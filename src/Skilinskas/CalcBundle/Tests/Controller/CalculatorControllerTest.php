<?php

namespace Skilinskas\CalcBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function getValidAddData()
    {
        return [
            [1, 2, 3],
            [1, 0, 1],
            [100, -111.01, -11.01],
        ];
    }

    /**
     * @dataProvider getValidAddData
     */
    public function testAdd($a, $b, $c)
    {
        $client = static::createClient();

        $client->request('GET', sprintf('/calc/add/%f/%f/', $a, $b));

        $response = json_decode($client->getResponse()->getContent());

        $this->assertEquals(true, $response->success);
        $this->assertEquals($c, $response->ans);
    }
}
