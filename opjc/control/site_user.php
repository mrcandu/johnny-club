<?php
///////////////////////////////////////////////////////////////////////////////Actions
//Add New Customer
if($_POST['action']=="Add")
{
//*Email and Pass POST vars are captured on the site controller
$site['customer']->cust_check = trim($_POST['cust_check']);  //terms
$site['customer']->cust_forename = trim($_POST['cust_forename']);
$site['customer']->cust_surname = trim($_POST['cust_surname']);  
$site['customer']->cust_type = trim($_POST['cust_type']);
//$site['customer']->add_live_customer();
$site['customer']->customer_signin();
}

//Forgot Password
elseif($_POST['action']=="Forgot"){
$site['customer']->spam = trim($_POST['spm']);
$site['customer']->sc_a = $_SESSION['spam']['sc_a'];
$site['customer']->sc_w = $_SESSION['spam']['sc_w'];
$site['customer']->cust_forgot_pass_check();
}

//Update Password
elseif($_POST['action']=="Pass"){
$site['customer']->cust_hash = trim($_POST['cust_hash']);
$site['customer']->cust_update_pass();
}

elseif($_POST['action']=="Update Password"){$site['customer']->cust_set_perm_pass_session();}

//Cancel Subscription
elseif($_POST['action']=="Cancel"){
$build['cancel_order'] = new order();
$build['cancel_order']->order_hash = trim($_POST['order_hash']);
$build['cancel_order']->cust_id = $_SESSION['cust']['cust_id'];
$build['cancel_order']->cancel_order();
$build['pp_error'] = $build['cancel_order']->error;
$build['pp_success'] = $build['cancel_order']->success;
}

//Error / Success Messages
$build['error']=$site['customer']->error;
$build['success']=$site['customer']->success;

///////////////////////////////////////////////////////////////////////////////Set Variables and Classes


//Form Template
$build['form'] = new form(1);

//set spam check question
if(!isset($_SESSION['spam']))
{
$sc = spamcheck();
$_SESSION['spam']['sc_q'] = $sc['q'];
$_SESSION['spam']['sc_a'] = $sc['a'];
$_SESSION['spam']['sc_w'] = $sc['w'];
}

if(trim($_POST['cust_forename'])==""){$_POST['cust_forename']="Forename";}
if(trim($_POST['cust_surname'])==""){$_POST['cust_surname']="Surname";}
if(trim($_POST['cust_email'])==""){$_POST['cust_email']="Email";}

///////////////////////////////////////////////////////////////////////////////Templates

////Login
if($_GET['ctrl2']=="login" and !isset($_SESSION['cust'])){

$build['title'] = "Log In - One Pound Johnny Club";
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_site_user_login.php');
$build['tmpl']->page_path = $site_config['url'];
$build['tmpl']->error = $site['customer']->error;

$build['tmpl']->shop = $_SESSION['last_prd']['prd_id'];
$build['tmpl']->cust_email = $build['form']->formInput('cust_email',$_POST['cust_email'],'');
$build['tmpl']->cust_dummy_pass = $build['form']->formInput('dummy_pass','Password','');
$build['tmpl']->cust_pass = $build['form']->formPass('cust_pass','','');
$build['tmpl']->password = $build['form']->formHidden('password','','');

$build['tmpl']->reset_password = '<a href="'.$site_config['url'].'user/reset_pass/">Forgot Password</a>';
$build['tmpl']->page_path = $site_config['url'];
$page['jquery'] = '<script src="'.$site_config['url'].'incfiles/js_site_user_login.js"></script>';

}
////

