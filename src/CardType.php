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

namespace PichuChen\einvoice;

class CardType{
  const PHONE_BARCODE = "3J0002"; // 手機條碼
  const EASYCARD      = "1K0001"; // 悠遊卡
  const ICASH         = "2G0001"; // icash (Deprecated?)
  const CDC_BARCODE   = "CQ0001"; // 自然人憑證條碼
  const EI            = "EJ0011"; // 鯨躍發票卡
  const TIH_MEMBER    = "EJ1507"; // 台灣智慧家庭會員
  const ECPAY         = "EM0009"; // 綠界科技

  static function customCardType($code) {
  	return $code;
  }



};


