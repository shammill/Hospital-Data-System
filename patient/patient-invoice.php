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
body {
	font-size: 16px;
	font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
}
.bordered{
	display:block;
	width:400px;
	border: 1px dashed #E7E7E7;
	margin-bottom:10mm;
	}
.table{
	display:block;
	width:800px;
	border: 2px dashed #E7E7E7;

}	
th{ width: 25mm; height: 10mm; background-color:#E5E5E5; text-align:center;}
td{ width: 25mm; height: 10mm; border-top: 1px dashed #D5D2D2; text-align:center;}	
</style>
<page>
 <div class="content" >
  <hr/>
  <h1>Tax invoice </h1>
  
  <div class="bordered">
  <p>Patient Name: <? echo $patient->first_name." ".$patient->last_name;?></p>
  <p>Address: <? echo $patient->address;?></p>
  <p>Phone: <? echo $patient->home_phone;?></p>
  <p>&nbsp;</p>
  </div>
  <table class="table">
  <thead>
    <tr>
      <th>Item</th>
      <th>Description</th>
      <th>Price</th>
      <th>Tax</th>
      <th>Medicare Price</th>
      <th>Medicare Tax</th>
      <th>Total</th>
      </tr>
    </thead>
    <tr>
      <td>1</td>
      <td>Surgery services</td>
      <td>2000</td>
      <td>10</td>
      <td>1000</td>
      <td>0.5</td>
      <td>1000</td>     
    </tr>
    <tr>
      <td>2</td>
      <td>Pain killers</td>
      <td>50</td>
      <td>0.1</td>
      <td>0</td>
      <td>0</td>
      <td>50</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><strong>Subtotal</strong></td>
      <td>1050</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><strong>GST (10%)</strong></td>
      <td>105</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><strong>Total</strong></td>
      <td>1155</td>
    </tr>
  </table>
  <p>&nbsp; </p>
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



 