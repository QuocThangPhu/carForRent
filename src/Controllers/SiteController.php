<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\bootstrap\Application;
use Thangphu\CarForRent\bootstrap\Controller;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\Database\DatabaseConnect;

class SiteController extends Controller
{

    public function home()
    {
        $params = [
            'name' => "Sayno"
        ];
        return $this->render('home', $params);
    }
    /**
     * @return string|string[]
     */
    public function contact()
    {
        return $this->render('contact');
    }

    /**
     * @return string
     */
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return 'handling submittid';
    }

    /**
     * @param $number1
     * @param $number2
     * @return string
     */
}
