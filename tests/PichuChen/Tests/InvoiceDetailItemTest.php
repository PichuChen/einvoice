<?php 

namespace PichuChen\Tests\Einvoice;

use PichuChen\Einvoice\InvoiceDetail;
//use PichuChen\Einvoice\InvoiceDateItem;

class InvoiceDetailTest extends \PHPUnit\Framework\TestCase {

  var $mockFile = 'tests/mock/InvoiceDetail_response';

  function testGetDetails(){
    $response = new InvoiceDetail(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $this->assertInternalType('array',$response->getDetails());
    $this->assertInstanceOf('PichuChen\\Einvoice\\InvoiceDetailItem',$response->getDetails()[0]);
  }

  function testGetNumber(){
    $response = new InvoiceDetail(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getNumber();
    $this->assertInternalType('string',$actual);
    $this->assertEquals('TB65188703',$actual);
  }

  function testGetDate(){
    $response = new InvoiceDetail(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getDate();
    $this->assertInternalType('string',$actual);
    $this->assertEquals('2015/02/26',$actual);
  }

  function testGetSellerName(){
    $response = new InvoiceDetail(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getSellerName();
    $this->assertInternalType('string',$actual);
    $this->assertEquals('興北',$actual);
  }

  function testGetStatus(){
    $response = new InvoiceDetail(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getStatus();
    $this->assertInternalType('string',$actual);
  }

  function testGetPeriod(){
    $response = new InvoiceDetail(
      json_decode(file_get_contents($this->mockFile),true)
    );
    $actual = $response->getPeriod();
    $this->assertInternalType('string',$actual);
    $this->assertEquals('10402',$actual);
  }

}



