<?php

namespace app\controllers;

use core\App;

class BrowserCtrl{
    public function action_browser() {
        App::getSmarty()->assign('page_title', 'Wyszukiwarka produktów');
        //App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('BrowserView.tpl');
    }
    public function generateView() {

        App::getSmarty()->assign('page_title', 'Wyszukiwarka produktów');
        //App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('BrowserView.tpl');
    }
}
