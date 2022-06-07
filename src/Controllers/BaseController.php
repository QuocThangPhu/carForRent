<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\Bootstrap\Request;
use Thangphu\CarForRent\Bootstrap\Response;

abstract class BaseController
{
    protected Request $request;
    protected Response $response;

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}
