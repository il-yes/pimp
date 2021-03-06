<?php

require __DIR__.'/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client([
    'base_uri' => 'http://localhost:8000',
    'timeout' => 2000,
    'http_errors' => false
]);

$name = 'hero'.rand(0, 999);
$data = array(
    'name' => $name,
    'activity' => null,
    'capacity' => \ProductBundle\Entity\Workshop::SMALL,
    'isAvailable' => true
);


try {

    // POST to create a workshop
    $response = $client->post('/api/workshops', [
        'body' => json_encode($data)
    ]);
    $body = $response->getBody();
    $statusCode = $response->getStatusCode();
    /*
    echo $statusCode;
    echo "\n\n";
    echo $body;
    echo "\n\n";
    */
    $workshopUrl = $response->getHeader('Location')[0];

    // GET to fetch that workshop
    $response = $client->get('/api/workshops/'. 1); // 1ere solution
    //$response = $client->get($workshopUrl);               // 2eme solution

    $body = $response->getBody();
    $statusCode = $response->getStatusCode();
    $finishedData = json_decode($body, true);
    /*
    echo var_dump($response->getHeaders());
    echo $statusCode;
    echo "\n\n";
    echo $body;
    var_dump($finishedData) ;
    echo "\n\n";
    */
    $data = array(
        'name' => $name,
        'activity' => null,
        'capacity' => \ProductBundle\Entity\Workshop::LARGE,
        'isAvailable' => true
    );
    $response = $client->put('/api/workshops/'. 12, [
        'body' => json_encode($data)
    ]);

    $body = $response->getBody();
    $statusCode = $response->getStatusCode();
    $finishedData = json_decode($body, true);

    echo var_dump($response->getHeaders());
    echo $statusCode;
    echo "\n\n";
    echo $body;
    var_dump($finishedData) ;
    echo "\n\n";



    // GET to get workshops
    $response = $client->get('/api/workshops');
    $body = $response->getBody();
    $statusCode = $response->getStatusCode();
/*
    echo var_dump($response->getHeaders());
    echo $statusCode;
    echo "\n\n";
    echo $body;
    echo "\n\n";
*/


// Implicitly cast the body to a string and echo it


} catch (\GuzzleHttp\Exception\ClientException $e) {
    // catches all ClientExceptions
    // echo $e->getMessage();
} catch (RequestException $e) {
    // catches all RequestExceptions
    //echo $e->getRequest()->getBody();
    if ($e->hasResponse()) {
        echo $e->getResponse()->getBody();
    }
}

