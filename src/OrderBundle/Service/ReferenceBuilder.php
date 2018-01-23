<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 23/01/18
 * Time: 09:54
 */

namespace OrderBundle\Service;


class ReferenceBuilder
{
    public function __construct($securityContext, $entityManager)
    {
        $this->securityContext = $securityContext;
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


}