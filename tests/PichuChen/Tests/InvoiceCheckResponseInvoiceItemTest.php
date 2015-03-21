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
use PichuChen\Einvoice\InvoiceCheckResponseInvoiceItem;
use PichuChen\Einvoice\CardType;

class InvoiceCheckResponsInvoiceItemTest extends \PHPUnit_Framework_TestCase {

  function testGetRow(){
    $response = new InvoiceCheckResponseInvoiceItem(
      json_decode(file_get_contents('tests/mock/InvoiceCheckResponseInvoiceItem_response'),true)
    );
    $this->assertEquals('1',$response->getRowNum());
  }

  function testCardType(){
    $response = new InvoiceCheckResponseInvoiceItem(
      json_decode(file_get_contents('tests/mock/InvoiceCheckResponseInvoiceItem_response'),true)
    );
    $this->assertEquals(CardType::EASYCARD,$response->getCardType());
  }

  function testCardNo(){
    $response = new InvoiceCheckResponseInvoiceItem(
      json_decode(file_get_contents('tests/mock/InvoiceCheckResponseInvoiceItem_response'),true)
    );
    $this->assertInternalType('string',$response->getCardNo());
  }  

  function testIsDonatable(){
    $response = new InvoiceCheckResponseInvoiceItem(
      json_decode(file_get_contents('tests/mock/InvoiceCheckResponseInvoiceItem_response'),true)
    );
    $this->assertEquals(false,$response->isDonatable());
  }

  function testGetAmount(){
    $response = new InvoiceCheckResponseInvoiceItem(
      json_decode(file_get_contents('tests/mock/InvoiceCheckResponseInvoiceItem_response'),true)
    );
    $actual = $response->getAmount();
    $this->assertInternalType('integer',$actual);
    $this->assertEquals(72,$actual);
  }

  function testGetDonateMark(){
    $response = new InvoiceCheckResponseInvoiceItem(
      json_decode(file_get_contents('tests/mock/InvoiceCheckResponseInvoiceItem_response'),true)
    );
    $actual = $response->getDonateMark();
    $this->assertInternalType('boolean',$actual);
    $this->assertEquals(false,$actual);
  }

  function testGetInvoiceDateTimezoneOffset(){
    $response = new InvoiceCheckResponseInvoiceItem(
      json_decode(file_get_contents('tests/mock/InvoiceCheckResponseInvoiceItem_response'),true)
    );
    $actual = $response->getInvoiceDateTimezoneOffset();
    $this->assertEquals(-480,$actual);
  }

  function testGetNumber(){
    $response = new InvoiceCheckResponseInvoiceItem(
      json_decode(file_get_contents('tests/mock/InvoiceCheckResponseInvoiceItem_response'),true)
    );
    $actual = $response->getNumber();
    $this->assertInternalType('string',$actual);
    $this->assertEquals('LN68533163',$actual);
  } 

  function testGetDate(){
    $response = new InvoiceCheckResponseInvoiceItem(
      json_decode(file_get_contents('tests/mock/InvoiceCheckResponseInvoiceItem_response'),true)
    );
    $actual = $response->getDate();
    $this->assertInternalType('string',$actual);
    $this->assertEquals('2014/09/01',$actual);
  }

  function testGetSellerName(){
    $response = new InvoiceCheckResponseInvoiceItem(
      json_decode(file_get_contents('tests/mock/InvoiceCheckResponseInvoiceItem_response'),true)
    );
    $actual = $response->getSellerName();
    $this->assertInternalType('string',$actual);
    $this->assertEquals('高雄西灣門市部',$actual);
  }

  function testGetStatus(){
    $response = new InvoiceCheckResponseInvoiceItem(
      json_decode(file_get_contents('tests/mock/InvoiceCheckResponseInvoiceItem_response'),true)
    );
    $actual = $response->getStatus();
    $this->assertInternalType('string',$actual);
  }

  function testGetPeriod(){
    $response = new InvoiceCheckResponseInvoiceItem(
      json_decode(file_get_contents('tests/mock/InvoiceCheckResponseInvoiceItem_response'),true)
    );
    $actual = $response->getPeriod();
    $this->assertInternalType('string',$actual);
    $this->assertEquals('10310',$actual);
  }

}



