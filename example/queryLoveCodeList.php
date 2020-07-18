<?php

require_once 'vendor/autoload.php';

$client = \PichuChen\einvoice\EinvoiceClient::factory([
    'uuid' => 'CLIENT_UUID',
    'appID' => getenv('PICHU_EINVOICE_APPID')
]);


$response = $client->queryLoveCode();

var_dump($response);

