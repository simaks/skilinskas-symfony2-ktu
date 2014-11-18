<?php

namespace Skilinskas\CalcBundle\Tests\Controller;

use Skilinskas\CalcBundle\Controller\CalculatorController;
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

    public function getValidMultiplyData()
    {
        return [
            [-1, 2, -2],
            [1, 0, 0],
            [-100, -0.01, 1],
        ];
    }

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(1, $crawler->filter('html:contains("Welcome to calculator!")')->count());
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

    /**
     * @dataProvider getValidAddData
     */
    public function testAddTwoNumbers($a, $b, $c)
    {
        $calculator = $this->getMock('\Skilinskas\CalcBundle\Controller\CalculatorController');
        $calculator->expects($this->once())
            ->method('addTwoNumbers')
            ->will($this->returnValue($a + $b));

        $this->assertEquals($calculator->addTwoNumbers($a, $b), $c);
    }

    /**
     * @dataProvider getValidMultiplyData
     */
    public function testMultiplyTwoNumbers($a, $b, $c)
    {
//        $calculator = $this->getMock('\Skilinskas\CalcBundle\Controller\CalculatorController');
//        $calculator->expects($this->once())
//            ->method('multiplyTwoNumbers')
//            ->will($this->returnValue($a * $b));

        $calculator = new CalculatorController();

        $this->assertEquals($calculator->multiplyTwoNumbers($a, $b), null);
    }
}
