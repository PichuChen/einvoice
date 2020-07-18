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

namespace PichuChen\Tests\Einvoice;

use GuzzleHttp\Subscriber\Mock;
use PichuChen\Einvoice\InvoiceCheckResponse;

class InvoiceCheckResponseTest extends \PHPUnit\Framework\TestCase {


  function testIsOnlyWinningInv(){
    $response = new InvoiceCheckResponse(json_decode(file_get_contents('tests/mock/InvoiceCheckResponse_response'),true));
    $this->assertEquals(false,$response->isOnlyWinningInv());
  }

  function testIsOnlyWinningInv2(){
    $response = new InvoiceCheckResponse(json_decode(file_get_contents('tests/mock/InvoiceCheckResponse_response_2'),true));
    $this->assertEquals(true,$response->isOnlyWinningInv());
  }

  function testGetDetails() {
    $response = new InvoiceCheckResponse(json_decode(file_get_contents('tests/mock/InvoiceCheckResponse_response'),true));
    $this->assertInternalType('array',$response->getDetails());
    $this->assertInstanceOf('PichuChen\\Einvoice\\InvoiceCheckResponseInvoiceItem',$response->getDetails()[0]);
  }

  function getResponseStatus() {
    $response = new InvoiceCheckResponse(json_decode(file_get_contents('tests/mock/InvoiceCheckResponse_response'),true));
    $this->assertInstanceOf('PichuChen\\Einvoice\\ResponseStatus',$response->getResponse());
  }

}