////Reset Password
elseif($_GET['ctrl2']=="forgot" and !isset($_SESSION['cust'])){
$build['title'] = "Reset Pass - One Pound Johnny Club";
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_site_user_forgot.php');

$build['tmpl']->cust_email = $build['form']->formInput('cust_email',$_POST['cust_email']);
$build['tmpl']->spam2 = '<p class="marg_bot"><em>To prove you are a person (not a spam bot), please type the answer to this math question: '.$_SESSION['spam']['sc_q']."</em></p>".$build['form']->formInput('spm2','');
$build['tmpl']->spam = $build['form']->formHidden('spm','');

$build['tmpl']->page_path = $site_config['url'];
$build['tmpl']->error = $build['error'];
$build['tmpl']->success = $build['success'];

$page['jquery'] = '<script src="'.$site_config['url'].'incfiles/js_site_user_forgot.js"></script>';
}
////


////Update Password
elseif($_GET['ctrl2']=="pass" and $_SESSION['cust']['reset'] != "0"){

$site['customer']->cust_hash = trim($_GET['ctrl3']);
$site['customer']->cust_check_pass_link();

if($site['customer']->invalid==""){

$build['title'] = "Update Pass - One Pound Johnny Club";
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_site_user_pass.php');

$build['tmpl']->cust_email = $build['form']->formInput('cust_email',$_POST['cust_email'],'');
$build['tmpl']->cust_pass = $build['form']->formPass('cust_pass','','');
$build['tmpl']->cust_dummy_pass = $build['form']->formInput('dummy_pass','Password','');
$build['tmpl']->cust_pass_check = $build['form']->formPass('cust_pass_check','','');
$build['tmpl']->cust_dummy_pass_check = $build['form']->formInput('dummy_pass_check','Re-enter Password','');
$build['tmpl']->cust_hash = $build['form']->formHidden('cust_hash',$_GET['ctrl3'],'');
$build['tmpl']->password = $build['form']->formHidden('password','','');

$build['tmpl']->error = $site['customer']->error;
$build['tmpl']->success = $site['customer']->success;
$build['tmpl']->page_path = $site_config['url'];
$page['jquery'] = '<script src="'.$site_config['url'].'incfiles/js_site_user_pass.js"></script>';
}
}
////

////Register
elseif(!isset($_SESSION['cust'])){

$build['title'] = "Sign Up - One Pound Johnny Club";
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_site_user_signin.php');
$build['tmpl']->page_path = $site_config['url'];
$build['tmpl']->error = $build['error'];

$build['tmpl']->shop = $_SESSION['last_prd']['prd_id'];
//$build['tmpl']->cust_forename = $build['form']->formInput('cust_forename',$_POST['cust_forename']);
//$build['tmpl']->cust_surname = $build['form']->formInput('cust_surname',$_POST['cust_surname']);
$build['tmpl']->cust_email = $build['form']->formInput('cust_email',$_POST['cust_email']);
$build['tmpl']->cust_type_new = $build['form']->formRadio('cust_type',1,'','',0);
$build['tmpl']->cust_type_exist = $build['form']->formRadio('cust_type',2,'','',1);
$build['tmpl']->cust_dummy_pass = $build['form']->formInput('dummy_pass','Password','');
$build['tmpl']->cust_pass = $build['form']->formPass('cust_pass','','');
$build['tmpl']->password = $build['form']->formHidden('password','');
//$build['tmpl']->cust_check = $build['form']->formCheck('cust_check',$_POST['cust_check']); //accept terms
$page['jquery'] = '<script src="'.$site_config['url'].'incfiles/js_site_user_signin.js"></script>';

}
////

