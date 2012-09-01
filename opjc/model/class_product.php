<?php
class product {
  	protected $connect,$sql,$syslog; 
	
	//DB Connect & Syslog
	public function __construct() {
		global $site_config;
		$this->connect = $site_config['connect']; 
		$this->syslog = new syslog();
	}
  
  	//Get Current Product
	public function get_product() {
		if($this->prd_id!="" or $this->prd_link!="")
		{
		//(admin) / (site:purchase)
		if($this->prd_id!="") {
		$this->sql = "SELECT a.*, aa.prd_desc_html, aa.prd_desc
		FROM product a 
		INNER JOIN product_desc aa ON a.prd_id = aa.prd_id
		WHERE a.prd_id = ".$this->prd_id.";";
		}
		//website
		elseif($this->prd_link!="") {
		$this->sql = "SELECT a.*, aa.prd_desc_html, b.img_width, b.img_height, b.img_name, b.img_full, c.prd_id main_prd_id, d.price
		FROM product a
		INNER JOIN product_desc aa ON a.prd_id = aa.prd_id
		LEFT JOIN product_image b ON a.prd_id = b.prd_id AND b.img_main = '1'
		LEFT JOIN product_packs c ON a.prd_id = c.pack_id AND c.prd_pack_main = '1'
		LEFT JOIN product_price d ON a.prd_id = d.prd_id AND d.prd_price_id = (SELECT MIN(d.prd_price_id) FROM product_price WHERE a.prd_id = prd_id  AND d.price_order = '1' OR d.price_order = '')
		
		WHERE a.prd_link = '".$this->prd_link."';";
		}
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		
		if(!empty($result[0]))
		{
		foreach ($result[0] as $col => $val)
		{
		$this->$col = $val;
		}
		}
		$this->get_delivery();
		}
		
	}
	
	/*
  	//Get Live Products
	public function get_live_packages() {
		$this->sql = "SELECT * FROM product WHERE prd_package = '1' AND prd_live = '1';";		
		$this->connect->query($this->sql);
		return $this->connect->resultArray();
		
	}
	*/
	
  	//Get Featured Products (Site)
	public function get_feat_packages() {
		$this->sql = "SELECT a.*, b.img_full, b.img_name 
						FROM product a
						INNER JOIN product_image b ON a.prd_id = b.prd_id AND b.img_main = '1'
						WHERE a.prd_package = '1' AND a.prd_live = '1' AND a.prd_feature != '' 
						ORDER BY a.prd_feature;";
						
		$this->connect->query($this->sql);
		return $this->connect->resultArray();
		
	}
			
	//Get Products List - Select (Admin)
	public function get_product_list() {
		$this->sql = "SELECT prd_id, prd_name FROM product WHERE prd_package = '".$this->prd_package."' ORDER BY prd_name";
		$this->connect->query($this->sql);		
		return $this->connect->resultArrayValues();
	}
	
	//Product - Required Fields
	public function required_fields() {
	return required_fields(array("Product Name"=>$this->prd_name,"Product Description"=>$this->prd_desc));
	}

	//Price Ordering (Admin)
	public function get_feature_order($prd_feature='') {
	
		if($this->prd_id!="")
		{
		$this->sql = 	"SELECT prd_feature, prd_feature
						FROM product
						WHERE prd_feature != ''";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArrayValues();				
		}
		
		for ($i = 1; $i <= 4; $i++)
			{
			if(!isset($result[$i]) or $i == $prd_feature)
				{
				$prd_feature_list[$i] = $i;
				}
			}
		return $prd_feature_list;
	}
		
