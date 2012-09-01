<?php

$build['form'] = new form(1);



//Purchase Session

if(!empty($_POST['prd_id']))

{

$_SESSION['last_prd']['prd_id'] = $_POST['prd_id'];

$_SESSION['last_prd']['prd_item_id'] = $_POST['prd_item_id'];

$_SESSION['last_prd']['prd_price_id'] = $_POST['prd_price_id'];
$_SESSION['last_prd']['vcher'] = $_POST['vcher'];
}

if(!empty($_SESSION['last_prd']['prd_id']) and empty($_POST['prd_id']))

{

$_POST['prd_id'] = $_SESSION['last_prd']['prd_id'];

$_POST['prd_item_id'] = $_SESSION['last_prd']['prd_item_id'];

$_POST['prd_price_id'] = $_SESSION['last_prd']['prd_price_id'];
$_POST['vcher'] = $_SESSION['last_prd']['vcher'];
}



///////////////////////////////////////////////////////////////////////////////Actions



if($_POST['action']=="Add Address")

{

$build['cust'] = new customer();

if(empty($_SESSION['cust']['cust_surname'])){

$build['cust']->add_cust_up = 1;

$build['cust']->cust_forename = trim($_POST['cust_forename']);

$build['cust']->cust_surname = trim($_POST['cust_surname']);

}

$build['cust']->cust_id = $_SESSION['cust']['cust_id'];

$build['cust']->add_name = trim($_POST['add_name']);

$build['cust']->add_aline1 = trim($_POST['add_aline1']);

$build['cust']->add_aline2 = trim($_POST['add_aline2']);

$build['cust']->add_city = trim($_POST['add_city']);

$build['cust']->add_county = trim($_POST['add_county']);

$build['cust']->add_postcode = trim($_POST['add_postcode']);

$build['cust']->add_country = trim($_POST['add_country']);

$build['cust']->add_active = "1";

$build['cust']->add_default = "1";

$build['cust']->add_address();

$build['error']=$build['cust']->error;



if(empty($_SESSION['cust']['cust_surname'])){

$build['cust']->get_customer();

$build['cust']->cust_forename = trim($_POST['cust_forename']);

$build['cust']->cust_surname = trim($_POST['cust_surname']);

$build['cust']->update_customer();

$build['cust']->custSession();

}







}



///////////////////////////////////////////////////////////////////////////////Page

////User Login Stuff

if(!isset($_SESSION['cust'])) {

header("Location: ".$site_config['url']."user/signin/");

exit;

}

