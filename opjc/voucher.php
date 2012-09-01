<?php session_start();
//Includes
include ('incfiles/config.php');
include ('incfiles/includes.php');

if(trim($_GET['vcher'])!=""){
$build['order'] = new order;
$build['order']->vcher = $_GET['vcher'];
$build['order']->check_voucher();
if(!empty($build['order']->v_desc)){
echo $build['order']->v_desc;
}
else{
echo "Sorry - you have yourself a duff voucher.";
}
}
?>