<?php

require_once('model.class.php');

class billable extends model{

    public $item = "";
    public $description = "";
    public $price = "";
    public $tax = "";
    public $medicare_price = "";
    public $medicare_tax = "";

    protected $fields = array('item', 'description', 'price', 'tax', 'medicare_price', 'medicare_tax');

    static $table = "billable";

    public function getCurrentBillableItem(){
        if(isset($_GET['billable'])==true){
            $this->load($_GET['billable']);
            return true;
        }
        return false;
    }
}