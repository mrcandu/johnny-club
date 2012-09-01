<?php 
$build['model'] = new customer();
$build['form'] = new form(1);
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_admin_customer.php');

///////////////////////////////////////////////////////////////////////////////Define ID
if($_POST['cust_id']!=""){$build['model']->cust_id = $_POST['cust_id'];}
///////////////////////////////////////////////////////////////////////////////Add / Update Procedure
if(isset($_POST['action']))
{
$build['model']->search_cust_id = trim($_POST['search_cust_id']);
$build['model']->search_forename = trim($_POST['search_forename']);
$build['model']->search_surname = trim($_POST['search_surname']);  
$build['model']->search_email = trim($_POST['search_email']);
$build['model']->search_postcode = trim($_POST['search_postcode']);

$build['model']->cust_forename = trim($_POST['cust_forename']);
$build['model']->cust_surname = trim($_POST['cust_surname']);  
$build['model']->cust_email = trim($_POST['cust_email']);
$build['model']->cust_tel = trim($_POST['cust_tel']);
$build['model']->cust_email = trim($_POST['cust_email']);
$build['model']->cust_mobile = trim($_POST['cust_mobile']);
$build['model']->cust_active = trim($_POST['cust_active']);
$build['model']->cust_pass = trim($_POST['cust_pass']);
$build['model']->cust_pass_check = trim($_POST['cust_pass_check']);

$build['model']->add_id = trim($_POST['add_id']);
$build['model']->add_name = trim($_POST['add_name']);
$build['model']->add_aline1 = trim($_POST['add_aline1']);
$build['model']->add_aline2 = trim($_POST['add_aline2']);
$build['model']->add_city = trim($_POST['add_city']);
$build['model']->add_county = trim($_POST['add_county']);
$build['model']->add_postcode = trim($_POST['add_postcode']);
$build['model']->add_country = trim($_POST['add_country']);
$build['model']->add_active = trim($_POST['add_active']);
$build['model']->add_default = trim($_POST['add_default']);
}

if($_POST['action']=="Add"){$build['model']->add_customer();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Email New User"){$build['model']->email_new_customer();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Update"){$build['model']->update_customer();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Delete Confirm"){$build['model']->delete_customer();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Email Reset Pass"){$build['model']->cust_forgot_pass();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Select Address"){$build['model']->get_address();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Add Address"){$build['model']->add_address();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Update Address"){$build['model']->update_address();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Delete Address Confirm"){$build['model']->delete_customer_address();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Close Address"){$build['model']->reset_address_fields();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Search"){$build['search_results'] = $build['model']->get_customer_list();$build['error']=$build['model']->error;}

///////////////////////////////////////////////////////////////////////////////Get Data For Form
$build['model']->get_customer();

///////////////////////////////////////////////////////////////////////////////Populate Template
$build['tmpl']->error = $build['error'];

//Search Form
$build['tmpl']->cust_id = $build['model']->cust_id;
$build['tmpl']->search_cust_id = $build['form']->formInput('search_cust_id',$build['model']->cust_id,'Membership No.');
$build['tmpl']->search_forename = $build['form']->formInput('search_forename',$build['model']->search_forename,'Forename');
$build['tmpl']->search_surname = $build['form']->formInput('search_surname',$build['model']->search_surname,'Surname');
$build['tmpl']->search_email = $build['form']->formInput('search_email',$build['model']->search_email,'Email');
$build['tmpl']->search_postcode = $build['form']->formInput('search_postcode',$build['model']->search_postcode,'Postcode');
$build['tmpl']->frm_search_btn = $build['form']->formButton('action','submit',"Search");

//Search Results
if(!empty($build['search_results']))
{
foreach($build['search_results'] as $build['search_results_row'])
{
$i++;
$build['search_results_list'][$i]['cust_name'] = $build['search_results_row']['cust_name'];
$build['search_results_list'][$i]['cust_email'] = $build['search_results_row']['cust_email'];
$build['search_results_list'][$i]['cust_address'] = $build['search_results_row']['cust_address'];
$build['search_results_list'][$i]['cust_id'] = $build['form']->formHidden('cust_id',$build['search_results_row']['cust_id']);	
}
$build['tmpl']->search_results = $build['search_results_list'];
$build['tmpl']->frm_select_btn = $build['form']->formButton('select','submit',"Select");
}

//Update Customer
$build['tmpl']->show_cust_id = $build['form']->formInput('cust_id',$build['model']->cust_id,'Membership No.','','1');
$build['tmpl']->cust_forename = $build['form']->formInput('cust_forename',$build['model']->cust_forename,'Forename',1);
$build['tmpl']->cust_surname = $build['form']->formInput('cust_surname',$build['model']->cust_surname,'Surname',1);
$build['tmpl']->cust_email = $build['form']->formInput('cust_email',$build['model']->cust_email,'Email:',1);
$build['tmpl']->cust_tel = $build['form']->formInput('cust_tel',$build['model']->cust_tel,'Telephone:');
$build['tmpl']->cust_mobile = $build['form']->formInput('cust_mobile',$build['model']->cust_mobile,'Mobile:');
$build['tmpl']->cust_active = $build['form']->formCheck('cust_active',$build['model']->cust_active,'Live');
if($build['model']->cust_id!=""){$build['btn_act'] = "Update";$build['cust_title'] = "Customer Details";}else{$build['btn_act'] = "Add";$build['cust_title'] = "Add New Customer";}
$build['tmpl']->frm_submit_btn1 = $build['form']->formButton('action','submit',$build['btn_act']);
$build['tmpl']->cust_title = $build['cust_title'];

