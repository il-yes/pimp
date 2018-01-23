<?php

namespace PrestationBundle\Tests\Controller;

use PrestationBundle\Entity\Prestation;
use PrestationBundle\Factory\ActivityFactory;
use ProductBundle\Factory\WorkshopFactory;
use Tests\Framework\WebTestCase;

class PrestationControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function createPrestation()
    {
        $activity = $this->createAndSaveActivity('system music', 'customizing', 100);
        $activity = $this->retrieveSavedActivitiesByName([$activity->getName()]);

        $workshop = $this->createAndSaveWorkshop('Cool audio room', $activity, 'classic', true);
        $workshop = $this->retrieveSavedWorkshopsByName([$workshop->getName()]);

        $activity->setWorkshop($workshop);

        $prestation = new Prestation();
        $prestation->setActivity($activity);

        $this->saveEntity($prestation);


        $this->visit('/prestations/prestations/new')
            ->assertResponseOk()
            ->assertEquals('system music', $prestation->getActivity()->getName());

            $this->assertTrue($workshop->getIsAvailable());
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

    private function createAndSaveActivity($name, $category, $price)
    {
        $activityFactory = new ActivityFactory();
        $activity = $activityFactory->createFromSpecification($name, $category, $price);
        $this->saveEntity($activity);

        return $activity;
    }

    private function createAndSaveWorkshop($name, $activity, $storage, $isAvailable = false)
    {
        $workshopFactory = new WorkshopFactory();
        $workshop = $workshopFactory->createFromSpecification($name, $activity, $storage, $isAvailable);
        $this->saveEntity($workshop);

        return $workshop;
    }
}
