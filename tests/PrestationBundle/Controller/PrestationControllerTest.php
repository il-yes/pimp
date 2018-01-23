<?php

namespace PrestationBundle\Tests\Controller;

use PrestationBundle\Entity\Prestation;
use PrestationBundle\Exception\Prestation\BadActivityArgument;
use PrestationBundle\Exception\Prestation\MissingWorshopAssigned;
use PrestationBundle\Factory\ActivityFactory;
use ProductBundle\Factory\WorkshopFactory;
use Tests\Framework\WebTestCase;
use PrestationBundle\Checker\WorkshopPresenceChecker;

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

        /** @var WorkshopPresenceChecker */
        $checker = new WorkshopPresenceChecker();
        $checker->isActivityValid($prestation);


        $this->saveEntity($prestation);


        $this->visit('/prestations/prestations/new')
            ->assertResponseOk()
            ->assertEquals('system music', $prestation->getActivity()->getName());

            $this->assertTrue($workshop->getIsAvailable());
    }

    public function canNotSetAnNonInstanceActivityOfActivity()
    {
        // bad category argument type
        $workshop = $this->createAndSaveWorkshop('Cool audio room', 'my activity girl !!! ',' classic', true);
        $workshop = $this->retrieveSavedWorkshopsByName([$workshop->getName()]);
        $prestation = new Prestation();

        $this->expectException(BadActivityArgument::class);
        $prestation->setActivity($activity);

        // Invalid activity missing workshop
        $activity = $this->createAndSaveActivity('system music', 'customizing', 100);
        $activity = $this->retrieveSavedActivitiesByName([$activity->getName()]);
        $prestation = new Prestation();

        $this->expectException(MissingWorshopAssigned::class);
        $activity->setWorkshop($workshop);



    }

    // ---------------- ActivityManager -------------------------
    private function createActivity($name, $category, $price)
    {
        $activityFactory = new ActivityFactory();
        return $activityFactory->createFromSpecification($name, $category, $price);
    }

    private function createAndSaveActivity($name, $category, $price)
    {
        $activityFactory = new ActivityFactory();
        $activity = $activityFactory->createFromSpecification($name, $category, $price);
        $this->saveEntity($activity);

        return $activity;
    }

    // ---------------- WorkshopManager -------------------------
    private function createWorkshop($name, $activity, $storage, $isAvailable = false)
    {
        $workshopFactory = new WorkshopFactory();
        $workshop = $workshopFactory->createFromSpecification($name, $activity, $storage, $isAvailable );
    }

    private function createAndSaveWorkshop($name, $activity, $storage, $isAvailable = false)
    {
        $workshopFactory = new WorkshopFactory();
        $workshop = $workshopFactory->createFromSpecification($name, $activity, $storage, $isAvailable);
        $this->saveEntity($workshop);

        return $workshop;
    }
}
