<?php

namespace app\controllers;

use core\App;
use core\Message;
use core\Utils;
use core\SessionUtils;

class MainViewCtrl {
    
    public function action_mainView() {
        
        SessionUtils::loadMessages();
        App::getSmarty()->display("MainView.tpl");
        
    }
    
}