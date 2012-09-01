<?php

class voucher {

 	protected $connect,$sql; 

	

	//DB Connect & Syslog

	public function __construct() {

		global $site_config;

		$this->connect = $site_config['connect']; 

		$this->syslog = new syslog();

	}

	

	//Get Current Price Type

	public function get_voucher() {

		if($this->v_id!="")

		{

		$this->sql = 'SELECT * FROM voucher WHERE v_id = '.$this->v_id;

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

	public function get_voucher_list() {

		$this->sql = 'SELECT v_id,v_code FROM voucher ORDER BY v_id';

		$this->connect->query($this->sql);

		return $this->connect->resultArrayValues();

	}

	

	//PriceType- Required Fields

	public function required_fields() {

	return required_fields(array("v_code"=>$this->v_code,"v_desc"=>$this->v_desc));

	}

	

	//Add Price Type

 	public function add_voucher() {

		//Required Fields

		$required_fields = $this->required_fields();

		if($required_fields!="") {$this->error=$required_fields;} else {	

		//Check Duplicate

		$this->sql = "SELECT v_code FROM voucher WHERE v_code = '".addslashes($this->v_code)."';";

		$this->connect->query($this->sql);

		$result = $this->connect->resultArray();

		

		if(!empty($result)){$this->error="This voucher already exists!";}

		else {

 		$this->sql = "INSERT INTO voucher (v_code,v_desc,v_live) VALUES (

		'".addslashes($this->v_code)."',

		'".addslashes($this->v_desc)."',

		'".addslashes($this->v_live)."'

		);";			

		$this->connect->query($this->sql);

		$this->v_id = $this->connect->InsertID();

		//Sys Log

		//$this->insert_log('ADD');

		}

		}

	}

	

	//Update Price Type

	public function update_voucher() {

		//Required Fields

		$required_fields = $this->required_fields();

		if($required_fields!="") {$this->error=$required_fields;} else {	

 		$this->sql = "UPDATE voucher SET 

		v_code = '".addslashes($this->v_code)."',

		v_desc = '".addslashes($this->v_desc)."', 

		v_live = '".addslashes($this->v_live)."'

		WHERE v_id = ".$this->v_id.";";			

		$this->connect->query($this->sql);

		//Sys Log

		//$this->insert_log('UPDATE');

		}

	}

	

	//Delete Price Type

	public function delete_voucher() {

		//Sys Log

		//$this->insert_log('DELETE');

			

 		$this->sql = "DELETE FROM voucher

		WHERE v_id = ".$this->v_id.";";			

		$this->connect->query($this->sql);


		$this->v_id = "";		

	}
}
?>