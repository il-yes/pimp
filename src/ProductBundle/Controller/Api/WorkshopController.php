<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 21/01/18
 * Time: 20:33
 */

namespace ProductBundle\Controller\Api;

use ProductBundle\Entity\Workshop;
use ProductBundle\Factory\WorkshopFactory;
use ProductBundle\Form\WorkshopType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class WorkshopController extends Controller
{
    /**
     * @return Response
     * POST | /api/workshops
     */
    public function newAction(Request $request)
    {

        $data = json_decode($request->getContent(), true);

        $factory = new WorkshopFactory();
        $workshop = $factory->createFromSpecification(
            $data['name'],
            $data['activity'],
            $data['capacity'],
            $data['isAvailable']
        );
        /*
        $form = $this->createForm(WorkshopType::class, $workshop);
        $this->processForm($request, $form);
        */


        $em = $this->getDoctrine()->getManager();
        $em->persist($workshop);
        $em->flush();

        $location = $this->generateUrl('api_product_workshop_show', [
            'id' => $workshop->getId()
        ]);

        $data = $this->workshopSerializer($workshop);

        $response = new JsonResponse($data, 201);
        $response->headers->set('Location', $location);

        return $response;
    }


    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $workshop = $em->getRepository(Workshop::class)->find($id);

        if (!$workshop)
        {
            throw $this->createNotFoundException(sprintf(
                'No workshop found with nickname "%s"',
                $id));
        }

        $data = $this->workshopSerializer($workshop);

        $response = new JsonResponse($data, 200);

        return $response;

    }

    private function workshopSerializer(Workshop $workshop)
    {
        return [
            'id' => $workshop->getId(),
            'name' => $workshop->getName(),
            'capacity' => $workshop->getCapacity(),
            'available' => $workshop->getIsAvailable(),
            'activity' => $workshop->getActivities()
        ];
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $workshops = $em->getRepository(Workshop::class)->findAll();

        $data = ['Workshops' => []];
        foreach ($workshops as $workshop)
        {
            $data['Workshops'][] = $this->workshopSerializer($workshop);
        }

        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $workshop = $em->getRepository(Workshop::class)->find($id);

        if (!$workshop)
        {
            throw $this->createNotFoundException(sprintf(
                'No workshop found with nickname "%s"',
                $id));
        }


        //$data = json_decode($request->getContent(), true);

        /** @var Workshop $workshop */
       /* $workshop->setName($data['name'])
        ->addActivity($data['activity'])
        ->setCapacity($data['capacity'])
        ->setIsAvailable($data['isAvailable']);
        */

        $form = $this->createForm(WorkshopType::class, $workshop);
        $this->processForm($request, $form);

        $em = $this->getDoctrine()->getManager();
        $em->persist($workshop);
        $em->flush();


        $data = $this->workshopSerializer($workshop);

        $response = new JsonResponse($data, 200);

        return $response;
    }

    private function processForm(Request $request, FormInterface $form)
    {
        $data = json_decode($request->getContent(), true);

        $clearMissing = $request->getMethod() != 'PATCH';
        $form->submit($data, $clearMissing);
    }


    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $workshop = $em->getRepository(Workshop::class)->find($id);

        if ($workshop)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($workshop);
            $em->flush();
        }
        return new Response(null, 204);
    }
}