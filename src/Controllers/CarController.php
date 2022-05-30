<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Repository\CarRepository;
use Thangphu\CarForRent\Request\CarRequest;
use Thangphu\CarForRent\Response\CarResponse;
use Thangphu\CarForRent\Service\CarService;
use Thangphu\CarForRent\varlidator\CreateCarValidator;

class CarController
{
    protected CarResponse $carResponse;
    protected Response $response;
    protected Request $request;
    protected CarRequest $carRequest;
    protected CreateCarValidator $carValidator;
    protected CarRepository $carRepository;

    public function __construct(
        CarResponse   $carResponse,
        Response      $response,
        Request       $request,
        CarRequest $carRequest,
        CreateCarValidator $carValidator,
        CarRepository $carRepository
    )
    {
        $this->carResponse = $carResponse;
        $this->request = $request;
        $this->response = $response;
        $this->carRequest = $carRequest;
        $this->carValidator = $carValidator;
        $this->carRepository = $carRepository;
    }

    public function createCarView()
    {
        return $this->response->renderView('createCar');
    }

    public function storeCar()
    {
        $errorMessage = '';
        try {
            if ($this->request->isPost()) {
                $this->carRequest->fromArray($this->request->getBody());
                $this->carValidator->createCarValidator($this->carRequest);
                $isSuccess = $this->carRepository->createCar($this->carRequest);
                if($isSuccess){
                    return $this->response->renderView('home');
                }
                $errorMessage = 'Somethings is wrong';
            }
        } catch (\Exception $exception) {
            $exception->getMessage();
            $errorMessage = 'Something is error';
        }
        //return view
        return $this->response->renderView('createCar', [
            'errors' => $errorMessage
        ]);
    }
}
