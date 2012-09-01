<?php

class order {

 	

 	protected $connect,$sql; 

	





	//DB Connect & Syslog

	public function __construct() {

		global $site_config;

		$this->connect = $site_config['connect']; 

		$this->syslog = new syslog();

	}

	

	//Create Stage Order

	public function purchase_details() {

	//Product Details
	
	if(!empty($this->vcher)){
		$this->check_voucher();
	}
		
	$product = new product(); 

	$product->prd_id = $this->prd_id;

	$product->prd_price_id = $this->prd_price_id;

	$product->get_product();	

	$price = $product->get_price();	

	$this->price = number_format($price['price'],2,'.', ' ');

	$this->price_code = $price['price_code'];

	$this->price_description = $price['price_type_desc'];

	$this->delivery_cost = number_format($product->delivery_cost,2,'.', ' ');

	$this->total_cost = number_format($this->price + $this->delivery_cost,2,'.', ' ');

	$this->product_name = $product->prd_name;	

	$this->product_number = $this->prd_id;

	

	//Item Details

	$product->prd_id = $this->prd_item_id;

	$product->get_product();

	$this->item_name = $product->prd_site_name;

	$this->item_number = trim($product->prd_code.$this->price_code);

	}


	//Get Stage Order Details
	public function check_voucher() {
	
		//echo "Yoooooooooooooo!<br>";
 		$this->sql = "SELECT * FROM voucher WHERE v_live = '1' AND LOWER(v_code) = '".addslashes(strtolower(trim($this->vcher)))."';";			
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		if(!empty($result[0]))
		{
		foreach ($result[0] as $col => $val)
		{
		$this->$col = $val;
		}
		}
		//echo $this->v_code."<br>";
		//echo $this->v_desc;
	}	

	//Create Stage Order

	public function create_order_stage() {

		$this->purchase_details();

		$this->order_hash = md5(uniqid()); 

 		$this->sql = "INSERT INTO order_stage (order_hash,cust_id,order_created,add_id,prd_id,prd_item_id,prd_price_id,price,del,tot_price,order_new,v_code) VALUES (

		'".addslashes($this->order_hash)."',

		'".addslashes($this->cust_id)."',

		'".addslashes(date("Y-m-d H:i:s"))."',

		'".addslashes($this->add_id)."',

		'".addslashes($this->prd_id)."',

		'".addslashes($this->prd_item_id)."',

		'".addslashes($this->prd_price_id)."',

		'".addslashes($this->price)."',

		'".addslashes($this->delivery_cost)."',

		'".addslashes($this->total_cost)."',

		'1',
		
		'".addslashes($this->v_code)."'

		);";			

