<?php

//Database class, used for all connection maintenance
class Database
{

    private static $Instance; //Creating an instance so we don't open multiple connections

    public $connection; //Store any connection
    private $dsn; //The data source name
    private $dbUser; //The data user
    private $dbPass; //The data pass

    //Automatically connect on construction
    private function __construct()
    {
        //Connection parameters for the liver server
        $this->dsn = 'mysql:dbname=clarensw_inb201;dbHost=localhost';
        $this->dbUser = 'clarensw_admin';
        $this->dbPass = 'qwerty()';

        //Connection parameters for Michaels local server
        if($_SERVER['SERVER_ADMIN']=='michael@mjth.org'){
            $this->dsn = 'mysql:dbname=inb201;dbHost=localhost';
            $this->dbUser = 'root';
            $this->dbPass = 'root';
        }
        //Connection parameters for Harry's local server
        if($_SERVER['SERVER_ADMIN']=='webmaster@localhost'){
            $this->dsn = 'mysql:dbname=clarensw_inb201;dbHost=localhost';
            $this->dbUser = 'root';
            $this->dbPass = 'root';
        }
        //Connect to the database
        $this->connection = new PDO($this->dsn,$this->dbUser,$this->dbPass);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
	public static function getQueryResults($sql){
		$db = database::getInstance(); 
		$result = $db->connection->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
	}
    //Check whether an instance is running, if not, create a new one
    public static function getInstance()
    {
        if(empty(self::$Instance))
        {
            try
            {
                self::$Instance = new Database();
            }
            catch (PDOException $e)
            {
                self::logAndDestroy($e);
            }
        }
        return self::$Instance;
    }

    //Get the last inserted ID
    public function lastInsertId(){
        return $this->connection->lastInsertId();
    }

    //On close, destroy the instance
    public function __destruct()
    {
        $Instance = self::$Instance;
        unset($Instance);
    }

    //Log a database error to the error log
    public static function log($e){
        $error = 'Database ERROR: LN:'.$e->getLine().':'.$e->getCode().':'.$e->getMessage();
        error_log($error);
        return $error;
    }

    //Log and redirect to the 500 page.
    public static function logAndDestroy($e){
        $error = self::log($e);
        //REMOVEFORFINAL url encoding
        if(isset($_GET['err'])){
            echo $error;
            die;
        }
        header('Location: /500?error='.urlencode($error));
        die;
    }

}
?>
