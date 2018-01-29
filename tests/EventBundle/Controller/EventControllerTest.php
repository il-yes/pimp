<?php

namespace EventBundle\Tests\Controller;

use CoreBundle\Specifics\Resources;
use EventBundle\Entity\Event;
use EventBundle\Factory\EventFactory;
use PrestationBundle\Entity\Activity;
use ProductBundle\Entity\Workshop;
use ProductBundle\Factory\VehiculeFactory;
use ProductBundle\Model\Vehicule;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;
use UserBundle\Entity\User;
use UserBundle\Factory\UserFactory;

class EventControllerTest extends KernelTestCase
{
    /*
         - createEvent
            - createClient
            - createVehicule
            - createPrestation
               - selectActivity
               - selectWorkshop
         - createCalendar
            - createDate / selectDate
            - selectPrestation
        */

    /** @var  EventFactory $factory */
    private $factory;

    /** @var  Resources $resourcesfactory */
    private $resourcesfactory;

    /** @var  UserFactory $userFactory */
    private $userFactory;

    /** @var  VehiculeFactory $vehiculeFactory */
    private $vehiculeFactory;

    /** @var  Container $container */
    private $container;

    /** @var Client $client  */
    private $client;

    private $crawler;


    public function setUp()
    {
        self::bootKernel();

        $this->container = self::$kernel->getContainer();
        $this->client = $this->container->get('test.client');

        $this->factory = new EventFactory();
        $this->vehiculeFactory = new VehiculeFactory();
        $this->userFactory = new UserFactory();
        $this->resourcesfactory = self::$kernel->getContainer()->get('test.'. Resources::class);
    }

    private function getEntityManager()
    {
        return $this->container->get('doctrine.orm.default_entity_manager');
    }

    private function eventBuilder()
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
        $prestation = $this->resourcesfactory->createPrestationWithActivity($activity, $workshop);
        $user = $this->userFactory->createUser(User::TYPE_CLIENT);
        $vehicule = $this->vehiculeFactory->createVehicule(Vehicule::MOTO);

        return $this->factory->createEvent($user, $vehicule, $prestation);
    }
    /**
     * @test
     */
    public function createEvent()
    {
        $event = $this->eventBuilder();
        $this->assertEquals(Vehicule::MOTO, $event->getVehicule()->getType());
        $this->assertEquals('repair', $event->getPrestation()->getActivity()->getName());
        //$this->assertContains('new Event');

        //var_dump($event);
    }

    /**
     * @test
     */
    public function eventsList()
    {
        $event = $this->eventBuilder();
        $this->getEntityManager()->persist($event);
        $this->getEntityManager()->flush();

        $eventReview = $this->getEntityManager()->getRepository(Event::class)->findAll();
        $this->crawler = $this->client->request('GET', '/events');

        self::assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('List event');


    }

}
