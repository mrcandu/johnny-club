<?php
class category {
 	
	public $cat_id,$cat_desc,$cattype_id,$error;
 	protected $connect,$sql; 
	
	//DB Connect & Syslog
	public function __construct() {
		global $site_config;
		$this->connect = $site_config['connect']; 
		$this->syslog = new syslog();
	}
	
	//Get Current Category
	public function get_category() {
		if($this->cat_id!="")
		{
		$this->sql = 'SELECT a.*, b.cattype_desc FROM category a 
		INNER JOIN category_type b ON a.cattype_id = b.cattype_id
		WHERE cat_id = '.$this->cat_id;
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
	
	//Get Category List - Select
	public function get_category_list() {
		$this->sql = "SELECT b.cattype_desc, a.cat_id, a.cat_desc
						FROM category a 
						INNER JOIN category_type b ON b.cattype_id = a.cattype_id
						ORDER BY b.cattype_desc,a.cat_desc
						";
		$this->connect->query($this->sql);
		return $this->connect->resultArrayArrayValues();
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
	
	//Category- Required Fields
	public function required_fields() {
	return required_fields(array("Category Name"=>$this->cat_desc,"Category Type"=>$this->cattype_id));
	}
	
	//Add Category
	public function add_category() {		
		//Required Fields
		$required_fields = $this->required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {
		$this->calc_fields();
		//Check Duplicate
		$this->sql = "SELECT cat_id FROM category WHERE cat_link = '".addslashes($this->cat_link)."';";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		
		if(!empty($result)){$this->error="This category already exists!";}
		else {
 		$this->sql = "INSERT INTO category (cat_desc,cattype_id,cat_link) VALUES (
		'".addslashes($this->cat_desc)."',
		'".addslashes($this->cattype_id)."',
		'".addslashes($this->cat_link)."'
		);";			
		$this->connect->query($this->sql);
		$this->cat_id = $this->connect->InsertID();
		//Sys Log
		//$this->insert_log('ADD');		
		}
		}
	}
	
	//Update Category
	public function update_category() {
	
		//Required Fields
		$required_fields = $this->required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {	
		$this->calc_fields();
 		$this->sql = "UPDATE category SET 
		cat_desc = '".addslashes($this->cat_desc)."', 
		cattype_id = '".addslashes($this->cattype_id)."',
		cat_link = '".addslashes($this->cat_link)."'
		WHERE cat_id = ".$this->cat_id.";";			
		$this->connect->query($this->sql);
		//Sys Log
		//$this->insert_log('UPDATE');		
		}
	}
	
	//Delete Category
	public function delete_category() {
	
		//Sys Log
		//$this->insert_log('DELETE');
			
 		$this->sql = "DELETE FROM category
		WHERE cat_id = ".$this->cat_id.";";			
		$this->connect->query($this->sql);
		
		$this->sql = "DELETE FROM product_cat
		WHERE cat_id = ".$this->cat_id.";";			
		$this->connect->query($this->sql);
		
		$this->cat_id = "";
	}
	
	//Calc Fields
	public function calc_fields() {
		$this->cat_link = createlink($this->cat_desc);
	}
	
	//Log Defaults
	public function insert_log($d='')
	{
		if(!empty($this->cat_id)) {
		$this->get_category();
		}
		
		$this->syslog->log_type = "Product Category";
		$this->syslog->log_key = $this->cat_id;
		$this->syslog->log_desc = $d." - ".$this->cat_desc.": ".$this->cattype_desc;
		$this->syslog->insert_log();		
	}
}
?>