<?php

namespace Skilinskas\DiaryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Skilinskas\DiaryBundle\Entity\Grade;


class GradeController extends Controller
{
    private function getGrades($subject = null, $date_from = null, $date_to = null) {
        $grades = $this->getDoctrine()
            ->getRepository('SkilinskasDiaryBundle:Grade')->findAllFiltered($subject, $date_from, $date_to);

        $result = [];
        foreach ($grades as $g) {
            array_push($result, $g->getAll());
        }
        return $result;
    }

    public function gradesAction(Request $request)
    {
        $date_from = $request->query->get('date_from');
        $date_to = $request->query->get('date_to');
        $callback = $request->query->get('callback');
        if ($date_from == null) {
            $date_from = date('Y-m-d', strtotime('-7 days'));
        }
        if ($date_to == null) {
            $date_to = date('Y-m-d');
        }
        $grades = $this->getGrades(null, $date_from, $date_to);


        $response = new Response();

        $response->setContent($callback . '(' . json_encode([
            'success' => true,
                'error' => '',
                'result' => [
                    'length' => count($grades),
                    'grades' => $grades,
                ],
        ]) . ')');
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
