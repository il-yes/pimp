<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 24/01/18
 * Time: 14:32
 */

namespace ProductBundle\Tests\Controller\Web;

use ProductBundle\Entity\Auto;
use ProductBundle\Factory\VehiculeFactory;
use ProductBundle\Model\Vehicule;
use Tests\Framework\WebTestCase;


class VehiculeControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function createAVehicule()
    {
        $motoFactory = new VehiculeFactory();
        $bike = $motoFactory->createVehicule(Vehicule::MOTO);
        $bike->setState('need to take care of it');

        $this->visit('/vehicules-auto/new')
            ->assertResponseOk()
            ->seeText('vehicule creation')
            ->seeText(Vehicule::MOTO);

    }
}