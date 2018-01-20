<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 20/01/18
 * Time: 13:27
 */

namespace PrestationBundle\Tests\Controller;

use PrestationBundle\Factory\ActionFactory;
use Tests\Framework\WebTestCase;
use PrestationBundle\Entity\Action;

class ActionControllerTest extends WebTestCase
{
    /**
     * - create a new esthetic action
     * @test
     */
    public function new_esthetic_action()
    {
        $factory  = new ActionFactory();
        $action = $factory->createEsthetic('car wash', 15);

            $this->visit('/prestations/new')
                ->assertResponseOk()
                ->seeText('Creation')
                ->seeText('welcome dear client -)');
    }

    /**
     * - create a new maintenance action
     * @test
     */
    public function new_maintenance_action()
    {
        $factory  = new ActionFactory();
        $action = $factory->createMaintenance('Car Repair', 27);

        $this->visit('/prestations/new')
            ->assertResponseOk()
            ->seeText('Creation')
            ->seeText('welcome dear client -)');

    }


}