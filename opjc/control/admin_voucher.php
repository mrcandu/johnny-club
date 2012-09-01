<?php 

$build['model'] = new voucher();

$build['form'] = new form(1);

$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_admin_voucher.php');



///////////////////////////////////////////////////////////////////////////////Define ID

if($_POST['v_id']!=""){$build['model']->v_id = $_POST['v_id'];}



///////////////////////////////////////////////////////////////////////////////Add / Update Procedure

if(isset($_POST['action']))

{

$build['model']->v_code = trim($_POST['v_code']);

$build['model']->v_desc = trim($_POST['v_desc']);

$build['model']->v_live = trim($_POST['v_live']);

$build['model']->v_id = trim($_POST['v_id']);

}

if($_POST['action']=="Add"){$build['model']->add_voucher();$build['error']=$build['model']->error;}

elseif($_POST['action']=="Update"){$build['model']->update_voucher();$build['error']=$build['model']->error;}

elseif($_POST['action']=="Delete Confirm"){$build['model']->delete_voucher();}



///////////////////////////////////////////////////////////////////////////////Get Data For Form

$build['voucher_list'] = $build['model']->get_voucher_list();

$build['model']->get_voucher();



///////////////////////////////////////////////////////////////////////////////Populate Template

$build['tmpl']->title = "Update Vouchers";

$build['tmpl']->error = $build['error'];



//Select / Delete a Product

$build['tmpl']->voucher_select = $build['form']->formSelect('v_id',$build['voucher_list'],$build['model']->v_id,'Select Voucher Type:');

$build['tmpl']->frm_select_btn = $build['form']->formButton('select','submit',"Select");

if($_POST['action']!="Delete" and $build['model']->v_id!="") {

$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete");

}

if($_POST['action']=="Delete") {

$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete Confirm");

}



//Update Product

$build['tmpl']->v_code = $build['form']->formInput('v_code',$build['model']->v_code,'Voucher Code:');

$build['tmpl']->v_desc = $build['form']->formInput('v_desc',$build['model']->v_desc,'Voucher Description:');

$build['tmpl']->v_live = $build['form']->formCheck('v_live',$build['model']->v_live,'Voucher Live:');

$build['tmpl']->v_id = $build['form']->formHidden('v_id',$build['model']->v_id);



if($build['model']->v_id!=""){$build['btn_act'] = "Update";}else{$build['btn_act'] = "Add";}

$build['tmpl']->frm_submit_btn1 = $build['form']->formButton('action','submit',$build['btn_act']);



//Close Link

if($build['model']->v_id!=""){$build['link_close'] = "<a href=\"\">Close Voucher</a>";}

$build['tmpl']->link_close = $build['link_close'];



///////////////////////////////////////////////////////////////////////////////Render The Page

$page['title'] = "Vouchers";

$page['body'] = $build['tmpl']->parse();



///////////////////////////////////////////////////////////////////////////////Tidy Up

unset($build);

?>