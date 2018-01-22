<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 21/01/18
 * Time: 20:33
 */

namespace ProductBundle\Controller\Api;

use ProductBundle\Factory\WorkshopFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class WorkshopController extends Controller
{
    /**
     * @return Response
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

        $response = new Response('It worked. Believe me - I\'m an API', 201);
        $response->headers->set('Location', '/some/programmer/url');
        return $response;
    }
}