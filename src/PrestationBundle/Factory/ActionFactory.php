<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 20/01/18
 * Time: 17:38
 */

namespace PrestationBundle\Factory;


use PrestationBundle\Entity\Action;

class ActionFactory
{
    const ESTHETIC = 'esthetic';
    const MAINTENANCE = 'maintenance';
    const CUSTOMIZING = 'customizing';


    public function createEsthetic($name, $price)
    {
        return new Action($name, self::ESTHETIC, $price);
    }

    public function createMaintenance($name, $price)
    {
        return new Action($name, self::MAINTENANCE, $price);
    }

    public function createCustomizing($name, $price)
    {
        return new Action($name, self::CUSTOMIZING, $price);
    }
}