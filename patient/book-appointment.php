<?PHP

require_once('../.class/staff.class.php');
require_once('../.class/patient.class.php');
include('../.views/header.php');

if($staff->permissions()->has('ASSIGN_PATIENT_TO_STAFF', 'name')==false){
    echo '<div class="alert alert-danger"><center>';
    echo 'Sorry, you do not have permission to access this resource.';
    echo '</center></div>';
    die;
}
?>

<div class="container-fluid" id="login-page">
	<form method="post" role="form" id="booking">
		<h2>Book an Appointment </h2><br/><br/>
		<div class="form-group ">
			<p>Current Patient Here</p>
			<label for="doctor">Doctor:</label>
			<select class="form-control" name="doctor" >
				<option>Dr. Jhonson</option>
				<option>Dr. KKK</option>
				<option>Dr. Chen</option>
				<option>Dr. Chin</option>
			</select><br/>

			<label for="type">Type:</label>
			<div class="radio">
				<input type="radio" name="booking-type" value="normal" checked="checked">Normal<br/>
				<input type="radio" name="booking-type" value="transfer">Transfer<br/>
				<input type="radio" name="booking-type" value="emergency">Emergency<br/><br/>
			</div>
			
			<label for="datetime">Date and Time:</label>
			<input type="datetime-local" name="date" placeholder="Repeat New" class="form-control"><br/>
			<hr/>
			<input type="submit" value="Submit" class="btn btn-primary">
		</div>
	</form>
</div>
<?php
include('../.views/footer.php');?>