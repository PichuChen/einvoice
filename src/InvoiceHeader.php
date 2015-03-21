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

class InvoiceHeader{
  protected $responseStatus;
  protected $invoiceHeaderData;

  function __construct($data){
    $this->responseStatus = new ResponseStatus($data);
    $this->invoiceHeaderData = new InvoiceHeaderData($data);
  }


  function getNumber() {return $this->invoiceHeaderData->invNum;}
  function getDate() {return $this->invoiceHeaderData->invDate;}
  function getSellerName() {return $this->invoiceHeaderData->sellerName;}
  function getStatus() {return $this->invoiceHeaderData->invStatus;}
  function getPeriod() {return $this->invoiceHeaderData->invPeriod;}
  function getResponseStatus() {return $this->responseStatus;}


}

