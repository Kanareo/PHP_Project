<?php

namespace app\controllers;

use app\transfer\User;
use app\forms\LoginForm;
use core\ParamUtils;
use core\App;
use core\Utils;
use core\RoleUtils;
use core\SessionUtils;

class LoginCtrl {

    private $form;

    public function __construct() {
        $this->form = new LoginForm();
    }

    public function getParams() {
        $this->form->login = ParamUtils::getFromRequest('login');
        $this->form->pass = ParamUtils::getFromRequest('pass');
    }

    public function validate() {
        if (!(isset($this->form->login) && isset($this->form->pass))) {
            return false;
        }

        if (!App::getMessages()->isError()) {

            if ($this->form->login == "") {
                Utils::addErrorMessage('Nie podano loginu');
            }
            if ($this->form->pass == "") {
                Utils::addErrorMessage('Nie podano hasła');
            }
        }
        
        $user = App::getDB()->get("users",[
            "email","password","blocked","role"
        ],[
            "email" => $this->form->login
        ]);

        //print_r($user);
        if (!App::getMessages()->isError()) {
            
            if($user["blocked"] == 1) { Utils::addErrorMessage('Twoje konto jest zablokowane, skontaktuje się z administratorem'); }
            else if (isset($user["password"]) && $this->form->pass == $user["password"]) { 
                RoleUtils::addRole($user["role"]);
                SessionUtils::storeObject("user", new User($this->form->login,$user["role"]));
                //SessionUtils::store("email",$user["email"]);
            } else { Utils::addErrorMessage('Niepoprawny login lub hasło'); }
        }

        return !App::getMessages()->isError();
    }

    public function action_login() {

        $this->getParams();

        if ($this->validate()) {
            App::getRouter()->redirectTo("hello");
        } else {
            $this->generateView();
        }
    }

    public function action_logout() {
        session_destroy();

        Utils::addInfoMessage('Poprawnie wylogowano z systemu');
        SessionUtils::storeMessages();

        App::getRouter()->redirectTo('mainView');
    }

    public function generateView() {

        App::getSmarty()->assign('page_title', 'Strona logowania');
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('LoginView.tpl');
    }

}
