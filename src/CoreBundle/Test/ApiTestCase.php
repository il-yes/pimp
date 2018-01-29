<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 29/01/18
 * Time: 14:34
 */

namespace CoreBundle\Test;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ApiTestCase extends KernelTestCase
{
    private static $staticClient;

    /** @var  Client */
    protected $client;

    public static function setUpBeforeClass()
    {
        self::$staticClient = new Client([
            'base_uri' => 'http://localhost:8000',
            'timeout' => 2000,
            'http_errors' => false
        ]);

        self::bootKernel();
    }


    public function setUp()
    {
        $this->client = self::$staticClient;
        $this->purgeDatabase();
    }

    /**
     * Clean up Kernel usage in this test.
     */
    protected function tearDown()
    {
        // purposefully not calling parent class, which shuts down the kernel
    }
    private function purgeDatabase()
    {
        $purger = new ORMPurger($this->getService('doctrine.orm.default_entity_manager'));
        $purger->purge();
    }
    protected function getService($id)
    {
        return self::$kernel->getContainer()
            ->get($id);
    }
}