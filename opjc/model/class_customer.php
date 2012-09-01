<?php
class customer {
 
 	protected $connect,$sql; 
	
	//DB Connect & Syslog
	public function __construct() {
		global $site_config;
		$this->connect = $site_config['connect']; 
		$this->syslog = new syslog();
	}

	//Reset Fields
	public function reset_fields() {
		$this->cust_id = "";
		$this->cust_created = "";
		$this->cust_forename = "";
		$this->cust_surname = "";
		$this->cust_email = "";
		$this->cust_tel = "";
		$this->cust_mobile = "";
		$this->cust_active = "";
	}
		
	//Get Current Customer
	public function get_customer() {
		if($this->cust_id!="")
		{
		$this->sql = 'SELECT * FROM customer WHERE cust_id = '.$this->cust_id;
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
	
	//Search Customer
	public function get_customer_list() {

		if(!empty($this->search_cust_id)){$sql_crit[4]="AND a.cust_id = '".addslashes($this->search_cust_id)."'";}
		if(!empty($this->search_forename)){$sql_crit[0]="AND LOWER(REPLACE(a.cust_forename,' ','')) LIKE '%".strtolower(preg_replace('/\s+/','',$this->search_forename))."%'";}
		if(!empty($this->search_surname)){$sql_crit[1]="AND LOWER(REPLACE(a.cust_surname,' ','')) LIKE '%".strtolower(preg_replace('/\s+/','',$this->search_surname))."%'";}
		if(!empty($this->search_email)){$sql_crit[2]="AND LOWER(REPLACE(a.cust_email,' ','')) LIKE '%".strtolower(preg_replace('/\s+/','',$this->search_email))."%'";}
		if(!empty($this->search_postcode)){$sql_crit[3]="INNER JOIN customer_address b ON a.cust_id = b.cust_id AND LOWER(REPLACE(b.add_postcode,' ','')) LIKE '%".strtolower(preg_replace('/\s+/','',$this->search_postcode))."%'";}
		
		$this->sql = "
		SELECT a.cust_id, concat(cust_forename,' ',cust_surname) cust_name, cust_email, concat(c.add_aline1,' ',c.add_aline2,' ',c.add_city,' ',c.add_county,' ',c.add_postcode) cust_address
		FROM customer a
		".$sql_crit[3]."
		LEFT JOIN customer_address c ON a.cust_id = c.cust_id AND c.add_default = '1'
		WHERE a.cust_id IS NOT NULL
		".$sql_crit[0]." 
		".$sql_crit[1]." 
		".$sql_crit[2]." 
		".$sql_crit[4]."
		ORDER BY a.cust_id DESC LIMIT 0,30
		";		
		
		$this->connect->query($this->sql);
		return $this->connect->resultArray();
	}
	
	//Customer - Required Fields
	public function required_fields() {
	$ret =  required_fields(array("Email Address"=>$this->cust_email));
	if(!empty($ret)) {
	return $ret;
	}
	//elseif($this->cust_forename=="Forename"){return "Please enter a valid Forename";}
	//elseif($this->cust_surname=="Surname"){return "Please enter a valid Surname";}
	elseif(filter_var($this->cust_email, FILTER_VALIDATE_EMAIL)==false) {return "Please enter a valid email address";}
	}
	
	public function customer_signin() {
	if($this->cust_type == 1){
	$this->add_live_customer();
	}
	elseif($this->cust_type == 2){
	$this->login();
	}
	}
	
	//Add Live Customer
 	public function add_live_customer() {
	$required_fields = $this->required_fields();
	if($required_fields!="") {$this->error=$required_fields;}
	//elseif($this->cust_pass==""){$this->error = "Please enter a valid password";}
	//elseif($this->cust_check!="1"){$this->error = "Please accept the Terms and Conditions";}	
	//elseif($this->password!=""){$this->error = "Are you a spam bot?";}
	else {
	
	$this->cust_active = "1";
	$this->add_customer();

	if(empty($this->error)){
	
	$this->cust_pass_check = $this->cust_pass;
	$this->cust_set_perm_pass_session();
	$this->email_new_customer();
	
	if(empty($this->error)){
	$this->success = 1;
	}
	}
	
	}
	
	}
	
	//Add Customer
 	public function add_customer() {	
		
		$this->cust_hash = md5(uniqid()); 
		
		//Required Fields
		$required_fields = $this->required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {
		//Check Duplicate
		$this->sql = "SELECT cust_email FROM customer WHERE cust_email = '".addslashes($this->cust_email)."';";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		
		if(!empty($result)){$this->error="This email address is already registered!";}
		else {
 		$this->sql = "INSERT INTO customer (cust_created,cust_forename,cust_surname,cust_email,cust_tel,cust_mobile,cust_active,cust_hash,cust_reset,cust_pass,cust_update) VALUES (
		'".addslashes(date("Y-m-d H:i:s"))."',
		'".addslashes($this->cust_forename)."',
		'".addslashes($this->cust_surname)."', 
		'".addslashes($this->cust_email)."',		
		'".addslashes($this->cust_tel)."',
		'".addslashes($this->cust_mobile)."',
		'".addslashes($this->cust_active)."',
		'".addslashes($this->cust_hash)."',
		'1',
		'".addslashes($this->cust_hash)."',
		'".addslashes(date("Y-m-d H:i:s"))."'
		);";			
		$this->connect->query($this->sql);
		
		$this->cust_id = $this->connect->InsertID();

		}
		}
	}

	
	//Update Customer
	public function update_customer()
	{
		//Required Fields
		$required_fields = $this->required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {
		
		//Check Duplicate
		$this->sql = "SELECT cust_email FROM customer WHERE cust_email = '".addslashes($this->cust_email)."' AND cust_id != '".$this->cust_id."';";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		
		if(!empty($result)){$this->error="This email address is already registered!";}
		else {			
		$this->sql = "UPDATE customer
		SET cust_forename = '".addslashes($this->cust_forename)."',
		cust_surname = '".addslashes($this->cust_surname)."',
		cust_email = '".addslashes($this->cust_email)."',
		cust_tel = '".addslashes($this->cust_tel)."',
		cust_mobile = '".addslashes($this->cust_mobile)."',
		cust_active = '".addslashes($this->cust_active)."'
		WHERE cust_id = ".$this->cust_id.";";			
		$this->connect->query($this->sql);
		}
		}
	}
	
	//Delete Customer
	public function delete_customer() {

		$this->get_customer();
		
 		$this->sql = "DELETE FROM customer
		WHERE cust_id = ".$this->cust_id.";";			
		$this->connect->query($this->sql);
		
		$this->sql = "DELETE FROM customer_address
		WHERE cust_id = ".$this->cust_id.";";			
		$this->connect->query($this->sql);
		
		$this->sql = "DELETE FROM orders_stage
		WHERE cust_id = ".$this->cust_id.";";			
		$this->connect->query($this->sql);
		
		$this->sql = "	DELETE a.*
						FROM orders_trans a
						INNER JOIN orders b ON a.order_id = b.order_id
						WHERE b.cust_id = ".$this->cust_id.";";			
		$this->connect->query($this->sql);
		
		$this->sql = "DELETE FROM orders
		WHERE cust_id = ".$this->cust_id.";";			
		$this->connect->query($this->sql);
		
		$this->reset_fields();
	}

	//Email New Customer
	public function email_new_customer()
	{
		global $site_config;
		$tmpl = new Templater($site_config['path'].'templates/tmpl_email_new_custnew.php');
		$tmpl->cust_id = $this->cust_id;		
		$tmpl->cust_forename = $this->cust_forename;
		$tmpl->cust_link = $site_config['url']."user/pass/".$this->cust_hash."/";
		$body = $tmpl->parse();
	
		$this->email = new email();
		$this->email->subject = "Welcome to the Club";
		$this->email->body = $body;
		$this->email->to_email = $this->cust_email;
		$this->email->to_name = $this->cust_forename." ".$this->cust_surname;
		
		
		/*
		$this->email->host = $site_config['contact_email']['1']['host'];
		$this->email->port = $site_config['contact_email']['1']['port'];
		$this->email->smtp = $site_config['contact_email']['1']['smtp'];
		$this->email->username = $site_config['contact_email']['1']['username'];
		$this->email->password = $site_config['contact_email']['1']['password'];
		$this->email->from_name = $site_config['contact_email']['1']['from_name'];
		$this->email->from_email = $site_config['contact_email']['1']['from_email'];	
		$this->email->send_email();
		*/
		
		$this->email->email_from_id = 1;				
		$this->email->create_email();
		
		$this->error = $this->email->error;
		
	}

	//Set Permanent Password
	public function cust_set_perm_pass() {
		$ret =  required_fields(array("Password 1"=>$this->cust_pass,"Password 2"=>$this->cust_pass_check));
		if(empty($ret)) {
		if($this->cust_pass == $this->cust_pass_check) {
		
		$pass = new password();
		$pwd = $pass->hash($this->cust_pass);
		
		$this->cust_hash = md5(uniqid()); 
		
		$this->sql = "UPDATE customer
		SET cust_pass = '".addslashes($pwd)."',
		cust_reset = '',
		cust_update = '".addslashes(date("Y-m-d H:i:s"))."',
		cust_hash = '".addslashes($this->cust_hash)."'
		WHERE cust_id = ".addslashes($this->cust_id).";";			
		$this->connect->query($this->sql);
		}
		else {
		$this->error="Passwords don't match!";
		}
		}
		else {
		$this->error=$ret;
		}
	}
	
	//Permanent Password & Update Session
	public function cust_set_perm_pass_session() {
	$this->cust_set_perm_pass();
	$this->custSession();
	}
	
	
	//Customer Forgot Password Check
	public function cust_forgot_pass_check() {
	
	$ret =  required_fields(array("Email"=>$this->cust_email));
	if(!empty($ret)){$this->error=$ret;}
	elseif(filter_var($this->cust_email, FILTER_VALIDATE_EMAIL)==false) {$this->error="Please enter a valid email address";}
	elseif($this->sc_a != strtolower($this->spam) and $this->sc_w != strtolower($this->spam)){$this->error = "Your answer to the anti spam question is incorrect, please try again.";}
	
	else {
	$this->cust_forgot_pass();
	}
	
	}
	
	//Customer Forgot Password
	public function cust_forgot_pass() {
	
	$this->sql = "SELECT cust_id, cust_hash FROM customer
	WHERE cust_email = '".addslashes($this->cust_email)."';";			
	$this->connect->query($this->sql);
	$result = $this->connect->resultArray();
		
	$cust_id = $result[0]['cust_id'];
	$cust_hash = $result[0]['cust_hash'];
		
	if(empty($cust_id)){$this->error="Sorry, we couldn't find an account with that email.";}
	else {
	$this->sql = "UPDATE customer
	SET cust_reset = '1',
	cust_update = '".addslashes(date("Y-m-d H:i:s"))."'
	WHERE cust_id = ".addslashes($cust_id).";";			
	$this->connect->query($this->sql);
	
	$this->cust_id = $cust_id;
	$this->get_customer();
	
	global $site_config;
	
	$tmpl = new Templater($site_config['path'].'templates/tmpl_email_new_custpass.php');
	$tmpl->cust_forename = $this->cust_forename;
	$tmpl->cust_link = $site_config['url']."user/pass/".$cust_hash."/";
	$body = $tmpl->parse();
		
	$this->email = new email();
	$this->email->subject = "Reset Pass";
	$this->email->body = $body;
	$this->email->to_email = $this->cust_email;
	$this->email->to_name = $this->cust_forename." ".$this->cust_surname;
		
	$this->email->host = $site_config['contact_email']['1']['host'];
	$this->email->port = $site_config['contact_email']['1']['port'];
	$this->email->smtp = $site_config['contact_email']['1']['smtp'];
	$this->email->username = $site_config['contact_email']['1']['username'];
	$this->email->password = $site_config['contact_email']['1']['password'];
	$this->email->from_name = $site_config['contact_email']['1']['from_name'];
	$this->email->from_email = $site_config['contact_email']['1']['from_email'];	
	$this->email->send_email();
	
	//$this->email->email_from_id = 1;				
	//$this->email->create_email();
	
	$this->error = $this->email->error;
	if(empty($this->error)){$this->success = "Email Sent!";}
	}
	
	unset($_SESSION['spam']);
	}

	//Customer Check Password Link
	public function cust_check_pass_link() {

	if($this->cust_hash!= ""){
	$this->sql = "SELECT cust_id FROM customer
	WHERE cust_hash = '".addslashes($this->cust_hash)."' and cust_reset = '1';";			
	$this->connect->query($this->sql);
	$result = $this->connect->resultArray();
	$cust_id = $result[0]['cust_id'];
	if($cust_id==""){$this->invalid=1;}
	}	
	else {
	$this->invalid=1;
	}
	
	}
	
	//Customer Update Password
	public function cust_update_pass() {
		
	if($this->cust_hash!= ""){
	$this->sql = "SELECT cust_id FROM customer
	WHERE cust_hash = '".addslashes($this->cust_hash)."' and cust_reset = '1' and cust_email = '".addslashes($this->cust_email)."';";			
	$this->connect->query($this->sql);
	$result = $this->connect->resultArray();
	
	$cust_id = $result[0]['cust_id'];
	if($cust_id==""){$this->error = "Sorry, something has gone wrong, please try to reset your password again.";}
	
	else{
	$this->cust_id = $cust_id;
	
	$this->cust_set_perm_pass();
	
	if(empty($this->error)){	
	$this->login();
	}
	
	}
	
	}
	
	}
	
	//Customer Tidy Reset Pass
	public function tidy_reset_pass() {
	
	$this->sql = "UPDATE customer
	SET cust_reset = '0'
	WHERE cust_reset = '1' AND cust_update < '".addslashes(date("Y-m-d",strtotime("- 1 day")))."';";			
	$this->connect->query($this->sql);
	
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// Login
	
	//Customer login
    public function login()
    {
	if($this->cust_email=="Email"){$this->cust_email="";}
	$ret =  required_fields(array("Email"=>$this->cust_email,"Password"=>$this->cust_pass));
	if(!empty($ret)){$this->error = $ret;}
	elseif(filter_var($this->cust_email, FILTER_VALIDATE_EMAIL)==false) {$this->error="Please enter a valid email address";}
	elseif($this->password!=""){$this->error = "Are you a spam bot?";}
	else {
        $this->checkCredentials();
        if ($this->cust_id!="") {  
		$this->custSession();
		$this->success = 1;
		}
		else {
		unset($_SESSION['cust']);
		$this->error = 'Sorry, we couldn\'t find an account with that email and password combination.</a>';
		}
		
	}
	
    }
	
	//Check Customer Email and Password
    protected function checkCredentials()
    {
		$pass = new password();
		$pwd = $pass->hash($this->cust_pass);
		
		$this->sql = "SELECT cust_id FROM customer WHERE cust_active = '1' AND cust_email = '".addslashes($this->cust_email)."' AND cust_pass = '".addslashes($pwd)."';";
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

	//User Session  Details
    public function custSession()
    {	
		$this->get_customer();
		if($this->cust_reset=="1"){
		$_SESSION['cust']['reset'] = 1;
		}
		else{
		$_SESSION['cust']['reset'] = 0;
		}
		$_SESSION['cust']['cust_id'] = $this->cust_id;
		$_SESSION['cust']['cust_forename'] = $this->cust_forename;
		$_SESSION['cust']['cust_surname'] = $this->cust_surname;
		$_SESSION['cust']['cust_email'] = $this->cust_email;
		$_SESSION['cust']['logged_in_as'] = $this->cust_forename." ".$this->cust_surname;
    }
	
	//Check Customer Email Address Exists
    public function checkCredentialsEmail()
    {	
		$this->sql = "SELECT cust_id FROM customer WHERE cust_email = '".addslashes($this->cust_email)."';";
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
			
	//User Log Off
    public function logoff()
    {	
		unset($_SESSION['cust']);
		unset($_SESSION['last_prd']);
		$this->reset_fields();
    }

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// Address
	
	//Get Addresses - Select
	public function get_address_list() {
		$this->sql = "SELECT add_id, add_name ,add_aline1 ,add_aline2, add_city, add_county, add_postcode, add_default FROM customer_address WHERE cust_id = ".$this->cust_id." ORDER BY add_default DESC, add_id ASC";
		$this->connect->query($this->sql);
		return $this->connect->resultArray();
	}
	
	//Get Current Address
	public function get_address() {
		if($this->add_id!="")
		{
		$this->sql = 'SELECT * FROM customer_address WHERE add_id = '.$this->add_id;
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
	
	//Customer Address - Required Fields
	public function add_required_fields() {
	
	if($this->add_cust_up == 1){
	$fields = array("Forename"=>$this->cust_forename,"Surname"=>$this->cust_surname,"Recipient"=>$this->add_name,"Address Line 1"=>$this->add_aline1,"City"=>$this->add_city,"Postcode"=>$this->add_postcode,"Country"=>$this->add_country);
	}
	
	else {
	$fields = array("Recipient"=>$this->add_name,"Address Line 1"=>$this->add_aline1,"City"=>$this->add_city,"Postcode"=>$this->add_postcode,"Country"=>$this->add_country);
	}
	
	return required_fields($fields);
	}

	//Add Address
	public function add_address() {	
				
		//Required Fields
		$required_fields = $this->add_required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {
		
 		$this->sql = "INSERT INTO customer_address (cust_id,add_name,add_aline1,add_aline2,add_city,add_county,add_postcode,add_country,add_active,add_default) VALUES (
		'".addslashes($this->cust_id)."',
		'".addslashes($this->add_name)."',
		'".addslashes($this->add_aline1)."',
		'".addslashes($this->add_aline2)."', 
		'".addslashes($this->add_city)."',
		'".addslashes($this->add_county)."',		
		'".addslashes(strtoupper($this->add_postcode))."',
		'".addslashes($this->add_country)."',
		'".addslashes($this->add_active)."',
		'".addslashes($this->add_default)."'
		);";			
		$this->connect->query($this->sql);
		$this->add_id = $this->connect->InsertID();
		$this->default_address();
		$this->success = 1;
		
		//Sys Log
		//$this->insert_log("ADD ADDRESS");
		}
	}


	//Add Address
	public function update_address() {	
				
		//Required Fields
		$required_fields = $this->add_required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {
		
 		$this->sql = "UPDATE customer_address SET
		cust_id = '".addslashes($this->cust_id)."',
		add_name = '".addslashes($this->add_name)."',
		add_aline1 = '".addslashes($this->add_aline1)."',
		add_aline2 = '".addslashes($this->add_aline2)."', 
		add_city = '".addslashes($this->add_city)."',
		add_county = '".addslashes($this->add_county)."',		
		add_postcode = '".addslashes(strtoupper($this->add_postcode))."',
		add_country = '".addslashes($this->add_country)."',
		add_active = '".addslashes($this->add_active)."',
		add_default = '".addslashes($this->add_default)."'
		WHERE add_id = ".$this->add_id.";";			
		$this->connect->query($this->sql);
		$this->default_address();
		
		//Sys Log
		//$this->insert_log("UPDATE ADDRESS");
		}
	}

	//Reset Fields
	public function reset_address_fields() {
		$this->add_aline1 = "";
		$this->add_aline2 = "";
		$this->add_city = "";
		$this->add_county = "";
		$this->add_postcode = "";
		$this->add_country = "";
		$this->add_active = "";
		$this->add_default = "";
		$this->add_id = "";
	}
	
	//Delete Customer Address
	public function delete_customer_address() {
		
 		$this->sql = "DELETE FROM customer_address
		WHERE add_id = ".$this->add_id.";";			
		$this->connect->query($this->sql);
		$this->default_address();
		//Sys Log
		//$this->insert_log("DELETE ADDRESS");
		$this->reset_address_fields();
	}
	
	//Default Address
	public function default_address() {
		$this->sql = "SELECT add_id
		FROM customer_address a
		WHERE a.cust_id = ".$this->cust_id."
		AND a.add_default = '1'";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		
		if(count($result)>1)
		{
		$this->sql = "UPDATE customer_address SET 
		add_default = ''
		WHERE cust_id = ".$this->cust_id." AND add_default = '1' AND add_id != ".$this->add_id.";";
		$this->connect->query($this->sql);
		}
		
		if(empty($result))
		{
		$this->sql = "UPDATE customer_address a
		INNER JOIN (SELECT MIN(add_id) add_id FROM customer_address WHERE cust_id = '".$this->cust_id."') b ON a.add_id = b.add_id
		SET a.add_default = '1'
		WHERE a.cust_id = ".$this->cust_id.";";
		$this->connect->query($this->sql);
		$this->add_default = "1";
		}
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// Orders

	//Enquiry
	public function create_enquiry()
	{
		unset($_SESSION['spam']);
		$ret = required_fields(array("Forename"=>$this->enq_forename,"Surname"=>$this->enq_surname,"Email"=>$this->enq_email,"Enquiry"=>$this->enq_enq));
		if(!empty($ret)){$this->error = $ret;}
		elseif(filter_var($this->enq_email, FILTER_VALIDATE_EMAIL)==false) {$this->error = "Please enter a valid email address";}
		elseif($this->sc_a != strtolower($this->spam) and $this->sc_w != strtolower($this->spam)){$this->error = "Your answer to the anti spam question is incorrect, please try again.";}
		else {
		global $site_config;
		$tmpl = new Templater($site_config['path'].'templates/tmpl_email_enquiry.php');
		
		$tmpl->enq_forename = $this->enq_forename;
		$tmpl->enq_surname = $this->enq_surname;
		$tmpl->enq_email = $this->enq_email;
		$tmpl->enq_enq = $this->enq_enq;
		$body = $tmpl->parse();
		
		$this->email = new email();
		$this->email->subject = "OPJC Enquiry";
		$this->email->body = $body;
		$this->email->to_email = $site_config['contact_email']['1']['from_email'];
		$this->email->to_name = $site_config['contact_email']['1']['from_name'];
		/*
		$this->email->host = $site_config['contact_email']['1']['host'];
		$this->email->port = $site_config['contact_email']['1']['port'];
		$this->email->smtp = $site_config['contact_email']['1']['smtp'];
		$this->email->username = $site_config['contact_email']['1']['username'];
		$this->email->password = $site_config['contact_email']['1']['password'];
		*/
		$this->email->from_name = $this->enq_forename." ".$this->enq_surname;
		$this->email->from_email = $this->enq_email;
		$this->smtp==0;
		$this->email->send_email();
	
		//$this->email->email_from_id = 1;				
		//$this->email->create_email();
	
		$this->error = $this->email->error;
		
		/*
		$to      = $site_config['contact_email']['1']['from_email'];
		$subject = 'OPJC Enquiry';
		$message = $this->enq_enq;
		$headers = 'From: '.$this->enq_email. "\r\n" .
    	"Reply-To: ".$site_config['contact_email']['1']['from_email']. "\r\n" .
    	'X-Mailer: PHP/' . phpversion();

		if(mail($to, $subject, $message, $headers)){
		$this->success = "Enquiry Sent!";
		*/
		
		if(empty($this->error)){
		$this->success = "Enquiry Sent!";
		}
		}
		
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// Orders

		
	//Log Defaults
	public function insert_log($d)
	{
		if(!empty($this->cust_id)) {
		$this->get_customer();
		}
		
		$this->syslog->log_type = "Customer";
		$this->syslog->log_key = $this->cust_id;
		$this->syslog->log_desc = $d." - ".$this->cust_forename." / ".$this->cust_surname." / ".$this->cust_email;
		$this->syslog->insert_log();		
	}
}
?>