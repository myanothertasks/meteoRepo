<?php

interface IMeteoAPI{
    //Метод для получения метео данных
    public function getMeteoInfo($lat, $lon);

}