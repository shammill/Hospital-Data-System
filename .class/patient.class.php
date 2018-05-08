<?php
require_once('model.class.php');

class patient extends model{

	public $first_name="";
	public $middle_name="";
	public $last_name="";
	public $gender="";
	public $date_of_birth="";
	public $email="";
	public $home_phone="";
	public $mobile_phone="";
	public $address="";
	public $medicare="";
	public $medicare_ref="";
	public $medicare_exp="";
	public $priv_health_org="";
	public $priv_health_num="";
	public $nok_first_name="";
	public $nok_last_name="";
	public $nok_home_phone="";
	public $nok_mobile_phone="";
	public $nok_address="";
	public $nok_relationship="";
	
	
	static $table="patients";
	protected $fields = array('first_name','middle_name','last_name', 'gender', 'date_of_birth', 'email','home_phone','mobile_phone','address','medicare', 'medicare_ref', 'medicare_exp', 
							  'priv_health_org', 'priv_health_num', 'nok_first_name', 'nok_last_name', 'nok_home_phone', 'nok_mobile_phone', 'nok_address', 'nok_relationship');

    //Get patient notes using the link model
	public function notes(){
        return new onetomany_link($this, 'note');
	}

    //Get patient notes using the link model
    public function invoices(){
        return new onetomany_link($this, 'invoice');
    }

    //This function uses the get parameter PATIENT to load the patient into the current model
	public function getCurrentPatient(){
		if(isset($_REQUEST['patient'])==true){
			$this->load($_REQUEST['patient']);
			return true;
		}
		return false;
	}

    public function queue(){
        return new onetomany_link($this, 'resource_queue');
    }

}