<?php
require_once('.class/acl.class.php');
require_once('.class/staff.class.php');
require_once('.class/model.class.php');

include(".views/header.php");
 

 
$current_nurses = $staff->getnurses()->get();

echo "<div class='container'>";
echo "<h3>List of nurses allocated to <i>$staff->firstname, $staff->lastname </i> </h3>";

foreach ($current_nurses as $nurse){
	echo "<strong>- Nurse: </strong>".$nurse->firstname." ".$nurse->lastname." <input type='checkbox' name='nurses[]' value='".$nurse->id()."'/><br/>";
}

echo "</div>"; 
  
?>
<?PHP include(".views/footer.php"); ?>
