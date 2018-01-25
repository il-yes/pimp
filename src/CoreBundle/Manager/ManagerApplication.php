<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 23/01/18
 * Time: 14:35
 */

namespace CoreBundle\Manager;


use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ManagerApplication
{
    protected $container;

    protected $em;

    public function dataMigration(array $entities)
    {
        foreach ($entities as $entity)
        {
            $this->saveEntity($entity);
        }
    }

    public function saveEntity($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

}