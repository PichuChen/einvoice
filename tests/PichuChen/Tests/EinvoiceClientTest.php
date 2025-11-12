<?php
/*
 * Copyright 2015 Pichu Chen, TIH
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace PichuChen\Tests\einvoice;

use PichuChen\einvoice\CardType;
use PichuChen\einvoice\CodeType;
use PichuChen\einvoice\EinvoiceClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Message;


class EinvoiceClientTest extends \PHPUnit\Framework\TestCase {

  var $testingUUID = '28c7fb82-bd5d-46cc-a814-b2a92310f72e';
//  var $appID = 'EINV3201402316654'; // Fack ID
  var $appID = "EINV3201402123456" ; 

  function buildClient(){
    return EinvoiceClient::factory([
      'uuid' => $this->testingUUID,
      'appID' => $this->appID,
    ]);
  }

  function testTest(){
    $this->assertTrue(true);

  }

  function testFactoryInitializesClient(){
      $client = EinvoiceClient::factory([
        'uuid' => $this->testingUUID,
        'appID' => $this->appID,
      ]);
      
      
  }


  function testFactoryArgumentError(){
    try{
      $client = EinvoiceClient::factory([
        'uuid' => '28c7fb82-bd5d-46cc-a814-b2a92310f72e',
        'appId' => "EINV3201402123456",
      ]);
    }catch(\InvalidArgumentException $e){
      return;
    }
    $this->fail('An expected exception has not been raised');
    var_dump($client);
  }

  function testQueryWinningList(){
    $raw = file_get_contents('tests/mock/QueryWinningList_response');
    $resp = Message::parseResponse($raw);
    $EinvoiceClient = $this->buildClient();
    $EinvoiceClient->mockGuzzleResponses([$resp]);
    $result = $EinvoiceClient->queryWinningList([
      'invTerm' => '10106'
    ]);
    $this->assertInstanceOf('PichuChen\Einvoice\WinningList',$result); 
  }

  function testQueryInvoiceHeader(){
    $raw = file_get_contents('tests/mock/QueryInvoiceHeader_response');
    $resp = Message::parseResponse($raw);
    $EinvoiceClient = $this->buildClient();
    $EinvoiceClient->mockGuzzleResponses([$resp]);
    $result = $EinvoiceClient->queryInvoiceHeader([
      'type'=>CodeType::BARCODE,
      'invNum' => 'TB65188703',
      'invDate' => '2015/02/26'
    ]);
    $this->assertInstanceOf('PichuChen\Einvoice\InvoiceHeader',$result);
  }

  function testQueryInvoiceDetail(){
    $raw = file_get_contents('tests/mock/QueryInvoiceDetail_response');
    $resp = Message::parseResponse($raw);
    $EinvoiceClient = $this->buildClient();
    $EinvoiceClient->mockGuzzleResponses([$resp]);
    $result = $EinvoiceClient->queryInvoiceDetail([
      'type' => CodeType::BARCODE,
      'invNum' => 'TB65188703',
      'invTerm' => '10402',
      'invDate' => '2014/02/26',
      'randomNumber' => '9986',
    ]);

    $this->assertInstanceOf('PichuChen\Einvoice\InvoiceDetail',$result);
  }

  function testQueryLoveCode(){
    $raw = file_get_contents('tests/mock/QueryLoveCode_response');
    $resp = Message::parseResponse($raw);
    $EinvoiceClient = $this->buildClient();
    $EinvoiceClient->mockGuzzleResponses([$resp]);
    $result = $EinvoiceClient->queryLoveCode();

    $this->assertInstanceOf('PichuChen\Einvoice\SocialWelfareList',$result);

  }

  function testCarrierInvoiceCheck(){
    $raw = file_get_contents('tests/mock/CarrierInvoiceCheck_response');
    $resp = Message::parseResponse($raw);
    $EinvoiceClient = $this->buildClient();
    $EinvoiceClient->mockGuzzleResponses([$resp]);
    $result = $EinvoiceClient->carrierInvoiceCheck([
     'cardType' => CardType::EASYCARD,
     'cardNo' => '4051212345',
     'startDate' => '2014/09/01',
     'endDate' => '2014/09/04',
     'onlyWinningInv' => 'N',
     'cardEncrypt' => '1234512345'
    ]);

    $this->assertInstanceOf('PichuChen\Einvoice\InvoiceCheckResponse',$result);

  }

  function testCarrierInvoiceDetail(){
    $raw = file_get_contents('tests/mock/CarrierInvoiceDetail_response');
    $resp = Message::parseResponse($raw);
    $EinvoiceClient = $this->buildClient(); 
    $EinvoiceClient->mockGuzzleResponses([$resp]);
    $result = $EinvoiceClient->carrierInvoiceDetail([
      'cardType' => CardType::EASYCARD,
      'cardNo' => '405112345',
      'invNum' => 'LG27676622',
      'invDate' => '2014/9/4',
      'cardEncrypt' => '1234512334'
    ]);
    
    $this->assertInstanceOf('PichuChen\Einvoice\InvoiceDetail',$result);
  }

  

}