		$this->connect->query($this->sql);

	}



	//Delete Stage Order

	public function delete_stage_order() {

 		$this->sql = "DELETE FROM order_stage WHERE order_hash = '".addslashes($this->order_hash)."';";			

		$this->connect->query($this->sql);

	}



	//Tidy Stage Order

	public function tidy_stage_order() {

 		$this->sql = "DELETE FROM order_stage WHERE order_created < '".addslashes(date("Y-m-d",strtotime("- 1 day")))."';";			

		$this->connect->query($this->sql);

	}

		

	//Get Order Details

	public function get_order() {	

	$this->get_orders();

	if($this->cust_id==""){

	$this->get_order_stage();

	}	

	}

				

	//Get Stage Order Details

	public function get_order_stage() {

	

 		$this->sql = "SELECT * FROM order_stage WHERE order_hash = '".addslashes($this->order_hash)."';";			

		$this->connect->query($this->sql);

		$result = $this->connect->resultArray();

		if(!empty($result[0]))

		{

		foreach ($result[0] as $col => $val)

		{

		$this->$col = $val;

		}

		}

				

	}



	//Get Order Details

	public function get_orders() {

	

 		$this->sql = "SELECT * FROM orders WHERE order_hash = '".addslashes($this->order_hash)."';";			

		$this->connect->query($this->sql);

		$result = $this->connect->resultArray();

		if(!empty($result[0]))

		{

		foreach ($result[0] as $col => $val)

		{

		$this->$col = $val;

		}

		}

				

	}





	//Create Error

	public function create_error($err) {	

 		$this->sql = "INSERT INTO paypal_error (error_code,paypal_report) VALUES ('".addslashes($err)."','".addslashes($this->report)."');";			

		$this->connect->query($this->sql);	

	}

	

		//Get Address

		public function get_address() {

		if($this->add_id!="")

		{

		$this->sql = 'SELECT add_name,add_aline1,add_aline2,add_city,add_county,add_postcode,add_country FROM customer_address WHERE add_id = '.$this->add_id;

		$this->connect->query($this->sql);

		$result = $this->connect->resultArray();

		if(!empty($result[0]))

		{

		foreach ($result[0] as $col => $val)

		{

		$this->$col = $val;

		}

		}

		}

		}

		

	//Create Order

	public function create_order() {

		global $site_config;

		$this->get_address();

  

 		$this->sql = "INSERT IGNORE INTO orders (order_hash,subscr_id,cust_id,order_name,order_code,order_created,order_updated,order_status,prd_id,prd_item_id,prd_price_id,add_name,add_aline1,add_aline2,add_city,add_county,add_postcode,add_country,price,del,tot_price,v_code) VALUES (

		'".addslashes($this->order_hash)."',

		'".addslashes($this->subscr_id)."',

		'".addslashes($this->cust_id)."',

		'".addslashes($this->order_name)."',

		'".addslashes($this->order_code)."',

		'".addslashes(date("Y-m-d H:i:s"))."',

		'".addslashes(date("Y-m-d H:i:s"))."',

		'".addslashes($this->txn_type)."',

		'".addslashes($this->prd_id)."',

		'".addslashes($this->prd_item_id)."',

		'".addslashes($this->prd_price_id)."',

		'".addslashes($this->add_name)."',

		'".addslashes($this->add_aline1)."',

		'".addslashes($this->add_aline2)."',

		'".addslashes($this->add_city)."',

		'".addslashes($this->add_county)."',

		'".addslashes($this->add_postcode)."',

		'".addslashes($this->add_country)."',

		'".addslashes($this->price)."',

		'".addslashes($this->del)."',

		'".addslashes($this->tot_price)."',
		
		'".addslashes($this->v_code)."'

		);";			

		$this->connect->query($this->sql);

		$this->order_id = $this->connect->InsertID();



	}

	

	//Create Order

	public function create_action() {	

		global $site_config;

		$this->sql = "SELECT COUNT(txn_id) cnt_txn FROM order_trans WHERE txn_id = '".addslashes($this->txn_id)."' AND order_id = '".addslashes($this->order_id)."';";			

		$this->connect->query($this->sql);

		$result = $this->connect->resultArray();

		if($result[0]['cnt_txn']>=1)

		{

		$this->cnt_txn = 1;

		}

		

		if($this->cnt_txn!=1) {

		

		$this->sql = "SELECT COUNT(txn_id) dispatch_no FROM order_trans WHERE order_id = '".addslashes($this->order_id)."';";			

		$this->connect->query($this->sql);

		$result = $this->connect->resultArray();

		if($result[0]['dispatch_no']>=1)

		{

		$this->dispatch_no = $result[0]['dispatch_no']++;

		}

		else

		{

		$this->dispatch_no = 1;

		}

		

 		$this->sql = "INSERT IGNORE INTO order_trans (order_id,txn_id,payment_status,payment_type,order_trans_created,order_trans_updated,dispatch,dispatch_no) VALUES (

		'".addslashes($this->order_id)."',

		'".addslashes($this->txn_id)."',	

		'".addslashes($site_config['payment_status_lu'][$this->payment_status])."',

		'".addslashes($site_config['payment_type_lu'][$this->payment_type])."',

		'".addslashes(date("Y-m-d H:i:s"))."',

		'".addslashes(date("Y-m-d H:i:s"))."',

		'1',

		'".addslashes($this->dispatch_no)."'

		);";			

		$this->connect->query($this->sql);	

		}

		

		else {

		$this->sql = "UPDATE order_trans SET

		order_trans_updated = '".addslashes(date("Y-m-d H:i:s"))."',

		payment_status = '".addslashes($site_config['payment_status_lu'][$this->payment_status])."',

		payment_type = '".addslashes($site_config['payment_type_lu'][$this->payment_type])."'

		WHERE order_id = '".addslashes($this->order_id)."' AND

		txn_id = '".addslashes($this->txn_id)."';";	

		$this->connect->query($this->sql);	

		}

		

	}	

			

		//Create Order

	public function update_order() {	

		global $site_config;

		

		//Cancelled

		if($this->txn_type==2) {

		$cancelled = date("Y-m-d H:i:s");

		}

		

		$this->sql = "UPDATE orders SET

		subscr_id = '".addslashes($this->subscr_id)."',

		order_status = '".addslashes($this->txn_type)."',

		order_updated = '".addslashes(date("Y-m-d H:i:s"))."',

		order_cancelled = '".addslashes($cancelled)."'

		WHERE order_id = '".addslashes($this->order_id)."'

		AND order_status != '2';";	

		$this->connect->query($this->sql);	

		}

		

	//Customer Orders

	public function get_cust_orders($f=null) {

	

		if($f==1){$sql="AND a.order_cancelled = '0000-00-00 00:00:00'";}

		elseif($f==2){$sql="AND a.order_cancelled != '0000-00-00 00:00:00'";}

		

		$this->sql = "SELECT a.*, b.lu_desc order_status_desc

		FROM orders a

		LEFT JOIN lookup b ON a.order_status = b.lu_key AND b.lu_id = '3'

		WHERE a.cust_id = ".$this->cust_id."

		".$sql."

		ORDER BY a.order_id DESC";

		$this->connect->query($this->sql);

		return $this->connect->resultArray();

	}

	

	//For Order Details form in Admin

		public function get_order_details() {

		if(!empty($this->order_id)){

		$this->sql = "SELECT a.*, b.cust_forename, b.cust_surname, b.cust_email, c.lu_desc order_status_desc

		FROM orders a

		INNER JOIN customer b ON a.cust_id = b.cust_id

		LEFT JOIN lookup c ON a.order_status = c.lu_key AND c.lu_id = '3'

		WHERE a.order_id = ".$this->order_id;

		$this->connect->query($this->sql);

		$result = $this->connect->resultArray();

		if(!empty($result[0]))

		{

		foreach ($result[0] as $col => $val)

		{

		$this->$col = $val;

		}

		}

		}



	}



	//For Order Details form in Admin

		public function get_order_trans() {

		if(!empty($this->order_id)){

		$this->sql = "SELECT a.*

		FROM order_trans a

		WHERE a.order_id = ".$this->order_id."

		ORDER BY order_trans_id DESC;";

		$this->connect->query($this->sql);

		return $this->connect->resultArray();

		}



	}

	

		//Get Dispatch Status

	public function get_lookup_list($lu) {

		$this->sql = "SELECT lu_key, lu_desc FROM lookup WHERE lu_id = ".$lu.";";

		$this->connect->query($this->sql);

		return $this->connect->resultArrayValues();

	}

	

		//Update Shipping Address

	public function update_shipping() {			

		$this->sql = "UPDATE orders SET

		add_aline1 = '".addslashes($this->add_aline1)."',

		add_aline2 = '".addslashes($this->add_aline2)."',

		add_city = '".addslashes($this->add_city)."',

		add_county = '".addslashes($this->add_county)."',

		add_postcode = '".addslashes($this->add_postcode)."',

		add_country = '".addslashes($this->add_country)."'

		WHERE order_id = '".addslashes($this->order_id)."';";	

		$this->connect->query($this->sql);	

	}

		//Update Shipping Address

	public function update_dispatch() {			

		$this->sql = "UPDATE order_trans SET

		dispatch = '".addslashes($this->dispatch)."'

		WHERE order_trans_id = '".addslashes($this->order_trans_id)."';";	

		$this->connect->query($this->sql);	

	}

	

		//Update Order Status - Used for cancellation pending

		public function cancel_order() {

		

		if(!empty($this->order_hash)){

		

		$this->sql = "SELECT a.subscr_id, a.order_id

		FROM orders a

		WHERE a.order_hash = '".$this->order_hash."' AND cust_id = ".$this->cust_id.";";

		$this->connect->query($this->sql);

		$result = $this->connect->resultArray();

		if(!empty($result[0]))

		{

		$this->subscr_id = $result[0]['subscr_id'];

		$this->order_id = $result[0]['order_id'];

		}



		if(!empty($this->order_id)){

		

		$pp = new opjc_paypal();

		$pp->profile_id = $this->subscr_id;

		$pp->action = "Cancel";

		$pp->change_subscription_status();

		

		$this->error = $pp->error;

		$this->success = $pp->success;

			

		$this->sql = "UPDATE orders SET

		order_status = '7'

		WHERE order_id = ".addslashes($this->order_id).";";	

		$this->connect->query($this->sql);

		}

		else

		{

		$this->error=1;

		}

		}

		else

		{

		$this->error=1;

		}



	}

		

	//Email New Order

	public function email_new_order()

	{

		global $site_config;

		$tmpl = new Templater($site_config['path'].'templates/tmpl_email_new_ordernew.php');

		

		$customer = new customer(); 

		$customer->cust_id = $this->cust_id;

		$customer->get_customer();

		

		$tmpl->cust_forename = $customer->cust_forename;

		$tmpl->cust_email = $customer->cust_email;

		$tmpl->order_name = $this->order_name." - &pound; ".$this->tot_price." / Month";

		$tmpl->delivery = concat_address(array($this->add_name,$this->add_aline1,$this->add_aline2,$this->add_city,$this->add_county,$this->add_postcode),"<br>");



		

		$body = $tmpl->parse();

				

		$this->email = new email();

		$this->email->subject = "Thanks for your order!";

		$this->email->body = $body;

		$this->email->to_email = $customer->cust_email;

		$this->email->to_name = $customer->cust_forename." ".$customer->cust_surname;

		

		/*

		$this->email->host = $site_config['contact_email']['2']['host'];

		$this->email->port = $site_config['contact_email']['2']['port'];

		$this->email->smtp = $site_config['contact_email']['2']['smtp'];

		$this->email->username = $site_config['contact_email']['2']['username'];

		$this->email->password = $site_config['contact_email']['2']['password'];

		$this->email->from_name = $site_config['contact_email']['2']['from_name'];

		$this->email->from_email = $site_config['contact_email']['2']['from_email'];	

		$this->email->send_email();

		*/

		

		$this->email->email_from_id = 2;				

		$this->email->create_email();		

		

		$this->error = $this->email->error;

	}

	

	//For Order Details form in User Home

	public function get_customer_orders() 

	{

		if(!empty($this->cust_id)){

		$this->sql = "SELECT a.order_id, a.order_hash, a.subscr_id, a.order_name, a.order_created, a.order_cancelled, a.order_status, concat(a.add_name,' ',a.add_aline1,' ',add_aline2,' ',add_city,' ',add_county,' ',add_postcode) address, a.tot_price, b.prd_name, c.prd_site_name prd_item_name, d.order_trans_created, f.lu_desc dispatch, g.lu_desc order_status_desc, CASE WHEN a.order_status = '7' THEN '1' ELSE '0' END cancel_pend

		FROM orders a

		LEFT JOIN product b ON a.prd_id = b.prd_id

		LEFT JOIN product c ON a.prd_item_id = c.prd_id

		LEFT JOIN order_trans d ON a.order_id = d.order_id AND d.order_trans_id = (SELECT MAX(e.order_trans_id) FROM order_trans e WHERE a.order_id = e.order_id)

		LEFT JOIN lookup f ON d.dispatch = f.lu_key AND f.lu_id = '1'

		LEFT JOIN lookup g ON a.order_status = g.lu_key AND g.lu_id = '3'

		WHERE a.cust_id = ".addslashes($this->cust_id)."

		ORDER BY a.order_id DESC";

		$this->connect->query($this->sql);

		return $this->connect->resultArray();

		}

	}



