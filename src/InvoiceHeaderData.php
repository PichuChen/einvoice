<?php namespace PichuChen\einvoice;

class InvoiceHeaderData{
  public $invNum = "";
  public $invDate = "";
  public $sellerName = "";
  public $invStatus = "";
  public $invPeriod = "";
  function __construct($data){
    $this->invNum = $data['invNum'];
    $this->invDate = $data['invDate'];
    $this->sellerName = $data['sellerName'];
    $this->invStatus = $data['invStatus'];
    $this->invPeriod = $data['invPeriod'];
  }
};


