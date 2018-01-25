<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 21/01/18
 * Time: 19:07
 */

namespace ProductBundle\Exception\Workshop;


class BadCapacityArgument extends \Exception
{
    protected $message = "La valeur de la capacité doit être de type 'string'";
}