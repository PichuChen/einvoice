<?php 

namespace PichuChen\Tests\einvoice;

use PichuChen\einvoice\InvoiceDetail;
//use PichuChen\einvoice\InvoiceDateItem;

class InvoiceDetailTest extends \PHPUnit\Framework\TestCase {

  var $mockFile = 'tests/mock/InvoiceDetail_response';

  function testGetDetails(){
    $response = new InvoiceDetail(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $this->assertIsArray($response->getDetails());
    $this->assertInstanceOf('PichuChen\\einvoice\\InvoiceDetailItem',$response->getDetails()[0]);
  }

  function testGetNumber(){
    $response = new InvoiceDetail(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getNumber();
    $this->assertIsString($actual);
    $this->assertEquals('TB65188703',$actual);
  }

  function testGetDate(){
    $response = new InvoiceDetail(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getDate();
    $this->assertIsString($actual);
    $this->assertEquals('2015/02/26',$actual);
  }

  function testGetSellerName(){
    $response = new InvoiceDetail(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getSellerName();
    $this->assertIsString($actual);
    $this->assertEquals('興北',$actual);
  }

  function testGetStatus(){
    $response = new InvoiceDetail(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getStatus();
    $this->assertIsString($actual);
  }

  function testGetPeriod(){
    $response = new InvoiceDetail(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getPeriod();
    $this->assertIsString($actual);
    $this->assertEquals('10402',$actual);
  }

}



