<?php

namespace Thangphu\Test\Controller;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Bootstrap\Response;
use Thangphu\CarForRent\Controllers\SiteController;
use Thangphu\CarForRent\Model\CarModel;
use Thangphu\CarForRent\Repository\CarRepository;

class SiteControllerTest extends TestCase
{
    public function testHome()
    {
        $response = new Response();
        $carRepository = $this->getMockBuilder(CarRepository::class)->disableOriginalConstructor()->getMock();
        $siteView = new SiteController($response ,$carRepository);
        $resultView = $siteView->home()->getTemplate();
        $expectedView = new Response();
        $expectedView->renderView('home', ['cars' => $carRepository->selectCar()]);
        $this->assertEquals($expectedView->getTemplate(), $resultView);
    }
}