<?php

interface IMeteoRepo{
    //Метод для сохранения метео данных
    public function save($meteoInfo): void;

}