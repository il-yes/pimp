<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 21/01/18
 * Time: 15:46
 */

namespace ProductBundle\Tests\Factory;

use PHPUnit\Framework\TestCase;
use ProductBundle\Factory\WorkshopFactory;


class WorkshopFactoryTest extends TestCase
{
    const SMALL = 'small';

    const CLASSIC = 'classic';

    const LARGE = 'large';

    /**
     * - Création d'ateliers
     * @test
     */
    public function createWorkshop()
    {
        $factory = new WorkshopFactory();
        $workshop = $factory->createSmallWorkshop('venus', 'Painting', true);

        $this->assertEquals('venus', $workshop->getName());
        $this->assertEquals('small', $workshop->getCapacity());
        $this->assertEquals('Painting', $workshop->getActivity());
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
            $this->assertEquals(true, $workshop->isAvailable());
        }else{
            $this->assertEquals(false, $workshop->isAvailable());
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
            ['venus', 'Painting', self::SMALL, $inUse],
            ['oregon', 'car repair', self::LARGE, true],
            ['mars', 'washing', self::CLASSIC, $inUse],
            ['neptune', 'polish', self::LARGE, true],
        ];
    }



}