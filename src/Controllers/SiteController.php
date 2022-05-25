<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\App\View;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;

class SiteController
{
    protected Request $request;
    protected Response $response;
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function home()
    {
        return $this->response->renderView('home');
    }
}
