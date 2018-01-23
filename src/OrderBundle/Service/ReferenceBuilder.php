<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 23/01/18
 * Time: 09:54
 */

namespace OrderBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityManager;

class ReferenceBuilder
{
    private $container;

    public function __construct(ContainerInterface $container, EntityManager $entityManager)
    {
        $this->container = $container;
        $this->em = $entityManager;
    }

    public function reference()
    {
        $reference = $this->em->getRepository('OrderBundle:Command')->findOneBy(array('valider' => 1), array('id' => 'DESC'),1,1);

        if (!$reference)
            return 1;
        else
            return $reference->getReference() +1;
    }

    private function getSecurityContext()
    {
        return $this->container->get('security.context_listener');

    }


}