<?php 
$build['model'] = new category();
$build['form'] = new form(1);
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_admin_category.php');

///////////////////////////////////////////////////////////////////////////////Define ID
if($_POST['cat_id']!=""){$build['model']->cat_id = $_POST['cat_id'];}

///////////////////////////////////////////////////////////////////////////////Add / Update Procedure
if(isset($_POST['action']))
{
$build['model']->cat_desc = trim($_POST['cat_desc']);
$build['model']->cattype_id = trim($_POST['cattype_id']);
}
if($_POST['action']=="Add"){$build['model']->add_category();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Update"){$build['model']->update_category();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Delete Confirm"){$build['model']->delete_category();}

///////////////////////////////////////////////////////////////////////////////Get Data For Form
$build['cat_list'] = $build['model']->get_category_list();
$build['model']->get_category();
$build['cattype_list'] = $build['model']->get_categorytype_list();

///////////////////////////////////////////////////////////////////////////////Populate Template
$build['tmpl']->error = $build['error'];

//Select / Delete a Product
$build['tmpl']->cat_select = $build['form']->formSelect('cat_id',$build['cat_list'],$build['model']->cat_id,'Select Category:');
$build['tmpl']->frm_select_btn = $build['form']->formButton('select','submit',"Select");
if($_POST['action']!="Delete" and $build['model']->cat_id!="") {
$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete");
}
if($_POST['action']=="Delete") {
$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete Confirm");
}

//Update Product
$build['tmpl']->cat_desc = $build['form']->formInput('cat_desc',$build['model']->cat_desc,'Category Name:');
$build['tmpl']->cattype_id = $build['form']->formSelect('cattype_id',$build['cattype_list'],$build['model']->cattype_id,'Category Type:');
$build['tmpl']->cat_id = $build['form']->formHidden('cat_id',$build['model']->cat_id);

if($build['model']->cat_id!=""){$build['btn_act'] = "Update";}else{$build['btn_act'] = "Add";}
$build['tmpl']->frm_submit_btn1 = $build['form']->formButton('action','submit',$build['btn_act']);

//Close Link
if($build['model']->cat_id!=""){$build['link_close'] = "<a href=\"\">Close Category</a>";}
$build['tmpl']->link_close = $build['link_close'];

///////////////////////////////////////////////////////////////////////////////Render The Page
$page['title'] = "Categories";
$page['body'] = $build['tmpl']->parse();

///////////////////////////////////////////////////////////////////////////////Tidy Up
unset($build);
?>