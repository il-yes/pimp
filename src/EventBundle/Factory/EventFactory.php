<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 27/01/18
 * Time: 13:33
 */

namespace EventBundle\Factory;


use EventBundle\Entity\Event;
use EventBundle\Exception\Event\BadClientArgument;
use EventBundle\Exception\Event\BadPrestationArgument;
use EventBundle\Exception\Event\BadVehiculeArgument;
use PrestationBundle\Entity\Prestation;
use ProductBundle\Model\Vehicule;
use UserBundle\Entity\Client;

class EventFactory
{
    public function createEvent($client, $vehicule, $prestation)
    {
        $this->checkArguments($client, $vehicule, $prestation);

        return new Event($client, $vehicule, $prestation);
    }

    private function isClientValid($client)
    {
        if ($client instanceof Client)
        {
            return true;
        }
        return false;
    }

    private function isVehiculeValid($vehicule)
    {
        if ($vehicule instanceof Vehicule)
        {
            return true;
        }
        return false;
    }

    private function isPrestationValid($prestation)
    {
        if ($prestation instanceof Prestation)
        {
            return true;
        }
        return false;
    }

    private function checkArguments($client, $vehicule, $prestation)
    {
        if (!$this->isClientValid($client))
        {
            throw new BadClientArgument();
        }
        if (!$this->isVehiculeValid($vehicule))
        {
            throw new BadVehiculeArgument();
        }
        if (!$this->isPrestationValid($prestation))
        {
            throw new BadPrestationArgument();
        }
    }
}