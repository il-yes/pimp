<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 20/01/18
 * Time: 13:27
 */

namespace PrestationBundle\Tests\Controller;


use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\TestCase;
use PrestationBundle\Entity\Action;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseTestCase;

class WebTestCase extends BaseTestCase
{
    protected $client;

    protected $container;

    protected $schemaTool;

    private $em;

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



    /**
     * - create a new action
     * @test
     */
    public function new_action()
    {
        $action = new Action('car wash', 15);
        $this->em->persist($action);
        $this->em->flush();

        $crawler = $this->client->request('GET', '/prestations/new');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Creation', $this->client->getResponse()->getContent());
        $this->assertEquals('car wash', $action->getName());


    }

    public function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub

        $this->em->rollBack();
    }
}