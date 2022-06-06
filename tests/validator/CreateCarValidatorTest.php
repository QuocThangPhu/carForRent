<?php

namespace Thangphu\Test\validator;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Request\CarRequest;
use Thangphu\CarForRent\varlidator\CreateCarValidator;

class CreateCarValidatorTest extends TestCase
{
    /**
     * @dataProvider CreateCarValidatorProvider
     */
    public function testCreateCarValidatorWithTrue($param)
    {
        $carRequest = new CarRequest();
        $carRequest->fromArray($param);
        $carValidator = new CreateCarValidator();
        $result = $carValidator->createCarValidator($carRequest);
        $this->assertTrue($result);
    }


    /**
     * @dataProvider CreateCarValidatorFasleProvider
     */
    public function testCreateCarValidatorWithFasle($param)
    {
        $carRequest = new CarRequest();
        $carRequest->fromArray($param);
        $carValidator = new CreateCarValidator();
        $result = $carValidator->createCarValidator($carRequest);
        $this->assertIsArray($result);
    }

    public function CreateCarValidatorProvider()
    {
        return [
            'user-response-1' => [
                'param' =>[
                    'name' => 'Ford AvG',
                    'brand' => 'ford',
                    'price' => '500',
                    'picture' => 'test.jpg'
                ],
            ]
        ];
    }

    public function CreateCarValidatorFasleProvider()
    {
        return [
            'user-response-1' => [
                'param' =>[
                    'name' => 'Fo',
                    'brand' => 'fo',
                    'price' => 'tase',
                    'picture' => ''
                ],
            ],
            'user-response-2' => [
                'param' =>[
                    'name' => 4,
                    'brand' => '5grYDBGqnf8TOmFt3EhRQzMB6DaGcrAerEJCDhH2ORhJTGiAWf92dKW1BRWZu2PtawumZdttu48doF35sv21Q3Jv
                    rmKxPm6GTgFewUIfQjt1uLhSI62r7NRWRk0AhKuc9EHpJtH70mgQ37LPCBSsd
                    OMloN4pszSyeY1S8S61PIFH5hzd4xnkSZbS09dBrS
                    g84NuvSTf8S22fDN6P14vRgThdywPmguu7rnwx0o4zdieuWQ8qoBGlZ0J9QQUgwT9Y',
                    'price' => 'qwe2',
                    'picture' => ''
                ],
            ]
        ];
    }
}