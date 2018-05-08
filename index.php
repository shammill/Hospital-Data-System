<?php
include(".views/header.php");
?>

<style>

</style>
<div class="container-fluid">
	<div class="col-md-4">
		<ul>
			<li class="list-group-item active">Actions</li>
			    <li class="list-group-item"><a href="report.php">Create Report</a></li>
                <li class="list-group-item"><a href="patient/patient-list.php">View Patients</a></li>
            <?php if($staff->permissions()->has('CREATE_STAFF', 'name')){ ?>
			    <li class="list-group-item"><a href="create.php">New Staff</a></li>
            <?php } if($staff->permissions()->has('CREATE_PATIENT', 'name')){ ?>
			    <li class="list-group-item"><a href="patient/new-patient.php">New Patient</a></li>
            <?php } if($staff->permissions()->has('CREATE_RESOURCE', 'name')){ ?>
			    <li class="list-group-item"><a href="resources/create.php">Create Resource</a></li>
            <?php } if($staff->permissions()->has('UPDATE_PATIENT_MEDICAL', 'name')){ ?>
                <li class="list-group-item"><a href="resources/index.php">View Resources</a></li>
            <?php } if($staff->permissions()->has('MANAGE_PERMISSIONS_TO_ROLE', 'name')){ ?>
                <li class="list-group-item"><a href="permissions/default.php">Manage Roles</a></li>
            <?php } if($staff->permissions()->has('MANAGE_PERMISSIONS_TO_ROLE', 'name')){ ?>
                <li class="list-group-item"><a href="permissions/user.php">Manage Permissions</a></li>
            <?php } if($staff->permissions()->has('MANAGE_PERMISSIONS_TO_ROLE', 'name')){ ?>
                <li class="list-group-item"><a href="billable/index.php">Create billable items</a></li>
			<?php } if($staff->permissions()->has('MANAGE_PERMISSIONS_TO_ROLE', 'name')){ ?>
                <li class="list-group-item"><a href="report.php">Create reports</a></li>
            <?php } ?>
		</ul>
	</div>
	<div class="col-md-8">
	
	    <div class="column">
	    
            <?php include(".dash-modules/time.php"); ?>
            <?php include(".dash-modules/quick-sql.php"); ?>
                	    
	    </div>
	    
	    <div class="column">
            
            <?php include(".dash-modules/messages.php"); ?>
            <?php include(".dash-modules/news.php"); ?>
             	    
	    </div>
	    
	    <div class="column">
            
            <?php include(".dash-modules/schedule.php"); ?>
            	 	    
	    </div>
<?php
//~ insert dash modules here
//include(".dash-modules/time.php");
//~ end dash modules
?>
    </div>
</div>

<script>
$(function() {
    $( ".column" ).sortable({
        connectWith: ".column",
        handle: ".portlet-header",
        cancel: ".portlet-toggle",
        placeholder: "portlet-placeholder ui-corner-all",
        start: function(e, ui){
            ui.placeholder.height(ui.item.height());
        }        
    });
    
    $( ".portlet-toggle" ).click(function() {
        var icon = $( this );
        icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
        icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
    });
});
</script>
<?php
include(".views/footer.php");
?>
