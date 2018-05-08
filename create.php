<?php

require_once('.class/staff.class.php');
require_once('.class/acl.class.php');
include('.views/header.php');

if($staff->permissions()->has('CREATE_STAFF', 'name')==false){
    echo '<div class="alert alert-danger"><center>';
    echo 'Sorry, you do not have permission to access this resource.';
    echo '</center></div>';
    die;
}

$new_staff_member = new staff();

if($_POST && isset($_POST['firstname']) && isset($_POST['lastname'])){

    $new_staff_member->loadFromPost(); //Load the new staff member from post data

    try {
        //Check firstname and lastname aren't blank
        if($new_staff_member->firstname == '' || $new_staff_member->lastname == ''){
            throw new Exception('<div class="alert alert-danger"><center>Please enter a first name and last name!</center></div>');
        }

        /*
         * //Check email is valid
        if(filter_var($new_staff_member->email, FILTER_VALIDATE_EMAIL) == false){
            throw new Exception('Please enter a valid email address');
        }
        */

        //Uppercase firstname and lastname
        $new_staff_member->firstname = ucwords(strtolower($new_staff_member->firstname));
        $new_staff_member->lastname = ucwords(strtolower($new_staff_member->lastname));

        $pass = $new_staff_member->generate_pw(); //Generate a new password
        $new_staff_member->generateUsername(); //Generate username
        $new_staff_member->password_reset = 1; //Make reset password
        $new_staff_member->save();
        $new_staff_member->changeRole(new role($_POST['role_type']));

		echo '<div class="alert alert-success"><center>';
        echo "<p>New username is: ".$new_staff_member->username.'</p>';
        echo "<p>New password is: ".$pass.'</p>';
        echo '</center></div>';

    } catch (Exception $e){
        echo $e->getMessage();
    }


}

?>
<div class="container-fluid" id="login-page">
	<form name="create" method="post" role="form">
		<h2>Add Staff</h2>
		<div class="form-group">		
			<input type="text" name="firstname" placeholder="First Name" class="form-control" value="<?=$new_staff_member->firstname?>"><br/>
			<input type="text" name="lastname" placeholder="Last Name" class="form-control" value="<?=$new_staff_member->lastname?>"><br/>
			<select class="form-control" name="role_type">
                <?php
                //List all roles
                $roles = new role();
                foreach($roles->all() as $role){
                    echo '<option value="'.$role->id().'">'.$role->role_name.'</option>';
                }
                ?>
			</select>
			<hr/>
			<input type="submit" value="Create Account" class="btn btn-primary">
		</div>
	</form>
</div>
<?php
include(".views/footer.php");
?>
