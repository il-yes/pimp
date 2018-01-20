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
    public function indexAction()
    {
        return $this->render('PrestationBundle/Action/index.html.twig');
    }

    public function newAction(Request $request, $data)
    {

        $em = $this->getDoctrine()->getManager();
        $action = new Action($data['name'], $data['category'], $data['price']);

        $em->persist($action);
        $em->flush();

        $request->getSession()
            ->getFlashBag()
            ->add('success', sprintf('vous avez selectionnez %s, merci de votre confiance', $action->getName()));

        return $this->redirectToRoute('prestation_action_index');
    }
}