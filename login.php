<?php
require_once('.class/staff.class.php');
$staff = new staff(); //Get new staff
$username = ""; //Store username

if($_POST && isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Check if the user exists
    if($staff->findByCredentials($username, $password)){
        $staff->authenticate(); //Authenticate the user
		
        header('Location: /');
        die;
    } else {
        echo '<div class="alert alert-warning"><center>Incorrect username or password.</center></div>';
    }
}
include(".views/header.php");
?>
<div class="container-fluid" id="login-page">
	<h2>Staff Login</h2>
	<form name="login" method="post" role="form">
		<div class="form-group">
			<input type="text" name="username" class="form-control" placeholder="Username" value="<?=$username?>"> <br/>
			<input type="password" name="password" class="form-control" placeholder="Password"><br/>
			<input type="submit" value="Login" class="btn btn-primary">
		</div>	
	</form>
</div>
