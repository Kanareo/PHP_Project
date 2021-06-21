<?php

namespace app\controllers;

use core\App;
use app\forms\ShopCartForm;
use core\Utils;
use core\ParamUtils;
use core\RoleUtils;
use core\SessionUtils;

class CartCtrl{
    
    private $form;

    public function __construct() {
        $this->form = new ShopCartForm();
    }
    
    public function action_cartAdd() {
        
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
    
    public function action_cartSave() {
        
        $this->form->id_product = ParamUtils::getFromCleanURL(1);
        $this->form->quantity = ParamUtils::getFromRequest('quantity');
        $user = SessionUtils::loadObject("user", true);
        
        try {
                $id_order = App::getDB()->get("orders","id_order",[
                    "ORDER" => ["id_order" => "DESC"]
                ]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        
        //if(null == SessionUtils::load("check", true)) SessionUtils::store("check", true);  
        
        if(null == SessionUtils::load("check", true)){
            SessionUtils::store("check", true);
            
            try {
            $price = App::getDB()->get("products","product_price",[
                "id_product" => $this->form->id_product
            ]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }

            if($user == "employee") {$this->form->discount = 0.1;}
            else {$this->form->discount = 0;}

            $this->form->combined_price = $this->form->quantity * $price * (1 - $this->form->discount);    

            $this->form->id_order = $id_order + 1;
            print_r("Order id: " . $id_order . " ");

            try {
                $id_user = App::getDB()->get("users","id_user",[
                    "email[=]" => $user->login
                ]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }

            //print_r("Uzytkownik id: " . $id_user);

            try {
                    App::getDB()->insert("orders",
                            [
                                "id_user" => $id_user,
                                "order_status" => "Przetwarzanie",
                                "order_date" => date("Y-m-d")
                            ]);
                    /*print_r(App::getDB()->debug()->insert("users",
                            [
                                "id_user" => $id_user,
                                "order_status" => "Przetwarzanie",
                                "order_date" => date("Y-m-d")
                            ]));*/
                } catch (\PDOException $e) {
                    Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                    if (App::getConf()->debug)
                        echo($e);
                        //Utils::addErrorMessage($e->getMessage());
                }
                
                //print_r($this->form);
            
            try {
                    App::getDB()->insert("order_items",
                            [
                                "id_order" => $this->form->id_order,
                                "id_product" => $this->form->id_product,
                                "quantity" => $this->form->quantity,
                                "combined_price" => $this->form->combined_price,
                                "discount" => $this->form->discount
                            ]);
                    /*print_r(App::getDB()->debug()->insert("order_items",
                            [
                                "id_order" => $this->form->id_order,
                                "id_product" => $this->form->id_product,
                                "quantity" => $this->form->quantity,
                                "combined_price" => $this->form->combined_price,
                                "discount" => $this->form->discount
                            ]));*/
                } catch (\PDOException $e) {
                    Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                    if (App::getConf()->debug)
                        echo($e);
                        //Utils::addErrorMessage($e->getMessage());
                }
                
        }else {
            
            $this->form->id_order = $id_order;
            
            try {
            $price = App::getDB()->get("products","product_price",[
                "id_product" => $this->form->id_product
            ]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            } 

            if($user == "employee") {$this->form->discount = 0.1;}
            else {$this->form->discount = 0;}

            $this->form->combined_price = $this->form->quantity * $price * (1 - $this->form->discount);    

            try {
                $id_user = App::getDB()->get("users","id_user",[
                    "email[=]" => $user->login
                ]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
            
            //print_r($this->form);
            
            try {
                    App::getDB()->insert("order_items",
                            [
                                "id_order" => $this->form->id_order,
                                "id_product" => $this->form->id_product,
                                "quantity" => $this->form->quantity,
                                "combined_price" => $this->form->combined_price,
                                "discount" => $this->form->discount
                            ]);
                    /*print_r(App::getDB()->debug()->insert("order_items",
                            [
                                "id_order" => $this->form->id_order,
                                "id_product" => $this->form->id_product,
                                "quantity" => $this->form->quantity,
                                "combined_price" => $this->form->combined_price,
                                "discount" => $this->form->discount
                            ]));*/
                } catch (\PDOException $e) {
                    Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                    if (App::getConf()->debug)
                        echo($e);
                        //Utils::addErrorMessage($e->getMessage());
                }
        }
        App::getRouter()->redirectTo("browser");   
    }
    
    public function generateView() {

        App::getSmarty()->assign('page_title', 'Wyszukiwarka produktów');
        //App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('CartAddView.tpl');
    }
}
