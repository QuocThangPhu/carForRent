<?php

namespace Thangphu\CarForRent\Service;

use Aws\S3\S3Client;
use Thangphu\CarForRent\Exception\UploadFileException;
use Thangphu\CarForRent\Validator\ImageValidator;

class UploadImageService
{


    public function upload($file): ?string
    {
        $imageValidator = new ImageValidator();
        $imageValidator->validateImage($file);
        if (!move_uploaded_file($file["tmp_name"], $this->getFileName($file))) {
            throw new UploadFileException("There was an error uploading your file.");
        }

        $filePath = $this->getFileName($file);

        $result = $this->uploadS3Service($filePath);
        return $result->get('ObjectURL');
    }

    private function uploadS3Service($filePath)
    {
        $bucketName = $_ENV['S3_BUCKET_NAME'];
        $bucketRegion = $_ENV['S3_BUCKET_REGION'];
        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => $bucketRegion,
            'credentials' => ['key' => $_ENV['S3_ACCESS_KEY_ID'], 'secret' => $_ENV['S3_SECRET_ACCESS_KEY']]
        ]);
        $key = 'upload/' . basename($filePath);
        $result = $s3Client->putObject([
            'Bucket' => $bucketName,
            'Key' => $key,
            'SourceFile' => $filePath,
        ]);
        unlink($filePath);
        return $result;
    }

    private function getFileName($file): string
    {
        $path = __DIR__ . "/../../public/upload/";
        $filename = md5(date('Y-m-d H:i:s:u')) . $file["name"];
        return $path . $filename;
    }
}
