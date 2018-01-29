<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 27/01/18
 * Time: 13:48
 */

namespace EventBundle\Exception\Event;


class BadPrestationArgument extends \Exception
{
    protected $message = "La prestation doit être de type 'Prestation'";
}