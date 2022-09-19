<?php
require_once ("interfaces/IMeteoRepo.php");

class XML_Repo implements IMeteoRepo{
    
    private $fileDate=array(
        "Date"=>"",
        "Wind_speed"=>"",
        "Temp"=>""
        //"Full_info"=>array(),
    );

    // Функци взята с https://www.codeproject.com/Questions/553031/JSONplusTOplusXMLplusconvertionpluswithplusphp
    private function array_to_xml($template_info, &$xml_template_info) {
        foreach($template_info as $key => $value) {
            if(is_array($value)) {
                if(!is_numeric($key)){

                    $subnode = $xml_template_info->addChild("$key");

                    if(count($value) >1 && is_array($value)){
                        $jump = false;
                        $count = 1;
                        foreach($value as $k => $v) {
                            if(is_array($v)){
                                if($count++ > 1)
                                    $subnode = $xml_template_info->addChild("$key");

                                array_to_xml($v, $subnode);
                                $jump = true;
                            }
                        }
                        if($jump) {
                            goto LE;
                        }
                        array_to_xml($value, $subnode);
                    }
                    else
                        array_to_xml($value, $subnode);
                }
                else{
                    array_to_xml($value, $xml_template_info);
                }
            }
            else {
                $xml_template_info->addChild("$key","$value");
            }

            LE: ;
        }
    }


    public function save($meteoInfo){
        
        $dataForFile=$meteoInfo->meteoInfo->forecasts;

        foreach($dataForFile as $value){

            $this->fileDate['Date']=$value->date;
            $this->fileDate['Temp']=$value->parts->day_short->temp;
            $this->fileDate['Wind_speed']=$value->parts->day_short->wind_speed;
            //$this->fileDate['Full_info']=$value;


            $template_info =$this->fileDate;//$value;

            $xml = new SimpleXMLElement('<root/>');
            $this->array_to_xml($template_info,$xml);
           

            
            //array_walk_recursive($this->fileDate, array ($xml, 'addChild'));
            // print $xml->asXML();
            //var_dump($this->fileDate);
            $xml->asXML('FileStorage/XML/'.$value->date.'('.$meteoInfo->meteoInfo->info->lat.'+'.$meteoInfo->meteoInfo->info->lon.').xml');
            
        }
        
    }
}