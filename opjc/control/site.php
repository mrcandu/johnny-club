<?php
$site['form'] = new form(1);

//Customer
$site['customer'] = new customer;
if(isset($_SESSION['cust'])) {
$site['customer']->cust_id = $_SESSION['cust']['cust_id'];
}

////Variables
$site['customer']->cust_email = trim($_POST['cust_email']);
$site['customer']->password = trim($_POST['password']);//for spam bot
$site['customer']->cust_pass = trim($_POST['cust_pass']);
$site['customer']->cust_pass_check = trim($_POST['cust_pass_check']);

////Actions
if($_POST['action']=="Login"){$site['customer']->login();$build['error']=$site['customer']->error;}
if($_POST['action']=="Logoff"){$site['customer']->logoff();}


////Site
//Home
if(empty($_GET['ctrl1'])){
include($site_config['path'].'control/site_home.php');
}
//Everything Else
else{
include($site_config['path'].'control/site_'.$_GET['ctrl1'].'.php');
}
////

//Site Template
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_site.php');

//Banner
if(in_array($_GET['ctrl1'],array("")) or empty($_GET['ctrl1'])){
$build['tmpl']->inc_banner = 1;
}

//Google Anaytics
if($site_config['google']=="1"){
$build['tmpl']->google = "1";
}


////Menu Bar
if(isset($_SESSION['cust'])) {
$build['tmpl']->logged_in_as = 'User: <a href="'.$site_config['url'].'user/home/" class="last"><strong>'.$_SESSION['cust']['logged_in_as'].'</a></strong>';
$build['tmpl']->frm_logoff = $site['form']->formButton('action','submit','Logoff');
$build['tmpl']->frm_login = '<a href="#" id="logout" class="last">Log Off</a>';
}
else{
$build['tmpl']->frm_login = '<a href="'.$site_config['url'].'user/login/">Log In</a>';
}

$build['tmpl']->page_title = $page['title'];
$build['tmpl']->page_path = $site_config['url'];
$build['tmpl']->jquery = $page['jquery'];
$build['tmpl']->page_body = $page['body'];
$build['tmpl']->publish();
///////////////////////////////////////////////////////////////////////////////Tidy Up
unset($build);
?>