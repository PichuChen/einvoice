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

class WinningList {
  private $response = "";
  private $responseStatus;
  function __construct($data){
    $this->responseStatus = new ResponseStatus($data);
    $this->response = $data;
  }

  function getSuperPrizeNo() { return $this->response['superPrizeNo'];}
  function getResponseStatus() { return $this->responseStatus;}

  function __call($name = "", array $arguments){
    $request = substr($name,3);
    $request[0] = strtolower($request[0]);
    if(isset($this->response[$request])) return $this->response[$request];
    throw(new Exception("Call to Undefined Function: " . $name));
  }
};

