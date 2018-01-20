<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 20/01/18
 * Time: 13:27
 */

namespace PrestationBundle\Controller;


use PrestationBundle\Entity\Action;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActionController extends Controller
{
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $action = new Action('test prestation service', 30);
        /*
        $em->persist($action);
        $em->flush();
        */

        return $this->render('Prestation/Action/new.html.twig', ['text' => 'car wash']);


    }
}