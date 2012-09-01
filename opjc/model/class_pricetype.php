<?php
class pricetype {
 	
	public $price_type_id,$price_type_name,$price_type_desc,$price_type_months,$price_type_recur,$price_type_handling,$price_type_delivery,$error;
 	protected $connect,$sql; 
	
	//DB Connect & Syslog
	public function __construct() {
		global $site_config;
		$this->connect = $site_config['connect']; 
		$this->syslog = new syslog();
	}
	
	//Get Current Price Type
	public function get_pricetype() {
		if($this->price_type_id!="")
		{
		$this->sql = 'SELECT * FROM price_type WHERE price_type_id = '.$this->price_type_id;
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
	
	//Get Price Type List - Select
	public function get_pricetype_list() {
		$this->sql = 'SELECT price_type_id, price_type_name FROM price_type ORDER BY price_type_name';
		$this->connect->query($this->sql);
		return $this->connect->resultArrayValues();
	}
	
	//PriceType- Required Fields
	public function required_fields() {
	return required_fields(array("Price Type Name"=>$this->price_type_name));
	}
	
	//Add Price Type
 	public function add_pricetype() {
		//Required Fields
		$required_fields = $this->required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {	
		//Check Duplicate
		$this->sql = "SELECT price_type_id FROM price_type WHERE price_type_name = '".addslashes($this->price_type_name)."';";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		
		if(!empty($result)){$this->error="This price type already exists!";}
		else {
 		$this->sql = "INSERT INTO price_type (price_type_name,price_type_code,price_type_desc,price_type_months,price_type_recur,price_type_handling,price_type_delivery) VALUES (
		'".addslashes($this->price_type_name)."',
		'".addslashes($this->price_type_code)."',
		'".addslashes($this->price_type_desc)."',
		'".addslashes($this->price_type_months)."',
		'".addslashes($this->price_type_recur)."',
		'".addslashes($this->price_type_handling)."',
		'".addslashes($this->price_type_delivery)."'
		);";			
		$this->connect->query($this->sql);
		$this->price_type_id = $this->connect->InsertID();
		//Sys Log
		//$this->insert_log('ADD');
		}
		}
	}
	
	//Update Price Type
	public function update_pricetype() {
		//Required Fields
		$required_fields = $this->required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {	
 		$this->sql = "UPDATE price_type SET 
		price_type_name = '".addslashes($this->price_type_name)."',
		price_type_code = '".addslashes($this->price_type_code)."', 
		price_type_desc = '".addslashes($this->price_type_desc)."', 
		price_type_months = '".addslashes($this->price_type_months)."',
		price_type_recur = '".addslashes($this->price_type_recur)."',
		price_type_handling = '".addslashes($this->price_type_handling)."',
		price_type_delivery = '".addslashes($this->price_type_delivery)."'
		WHERE price_type_id = ".$this->price_type_id.";";			
		$this->connect->query($this->sql);
		//Sys Log
		//$this->insert_log('UPDATE');
		}
	}
	
	//Delete Price Type
	public function delete_pricetype() {
		//Sys Log
		//$this->insert_log('DELETE');
			
 		$this->sql = "DELETE FROM price_type
		WHERE price_type_id = ".$this->price_type_id.";";			
		$this->connect->query($this->sql);
		
		$this->sql = "DELETE FROM product_price
		WHERE price_type_id = ".$this->price_type_id.";";			
		$this->connect->query($this->sql);
		
		$this->price_type_id = "";		
	}

	//Log Defaults
	public function insert_log($d='')
	{
		if(!empty($this->price_type_id)) {
		$this->get_pricetype();
		}
		
		$this->syslog->log_type = "Price Type";
		$this->syslog->log_key = $this->price_type_id;
		$this->syslog->log_desc = $d." - ".$this->price_type_name.": ".$this->price_type_desc." / ".$this->price_type_months." / ".$this->price_type_recur." / ".$this->price_type_handling." / ".$this->price_type_delivery;
		$this->syslog->insert_log();		
	}
}
?>