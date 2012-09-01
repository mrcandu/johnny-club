<?php
//Includes
include ('../incfiles/config.php');
include ('../incfiles/includes.php');
$email = new email();
$email->bulk_email();
?>