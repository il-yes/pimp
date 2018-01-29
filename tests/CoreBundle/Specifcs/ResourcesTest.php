<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 26/01/18
 * Time: 18:37
 */

namespace Tests\CoreBundle\Specifics;


use CoreBundle\Specifics\Resources;
use PrestationBundle\Entity\Activity;
use PrestationBundle\Factory\ActivityFactory;
use PrestationBundle\Factory\PrestationFactory;
use ProductBundle\Entity\Workshop;
use ProductBundle\Factory\WorkshopFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Framework\WebTestCase;

class ResourcesTest extends KernelTestCase
{
    /** @var  Resources $resourcesProvider */
    private $resourcesProvider;

    public function setUp()
    {
        self::bootKernel();
    }


    /**
     * @test
     */
    public function createActivity()
    {
        $this->resourcesProvider = self::$kernel->getContainer()->get('test.'. Resources::class);
        $data = [
        'repair',                               // name
            Activity::CATEGORY_MAINTENANCE,     // category
            15                                  // price
        ];

        $activity = $this->resourcesProvider->createActivity($data);

        $this->assertEquals('repair', $activity->getName());
        $this->assertEquals(Activity::CATEGORY_MAINTENANCE, $activity->getCategory());
        $this->assertEquals(15, $activity->getPrice());

        return$activity;
    }

    /**
     * @test
     */
    public function createWorkshop()
    {
        $this->resourcesProvider = self::$kernel->getContainer()->get('test.'. Resources::class);

        $data = [
            'shark maintenace',   // name
            null,   // activity
            Workshop::CLASSIC,   // capacity
            true    // isAvailable
        ];

        $workshop = $this->resourcesProvider->createWorkshop($data);

        $this->assertEquals('shark maintenace', $workshop->getName());
        $this->assertEquals(null, $workshop->getActivities());
        $this->assertEquals(Workshop::CLASSIC, $workshop->getCapacity());
        $this->assertEquals(true, $workshop->getIsAvailable());

        return $workshop;
    }

    /**
     * @test
     */
    public function createAnActivityAndAWorkshop()
    {
        $this->resourcesProvider = self::$kernel->getContainer()->get('test.'. Resources::class);

        $activity = $this->createActivity();
        $workshop = $this->createWorkshop();

        $this->resourcesProvider->assignAWorkshopToAnActivity($activity, $workshop, true);

        //var_dump($activity);
    }

    /**
     * @test
     */
    public function createPrestationWithActivity()
    {
        $this->resourcesProvider = self::$kernel->getContainer()->get('test.'. Resources::class);

        $activity = [
            'repair',                               // name
            Activity::CATEGORY_MAINTENANCE,         // category
            15
        ];
        $workshop = [
            'shark maintenance',                         // name
            null,                                       // activity
            Workshop::CLASSIC,                          // capacity
            true                                        // isAvailable
        ];
        $prestation = $this->resourcesProvider->createPrestationWithActivity($activity, $workshop);

        self::assertEquals('repair', $prestation->getActivity()->getName());
        self::assertEquals(15, $prestation->getActivity()->getPrice());
    }
}