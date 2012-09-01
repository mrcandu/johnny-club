<?php
class categorytype {
 	
	public $cattype_id,$cattype_desc,$error;
 	protected $connect,$sql; 
	
	//DB Connect & Syslog
	public function __construct() {
		global $site_config;
		$this->connect = $site_config['connect']; 
		$this->syslog = new syslog();
	}
	
	//Get Current Category Type
	public function get_categorytype() {
		if($this->cattype_id!="")
		{
		$this->sql = 'SELECT * FROM category_type WHERE cattype_id = '.$this->cattype_id;
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
	
	//Get Category Type List - Select
	public function get_categorytype_list() {
		$this->sql = 	"SELECT cattype_id, cattype_desc
						FROM category_type
						ORDER BY cattype_desc
						";
		$this->connect->query($this->sql);
		return $this->connect->resultArrayValues();
	}

	//CategoryType- Required Fields
	public function required_fields() {
	return required_fields(array("Category Type Name"=>$this->cattype_desc));
	}
	
	//Add Category Type
	public function add_categorytype() {
		//Required Fields
		$required_fields = $this->required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {
		//Check Duplicate
		$this->sql = "SELECT cattype_desc FROM category_type WHERE cattype_desc = '".addslashes($this->cattype_desc)."';";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		
		if(!empty($result)){$this->error="This category type already exists!";}
		else {	
 		$this->sql = "INSERT INTO category_type (cattype_desc) VALUES (
		'".addslashes($this->cattype_desc)."');";			
		$this->connect->query($this->sql);
		$this->cattype_id = $this->connect->InsertID();
		
		//Sys Log
		//$this->insert_log('ADD');
		}
		}
	}
		
	//Update Category Type	
	public function update_categorytype() {
		//Required Fields
		$required_fields = $this->required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {	
 		$this->sql = "UPDATE category_type SET 
		cattype_desc = '".addslashes($this->cattype_desc)."' 
		WHERE cattype_id = ".$this->cattype_id.";";			
		$this->connect->query($this->sql);
		
		//Sys Log
		//$this->insert_log('UPDATE');
		}
	}
	
	//Delete Category Type
	public function delete_categorytype() {
	
		//Sys Log
		//$this->insert_log('DELETE');
			
 		$this->sql = "DELETE FROM category_type
		WHERE cattype_id = ".$this->cattype_id.";";			
		$this->connect->query($this->sql);
		
		$this->sql = "	DELETE a.*
						FROM product_cat a
						INNER JOIN category b ON a.cat_id = b.cat_id
						WHERE b.cattype_id = ".$this->cattype_id.";";			
		$this->connect->query($this->sql);
		
		$this->sql = "DELETE FROM category
		WHERE cattype_id = ".$this->cattype_id.";";			
		$this->connect->query($this->sql);
		
		$this->cattype_id = "";
	}
	
 //Log Defaults
	public function insert_log($d='')
	{
		if(!empty($this->cattype_id)) {
		$this->get_categorytype();
		}
		
		$this->syslog->log_type = "Product Category Type";
		$this->syslog->log_key = $this->cattype_id;
		$this->syslog->log_desc = $d." - ".$this->cattype_desc;
		$this->syslog->insert_log();		
	}
	
}
?>