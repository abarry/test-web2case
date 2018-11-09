<?php

// params

//$uri = 'http://172.23.12.143:8082/topics/web2case'; // qualif
$uri = 'http://172.25.140.37:8082/topics/web2case'; // prod

$method = 'POST';
$json = '{
    "records": [
        {
            "value": {
                "email": "aurelien@mnstr.com",
                "lastName": "Millet",
                "firstName": "Aurélien",
                "title": "Mr.",
                "topic": "Other",
                "subject": "Other",
                "description": "test prod",
                "websiteCountry": "FR",
                "brand": "boucheron",
                "origin": "WebForm",
                "status": "New",
                "appId": "ynap",
                "attachmentURL": ""
            }
        }
    ]
}';
//$timeout = 5;
$acceptHeader = 'application/vnd.kafka.v2+json';
$contentTypeHeader = 'application/vnd.kafka.json.v2+json';

// Magento

/*try {
    require_once('../app/Mage.php');
    Mage::app();

    $client = new Varien_Http_Client();
    $response = $client->setUri($uri)
        ->setConfig(['timeout' => $timeout])
        ->setMethod($method)
        ->setRawData($json, $contentTypeHeader)
        ->setHeaders('Accept', $acceptHeader)
        ->request();

    Zend_Debug::dump($response);
} catch (Exception $e) {
    Zend_Debug::dump($e);
}

exit;*/

// Guzzle

try {
    require 'vendor/autoload.php';

    $client = new GuzzleHttp\Client();
    $opts = [
        'json' => json_decode($json),
        'timeout' => $timeout,
        'debug' => true,
        'headers' => [
            'Accept' => $acceptHeader,
            'Content-Type' => $contentTypeHeader,
        ],
    ];
    $response = $client->request($method, $uri, $opts);

    echo '<pre>';
    var_dump($response->getStatusCode(), $response->getHeader('content-type'), $response->getBody()->getContents());
    echo '</pre>';
} catch (Exception $e) {
    echo '<pre>';
    var_dump($e);
    echo '</pre>';
}

