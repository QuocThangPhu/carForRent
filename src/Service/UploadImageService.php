<?php

namespace Thangphu\CarForRent\Service;

use Aws\S3\Exception\S3Exception;
use Dotenv\Dotenv;
use Thangphu\CarForRent\Exception\UploadImageException;
use Aws\S3\S3Client;

class UploadImageService
{

//    protected static $dotenv;

    public function upload($file): ?string
    {
//        $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
//        self::$dotenv = $dotenv->load();
//        $bucketName = $_ENV['S3_BUCKET_NAME'];
//        $bucketRegion = $_ENV['S3_BUCKET_REGION'];
//        $s3Client = new S3Client([
//            'version' => 'latest',
//            'region' => $bucketRegion,
//            'credentials' => ['key' => $_ENV['S3_ACCESS_KEY_ID'], 'secret' => $_ENV['S3_SECRET_ACCESS_KEY']]
//        ]);
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            throw new UploadImageException('Invalid request method');
        }
        if (!isset($file) || $file["error"] != 0) {
            throw new UploadImageException('File upload does not exist');
        }
        $allowed = array(
            "jpg" => "image/jpg",
            "jpeg" => "image/jpeg",
            "gif" => "image/gif",
            "png" => "image/png"
        );
        $path = __DIR__ . "/../../public/upload/";
        $filename = md5(date('Y-m-d H:i:s:u')) . $file["name"];
        $filetype = $file["type"];
        $filesize = $file["size"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) {
            throw new UploadImageException("Error: Please select a valid file format.");
        }
        $maxsize = 10 * 1024 * 1024;

        if ($filesize > $maxsize) {
            throw new UploadImageException("Error: File size is larger than the allowed limit.");
        }
        // Validate type of the file
        if (!in_array($filetype, $allowed)) {
            throw new UploadImageException("Error: Please select a valid file format.");
        }


        if (move_uploaded_file($file["tmp_name"], $path . $filename)) {
//            $file_Path = $path. $filename;
//            $key = basename($file_Path);
//            try {
//                $result = $s3Client->putObject([
//                    'Bucket' => $bucketName,
//                    'Key' => $key,
//                    'SourceFile' => $file_Path,
//                ]);
//                unlink($path . $filename);
//                return $result->get('ObjectURL');
//            } catch (S3Exception $e) {
//                return null;
//            }
            return '/upload/'. $filename;
        } else {
            throw new UploadImageException("Error: There was an error uploading your file.");
        }
    }
}