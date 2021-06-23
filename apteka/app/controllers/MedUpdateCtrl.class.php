<?php

namespace app\controllers;

use core\App;
use app\forms\MedInfoForm;
use core\Utils;
use core\ParamUtils;

class MedUpdateCtrl {

    public function __construct() {
        $this->form = new MedInfoForm();
    }

    public function action_medUpdate() {

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

        App::getSmarty()->assign('products', $this->records);
        $this->generateView();
    }

    public function action_medUpdateSave() {

        $this->form->id_product = ParamUtils::getFromCleanURL(1);
        $this->form->quantity = ParamUtils::getFromRequest("quantity");

        if (is_numeric($this->form->quantity) && $this->form->quantity > 0) {

            try {
                App::getDB()->update("products",
                        [
                            'quantity' => $this->form->quantity
                        ],
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
        } else {
            Utils::addErrorMessage('Wpisana wartość nie jest liczbą, lub jest mniejsza lub równa 0');
        }
        
        App::getRouter()->redirectTo("medInfo/".$this->form->id_product);
    }

    public function generateView() {
        
        App::getSmarty()->display('MedUpdateView.tpl');
        
    }

}
