<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 20/01/18
 * Time: 17:30
 */

namespace Tests\PrestationBundle\Factory;

use PHPUnit\Framework\TestCase;
use PrestationBundle\Entity\Action;
use PrestationBundle\Factory\ActionFactory;


class ActionFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function createEsthetic()
    {
        $factory = new ActionFactory();
        $action = $factory->createEsthetic('Car Polish', 15);

        $this->assertEquals('Car Polish', $action->getName());
        $this->assertEquals(15, $action->getPrice());
        $this->assertEquals('esthetic', $action->getCategory());
    }


    /**
     * @test
     */
    public function createMaintenance()
    {
        $factory = new ActionFactory();
        $action = $factory->createMaintenance('car repair', 45);

        $this->assertEquals('car repair', $action->getName());
        $this->assertEquals(45, $action->getPrice());
        $this->assertEquals('maintenance', $action->getCategory());
    }


    /**
     * @test
     */
    public function createCustomizing()
    {
        $factory = new ActionFactory();
        $action = $factory->createCustomizing('pimp my car baby !!!', 245);

        $this->assertEquals('pimp my car baby !!!', $action->getName());
        $this->assertEquals(245, $action->getPrice());
        $this->assertEquals('customizing', $action->getCategory());
    }

}