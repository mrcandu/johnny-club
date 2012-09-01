<?php 
$build['model'] = new categorytype();
$build['form'] = new form(1);
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_admin_categorytype.php');

///////////////////////////////////////////////////////////////////////////////Define ID
if($_POST['cattype_id']!=""){$build['model']->cattype_id = $_POST['cattype_id'];}

///////////////////////////////////////////////////////////////////////////////Add / Update Procedure
if(isset($_POST['action']))
{
$build['model']->cattype_desc = trim($_POST['cattype_desc']);
$build['model']->cattype_id = trim($_POST['cattype_id']);
}
if($_POST['action']=="Add"){$build['model']->add_categorytype();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Update"){$build['model']->update_categorytype();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Delete Confirm"){$build['model']->delete_categorytype();}

///////////////////////////////////////////////////////////////////////////////Get Data For Form
$build['cattype_list'] = $build['model']->get_categorytype_list();
$build['model']->get_categorytype();

///////////////////////////////////////////////////////////////////////////////Populate Template
$build['tmpl']->cattype_id = $build['model']->cattype_id;

$build['tmpl']->error = $build['error'];

//Select / Delete a Product
$build['tmpl']->cattype_select = $build['form']->formSelect('cattype_id',$build['cattype_list'],$build['model']->cattype_id,'Select Category Type:');
$build['tmpl']->frm_select_btn = $build['form']->formButton('select','submit',"Select");
if($_POST['action']!="Delete" and $build['model']->cattype_id!="") {
$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete");
}
if($_POST['action']=="Delete") {
$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete Confirm");
}

//Update Product
$build['tmpl']->cattype_desc = $build['form']->formInput('cattype_desc',$build['model']->cattype_desc,'Category Type Name:');
$build['tmpl']->cattype_id = $build['form']->formHidden('cattype_id',$build['model']->cattype_id);

if($build['model']->cattype_id!=""){$build['btn_act'] = "Update";}else{$build['btn_act'] = "Add";}
$build['tmpl']->frm_submit_btn1 = $build['form']->formButton('action','submit',$build['btn_act']);

//Close Link
if($build['model']->cattype_id!=""){$build['link_close'] = "<a href=\"\">Close Category Type</a>";}
$build['tmpl']->link_close = $build['link_close'];

///////////////////////////////////////////////////////////////////////////////Render The Page
$page['title'] = "Category Types";
$page['body'] = $build['tmpl']->parse();

///////////////////////////////////////////////////////////////////////////////Tidy Up
unset($build);
?>