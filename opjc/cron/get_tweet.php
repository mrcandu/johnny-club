<?php
//Includes
include ('../incfiles/config.php');
include ('../incfiles/includes.php');
$tweet = new johnny_tweet();
$tweet->get_tweet();
?>