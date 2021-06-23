<?php

namespace app\controllers;

use core\App;
use app\forms\MedInfoForm;
use core\Utils;
use core\ParamUtils;

class MedInfoCtrl {

    public function __construct() {
        $this->form = new MedInfoForm();
    }

    public function action_medInfo() {

        $this->form->id_product = ParamUtils::getFromCleanURL(1);

        try {
            $this->records = App::getDB()->get("products", ['[><]brands' => 'id_brand', '[><]categories' => 'id_category'], '*',
                    [
                        'id_product' => $this->form->id_product
                    ]
            );
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                echo($e);
            //Utils::addErrorMessage($e->getMessage());
        }

        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->assign('products', $this->records);
        $this->generateView();
    }

    public function generateView() {

        App::getSmarty()->display('MedInfoView.tpl');
        
    }

}
