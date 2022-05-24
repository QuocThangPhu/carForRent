<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\App\View;
use Thangphu\CarForRent\bootstrap\Request;

class SiteController
{

    public function home()
    {
        $params = [
            'name' => "Sayno"
        ];
        return View::renderView('home', $params);
    }
}
