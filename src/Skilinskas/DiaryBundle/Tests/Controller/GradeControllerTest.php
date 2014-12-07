<?php

namespace Skilinskas\DiaryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GradeControllerTest extends WebTestCase
{

    public function testGrades()
    {
        $client = static::createClient();


        $client->request('GET', '/api/grades');

        $response = json_decode($client->getResponse()->getContent());

        $this->assertEquals(true, $response->success);
//        $this->assertEquals(8, $response->result->grades[0]->id);
    }


}
