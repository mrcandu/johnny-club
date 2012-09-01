<?php 
$build['model'] = new pricetype();
$build['form'] = new form(1);
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_admin_pricetype.php');

///////////////////////////////////////////////////////////////////////////////Define ID
if($_POST['price_type_id']!=""){$build['model']->price_type_id = $_POST['price_type_id'];}

///////////////////////////////////////////////////////////////////////////////Add / Update Procedure
if(isset($_POST['action']))
{
$build['model']->price_type_name = trim($_POST['price_type_name']);
$build['model']->price_type_code = trim($_POST['price_type_code']);
$build['model']->price_type_desc = trim($_POST['price_type_desc']);
$build['model']->price_type_months = trim($_POST['price_type_months']);
$build['model']->price_type_recur = trim($_POST['price_type_recur']);
$build['model']->price_type_handling = trim($_POST['price_type_handling']);
$build['model']->price_type_delivery = trim($_POST['price_type_delivery']);
}
if($_POST['action']=="Add"){$build['model']->add_pricetype();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Update"){$build['model']->update_pricetype();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Delete Confirm"){$build['model']->delete_pricetype();}

///////////////////////////////////////////////////////////////////////////////Get Data For Form
$build['pricetype_list'] = $build['model']->get_pricetype_list();
$build['model']->get_pricetype();

///////////////////////////////////////////////////////////////////////////////Populate Template
$build['tmpl']->title = "Update Price Types";
$build['tmpl']->error = $build['error'];

//Select / Delete a Product
$build['tmpl']->pricetype_select = $build['form']->formSelect('price_type_id',$build['pricetype_list'],$build['model']->price_type_id,'Select Price Type:');
$build['tmpl']->frm_select_btn = $build['form']->formButton('select','submit',"Select");
if($_POST['action']!="Delete" and $build['model']->price_type_id!="") {
$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete");
}
if($_POST['action']=="Delete") {
$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete Confirm");
}

//Update Product
$build['tmpl']->price_type_name = $build['form']->formInput('price_type_name',$build['model']->price_type_name,'Price Type Name:');
$build['tmpl']->price_type_code = $build['form']->formInput('price_type_code',$build['model']->price_type_code,'Price Type Code:');
$build['tmpl']->price_type_desc = $build['form']->formText('price_type_desc',$build['model']->price_type_desc,'Price Type Description:');
$build['tmpl']->price_type_recur = $build['form']->formCheck('price_type_recur',$build['model']->price_type_recur,'Recurring Subscription:');
$build['tmpl']->price_type_months = $build['form']->formInput('price_type_months',$build['model']->price_type_months,'Recurring Months:');
$build['tmpl']->price_type_handling = $build['form']->formCheck('price_type_handling',$build['model']->price_type_handling,'Handling:');
$build['tmpl']->price_type_delivery = $build['form']->formCheck('price_type_delivery',$build['model']->price_type_delivery,'Delivery:');
$build['tmpl']->price_type_id = $build['form']->formHidden('price_type_id',$build['model']->price_type_id);

if($build['model']->price_type_id!=""){$build['btn_act'] = "Update";}else{$build['btn_act'] = "Add";}
$build['tmpl']->frm_submit_btn1 = $build['form']->formButton('action','submit',$build['btn_act']);

//Close Link
if($build['model']->price_type_id!=""){$build['link_close'] = "<a href=\"\">Close Price Type</a>";}
$build['tmpl']->link_close = $build['link_close'];

///////////////////////////////////////////////////////////////////////////////Render The Page
$page['title'] = "Price Types";
$page['body'] = $build['tmpl']->parse();

///////////////////////////////////////////////////////////////////////////////Tidy Up
unset($build);
?>