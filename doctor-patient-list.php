<?php
require_once('.class/acl.class.php');
require_once('.class/staff.class.php');
require_once('.class/patient.class.php');
require_once('.class/model.class.php');

include(".views/header.php");

$patient = new patient();

 

$patients = $staff->assigned()->get();
echo "<div class='container'>";
echo "<strong>Your patients so far:</strong><br/>";
foreach ($patients as $patient){
	echo "<a href='http://localhost/patient/patient-profile.php?patient=".$patient->id()."'>$patient->first_name</a><br/>";
	}
echo '</div>';

 

?>
<?PHP include(".views/footer.php"); ?>
