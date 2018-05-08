<?php
include(".class/database.class.php");
include(".class/staff.class.php");
include(".views/header.php");
?>
<div class="container-fluid" id="login-page">
	<form name="create" method="post" role="form">
		<h2>Assign Staff</h2>
		<div class="form-group">
			<h3>Assign:</h3>
			<select class="form-control" name="assigner">
			<?php
				//Will need to be changed once class is changed
				$assigner = database::getQueryResults('select id, firstname, lastname from staff');
				foreach($assigner as $staff){
					echo '<option value="'.$staff['id'].'">'.$staff['firstname'].' '.$staff['lastname'].'</option>';
				}
			?>
			</select>
			<h3>To:</h3>
			</select>
			<select class="form-control" name="assignee">
			<?php
				//Will need to be changed once class is changed
				$assigner = database::getQueryResults('select id, firstname, lastname from staff');
				foreach($assigner as $staff){
					echo '<option value="'.$staff['id'].'">'.$staff['firstname'].' '.$staff['lastname'].'</option>';
				}
			?>
			</select>
			<hr/>
			<input type="submit" value="Assign" class="btn btn-primary">
		</div>
	</form>
</div>
<?php
include(".views/footer.php");
?>
