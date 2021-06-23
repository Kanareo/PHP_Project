<?php

namespace app\controllers;

use core\App;
use app\forms\OrderItemForm;
use app\transfer\Order;
use core\Utils;
use core\ParamUtils;
use core\SessionUtils;

class OrderCtrl {

    public function __construct() {
        $this->form = new OrderItemForm();
    }

    public function action_order() {
        
        try {
            $product = App::getDB()->select("products", [
                "id_product",
                "product_name"
                    ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        App::getSmarty()->assign('product', $product);         
        App::getSmarty()->display('OrderView.tpl');
    }

    public function action_orderAdd() {
        try {
            $product = App::getDB()->select("products", [
                "id_product",
                "product_name"
                    ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        App::getSmarty()->assign('product', $product);

        if (null == SessionUtils::load("check", true)) {

            $user = SessionUtils::loadObject("user", true);

            $order_date = date("Y-m-d");
            $order_status = "Zamówione";
            $delivery_date = "0000-00-00";

            try {
                $id_user = App::getDB()->get("users", "id_user", [
                    "email[=]" => $user->login
                ]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }

            $order = new Order($id_user, $order_status, $order_date, $delivery_date);

            try {
                App::getDB()->insert("orders",[
                  "id_user" => $order->id_user,
                  "order_status" => $order->order_status,
                  "order_date" => $order->order_date,
                  "delivery_date" => $order->delivery_date
                  ]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas wprowadzania rekordów');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
            
            try {
                $id_order = App::getDB()->get("orders", "id_order", [
                    "ORDER" => ["id_order" => "DESC"]
                ]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }


            SessionUtils::store("id_order", $id_order);

            SessionUtils::store("check", true);
        }

        $this->form->id_order = SessionUtils::load("id_order", true);
        $this->form->id_product = ParamUtils::getFromRequest("id_product");
        $this->form->quantity = ParamUtils::getFromRequest("quantity");

        if ((isset($this->form->id_product) && strlen($this->form->id_product) > 0)  && (isset($this->form->quantity)) && strlen($this->form->quantity) > 0) {
            try {
                App::getDB()->insert("order_items",[
                  "id_order" => $this->form->id_order,
                  "id_product" => $this->form->id_product,
                  "quantity" => $this->form->quantity
                  ]);
                Utils::addInfoMessage('Pomyślnie dodano produkt do listy');
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas wprowadzania rekordów');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        }else Utils::addErrorMessage('Nie można wprowadzić pustych wartości');
        
        $this->generateView();
    }

    public function action_orderClear() {
        
        $id_order = SessionUtils::load("id_order");
        
        try {
            App::getDB()->update("orders",[
                "order_status" => "Oczekuje na dostawe"
            ],[
                "id_order[=]" => $id_order
            ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        SessionUtils::remove("check");
        App::getRouter()->redirectTo("order");
    }

    public function generateView() {

        App::getSmarty()->display('OrderView.tpl');
        
    }

}
