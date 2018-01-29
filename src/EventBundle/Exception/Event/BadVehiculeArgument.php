<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 27/01/18
 * Time: 13:48
 */

namespace EventBundle\Exception\Event;


class BadVehiculeArgument extends \Exception
{
    protected $message = "Le véhicule doit être de type 'Vehicule'";
}