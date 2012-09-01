<?php
$admin['model'] = new user();
$admin['form'] = new form(1);

if(isset($_SESSION['user'])) {
$admin['model']->user_id = $_SESSION['user']['user_id'];
} 

$admin['model']->user_email = trim($_POST['user_email']);
$admin['model']->user_pass = trim($_POST['user_pass']);
$admin['model']->user_pass_check = trim($_POST['user_pass_check']);

if($_POST['action']=="Login"){$admin['model']->login();$build['error']=$admin['model']->error;}
elseif($_POST['action']=="Logoff"){$admin['model']->logoff();}
elseif($_POST['action']=="Update Password"){$admin['model']->set_user_permpass();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Reset Password"){$admin['model']->user_reset_pass();$build['error']=$build['model']->error;}

//Reset Password
if($_GET['ctrl2']=="reset_password" and !isset($_SESSION['user']))
{
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_admin_login.php');
$build['tmpl']->page_title = "OPJC Admin | Reset Password";
$build['tmpl']->error = $admin['model']->error;

$build['tmpl']->user_email = $admin['form']->formInput('user_email',$_POST['user_email'],'User Email:',1);
$build['tmpl']->frm_submit_btn1 = $admin['form']->formButton('action','submit','Reset Password');
}

//Login
elseif(!isset($_SESSION['user']))
{
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_admin_login.php');
$build['tmpl']->page_title = "OPJC Admin | Log In";
$build['tmpl']->error = $admin['model']->error;

$build['tmpl']->user_email = $admin['form']->formInput('user_email',$_POST['user_email'],'User Email:',1);
$build['tmpl']->user_pass = $admin['form']->formPass('user_pass','','User Pass:',1);
$build['tmpl']->frm_submit_btn1 = $admin['form']->formButton('action','submit','Login');

$build['tmpl']->reset_password = '<a href="'.$site_config['admin_url'].'reset_password/">Reset Password</a>';
}

//Reset Password
elseif(isset($_SESSION['user']) and $_SESSION['user']['user_usetemp']=="1")
{
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_admin_resetpass.php');
$build['tmpl']->page_title = "OPJC Admin | Update Password";
$build['tmpl']->error = $admin['model']->error;

$build['tmpl']->user_pass = $admin['form']->formPass('user_pass','','Enter New Password:',1);
$build['tmpl']->user_pass_check = $admin['form']->formPass('user_pass_check','','Enter New Password Again:',1);
$build['tmpl']->frm_submit_btn1 = $admin['form']->formButton('action','submit','Update Password');
}

else
{
//Items
if(empty($_GET['ctrl2']))
{
$page['body'] = "<h1>Welcome to the the OPJC Admin</h1><p>Have a look around</p>";
}
elseif($_GET['ctrl2']=="admin_item")
{
$build['product_mode'] = "0";
include($site_config['path'].'control/admin_product.php');
}
//Products
elseif($_GET['ctrl2']=="admin_product")
{
$build['product_mode'] = "1";
include($site_config['path'].'control/admin_product.php');
}
//Everything Else
elseif(!empty($_GET['ctrl2']))
{
include($site_config['path'].'control/'.$_GET['ctrl2'].'.php');
}

$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_admin.php');
$build['tmpl']->page_title = "OPJC Admin | ".$page['title'];
$build['tmpl']->logged_in_as = $_SESSION['user']['logged_in_as'];
$build['tmpl']->frm_logoff_url = $site_config['admin_url'];
$build['tmpl']->frm_logoff = $admin['form']->formButton('action','submit','Logoff');
}

$build['tmpl']->page_path = $site_config['url'];
$build['tmpl']->admin_url = $site_config['admin_url'];
$build['tmpl']->page_body = $page['body'];
$build['tmpl']->publish();
///////////////////////////////////////////////////////////////////////////////Tidy Up
unset($build);
?>