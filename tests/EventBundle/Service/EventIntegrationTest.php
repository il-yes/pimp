<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 29/01/18
 * Time: 10:09
 */

namespace tests\EventBundle\Service;


use CoreBundle\Specifics\Resources;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use EventBundle\Entity\Event;
use EventBundle\Factory\EventFactory;
use PrestationBundle\Entity\Activity;
use ProductBundle\Entity\Workshop;
use ProductBundle\Factory\VehiculeFactory;
use ProductBundle\Model\Vehicule;
use UserBundle\Entity\User;
use UserBundle\Factory\UserFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EventIntegrationTest extends KernelTestCase
{
    private $purger;

    /** @var  EventFactory $factory */
    private $factory;

    /** @var  Resources $resourcesfactory */
    private $resourcesfactory;

    /** @var  UserFactory $userFactory */
    private $userFactory;

    /** @var  VehiculeFactory $vehiculeFactory */
    private $vehiculeFactory;

    public function setUp()
    {
        self::bootKernel();
        $this->truncateEntities();
/*
        $this->factory = new EventFactory();
        $this->vehiculeFactory = new VehiculeFactory();
        $this->userFactory = new UserFactory();
        //$this->resourcesfactory = self::$kernel->getContainer()->get('test.'. Resources::class);
*/
    }

    private function truncateEntities()
    {
        $this->purger = new ORMPurger($this->getEntityManager());
        $this->purger->purge();
    }

    /**
     * @return EntityManager
     */
    private function getEntityManager()
    {
        return self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * @test
     */
    public function itBuildAnEvent()
    {
        $event = $this->eventBuilder();
        // Client->setEvent()
        $event->getClient()->addEvent($event);

        /** @var EntityManager $em */
        $em = $this->getEntityManager();
        $em->persist($event);
        $em->flush();


        $count = (int) $em->getRepository(Event::class)
            ->createQueryBuilder('e')
            ->select('COUNT(e.id)')
            ->getQuery()
            ->getSingleScalarResult();
        self::assertSame(1, $count, 'Amount ('. $count .') of events is not the same');

    }

    private function eventBuilder()
    {
        $this->resourcesfactory = self::$kernel->getContainer()->get('test.'. Resources::class);

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

        $em = $this->getEntityManager();

        //$em->persist($prestation->getActivity()->getWorkshop());
        $em->persist($prestation->getActivity());
        $em->persist($prestation);
        $em->persist($user);
        $em->persist($vehicule);
        $em->flush();

        return $this->factory->createEvent($user, $vehicule, $prestation);
    }

}