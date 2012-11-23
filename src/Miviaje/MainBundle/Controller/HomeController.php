<?php

namespace Miviaje\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MiviajeMainBundle:Home:index.html.twig', array('name' => $name));
    }
}
