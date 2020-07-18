<?php

require_once 'vendor/autoload.php';

use \PichuChen\einvoice\CardType;

$client = \PichuChen\einvoice\EinvoiceClient::factory([
    'uuid' => 'CLIENT_UUID',
    'appID' => getenv('PICHU_EINVOICE_APPID')
]);


$response = $client->carrierInvoiceCheck([
     'cardType' => CardType::EI,
     'cardNo' => '',
     'startDate' => '2019/09/01',
     'endDate' => '2020/09/04',
     'onlyWinningInv' => 'N',
     'cardEncrypt' => '' // ???
    ]);

var_dump($response);
