<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 21/01/18
 * Time: 16:08
 */

namespace ProductBundle\Factory;


use PrestationBundle\Entity\Activity;
use ProductBundle\Entity\Workshop;
use ProductBundle\Exception\WhatIsMyMotherFunckinName;

class WorkshopFactory
{
    private function createWorkshop($name, $activity = null, $capacity, $isAvailable = false)
    {
        if (!$this->canAddAWorshop($name, $activity, $capacity))
        {
            throw new WhatIsMyMotherFunckinName();
        }
        return new Workshop($name, $activity, $capacity, $isAvailable, $isAvailable);
    }

    /**
     * - SMALL
     * @param $name
     * @param $activity
     * @param bool $isAvailable
     * @return Workshop
     */
    public function createSmallWorkshop($name, $activity, $isAvailable = false)
    {
        return $this->createWorkshop($name, $activity, Workshop::SMALL, $isAvailable);
    }

    /**
     * - CLASSIC
     * @param $name
     * @param $activity
     * @param bool $isAvailable
     * @return Workshop
     */
    public function createClassicWorkshop($name, $activity, $isAvailable = false)
    {
        return new Workshop($name, $activity, Workshop::CLASSIC, $isAvailable);
    }

    /**
     * - LARGE
     * @param $name
     * @param $activity
     * @param bool $isAvailable
     * @return Workshop
     */
    public function createLargeWorkshop($name, $activity, $isAvailable = false)
    {
        return new Workshop($name, $activity, Workshop::LARGE, $isAvailable);
    }


    public function createFromSpecification($name, $activity = null, $storage, $isAvailable = false)
    {
        $storage = strtolower($storage);

        switch ($storage)
        {
            case 'small' :
                return $this->createSmallWorkshop($name, $activity, $isAvailable);
                break;

            case 'classic' :
                return $this->createClassicWorkshop($name, $activity, $isAvailable);
                break;

            case 'large' :
                return $this->createLargeWorkshop($name, $activity, $isAvailable);
                break;
            default :
                return $this->createClassicWorkshop($name, $activity, $isAvailable);
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function canAddAWorshop($name, $activity, $capacity)
    {
        if ($name = '' || !is_string($name) )
        {
            return false;
        }
        if ($activity != null && !$activity instanceof Activity)
        {
            return false;
        }
        if (!is_string($capacity))
        {
            return false;
        }

        return true;
    }
}