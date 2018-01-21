<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 21/01/18
 * Time: 16:08
 */

namespace ProductBundle\Factory;


use ProductBundle\Entity\Workshop;

class WorkshopFactory
{
    private function createWorkshop($name, $activity, $capacity, $isAvailable = false)
    {
        return new Workshop($name, $activity, $capacity, $isAvailable, $isAvailable = false);
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


    public function createFromSpecification($name, $activity, $storage, $isAvailable = false)
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
}