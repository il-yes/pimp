<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 29/01/18
 * Time: 14:34
 */

namespace CoreBundle\Test;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ApiTestCase extends TestCase
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

    }


    public function setUp()
    {
        $this->client = self::$staticClient;
    }
}