<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 26/01/18
 * Time: 18:37
 */

namespace CoreBundle\Specifics;


use PrestationBundle\Factory\ActivityFactory;
use PrestationBundle\Factory\PrestationFactory;
use ProductBundle\Factory\WorkshopFactory;

class Resources
{
    private  $activityFactory;

    private $workshopFactory;

    /** @var PrestationFactory $prestationFactory */
    private $prestationFactory;


    /**
     * Resources constructor.
     * @param $activityFactory
     * @param $workshopFactory
     */
    public function __construct(ActivityFactory $activityFactory, WorkshopFactory $workshopFactory, PrestationFactory $prestationFactory)
    {
        $this->activityFactory = $activityFactory;
        $this->workshopFactory = $workshopFactory;
        $this->prestationFactory = $prestationFactory;
    }


    /**
     * @param array $data
     * @return \PrestationBundle\Entity\Activity
     */
    public function createActivity($data = [])
    {
        return $this->activityFactory->createFromSpecification(
            $data[0],   // name
            $data[1],   // category
            $data[2]    // price
        );
    }

    /**
     * @param array $data
     * @return \ProductBundle\Entity\Workshop
     */
    public function createWorkshop($data = [])
    {
        return $this->workshopFactory->createFromSpecification(
            $data[0],   // name
            $data[1],   // activity
            $data[2],   // capacity
            $data[3]    // isAvailable
        );
    }

    public function createAnActivityAndAWorkshop($activity = [], $workshop = [], $isAssigned = false)
    {
        $activity = $this->createActivity($activity);

        $workshop = $this->createWorkshop($workshop);

        $this->assignAWorkshopToAnActivity($activity, $workshop, $isAssigned);

        return $activity;
    }

    public function assignAWorkshopToAnActivity($activity, $workshop, $isAssigned)
    {
        if ($isAssigned)
        {
            return $activity->setWorkshop($workshop);
        }
        return ;
    }

    public function createPrestationWithActivity($activity = [], $workshop = [])
    {
        $activity = $this->createAnActivityAndAWorkshop($activity, $workshop, true);
        return $this->prestationFactory->createPrestation($activity);
    }
}