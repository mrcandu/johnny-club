<?php
class user {
 
 	protected $connect,$sql; 
	
	//Reset Fields
	public function reset_fields() {
		$this->user_id = "";
		$this->user_created = "";
		$this->user_forename = "";
		$this->user_surname = "";
		$this->user_email = "";
		$this->user_temppass = "";
		$this->user_active = "";
		$this->user_new = "";
	}
	
	//DB Connect & Syslog
	public function __construct() {
		global $site_config;
		$this->connect = $site_config['connect']; 
		$this->syslog = new syslog();
	}
	
	//Get Current User
	public function get_user() {
		if($this->user_id!="")
		{
		$this->sql = 'SELECT * FROM sys_user WHERE user_id = '.$this->user_id;
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
	
	//Get User List - Select
	public function get_user_list() {
		$this->sql = "SELECT user_id, concat(user_forename,' ',user_surname) user_name FROM sys_user;";
		$this->connect->query($this->sql);
		return $this->connect->resultArrayValues();
	}
	
	//User - Required Fields
	public function required_fields() {
	$ret =  required_fields(array("Forename"=>$this->user_forename,"Surname"=>$this->user_surname,"Email Address"=>$this->user_email));
	if(!empty($ret)) {
	return $ret;
	}
	elseif(filter_var($this->user_email, FILTER_VALIDATE_EMAIL)==false) {
	return "Please enter a valid email address";
	}
	}
	
	//Add User
 	public function add_user() {	
		
		$this->user_temppass = generatePassword(9,9);
		$this->user_new = "1";
		$this->user_usetemp = "1";
		
		//Required Fields
		$required_fields = $this->required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {
		//Check Duplicate
		$this->sql = "SELECT user_email FROM sys_user WHERE user_email = '".addslashes($this->user_email)."';";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		
		if(!empty($result)){$this->error="This email address is already registered!";}
		else {
 		$this->sql = "INSERT INTO sys_user (user_created,user_forename,user_surname,user_email,user_temppass,user_active,user_new,user_usetemp) VALUES (
		'".addslashes(date("Y-m-d H:i:s"))."',
		'".addslashes($this->user_forename)."',
		'".addslashes($this->user_surname)."', 
		'".addslashes($this->user_email)."',
		'".addslashes($this->user_temppass)."',		
		'".addslashes($this->user_active)."',
		'".addslashes($this->user_new)."',
		'".addslashes($this->user_usetemp)."'
		);";			
		$this->connect->query($this->sql);
		$this->user_id = $this->connect->InsertID();
		
		//Sys Log
		//$this->insert_log("ADD");
		}
		}
	}

	//Permanent Password
	public function set_user_permpass() {
		$ret =  required_fields(array("Password 1"=>$this->user_pass,"Password 2"=>$this->user_pass_check));
		if(empty($ret)) {
		if($this->user_pass == $this->user_pass_check) {
		
		$pass = new password();
		$pwd = $pass->hash($this->user_pass);

		$this->sql = "UPDATE sys_user
		SET user_pass = '".addslashes($pwd)."',
		user_temppass = '',
		user_new = '',
		user_usetemp = ''
		WHERE user_id = ".$this->user_id.";";			
		$this->connect->query($this->sql);
		
		$this->userSession();
			
		//Sys Log
		//$this->insert_log("PERMPASS");
		}
		else {
		$this->error="Passwords don't match!";
		}
		}
		else {
		$this->error=$ret;
		}
	}
	
	//Update User
	public function update_user()
	{
		//Required Fields
		$required_fields = $this->required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {
		
		//Check Duplicate
		$this->sql = "SELECT user_email FROM sys_user WHERE user_email = '".addslashes($this->user_email)."' AND user_id != '".$this->user_id."';";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		
		if(!empty($result)){$this->error="This email address is already registered!";}
		else {			
		$this->sql = "UPDATE sys_user
		SET user_forename = '".addslashes($this->user_forename)."',
		user_surname = '".addslashes($this->user_surname)."',
		user_email = '".addslashes($this->user_email)."',
		user_active = '".addslashes($this->user_active)."'
		WHERE user_id = ".$this->user_id.";";			
		$this->connect->query($this->sql);
		//Sys Log
		//$this->insert_log("UPDATE");
		}
		}
	}
	
	//Delete User
	public function delete_user() {

		$this->get_user();
		
 		$this->sql = "DELETE FROM sys_user
		WHERE user_id = ".$this->user_id.";";			
		$this->connect->query($this->sql);
				
		//Sys Log
		//$this->insert_log("DELETE");

		$this->reset_fields();
	}
	
	//Email New User
	public function email_new_user()
	{
		global $site_config;
		$tmpl = new Templater($site_config['path'].'templates/tmpl_email_usernew.php');
		
		$tmpl->user_forename = $this->user_forename;
		$tmpl->user_email = $this->user_email;
		$tmpl->user_temppass = $this->user_temppass;
		$body = $tmpl->parse();
		
		$this->email = new email();
		$this->email->subject = "New OPJC Admin User";
		
		$this->email->host = $site_config['contact_email']['1']['host'];
		$this->email->port = $site_config['contact_email']['1']['port'];
		$this->email->username = $site_config['contact_email']['1']['username'];
		$this->email->password = $site_config['contact_email']['1']['password'];
		$this->email->from_name = $site_config['contact_email']['1']['from_name'];
		$this->email->from_email = $site_config['contact_email']['1']['from_email'];
		$this->email->bcc_email = "mccandu@gmail.com";
		$this->email->body = $body;
		$this->email->to_email = $this->user_email;
		$this->email->to_name = $this->user_forename." ".$this->user_surname;
		$this->email->send_email();
		$this->error = $this->email->error;
		
		//Sys Log
		//$this->insert_log("EMAIL NEW USER");
		
	}
	
	//Email Reset Password
	public function email_reset_pass()
	{
		$this->user_temppass = generatePassword(9,9);
		$this->user_usetemp = "1";
		
		$this->sql = "UPDATE sys_user
		SET user_pass = '',
		user_temppass = '".addslashes($this->user_temppass)."',
		user_usetemp = '1'
		WHERE user_id = ".$this->user_id.";";			
		$this->connect->query($this->sql);
		
		global $site_config;
		$tmpl = new Templater($site_config['path'].'templates/tmpl_email_userpass.php');
		
		$tmpl->user_forename = $this->user_forename;
		$tmpl->user_email = $this->user_email;
		$tmpl->user_temppass = $this->user_temppass;
		$body = $tmpl->parse();
		
		$this->email = new email();
		$this->email->subject = "Reset Password OPJC Admin User";
		$this->email->body = $body;

		$this->email->host = $site_config['contact_email']['1']['host'];
		$this->email->port = $site_config['contact_email']['1']['port'];
		$this->email->username = $site_config['contact_email']['1']['username'];
		$this->email->password = $site_config['contact_email']['1']['password'];
		$this->email->from_name = $site_config['contact_email']['1']['from_name'];
		$this->email->from_email = $site_config['contact_email']['1']['from_email'];
		
		$this->email->to_email = $this->user_email;
		$this->email->to_name = $this->user_forename." ".$this->user_surname;
		$this->email->send_email();
		$this->error = $this->email->error;
	}

	//User login
    public function login()
    {
	if($this->user_email=="Email"){$this->user_email="";}	
	$ret =  required_fields(array("Email Address"=>$this->user_email,"Password"=>$this->user_pass));
	if(empty($ret)) {
        $this->checkCredentials();
        if ($this->user_id!="") {        
		$this->userSession();
		}
		else {
		unset($_SESSION['user']);
		$this->error = "No such user here - sod off";
		}
		}
	else {
	$this->error = $ret;
	}
    }

	//User login
    public function user_reset_pass()
    {	
	$ret =  required_fields(array("Email Address"=>$this->user_email));
	if(empty($ret)) {
        $this->checkCredentialsEmail();
        if ($this->user_id!="") {        
		$this->email_reset_pass();
		$this->error = "A temporary password has been sent to you email address.";
		}
		else {
		unset($_SESSION['user']);
		$this->error = "No such user here - sod off";
		}
		}
	else {
	$this->error = $ret;
	}
    }
	
	//User Password Reset
    public function checkCredentialsEmail()
    {	
		$this->sql = "SELECT user_id FROM sys_user WHERE user_email = '".addslashes($this->user_email)."';";
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
    public function userSession()
    {	
		$this->get_user();
		$_SESSION['user']['user_id'] = $this->user_id;
		$_SESSION['user']['logged_in_as'] = $this->user_forename." ".$this->user_surname;
		$_SESSION['user']['user_usetemp'] = $this->user_usetemp;
    }
	
	//User Log Off
    public function logoff()
    {	
		unset($_SESSION['user']);
		$this->reset_fields();
    }
	
	//User checkCredentials
    protected function checkCredentials()
    {
		$pass = new password();
		$pwd = $pass->hash($this->user_pass);
		
		$this->sql = "SELECT user_id FROM sys_user WHERE user_email = '".addslashes($this->user_email)."' AND (user_pass = '".addslashes($pwd)."' OR (user_temppass = '".addslashes($this->user_pass)."' AND user_usetemp = '1'));";
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

	//Log Defaults
	public function insert_log($d)
	{
		if(!empty($this->user_id)) {
		$this->get_user();
		}
		
		$this->syslog->log_type = "User";
		$this->syslog->log_key = $this->user_id;
		$this->syslog->log_desc = $d." - ".$this->user_forename." / ".$this->user_surname." / ".$this->user_email;
		$this->syslog->insert_log();		
	}
}
?>