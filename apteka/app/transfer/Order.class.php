<?php

namespace app\transfer;

class Order{
	public $id_user;
	public $order_status;
        public $order_date;
        public $delivery_date;
	
	public function __construct($id_user, $order_status, $order_date, $delivery_date){
		$this->id_user = $id_user;
                $this->order_status = $order_status;
                $this->order_date = $order_date;
                $this->delivery_date = $delivery_date;
	}	
}