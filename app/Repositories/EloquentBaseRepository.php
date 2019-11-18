<?php

namespace App\Repositories;

abstract class EloquentBaseRepository
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * @var $imageUploadType
     */
    protected $imageUploadType;

    /**
     * @var $uploader
     */
    protected $uploader;

    /**
     * @var array $exceptFields
     */
    protected $exceptFields = ['_method', '_token'];

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function latest($columns = array('*'))
    {
        return $this->model->latest()->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 5, $columns = array('*'))
    {
        return $this->model->latest()->paginate($perPage, $columns);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function first($columns = array('*'))
    {
        return $this->model->first($columns);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        $data = $this->getRequestData($request);

        if ($request->hasFile('img')) {
            if ($img = $this->uploadImage($request->file('img'))) {
                $data['img'] = $img;
            } else {
                return ['error' => __('admin.image_not_correct')];
            }
        }

        if ($request->hasFile('cv')) {
            if ($uploadFileResult = $this->uploadFile($request->file('cv'))) {
                $data['cv'] = $uploadFileResult;
            } else {
                return ['error' => __('admin.file_not_correct')];
            }
        }

        if ($this->model->create($data)) {
            return ['success' => __('admin.data_added')];
        }

        return ['error' => __('admin.something_went_wrong')];
    }

    /**
     * @param $request
     * @param $dataCollection
     * @return mixed
     */
    public function update($request, $dataCollection)
    {
        $data = $this->getRequestData($request);

        if ($request->hasFile('img')) {
            if ($uploadedImg = $this->uploadImage($request->file('img'))) {
                $data['img'] = $uploadedImg;

                if ($dataCollection->img) {
                    //Deleting old image
                    $this->deleteImageData($dataCollection->img);
                }
            } else {
                return ['error' => __('admin.image_not_correct')];
            }
        }

        if ($request->hasFile('cv')) {
            if ($uploadedFile = $this->uploadFile($request->file('cv'))) {
                $data['cv'] = $uploadedFile;

                if ($dataCollection->cv) {
                    //Deleting old file
                    $this->deleteFile($dataCollection->cv);
                }
            } else {
                return ['error' => __('admin.file_not_correct')];
            }
        }

        $dataCollection->fill($data);

        if ($dataCollection->save()) {
            return ['success' => __('admin.data_updated')];
        }

        return ['error' => __('admin.something_went_wrong')];
    }

    /**
     * @param $dataCollection
     * @return mixed
     */
    public function delete($dataCollection)
    {
        if ($dataCollection->img) {
            $this->deleteImageData($dataCollection->img);
        }

        if ($dataCollection->cv) {
            $this->deleteFile($dataCollection->cv);
        }

        if ($this->model->destroy($dataCollection->id)) {
            return ['success' => __('admin.data_deleted')];
        }

        return ['error' => __('admin.something_went_wrong')];
    }

    /**
     * @param $image
     * @return mixed
     */
    protected function uploadImage($image)
    {
        $imageUploadType = $this->imageUploadType;

        if ($image->isValid()) {
            if ($uploadResult = $this->uploader->$imageUploadType($image)) {
                return $uploadResult;
            }
        }

        return false;
    }

    /**
     * @param $file
     * @return mixed
     */
    protected function uploadFile($file)
    {
        if ($file->isValid()) {
            if ($uploadResult = $this->uploader->uploadFile($file)) {

                return $uploadResult;
            }
        }

        return false;
    }

    /**
     * @param $imageData
     * @return mixed
     */
    protected function deleteImageData($imageData)
    {
        if (is_array($imageData) || is_object($imageData)) {
            foreach ($imageData as $image) {
                $this->uploader->deleteFile($image, true);
            }
        } else {
            $this->uploader->deleteFile($imageData, true);
        }
    }

    /**
     * @param $file
     * @return mixed
     */
    protected function deleteFile($file)
    {
        $this->uploader->deleteFile($file);
    }

    /**
     * @param array $fields
     * @return mixed
     */
    protected function setExceptFields(array $fields)
    {
        $this->exceptFields = array_merge($this->exceptFields, $fields);
    }

    /**
     * @param $request
     * @return mixed
     */
    protected function getRequestData($request)
    {
        return $request->except($this->exceptFields);
    }
}
