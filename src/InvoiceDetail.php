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
 *
 */
namespace PichuChen\einvoice;

use PichuChen\einvoice\ResponseStatus;
use PichuChen\einvoice\InvoiceHeaderData;
use PichuChen\einvoice\InvoiceDetailItem;

class InvoiceDetail implements \JsonSerializable {
  protected $responseStatus;
  protected $invoiceHeaderData;
  private $details = [];

  function __construct($data){
    $this->responseStatus = new ResponseStatus($data);
    $data['invDate'] = sprintf("%04d/%02d/%02d", substr($data['invDate'],0,4), substr($data['invDate'],4,2), substr($data['invDate'],6,2) );

    $this->invoiceHeaderData = new InvoiceHeaderData($data);
    foreach($data['details'] as $k => $v){
      $this->details[] = new InvoiceDetailItem($v);
    }
  }

  function getDetails(){ return $this->details;}
  function getNumber() {return $this->invoiceHeaderData->invNum;}
  function getDate() {return $this->invoiceHeaderData->invDate;}
  function getSellerName() {return $this->invoiceHeaderData->sellerName;}
  function getStatus() {return $this->invoiceHeaderData->invStatus;}
  function getPeriod() {return $this->invoiceHeaderData->invPeriod;}
  function getResponseStatus() {return $this->responseStatus;}

    /**
     *
     * JsonSerialize
     *
     * @return array
     */
    function jsonSerialize(){
        return [
            "number" => $this->getNumber(),
            "date" => $this->getDate(),
            "sellerName" => $this->getSellerName(),
            "status" => $this->getStatus(),
            "period" => $this->getPeriod(),
            "details" => $this->getDetails()
        ];
    }

};