	//Add Product
 	public function add_product() {	
		$this->calc_fields();
		//Required Fields
		$required_fields = $this->required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {
		//Check Duplicate
		$this->sql = "SELECT prd_id FROM product WHERE prd_link = '".addslashes($this->prd_link)."' AND prd_package = '".$this->prd_package."';";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		
		if(!empty($result)){$this->error="This product already exists!";}
		else {
 		$this->sql = "INSERT INTO product (prd_package,prd_code,prd_name,prd_site_name,prd_live,prd_link,prd_feature) VALUES (
		'".addslashes($this->prd_package)."',
		'".addslashes($this->prd_code)."',
		'".addslashes($this->prd_name)."',
		'".addslashes($this->prd_site_name)."',
		'".addslashes($this->prd_live)."', 
		'".addslashes($this->prd_link)."',
		'".addslashes($this->prd_feature)."'
		);";			
		$this->connect->query($this->sql);
		$this->prd_id = $this->connect->InsertID();
		
 		$this->sql = "INSERT INTO product_desc (prd_id,prd_desc,prd_desc_html) VALUES (
		'".addslashes($this->prd_id)."',
		'".addslashes($this->prd_desc)."',
		'".addslashes($this->prd_desc_html)."'
		);";			
		$this->connect->query($this->sql);
		
		//Sys Log
		//$this->insert_log("ADD");
		}
		}
	}
		
	public function calc_fields() {
		$this->prd_desc_html = texttohtml($this->prd_desc);
		$this->prd_link = createlink($this->prd_name);
	}
	
	//Update Product
	public function update_product() {	
	    $this->calc_fields();
		
		//Required Fields
		$required_fields = $this->required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {
		//Check Duplicate
		$this->sql = "SELECT prd_id FROM product WHERE prd_link = '".addslashes($this->prd_link)."' AND prd_id != '".$this->prd_id."' AND 				prd_package = '".$this->prd_package."';";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		
		if(!empty($result)){$this->error="This product already exists!";}
		else {

 		$this->sql = "UPDATE product SET 
		prd_package = '".addslashes($this->prd_package)."',
		prd_code = '".addslashes($this->prd_code)."',
		prd_name = '".addslashes($this->prd_name)."', 
		prd_site_name = '".addslashes($this->prd_site_name)."', 
		prd_live = '".addslashes($this->prd_live)."',
		prd_link = '".addslashes($this->prd_link)."',
		prd_feature = '".addslashes($this->prd_feature)."'
		WHERE prd_id = ".$this->prd_id.";";			
		$this->connect->query($this->sql);
		
		$this->sql = "UPDATE product_desc SET 
		prd_desc = '".addslashes($this->prd_desc)."',
		prd_desc_html = '".addslashes($this->prd_desc_html)."'
		WHERE prd_id = ".$this->prd_id.";";			
		$this->connect->query($this->sql);
		
		//Sys Log
		//$this->insert_log("UPDATE");
				
		}
		}
	}
	
	//Delete Product
	public function delete_product() {

		$this->get_product();
		
 		$this->sql = "DELETE FROM product
		WHERE prd_id = ".$this->prd_id.";";			
		$this->connect->query($this->sql);
		
		$this->sql = "DELETE FROM product_desc
		WHERE prd_id = ".$this->prd_id.";";			
		$this->connect->query($this->sql);
		
		$this->sql = "DELETE FROM product_cat
		WHERE prd_id = ".$this->prd_id.";";			
		$this->connect->query($this->sql);
		
		$this->sql = "DELETE FROM product_price
		WHERE prd_id = ".$this->prd_id.";";			
		$this->connect->query($this->sql);
		
		$this->sql = 'SELECT * FROM product_image WHERE prd_id = '.$this->prd_id;
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		if(!empty($result))
		{
		foreach($result as $row)
		{
		$this->img_id = $row['img_id'];
		$this->delete_image();
		}
		}
		
		//Sys Log
		//$this->insert_log("DELETE");
		//$this->prd_id = "";
	}
			
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////// Categories

	//Category - Required Fields
	public function cat_required_fields() {
	return required_fields(array("Category"=>$this->cat_id));
	}
				
	//Get Categories List - Select (Admin)
	public function get_category_list() {
		$this->sql = 	"SELECT b.cattype_desc, a.cat_id, a.cat_desc
						FROM category a 
						INNER JOIN category_type b ON b.cattype_id = a.cattype_id
						AND a.cat_id NOT IN (SELECT cat_id FROM product_cat WHERE prd_id = '".$this->prd_id."')
						ORDER BY b.cattype_desc,a.cat_desc
						";
		$this->connect->query($this->sql);
		return $this->connect->resultArrayArrayValues();
		
	}
	
	//Get Current Product Categories (Admin)
	public function get_categories() {
		if($this->prd_id!="")
		{
		$this->sql = 	'SELECT a.prdcat_id, b.cat_id, b.cat_desc, b.cattype_id, c.cattype_desc
						FROM product_cat a
						INNER JOIN category b ON a.cat_id = b.cat_id
						INNER JOIN category_type c ON b.cattype_id = c.cattype_id
						WHERE a.prd_id = '.$this->prd_id.'
						ORDER BY c.cattype_desc, b.cat_desc';
		$this->connect->query($this->sql);
		return $this->connect->resultArray();
		}	
	}
	
	//Get Specific Category For Product (Admin)
	public function get_category() {
		if($this->prdcat_id!="" and $this->prd_id !="")
		{
		$this->sql = 	'SELECT a.prdcat_id, b.cat_id, b.cat_desc, b.cattype_id, c.cattype_desc
						FROM product_cat a
						INNER JOIN category b ON a.cat_id = b.cat_id
						INNER JOIN category_type c ON b.cattype_id = c.cattype_id
						WHERE a.prd_id = '.$this->prd_id.' 
						AND a.prdcat_id = '.$this->prdcat_id.'
						ORDER BY c.cattype_desc, b.cat_desc';	
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		if(!empty($result[0]))
		{
		return $result[0];
		}
		}	
	}
	
	//Add Product Category (Admin)	
	public function add_category() {
		if(isset($this->prd_id))
		{	
		//Required Fields
		$required_fields = $this->cat_required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {
 		$this->sql = "INSERT INTO product_cat (prd_id,cat_id) VALUES (
		'".addslashes($this->prd_id)."', 
		'".addslashes($this->cat_id)."'
		);";			
		$this->connect->query($this->sql);
		$this->prdcat_id = $this->connect->InsertID();
		
		//Sys Log
		//$cat = $this->get_category();	
		//$this->insert_log("ADD CAT: ".$cat['cattype_desc']." ".$cat['cat_desc']."");
		}
		}
	}

	//Delete Product Category (Admin)
	public function delete_category() {	

		//Sys Log
		//$cat = $this->get_category();	
		//$this->insert_log("DELETE CAT: ".$cat['cattype_desc']." ".$cat['cat_desc']."");
		
		$this->sql = "DELETE FROM product_cat
		WHERE prdcat_id = ".$this->prdcat_id.";";			
		$this->connect->query($this->sql);
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////// Images

	//Images - Required Fields
	public function image_required_fields() {
	return required_fields(array("Image Name"=>$this->img_name));
	}
	
	//Get Current Product Images (Admin)
	public function get_images() {
		if($this->prd_id!="")
		{
		$this->sql = 	"SELECT *
						FROM product_image a
						WHERE a.prd_id = ".$this->prd_id."
						ORDER BY a.img_main DESC, a.img_id ASC";
		$this->connect->query($this->sql);
		return $this->connect->resultArray();
		}	
	}
		
	//Add Product Image (Admin)	
	public function add_image() {	
		global $site_config;		
		$this->get_product();
		
		$image = image_file($_FILES);
		if(empty($image['error']))
		{		
		//Check Image Type & Format
		$check = check_image($_FILES,$site_config['prd_img_fixed_width'],$site_config['prd_img_fixed_height'],$site_config['prd_img_fixed_type']);
		
		if($check!="" and $site_config['prd_img_fixed'] == "1") {
		$this->error=$check;
		}
		
		else {
		$image_file = $this->prd_link.$image['type'];
		
	 	$this->sql = "INSERT INTO product_image (prd_id,img_width,img_height,img_type,img_name,img_size) VALUES (
		'".addslashes($this->prd_id)."',
		'".addslashes($image['width'])."', 
		'".addslashes($image['height'])."',
		'".addslashes($image['type'])."',
		'".addslashes($image['name'])."',
		'".addslashes($image['size'])."'
		);";			
		$this->connect->query($this->sql);
		$this->img_id = $this->connect->InsertID();
		
		$image_file = $this->prd_link."_".$this->img_id.$image['type'];
		
		$this->sql = "UPDATE product_image SET 
		img_link = '".addslashes($this->prd_link."_".$this->img_id)."', 
		img_full = '".addslashes($image_file)."'
		WHERE img_id = ".$this->img_id.";";			
		$this->connect->query($this->sql);
		
		$target_file = $site_config['prd_img_path'].$image_file;		
		if(!move_uploaded_file($image['temp'],$target_file)) {
    	$this->error="Something went wrong man!";
		}
		
		//Icon
		$icon_target_file = $site_config['prd_img_icon_path'].$image_file;	
		$icon = new resize($target_file);
		$icon -> resizeImage($site_config['prd_img_icon_width'],$site_config['prd_img_icon_height'], 'auto');
		$icon -> saveImage($icon_target_file,$site_config['prd_img_icon_qty']);
		
		//Featured
		$feat_target_file = $site_config['prd_img_feat_path'].$image_file;	
		$feat = new resize($target_file);
		$feat -> resizeImage($site_config['prd_img_feat_width'],$site_config['prd_img_feat_height'], 'auto');
		$feat -> saveImage($feat_target_file,$site_config['prd_img_feat_qty']);
		}

		$this->update_image_main();
		
		//Sys Log	
		//$this->insert_log("ADD IMAGE: ".$image['name']."");
		
		}
		else
		{
		$this->error=$image['error'];
		}
	}

	//Update Product Image (Admin)
	public function update_image() {
		//Required Fields
		$required_fields = $this->image_required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {
		$this->sql = "UPDATE product_image SET 
		img_name = '".addslashes($this->img_name)."', 
		img_main = '".addslashes($this->img_main)."'
		WHERE img_id = ".$this->img_id.";";			
		$this->connect->query($this->sql);
		$this->update_image_main();
		
		//Sys Log	
		//$this->insert_log("UPDATE IMAGE: ".$this->img_name." Main: ".$this->img_main."");
		}
	}
	
	//Delete Product Image (Admin)
	public function delete_image() {	
		global $site_config;		
		$this->sql = "SELECT img_name, img_full
		FROM product_image a
		WHERE a.img_id = ".$this->img_id.";";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		
		unlink($site_config['prd_img_path'].$result[0]['img_full']);
		unlink($site_config['prd_img_icon_path'].$result[0]['img_full']);
		unlink($site_config['prd_img_feat_path'].$result[0]['img_full']);
		
		$this->sql = "DELETE FROM product_image 
		WHERE img_id = ".$this->img_id.";";			
		$this->connect->query($this->sql);
		$this->update_image_main();
		
		//Sys Log	
		//$this->insert_log("DELETE IMAGE: ".$result[0]['img_name']);
	}

	//Update Product Image MAIN!!!
	public function update_image_main() {
		$this->sql = "SELECT img_id
		FROM product_image a
		WHERE a.prd_id = ".$this->prd_id."
		AND a.img_main = '1'";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		
		if(count($result)>1)
		{
		$this->sql = "UPDATE product_image SET 
		img_main = ''
		WHERE prd_id = ".$this->prd_id." AND img_main = '1' AND img_id != ".$this->img_id.";";
		$this->connect->query($this->sql);
		}
		
		if(empty($result))
		{
		$this->sql = "UPDATE product_image a
		INNER JOIN (SELECT MIN(img_id) img_id FROM product_image WHERE prd_id = '".$this->prd_id."') b ON a.img_id = b.img_id
		SET a.img_main = '1'
		WHERE a.prd_id = ".$this->prd_id.";";
		$this->connect->query($this->sql);
		}
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////// Prices
	
	//Prices - Required Fields
	public function price_required_fields() {
	return required_fields(array("Product Type"=>$this->price_type_id,"Price"=>$this->price));
	}
	
	//Get Prices List - Select (Admin)
	public function get_pricetype_list() {
		$this->sql = 	"SELECT	price_type_id, price_type_name
						FROM price_type
						WHERE price_type_id NOT IN (SELECT price_type_id FROM product_price WHERE prd_id = '".$this->prd_id."')
						ORDER BY price_type_desc
						";
		$this->connect->query($this->sql);
		return $this->connect->resultArrayValues();
	}

	//Get Prices List - Select2 (Site)
	public function get_pricetype_list2() {
		if($this->prd_id!="")
		{
		$this->sql = 	"SELECT a.prd_price_id,CONCAT(b.price_type_name,' - &pound;',a.price) price_type_name
						FROM product_price a
						INNER JOIN price_type b ON a.price_type_id = b.price_type_id
						WHERE a.prd_id = ".$this->prd_id." AND b.price_type_delivery != '1'
						ORDER BY a.price_order ASC, b.price_type_desc ASC";
		$this->connect->query($this->sql);
		
		return $this->connect->resultArrayValues();				
		}	
	}
		
	//Get Current Product Prices (Admin)
	public function get_prices() {
		if($this->prd_id!="")
		{
		$this->sql = 	'SELECT a.prd_price_id,b.price_type_name,a.price_type_id,a.price, a.price_order, a.price_code
						FROM product_price a
						INNER JOIN price_type b ON a.price_type_id = b.price_type_id
						WHERE a.prd_id = '.$this->prd_id.'
						ORDER BY a.price_order ASC, b.price_type_desc ASC';
		$this->connect->query($this->sql);
		$this->no_of_prices = $this->connect->numRows();
		return $this->connect->resultArray();
				
		}	
	}

	//Get Current Product Prices (Site:Home)
	public function get_min_price() {
		if($this->prd_id!="")
		{
		$this->sql = 	"SELECT MIN(a.price) price
						FROM product_price a
						INNER JOIN price_type b ON a.price_type_id = b.price_type_id
						WHERE a.prd_id = ".$this->prd_id." AND b.price_type_delivery != '1';";
		$this->connect->query($this->sql);
		
		$this->no_of_prices = $this->connect->numRows();
		$result = $this->connect->resultArray();
		return $result[0]['price'];
				
		}	
	}
	
	//Get Delivery (Site:Home)
	public function get_delivery() {
		if($this->prd_id!="")
		{
		$this->sql = 	"SELECT SUM(a.price) price
						FROM product_price a
						INNER JOIN price_type b ON a.price_type_id = b.price_type_id
						WHERE a.prd_id = ".$this->prd_id." AND b.price_type_delivery = '1';";
		$this->connect->query($this->sql);
		
		$result = $this->connect->resultArray();
		$this->delivery_cost = $result[0]['price'];
				
		}	
	}		
		
		
		
	//Price Ordering (Admin)
	public function get_price_order($price_order='') {
		if($this->prd_id!="")
		{
		$this->sql = 	"SELECT a.price_order, a.price_order
						FROM product_price a
						WHERE a.prd_id = ".$this->prd_id." AND a.price_order != ''";
		$this->connect->query($this->sql);

		$result = $this->connect->resultArrayValues();				
		}

		if($this->no_of_prices >= 1)
		{
		for ($i = 1; $i <= $this->no_of_prices; $i++)
			{
			if(!isset($result[$i]) or $i == $price_order)
				{
				$price_order_list[$i] = $i;
				}
			}
		}
		return $price_order_list;
	}
	
	//Get Specific Price For Product (used by product and order class)
	public function get_price() {
		if($this->prd_id!="")
		{
		$this->sql = "SELECT a.prd_price_id,b.price_type_desc,a.price_type_id,a.price,a.price_code, a.price_order
FROM product_price a
INNER JOIN price_type b ON a.price_type_id = b.price_type_id
WHERE a.prd_id = ".$this->prd_id."
AND a.prd_price_id = ".$this->prd_price_id."
ORDER BY b.price_type_desc";

		$this->connect->query($this->sql);
				
		$result = $this->connect->resultArray();
		if(!empty($result[0]))
		{
		return $result[0];
		}
		}	
	}
	
	//Add Price
	public function add_price() {
		if(isset($this->prd_id))
		{
		//Required Fields
		$required_fields = $this->price_required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {
 		$this->sql = "INSERT INTO product_price (prd_id,price_type_id,price,price_code) VALUES (
		'".addslashes($this->prd_id)."', 
		'".addslashes($this->price_type_id)."',
		'".addslashes($this->price)."',
		'".addslashes($this->price_code)."'
		);";			
		$this->connect->query($this->sql);
		$this->prd_price_id = $this->connect->InsertID();
		
		//Sys Log
		//$price = $this->get_price();	
		//$this->insert_log("ADD PRICE: ".$price['price_type_desc']." - Price: ".$price['price']." - Order: ".$price['price_order']);
		}
		}
	}
	
	//Update Price
	public function update_price() {
		//Required Fields
		$required_fields = $this->price_required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {			
		$this->sql = "UPDATE product_price
		SET price = '".addslashes($this->price)."',
		price_code = '".addslashes($this->price_code)."',
		price_order = '".addslashes($this->price_order)."'
		WHERE prd_price_id = ".$this->prd_price_id.";";			
		$this->connect->query($this->sql);
		
		//Sys Log
		//$price = $this->get_price();	
		//$this->insert_log("UPDATE PRICE: ".$price['price_type_desc']." - Price: ".$price['price']." - Order: ".$price['price_order']);
		}
	}
	
	//Delete Price
	public function delete_price() {
	
		//Sys Log
		//$price = $this->get_price();	
		//$this->insert_log("DELETE PRICE: ".$price['price_type_desc']." - ".$price['price']);
			
		$this->sql = "DELETE FROM product_price
		WHERE prd_price_id = ".$this->prd_price_id.";";			
		$this->connect->query($this->sql);
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////// Package Products	
	
	//Package Products - Required Fields
	public function packproduct_required_fields() {
	return required_fields(array("Product"=>$this->pack_prd_id));
	}
	
	//Get Items List - Select (admin)
	public function get_packproduct_list() {
		$this->sql = "SELECT prd_id pack_id, prd_name 
		FROM product 
		WHERE prd_package = '0' 
		AND prd_id NOT IN (SELECT prd_id FROM product_packs WHERE pack_id = '".$this->prd_id."')
		ORDER BY prd_name";
		$this->connect->query($this->sql);
		return $this->connect->resultArrayValues();
	}
	
	//Get Current Product Items (Site & Admin)
	public function get_packproducts() {
		if($this->prd_id!="")
		{
		$this->sql = 	'SELECT b.prd_pack_id, b.prd_pack_main, a.*, aa.prd_desc_html
						FROM product a
						INNER JOIN product_desc aa ON a.prd_id = aa.prd_id
						INNER JOIN product_packs b ON a.prd_id = b.prd_id						
						WHERE b.pack_id = '.$this->prd_id.'
						ORDER BY b.prd_pack_main DESC, a.prd_name ASC';
		$this->connect->query($this->sql);
		
		return $this->connect->resultArray();
		}	
	}
	
		//Get Items List - Site
	public function get_packproducts_list() {
		if($this->prd_id!="")
		{
		$this->sql = 	"SELECT b.prd_id, a.prd_site_name
						FROM product a
						INNER JOIN product_packs b ON a.prd_id = b.prd_id
						WHERE b.pack_id = ".$this->prd_id."
						AND a.prd_live = '1'
						ORDER BY b.prd_pack_main DESC, a.prd_name ASC";
		$this->connect->query($this->sql);
		
		return $this->connect->resultArrayValues();
		}	
	}
	
	/*
	//Get Specific Item For Product - Used for logging
	public function get_packproduct() {
		if($this->prd_id!="")
		{
		$this->sql = 	'SELECT b.prd_pack_id, b.prd_pack_main, a.prd_id, a.prd_name
						FROM product a
						INNER JOIN product_packs b ON a.prd_id = b.prd_id
						WHERE b.pack_id = '.$this->prd_id.'
						AND b.prd_pack_id = '.$this->prd_pack_id.'
						ORDER BY b.prd_pack_main DESC, a.prd_name ASC';
		$this->connect->query($this->sql);
		
		$result = $this->connect->resultArray();
		if(!empty($result[0]))
		{
		return $result[0];
		}
		}	
	}
	*/
	
	//Add Item to Product
	public function add_packproduct() {
		if(isset($this->prd_id))
		{
		$required_fields = $this->packproduct_required_fields();
		if($required_fields!="") {$this->error=$required_fields;} else {			
 		$this->sql = "INSERT INTO product_packs (prd_pack_main,pack_id,prd_id) VALUES (
		'".addslashes($this->prd_pack_main)."', 
		'".addslashes($this->prd_id)."', 
		'".addslashes($this->pack_prd_id)."' 
		);";			
		$this->connect->query($this->sql);
		$this->prd_pack_id = $this->connect->InsertID();
		
		$this->update_packproduct_main();
		
		//Sys Log
		//$packproduct = $this->get_packproduct();	
		//$this->insert_log("ADD PRODUCT ITEM: ".$packproduct['prd_name']);
		}
		}
	}
	
	//Update Item for Product
	public function update_packproduct() {
		if(isset($this->prd_id))
		{			
 		$this->sql = "UPDATE product_packs SET
		prd_pack_main = '".addslashes($this->prd_pack_main)."'
		WHERE prd_pack_id = '".addslashes($this->prd_pack_id)."';";			
		$this->connect->query($this->sql);
		$this->update_packproduct_main();
		
		//Sys Log
		//$packproduct = $this->get_packproduct();	
		//$this->insert_log("UPDATE PRODUCT ITEM: ".$packproduct['prd_name']." Main: ".$packproduct['prd_pack_main']);
		}
	}
	
	public function delete_packproduct() {
	
		//Sys Log
		//$packproduct = $this->get_packproduct();	
		//$this->insert_log("DELETE PRODUCT ITEM: ".$packproduct['prd_name']);
			
		$this->sql = "DELETE FROM product_packs
		WHERE prd_pack_id = ".$this->prd_pack_id.";";			
		$this->connect->query($this->sql);
		$this->update_packproduct_main();		
	}
	
	//Product Item MAIN!!!
	public function update_packproduct_main() {
		$this->sql = "SELECT prd_pack_id
		FROM product_packs a
		WHERE a.pack_id = ".$this->prd_id."
		AND a.prd_pack_main = '1'";
		$this->connect->query($this->sql);
		$result = $this->connect->resultArray();
		
		if(count($result)>1)
		{
		$this->sql = "UPDATE product_packs SET 
		prd_pack_main = ''
		WHERE pack_id = ".$this->prd_id." AND prd_pack_main = '1' AND prd_pack_id != ".$this->prd_pack_id.";";
		$this->connect->query($this->sql);
		}
		
		if(empty($result))
		{
		$this->sql = "UPDATE product_packs a
		INNER JOIN (SELECT MIN(prd_pack_id) prd_pack_id FROM product_packs WHERE pack_id = '".$this->prd_id."') b ON a.prd_pack_id = b.prd_pack_id
		SET a.prd_pack_main = '1'
		WHERE a.pack_id = ".$this->prd_id.";";
		$this->connect->query($this->sql);
		}
	}

	//Get Package Images
	public function get_package_images() {
		if($this->prd_id!="")
		{
		$this->sql = 	"SELECT a.*
						FROM product_image a
						INNER JOIN product_packs b ON a.prd_id = b.prd_id
						WHERE b.pack_id = ".$this->prd_id."
						ORDER BY a.img_main DESC, a.img_id ASC";
		$this->connect->query($this->sql);
		return $this->connect->resultArray();
		}	
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////// Other	

	//Class Descriptions
	public function product_desc($t,$v) {
	if($t==1) {
		if($v=="1") {
			return "Product";
		}
		else {
			return "Item";
		}
		
	}
	}
	
	//Log Defaults
	public function insert_log($d)
	{
		if(!empty($this->prd_id)) {
		$this->get_product();
		}
		
		$this->syslog->log_type = "Product";
		$this->syslog->log_key = $this->prd_id;
		$this->syslog->log_desc = $d." - ".$this->product_desc(1,$this->prd_package).": ".$this->prd_name." / Live:".$this->prd_live;
		$this->syslog->insert_log();		
	}
}
?>