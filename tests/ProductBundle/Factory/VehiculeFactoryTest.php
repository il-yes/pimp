<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 24/01/18
 * Time: 14:57
 */

namespace ProductBundle\Tests\Factory;

use PHPUnit\Framework\TestCase;
use ProductBundle\Factory\VehiculeFactory;


class VehiculeFactoryTest extends TestCase
{
    const AUTO = 'automobile';
    const MOTO = 'motorcycle';
    const TRUCK = 'poids_lourd';

    const AUDIO_SYSTEM = 'wish a new audio system';
    const CAR_REPAIR = 'need to repair my engine';

    /**
     * @test
     */
    public function createATruckVehicule()
    {
        $vehiculeFactory = new VehiculeFactory();
        $truck = $vehiculeFactory->createVehicule(self::TRUCK);
        $truck->setState(self::AUDIO_SYSTEM);

        $this->assertEquals(self::TRUCK, $truck->getType());
        $this->assertEquals(self::AUDIO_SYSTEM, $truck->getState());
    }


    /**
     * @dataProvider createFromSpecification
     * @test
     */
    public function createVehiculesFromSpecification($type)
    {
        $vehiculeFactory = new VehiculeFactory();
        $vehicule = $vehiculeFactory->createFromSpecification($type);

        switch ($type)
        {
            case self::MOTO :
                $this->assertEquals(self::MOTO, $vehicule->getType());
                break;

            case self::AUTO :
                self::assertEquals(self::AUTO, $vehicule->getType());
                break;

            case self::TRUCK :
                self::assertEquals(self::TRUCK, $vehicule->getType());
                break;
        }
    }

    public function createFromSpecification()
    {
        return [
            // $type, $state
            [self::AUTO],
            [self::MOTO],
            [self::TRUCK]
        ];
    }
}