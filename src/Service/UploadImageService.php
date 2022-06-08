<?php

namespace Thangphu\CarForRent\Service;

use Thangphu\CarForRent\Exception\UploadFileException;
use Thangphu\CarForRent\Validator\ImageValidator;

class UploadImageService
{


    public function upload($file): ?string
    {
        $validatorFile = new ImageValidator();
        $validatorFile->validateImage($file);
        if (!move_uploaded_file($file["tmp_name"], $this->getURL($this->getFilePath(), $this->getFileName($file)))) {
            throw new UploadFileException("There was an error uploading your file.");
        }
        move_uploaded_file($file["tmp_name"],$this->getURL($this->getFilePath(), $this->getFileName($file)));
        return '/upload/' . $this->getFileName($file);
    }

    private function getFilePath()
    {
        return __DIR__ . "/../../public/upload/";
    }

    private function getFileName($file): string
    {
        return md5(date('Y-m-d H:i:s:u')) . $file["name"];
    }

    private function getURL($path, $fileName)
    {
        return $path . $fileName;
    }
}
