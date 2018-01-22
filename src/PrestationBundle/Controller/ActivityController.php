<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 20/01/18
 * Time: 13:27
 */

namespace PrestationBundle\Controller;


use PrestationBundle\Entity\Activity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActivityController extends Controller
{
    public function indexAction()
    {
        return $this->render('PrestationBundle/Activity/index.html.twig');
    }

    public function newAction(Request $request)
    {
        /*
            $em = $this->getDoctrine()->getManager();
            $action = new Action($data['name'], $data['category'], $data['price']);

            $em->persist($action);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', sprintf('vous avez selectionnez %s, merci de votre confiance', $action->getName()));

            return $this->redirectToRoute('prestation_action_index');
        */

        return $this->render('Prestation/Activity/new.html.twig', ['text' => 'Hello this is here to create a new acivity']);
    }
}