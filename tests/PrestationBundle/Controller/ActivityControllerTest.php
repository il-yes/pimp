<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 20/01/18
 * Time: 13:27
 */

namespace PrestationBundle\Tests\Controller;

use PrestationBundle\Factory\ActivityFactory;
use PrestationBundle\Entity\activity;
use PrestationBundle\Manager\ActivityManager;
use Tests\Framework\WebTestCase;

class ActivityControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function createActivity()
    {
        $factory = new ActivityFactory();
        $activity = $factory->createEsthetic('car wash', 15);

        $this->visit('/prestations/activity/new')
            ->assertResponseOk()
            ->seeText('Creation')
            ->seeText('Hello this is here to create a new acivity');
    }

}