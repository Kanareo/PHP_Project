<?php

namespace app\controllers;

use core\App;
use core\SessionUtils;

class MainViewCtrl {
    
    public function action_mainView() {
        
        SessionUtils::loadMessages();
        App::getSmarty()->display("MainView.tpl");
        
    }
    
}