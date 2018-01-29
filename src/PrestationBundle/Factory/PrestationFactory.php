<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 26/01/18
 * Time: 16:12
 */

namespace PrestationBundle\Factory;


use PrestationBundle\Entity\Activity;
use PrestationBundle\Entity\Prestation;
use Tests\Framework\WebTestCase;

class PrestationFactory extends WebTestCase
{
    private $factory;

    private $activityFactory;

    public function setUp()
    {
        $this->factory = new PrestationFactory();
        $this->activityFactory = new ActivityFactory();
    }

    public function createPrestation(Activity $activity)
    {
        return new Prestation($activity);
    }

    public function createPrestationFromSpecification($activity = [])
    {
        $activity = $this->activityFactory->createFromSpecification($activity[0], $activity[1],$activity[2]);
        return $this->factory->createFromSpecification($activity);
    }
}