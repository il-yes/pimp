<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 29/01/18
 * Time: 14:34
 */

namespace CoreBundle\Test;


use Doctrine\ORM\EntityManager;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use \GuzzleHttp\Psr7\Response;
use Guzzle\Http\Message;
use Guzzle\Http\Message\AbstractMessage;
use Guzzle\Plugin\History\HistoryPlugin;
use ProductBundle\Entity\Workshop;
use ProductBundle\Factory\WorkshopFactory;
use Throwable;
use \Exception;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\DomCrawler\Crawler;

class ApiTestCase extends KernelTestCase
{
    private static $staticClient;

    private static $history;

    /** @var  \Guzzle\Http\Message\Response $crawler */
    protected $crawler;

    protected $response;

    protected $responseContent;

    /** @var  Client */
    protected $client;

    protected $stockage;

    public static function setUpBeforeClass()
    {

        self::$staticClient = new Client([
            'base_uri' => 'http://localhost:8000',
            'timeout' => 2000,
            'http_errors' => false
        ]);

        //self::$history = new HistoryPlugin();

        self::bootKernel();


    }


    public function setUp()
    {
        $this->client = self::$staticClient;

        $this->stockage = [];
        self::$history = Middleware::history($this->stockage);

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

    protected function visit($url)
    {
        $this->response = $this->client->get($url);
        //die(var_dump($response->getStatusCode()));

        return $this;
    }



    protected function assertResponseOk()
    {
        $this->assertEquals(200, $this->response->getStatusCode());
        return $this;
    }




     protected function printLastRequestUrl()
    {
        $lastRequest = self::$history->getLastRequest();

        if ($lastRequest) {
            $this->printDebug(sprintf('<comment>%s</comment>: <info>%s</info>', $lastRequest->getMethod(), $lastRequest->getUrl()));
        } else {
            $this->printDebug('No request was made.');
        }
    }


    protected function seeText($text)
    {
        $this->assertContains($text, $this->responseContent);
        return $this;
    }




    /**
     * Print a message out - useful for debugging
     *
     * @param $string
     */
    protected function printDebug($string)
    {
        echo $string."\n";
    }

    protected function debugResponse(ResponseInterface $response)
    {
        $this->printDebug(AbstractMessage::getHeaderLines($response));
        $body = (string) $response->getBody();

        $contentType = $response->getHeader('Content-Type');
        if ($contentType == 'application/json' || strpos($contentType, '+json') !== false) {
            $data = json_decode($body);
            if ($data === null) {
                // invalid JSON!
                $this->printDebug($body);
            } else {
                // valid JSON, print it pretty
                $this->printDebug(json_encode($data, JSON_PRETTY_PRINT));
            }
        } else {
            // the response is HTML - see if we should print all of it or some of it
            $isValidHtml = strpos($body, '</body>') !== false;

            if ($isValidHtml) {
                $this->printDebug('');
                $crawler = new Crawler($body);

                // very specific to Symfony's error page
                $isError = $crawler->filter('#traces-0')->count() > 0
                    || strpos($body, 'looks like something went wrong') !== false;
                if ($isError) {
                    $this->printDebug('There was an Error!!!!');
                    $this->printDebug('');
                } else {
                    $this->printDebug('HTML Summary (h1 and h2):');
                }

                // finds the h1 and h2 tags and prints them only
                foreach ($crawler->filter('h1, h2')->extract(array('_text')) as $header) {
                    // avoid these meaningless headers
                    if (strpos($header, 'Stack Trace') !== false) {
                        continue;
                    }
                    if (strpos($header, 'Logs') !== false) {
                        continue;
                    }

                    // remove line breaks so the message looks nice
                    $header = str_replace("\n", ' ', trim($header));
                    // trim any excess whitespace "foo   bar" => "foo bar"
                    $header = preg_replace('/(\s)+/', ' ', $header);

                    if ($isError) {
                        $this->printErrorBlock($header);
                    } else {
                        $this->printDebug($header);
                    }
                }

                /*
                 * When using the test environment, the profiler is not active
                 * for performance. To help debug, turn it on temporarily in
                 * the config_test.yml file:
                 *   A) Update framework.profiler.collect to true
                 *   B) Update web_profiler.toolbar to true
                 */
                $profilerUrl = $response->getHeader('X-Debug-Token-Link');
                if ($profilerUrl) {
                    $fullProfilerUrl = $response->getHeader('Host').$profilerUrl;
                    $this->printDebug('');
                    $this->printDebug(sprintf(
                        'Profiler URL: <comment>%s</comment>',
                        $fullProfilerUrl
                    ));
                }

                // an extra line for spacing
                $this->printDebug('');
            } else {
                $this->printDebug($body);
            }
        }


    }


    /**
     * Print a debugging message out in a big red block
     *
     * @param $string
     */
    protected function printErrorBlock($string)
    {
        if ($this->formatterHelper === null) {
            $this->formatterHelper = new FormatterHelper();
        }
        $output = $this->formatterHelper->formatBlock($string, 'bg=red;fg=white', true);

        $this->printDebug($output);
    }

    public function createWorkshop($data = [])
    {
        $workshopFactory = new WorkshopFactory();
        $workshop = $workshopFactory->createFromSpecification($data['name'], $data['activity'], $data['capacity'], $data['isAvailable']);
        /** @var EntityManager $em */
        $em = $this->getService('doctrine.orm.default_entity_manager');
        $em->persist($workshop);
        $em->flush();

        return $workshop;
    }

    public function createVenusOregonMarsWorkshops()
    {
        $inUse = false;
        $workshopFactory = new WorkshopFactory();

        $workshop1 = $workshopFactory->createFromSpecification('venus', null, Workshop::LARGE, $inUse);
        $workshop2 = $workshopFactory->createFromSpecification('oregon', null, Workshop::CLASSIC, true);
        $workshop3 = $workshopFactory->createFromSpecification('mars', null, Workshop::SMALL, $inUse);

        $em = $this->getService('doctrine.orm.default_entity_manager');


        return [$workshop1, $workshop2, $workshop3];
    }

}