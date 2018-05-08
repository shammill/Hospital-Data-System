<?php

require_once('.class/staff.class.php');
require_once('.class/acl.class.php');
include('.views/header.php');

$expected = array('password','password_reset');
$password_updated=0;//0 means that it doesn't need to be updated.
$new_staff_member = new staff();
$new_staff_member->authenticated();

if($_POST){
	$password  = $_POST['password'];
	$rpassword = $_POST['rpassword'];//an extra variable to verify equality 
    
	try {
     
		if($password != $rpassword){
		echo '<div class="alert alert-danger"><center>';
		throw new Exception('Passwords do not match!');
		echo '</center></div>';
            
        }
		else{
		$new_staff_member->password_reset=$password_updated;		
		$new_staff_member->setPassword($password); 
		
		$new_staff_member->save();
		
		header( "refresh:5;url=index.php" );
		
		echo '<div class="alert alert-success"><center>';
		echo 'Password successfully updated. You will be redirected to the home page in 5 seconds.';
        echo '</center></div>';
		}
		

    } catch (Exception $e){
        echo $e->getMessage();
    }


}

?>
<div class="container-fluid" id="login-page">
	<form name="create" method="post" role="form">
		<h2>Reset Password</h2>
		<div class="form-group">		
			<input type="password" name="password" placeholder="Password" class="form-control" ><br/>
			<input type="password" name="rpassword" placeholder="Repeat Password" class="form-control" ><br/>
			<hr/>
			<input type="submit" value="Reset Password" class="btn btn-primary">
		</div>
	</form>
</div>
