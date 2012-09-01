<?php
//Includes
include ('../incfiles/config.php');
include ('../incfiles/includes.php');
$email = new customer();
$email->tidy_reset_pass();
?>