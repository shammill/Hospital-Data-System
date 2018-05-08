<?php

include('../.views/header.php');

require_once('../.class/acl.class.php');
require_once('../.class/model.class.php');
require_once('../.class/patient.class.php');
require_once('../.class/note.class.php');

$patient = new patient();
$image = new image();
$note = new note();

if($note->getCurrentNote()){
	
	$all_images = $note->relatedImages()->get();


	
}else 
{
	header('Location: /patient/patient-list.php');
}
  


?>
<div class="container-fluid">

<a href="javascript:history.go(-1)" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Go Back</a>
<hr/>
	<div class="row">	 
		<div class="col-md-8">
		<h3>Note List</h3>
		<?php
		if ($all_images){
		foreach($all_images as $image){
	
			echo '	<div class="panel panel-default">';
			echo '		<div class="panel-body">';
			echo '<img class="img-thumbnail" src="'.$image->name_location.'"/>';
			echo '  	</div>';
			echo '  </div>';
	
		}
		}else {
			echo "<p class='bg-info'><strong>There are not any images for $note->description</strong></p>";
		}
		?>
		</div>
	</div>
</div>
<?php
include('../.views/footer.php');
?>
