<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 21/01/18
 * Time: 19:07
 */

namespace PrestationBundle\Exception\Prestation;


class MissingWorshopAssigned extends \Exception
{
    protected $message = "Une prestation ne peut se poursuivre avec une activité sans atelier assigné";
}