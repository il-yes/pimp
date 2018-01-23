<?php

namespace PrestationBundle\Tests\Controller;

use PrestationBundle\Entity\Prestation;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PrestationControllerTest extends WebTestCase
{
    public function createPrestation()
    {
        $prestation = new Prestation();
    }
}
