<?php

namespace Skilinskas\DiaryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Skilinskas\DiaryBundle\Entity\Grade;
use Skilinskas\DiaryBundle\Service\GradeService;


class GradeController extends Controller
{
    public function getGradesAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('SkilinskasDiaryBundle:Grade');
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

        $grades = (new GradeService())->getGrades($repository, $studentId, $subjectId, $date_from, $date_to);

        $response = new JsonResponse();

        $response->setData([
            'success' => true,
            'error' => '',
            'result' => [
                'grades' => $grades,
                'date_from' => $date_from,
                'date_to' => $date_to,
            ],
        ]);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    public function addGradeAction(Request $request)
    {
        $studentId = $request->request->get('studentId');
        $subjectId = $request->request->get('subjectId');
        $grade = $request->request->get('grade');
        $date = $request->request->get('date');
        $error = '';
        if ($grade == null) {
            $error .= 'Grade not provided. ';
        }
        if ($studentId == null) {
            $error .= 'Student not provided. ';
        }
        if ($subjectId == null) {
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
            $gradeObject->setSubjectId($subjectId);
            $gradeObject->setStudentId($studentId);

            $em = $this->getDoctrine()->getManager();

            $em->persist($gradeObject);
            $em->flush();
        }

        $response = new JsonResponse();
        $response->setData([
            'success' => $error == '',
            'error' => $error,
        ]);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
