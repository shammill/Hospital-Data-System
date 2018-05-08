<?PHP

require_once('.class/staff.class.php');
include('.views/header.php');

if($_POST){
	$cpassword  = $_POST['cpassword']; //Current password
	$npassword  = $_POST['npassword']; //New password
	$rpassword = $_POST['rpassword'];//an extra variable to verify equality 

    if($staff->matchPassword($cpassword)){ //Check if password matches current password
        if($npassword != $rpassword){ //Check if two new passwords match
            echo '<div class="alert alert-danger"><center>';
            echo 'Passwords do not match!';
            echo '</center></div>';
        }else{
            $staff->setPassword($npassword);
            $staff->save(); //Set and save password

            header( "refresh:5;url=index.php" ); //Redirect home in 5 seconds

            echo '<div class="alert alert-success"><center>';
            echo 'Password successfully updated. You will be redirected to the home page in 5 seconds.';
            echo '</center></div>';
        }
    } else {
        echo '<div class="alert alert-danger"><center>';
        echo 'Current password incorrect!';
        echo '</center></div>';
    }
}
?>

<div class="container-fluid" id="login-page">
	<form name="create" method="post" role="form">
		<h2>Change Password</h2>
		<div class="form-group">		
			<input type="password" name="cpassword" placeholder="Current Password" class="form-control" ><br/>
			<input type="password" name="npassword" placeholder="New Password" class="form-control" ><br/>
			<input type="password" name="rpassword" placeholder="Repeat New" class="form-control" ><br/>
			<hr/>
			<input type="submit" value="Change Password" class="btn btn-primary">
		</div>
	</form>
</div>
