<?php

require_once('acl.class.php');
require_once('model.class.php');

class staff extends model{

    public $firstname = "";
    public $lastname = "";
    public $email = "";
    public $username = "";
    protected $password = "";
	public $password_reset="";
    static $table = "staff";
    protected $fields = array('firstname', 'lastname', "username", 'email', 'password', 'password_reset');

    //Check the session is started, if not start it
    public function __construct($id=0){
        parent::__construct($id);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    //Get all assigned patients
	public function assigned(){
        return new manytomany_link($this, 'patient', 'staffpatient');
	}
 	

	//Get Nurses assigned to this doctor
	public function getnurses(){
		return new manytomany_link($this, 'staff', 'doctornurse', 'staff_id','nurse_id');
	}


    public function role(){
        return new onetoone_link($this, 'role');
    }

    public function changeRole($role){
        //Delete current role
        $this->role()->remove();

        //Delete current permissions
        $this->permissions()->removeAll();

        //Create new role
        $this->role()->add($role);

        //Save new permissions
        foreach($role->permissions()->get() as $RolePermissions){
            $perm = $this->permissions()->add($RolePermissions);
        }
    }
 
	//Find a user by credentials instead of ID
    public function findByCredentials($username, $password){
        $db = database::getInstance();
        if($db === null){
            header('Location: /500');
            die;
        }

        try{
            $password = hash('sha512', $password); //Hash the password

            $stmt = $db->connection->prepare('SELECT id FROM '.static::$table.' WHERE username = :username AND password = :password LIMIT 1;');
            $stmt->bindParam('username', $username);
            $stmt->bindParam('password', $password);
            $stmt->execute();

            if($stmt->rowCount()==1){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->load($row['id']); //Load the found object
                return true;
            } else {
                return false;
            }
        }catch (PDOException $e){
            database::logAndDestroy($e);
        }
    }

    //Authenticate the user
    public function authenticate(){
        $_SESSION['user'] = $this->id;
    }

    //Check if their is a user authenticated
    //Careful with header links, should make this logout.php
    public function authenticated(){
        if(isset($_SESSION['user'])){
            if($this->load($_SESSION['user']) == false){
                header('Location: /logout.php');
                die;
            }
            return true;
        }
        return false;
    }

    //Deauthenticate a user
    public function deauthenticate(){
        unset($_SESSION['user']);
        session_destroy();
    }

    //Check if current password is variable
    public function matchPassword($password){
        if($this->password == hash('sha512', $password)){
            return true;
        }
        return false;
    }

    //Set a password field
    public function setPassword($password){
        $this->password = hash('sha512', $password);
    }

    //Generate a username from the user firstname, lastname and ID
    public function generateUsername(){
        $this->username = strtolower(substr($this->firstname,0,1).$this->lastname.$this->id());
    }

    //Generate a random password
    public function generate_pw(){
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = str_shuffle($alphabet);
        $pass = substr($pass, 0, 8);
        $this->setPassword($pass);
        return $pass; //turn the array into a string
    }

    //Link permissions to the staff
    public function permissions(){
        return new manytomany_link($this, 'permission', 'staffpermissions');
    }

    public function notes(){
        return new onetomany_link($this, 'note');
    }

    public function queue(){
        return new onetomany_link($this, 'resource_queue');
    }
}

?>
