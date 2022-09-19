<?php
require_once ("interfaces/IMeteoAPI.php");

class MeteoClient implements IMeteoAPI{

    private $API;
    public function __construct($API)
    {
        $this->API = $API;
    }    
    public function getMeteoInfo($lat, $lon)
    {
        return $this->API->getMeteoInfo($lat, $lon);
    }
}
