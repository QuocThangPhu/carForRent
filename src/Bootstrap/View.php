<?php

namespace Thangphu\CarForRent\Bootstrap;

class View
{
    public static function display($response)
    {
        if ($response->getRedirectUrl() != null) {
            static::redirect($response->getRedirectUrl());
        }
        if ($response->getTemplate() != null) {
            static::handleViewTemplate($response);
            return;
        }
        static::handleViewJson($response);
    }

    public static function handleViewJson(Response $response)
    {
        $data = $response->getData();
        $statusCode = $response->getStatusCode();
        $dataResponse = json_encode($data);
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($statusCode);
        print_r($dataResponse);
    }

    public static function handleViewTemplate(Response $response)
    {
        $template = $response->getTemplate();
        $data = $response->getData();

        require __DIR__ . "/../Views/layouts/main.php";
        require __DIR__ . "/../Views/$template.php";
    }

    public static function redirect($url)
    {
        header("Location: $url");
    }
}
