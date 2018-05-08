<?php
require_once('../.class/acl.class.php');
require_once('../.class/model.class.php');
require_once('../.class/patient.class.php');
require_once('../.class/note.class.php');

$patient = new patient(); //Get the current patient by ID

if(!$patient->getCurrentPatient()){
	header('Location: /patient/patient-list.php');
}

include('../.views/header.php');

if($staff->permissions()->has('UPDATE_PATIENT_MEDICAL', 'name')==false){
    echo '<div class="alert alert-danger"><center>';
    echo 'Sorry, you do not have permission to access this resource.';
    echo '</center></div>';
    die;
}


//Success and message variables
$success="";
$successImg="";
$msg="";

//Check the post variables exist
if($_POST && isset($_POST['description']) && isset($_POST['staff_id']) && isset($_POST['patient_id'])){
	$note = new note();
	$note->description = $_POST['description'];
	$note->staff_id = $_POST['staff_id'];
	$today= getdate();
	$note->date = $today=$today['year']."-".$today['mon']."-".$today['mday'];
	
	//Save the note
	if($note->save()){
		$patient->notes()->add($note); //Add the note to the patient
		$success="alert alert-success";
		$msg="Note was added successfully";
	}else{
		$success="alert alert-danger";
		$msg="Unable to add note";
	}
	
	//uploal images
}
 
if(isset($_FILES['userfile'])){
		 
		$name_array = $_FILES['userfile']['name'];
		$tmp_name_array = $_FILES['userfile']['tmp_name'];
		$error_array = $_FILES['userfile']['error'];
		$size_array = $_FILES['userfile']['size'];
		
		
	for($i=0; $i < count($tmp_name_array); $i++){
			if($size_array[$i] != 0){
				$image = new image();
				move_uploaded_file($tmp_name_array[$i], "img/".$name_array[$i]);
				
				$image->name_location= "img/".$name_array[$i];	
				$image->note_id = $note->id();
				$image->save();
				$note->relatedImages()->add($image);
				$successImg="alert alert-success";		
			}
	}
 
} 
 

?>
<div class="container-fluid">
<a href="patient-profile.php?patient=<?=$patient->id();?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Go Back</a>
<hr/>
	<div class="row">
	<form method="post" name="form1" id="form1" enctype="multipart/form-data">
		<div class= "col-md-4 <?php echo $success;?>">
		<?php echo $msg;?>
			
			<fieldset>
				<h3>Add notes for <?=$patient->first_name." ".$patient->last_name;?> </h3>
					<input type="hidden"  name="staff_id" value="<?=$staff->id();?>"/> 
					<input type="hidden"  name="patient_id" value="<?=$patient->id();?>"/> 
					<textarea class="form-control" name="description" cols="100" rows="20" id="textarea" palceholder="Description"></textarea><br/>
					<!--<input type="file" class="form-control" name="fileField" id="fileField" value="Upload Image"><br/>-->
					<input type="hidden" class="form-control" name="date">
					<hr/>
					 
			
		</div>
		<div class= "col-md-4 <?php echo $successImg;?>">
				  <h3>Insert pictures (x-rays)</h3>
					 <input class="form-control" type="hidden" name="MAX_FILE_SIZE" value="30000000" />
				 
				   <input class="form-control" name="userfile[]" type="file" /> <br/>
				  
				  <!--<input name="userfile[]" type="file" /><br />-->
				  
				  <input type="button" id="theButton" class="btn btn-default" value="more fields"/>
					<hr/>
					<input type="submit" class="btn btn-primary" value="Add notes">
			</fieldset>
			
		
		</div></form>
	</div>
</div>

<script  type="text/javascript">
	var counter=0;
	$(document).ready(function(){
		$("#theButton").on("click", function(){
		counter++;
		if (counter<10){
			$( "input:button" ).last().before('  <input class="form-control" name="userfile[]" type="file" /> <br/>');
		}else{
			alert("Unfortunately there is a limit of 10 images per note! ");
		}
		});
	});

</script>
<?php
include('../.views/footer.php');
?>
