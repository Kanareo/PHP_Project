<?php

namespace app\controllers;

use core\App;
use app\forms\UserInfoForm;
use core\Utils;
use core\ParamUtils;

class UserInfoCtrl {

    public function __construct() {
        $this->form = new UserInfoForm();
    }

    public function action_userInfo() {

        $this->form->id_user = ParamUtils::getFromCleanURL(1);

        try {
            $this->records = App::getDB()->get("users", '*',
                    [
                        'id_user' => $this->form->id_user
                    ]
            );
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                echo($e);
            //Utils::addErrorMessage($e->getMessage());
        }

        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->assign('users', $this->records);
        $this->generateView();
    }

    public function generateView() {

        App::getSmarty()->assign('page_title', 'Informacje o użytkowniku');
        App::getSmarty()->display('UserInfoView.tpl');
    }

}
