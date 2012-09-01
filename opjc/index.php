<?php session_start();

//Includes
include ('incfiles/config.php');
include ('incfiles/includes.php');
if($_GET['ctrl1']=="admin") {
include($site_config['path'].'control/'.$_GET['ctrl1'].'.php'); 
}
else{
include($site_config['path'].'control/site.php'); 
}
?>