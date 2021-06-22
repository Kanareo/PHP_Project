<?php

namespace app\controllers;

use core\App;
use app\forms\OrderItemForm;
use app\transfer\Order;
use core\Utils;
use core\ParamUtils;
use core\RoleUtils;
use core\SessionUtils;

class OrderCtrl {

    public function __construct() {
        $this->form = new OrderItemForm();
    }

    public function action_order() {
        
        try {
            $id_product = App::getDB()->select("products", [
                "id_product"
                    ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        App::getSmarty()->assign('id_product', $id_product);
        
        
        App::getSmarty()->display('OrderView.tpl');
    }

    public function action_orderAdd() {
        
        try {
            $id_product = App::getDB()->select("products", [
                "id_product"
                    ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        App::getSmarty()->assign('id_product', $id_product);

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
                $id_order = App::getDB()->get("orders", "id_order", [
                    "ORDER" => ["id_order" => "DESC"]
                ]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }

            //print($order->id_user);

            try {
                App::getDB()->insert("orders",[
                  "id_user" => $order->id_user,
                  "order_status" => $order->order_status,
                  "order_date" => $order->order_date,
                  "delivery_date" => $order->delivery_date
                  ]);
                /*print_r(App::getDB()->debug()->insert("orders", [
                            "id_user" => $order->id_user,
                            "order_status" => $order->order_status,
                            "order_date" => $order->order_date,
                            "delivery_date" => $order->delivery_date
                ]));*/
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas wprowadzania rekordów');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }

            $id_order += 1;

            SessionUtils::store("id_order", $id_order);

            //print_r($order);
            SessionUtils::store("check", true);
        } //else print("Order juz jest");

        //print($this->transfer->id_user);

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
                /*print_r(App::getDB()->debug()->insert("order_items", [
                            "id_order" => $this->form->id_order,
                            "id_product" => $this->form->id_product,
                            "quantity" => $this->form->quantity
                ]));*/
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas wprowadzania rekordów');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        }else Utils::addErrorMessage('Nie można wprowadzić pustych wartości');

        //print_r($this->form);



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

        App::getSmarty()->assign('page_title', 'Panel Administratora');
        App::getSmarty()->display('OrderView.tpl');
    }

}
