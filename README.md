# einvoice
PHP SDK of Taiwan E-Invoice API


## 基本需求

### 電子發票API
使用前請先向「財政部電子發票整合服務平台」申請「電子發票API」(https://www.einvoice.nat.gov.tw/APMEMBERVAN/APIService/Registration?CSRT=15916142259000470854)

### Composer
此Library 使用Comporser進行安裝，在專案目錄下的`composer.json`新增

    {
        "require":{
            "pichuchen/einvoice": "1.0.0"
        }
    }
  
 接下來執行
 
    curl -sS https://getcomposer.org/installer | php
    php composer.phar install
    
 進行安裝

## 設定
使用時請先

    require_once 'vendor/autoload.php';
    
接著用

    $client = \PichuChen\einvoice\EinvoiceClient::factory([
        'uuid' => 'CLIENT_UUID',
        'appID' => 'API_KEY'
    ]);

生成`EinvoiceClient`實體。
其中`CLIENT_UUID`是電子發票整合服務平台為了避免特定使用者濫用所要求之ＩＤ，
請試著給不同的使用者不同的UUID。
`API_KEY`的部分是和電子發票整合平台提出聲請後得到的KEY。

## 功能介紹

目前支援的功能有

* 查詢開獎號碼
* 查詢特定發票表頭資訊
* 查詢特定發票細節資訊
* 查詢捐贈代號
* 查詢特定載具上的發票資訊
* 查詢特定載具上發票資訊細節
 
