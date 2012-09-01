<?php 
$build['model'] = new user();
$build['form'] = new form(1);
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_admin_user.php');

///////////////////////////////////////////////////////////////////////////////Define ID
if($_POST['user_id']!=""){$build['model']->user_id = $_POST['user_id'];}
///////////////////////////////////////////////////////////////////////////////Add / Update Procedure
if(isset($_POST['action']))
{
$build['model']->user_forename = trim($_POST['user_forename']);
$build['model']->user_surname = trim($_POST['user_surname']);  
$build['model']->user_email = trim($_POST['user_email']);
$build['model']->user_active = trim($_POST['user_active']);
$build['model']->user_temppass = trim($_POST['user_temppass']);
$build['model']->user_pass = trim($_POST['user_pass']);
$build['model']->user_pass_check = trim($_POST['user_pass_check']);
}

if($_POST['action']=="Add"){$build['model']->add_user();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Email New User"){$build['model']->email_new_user();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Update"){$build['model']->update_user();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Delete Confirm"){$build['model']->delete_user();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Add Password"){$build['model']->set_user_permpass();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Email Reset Pass"){$build['model']->email_reset_pass();$build['error']=$build['model']->error;}

///////////////////////////////////////////////////////////////////////////////Get Data For Form
$build['model']->get_user();

///////////////////////////////////////////////////////////////////////////////Populate Template
$build['tmpl']->error = $build['error'];

//Search Form
$build['tmpl']->user_select = $build['form']->formSelect('user_id',$build['model']->get_user_list(),$build['model']->user_id,'Select User:');
$build['tmpl']->frm_select_btn = $build['form']->formButton('select','submit',"Select");
if($_POST['action']!="Delete" and $build['model']->user_id!="") {
$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete");
}
if($_POST['action']=="Delete") {
$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete Confirm");
}

//Update User
$build['tmpl']->user_id = $build['form']->formHidden('user_id',$build['model']->user_id);
$build['tmpl']->user_forename = $build['form']->formInput('user_forename',$build['model']->user_forename,'Forename',1);
$build['tmpl']->user_surname = $build['form']->formInput('user_surname',$build['model']->user_surname,'Surname',1);
$build['tmpl']->user_email = $build['form']->formInput('user_email',$build['model']->user_email,'Email:',1);
$build['tmpl']->user_active = $build['form']->formCheck('user_active',$build['model']->user_active,'Live');
if($build['model']->user_id!=""){$build['btn_act'] = "Update";}else{$build['btn_act'] = "Add";}
$build['tmpl']->frm_submit_btn1 = $build['form']->formButton('action','submit',$build['btn_act']);

if($_POST['action']!="Delete" and $build['model']->user_id!="") {
$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete");
}
if($_POST['action']=="Delete") {
$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete Confirm");
}

if($build['model']->user_id!="" and $build['model']->user_new == "")
{
$build['tmpl']->frm_submit_btn3 = $build['form']->formButton('action','submit','Email Reset Pass');
}

//Add Permanent Password
if($build['model']->user_id!="" and $build['model']->user_new == "1")
{
$build['tmpl']->frm_submit_btn2 = $build['form']->formButton('action','submit','Email New User');
}
if($build['model']->user_id!="" and $build['model']->user_usetemp == "1")
{
$build['tmpl']->user_temppass = $build['form']->formInput('user_temppass',$build['model']->user_temppass,'Temporary Pass:');
$build['tmpl']->user_pass = $build['form']->formInput('user_pass',$build['model']->user_pass,'Enter New Password:');
$build['tmpl']->user_pass_check = $build['form']->formInput('user_pass_check',$build['model']->user_pass_check,'Enter New Password Again:');
$build['tmpl']->frm_submit_btn4 = $build['form']->formButton('action','submit','Add Password');
}

//Close Link
if($build['model']->user_id!=""){$build['link_close'] = "<a href=\"\">Close User</a>";}
$build['tmpl']->link_close = $build['link_close'];

///////////////////////////////////////////////////////////////////////////////Render The Page
$page['title'] = "Admin User";
$page['body'] = $build['tmpl']->parse();

///////////////////////////////////////////////////////////////////////////////Tidy Up
unset($build);
?>