<?php
class syslog 
    { 
    public $log_type,$log_desc,$log_key;
 	protected $connect,$sql,$log_user;
	
	//DB Connect
	public function __construct() {
		global $site_config;
		$this->connect = $site_config['connect'];
		$this->log_user = "1";
		}
	
    function insert_log() { 
        $this->sql = "INSERT INTO sys_log (log_type,log_desc,log_key,user_id,log_datetime) VALUES (
		'".addslashes($this->log_type)."',
		'".addslashes(preg_replace( '/\s+/', ' ',$this->log_desc))."',
		'".addslashes($this->log_key)."',
		'".addslashes($this->log_user)."',
		'".addslashes(date("Y-m-d H:i:s"))."'
		);";			
		$this->connect->query($this->sql);
        } 	      
    }
?>