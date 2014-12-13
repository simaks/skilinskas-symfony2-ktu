<?php

namespace Skilinskas\DiaryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Skilinskas\DiaryBundle\Service\StudentService;
use Skilinskas\DiaryBundle\Entity\StudentRepository;


class StudentController extends Controller
{
    public function getStudentsAction()
    {
        /** @var StudentRepository $repository */
        $repository = $this->getDoctrine()->getRepository('SkilinskasDiaryBundle:Student');
        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'error' => '',
            'result' => [
                'students' => (new StudentService($repository))->getStudents(),
            ],
        ]);

        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
