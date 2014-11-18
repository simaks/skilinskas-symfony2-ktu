<?php

namespace Skilinskas\CalcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CalculatorController extends Controller
{
    /**
     * @param $x
     * @param $y
     * @return mixed
     */
    public function addTwoNumbers($x, $y) {
        return $x + $y;
    }

    /**
     * @param $x
     * @param $y
     * @return mixed
     */
    public function multiplyTwoNumbers($x, $y) {
        return null; // TODO implement;
    }

    /**
     * @Route("/", name="_welcome")
     * @Template()
     */
    public function addAction($x, $y)
    {
        return $this->render('SkilinskasCalcBundle:Calculator:index.html.twig', [
            'result' => [
                'success' => true,
                'x' => $x,
                'y' => $y,
                'ans' => $this->addTwoNumbers($x, $y),
            ],
        ]);
    }
}
