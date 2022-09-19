<?php
require_once ("interfaces/IMeteoRepo.php");

class MeteoStore implements IMeteoRepo{
    
    private $repo;
    public function __construct($repo){
        $this->repo = $repo;
    }    

    public function save($meteoInfo){
        $this->repo->save($meteoInfo);
    }

}