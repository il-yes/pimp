<?php

namespace PrestationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PrestationBundle:Default:index.html.twig');
    }
}
