<?php

include('../.views/header.php');

require_once('../.class/acl.class.php');
require_once('../.class/model.class.php');
require_once('../.class/patient.class.php');
require_once('../.class/note.class.php');


if($staff->permissions()->has('VIEW_PATIENT_MEDICAL', 'name')==false){
    echo '<div class="alert alert-danger"><center>';
    echo 'Sorry, you do not have permission to access this resource.';
    echo '</center></div>';
    die;
}


$patient = new patient();


if($patient->getCurrentPatient()){
	$patient->notes();
	$all_notes = $patient->notes()->get();

	
}else 
{
	header('Location: /patient/patient-list.php');
}
  


?>
<div class="container-fluid">
<a href="patient-profile.php?patient=<?=$patient->id();?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Go Back</a>
<hr/>
	<div class="row">	 
		<div class="col-md-8">
		<h3>Note List</h3>
		<?php
		if ($all_notes){
		foreach($all_notes as $note){
	
			echo '	<div class="panel panel-default">';
			echo '		<div class="panel-body">';
			echo '<strong>'.$note->date."</strong>&nbsp;&nbsp;&nbsp;";
			echo $note->description;
			//check if there are any images related to this note!
			$are_there_images = $note->relatedImages()->get();
			if($are_there_images){
			echo '<a class="pull-right" href="notes-images.php?note_id='.$note->id().'">See more &nbsp;<span class="glyphicon glyphicon-picture"></span></a>';
			}
			echo '  	</div>';
			echo '  </div>';
	
		}
		}else {
			echo "<p class='bg-info'><strong>There are not any notes for $patient->first_name</strong></p>";
		}
		?>
		</div>
	</div>
</div>
<?php
include('../.views/footer.php');
?>
