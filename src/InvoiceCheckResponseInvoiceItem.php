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

class InvoiceCheckResponseInvoiceItem implements \JsonSerializable  {
  private $rowNum;
  private $cardType;
  private $cardNo;
  private $invDonatable;
  private $amount;
  private $donateMark;
  private $invDateTimezoneOffset;

  protected $invoiceHeaderData;

  function __construct($data){
    $this->rowNum = $data['rowNum'];
    $this->cardType = $data['cardType'];
    $this->cardNo = $data['cardNo'];
    $this->invDonatable = $data['invDonatable'];
    $this->amount = $data['amount'];
    $this->donateMark = $data['donateMark'];
    $this->invDateTimezoneOffset = $data['invDate']['timezoneOffset'];
    $data['invDate'] = sprintf("%4d/%02d/%02d", (intval($data['invDate']['year']) + 1911), $data['invDate']['month'], $data['invDate']['date']);
    $this->invoiceHeaderData = new InvoiceHeaderData($data);
  }

  function getRowNum() {return $this->rowNum;}
  function getCardType() {return $this->cardType;}
  function getCardNo() {return $this->cardNo;}
  function isDonatable() {return $this->invDonatable;}
  function getAmount() {return $this->amount;}
  function getDonateMark() {return $this->donateMark === 1;}
  function getInvoiceDateTimezoneOffset() {return $this->invDateTimezoneOffset;}

  function getNumber() {return $this->invoiceHeaderData->invNum;}
  function getDate() {return $this->invoiceHeaderData->invDate;}
  function getSellerName() {return $this->invoiceHeaderData->sellerName;}
  function getStatus() {return $this->invoiceHeaderData->invStatus;}
  function getPeriod() {return $this->invoiceHeaderData->invPeriod;}

    function jsonSerialize(){
        return [
            "rowNum" => $this->getRowNum(),
            "number" => $this->getNumber(),
            "date" => $this->getDate(),
            "sellerName" => $this->getSellerName(),
            "period" => $this->getPeriod(),
            "status" => $this->getStatus(),
            "cardType" => $this->getCardType(),
            "cardNo" => $this->getCardNo(),
            "donatable" => $this->isDonatable(),
            "donateMark" => $this->getDonateMark(),
            "amount" => $this->getAmount(),
            "timezoneOffset" => $this->getInvoiceDateTimezoneOffset(),
        ];
    }
  

}

