<?php
require_once ("interfaces/IMeteoAPI.php");
require_once ("controllers/MeteoClient.php");

 class YandexMeteoAPI implements IMeteoAPI {
    
    private $_APIKey="4e24e187-adee-4f08-9a5a-fb72c9f30fc5";
    private $_APIurl="https://api.weather.yandex.ru/v2/forecast?";

    public function getMeteoInfo($lat, $lon){
        
        $getParams = array("lat" => $lat, "lon" => $lon,"limit" =>7);
        $curlParams= array(
            CURLOPT_URL => $this->_APIurl.http_build_query($getParams),
            CURLOPT_USERAGENT => "Mozilla/4.0",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "X-Yandex-API-Key: ".$this->_APIKey
            ),
            );
            
        $curl = curl_init();   
        curl_setopt_array($curl, $curlParams);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;

    }

}