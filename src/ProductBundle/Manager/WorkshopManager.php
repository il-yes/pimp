<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 23/01/18
 * Time: 14:18
 */

namespace ProductBundle\Manager;


use CoreBundle\Manager\ManagerApplication;
use PrestationBundle\Entity\Activity;
use ProductBundle\Entity\Workshop;
use ProductBundle\Factory\WorkshopFactory;
use Psr\Container\ContainerInterface;

class WorkshopManager extends ManagerApplication
{
    /**
     * @var WorkshopFactory
     */
    private $factory;

    public function __construct(ContainerInterface $container, WorkshopFactory $factory)
    {
        $this->container = $container;
        $this->em = $container->get('doctrine.orm.default_entity_manager');
        $this->factory = $factory;
    }

    public function createWorkshop($name, $activity = null, $storage, $isAvailable = false)
    {
        return $this->factory->createFromSpecification($name, $activity, $storage, $isAvailable);
    }


    public function createVenusOregonMarsWorkshops()
    {
        $inUse = false;

        $worshop1 = $this->factory->createFromSpecification('venus', null, Workshop::LARGE, $inUse);
        $worshop2 = $this->factory->createFromSpecification('oregon', null, Workshop::CLASSIC, true);
        $worshop3 = $this->factory->createFromSpecification('mars', null, Workshop::SMALL, $inUse);

        return [$worshop1, $worshop2, $worshop3];
    }


}