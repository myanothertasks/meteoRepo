<?php
require_once ("models/MeteoData.php");
require_once ("controllers/MeteoClient.php");
require_once ("controllers/YandexMeteoAPI.php");
require_once ("controllers/MeteoStore.php");
require_once ("controllers/JSON_Repo.php");
require_once ("controllers/XML_Repo.php");

$meteoData = new MeteoData();
$meteoData->lat="45.043315";
$meteoData->lon="41.969109";

$meteoClient=new MeteoClient(new YandexMeteoAPI());
$meteoData->meteoInfo=json_decode($meteoClient->getMeteoInfo($meteoData->lat, $meteoData->lon));

//var_dump($meteoData);
$repoXML = new MeteoStore(new XML_Repo());
$repoJSON = new MeteoStore(new JSON_Repo());

$repoJSON->save($meteoData);
$repoXML->save($meteoData);
