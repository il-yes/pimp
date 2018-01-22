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