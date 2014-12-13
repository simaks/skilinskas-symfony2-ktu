<?php

namespace Skilinskas\DiaryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Skilinskas\DiaryBundle\Entity\Subject;

class SubjectControllerTest extends WebTestCase
{
    public function testSubject () {
        $subject = new Subject();
        $name = 9;
        $subject->setName($name);

        $s = $subject->getAll();
        $this->assertEquals($name, $s['name']);
    }

    public function testGetSubjects()
    {
        $client = static::createClient();
        $client->request('GET', '/api/get/subjects');

        $response = $client->getResponse()->getContent();

        $r = json_decode($response);
        $this->assertEquals(true, $r->success);
    }
}
