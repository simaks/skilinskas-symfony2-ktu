<?php

namespace Skilinskas\DiaryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Skilinskas\DiaryBundle\Entity\Grade;

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

    public function testGrades()
    {
        $client = static::createClient();


        $client->request('GET', '/api/grades');

        $response = $client->getResponse()->getContent();

        $r = json_decode(substr($response, 1, strlen($response)-2));
        $this->assertEquals(true, $r->success);
    }


}
