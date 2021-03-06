<?php

namespace app\controllers;

use core\App;
use core\Pagination;
use app\forms\BrowserForm;
use core\Utils;
use core\ParamUtils;


class BrowserCtrl{
    
    private $records;
    public $recordsPerPage = 5;
    
    private $form;

    public function __construct() {
        $this->form = new BrowserForm();
    }
    
    public function loadBrowser(){
        
        $this->form->name = ParamUtils::getFromRequest('name');
        $this->form->brand = ParamUtils::getFromRequest('brand');
        $this->form->category = ParamUtils::getFromRequest('category');
        
        try {
            $brands = App::getDB()->select("brands", [
                "brand_name"
                    ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        App::getSmarty()->assign('brands', $brands);
        
        try {
            $categories = App::getDB()->select("categories", [
                "category_name"
                    ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        App::getSmarty()->assign('categories', $categories);
        
        
        $search_params = [];
        if (isset($this->form->name) && !empty($this->form->name)) {
            $search_params['product_name[~]'] = $this->form->name;
        }
        
        if (isset($this->form->brand) && !empty($this->form->brand)) {
            $search_params['brand_name[~]'] = $this->form->brand;
        }
        
        if (isset($this->form->category) && !empty($this->form->category)) {
            $search_params['category_name[~]'] = $this->form->category;
        }

        $num_params = sizeof($search_params);
        if ($num_params > 1) {
            $where = ["AND" => &$search_params];
        } else {
            $where = &$search_params;
        }
        
        $where ["ORDER"] = "id_product";
        
        $numRecords = 0;
        
        try {
            $numRecords = App::getDB()->count("products",['[><]brands'=>'id_brand', '[><]categories'=>'id_category'],'*', $where);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                echo($e);
                //Utils::addErrorMessage($e->getMessage());
        }
        
        if($numRecords > 0){
        
            $page = Pagination::getPages($numRecords, $this->recordsPerPage);
            $offset = $this->recordsPerPage * ($page - 1);
            $where ["LIMIT"] = [$offset,$this->recordsPerPage];

            try {
                $this->records = App::getDB()->select("products",['[><]brands'=>'id_brand', '[><]categories'=>'id_category'],'*', $where);
                //print_r(App::getDB()->debug()->select("products",['[><]brands'=>'id_brand', '[><]categories'=>'id_category'],'*', $where));
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                if (App::getConf()->debug)
                    echo($e);
                    //Utils::addErrorMessage($e->getMessage());
            }
            
            App::getSmarty()->assign('products', $this->records);
        }
        
        App::getSmarty()->assign('numRecords', $numRecords);
        App::getSmarty()->assign('form', $this->form);
        
    }
    
    public function action_browserData(){
         
        $this->loadBrowser();
        $this->generateView('BrowserViewData.tpl');
        
    }
    
    public function action_browser() {
        
        $this->loadBrowser();
        $this->generateView('BrowserViewFull.tpl');
        
    }
    
    public function generateView($page) {
        
        App::getSmarty()->display($page);
        
    }
}