////Home
elseif(isset($_SESSION['cust']) and $_GET['ctrl2']=="home"){

//Paypal PDT
if(isset($_GET['tx']))
{
$build['paypal'] = new opjc_paypal();

$build['paypal']->tx = $_GET['tx'];
$build['paypal']->token = $site_config['paypal_pdt'];
$build['paypal']->process_pdt();
$build['paypal']->process_order();

$build['pp_error'] = $build['paypal']->error;
$build['pp_success'] = $build['paypal']->success;

if($build['pp_success']==1){
$build['pp_success'] = "Thanks for signing up!";
}
else {
$build['pp_error'] = "Ooops, something went wrong. Please contact support.";
}
}

//Cancel Subscription
elseif($_POST['action']=="Cancel")
{
if($build['pp_success']==1){
$build['pp_success'] = "Your subscription has been cancelled. You will not be charged for any further deliveries. Updates will be reflected here shortly.";
}
else {
$build['pp_error'] = "Ooops, something went wrong. Please contact support.";
}
}

$build['title'] = "Your Subscriptions - One Pound Johnny Club";
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_site_user_home.php');
$build['tmpl']->page_path = $site_config['url'];

$build['tmpl']->error = $build['pp_error'];
$build['tmpl']->success = $build['pp_success'];

$build['order'] = new order();
$build['order']->cust_id = $_SESSION['cust']['cust_id'];
$build['order_list'] = $build['order']->get_customer_orders();

if(!empty($build['order_list']))
{
foreach($build['order_list'] as $build['orders_row'])
{
$i++;

if($build['orders_row']['order_status']=="2"){$build['order_status']="2";}else{$build['order_status']="1";}
$build['orders_list'][$build['order_status']][$i]['order_id'] = $build['orders_row']['order_id'];
$build['orders_list'][$build['order_status']][$i]['order_hash'] = $build['orders_row']['order_hash'];
$build['orders_list'][$build['order_status']][$i]['order_name'] = $build['orders_row']['order_name'];
$build['orders_list'][$build['order_status']][$i]['order_created'] = date("d-m-y",strtotime($build['orders_row']['order_created']));
$build['orders_list'][$build['order_status']][$i]['order_cancelled'] = $build['orders_row']['order_cancelled'];
$build['orders_list'][$build['order_status']][$i]['order_status'] = $build['orders_row']['order_status_desc'];
$build['orders_list'][$build['order_status']][$i]['address'] = $build['orders_row']['address'];
$build['orders_list'][$build['order_status']][$i]['tot_price'] = "&pound;".$build['orders_row']['tot_price']." / Month";
$build['orders_list'][$build['order_status']][$i]['prd_name'] = $build['orders_row']['prd_name'];
$build['orders_list'][$build['order_status']][$i]['prd_item_name'] = $build['orders_row']['prd_item_name'];
$build['orders_list'][$build['order_status']][$i]['order_trans_created'] = date("d-m-y",strtotime($build['orders_row']['order_trans_created']));
$build['orders_list'][$build['order_status']][$i]['dispatch'] = $build['orders_row']['dispatch'];
$build['orders_list'][$build['order_status']][$i]['subscr_id'] = $build['orders_row']['subscr_id'];
$build['orders_list'][$build['order_status']][$i]['cancel_pend'] = $build['orders_row']['cancel_pend'];

$build['order']->order_id = $build['orders_row']['order_id'];
$build['orders_list'][$build['order_status']][$i]['payments'] = $build['order']->get_order_payments();

}
$build['tmpl']->orders_list = $build['orders_list']['1'];
$build['tmpl']->cancelled_list = $build['orders_list']['2'];
}

$page['jquery'] = '<script src="'.$site_config['url'].'incfiles/js_site_user_home.js"></script>';

}
////

////Purchase
elseif(isset($_SESSION['cust']) and !empty($_SESSION['last_prd']['prd_id']))
{
header("Location: ".$site_config['url']."purchase/");
exit;
}

////Else
elseif(isset($_SESSION['cust']) and $_GET['ctrl1']=="user"){
header("Location: ".$site_config['url']);
exit;
}
////

///////////////////////////////////////////////////////////////////////////////Parse

$page['title'] = $build['title']." | One Pound Johnny Club";;
if(isset($build['tmpl']))
{
$page['body'] = $build['tmpl']->parse();
}

///////////////////////////////////////////////////////////////////////////////Tidy Up

unset($build);
?>