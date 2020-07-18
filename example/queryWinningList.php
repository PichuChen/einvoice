<?php

require_once 'vendor/autoload.php';

// use PichuChen\einvoice\EinvoiceClient;

echo getenv('PICHU_EINVOICE_APPID');

$client = \PichuChen\einvoice\EinvoiceClient::factory([
    'uuid' => 'CLIENT_UUID',
    'appID' => getenv('PICHU_EINVOICE_APPID')
]);


$response = $client->queryWinningList([
      'invTerm' => '10106'
    ]);

var_dump($response);

