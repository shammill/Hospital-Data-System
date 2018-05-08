<?php


require_once('../.class/acl.class.php');
require_once('../.class/model.class.php');
require_once('../.class/patient.class.php');
require_once('../.class/note.class.php');

$patient = new patient();
if(!$patient->getCurrentPatient()){
	header('Location: /patient/patient-list.php');
} 

include('../.views/header.php');

if($staff->permissions()->has('VIEW_PATIENT_MEDICAL', 'name')==false){
    echo '<div class="alert alert-danger"><center>';
    echo 'Sorry, you do not have permission to access this resource.';
    echo '</center></div>';
    die;
}

?>
<div class="container-fluid">
<a href="patient-list.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Go Back</a>
<hr/>
	<div class="row">	 
		<div class="col-md-12">
			<h2>Patient Profile</h2>
		</div>
		<div class="col-md-2">
			<a href="insert-notes.php?patient=<?=$patient->id();?>" class="btn btn-primary">Insert Notes</a>											   
			<a href="patient-notes.php?patient=<?=$patient->id();?>" class="btn btn-primary">See Notes</a>
			<a href="patient-report.php?patient=<?=$patient->id();?>" class="btn btn-primary">Generate Report</a>
			<a href="invoices/create.php?patient=<?=$patient->id();?>" class="btn btn-primary">Generate Invoice</a>
			<a href="patient-invoice.php?patient=<?=$patient->id();?>" class="btn btn-primary">Generate Invoice PDF</a>
			
		</div>        
		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item active">Personal</li>
				<li class="list-group-item">First Name: <?=$patient->first_name;?><a href="#" data-db-table="patients" data-db-field="first_name" data-patient-id="<?=$patient->id();?>" class="api-edit-field"><span class="glyphicon glyphicon-pencil"></span></a></li></li>
				<li class="list-group-item">Middle Name: <?=$patient->middle_name;?><a href="#" data-db-table="patients" data-db-field="middle_name" data-patient-id="<?=$patient->id();?>" class="api-edit-field"><span class="glyphicon glyphicon-pencil"></span></a></li></li>
				<li class="list-group-item">Last Name: <?=$patient->last_name;?><a href="#" data-db-table="patients" data-db-field="last_name" data-patient-id="<?=$patient->id();?>" class="api-edit-field"><span class="glyphicon glyphicon-pencil"></span></a></li></li>
				<li class="list-group-item">Gender: <?=$patient->gender;?><a href="#" data-db-table="patients" data-db-field="gender" data-patient-id="<?=$patient->id();?>" class="api-edit-field"><span class="glyphicon glyphicon-pencil"></span></a></li>
				<li class="list-group-item">Date of Birth: <?=$patient->date_of_birth;?></li>
			</ul>
			<ul class="list-group">
				<li class="list-group-item active">Health Cover</li>
				<li class="list-group-item">Private Health Organisation: <?=$patient->priv_health_org;?></li>
				<li class="list-group-item">Private Health Number: <?=$patient->priv_health_num;?></li>
				<li class="list-group-item">Medicare Number: <?=$patient->medicare;?></li>
				<li class="list-group-item">Medicare Reference: <?=$patient->medicare_ref;?></li>
				<li class="list-group-item">Medicare Expiration: <?=$patient->medicare_exp;?></li>
			</ul>
		</div>
		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item active">Contact</li>
				<li class="list-group-item">Home Phone: <?=$patient->home_phone;?><a href="#" data-db-table="patients" data-db-field="home_phone" class="api-edit-field"><span class="glyphicon glyphicon-pencil"></span></a></li></li>
				<li class="list-group-item">Mobile Phone: <?=$patient->mobile_phone;?></li>
				<li class="list-group-item">Address: <?=$patient->address;?></li>
				<li class="list-group-item">Email: <?=$patient->email;?></li>
			</ul>
			<ul class="list-group">
				<li class="list-group-item active">Next of Kin</li>
				<li class="list-group-item">First Name: <?=$patient->nok_first_name;?></li>
				<li class="list-group-item">Last Name: <?=$patient->nok_last_name;?></li>
				<li class="list-group-item">Home Phone: <?=$patient->nok_home_phone;?></li>
				<li class="list-group-item">Mobile Phone: <?=$patient->nok_mobile_phone;?></li>
				<li class="list-group-item">Address: <?=$patient->nok_address;?></li>
				<li class="list-group-item">Relationship: <?=$patient->nok_relationship;?></li>
			</ul>
		</div>
	</div>
</div>

<script>
$(".glyphicon glyphicon-pencil").on("click", function (){
$( this ).text()
});
</script>
<?php
include('../.views/footer.php');
?>
