<?php

namespace Thangphu\CarForRent\Service;

use Aws\S3\Exception\S3Exception;
use Dotenv\Dotenv;
use Thangphu\CarForRent\Exception\UploadImageException;
use Aws\S3\S3Client;

class UploadImageService
{
    public function upload($file): ?string
    {
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
            throw new UploadImageException("Please select a valid file format.");
        }
        $maxsize = 10 * 1024 * 1024;

        if ($filesize > $maxsize) {
            throw new UploadImageException("File size is larger than the allowed limit.");
        }
        // Validate type of the file
        if (!in_array($filetype, $allowed)) {
            throw new UploadImageException("Please select a valid file format.");
        }
        if (move_uploaded_file($file["tmp_name"], $path . $filename)) {
            return '/upload/' . $filename;
        } else {
            throw new UploadImageException("There was an error uploading your file.");
        }
    }
}
