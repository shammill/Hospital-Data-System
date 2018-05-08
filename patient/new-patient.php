<?php

require_once('../.class/patient.class.php');
include("../.views/header.php");

if($staff->permissions()->has('CREATE_PATIENT', 'name')==false){
    echo '<div class="alert alert-danger"><center>';
    echo 'Sorry, you do not have permission to access this resource.';
    echo '</center></div>';
    die;
}

$new_patient = new patient();

if ($_POST) {
	
	$new_patient->loadFromPost();
	$new_patient->save();
	
	echo '<div class="alert alert-success"><center>';
	echo 'New patient successfully added.';
	echo '</center></div>';
}

?>
<!--CSS -->
 <div class="container-fluid" id="patient-page">
	<form name="create" method="post" role="form">
		<h2>Add Patient</h2>
		<div class="form-group">
			<h4>Personal</h4>
			<div class="row">
				<div class="col-md-6"><input type="text" name="first_name" placeholder="First Name" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="text" name="middle_name" placeholder="Middle Name" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="text" name="last_name" placeholder="Last Name" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="date" name="date_of_birth" placeholder="Date of Birth" class="form-control" value=""><br/></div>
				<div class="col-md-6"><select name="gender" class="form-control">
										<option value="Male" class="form-control">Male</option>
										<option value="Female" class="form-control">Female</option>
									  </select><br/></div>
			</div>
			
			<h4>Contact</h4>
			<div class="row">
				<div class="col-md-6"><input type="text" name="home_phone" placeholder="Home Phone Number" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="text" name="mobile_phone" placeholder="Mobile Phone Number" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="text" name="address" placeholder="Address" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="text" name="email" placeholder="Email" class="form-control" value=""><br/></div>
			</div>
				
			<h4>Health Cover</h4>
			<div class="row">
				<div class="col-md-6"><input type="text" name="priv_health_org" placeholder="Private Health Organisation" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="text" name="priv_health_num" placeholder="Private Health Number" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="text" name="medicare" placeholder="Medicare Number" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="text" name="medicare_ref" placeholder="Medicare Reference Number" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="date" name="medicare_exp" placeholder="Medicare Expiry Date" class="form-control" value=""><br/></div>
			</div>
				
			<h4>Next of Kin</h4>
			<div class="row">
				<div class="col-md-6"><input type="text" name="nok_first_name" placeholder="First Name" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="text" name="nok_last_name" placeholder="Last Name" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="text" name="nok_home_phone" placeholder="Home Phone Number" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="text" name="nok_mobile_phone" placeholder="Mobile Phone Number" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="text" name="nok_address" placeholder="Address" class="form-control" value=""><br/></div>
				<div class="col-md-6"><input type="text" name="nok_relationship" placeholder="Relationship" class="form-control" value=""><br/></div>
			</div>
						
			
			<input type="submit" value="Create Patient" class="btn btn-primary">
		</div>
	</form>
</div>
<?php 
include("../.views/footer.php");
?>