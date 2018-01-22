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
     * @dataProvider createFromSpecification
     * @test
     * @param $name
     * @param $category
     * @param $price
     */
    public function createActivityFromSpecification($name, $category, $price)
    {
        $factory = new ActivityFactory();
        $activity = $factory->createfromSpecification($name, $category, $price);


        switch ($category)
        {
            case ActivityFactory::ESTHETIC :
                $this->assertEquals('esthetic', $activity->getCategory());
                break;

            case ActivityFactory::MAINTENANCE :
                $this->assertEquals('maintenance', $activity->getCategory());
                break;

            case ActivityFactory::CUSTOMIZING :
                $this->assertEquals('customizing', $activity->getCategory());
                break;
        }

        $this->assertTrue(is_string($name));
        $this->assertTrue(is_integer($price));
    }


    public function createFromSpecification()
    {
        return [
            // $name, $category, $price
            ['car polish', 'maintenance', 45],
            ['salon','esthetic', 235 ],
            ['Music System', 'customizing', 300],
        ];
    }

}