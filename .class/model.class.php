<?php

//Require database class
require_once('database.class.php');

//Model class handles a particular object to save and delete
//The class should be extended for use!

class model{

    protected $id = 0; //The ID field of the relevant table!
    protected $fields = array(); //All the field names to load and save!
    static $table = ""; //The table name of the object

    //Load a certain ID on start!
    public function __construct($id=0){
        if($id != 0){
            $this->load($id);
        }
    }

    //Load a model using ID
    public function load($id){
        $db = database::getInstance(); //Get the database connection

        $sql = 'SELECT * FROM '.static::$table.' WHERE id = :id LIMIT 1;';
        try{
            $stmt = $db->connection->prepare($sql);
            $stmt->execute(array('id' => $id));
        }catch (PDOException $e){
            database::logAndDestroy($e);
        }

        if($stmt->rowCount() == 0){
            return false;
        }

        //Set the fields
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach($this->fields as $field){
            $this->$field = $row[$field];
        }

        $this->id = $id; //Set the current ID

        return true;
    }

    //Save all changes to the model
    public function save(){
        $db = database::getInstance();

        if($this->id==0){ //If the ID does not exist, insert this new field
            $sql = 'INSERT INTO '. static::$table .' ('.implode(',',$this->fields).') VALUES (';
            foreach($this->fields as $field){
                $sql .= ':'.$field.',';
            }
            $sql = rtrim($sql, ",").');';
        } else { //If the ID does exist, update the existing field
            $sql = 'UPDATE '. static::$table. ' SET ';
            foreach($this->fields as $field){
                $sql .= $field.'=:'.$field.',';
            }
            $sql = rtrim($sql, ",").' where id='.$this->id.';';
        }

        try{
            $stmt = $db->connection->prepare($sql);
            foreach($this->fields as $field){
                $stmt->bindParam($field, $this->$field);
            }
            $stmt->execute();
            if($this->id==0){ //Get the ID of the new object and save it
                $this->id = $db->connection->lastInsertId();
            }
            $this->id;
        }catch (PDOException $e){
            database::logAndDestroy($e);
        }

        return true;
    }

    //Load fields from $_POST parameters
    public function loadFromPost(){
        foreach($this->fields as $field){
            if(isset($_POST[$field])){
                $this->$field = $_POST[$field];
            }
        }
    }

    //Return this id
	public function id(){
       return $this->id;
   }

    public function group($field){
        $db = database::getInstance();
        return $db->getQueryResults('SELECT count('.$field.') AS count, '.$field.' FROM '.static::$table.' GROUP BY '.$field.' ORDER BY count DESC;');
    }

   //Load all current models
   public function all($end=''){
       $db = database::getInstance();
       $sql = "SELECT * FROM ".static::$table.$end.';';
       $result = $db->connection->query($sql);

       $models = array(); //To store all the models
       $classname = get_class($this);

       while($row = $result->fetch(PDO::FETCH_ASSOC)){
           $new = new $classname(); //Create a new model
           foreach($this->fields as $field){ //Fill the model
               if(isset($row['id'])){
                   $new->id = $row['id'];

               }
               $new->$field = $row[$field];
           }
           $models[] = $new; //Add the model to the store
       }

       return $models; //Return all models
   }

   //The Truncate Function, Remove all data from a table.
   //REMOVEFORFINAL
   public function truncate(){
	   $db = database::getInstance();
	   $sql = "Truncate ".static::$table.';';
	   $result = $db->connection->query($sql);
	   if($result){
			echo(" ".static::$table." table has been cleaned.");
	   }else {
			return null;
	   }
   }
}

class link{

    protected $current_model = null; //The current model passed as an object
    protected $new_model_name = null; //The new model passed as a name
    protected $joining_table = null; //The name of the table that joins the two (ManyToMany Only)

    protected $current_model_table = null; //The name of the table for the current model
    protected $new_model_table = null;//The name of the table for the new model

    protected $current_model_field = null;//The name of the field for the current model
    protected $new_model_field = null;//The name of the field for the new model


