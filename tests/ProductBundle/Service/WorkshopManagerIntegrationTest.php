<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 25/01/18
 * Time: 19:55
 */

namespace ProductBundle\Service;


use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use ProductBundle\Entity\Workshop;
use ProductBundle\Manager\WorkshopManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class WorkshopManagerIntegrationTest extends KernelTestCase
{
    private $purger;

    public function setUp()
    {
        self::bootKernel();
        $this->truncateEntites();
    }

    private function truncateEntites()
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
    public function ItBuildsWorkshopWithDefaultSpecifications()
    {
        /** @var WorkshopManager $workshopManager */
        $workshopManager = self::$kernel->getContainer()
            ->get('test.'. WorkshopManager::class);

        $workshop = $workshopManager->createWorkshop('neptune', null, 'large', true);
        $workshopManager->saveEntity($workshop);

        /** @var EntityManager $em */
        $em = $this->getEntityManager();

        $count = (int) $em->getRepository(Workshop::class)
            ->createQueryBuilder('w')
            ->select('COUNT(w.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $this->assertSame(1, $count, 'Amount ('. $count .') of workshop is not the same');
    }

    /**
     * @test
     */
    public function ItBuilds3Workshops()
    {
        self::bootKernel();

        /** @var WorkshopManager $workshopManager */
        $workshopManager = self::$kernel->getContainer()
            ->get('test.'. WorkshopManager::class);

        $workshops = $workshopManager->createVenusOregonMarsWorkshops();
        $workshopManager->dataMigration($workshops);

        /** @var EntityManager $em */
        $em = $this->getEntityManager();

        $count = (int) $em->getRepository(Workshop::class)
            ->createQueryBuilder('w')
            ->select('COUNT(w.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $this->assertSame(3, $count, 'Amount ('. $count .') of workshop is not the same');
    }
}