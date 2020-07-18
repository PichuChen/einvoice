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

use PichuChen\einvoice\InvoiceHeader;
//use PichuChen\einvoice\InvoiceDateItem;

class InvoiceHeaderTest extends \PHPUnit\Framework\TestCase {

  var $mockFile = 'tests/mock/InvoiceHeader_response';

  function testGetNumber(){
    $response = new InvoiceHeader(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $this->assertEquals('TB65188703',$response->getNumber());
  }

  function testGetSellerName(){
    $response = new InvoiceHeader(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getSellerName();
    $this->assertInternalType('string',$actual);
  }
  
  function testGetStatus(){
    $response = new InvoiceHeader(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getStatus();
    $this->assertInternalType('string',$actual);
  }

  function testGetPeriod(){
    $response = new InvoiceHeader(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getPeriod();
    $this->assertInternalType('string',$actual);
  }

  function testGetResponseStatus(){
    $response = new InvoiceHeader(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getResponseStatus();
    $this->assertInstanceOf('PichuChen\\Einvoice\\ResponseStatus',$actual);
  }

}



