<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 21/01/18
 * Time: 15:46
 */

namespace ProductBundle\Tests\Factory;

use PHPUnit\Framework\TestCase;
use PrestationBundle\Entity\Activity;
use PrestationBundle\Factory\ActivityFactory;
use ProductBundle\Exception\WhatIsMyMotherFunckinName;
use ProductBundle\Factory\WorkshopFactory;
use Tests\Framework\WebTestCase;


class WorkshopFactoryTest extends WebTestCase
{
    const SMALL = 'small';

    const CLASSIC = 'classic';

    const LARGE = 'large';

    private $activitiesRequest = [
        // $key, $_name, $_category, $_price
        'activityPainting' => [
            'name' => 'Car Painting',
            'category' => ActivityFactory::ESTHETIC,
            'price' => 45,
        ],
        'activityRepair' => [
            'name' => 'Denting',
            'category' => ActivityFactory::MAINTENANCE,
            'price' => 75,
        ],
        'activityCustom' => [
            'name' => 'Car Interior',
            'category' => ActivityFactory::CUSTOMIZING,
            'price' => 15,
        ]
    ];

    /**
     * - Création d'ateliers
     * @test
     */
    public function createWorkshop()
    {
        $workshopFactory = new WorkshopFactory();
        $activityFactory = new ActivityFactory();

        $activity = $activityFactory->createEsthetic('Painting', 35);
        $this->saveEntity($activity);

        $activity = $this->findActivity($activity)[0];
        $workshop = $workshopFactory->createSmallWorkshop('venus', $activity, true);
        $activity->addWorkshop($workshop);

        $this->assertEquals('venus', $workshop->getName());
        $this->assertEquals('small', $workshop->getCapacity());
    }


    /**
     * @dataProvider workshopBuilder
     * @test
     *
     * test de creation d'ateliers a partir d'une boucle
     *
     * @param $name
     * @param $activity
     * @param $capacity
     * @param $isAvailable
     */
    public function createWorkshopsFromSpecifications($name, $activity, $capacity, $isAvailable)
    {
        $requestedActivities = $this->createActivities();
        //$this->dataMigration($requestedActivities);
        $activities = $this->retrieveSavedActivities([
            $this->activitiesRequest['activityPainting']['name'],
            $this->activitiesRequest['activityRepair']['name'],
            $this->activitiesRequest['activityCustom']['name']
        ]);

        $factory = new WorkshopFactory();
        $workshop = $factory->createFromSpecification($name, $activity, $capacity, $isAvailable);
var_dump($workshop);
        switch ($capacity)
        {
            case 'small' :
                $this->assertEquals(self::SMALL, $workshop->getCapacity());
                break;

            case 'classic' :
                $this->assertEquals(self::CLASSIC, $workshop->getCapacity());
                break;

            case 'large' :
                $this->assertEquals(self::LARGE, $workshop->getCapacity());
                break;
        }

        if ($isAvailable)
        {
            $this->assertEquals(true, $workshop->getIsAvailable());
        }else{
            $this->assertEquals(false, $workshop->getIsAvailable());
        }


    }

    /**
     * - fixtures for thr test
     * @return array
     */
    public function workshopBuilder()
    {
        $inUse = false;
        return [
            // $name, $activity, $capacity, $isAvailable = false
            ['venus', null, self::SMALL, $inUse],
            ['oregon', null, self::LARGE, true],
            ['mars', null, self::CLASSIC, $inUse],
            ['neptune', null, self::LARGE, true],
            ['', null, self::LARGE, true],
        ];
    }

    /**
     * @test
     */
    public function canNotCreateAWorkshopWithoutAName()
    {
        $factory = new WorkshopFactory();
        $this->expectException(WhatIsMyMotherFunckinName::class);
        $workshop = $factory->createSmallWorkshop('', 'Painting', true);

        $this->expectException(WhatIsMyMotherFunckinName::class);
        $workshop = $factory->createSmallWorkshop(45, 'Painting', true);

    }

    private function createActivities()
    {
        $activityFactory = new ActivityFactory();
        $activities = [];

        foreach ($this->activitiesRequest as $metadata)
        {
            array_push($activities, $activityFactory->createFromSpecification($metadata['name'], $metadata['category'], $metadata['price']));
        }
        return $activities;
    }

    private function dataMigration($entities)
    {
        foreach ($entities as $entity)
        {
            $this->saveEntity($entity);
        }
    }

    private function retrieveSavedActivities($nameActivities = [])
    {
        $activities = [];
        foreach ($nameActivities as $name)
        {
            array_push($activities, $this->em->getRepository(Activity::class)->findOneBy(['name' => $name]));
        }
        return $activities;
    }

    private function findActivity($activity)
    {
        return $this->em->getRepository(Activity::class)->findBy(['name' =>$activity->getName()]);
    }

}