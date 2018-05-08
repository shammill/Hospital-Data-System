<?php
//Deauthenticate using class and redirect to login
require_once('.class/staff.class.php');
$staff = new staff();
$staff->deauthenticate();
header('Location: /login.php');
die;
?>