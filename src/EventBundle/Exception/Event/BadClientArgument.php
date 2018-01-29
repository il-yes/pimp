<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 27/01/18
 * Time: 13:48
 */

namespace EventBundle\Exception\Event;


class BadClientArgument extends \Exception
{
    protected $message = "Le client doit être de type 'Client'";
}