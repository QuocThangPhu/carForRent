<?php

namespace Thangphu\CarForRent\Service;

use Thangphu\CarForRent\Exception\UploadFileException;

class UploadImageService
{


    public function upload($file): ?string
    {
        if (!move_uploaded_file($file["tmp_name"], $this->getURL($this->getFilePath(), $this->getFileName($file)))) {
            throw new UploadFileException("There was an error uploading your file.");
        }
        move_uploaded_file($file["tmp_name"],$this->getURL($this->getFilePath(), $this->getFileName($file)));
        return '/upload/' . $this->getFileName($file);
    }

    private function getFilePath()
    {
        return __DIR__ . "/../../../public/upload/";
    }

    private function getFileName($file): string
    {
        $filename = md5(date('Y-m-d H:i:s:u')) . $file["name"];
        return $filename;
    }

    private function getURL($path, $fileName)
    {
        return $path . $fileName;
    }
}
