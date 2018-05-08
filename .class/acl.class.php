<?php

require_once('model.class.php');

class role extends model{

    public $role_name = "";

    static $table = "rolelist";
    protected $fields = array('role_name');

    public function permissions(){
	//this->id() is it staff id?
        return new manytomany_link($this, 'permission', 'rolepermissions');
    }

	public function staff(){
	return new onetomany_link($this, 'staff');
	}

}

class permission extends model{

    public $name = "";
    public $description = "";

    static $table = "permissionlist";
    protected $fields = array('name', 'description');

}

?>
