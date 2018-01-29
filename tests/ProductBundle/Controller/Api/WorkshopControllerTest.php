<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 29/01/18
 * Time: 14:15
 */

namespace tests\ProductBundle\Controller\Api;


use CoreBundle\Test\ApiTestCase;

class WorkshopControllerTest extends ApiTestCase
{
    /**
     * @test
     */
    public function Post()
    {
        $name = 'workshop-founder';
        $data = array(
            'name' => $name,
            'activity' => null,
            'capacity' => \ProductBundle\Entity\Workshop::SMALL,
            'isAvailable' => true
        );



            // POST to create a workshop
            $response = $this->client->post('/api/workshops', [
                'body' => json_encode($data)
            ]);
            $body = $response->getBody();

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('/api/workshops/workshop-founder', $response->getHeader('Location')[0]);
        $this->assertTrue($response->hasHeader('Location'));
        $finishedData = json_decode($response->getBody(true), true);
        $this->assertEquals('workshop-founder', $finishedData['name']);

        var_dump($finishedData);
    }
}