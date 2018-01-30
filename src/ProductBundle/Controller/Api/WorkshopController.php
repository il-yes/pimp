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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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


}