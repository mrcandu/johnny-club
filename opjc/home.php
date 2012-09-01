<?php session_start();
//Includes
include ('incfiles/config.php');
include ('incfiles/includes.php');
$_GET['ctrl1']="user";
$_GET['ctrl2']="home";
include($site_config['path'].'control/site.php'); 
?>