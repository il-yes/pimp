<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 21/01/18
 * Time: 19:07
 */

namespace PrestationBundle\Exception\Activity;


class BadActivityArgument extends \Exception
{
    protected $message = "La valeur de l'activité doit être une instance de Activity entity";
}