if($_POST['action']!="Delete" and $build['model']->cust_id!="") {
$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete");
}
if($_POST['action']=="Delete") {
$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete Confirm");
}

if($build['model']->cust_id!="")
{
$build['tmpl']->frm_submit_btn2 = $build['form']->formButton('action','submit','Email New User');
$build['tmpl']->frm_submit_btn3 = $build['form']->formButton('action','submit','Email Reset Pass');
}

//Add Address
if($build['model']->cust_id!="")
{ 
//Address List
$build['cust_addlist'] = $build['model']->get_address_list();

if(!empty($build['cust_addlist']))
{
foreach($build['cust_addlist'] as $build['cust_addlist_row'])
{
$i++;
$build['cust_addresslist'][$i]['address'] = concat_address(array($build['cust_addlist_row']['add_name'],$build['cust_addlist_row']['add_aline1'],$build['cust_addlist_row']['add_aline2'],$build['cust_addlist_row']['add_city'],$build['cust_addlist_row']['add_county'],$build['cust_addlist_row']['add_postcode']),", ");

$build['cust_addresslist'][$i]['add_default'] = $build['cust_addlist_row']['add_default'];
$build['cust_addresslist'][$i]['add_id'] = $build['form']->formHidden('add_id',$build['cust_addlist_row']['add_id']);		
}

$build['tmpl']->cust_addlist = $build['cust_addresslist'];

$build['tmpl']->frm_select_btn5 = $build['form']->formButton('action','submit',"Select Address");
}

//Address Form    
$build['tmpl']->add_id = $build['form']->formHidden('add_id',$build['model']->add_id);
$build['tmpl']->cust_id = $build['form']->formHidden('cust_id',$build['model']->cust_id);
$build['tmpl']->add_name = $build['form']->formInput('add_name',$build['model']->add_name,'Recipient:',1);
$build['tmpl']->add_aline1 = $build['form']->formInput('add_aline1',$build['model']->add_aline1,'Address Line 1:',1);
$build['tmpl']->add_aline2 = $build['form']->formInput('add_aline2',$build['model']->add_aline2,'Address Line 2:');
$build['tmpl']->add_city = $build['form']->formInput('add_city',$build['model']->add_city,'Town / City:',1);
$build['tmpl']->add_county = $build['form']->formSelect('add_county',$site_config['county'],$build['model']->add_county,'County:',1);
$build['tmpl']->add_postcode = $build['form']->formInput('add_postcode',$build['model']->add_postcode,'Postcode:',1);
$build['tmpl']->add_country = $build['form']->formSelect('add_country',$site_config['country'],$build['model']->add_country,'Country:',1);
$build['tmpl']->add_active = $build['form']->formCheck('add_active',$build['model']->add_active,'Live:');
$build['tmpl']->add_default = $build['form']->formCheck('add_default',$build['model']->add_default,'Default:');

if($build['model']->add_id!=""){
$build['btn_act_6'] = "Update Address";
$build['tmpl']->frm_submit_btn7 = $build['form']->formButton('action','submit',"Close Address");
}
else{$build['btn_act_6'] = "Add Address";}
$build['tmpl']->frm_submit_btn6 = $build['form']->formButton('action','submit',$build['btn_act_6']);

if($_POST['action']!="Delete Address" and $build['model']->add_id!="") {
$build['tmpl']->frm_delete_btn5 = $build['form']->formButton('action','submit',"Delete Address");
}
if($_POST['action']=="Delete Address") {
$build['tmpl']->frm_delete_btn5 = $build['form']->formButton('action','submit',"Delete Address Confirm");
}

}

//Orders
if($build['model']->cust_id!="")
{ 
$build['orders'] = new order();
$build['orders']->cust_id = $build['model']->cust_id;
$build['order_list'] = $build['orders']->get_cust_orders();

if(!empty($build['order_list']))
{
foreach($build['order_list'] as $build['order_list_row'])
{
$i++;
$build['cust_order_list'][$i]['order_id'] = $build['order_list_row']['order_id'];
$build['cust_order_list'][$i]['order_name'] = $build['order_list_row']['order_name'];
$build['cust_order_list'][$i]['order_status'] = $build['order_list_row']['order_status_desc'];
$build['cust_order_list'][$i]['order_created'] = date_form($build['order_list_row']['order_created']);
$build['cust_order_list'][$i]['order_cancelled'] = date_form($build['order_list_row']['order_cancelled']);
$build['cust_order_list'][$i]['order_id_frm'] = $build['form']->formHidden('order_id',$build['order_list_row']['order_id']);		
}
$build['tmpl']->cust_order_list = $build['cust_order_list'];
$build['tmpl']->frm_select_btn8 = $build['form']->formButton('action','submit',"Select Order");
}

}
//

//Close Link
if($build['model']->cust_id!=""){$build['link_close'] = "<a href=\"\">Close Customer</a>";}
$build['tmpl']->link_close = $build['link_close'];

///////////////////////////////////////////////////////////////////////////////Render The Page
$page['title'] = "Customer";
$build['tmpl']->admin_url = $site_config['admin_url'];
$page['body'] = $build['tmpl']->parse();

///////////////////////////////////////////////////////////////////////////////Tidy Up
unset($build);
?>