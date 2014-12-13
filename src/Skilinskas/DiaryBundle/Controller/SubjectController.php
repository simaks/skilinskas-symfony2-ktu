<?php

namespace Skilinskas\DiaryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Skilinskas\DiaryBundle\Service\SubjectService;
use Skilinskas\DiaryBundle\Entity\SubjectRepository;


class SubjectController extends Controller
{
    public function getSubjectsAction()
    {
        /** @var SubjectRepository $repository */
        $repository = $this->getDoctrine()->getRepository('SkilinskasDiaryBundle:Subject');
        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'error' => '',
            'result' => [
                'subjects' => (new SubjectService($repository))->getSubjects(),
            ],
        ]);

        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
