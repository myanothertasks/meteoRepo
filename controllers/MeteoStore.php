<?php
require_once dirname("../interface/IMeteoRepo.php");

abstract class MeteoStore implements IMeteoRepo{
    
    abstract public function MeteoRepo(): IMeteoRepo; 
    
    public function save($meteoInfo){
        $repo= $this->MeteoRepo(); 
        $repo->save($meteoInfo);
    }

}