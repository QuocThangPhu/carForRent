<?php

namespace Thangphu\Test\Controller;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Bootstrap\Request;
use Thangphu\CarForRent\Bootstrap\Response;
use Thangphu\CarForRent\Controllers\CarController;
use Thangphu\CarForRent\Repository\CarRepository;
use Thangphu\CarForRent\Request\CarRequest;
use Thangphu\CarForRent\Service\UploadImageService;
use Thangphu\CarForRent\Validator\CreateCarValidator;

class CarControllerTest extends TestCase
{
    public function testCreateCarWithWrongMethod()
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $response = new Response();
        $carRequest = new CarRequest();
        $carValidator = new CreateCarValidator();
        $carRepository = $this->getMockBuilder(CarRepository::class)->getMock();
        $uploadFile = $this->getMockBuilder(UploadImageService::class)->getMock();
        $carController = new CarController($response, $requestMock, $carRequest, $carValidator, $carRepository, $uploadFile);
        $result = $carController->createNewCar();
        $this->assertEquals('createCar', $result->getTemplate());
    }

    public function testCreateCarWithWrongData()
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects($this->once())->method('isPost')->willReturn(true);
        $requestMock->expects($this->once())->method('getFileName')->willReturn([
            'picture' => 'car.jpg'
        ]);
        $requestMock->expects($this->once())->method('getBody')->willReturn([
            'name' => 'test car demo',
            'price' => '45',
            'picture' => 'car.jpg',
            'brand' => 'test data'
        ]);
        $uploadFile = $this->getMockBuilder(UploadImageService::class)->getMock();
        $uploadFile->expects($this->once())->method('upload')->willReturn('car.jpg');
        $response = new Response();
        $carRequest = $this->getMockBuilder(CarRequest::class)->getMock();
        $carValidator = new CreateCarValidator();
        $carRepository = $this->getMockBuilder(CarRepository::class)->getMock();
        $carController = new CarController($response, $requestMock, $carRequest, $carValidator, $carRepository, $uploadFile);
        $result = $carController->createNewCar();
        $this->assertEquals('createCar', $result->getTemplate());
    }
}