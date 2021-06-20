<?php

namespace app\controllers;

use core\App;
use app\forms\UsersForm;
use core\Utils;
use core\ParamUtils;
use core\RoleUtils;
use core\SessionUtils;

class UserAddCtrl{
    public function __construct() {
        $this->form = new UsersForm();
    }
    
    public function action_userAdd() {    
        $this->form->first_name = ParamUtils::getFromRequest('first_name');
        $this->form->second_name = ParamUtils::getFromRequest('second_name');
        $this->form->email = ParamUtils::getFromRequest('email');
        $this->form->phone = ParamUtils::getFromRequest('phone');
        $this->form->blocked = ParamUtils::getFromRequest('blocked');
        $this->form->role = ParamUtils::getFromRequest('role');
        $this->form->password = ParamUtils::getFromRequest('password');
        
        
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
            $role = App::getDB()->select("users", [
                "@role"
                    ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        App::getSmarty()->assign('role', $role);
        
        
        if(
            (isset($this->form->first_name) && !empty($this->form->first_name) &&
            isset($this->form->second_name) && !empty($this->form->second_name) &&
            isset($this->form->email) && !empty($this->form->email) &&
            isset($this->form->phone) && !empty($this->form->phone) &&
            isset($this->form->blocked) &&
            isset($this->form->role) && !empty($this->form->role) &&
            isset($this->form->password) && !empty($this->form->password))
        ){
            try {
                $this->records = App::getDB()->insert("users",
                        [
                            "first_name" => $this->form->first_name,
                            "second_name" => $this->form->second_name,
                            "email" => $this->form->email,
                            "phone" => $this->form->phone,
                            "blocked" => $this->form->blocked,
                            "role" => $this->form->role,
                            "password" => $this->form->password
                        ]);
                /*print_r(App::getDB()->debug()->insert("users",
                        [
                            "first_name" => $this->form->first_name,
                            "second_name" => $this->form->second_name,
                            "email" => $this->form->email,
                            "phone" => $this->form->phone,
                            "blocked" => $this->form->blocked,
                            "role" => $this->form->role,
                        ]));*/
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                if (App::getConf()->debug)
                    echo($e);
                    //Utils::addErrorMessage($e->getMessage());
            }
            Utils::addInfoMessage('Pomyślnie dodano użytkownika');
        }else{
            Utils::addErrorMessage('Nie podano jednego z parametrow, do wprawodzenia użytkownika wymagane są wszystkie');
        }
        $this->generateView();
    }
    
    public function generateView() {

        App::getSmarty()->assign('page_title', 'Panel Administratora');
        App::getSmarty()->display('UserAddView.tpl');
    }
}