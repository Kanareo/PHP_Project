<?php

namespace app\controllers;

use core\App;
use app\forms\UsersForm;
use core\Utils;
use core\ParamUtils;
use core\RoleUtils;
use core\SessionUtils;

class PanelCtrl{
    public function __construct() {
        $this->form = new UsersForm();
    }
    
    public function action_adminPanel() {   
        
        $this->form->id = ParamUtils::getFromRequest('id');
        $this->form->first_name = ParamUtils::getFromRequest('first_name');
        $this->form->second_name = ParamUtils::getFromRequest('second_name');
        $this->form->email = ParamUtils::getFromRequest('email');
        $this->form->phone = ParamUtils::getFromRequest('phone');
        $this->form->blocked = ParamUtils::getFromRequest('blocked');
        $this->form->role = ParamUtils::getFromRequest('role');
        
        try {
            $blocked = App::getDB()->select("users", [
                "blocked"
                    ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        App::getSmarty()->assign('blocked', $blocked);
        
        try {
            $role = App::getDB()->select("users", [
                "role"
                    ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        App::getSmarty()->assign('role', $role);
        
        
        $search_params = [];
        if (isset($this->form->id) && !empty($this->form->id)) {
            $search_params['id_user[~]'] = $this->form->id . '%';
        }
        
        if (isset($this->form->first_name) && !empty($this->form->first_name)) {
            $search_params['first_name[~]'] = $this->form->first_name . '%';
        }
        
        if (isset($this->form->second_name) && !empty($this->form->second_name)) {
            $search_params['second_name[~]'] = $this->form->second_name . '%';
        }
        if (isset($this->form->email) && !empty($this->form->email)) {
            $search_params['email[~]'] = $this->form->email . '%';
        }
        
        if (isset($this->form->phone) && !empty($this->form->phone)) {
            $search_params['phone[~]'] = $this->form->phone . '%';
        }
        
        if (isset($this->form->blocked) && !empty($this->form->blocked)) {
            $search_params['blocked'] = $this->form->blocked . '%';
        }
        if (isset($this->form->role) && !empty($this->form->role)) {
            $search_params['role'] = $this->form->role . '%';
        }

        $num_params = sizeof($search_params);
        if ($num_params > 1) {
            $where = ["AND" => &$search_params];
        } else {
            $where = &$search_params;
        }
        
        $where ["ORDER"] = "id_user";
        try {
            $this->records = App::getDB()->select("users",'*', $where);
            //print_r(App::getDB()->debug()->select("users",'*', $where));
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                echo($e);
                //Utils::addErrorMessage($e->getMessage());
        }
        
        App::getSmarty()->assign('users', $this->records);
        $this->generateView();
    }
    
    public function generateView() {

        App::getSmarty()->assign('page_title', 'Panel Administratora');
        App::getSmarty()->display('PanelView.tpl');
    }
}