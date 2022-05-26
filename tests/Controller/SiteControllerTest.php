<?php

namespace Thangphu\Test\Controller;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Controllers\SiteController;

class SiteControllerTest extends TestCase
{
    public function testHome()
    {
        $response = new Response();
        $siteView = new SiteController($response);
        $resultView = $siteView->home()->getTemplate();
        $expectedView = new Response();
        $expectedView->setTemplate('home');
        $this->assertEquals($expectedView->getTemplate(), $resultView);
    }
}