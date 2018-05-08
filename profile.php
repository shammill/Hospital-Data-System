<?php
include(".views/header.php");
?>
<div class="fluid-container">
    <div class="col-md-3">
        <!-- Side bar for user content -->
        <a class="thumbnail">
          <img data-src="js/holder.js/100%x300/sky">
        </a>
        
	    <ul class="list-group">
	        <li class="list-group-item active">About</li>
			<li class="list-group-item">Given Name: <?php echo $staff->firstname; ?><a href="#" data-db-table="staff" data-db-field="firstname" class="api-edit-field"><span class="glyphicon glyphicon-pencil"></span></a></li>
			<li class="list-group-item">Last Name: <?php echo $staff->lastname; ?><a href="#" data-db-table="staff" data-db-field="lastname" class="api-edit-field"><span class="glyphicon glyphicon-pencil"></span></a></li>
			<li class="list-group-item">Email: <?php echo $staff->email; ?><a href="#" data-db-table="staff" data-db-field="email" class="api-edit-field"><span class="glyphicon glyphicon-pencil"></span></a></li>
			<li class="list-group-item">Role: <?php echo $staff->role()->get()->role_name; ?></a></li>
			<li class="list-group-item"><a href="change-password.php">Change Password</a></li>
		</ul>          
    </div>
    
    <div class="col-md-9">
        <div class="well well-lg">
            
            <?php
                $CAL_events_file = "calendar/profile-events.php";            
                include("calendar/cal.php"); 
            ?>            

        </div>
    </div>
    <script>

</script>
</div>
<?php
include(".views/footer.php");
?>