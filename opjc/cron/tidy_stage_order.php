<?php
//Includes
include ('../incfiles/config.php');
include ('../incfiles/includes.php');
$email = new order();
$email->tidy_stage_order();
?>