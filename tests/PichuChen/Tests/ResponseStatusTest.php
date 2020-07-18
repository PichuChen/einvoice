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

use PichuChen\einvoice\ResponseStatus;
//use PichuChen\einvoice\InvoiceDateItem;

class ResponseStatusTest extends \PHPUnit\Framework\TestCase {

  var $mockFile = 'tests/mock/InvoiceHeader_response';

  function testGetVersion(){
    $response = new ResponseStatus(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $this->assertEquals('0',$response->getVersion());
  }

  function testGetCode(){
    $response = new ResponseStatus(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getCode();
    $this->assertEquals('200',$actual);
  }
  
  function testGetMessage(){
    $response = new ResponseStatus(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getMessage();
    $this->assertIsString($actual);
  }

}



