<?php

namespace Thangphu\CarForRent\bootstrap;

use ParagonIE\Sodium\File;

class Request
{
    /**
     * @return string
     */
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        if (!strpos($path, '?')) {
            return $path;
        }
        return substr($path, 0, strpos($path, '?'));
    }

    /**
     * @return string
     */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isGet()
    {
        return $this->method() === 'GET';
    }

    public function isPost()
    {
        return $this->method() === 'POST';
    }

    public function getRequestBody(): bool|string
    {
        return file_get_contents('php://input');
    }

    public function getRequestJsonBody()
    {
        $data = file_get_contents('php://input');

        return json_decode($data, true);
    }

    public function getFile()
    {
        return $_FILES['picture'];
    }

    public function getFileName()
    {
        return $_FILES['picture']['name'];
    }

    /**
     * @return array
     */
    public function getBody()
    {
        $body = [];
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
}
