<?php
class site {
 	
	public $error;
 	protected $connect,$sql; 
	
	//DB Connect & Syslog
	public function __construct() {
		global $site_config;
		$this->connect = $site_config['connect']; 
	}
	
	//Get Sys Log
	public function get_syslog() {
		$this->sql = "SELECT a.*, concat(b.user_forename,' ',b.user_surname) user_name
		FROM sys_log a
		INNER JOIN sys_user b ON a.user_id = b.user_id
		ORDER BY log_id DESC LIMIT 0,100";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		return $result;
	}
}
?>