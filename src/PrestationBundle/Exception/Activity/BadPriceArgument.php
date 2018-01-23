<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 21/01/18
 * Time: 19:07
 */

namespace PrestationBundle\Exception\Activity;


class BadPriceArgument extends \Exception
{
    protected $message = "Le prix n'est pas valide";
}