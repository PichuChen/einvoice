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

use GuzzleHttp\Client;
use PichuChen\einvoice\CardType;

class EinvoiceClient {

  const endpoint = 'https://www.einvoice.nat.gov.tw';
  var $timestampDelay = 180; // 180s
  var $uuid = "";
  var $appID = ""; 
  var $client;
 

  public static function factory($config = array()){

    if(!isset($config['uuid'])){
      throw new \InvalidArgumentException('uuid must be set.');
    }
    
    if(!isset($config['appID'])){
      throw new \InvalidArgumentException('appID must be set.');
    }

    $client = new EinvoiceClient();
    $client->uuid = $config['uuid'];
    $client->appID = $config['appID'];
    $client->client = new Client();
    return $client;
  }

  public function mockGuzzle($mock){
    $this->client->getEmitter()->attach($mock);
  }

    /**
     *
     * Query Winning List
     *
     * @param Array $data invTerm: optional
     * @return WinningList
     */
  public function queryWinningList($data){
    $param['version'] = "0.2";
    $param['action']  = "QryWinningList";
    $param['invTerm'] = isset($data['invTerm']) ? $data['invTerm'] : "";
    $param['UUID']    = $this->uuid;
    $param['appID']   = $this->appID;

    $queryString = self::endpoint . '/PB2CAPIVAN/invapp/InvApp?' . $this->buildParam($param) ;
    $result = $this->doRequest($queryString);
    return new WinningList(json_decode($result,true));
  }

    /**
     *
     * QueryInvoiceHeader
     *
     * @param Array $data type: optinal, default: BARCODE; invNum: required; invDate: required;
     * @return InvoiceHeader
     */
  public function queryInvoiceHeader($data){
    $param = array(
      'version' => '0.2',
      'type' => isset($data['type']) ? $data['type'] : CodeType::BARCODE,
      'invNum' => isset($data['invNum']) ? $data['invNum'] : '',
      'action' => 'qryInvHeader',
      'generation' => 'V2',
      'invDate' => isset($data['invDate']) ? $data['invDate'] : '',
      'UUID' => $this->uuid,
      'appID' => $this->appID
    );

    $queryString = self::endpoint . '/PB2CAPIVAN/invapp/InvApp?' . $this->buildParam($param) ;
    $result = $this->doRequest($queryString);
    return new InvoiceHeader(json_decode($result,true));
  }

  public function queryInvoiceDetail($data){
    $param = array(
      'version' => '0.2',
      'type' => isset($data['type']) ? $data['type'] : CodeType::BARCODE,
      'invNum' => isset($data['invNum']) ? $data['invNum'] : '',
      'action' => 'qryInvDetail',
      'generation' => 'V2',
      'invTerm' => isset($data['invTerm']) ? $data['invTerm'] : '',
      'invDate' => isset($data['invDate']) ? $data['invDate'] : '',
      'encrypt' => isset($data['encrypt']) ? $data['encrypt'] : '',
      'sellerID' => isset($data['sellerID']) ? $data['sellerID'] : '',
      'UUID' => $this->uuid,
      'randomNumber' => isset($data['randomNumber']) ? $data['randomNumber'] : '',
      'appID' => $this->appID
    );

    $queryString = self::endpoint . '/PB2CAPIVAN/invapp/InvApp?' . $this->buildParam($param) ;
    $result = $this->doRequest($queryString);
    return new InvoiceDetail(json_decode($result,true));
  }

  public function queryLoveCode(){
    $param = array(
      'version' => '0.2',
      'qKey' => '1',
      'action' => 'qryLoveCode',
      'UUID' => $this->uuid,
      'appID' => $this->appID
    );

    $queryString = self::endpoint . '/PB2CAPIVAN/loveCodeapp/qryLoveCode?' . $this->buildParam($param) ;
    $result = $this->doRequest($queryString);
    return new SocialWelfareList(json_decode($result,true));
  }

  public function carrierInvoiceCheck($data){
    $endDate = new \DateTime('now');
    $startDate = $endDate->sub(\DateInterval::createFromDateString('7 days'));
    $param = array(
      'version' => '0.2',
      'cardType' => isset($data['cardType']) ? $data['cardType'] : CardType::PHONEBARCODE,
      'cardNo' => isset($data['cardNo']) ? $data['cardNo'] : '/AB56P5Q',
      'expTimeStamp' => isset($data['expTimeStamp']) ? $data['expTimeStamp'] : '2147483647',
      'action' => 'carrierInvChk',
      'timeStamp' => $this->getTimestamp(),
      'startDate' => isset($data['startDate']) ? $data['startDate'] : $startDate->format('Y/m/d'),
      'endDate' => isset($data['endDate']) ? $data['endDate'] : $endDate->format('Y/m/d'),
      'onlyWinningInv' => isset($data['onlyWinningInv']) ? $data['onlyWinningInv'] : 'N',
      'uuid' => $this->uuid,
      'appID' => $this->appID,
      'cardEncrypt' => isset($data['cardEncrypt']) ? $data['cardEncrypt'] : ''
    );

    $queryString = self::endpoint . '/PB2CAPIVAN/invServ/InvServ?' . $this->buildParam($param) ;
    $result = $this->doRequest($queryString);
    return new InvoiceCheckResponse(json_decode($result,true));
  }

  public function carrierInvoiceDetail($data){
    $param = array(
      'version' => '0.1',
      'cardType' => isset($data['cardType']) ? $data['cardType'] : CardType::PHONEBARCODE,
      'cardNo' => isset($data['cardNo']) ? $data['cardNo'] : '/AB56P5Q',
      'expTimeStamp' => isset($data['expTimeStamp']) ? $data['expTimeStamp'] : '2147483647',
      'action' => 'carrierInvDetail',
      'timeStamp' => $this->getTimestamp(),
      'invNum' => isset($data['invNum']) ? $data['invNum'] : '',
      'invDate' => isset($data['invDate']) ? $data['invDate'] : '',
      'uuid' => $this->uuid,
      //'sellerName' => 'test',
      //'amount' => 'test',
      'appID' => $this->appID,
      'cardEncrypt' => isset($data['cardEncrypt']) ? $data['cardEncrypt'] : ''
    );

    $queryString = self::endpoint . '/PB2CAPIVAN/invServ/InvServ?' . $this->buildParam($param) ;
    $result = $this->doRequest($queryString);
    return new InvoiceDetail(json_decode($result,true));
  }

  private function getTimestamp(){
    return time() + $this->timestampDelay;
  }

    /**
     *
     * Build query param string from array
     *
     * @param $data
     * @return string
     */
  private function buildParam($data){
    return urldecode(http_build_query($data));

  }

  private function doRequest($input){
      $response = $this->client->get($input, ['verify' => false]);
      return $response->getBody();
//    return shell_exec("curl -ks '".$input."'");
  }

};

