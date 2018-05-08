<?php
require_once('model.class.php');

class resource extends model{

    public $name = "";
    public $description = "";

    static $table = "resources";
    protected $fields= array("name", "description");

    public function queue(){
        return new onetomany_link($this, 'resource_queue');
    }

    public function children(){
        return new onetomany_link($this, 'resource', '', 'parent_resource_id');
    }

    public function type(){
        return new onetoone_link($this, 'resource_type');
    }

    public function allParents(){
        return $this->all(' WHERE parent_resource_id = 0');
    }

    public function getCurrentResource(){
        if(isset($_GET['resource'])==true){
            $this->load($_GET['resource']);
            return true;
        }
        return false;
    }
    
    public function getResourceId(){
        if($this->getCurrentResource()){
            return $_GET['resource'];
        }
    }
}

class resource_type extends model{

    static $table = "resource_types";
    protected $fields = array("name");

    public $name = "";

    public function resources(){
        return new onetomany_link($this, 'resource');
    }
}

class resource_queue extends model{

    public $entry_time = null;
    public $exit_time = null;

    static $table = "resource_queue";
    protected $fields= array('entry_time', 'exit_time','patient_id');

    public function staff(){
        return new onetoone_link($this, 'staff');
    }

    public function patient(){
        return new onetoone_link($this, 'patient');
    }

}

?>
