<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;

class OrderEditCtrl {

    public function action_orderEdit() {
        
        
        try {
            $orders = App::getDB()->select("orders", "*", [
                "order_status[=]" => "Oczekuje na dostawe" 
            ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }    
        
        App::getSmarty()->assign('orders', $orders);
        
        
        $this->generateView();
    }

    public function action_orderDelivered() {
        
        $id_order = ParamUtils::getFromCleanURL(1);
        
        try {
            App::getDB()->update("orders",[
                "delivery_date" => date("Y-m-d"),
                "order_status" => "Dostarczone"
            ],[
                "id_order[=]" => $id_order
            ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        try {
            $id_product = App::getDB()->select("order_items","id_product",[
                "id_order[=]" => $id_order
            ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        try {
            $quantity = App::getDB()->select("order_items","quantity",[
                "id_order[=]" => $id_order
            ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        print_r($id_product);
        print("\n");
        print_r($quantity);
        
        $numRecords = count($id_product);
        
        try {
            for($i = 0; $i < $numRecords; $i++){
                App::getDB()->update("products",[
                    "quantity[+]" => $quantity[$i]
                ],[
                    "id_product[=]" => $id_product[$i]
                ]);
            } 
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        
        App::getRouter()->redirectTo("orderEdit");

    }
    
    public function action_orderDelete() {
        
        $id_order = ParamUtils::getFromCleanURL(1);
         
        
        try {
            App::getDB()->delete("order_items",[
                "id_order[=]" => $id_order
            ]);
            App::getDB()->delete("orders",[
                "id_order[=]" => $id_order
            ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        App::getRouter()->redirectTo("orderEdit");

    }

    public function generateView() {

        App::getSmarty()->display('OrderEditView.tpl');
        
    }

}
