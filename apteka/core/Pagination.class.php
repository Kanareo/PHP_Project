<?php

namespace core;

class Pagination{
    
    public static function getPages($recordsNum, $recordsPerPage) {
            $page = ParamUtils::getFromCleanURL(1);
            
            $lastPage = 1;
            
            while($recordsNum > 0){
                $recordsNum = $recordsNum - $recordsPerPage;
                $lastPage++;
            }
            
            if(!isset($page) || $page < 1){ 
                $page = 1;      
            }
            if($page > $lastPage-1){ 
                $page = $lastPage-1; 
            }
            
            
            App::getSmarty()->assign("lastPage", $lastPage);
            App::getSmarty()->assign("page", $page);
            return $page;
        }   
}

