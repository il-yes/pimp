<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 20/01/18
 * Time: 17:38
 */

namespace PrestationBundle\Factory;


use PrestationBundle\Entity\Activity;

class ActivityFactory
{
    const ESTHETIC = 'esthetic';
    const MAINTENANCE = 'maintenance';
    const CUSTOMIZING = 'customizing';


    public function createEsthetic($name, $price)
    {
        return new Activity($name, self::ESTHETIC, $price);
    }

    public function createMaintenance($name, $price)
    {
        return new Activity($name, self::MAINTENANCE, $price);
    }

    public function createCustomizing($name, $price)
    {
        return new Activity($name, self::CUSTOMIZING, $price);
    }
}