public function get_order_payments() 

	{

		if(!empty($this->order_id)){

		$this->sql = "SELECT count(order_id) payments FROM order_trans WHERE order_id = ".addslashes($this->order_id)." AND payment_status = 2";

		$this->connect->query($this->sql);

		$result = $this->connect->resultArray();

		return $result[0]['payments'];

		}



	}	

		

	//Search Orders in Admin

	public function search_orders() 

	{

		//

		if(!empty($this->batch_id)){

		$sql_crit[1]="AND d.batch_id = ".addslashes($this->batch_id);

		}

		else {

		

		if(!empty($this->dispatch)){$sql_crit[1]="AND d.dispatch = ".addslashes($this->dispatch);}

		if(!empty($this->order_status)){$sql_crit[2]="AND a.order_status = ".addslashes($this->order_status);}

		if(!empty($this->payment_status)){$sql_crit[3]="AND d.payment_status = ".addslashes($this->payment_status);}

		if(($this->order_switch=="1") or empty($this->order_switch)){$sql_crit[4]="AND d.order_trans_id = (SELECT MAX(e.order_trans_id) FROM order_trans e WHERE a.order_id = e.order_id) ";}

		

		if(!empty($this->date_start)){

			if($this->order_switch=="1"){

				$sql_crit[5]="AND a.order_created >= '".addslashes(date_rev($this->date_start))."'";

			}

			if($this->order_switch=="2"){

				$sql_crit[5]="AND d.order_trans_created >= '".addslashes(date_rev($this->date_start))."'";

			}

		}

		

		if(!empty($this->date_end)){

			if($this->order_switch=="1"){

				$sql_crit[6]="AND CAST(a.order_created AS DATE) <= '".addslashes(date_rev($this->date_end))."'";

			}

			if($this->order_switch=="2"){

				$sql_crit[6]="AND CAST(d.order_trans_created AS DATE) <= '".addslashes(date_rev($this->date_end))."'";

			}

		}

		

		if(empty($sql_crit)){$sql_crit[0]=" LIMIT 0,30";}

		

		} //

		

		

	

		$this->sql = "SELECT 

		a.order_id, 

		CONCAT(aa.cust_forename,' ',aa.cust_surname) cust_name,

		aa.cust_email,

		a.order_created, 

		a.order_cancelled, 

		g.lu_desc order_status_desc, 

		h.lu_desc payment_status, 

		CONCAT(a.order_code,IF (d.dispatch_no = 1,'-N','')) order_code,

		b.prd_name, 

		c.prd_name prd_item_name, 

		a.tot_price, 

		CONCAT(

		IF(a.add_name != '',CONCAT(a.add_name,'\n'),''),

		IF(a.add_aline1 != '',CONCAT(a.add_aline1,'\n'),''),

		IF(a.add_aline2 != '',CONCAT(a.add_aline2,'\n'),''),

		IF(a.add_city != '',CONCAT(a.add_city,'\n'),''),

		IF(a.add_county != '',CONCAT(a.add_county,'\n'),''),

		a.add_postcode

		) dispatch_address,

		d.order_trans_id,

		d.order_trans_created, 

		f.lu_desc dispatch, 

		d.batch_id,
		
		a.v_code voucher,
		
		i.cnt,

		IF (d.dispatch_no = 1,'Yes','No') new_order

		FROM orders a

		INNER JOIN customer aa ON a.cust_id = aa.cust_id

		LEFT JOIN product b ON a.prd_id = b.prd_id

		LEFT JOIN product c ON a.prd_item_id = c.prd_id

		LEFT JOIN order_trans d ON a.order_id = d.order_id ".$sql_crit[4]."

		LEFT JOIN lookup f ON d.dispatch = f.lu_key AND f.lu_id = '1'

		LEFT JOIN lookup g ON a.order_status = g.lu_key AND g.lu_id = '3'

		LEFT JOIN lookup h ON d.payment_status = h.lu_key AND h.lu_id = '2'
		
		LEFT JOIN (SELECT order_id, COUNT(*) cnt FROM order_trans GROUP BY order_id) i ON a.order_id = i.order_id

		WHERE a.order_id IS NOT NULL

		".$sql_crit[1]."

		".$sql_crit[2]."

		".$sql_crit[3]."

		".$sql_crit[5]."

		".$sql_crit[6]."

		ORDER BY IF (d.dispatch_no = 1,'Yes','No') ASC, a.order_code, a.order_id".$sql_crit[0]."";

		$this->connect->query($this->sql);

		return $this->connect->resultArray();

		

	}	



	//Search Orders in Admin

	public function await_dispatch() 

	{

	$this->order_switch = "2";

	$this->dispatch  = "1";

	$this->payment_status = "2";

	//$this->order_status = "1";

	}

	

	//Search Orders in Admin

	public function create_batch() 

	{

	$this->sql = "INSERT INTO order_batch (batch_id) VALUES ('')";

	$this->connect->query($this->sql);

	$this->batch_id = $this->connect->InsertID();



	$this->sql = "	UPDATE order_trans a

					INNER JOIN orders b ON a.order_id = b.order_id

					SET a.batch_id = ".$this->batch_id.",

					a.dispatch = '2'

					WHERE a.dispatch = ".addslashes($this->dispatch)."

					AND a.payment_status = ".addslashes($this->payment_status).";";

	$this->connect->query($this->sql);

	}

	

	//Search Orders in Admin

	public function set_dispatched() 

	{

	$this->sql = "	UPDATE order_trans a

					SET a.dispatch = '3'

					WHERE a.batch_id = ".addslashes($this->batch_id).";";

	$this->connect->query($this->sql);

	}





	//Search Orders in Admin

	public function export_batch($a) 

	{

	header("Content-type: application/csv");

	header("Content-Disposition: attachment; filename=OPJC_Export.csv");

	header("Pragma: no-cache");

	header("Expires: 0");



	echo $this->arr_to_csv($a);

	exit();

	

	}

	

	public function arr_to_csv($a,$h=1) {

			$h="";

		foreach ($a as $r) {

			$head="";

			$row="";

			foreach ($r as $c => $v) {

				if(empty($h)){

				$head .= '"' .str_replace('"', '""', $c) . '",';

				}

				$row .= '"' .str_replace('"', '""',$v) . '",';

			}

			

			if(empty($h)){

			$h=1;

			$lines .= substr($head,0,-1)."\r\n";

			}

			

			$lines .= substr($row,0,-1)."\r\n";

		}

		return $lines;

	}

	

}	

?>