else {

////Purchase Confirm

if($_POST['action'] == "Get Jiggy"){

unset($_SESSION['last_prd']);

$build['title'] = "Payment - One Pound Johnny Club";

$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_site_purchase_confirm.php');

$build['tmpl']->error = $build['error'];

$build['tmpl']->page_path = $site_config['url'];

$build['order'] = new order;

$build['order']->cust_id = $_SESSION['cust']['cust_id'];

$build['order']->add_id = $_POST['add_id'];

$build['order']->prd_id = $_POST['prd_id'];

$build['order']->prd_item_id = $_POST['prd_item_id'];

$build['order']->prd_price_id = $_POST['prd_price_id'];

$build['order']->vcher = $_POST['vcher'];

$build['order']->create_order_stage();



$build['order']->get_address();





$build['tmpl']->item_name = $build['order']->product_name.": ".$build['order']->item_name.", ".$build['order']->price_description;

$build['tmpl']->item_number = $build['order']->item_number;

$build['tmpl']->a3 = $build['order']->total_cost;

$build['tmpl']->t3 = $site_config['paypal_t3'];

$build['tmpl']->custom = $build['order']->order_hash;

$build['tmpl']->paypal_url = $site_config['paypal_url'];

$build['tmpl']->paypal_business = $site_config['paypal_business'];



$build['tmpl']->add_aline1 = $build['order']->add_aline1;

$build['tmpl']->add_aline2 = $build['order']->add_aline2;

$build['tmpl']->add_city = $build['order']->add_city;

$build['tmpl']->add_county = $build['order']->add_county;

$build['tmpl']->add_postcode = $build['order']->add_postcode;

$build['tmpl']->add_country = $build['order']->add_country;

$build['tmpl']->first_name = $_SESSION['cust']['cust_forename'];

$build['tmpl']->last_name = $_SESSION['cust']['cust_surname'];

$build['tmpl']->email = $_SESSION['cust']['cust_email'];



$page['jquery'] = '<script src="'.$site_config['url'].'incfiles/js_site_purchase_confirm.js"></script>';

}

////



////Purchase Product

else {

$build['title'] = "Purchase - One Pound Johnny Club";

$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_site_purchase.php');

$build['tmpl']->error = $build['error'];

$build['tmpl']->page_path = $site_config['url'];





//Order Details

$build['order'] = new order;

$build['order']->cust_id = $_SESSION['cust']['cust_id'];

$build['order']->prd_id = $_SESSION['last_prd']['prd_id'];

$build['order']->prd_item_id = $_SESSION['last_prd']['prd_item_id'];

$build['order']->prd_price_id = $_SESSION['last_prd']['prd_price_id'];

$build['order']->vcher = $_SESSION['last_prd']['vcher'];

$build['order']->purchase_details();

$build['tmpl']->product_name = $build['order']->product_name;

$build['tmpl']->price_description = $build['order']->price_description;

$build['tmpl']->v_desc = $build['order']->v_desc;

$build['tmpl']->item_name = $build['order']->item_name;

$build['tmpl']->item_number = $build['order']->item_number;

$build['tmpl']->subtotal = $build['order']->price;

$build['tmpl']->pandp = $build['order']->delivery_cost;

$build['tmpl']->grandtotal = $build['order']->total_cost." / Month";



//Add Address

if($build['cust']->add_country==""){$build['cust']->add_country="GB";}



if(empty($_SESSION['cust']['cust_surname'])){

$build['tmpl']->cust_forename = $build['form']->formInput('cust_forename',$build['cust']->cust_forename,'Forename');

$build['tmpl']->cust_surname = $build['form']->formInput('cust_surname',$build['cust']->cust_surname,'Surname');

}

elseif($build['cust']->add_name==""){$build['cust']->add_name=$_SESSION['cust']['logged_in_as'];}



$build['tmpl']->add_name = $build['form']->formInput('add_name',$build['cust']->add_name,'Recipient:');

$build['tmpl']->add_aline1 = $build['form']->formInput('add_aline1',$build['cust']->add_aline1,'Address Line 1:');

$build['tmpl']->add_aline2 = $build['form']->formInput('add_aline2',$build['cust']->add_aline2,'Address Line 2:');

$build['tmpl']->add_city = $build['form']->formInput('add_city',$build['cust']->add_city,'Town / City:');

$build['tmpl']->add_county = $build['form']->formSelect('add_county',$site_config['county'],$build['cust']->add_county,'County:','','',1);

$build['tmpl']->add_postcode = $build['form']->formInput('add_postcode',$build['cust']->add_postcode,'Postcode:');

$build['tmpl']->add_country = $build['form']->formSelect('add_country',$site_config['country'],$build['cust']->add_country,'Country:','',1,1);





$build['cust_addlist'] = $site['customer']->get_address_list();



if(!empty($build['cust_addlist']))

{

foreach($build['cust_addlist'] as $build['cust_addlist_row'])

{

$i++;



$build['cust_addresslist'][$i]['address'] = concat_address(array($build['cust_addlist_row']['add_name'],$build['cust_addlist_row']['add_aline1'],$build['cust_addlist_row']['add_aline2'],$build['cust_addlist_row']['add_city'],$build['cust_addlist_row']['add_county'],$build['cust_addlist_row']['add_postcode']),", ");

$build['cust_addresslist'][$i]['add_default'] = $build['cust_addlist_row']['add_default'];



//Select Address

if(!empty($_POST['add_id']) and $build['cust_addlist_row']['add_id'] == $_POST['add_id']){$build['add_id']=1;}

elseif(!empty($_POST['add_id']) and $build['cust_addlist_row']['add_id'] != $_POST['add_id']){$build['add_id']=0;}

else{$build['add_id']=$build['cust_addlist_row']['add_default'];}

$build['cust_addresslist'][$i]['add_id'] = $build['form']->formRadio('add_id',$build['cust_addlist_row']['add_id'],'','',$build['add_id']);		

}

$build['tmpl']->cust_addlist = $build['cust_addresslist'];

}



$build['tmpl']->prd_id = $build['form']->formHidden('prd_id',$_SESSION['last_prd']['prd_id']);

$build['tmpl']->prd_item_id = $build['form']->formHidden('prd_item_id',$_SESSION['last_prd']['prd_item_id']);

$build['tmpl']->prd_price_id = $build['form']->formHidden('prd_price_id',$_SESSION['last_prd']['prd_price_id']);

$build['tmpl']->vcher = $build['form']->formHidden('vcher',$_SESSION['last_prd']['vcher']);

$page['jquery'] = '<script src="'.$site_config['url'].'incfiles/js_site_purchase.js"></script>';

}

////

		

$page['title'] = $build['title'];

$page['body'] = $build['tmpl']->parse();



}

///////////////////////////////////////////////////////////////////////////////Tidy Up

unset($build);

?>