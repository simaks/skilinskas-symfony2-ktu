<?php

namespace Skilinskas\CalcBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $response=  json_decode($client->getResponse()->getContent());

        $this->assertEquals(true, $response->success);
        $this->assertEquals(3, $response->ans);
    }
}
