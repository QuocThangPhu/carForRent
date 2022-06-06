<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Repository\CarRepository;
use Thangphu\CarForRent\Request\CarRequest;
use Thangphu\CarForRent\Response\CarResponse;
use Thangphu\CarForRent\Service\UploadImageService;
use Thangphu\CarForRent\varlidator\CreateCarValidator;

class CarController
{
    protected CarResponse $carResponse;
    protected Response $response;
    protected Request $request;
    protected CarRequest $carRequest;
    protected CreateCarValidator $carValidator;
    protected CarRepository $carRepository;
    protected UploadImageService $uploadImageService;

    public function __construct(
        CarResponse   $carResponse,
        Response      $response,
        Request       $request,
        CarRequest $carRequest,
        CreateCarValidator $carValidator,
        CarRepository $carRepository,
        UploadImageService $uploadImageService
    ) {
        $this->carResponse = $carResponse;
        $this->request = $request;
        $this->response = $response;
        $this->carRequest = $carRequest;
        $this->carValidator = $carValidator;
        $this->carRepository = $carRepository;
        $this->uploadImageService = $uploadImageService;
    }

    public function createNewCar()
    {
        if (!$this->request->isPost()) {
            return $this->response->renderView('createCar');
        }
        $requestData = $this->request->getBody();
        $requestData['picture'] = $_FILES['picture']['name'];
        $this->carRequest->fromArray($requestData);
        $isCarValid = $this->carValidator->createCarValidator($this->carRequest);
        if (is_array($isCarValid)) {
            return $this->response->renderView('createCar', [
                'errors' => $isCarValid
            ]);
        }
        $isUploadImage = $this->uploadImageService->upload($_FILES['picture']);
        $this->carRequest->setPicture($isUploadImage);
        $isSuccess = $this->carRepository->createCar($this->carRequest);
        if ($isSuccess) {
            return $this->response->redirect('/');
        }
        $errorMessage = 'Somethings is wrong';
        return $this->response->renderView('createCar', [
            'errors' => $errorMessage
        ]);
    }
}
