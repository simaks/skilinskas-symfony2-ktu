<?php

namespace Skilinskas\DiaryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GradeControllerTest extends WebTestCase
{

    public function testGrades()
    {
        $client = static::createClient();


        $client->request('GET', '/api/grades');

        $response = $client->getResponse()->getContent();

        $r = json_decode(substr($response, 1, strlen($response)-2));
        $this->assertEquals(true, $r->success);
    }


}
