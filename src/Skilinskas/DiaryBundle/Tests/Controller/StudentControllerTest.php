<?php

namespace Skilinskas\DiaryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Skilinskas\DiaryBundle\Entity\Student;

class StudentControllerTest extends WebTestCase
{
    public function testStudent () {
        $student = new Student();
        $name = 'Tester';
        $surname = 'Test';
        $student->setName($name);
        $student->setSurname($surname);

        $s = $student->getAll();
        $this->assertEquals($name, $s['name']);
        $this->assertEquals($surname, $s['surname']);
    }

    public function testGetStudents()
    {
        $client = static::createClient();
        $client->request('GET', '/api/get/students');

        $response = $client->getResponse()->getContent();

        $r = json_decode($response);
        $this->assertEquals(true, $r->success);
    }

}
