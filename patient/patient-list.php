<?php
 
require_once("../.class/acl.class.php");
require_once("../.class/model.class.php");
require_once("../.class/patient.class.php");
require_once("../.class/note.class.php");



$patient = new patient();
$next_page = "patient-profile.php";	 
$all_patients = $patient->all();
 
 
include("../.views/header.php");
?>
<div class="container-fluid">
 
            <h3>Patients list</h3>
			<input class="form-control search" id="search-patients"/>
              <div id="patient-list">
	
<?php

foreach($all_patients as $patient){
echo '<div class="panel panel-default floating-table">';
echo '  <div class="panel-body">';
echo "		<a href='".$next_page."?patient=".$patient->id()."' >".$patient->first_name. " " .$patient->last_name."</a>";
echo '  </div>';
echo '</div>';
}
?>

</div>
				 
   
</div>
<script>
	results = []
	$(document).ready(function(){
		results = api.getpatients();
	})
	$("#search-patients").keyup(function(){
		$("#patient-list").html("")
		data = $(this).val()
		console.log(data);
		for (result in results){
			if (results[result].first_name.toLowerCase().search(data.toLowerCase()) != -1){
				console.log(results[result].id)
				$("#patient-list").append('<div class="panel panel-default floating-table"><div class="panel-body"><a href="patient-profile.php?patient='+results[result].id+'" >'+results[result].first_name+" "+results[result].last_name+'</a>');
			}
		}
	})
</script>
<?PHP include("../.views/footer.php"); ?>



