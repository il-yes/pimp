<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 21/01/18
 * Time: 15:46
 */

namespace ProductBundle\Tests\Factory;


use PrestationBundle\Exception\Activity\BadActivityArgument;
use PrestationBundle\Exception\Activity\WhatIsMyMotherFunckinName;
use PrestationBundle\Factory\ActivityFactory;
use PrestationBundle\Manager\ActivityManager;
use ProductBundle\Factory\WorkshopFactory;
use Tests\Framework\WebTestCase;


class WorkshopFactoryTest extends WebTestCase
{
    const SMALL = 'small';

    const CLASSIC = 'classic';

    const LARGE = 'large';

    private $workshopFactory;

    private $activityFactory;

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


    public function setUp()
    {
        parent::setUp();
        $this->workshopFactory = new WorkshopFactory();
        $this->activityFactory = new ActivityFactory();
    }


    /**
     * - Création d'ateliers
     * @test
     */
    public function createWorkshop()
    {
        $activity = $this->activityFactory->createEsthetic('Painting', 35);
        $workshop = $this->workshopFactory->createSmallWorkshop('venus', $activity, true);

        /** var Activity */
        $activity->setWorkshop($workshop);

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
        $requestedActivities = $this->createActivities($this->activitiesRequest);

        $factory = new WorkshopFactory();
        $workshop = $factory->createFromSpecification($name, $activity, $capacity, $isAvailable);

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
        $this->expectException(BadActivityArgument::class);
        $workshop = $factory->createSmallWorkshop('test name', 'Painting', true);

        $this->expectException(WhatIsMyMotherFunckinName::class);
        $workshop = $factory->createSmallWorkshop(45, 'Painting', true);

    }




}