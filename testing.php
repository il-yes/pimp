<?php

require __DIR__.'/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client([
    'base_uri' => 'http://localhost:8001',
    'timeout' => 2000,
    'http_errors' => false
]);

$name = 'worshop'.rand(0, 999);
$data = array(
    'name' => $name,
    'activity' => 'Scrach Remove',
    'capacity' => 'classic',
    'isAvailable' => true
);


try {
    // your code here
    $response = $client->post('/api/workshops/', [
        'body' => json_encode($data)
    ]);
    $body = $response->getBody();
    $statusCode = $response->getStatusCode();
// Implicitly cast the body to a string and echo it
    echo $response;
    echo "\n\n";
} catch (\GuzzleHttp\Exception\ClientException $e) {
    // catches all ClientExceptions
    // echo $e->getMessage();
} catch (RequestException $e) {
    // catches all RequestExceptions
    echo $e->getRequest()->getBody();
    if ($e->hasResponse()) {
        echo $e->getResponse()->getBody();
    }
}

