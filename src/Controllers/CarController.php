<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\Bootstrap\Request;
use Thangphu\CarForRent\Bootstrap\Response;
use Thangphu\CarForRent\Repository\CarRepository;
use Thangphu\CarForRent\Request\CarRequest;
use Thangphu\CarForRent\Service\UploadImageService;
use Thangphu\CarForRent\Validator\CreateCarValidator;

class CarController extends BaseController
{
    const  SOME_THING_WRONG = 'Somethings is wrong';
    protected CarRequest $carRequest;
    protected CreateCarValidator $carValidator;
    protected CarRepository $carRepository;
    protected UploadImageService $uploadImageService;

    public function __construct(
        Response $response,
        Request $request,
        CarRequest $carRequest,
        CreateCarValidator $carValidator,
        CarRepository $carRepository,
        UploadImageService $uploadImageService
    ) {
        parent::__construct($request, $response);
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
        $this->checkValidateCreateCar();
        $isUploadImage = $this->uploadImageService->upload($this->request->getFile());
        $this->carRequest->setPicture($isUploadImage);
        $this->checkCreateCarSuccess();
        $errorMessage = static::SOME_THING_WRONG;
        return $this->response->renderView('createCar', [
            'errors' => $errorMessage
        ]);
    }

    private function checkValidateCreateCar()
    {
        $requestData = $this->request->getBody();
        $requestData['picture'] = $this->request->getFileName();
        $this->carRequest->fromArray($requestData);
        $isCarValid = $this->carValidator->createCarValidator($this->carRequest);
        if (is_array($isCarValid)) {
            return $this->response->renderView('createCar', [
                'errors' => $isCarValid
            ]);
        }
    }

    private function checkCreateCarSuccess()
    {
        $isSuccess = $this->carRepository->createCar($this->carRequest);
        if ($isSuccess) {
            return $this->response->redirect('/');
        }
    }
}
