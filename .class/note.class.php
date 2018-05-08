<?php
require_once('model.class.php');

class note extends model{

    public $description="";
    public $date="";
	public $staff_id="";

    static $table = "notes";
    protected $fields= array('description', 'date' , 'staff_id' );

	public function relatedImages(){
	//image is the actual name of the table
		return new onetomany_link($this, 'image' , 'image');
	}
	
	public function getCurrentNote(){
		if(isset($_GET['note_id'])==true){
			$this->load($_GET['note_id']);
			return true;
		}
		return false;
	}
	
	
}

class image extends model{

	public $name_location="";
	public $note_id="";
	
	static $table="image";
	protected $fields=array('name_location', 'note_id');	
	
	public function generateName($note_date, $tmp_name){
		return "picture-".$tmp_name."-".$note_date;
	}
}


?>
