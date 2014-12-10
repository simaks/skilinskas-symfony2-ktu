<?php

namespace Skilinskas\DiaryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Skilinskas\DiaryBundle\Entity\Student;
use Skilinskas\DiaryBundle\Entity\Subject;
use Skilinskas\DiaryBundle\Entity\Grade;


class GradeController extends Controller
{
    private function getGrades($studentId = null, $subjectId = null, $date_from = null, $date_to = null)
    {
        $repository = $this->getDoctrine()
            ->getRepository('SkilinskasDiaryBundle:Grade');

        $queryBuild = $repository->createQueryBuilder('g');

        if ($studentId != null && $subjectId != null) {
            $queryBuild->where('g.date > :date_from AND g.date < :date_to AND g.studentId = :studentId AND g.subjectId = :subjectId')
                ->setParameter(':studentId', $studentId)->setParameter(':subjectId', $subjectId);
        } elseif ($subjectId != null) {
            $queryBuild->where('g.date > :date_from AND g.date < :date_to AND g.subjectId = :subjectId')
                ->setParameter(':subjectId', $subjectId);
        } elseif ($studentId != null) {
            $queryBuild->where('g.date > :date_from AND g.date < :date_to AND g.studentId = :studentId')
                ->setParameter(':studentId', $studentId);
        } else {
            $queryBuild->where('g.date > :date_from AND g.date < :date_to');
        }
        $queryBuild->setParameter(':date_from', $date_from)->setParameter(':date_to', $date_to);

        $query = $queryBuild->getQuery();

        $grades = $query->getResult();

        $result = [];
        /** @var Grade $g */
        foreach ($grades as $g) {
            array_push($result, $g->getAll());
        }
        return $result;
    }

    public function getSubjects()
    {
        $subjects = $this->getDoctrine()
            ->getRepository('SkilinskasDiaryBundle:Subject')
            ->findAll();
        $result = [];
        /** @var Subject $s */
        foreach ($subjects as $s) {
            array_push($result, $s->getAll());
        }
        return $result;
    }

    public function getStudents()
    {
        $students = $this->getDoctrine()
            ->getRepository('SkilinskasDiaryBundle:Student')
            ->findAll();
        $result = [];

        /** @var Student $s */
        foreach ($students as $s) {
            array_push($result, $s->getAll());
        }
        return $result;
    }

    public function getGradesAction(Request $request)
    {
        $studentId = $request->query->get('studentId');
        $subjectId = $request->query->get('subjectId');
        $date_from = $request->query->get('date_from');
        $date_to = $request->query->get('date_to');
        if ($date_from == null) {
            $date_from = date('Y-m-d', strtotime('-7 days'));
        }
        if ($date_to == null) {
            $date_to = date('Y-m-d');
        }
        if ($studentId == '*') {
            $studentId = null;
        }
        if ($subjectId == '*') {
            $subjectId = null;
        }
        $grades = $this->getGrades($studentId, $subjectId, $date_from, $date_to);

        $response = new Response();

        $response->setContent(json_encode([
            'success' => true,
            'error' => '',
            'result' => [
                'grades' => $grades,
            ],
        ]));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    public function getSubjectsAction()
    {
        $response = new Response();

        $response->setContent(json_encode([
            'success' => true,
            'error' => '',
            'result' => [
                'subjects' => $this->getSubjects(),
            ],
        ]));

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    public function getStudentsAction()
    {
        $response = new Response();

        $response->setContent(json_encode([
            'success' => true,
            'error' => '',
            'result' => [
                'students' => $this->getStudents(),
            ],
        ]));

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    public function addGradeAction(Request $request)
    {
        $student = $request->request->get('student');
        $subject = $request->request->get('subject');
        $grade = $request->request->get('grade');
        $date = $request->request->get('date');
        $error = '';
        if ($grade == null) {
            $error .= 'Grade not provided. ';
        }
        if ($student == null) {
            $error .= 'Student not provided. ';
        }
        if ($subject == null) {
            $error .= 'Subject not provided. ';
        }
        if ($date == null) {
            $error .= 'Date not provided. ';
        } else {
            $date = new \DateTime($date);
        }

        if ($error == '') {
            $gradeObject = new Grade();
            $gradeObject->setDate($date);
            $gradeObject->setGrade($grade);
            $gradeObject->setSubjectId($subject);
            $gradeObject->setStudentId($student);

            $em = $this->getDoctrine()->getManager();

            $em->persist($gradeObject);
            $em->flush();
        }

        $response = new Response();
        $response->setContent(json_encode([
            'success' => $error == '',
            'error' => $error,
        ]));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
