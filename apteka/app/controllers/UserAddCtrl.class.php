<?php

namespace app\controllers;

use core\App;
use app\forms\UsersForm;
use core\Utils;
use core\ParamUtils;

class UserAddCtrl{
    public function __construct() {
        $this->form = new UsersForm();
    }
      
    public function validate() {
            $this->form->first_name = ParamUtils::getFromRequest('first_name', true, 'Błędne wywołanie aplikacji');
            $this->form->second_name = ParamUtils::getFromRequest('second_name', true, 'Błędne wywołanie aplikacji');
            $this->form->email = ParamUtils::getFromRequest('email', true, 'Błędne wywołanie aplikacji');
            $this->form->phone = ParamUtils::getFromRequest('phone', true, 'Błędne wywołanie aplikacji');
            $this->form->password = ParamUtils::getFromRequest('password', true, 'Błędne wywołanie aplikacji');
            $this->form->blocked = ParamUtils::getFromRequest('blocked', true, 'Błędne wywołanie aplikacji');
            $this->form->role = ParamUtils::getFromRequest('role', true, 'Błędne wywołanie aplikacji');
            
            if (App::getMessages()->isError()){ return false; }
            
            if (empty(trim($this->form->first_name))) { Utils::addErrorMessage('Wprowadź imie'); }
            if (empty(trim($this->form->second_name))) { Utils::addErrorMessage('Wprowadź nazwisko'); }
            if (empty(trim($this->form->email))) { Utils::addErrorMessage('Wprowadź email'); }
            if (empty(trim($this->form->phone))) { Utils::addErrorMessage('Wprowadź nr telefonu'); }
            if (empty(trim($this->form->password))) { Utils::addErrorMessage('Wprowadź haslo'); }
            
            if (App::getMessages()->isError()){ return false; }
            
            if(!preg_match('/^[a-zA-ząćęłńóśźżĄĘŁŃÓŚŹŻ\x20]{3,45}$/', $this->form->first_name)){ Utils::addErrorMessage("Podano niepoprawne imię"); }
            if(!preg_match('/^[a-zA-ząćęłńóśźżĄĘŁŃÓŚŹŻ\x20-]{3,45}$/', $this->form->second_name)){ Utils::addErrorMessage("Podano niepoprawne nazwisko"); }
            if(!preg_match('/^\d{9,15}$/', $this->form->phone)){ Utils::addErrorMessage("Podano niepoprawny nr telefonu"); }
            if(!preg_match('/^[a-zA-ząćęłńóśźżĄĘŁŃÓŚŹŻ\x20-_]{3,25}$/', $this->form->password)){ Utils::addErrorMessage("Podano niepoprawne haslo"); }
            if(!filter_var($this->form->email, FILTER_VALIDATE_EMAIL)){
                Utils::addErrorMessage("Podano niepoprawny email"); 
            }
            
            if (App::getMessages()->isError()){ return false; }
            
            $exists = App::getDB()->has("users", ["phone" => $this->form->phone]);  
            if($exists) { Utils::addErrorMessage('Podany numer telefonu jest już zajęty'); }
            
            $exists = App::getDB()->has("users", ["email" => $this->form->email]);  
            if($exists) { Utils::addErrorMessage('Podany adres email jest już zajęty'); }
            
            if (App::getMessages()->isError()){ return false; }
            
            return !App::getMessages()->isError();
        }
    
    public function action_userAdd() {    
        
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
        
        $this->generateView();
    }
    
    public function action_userAddSave(){
       
        if($this->validate()){
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
                Utils::addInfoMessage('Pomyślnie dodano użytkownika');
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                if (App::getConf()->debug)
                    echo($e);
                    //Utils::addErrorMessage($e->getMessage());
            }   
        }
       
        App::getRouter()->forwardTo("userAdd");
        
    }
    
    public function generateView() {

        App::getSmarty()->assign('page_title', 'Panel Administratora');
        App::getSmarty()->display('UserAddView.tpl');
    }
}