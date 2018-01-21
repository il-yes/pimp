<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 21/01/18
 * Time: 14:28
 */

namespace ProductBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WorkshopController extends Controller
{
    public function newAction()
    {
        //$workshop = new Workshop();
        return $this->render('Product/Workshop/new.html.twig');
    }
}