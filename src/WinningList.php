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

class WinningList implements \JsonSerializable {
  private $response = "";
  private $responseStatus;
  function __construct($data){
    $this->responseStatus = new ResponseStatus($data);
    $this->response = $data;
  }

  function getSuperPrizeNo() { return $this->response['superPrizeNo'];}
  function getResponseStatus() { return $this->responseStatus;}


    /**
     *
     * JsonSerialize
     *
     * @return array
     */
    function jsonSerialize(){

        $superPrizeNoList = [];

        foreach(['superPrizeNo'] as $v){
            if($this->response[$v] !== "") $superPrizeNoList[] = $this->response[$v];
        }

        $spcPrizeNoList = [];

        foreach(['spcPrizeNo','spcPrizeNo2','spcPrizeNo3'] as $v){
            if($this->response[$v] !== "") $spcPrizeNoList[] = $this->response[$v];
        }

        $firstPrizeNoList = [];

        foreach(['firstPrizeNo1','firstPrizeNo2','firstPrizeNo3','firstPrizeNo4','firstPrizeNo5',
                 'firstPrizeNo6','firstPrizeNo7','firstPrizeNo8','firstPrizeNo9','firstPrizeNo10'] as $v){
            if($this->response[$v] !== "") $firstPrizeNoList[] = $this->response[$v];
        }

        $sixthPrizeNoList = [];

        foreach(['sixthPrizeNo1','sixthPrizeNo2','sixthPrizeNo3','sixthPrizeNo4','sixthPrizeNo5',
                    'sixthPrizeNo6'] as $v){
            if($this->response[$v] !== "") $sixthPrizeNoList[] = $this->response[$v];
        }

        return [
            'superPrizeAmt' => intval($this->response['superPrizeAmt']),
            'firstPrizeAmt' => intval($this->response['firstPrizeAmt']),
            'secondPrizeAmt' => intval($this->response['secondPrizeAmt']),
            'thirdPrizeAmt' => intval($this->response['thirdPrizeAmt']),
            'fourthPrizeAmt' => intval($this->response['fourthPrizeAmt']),
            'fifthPrizeAmt' => intval($this->response['fifthPrizeAmt']),
            'sixthPrizeAmt' => intval($this->response['sixthPrizeAmt']),

            'superPrizeNo' => $this->response['superPrizeNo'],

            'spcPrizeNo' => ($this->response['spcPrizeNo']),
            'spcPrizeNo1' => ($this->response['spcPrizeNo']),
            'spcPrizeNo2' => ($this->response['spcPrizeNo2']),
            'spcPrizeNo3' => ($this->response['spcPrizeNo3']),

            'firstPrizeNo1' => ($this->response['firstPrizeNo1']),
            'firstPrizeNo2' => ($this->response['firstPrizeNo2']),
            'firstPrizeNo3' => ($this->response['firstPrizeNo3']),
            'firstPrizeNo4' => ($this->response['firstPrizeNo4']),
            'firstPrizeNo5' => ($this->response['firstPrizeNo5']),
            'firstPrizeNo6' => ($this->response['firstPrizeNo6']),
            'firstPrizeNo7' => ($this->response['firstPrizeNo7']),
            'firstPrizeNo8' => ($this->response['firstPrizeNo8']),
            'firstPrizeNo9' => ($this->response['firstPrizeNo9']),
            'firstPrizeNo10' => ($this->response['firstPrizeNo10']),
            
            'sixthPrizeNo1' => ($this->response['sixthPrizeNo1']),
            'sixthPrizeNo2' => ($this->response['sixthPrizeNo2']),
            'sixthPrizeNo3' => ($this->response['sixthPrizeNo3']),
            'sixthPrizeNo4' => ($this->response['sixthPrizeNo4']),
            'sixthPrizeNo5' => ($this->response['sixthPrizeNo5']),
            'sixthPrizeNo6' => ($this->response['sixthPrizeNo6']),

            'superPrizeNoList' => $superPrizeNoList,
            'spcPrizeNoList' => $spcPrizeNoList,
            'firstPrizeNoList' => $firstPrizeNoList,
            'sixthPrizeNoList' => $sixthPrizeNoList,

            'invoYm' => $this->response['invoYm'],
            'updateDate' => $this->response['updateDate'],

        ];
    }

  function __call($name = "", array $arguments){
    $request = substr($name,3);
    $request[0] = strtolower($request[0]);
    if(isset($this->response[$request])) return $this->response[$request];
    throw(new Exception("Call to Undefined Function: " . $name));
  }
};

