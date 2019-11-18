<?php

namespace App\Contracts;

/**
 * Interface Uploader
 * @package App\Contracts
 */
interface Uploader
{
    /**
     * @param $image
     * @return bool|string
     */
    public function uploadSingleSizeImage($image);

    /**
     * @param $image
     * @return bool|string
     */
    public function uploadMultipleSizesImage($image);

    /**
     * @param $file
     * @return array|string
     */
    public function uploadFile($file);

    /**
     * @param $fileName
     * @param bool $isImage
     */
    public function deleteFile($fileName, $isImage = false);
}
