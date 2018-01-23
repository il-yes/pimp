<?php

namespace PrestationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PrestationController extends Controller
{
    public function indexAction()
    {
        return $this->render('Prestation/Prestation/index.html.twig');
    }

    public function newAction()
    {
        return $this->render('Prestation/Prestation/new.html.twig');
    }
}
