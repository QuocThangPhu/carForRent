<?php

namespace Thangphu\CarForRent\App;

use Thangphu\CarForRent\bootstrap\Application;

class View
{
    public static function display($response)
    {
        if($response->getRedirectUrl() != null)
        {
            static::redirect($response->getRedirectUrl());
        }
        $template = $response->getTemplate();
        $data = $response->getData();

        require __DIR__ . "/../views/layouts/main.php";
        require __DIR__ . "/../views/$template.php";
    }

    public static function redirect($url)
    {
        header("Location: $url");
    }
}
