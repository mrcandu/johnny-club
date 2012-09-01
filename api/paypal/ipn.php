<?php
include ('../../opjc/incfiles/config.php');
include ('../../opjc/incfiles/includes.php');

// tell PHP to log errors to ipn_errors.log in this directory
ini_set('log_errors', true);
ini_set('error_log', dirname(__FILE__).'/ipn_errors.log');

// intantiate the IPN listener
include('ipnlistener.php');
$listener = new IpnListener();

// tell the IPN listener to use the PayPal test sandbox
$listener->use_sandbox = false;

// try to process the IPN POST
try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
} catch (Exception $e) {
    error_log($e->getMessage());
    exit(0);
}

if ($verified) {
$build['paypal'] = new opjc_paypal();
$build['paypal']->custom = $_POST['custom'];
$build['paypal']->report = $listener->getTextReport();
$build['paypal']->receiver_email = $_POST['receiver_email'];
$build['paypal']->txn_type = $_POST['txn_type'];
$build['paypal']->mc_gross = $_POST['mc_gross'];
$build['paypal']->mc_amount3 = $_POST['mc_amount3'];
$build['paypal']->mc_currency = $_POST['mc_currency'];
$build['paypal']->parent_txn_id = $_POST['parent_txn_id'];
$build['paypal']->txn_id = $_POST['txn_id'];
$build['paypal']->txn_type = $_POST['txn_type'];
$build['paypal']->item_name = $_POST['item_name'];
$build['paypal']->item_number = $_POST['item_number'];
$build['paypal']->payment_status = $_POST['payment_status'];
$build['paypal']->payment_type = $_POST['payment_type'];
$build['paypal']->subscr_id = $_POST['subscr_id'];
$build['paypal']->process_order();
}
?>