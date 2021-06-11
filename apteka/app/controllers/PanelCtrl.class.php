<?php

namespace app\controllers;

use core\App;

class PanelCtrl{
    public function action_adminPanel() {
        $this->generateView();
    }
    public function generateView() {

        App::getSmarty()->assign('page_title', 'Panel Administratora');
        //App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('PanelView.tpl');
    }
}