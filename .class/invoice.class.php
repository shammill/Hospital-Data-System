<?php

require_once('billable.class.php');
require_once('model.class.php');

class invoice extends model{

    public $status = 0;
    public $medicare_provided = 0;
    public $patient_id = 0;

    protected $fields = array('status', 'medicare_provided', 'patient_id');

    static $table = "invoice";

    public function items(){
        return new manytomany_link($this, 'billable', 'invoice_items');
    }

    //This function uses the get parameter PATIENT to load the patient into the current model
    public function getCurrentInvoice(){
        if(isset($_GET['invoice'])==true){
            $this->load($_GET['invoice']);
            return true;
        }
        return false;
    }

}