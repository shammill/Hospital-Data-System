<?php

include('../../.views/header.php');

require_once('../../.class/acl.class.php');
require_once('../../.class/model.class.php');
require_once('../../.class/patient.class.php');
require_once('../../.class/invoice.class.php');
require_once('../../.class/render.class.php');

/*
if($staff->permissions()->has('VIEW_PATIENT_INVOICE', 'name')==false){
    echo '<div class="alert alert-danger"><center>';
    echo 'Sorry, you do not have permission to access this resource.';
    echo '</center></div>';
    die;
}
*/

$patient = new patient();
if($patient->getCurrentPatient()){
    $all_invoices = $patient->invoices()->get();
}else{
    header('Location: /patient/patient-list.php');
    die;
}



?>
<div class="container-fluid">
    <a href="/patient/patient-profile.php?patient=<?=$patient->id();?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Go Back</a>
    <hr/>
    <a href="create.php?patient=<?=$patient->id();?>" class="btn btn-default">Click to create a new invoice</a><br/><br/>
    <div class="row">
        <div class="col-md-8">
            <h3>Patient List</h3>
            <?php
            if ($all_invoices){
                render::table($all_invoices,
                    array(
                        'ID' => '%id%',
                        'Status' => '%status%',
                        'Adminstrative' => '<a href="view.php?invoice=%id%">View Invoice</a>'
                    )
                );
            }else {
                echo "<p class='bg-info'><strong>There are not any invoices for $patient->first_name</strong></p>";
            }
            ?>
        </div>
    </div>
</div>
<?php
include('../../.views/footer.php');
?>
