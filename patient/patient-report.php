<?php
require_once('../.class/acl.class.php');
require_once('../.class/model.class.php');
require_once('../.class/patient.class.php');
require_once('../.class/note.class.php');
require_once('../.class/staff.class.php');
$staff = new staff();
if($staff->authenticated()==false && $_SERVER['PHP_SELF']!='/login.php'){
	header("Location: /login.php");
	die();
}
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
  

/* The Generator starts reading here. */
ob_start();
?>

<style type="text/css">
ul{list-style-type: none;}
ol{margin-left:30px;}
.row{ width:160mm; margin: 10mm;  padding:10px;}
.col-md-12{width: 80%; padding-top:100mm; }
 
.title{font-weight:900; }
li{padding-top:20px;}
h5{margin-left:100mm;}
</style>
<page>
<div class="container-fluid">
<hr/>
	<div class="row">	 
		<div class="col-md-12">
			<h1>Patient Profile - <? echo $patient->first_name." ".$patient->last_name;?></h1>
			<h4><?php echo date("d-m-Y") . "<br>";?></h4>
		</div>
		<div class="col-md-8">
			<ul class="list-group">
				<li class="title"><h3>Personal Information</h3></li>
				<li class="list-group-item"><strong>First Name:</strong> <?=$patient->first_name;?></li>
				<li class="list-group-item"><strong>Middle Name:</strong> <?=$patient->middle_name;?></li>
				<li class="list-group-item"><strong>Last Name:</strong> <?=$patient->last_name;?></li>
				<li class="list-group-item"><strong>Gender:</strong> <?=$patient->gender;?></li>
				<li class="list-group-item"><strong>Date of Birth:</strong> <?=$patient->date_of_birth;?></li>
			</ul>
			<ul class="list-group">
				<li class="list-group-item active"><h3>Health Cover Details</h3></li>
				<li class="list-group-item"><strong>Private Health Organisation:</strong> <?=$patient->priv_health_org;?></li>
				<li class="list-group-item"><strong>Private Health Number:</strong> <?=$patient->priv_health_num;?></li>
				<li class="list-group-item"><strong>Medicare Number:</strong> <?=$patient->medicare;?></li>
				<li class="list-group-item"><strong>Medicare Reference:</strong> <?=$patient->medicare_ref;?></li>
				<li class="list-group-item"><strong>Medicare Expiration:</strong> <?=$patient->medicare_exp;?></li>
			</ul>
		 
			<ul class="list-group">
				<li class="list-group-item active"><h3>Contact Information</h3></li>
				<li class="list-group-item"><strong>Home Phone:</strong> <?=$patient->home_phone;?></li>
				<li class="list-group-item"><strong>Mobile Phone:</strong> <?=$patient->mobile_phone;?></li>
				<li class="list-group-item"><strong>Address:</strong> <?=$patient->address;?></li>
				<li class="list-group-item"><strong>Email: </strong><?=$patient->email;?></li>
			</ul>
			<ul class="list-group">
				<li class="list-group-item active"><h3>Next of Kin</h3></li>
				<li class="list-group-item"><strong>First Name:</strong> <?=$patient->nok_first_name;?></li>
				<li class="list-group-item"><strong>Last Name:</strong> <?=$patient->nok_last_name;?></li>
				<li class="list-group-item"><strong>Home Phone:</strong> <?=$patient->nok_home_phone;?></li>
				<li class="list-group-item"><strong>Mobile Phone:</strong> <?=$patient->nok_mobile_phone;?></li>
				<li class="list-group-item"><strong>Address:</strong> <?=$patient->nok_address;?></li>
				<li class="list-group-item"><strong>Relationship:</strong> <?=$patient->nok_relationship;?></li>
			</ul>
		</div>
		 <br/><br/><br/>
		<div class="col-md-10">
		
		<?php
		echo '	<div class="col-md-8">';
		echo '  <h3>Note List</h3>';
		echo ' 	<ul class="list-group">';
		if ($all_notes){
		foreach($all_notes as $note){
	
			
		 	echo '<li>'; 
			echo '<strong>'.$note->date."</strong>&nbsp;&nbsp;&nbsp;";
			echo $note->description."<br/><br/><br/>";
			//check if there are any images related to this note!
			$are_there_images = $note->relatedImages()->get();
			if($are_there_images){
			echo '<ol>';
			foreach($are_there_images as $image_note){
				echo '<li><img src="'.$image_note->name_location.'" width=200 height=200/></li>';
			
			}
			echo '</ol>';
			}
			echo '</li>';
			
	
		}
		}else {
			echo "<p class='bg-info'><strong>There are not any notes for $patient->first_name</strong></p>";
		}
		echo '  </ul>';
		echo '  </div>';
		?>	
		</div>
		
	</div>
</div>
</page>
<?php
    $content = ob_get_clean();
	require_once('../pdf/html2pdf.class.php');
    
	try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('radius.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
	
include('../.views/footer.php');
?>
