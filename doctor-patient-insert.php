<?php
require_once('.class/acl.class.php');
require_once('.class/staff.class.php');
require_once('.class/patient.class.php');
require_once('.class/model.class.php');

include(".views/header.php");

$patient = new patient();

if($_POST && isset($_POST['patient_id']) ){
$patient_list = $_POST['patient_id'];
	
	foreach ($patient_list as $a){
		$patient = new patient($a);
		$success=$staff->assigned()->add($patient);	
	 
	}
	if($success){
		echo "Success!";
	}else{
		echo ":(";
	}
 }


$all_patients=$patient->all();
echo "<form method='post'>";
foreach ($all_patients as $patient){
	echo "<div class=\"panel panel-default\"><strong>Patient name:&nbsp;</strong>$patient->first_name <input type='checkbox' name='patient_id[]' value='".$patient->id()."'/><br/>		<div class=\"panel-body\"></div>  </div>";
	//echo "Name=$patient->first_name <input type='checkbox' name='patient_id[]' value='".$patient->id()."'/><br/>";
}
echo "<input type='submit' value='save'/>";
echo "</form>";
?>
<?PHP include(".views/footer.php"); ?>
