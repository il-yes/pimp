<?php

namespace PrestationBundle\Tests\Controller;

use PrestationBundle\Entity\Prestation;
use PrestationBundle\Factory\ActivityFactory;
use ProductBundle\Factory\WorkshopFactory;
use Tests\Framework\WebTestCase;

class PrestationControllerTest extends WebTestCase
{
    public function createPrestation()
    {
        $activity = $this->createActivity('system music', 'customizing', 100);
        $this->saveEntity($activity);
        $workshop = $this->createWorkshop('Cool audio room', $activity, 'classic', true);
        $this->saveEntity($workshop);


        $prestation = new Prestation();
        $prestation
            ->setActivity($activity)
            ->setWorkshop($workshop);

    }

    private function createActivity($name, $category, $price)
    {
        $activityFactory = new ActivityFactory();
        return $activityFactory->createFromSpecification($name, $category, $price);
    }

    private function createWorkshop($name, $activity, $storage, $isAvailable = false)
    {
        $workshopFactory = new WorkshopFactory();
        $workshop = $workshopFactory->createFromSpecification($name, $activity, $storage, $isAvailable );
    }
}
