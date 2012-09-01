<?php
class email {
 	
	public $subject,$body,$to_email,$to_name,$error;
 	protected $connect,$sql,$email; 

	var $host = '';
	var $port = '';
	var $username = ''; 
	var $password = '';
	var $from_name = '';
	var $from_email = '';
		
	//DB Connect & Syslog
	public function __construct() {
		global $site_config;
		$this->connect = $site_config['connect']; 				
	}
	
	//Send Email
	public function send_email() {
	
	$this->email = new PHPMailer();
	
	if($this->smtp=='1'){
	$this->email->IsSMTP(); // enable SMTP
	$this->email->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$this->email->SMTPAuth = true;  // authentication enabled
	$this->email->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail	
	}
	
	$this->email->Host = $this->host;
	$this->email->Port = $this->port;
	$this->email->Username = $this->username; 
	$this->email->Password = $this->password;
	$this->email->SetFrom($this->from_email,$this->from_name);
	$this->email->Subject = $this->subject;
	$this->email->MsgHTML($this->body);
	$this->email->AddAddress($this->to_email,$this->to_name);
	if($this->bcc_email!=""){
	$this->email->AddBCC($this->bcc_email);
	}
	//$this->email->AddAddress('mccandu@gmail.com','Mat');
	
	if(!$this->email->Send()) {
		$this->error = 'Mail error: '.$this->email->ErrorInfo; 
		return false;
	} else {
		$this->error = '';
		return true;
	}
	
	}

	//Create Email
	public function create_email() {
 		$this->sql = "INSERT INTO email (email_subject,email_body,email_to_email,email_to_name,email_from_id) VALUES (
		'".addslashes($this->subject)."',
		'".addslashes($this->body)."',
		'".addslashes($this->to_email)."',
		'".addslashes($this->to_name)."',
		'".addslashes($this->email_from_id)."'
		);";			
		$this->connect->query($this->sql);
	}

	//Customer Check Password Link
	public function bulk_email() {
	set_time_limit(320);
	global $site_config;
	
	//Anything to do??
	$this->sql = "SELECT * FROM email
	WHERE email_batch IS NULL AND email_sent IS NULL ORDER BY email_id LIMIT 25;";			
	$this->connect->query($this->sql);
	$result = $this->connect->resultArray();
	if(!empty($result))
	{
		$email_batch = date("Y-m-d H:i:s");
		
		$this->sql = "UPDATE email SET email_batch = '".addslashes($email_batch)."' WHERE email_batch IS NULL AND email_sent IS NULL ORDER BY email_id LIMIT 30;";			
		$this->connect->query($this->sql);
	
		$this->sql = "SELECT * FROM email
		WHERE email_batch = '".addslashes($email_batch)."';";			
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		if(!empty($result))
		{
			foreach($result as $row)
			{
			$this->host = $site_config['contact_email'][$row['email_from_id']]['host'];
			$this->port = $site_config['contact_email'][$row['email_from_id']]['port'];
			$this->smtp = $site_config['contact_email'][$row['email_from_id']]['smtp'];
			$this->username = $site_config['contact_email'][$row['email_from_id']]['username'];
			$this->password = $site_config['contact_email'][$row['email_from_id']]['password'];
			$this->from_email = $site_config['contact_email'][$row['email_from_id']]['from_email'];
			$this->from_name = $site_config['contact_email'][$row['email_from_id']]['from_name'];
			$this->subject = $row['email_subject'];
			$this->body = $row['email_body'];
			$this->to_email = $row['email_to_email'];
			$this->to_name = $row['email_to_name'];
			
			$this->send_email();
						
			if(empty($this->error)){
			$this->sql = "UPDATE email SET email_sent = '1' WHERE email_batch = '".addslashes($email_batch)."';";			
			$this->connect->query($this->sql);
			}
			else{
			$this->sql = "UPDATE email SET email_sent = '2' WHERE email_batch = '".addslashes($email_batch)."';";			
			$this->connect->query($this->sql);
			echo $this->error;
			}
						
			sleep(8);
			}
		}
	
	}

	}

	//Delete Email
	public function delete_email() {
 		$this->sql = "DELETE FROM email WHERE email_batch IS NOT NULL AND email_sent = '1';";			
		$this->connect->query($this->sql);
	}
	
}	
?>