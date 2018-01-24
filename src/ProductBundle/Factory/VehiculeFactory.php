<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 24/01/18
 * Time: 15:12
 */

namespace ProductBundle\Factory;


use ProductBundle\Entity\Auto;
use ProductBundle\Entity\Moto;
use ProductBundle\Entity\Truck;

class VehiculeFactory
{
    const AUTO = 'automobile';
    const MOTO = 'motorcycle';
    const TRUCK = 'poids_lourd';


    public function createVehicule($type)
    {
        return $this->createFromSpecification($type);
    }

    private function createAuto()
    {
        return new Auto();
    }

    private function createMoto()
    {
        return new Moto();
    }

    private function createTruck()
    {
        return new Truck();
    }

    public function createFromSpecification($type)
    {

        switch ($type)
        {
            case self::MOTO :
                return $this->createMoto();
                break;

            case self::AUTO :
                return $this->createAuto();
                break;

            case self::TRUCK :
                return $this->createTruck();
                break;
        }
    }

}