<?php

namespace App\Services;

use App\Contracts\Uploader;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UploadFile implements Uploader
{
    /**
     * @var string
     */
    public $imageDirectory;

    /**
     * @var array $imageCropSizes
     */
    public $imageCropSizes;

    /**
     * @var array $imageUploadTypes
     */
    public $imageUploadTypes = [
        'ss' => 'uploadSingleSizeImage',
        'ms' => 'uploadMultipleSizesImage'
    ];

    /**
     * @param $image
     * @return bool|string
     */
    public function uploadSingleSizeImage($image)
    {
        $imageCropSizes = $this->imageCropSizes;
        $imgName = $this->getImageName('.png');

        if ($this->uploadImage($image, $imgName, $imageCropSizes['width'], $imageCropSizes['height'])) {
            return $imgName;
        }

        return false;
    }

    /**
     * @param $image
     * @return bool|string
     */
    public function uploadMultipleSizesImage($image)
    {
        $imageCropSizes = $this->imageCropSizes;
        $imageSizeTypes = $this->getImageSizeTypes($imageCropSizes);
        $imageNamesObject = $this->getImageNamesObject($imageSizeTypes);

        foreach ($imageCropSizes as $imageSizeName => $CropSizes) {
            $this->uploadImage(
                $image,
                $imageNamesObject->$imageSizeName,
                $CropSizes['width'],
                $CropSizes['height']
            );
        }

        return $imageNamesObject;
    }

    /**
     * @param $file
     * @return array|string
     */
    public function uploadFile($file)
    {
        $fileName = $file->getClientOriginalName();
        $destinationPath = $this->getFilePath();

        if($file->move($destinationPath, $fileName)) {
            return $fileName;
        }

        return false;
    }

    /**
     * @param $fileName
     * @param bool $isImage
     * @return bool
     */
    public function deleteFile($fileName, $isImage = false)
    {
        if ($isImage) {
            $path = $this->getImagePath();
        } else {
            $path = $this->getFilePath();
        }

        $file = $path . '/' . $fileName;

        if (File::isFile($file)) {
            File::delete($file);

            return true;
        }

        return false;
    }

    /**
     * @param $image
     * @param $imageName
     * @param $width
     * @param $height
     * @return bool
     */

    protected function uploadImage($image, $imageName, $width, $height)
    {
        $img = Image::make($image);

        if ($img->fit($width, $height)->save($this->getImagePath() . '/' . $imageName)) {
            return true;
        }

        return false;
    }

    /**
     * @param $type
     * @param $suffix
     * @return string
     */
    protected function getImageName($type, $suffix = '')
    {
        return $this->getRandomString(8) . $suffix . $type;
    }

    /**
     * @param $count
     * @return string
     */
    protected function getRandomString($count)
    {
        return Str::random($count);
    }

    /**
     * @param array $imageSizeTypes
     * @return \stdClass
     */
    protected function getImageNamesObject(array $imageSizeTypes)
    {
        $imageNamesObject = new \stdClass();

        foreach ($imageSizeTypes as $imageSizeType) {
            $imageNamesObject->$imageSizeType = $this->getImageName('.png', '_' . $imageSizeType);
        }

        return $imageNamesObject;
    }

    /**
     * @param array $configImageSizes
     * @return array
     */
    protected function getImageSizeTypes(array $configImageSizes)
    {
        $imageSizeTypes = [];

        foreach ($configImageSizes as $key => $value) {
            $imageSizeTypes[] = $key;
        }

        return $imageSizeTypes;
    }

    /**
     * Get file directory.
     * @return string
     */
    protected function getFilePath()
    {
        return public_path() . '/' . config('settings.theme') . '/' . config('settings.file_path');
    }

    /**
     * Get image directory.
     * @return string
     */
    protected function getImagePath()
    {
        $imagePath = public_path() . '/' . config('settings.theme') . '/' . config('settings.image_path');

        if ($this->imageDirectory) {
            $imagePath .= '/' . $this->imageDirectory;
        }

        return $imagePath;
    }
}
