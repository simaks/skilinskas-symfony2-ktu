<?php

namespace Skilinskas\DiaryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SkilinskasDiaryBundle:Default:index.html.twig', array('name' => $name));
    }
}
