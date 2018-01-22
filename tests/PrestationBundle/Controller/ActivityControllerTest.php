<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 20/01/18
 * Time: 13:27
 */

namespace PrestationBundle\Tests\Controller;

use PrestationBundle\Factory\ActivityFactory;
use Tests\Framework\WebTestCase;
use PrestationBundle\Entity\activity;

class ActivityControllerTest extends WebTestCase
{
    /**
     * - create a new esthetic activity
     * @test
     */
    public function new_esthetic_activity()
    {
        $factory  = new ActivityFactory();
        $activity = $factory->createEsthetic('car wash', 15);

            $this->visit('/prestations/new')
                ->assertResponseOk()
                ->seeText('Creation')
                ->seeText('welcome dear client -)');
    }

    /**
     * - create a new maintenance activity
     * @test
     */
    public function new_maintenance_activity()
    {
        $factory  = new ActivityFactory();
        $activity = $factory->createMaintenance('Car Repair', 27);

        $this->visit('/prestations/new')
            ->assertResponseOk()
            ->seeText('Creation')
            ->seeText('welcome dear client -)');

    }


}