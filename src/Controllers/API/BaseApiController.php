<?php

namespace Thangphu\CarForRent\Controllers\API;

use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Response\UserResponse;

abstract class BaseApiController
{
    protected Request $request;
    protected Response $response;
    protected UserResponse $userResponse;

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response, UserResponse $userResponse)
    {
        $this->request = $request;
        $this->response = $response;
        $this->userResponse = $userResponse;
    }
}