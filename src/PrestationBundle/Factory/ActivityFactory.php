<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 20/01/18
 * Time: 17:38
 */

namespace PrestationBundle\Factory;


use CoreBundle\Factory\FactoryBuilderInterface;
use PrestationBundle\Entity\Activity;

class ActivityFactory implements FactoryBuilderInterface
{
    const ESTHETIC = 'esthetic';
    const MAINTENANCE = 'maintenance';
    const CUSTOMIZING = 'customizing';

    public function createActivity($_name, $_category, $_price)
    {
        return new Activity($_name, $_category, $_price);
    }

    public function createEsthetic($name, $price)
    {
        return $this->createActivity($name, self::ESTHETIC, $price);
    }

    public function createMaintenance($name, $price)
    {
        return $this->createActivity($name, self::MAINTENANCE, $price);
    }

    public function createCustomizing($name, $price)
    {
        return $this->createActivity($name, self::CUSTOMIZING, $price);
    }

    public function createFromSpecification($_name, $_category, $_price)
    {
        $_category = strtolower($_category);

        switch ($_category)
        {
            case self::ESTHETIC :
                return $this->createEsthetic($_name, $_category, $_price);
                break;

            case self::MAINTENANCE :
                return $this->createMaintenance($_name, $_category, $_price);
                break;

            case self::CUSTOMIZING :
                return $this->createCustomizing($_name, $_category, $_price);
                break;
        }
    }
}