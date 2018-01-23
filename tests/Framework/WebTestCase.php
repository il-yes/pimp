<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 20/01/18
 * Time: 13:27
 */

namespace Tests\Framework;


use PrestationBundle\Entity\Activity;
use PrestationBundle\Factory\ActivityFactory;
use ProductBundle\Entity\Workshop;
use Throwable;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\TestCase;
use PrestationBundle\Entity\Action;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseTestCase;

class WebTestCase extends BaseTestCase
{
    protected $client;

    protected $container;

    protected $schemaTool;

    protected $em;

    protected $crawler;

    private $response;

    private $responseContent;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->client = static::createClient();
        $this->container = $this->client->getContainer();
        $this->em = $this->container->get('doctrine.orm.default_entity_manager');
        /*
            static $metadatas;
            if(!isset($metadatas))
            {
                $metadatas = $this->em->getMetadataFactory()->getAllMetadata();
            }

            $this->schemaTool = new SchemaTool($this->em);
            $this->schemaTool->dropDatabase();

            if (empty($metadatas))
            {
                $this->schemaTool->createSchema($metadatas);
            }
        */
        // Autre facon de gerer la bdd
        $this->em->beginTransaction();
        $this->em->getConnection()->setAutoCommit(false);
    }

    protected function visit($url)
    {
        $this->crawler = $this->client->request('GET', $url);

        $this->response = $this->client->getResponse();
        $this->responseContent = $this->response->getContent();
        return $this;
    }


    protected function seeText($text)
    {
        $this->assertContains($text, $this->responseContent);
        return $this;
    }

    protected function assertResponseOk()
    {
        $this->assertEquals(200, $this->response->getStatusCode());
        return $this;
    }


    protected function onNotSuccessfulTest(Throwable $t)
    {
        if ($this->crawler && $this->crawler->filter('.exception-message')->count() > 0)
        {
            $throwableClass = get_class($t);

            $message =  $this->crawler->filter('.exception-message')->eq(0)->text();

            throw new $throwableClass($t->getMessage() .' | '. $message);
        }
        throw $t;

    }

    public function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub

        $this->em->rollBack();
    }



    // ----------------------------- ManagerApplication --------------------------
    public function dataMigration($entities)
    {
        foreach ($entities as $entity)
        {
            $this->saveEntity($entity);
        }
    }

    public function saveEntity($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    // ------------------------- ActivityManager ------------------------------
    public function createActivities($activitiesRequest)
    {
        $activityFactory = new ActivityFactory();
        $activities = [];

        foreach ($activitiesRequest as $metadata)
        {
            array_push($activities, $activityFactory->createFromSpecification($metadata['name'], $metadata['category'], $metadata['price']));
        }
        return $activities;
    }



    public function retrieveSavedActivitiesByName($nameActivities = [])
    {
        $activities = [];
        foreach ($nameActivities as $name)
        {
            array_push($activities, $this->em->getRepository(Activity::class)->findOneBy(['name' => $name]));
        }
        return $activities[0];
    }

    public function findActivityByName($activity)
    {
        return $this->em->getRepository(Activity::class)->findBy(['name' =>$activity->getName()]);
    }


    // ------------------------- WorkshopManager ------------------------------
    public function retrieveSavedWorkshopsByName($nameWorkshops = [])
    {
        $workshops = [];
        foreach ($nameWorkshops as $name)
        {
            array_push($workshops, $this->em->getRepository(Workshop::class)->findOneBy(['name' => $name]));
        }
        return $workshops[0];
    }

    // ------------------------- WorkshopManager ------------------------------
    public function retrieveSavedPrestationsByName($nameWorkshops = [])
    {
        $workshops = [];
        foreach ($nameWorkshops as $name)
        {
            array_push($workshops, $this->em->getRepository(Workshop::class)->findOneBy(['name' => $name]));
        }
        return $workshops[0];
    }

}