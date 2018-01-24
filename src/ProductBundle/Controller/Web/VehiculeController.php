<?php

namespace ProductBundle\Controller\Web;

use ProductBundle\Entity\Moto;
use ProductBundle\Factory\VehiculeFactory;
use ProductBundle\Model\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VehiculeController extends Controller
{


    public function indexAction()
    {
        return $this->render('ProductBundle:Default:index.html.twig');
    }

    public function newAction()
    {
        $factory = new VehiculeFactory();
        $bike = $factory->createVehicule(Vehicule::MOTO);
        $bike->setName('test moto');
        $em = $this->getDoctrine()->getManager();
        $em->persist($bike);
        $em->flush();

        $bike = $em->getRepository(Moto::class)->findOneByName(['name' => $bike->getName()]);
        // for testing VehiculeController
        // return $this->render('Product/Vehicule/new.html.twig', ['type', $bike->getType()]);
        // for testing VehiculeControllerTest
        return $this->render('Product/Vehicule/new.html.twig');
    }
}