    public function __construct($current_model, $new_model_name, $joining_table='', $current_model_field='', $new_model_field=''){
        $this->current_model = $current_model;
        $this->new_model_name = $new_model_name;
        $this->joining_table = $joining_table;

        $this->current_model_table = $current_model::$table;
        $this->new_model_table = $new_model_name::$table;

        $this->current_model_field = get_class($this->current_model).'_id';
        $this->new_model_field = $this->new_model_name.'_id';

        if($current_model_field != ''){
            $this->current_model_field = $current_model_field;
        }
        if($new_model_field != ''){
            $this->new_model_field = $new_model_field;
        }
    }

    public function data($sql){
        try{
            $db = database::getInstance();
            return $db->connection->query($sql);
        }catch (PDOException $e){
            database::logAndDestroy($e);
        }
    }

    public function loadIntoModels($result){
        $models = array();
        while($row=$result->fetch(PDO::FETCH_BOTH)){
            $models[] = new $this->new_model_name($row[0]);
        }
        return $models;
    }

    public function get(){
        return array();
    }

    //Check whether the sub-model has a paritcular identifier
    public function has($identifier, $field=null){
        foreach($this->get() as $gotten){
            $check = ($field == null ? $gotten->id() : $gotten->$field); //If the field is null, use the current ID
            if($check == $identifier){
                return true;
            }
        }
        return false;
    }
}


class onetoone_link extends link{

    public function get(){
        $sql = "SELECT ".$this->new_model_field." as id FROM ".$this->current_model_table." WHERE id = ".$this->current_model->id().';';
        $result = $this->data($sql)->fetch(PDO::FETCH_ASSOC);
        $model = new $this->new_model_name($result['id']);
        return $model;
    }

    public function add($model){
        $sql = "UPDATE ".$this->current_model_table." SET ".$this->new_model_field." = ".$model->id()." WHERE id = ".$this->current_model->id().";";
        $this->data($sql);
        return true;
    }

    public function remove(){
        $db = database::getInstance();
        $sql = "UPDATE ".$this->current_model_table." SET ".$this->new_model_field." = 0 WHERE id = ".$this->current_model->id().";";
        $this->data($sql);
        return true;
    }

}

class onetomany_link extends link{

    public function get(){
        $sql = "SELECT id FROM ".$this->new_model_table.' WHERE '.$this->current_model_field.' = '.$this->current_model->id().';';
        return $this->loadIntoModels($this->data($sql));
    }

    public function add($model){
        $sql = 'UPDATE '.$this->new_model_table.' SET '.$this->current_model_field.' = '.$this->current_model->id().' WHERE id = '.$model->id().';';
        $this->data($sql);
        return true;
    }

    public function remove($model){
        $sql = 'UPDATE '.$this->new_model_table.' SET '.$this->current_model_field.' = 0 WHERE id = '.$model->id().';';
        $this->data($sql);
        return true;
    }

	public function removeAll(){
        $sql = 'UPDATE '.$this->new_model_table.' SET '.$this->current_model_field.' = 0 WHERE '.$this->current_model_field.' = '.$this->current_model->id().';';
        $this->data($sql);
        return true;
    }
    public function count(){
        $sql = "SELECT (id) as count FROM ".$this->new_model_table.' WHERE '.$this->current_model_field.' = '.$this->current_model->id().';';
        $row = $this->data($sql)->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }
}

class manytomany_link extends link{

    public function get(){
        $sql = "SELECT ".$this->new_model_field." FROM ".$this->joining_table." WHERE ".$this->current_model_field.' = '.$this->current_model->id().';';
		return $this->loadIntoModels($this->data($sql));
    }

    public function add($model){
        $sql = 'INSERT INTO '.$this->joining_table.' ('.$this->current_model_field.', '.$this->new_model_field.') VALUES ('.$this->current_model->id().', '.$model->id().');';
        $this->data($sql);
        return true;
    }

    public function remove($model){
        $sql = 'DELETE FROM '.$this->joining_table.' WHERE '.$this->new_model_field.' = '.$model->id().';';
        $this->data($sql);
        return true;
    }
    
	public function removeAll(){
        $sql = 'DELETE FROM '.$this->joining_table.' WHERE '.$this->current_model_field.' = '.$this->current_model->id().';';
        $this->data($sql);
        return true;
    }
    public function count(){
        $sql = "SELECT count(".$this->new_model_field.") as count FROM ".$this->joining_table." WHERE ".$this->current_model_field.' = '.$this->current_model->id().';';
        $row = $this->data($sql)->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }

}
?>