<?php

namespace Skilinskas\CalcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('SkilinskasCalcBundle:Welcome:index.html.twig');
    }
}
