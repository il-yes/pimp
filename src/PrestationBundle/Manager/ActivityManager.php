<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 23/01/18
 * Time: 14:20
 */

namespace PrestationBundle\Manager;


use CoreBundle\Manager\ManagerApplication;
use PrestationBundle\Entity\Activity;
use PrestationBundle\Factory\ActivityFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ActivityManager extends ManagerApplication
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createActivities()
    {
        $activityFactory = new ActivityFactory();
        $activities = [];

        foreach ($this->activitiesRequest as $metadata)
        {
            array_push($activities, $activityFactory->createFromSpecification($metadata['name'], $metadata['category'], $metadata['price']));
        }
        return $activities;
    }



    public function retrieveSavedActivitiesByName($nameActivities = [])
    {
        $activities = [];
        foreach ($nameActivities as $name)
        {
            array_push($activities, $this->em->getRepository(Activity::class)->findOneBy(['name' => $name]));
        }
        return $activities[0];
    }

    public function findActivityByName($activity)
    {
        return $this->em->getRepository(Activity::class)->findBy(['name' =>$activity->getName()]);
    }
}