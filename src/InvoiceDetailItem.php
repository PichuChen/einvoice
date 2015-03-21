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

class InvoiceDetailItem{
  private $rowNum = '';
  private $description = '';
  private $quantity = '';
  private $unitPrice = '';
  private $amount = '';

  function __construct($data){
    $this->rowNum = $data['rowNum'];
    $this->description = $data['description'];
    $this->quantity = $data['quantity'];
    $this->unitPrice = doubleval($data['unitPrice']);
    $this->amount = intval($data['amount']);
  }

  function getRowNum() {return $this->rowNum;}
  function getDescription() {return $this->description;}
  function getQuantity() {return $this->quantity;}
  function getUnitPrice() {return $this->unitPrice;}
  function getAmount() {return $this->amount;}

};

