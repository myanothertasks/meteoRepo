<?php
require_once ("interfaces/IMeteoRepo.php");

class JSON_Repo implements IMeteoRepo{
    private $fileDate=array(
        "Date"=>"",
        "Temp"=>"",
        "Wind_dir"=>"",
        "Full_info"=>array(),
    );
    public function save($meteoInfo){
        
        $dataForFile=$meteoInfo->meteoInfo->forecasts;

        foreach($dataForFile as $value){

            $this->fileDate['Date']=$value->date;
            $this->fileDate['Temp']=$value->parts->day_short->temp;
            $this->fileDate['Wind_dir']=$value->parts->day_short->wind_dir;
            $this->fileDate['Full_info']=$value;

            file_put_contents('FileStorage/JSON/'.$value->date.'('.$meteoInfo->meteoInfo->info->lat.'+'.$meteoInfo->meteoInfo->info->lon.').json',json_encode($this->fileDate));
            
        }
        //TODO: Добавить отлов ошибок при ошибке записи (нетд доступа, путь не найтен и т.п.)
        return true;
    }
}