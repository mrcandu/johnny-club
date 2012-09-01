<?php 

$build['model'] = new order();

$build['form'] = new form(1);

$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_admin_orders.php');



///////////////////////////////////////////////////////////////////////////////Add / Update Procedure



if($_POST['action']=="Export To CSV" or $_POST['action']=="Search Batch")

{

$build['model']->batch_id = trim($_POST['batch_id']);

}



if($_POST['action']=="Export To CSV" or $_POST['action']=="Search")

{

$build['model']->order_switch = trim($_POST['order_switch']);

$build['model']->dispatch = trim($_POST['dispatch']);

$build['model']->payment_status = trim($_POST['payment_status']);

$build['model']->order_status = trim($_POST['order_status']);

$build['model']->date_start = trim($_POST['date_start']);

$build['model']->date_end = trim($_POST['date_end']);

}



if($_GET['ctrl3']=="dispatch")

{

$build['model']->await_dispatch();

}



if($_POST['action']=="Create Dispatch Batch")

{

$build['model']->await_dispatch();

$build['model']->create_batch();

}

if($_POST['action']=="Set Items Dispatched")

{

$build['model']->batch_id = trim($_POST['batch_id']);

$build['model']->set_dispatched();

}



//Get List of Orders

$build['order_list'] = $build['model']->search_orders();



if($_POST['action']=="Export To CSV")

{

$build['model']->export_batch($build['order_list']);

}



///////////////////////////////////////////////////////////////////////////////Populate Template

$build['tmpl']->error = $build['error'];



//Search Form

if(!empty($build['model']->order_switch) and $build['model']->order_switch == "1"){$build['switch_order_order']=1;}

elseif(!empty($build['model']->order_switch) and $build['model']->order_switch == "2"){$build['switch_order_trans']=1;}

else{$build['switch_order_order']=1;}



$build['tmpl']->order_switch_order = $build['form']->formRadio('order_switch','1','Search Orders','',$build['switch_order_order']);

$build['tmpl']->order_switch_trans = $build['form']->formRadio('order_switch','2','Search Transactions','',$build['switch_order_trans']);



$build['tmpl']->dispatch = $build['form']->formSelect('dispatch',$build['model']->get_lookup_list("1"),$build['model']->dispatch,'Dispatch Status:');

$build['tmpl']->payment_status = $build['form']->formSelect('payment_status',$build['model']->get_lookup_list("2"),$build['model']->payment_status,'Payment Status:');

$build['tmpl']->order_status = $build['form']->formSelect('order_status',$build['model']->get_lookup_list("3"),$build['model']->order_status,'Order Status:');

$build['tmpl']->date_start = $build['form']->formInput('date_start',$build['model']->date_start,'Date Start:');

$build['tmpl']->date_end = $build['form']->formInput('date_end',$build['model']->date_end,'Date End:');

$build['tmpl']->frm_search_btn = $build['form']->formButton('action','submit',"Search");

$build['tmpl']->batch_id = $build['form']->formInput('batch_id',$build['model']->batch_id,'Batch No.:');

$build['tmpl']->frm_search_btn2 = $build['form']->formButton('action','submit',"Search Batch");



if(empty($build['model']->batch_id) and $_GET['ctrl3']=="dispatch"){

$build['tmpl']->frm_search_btn3 = $build['form']->formButton('action','submit',"Create Dispatch Batch");

}

elseif(!empty($build['model']->batch_id)){

$build['tmpl']->frm_search_btn4 = $build['form']->formButton('action','submit',"Set Items Dispatched");

$build['tmpl']->batch_id_hide = $build['form']->formHidden('batch_id',$build['model']->batch_id);

}

$build['tmpl']->frm_search_btn5 = $build['form']->formButton('action','submit',"Export To CSV");



$build['tmpl']->order_switch_order_hide = $build['form']->formHidden('order_switch',$build['model']->order_switch);

$build['tmpl']->dispatch_hide = $build['form']->formHidden('dispatch',$build['model']->dispatch);

$build['tmpl']->payment_status_hide = $build['form']->formHidden('payment_status',$build['model']->payment_status);

$build['tmpl']->order_status_hide = $build['form']->formHidden('order_status',$build['model']->order_status);

$build['tmpl']->date_start_hide = $build['form']->formHidden('date_start',$build['model']->date_start);

$build['tmpl']->date_end_hide = $build['form']->formHidden('date_end',$build['model']->date_end);



//Orders

if(!empty($build['order_list']))

{

foreach($build['order_list'] as $build['order_list_row'])

{

$i++;

$build['cust_order_list'][$i]['order_id'] = $build['order_list_row']['order_id'];

$build['cust_order_list'][$i]['order_name'] = $build['order_list_row']['prd_name']." : ".$build['order_list_row']['prd_item_name'];

$build['cust_order_list'][$i]['order_status'] = $build['order_list_row']['order_status_desc'];

$build['cust_order_list'][$i]['payment_status'] = $build['order_list_row']['payment_status'];

$build['cust_order_list'][$i]['order_created'] = date_form($build['order_list_row']['order_created']);

$build['cust_order_list'][$i]['order_cancelled'] = date_form($build['order_list_row']['order_cancelled']);

$build['cust_order_list'][$i]['order_trans_created'] = date_form($build['order_list_row']['order_trans_created']);

$build['cust_order_list'][$i]['dispatch'] = $build['order_list_row']['dispatch'];

$build['cust_order_list'][$i]['batch_id'] = $build['order_list_row']['batch_id'];

$build['cust_order_list'][$i]['voucher'] = $build['order_list_row']['voucher'];

$build['cust_order_list'][$i]['cnt'] = $build['order_list_row']['cnt'];

$build['cust_order_list'][$i]['order_id_frm'] = $build['form']->formHidden('order_id',$build['order_list_row']['order_id']);		

}

$build['tmpl']->cust_order_list = $build['cust_order_list'];

$build['tmpl']->frm_select_btn8 = $build['form']->formButton('action','submit',"Select Order");

}

//



///////////////////////////////////////////////////////////////////////////////Render The Page

$page['title'] = "Orders";

$build['tmpl']->admin_url = $site_config['admin_url'];

$page['body'] = $build['tmpl']->parse();



///////////////////////////////////////////////////////////////////////////////Tidy Up

unset($build);

?>