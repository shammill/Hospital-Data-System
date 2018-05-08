<?php
//comment these out to remove errors
ini_set("display_errors", 1);
error_reporting(-1);

if(isset($_SERVER['DOCUMENT_ROOT'])==false){
   die('No document root set on this server. Invalid config.');
}
define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);
//never comment this out
require_once(ABSPATH.'/.class/staff.class.php');
$staff = new staff();

//only comment this out to test pages if you aren't logged in.
//for production, it should never be commented out.
if($staff->authenticated()==false && $_SERVER['PHP_SELF']!='/login.php'){
	header("Location: /login.php");
	die();
}

if($staff->password_reset==1 && $_SERVER['PHP_SELF']!='/reset-password.php'){
    header('Location: reset-password.php');
    die;
}
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>INB201</title>
		<!--JavaScript -->
		<script src="/js/jquery-2.1.0.min.js" type="text/javascript"></script>
		<script src="/js/bootstrap.js" type="text/javascript"></script>
        <script src="/js/jquery-1.9.1.js"></script>
		<script src="/js/jquery-ui.js"></script>
		<script src="/js/holder.js"></script>
		<script type="text/javascript" src="/calendar/js/calendar.js"></script>
        <script type="text/javascript" src="/calendar/components/underscore/underscore-min.js"></script>
        <script type="text/javascript" src="/api/api.js"></script>        

		<!--CSS -->
		<link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="/css/bootstrap-theme.min.css" type="text/css">
		<link rel="stylesheet" href="/css/jquery-ui.css">
		<link rel="stylesheet" href="/css/additional-styles.css" type="text/css">
		<link rel="stylesheet" href="/calendar/css/calendar.css">

		<!-- Meta -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
	<?php
     if($staff->authenticated()){
		include(ABSPATH."/.views/nav-bar.php");
	 }
	?>
