<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 20/01/18
 * Time: 17:30
 */

namespace Tests\PrestationBundle\Factory;

use PHPUnit\Framework\TestCase;
use PrestationBundle\Entity\activity;
use PrestationBundle\Factory\ActivityFactory;


class ActivityFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function createEsthetic()
    {
        $factory = new ActivityFactory();
        $activity = $factory->createEsthetic('Car Polish', 15);

        $this->assertEquals('Car Polish', $activity->getName());
        $this->assertEquals(15, $activity->getPrice());
        $this->assertEquals('esthetic', $activity->getCategory());
    }


    /**
     * @test
     */
    public function createMaintenance()
    {
        $factory = new ActivityFactory();
        $activity = $factory->createMaintenance('car repair', 45);

        $this->assertEquals('car repair', $activity->getName());
        $this->assertEquals(45, $activity->getPrice());
        $this->assertEquals('maintenance', $activity->getCategory());
    }


    /**
     * @test
     */
    public function createCustomizing()
    {
        $factory = new ActivityFactory();
        $activity = $factory->createCustomizing('pimp my car baby !!!', 245);

        $this->assertEquals('pimp my car baby !!!', $activity->getName());
        $this->assertEquals(245, $activity->getPrice());
        $this->assertEquals('customizing', $activity->getCategory());
    }

}