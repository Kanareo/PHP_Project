<?php

namespace app\controllers;

use core\App;
use app\forms\UserInfoForm;
use core\Utils;
use core\ParamUtils;

class UserUpdateCtrl {

    public function __construct() {
        $this->form = new UserInfoForm();
    }

    public function action_userUpdate() {

        $this->form->id_user = ParamUtils::getFromCleanURL(1);

        try {
            $blocked = App::getDB()->select("users", [
                "@blocked"
            ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }

        App::getSmarty()->assign('blocked', $blocked);

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

    public function action_userUpdateSave() {

        $this->form->id_user = ParamUtils::getFromCleanURL(1);
        $this->form->blocked = ParamUtils::getFromRequest("blocked");

        try {
            App::getDB()->update("users",
                    [
                        'blocked' => $this->form->blocked
                    ],
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

        App::getRouter()->redirectTo("userInfo/" . $this->form->id_user);
    }

    public function generateView() {

        App::getSmarty()->display('UserUpdateView.tpl');
        
    }

}
