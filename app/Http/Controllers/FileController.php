<?php

namespace App\Http\Controllers;

use App\Events\DownloadFile;

class FileController extends BaseController
{
    /**
     * @param $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($file)
    {
        $path = $this->getFilePath($file);
        $header = $this->getHeader($file);

        logger('user download cv file');

        event(new DownloadFile($this->visitLogger));

        return response()->download($path, $file, $header);
    }

    /**
     * @param $file
     * @return string
     */
    protected function getFilePath($file)
    {
        return public_path() . '/' . config('settings.theme') . '/' . config('settings.file_path') . '/' . $file;
    }

    /**
     * @param $file
     * @return array
     */
    protected function getHeader($file)
    {
        return [
            'Content-Disposition: attachment; filename=' . $file
        ];
    }
}
