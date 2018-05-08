<?php
require_once('.class/acl.class.php');
require_once('.class/staff.class.php');
require_once('.class/model.class.php');

include(".views/header.php");
 

if($_POST && isset($_POST['nurses']) ){
$nurses_id = $_POST['nurses'];
	$current_nurses = $staff->getnurses();
	$current_nurses->removeAll();
	foreach ($nurses_id as $a){
		$nurse = new staff($a);
		$success=$current_nurses->add($nurse);	
	}
 	if($success){
		echo "Success!";
	}else{
		echo ":(";
	} 
 }

$nurses = new staff();
 
$nurse_role = new role(3);
$nurses = $nurse_role->staff()->get();
echo "<div class='container'>";
echo "<h3>List of nurses</h3>";
echo "<form method='post'>";
foreach ($nurses as $nurse){
	echo "<strong>- Nurse: </strong>".$nurse->firstname." ".$nurse->lastname." <input type='checkbox' name='nurses[]' value='".$nurse->id()."'/><br/>";
}
echo "<input type='submit' value='Save'/>";
echo "</form>";
echo "</div>"; 
 

 
?>
<?PHP include(".views/footer.php"); ?>
