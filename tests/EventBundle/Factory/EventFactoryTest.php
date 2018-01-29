<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 26/01/18
 * Time: 15:19
 */

namespace tests\EventBundle\Factory;

use CoreBundle\Specifics\Resources;
use EventBundle\Entity\Event;
use EventBundle\Factory\EventFactory;
use PrestationBundle\Entity\Activity;
use ProductBundle\Entity\Workshop;
use ProductBundle\Factory\VehiculeFactory;
use ProductBundle\Model\Vehicule;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use UserBundle\Entity\User;
use UserBundle\Factory\UserFactory;


class EventFactoryTest extends KernelTestCase
{
    /** @var  EventFactory $factory */
    private $factory;

    /** @var UserFactory $clientFactory */
    private $clientFactory;

    /** @var  VehiculeFactory $vehiculeFactory */
    private $vehiculeFactory;

    /** @var  Resources $resourcesFactory */
    private $resourcesFactory;

    public function setUp()
    {
        self::bootKernel();

        $this->factory = new EventFactory();
        $this->clientFactory = new UserFactory();
        $this->vehiculeFactory = new VehiculeFactory();
        $this->resourcesFactory = self::$kernel->getContainer()->get('test.'. Resources::class);
    }

    /**
     * @test
     */
    public function createEvent()
    {
        $client = $this->getClient();
        $vehicule = $this->getVehicule(Vehicule::MOTO);
        $prestation = $this->getPrestation();

        $event = $this->factory->createEvent($client, $vehicule, $prestation);

        //var_dump($event);
    }

    public function canNotCreateAEventWithInvalidsArguments()
    {

    }

    public function createEventFromSpecification()
    {
        return [
            // $client, $vehicule, $prestation
            [],
            [],
            [],
        ];
    }

    private function getClient()
    {
        return $this->clientFactory->createUser(User::TYPE_CLIENT);
    }

    private function getVehicule($type)
    {
        return $this->vehiculeFactory->createVehicule($type);
    }

    private function getPrestation()
    {
        $activity = [
            'repair',                               // name
            Activity::CATEGORY_MAINTENANCE,         // category
            15
        ];
        $workshop = [
            'shark maintenance',                         // name
            null,                                       // activity
            Workshop::CLASSIC,                          // capacity
            true                                        // isAvailable
        ];
        return $this->resourcesFactory->createPrestationWithActivity($activity, $workshop);
    }
}