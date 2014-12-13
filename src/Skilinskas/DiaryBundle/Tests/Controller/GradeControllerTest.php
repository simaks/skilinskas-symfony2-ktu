<?php

namespace Skilinskas\DiaryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Skilinskas\DiaryBundle\Entity\Grade;
use Skilinskas\DiaryBundle\Entity\Subject;
use Skilinskas\DiaryBundle\Entity\Student;

class GradeControllerTest extends WebTestCase
{
    public function testGrade () {
        $grade = new Grade();
        $gGrade = 9;
        $gSubjectId = 2;
        $gStudentId =3;
        $gDate = '2014-10-10';
        $grade->setGrade($gGrade);
        $grade->setSubjectId($gSubjectId);
        $grade->setStudentId($gStudentId);
        $grade->setDate(date_create($gDate));

        $g = $grade->getAll();
        $this->assertEquals($gGrade, $g['grade']);
        $this->assertEquals($gSubjectId, $g['subjectId']);
        $this->assertEquals($gStudentId, $g['studentId']);
        $this->assertEquals($gDate, $g['date']);
    }

    public function testGetGrades()
    {
        $client = static::createClient();
        $client->request('GET', '/api/get/grades', ['studentId' => '*', 'subjectId' => '*']);
        $response = $client->getResponse()->getContent();
        $r1 = json_decode($response);
        $this->assertEquals(true, $r1->success);

        $client->request('GET', '/api/get/grades', ['studentId' => 1, 'subjectId' => 1]);
        $response = $client->getResponse()->getContent();
        $r2 = json_decode($response);
        $this->assertEquals(true, $r2->success);

        $client->request('GET', '/api/get/grades', ['subjectId' => 1]);
        $response = $client->getResponse()->getContent();
        $r2 = json_decode($response);
        $this->assertEquals(true, $r2->success);

        $client->request('GET', '/api/get/grades', ['studentId' => 1]);
        $response = $client->getResponse()->getContent();
        $r2 = json_decode($response);
        $this->assertEquals(true, $r2->success);
        $this->assertTrue(count($r1->result->grades) >= count($r2->result->grades));
    }

    public function testAddGrade()
    {
        $client = static::createClient();
        $client->request('POST', '/api/add/grade', [
            'subjectId' => 1,
            'studentId' => 1,
            'grade' => 10,
            'date' => '2014-12-25',
        ]);
        $response = $client->getResponse()->getContent();
        $r = json_decode($response);
        $this->assertEquals(true, $r->success);


        $client->request('POST', '/api/add/grade');

        $response = $client->getResponse()->getContent();

        $r = json_decode($response);
        $this->assertEquals(false, $r->success);
    }

}
