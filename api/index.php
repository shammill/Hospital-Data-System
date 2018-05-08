<?php
ini_set("display_errors", 1);
define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);
require_once(ABSPATH.'/.class/staff.class.php');
$staff = new staff();
if($staff->authenticated()==true){
    if(isset($_REQUEST['q'])){
	   $q = $_REQUEST['q'];
	   switch($q){
            case 'staff':
                echo json_encode(database::getQueryResults("select id, firstname, lastname, email from staff"));
                break;
            case 'patients':
                echo json_encode(database::getQueryResults("select id, first_name, middle_name, last_name, gender from patients"));
                break;			
            default:
                echo "not a valid query.";
       }
	}else{
        require_once(ABSPATH.'/.class/patient.class.php');
        $patient = new patient();
        $patient->getCurrentPatient();
        echo $patient->first_name;

        $table = $_POST['table'];
        $col = $_POST['field'];
        $data = $_POST['inp'];
        if($col == 'id' || $col == 'password' || $col == 'role_id' || $col == 'password_reset'){
            die('unacceptable input.');   
        }        
        if($table == 'staff'){
            $staff->$col = $data;
            $staff->save();
        }
        if($table == 'patients'){
            $patient->$col = $data;
            $patient->save();
        }
    }
}

?>