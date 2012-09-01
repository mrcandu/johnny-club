<?php 
$build['model'] = new order();
$build['form'] = new form(1);
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_admin_order_history.php');

///////////////////////////////////////////////////////////////////////////////Define ID
if($_POST['order_id']!=""){$build['model']->order_id = $_POST['order_id'];}
///////////////////////////////////////////////////////////////////////////////Add / Update Procedure

if(isset($_POST['action']))
{
$build['model']->add_aline1 = trim($_POST['add_aline1']);
$build['model']->add_aline2 = trim($_POST['add_aline2']);
$build['model']->add_city = trim($_POST['add_city']);
$build['model']->add_county = trim($_POST['add_county']);
$build['model']->add_postcode = trim($_POST['add_postcode']);
$build['model']->add_country = trim($_POST['add_country']);
$build['model']->dispatch = trim($_POST['dispatch']);
$build['model']->order_trans_id = trim($_POST['order_trans_id']);
}

if($_POST['action']=="Update Shipping"){$build['model']->update_shipping();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Update Dispatch"){$build['model']->update_dispatch();$build['error']=$build['model']->error;}

///////////////////////////////////////////////////////////////////////////////Get Data For Form
$build['model']->get_order_details();

///////////////////////////////////////////////////////////////////////////////Populate Template
$build['tmpl']->error = $build['error'];

//Search Form
$build['tmpl']->cust_id = $build['form']->formHidden('cust_id',$build['model']->cust_id);
$build['tmpl']->frm_nav_btn1 = $build['form']->formButton('action','submit',"Customer");

$build['tmpl']->cust_forename = $build['model']->cust_forename;
$build['tmpl']->cust_surname = $build['model']->cust_surname;
$build['tmpl']->cust_email = $build['model']->cust_email;

$build['tmpl']->order_id = $build['model']->order_id;
$build['tmpl']->order_name = $build['model']->order_name;
$build['tmpl']->order_created = date_form($build['model']->order_created);
$build['tmpl']->order_updated = date_form($build['model']->order_updated);
$build['tmpl']->order_cancelled = date_form($build['model']->order_cancelled);
$build['tmpl']->order_status = $build['model']->order_status_desc;
$build['tmpl']->price = $build['model']->price;
$build['tmpl']->del = $build['model']->del;
$build['tmpl']->tot_price = $build['model']->tot_price;

$build['tmpl']->order_id_hidden = $build['form']->formHidden('order_id',$build['model']->order_id);
$build['tmpl']->add_aline1 = $build['form']->formInput('add_aline1',$build['model']->add_aline1,'Address Line 1:');
$build['tmpl']->add_aline2 = $build['form']->formInput('add_aline2',$build['model']->add_aline2,'Address Line 2:');
$build['tmpl']->add_city = $build['form']->formInput('add_city',$build['model']->add_city,'Town / City:');
$build['tmpl']->add_county = $build['form']->formInput('add_county',$build['model']->add_county,'County:');
$build['tmpl']->add_postcode = $build['form']->formInput('add_postcode',$build['model']->add_postcode,'Postcode:');
$build['tmpl']->add_country = $build['form']->formSelect('add_country',$site_config['country'],$build['model']->add_country,'Country:');
$build['tmpl']->frm_submit_btn1 = $build['form']->formButton('action','submit',"Update Shipping");

//Order Transaction
$build['order_tran'] = $build['model']->get_order_trans();
if(!empty($build['order_tran']))
{
foreach($build['order_tran'] as $build['order_tran_row'])
{
$i++;
$build['order_trans'][$i]['order_trans_id'] = $build['form']->formHidden('order_trans_id',$build['order_tran_row']['order_trans_id']);
$build['order_trans'][$i]['payment_status'] = array_search($build['order_tran_row']['payment_status'],$site_config['payment_status_lu']);
$build['order_trans'][$i]['payment_type'] = array_search($build['order_tran_row']['payment_type'],$site_config['payment_type_lu']);
$build['order_trans'][$i]['order_trans_created'] = date_form($build['order_tran_row']['order_trans_created']);
$build['order_trans'][$i]['dispatch'] = $build['form']->formSelect('dispatch',$build['model']->get_lookup_list("1"),$build['order_tran_row']['dispatch'],'','',1);
}
$build['tmpl']->frm_submit_btn2 = $build['form']->formButton('action','submit',"Update Dispatch");
$build['tmpl']->order_trans = $build['order_trans'];
}

///////////////////////////////////////////////////////////////////////////////Render The Page
$page['title'] = "Order History";
$build['tmpl']->admin_url = $site_config['admin_url'];
$page['body'] = $build['tmpl']->parse();

///////////////////////////////////////////////////////////////////////////////Tidy Up
unset($build);
?>