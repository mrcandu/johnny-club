<?php 
$build['model'] = new product();
$build['form'] = new form(1);

///////////////////////////////////////////////////////////////////////////////Define ID
$build['model']->prd_package = $build['product_mode'];
if($_POST['prd_id']!=""){$build['model']->prd_id = $_POST['prd_id'];}

if($build['model']->prd_package=="1"){
$build['tmpl_file']="tmpl_admin_package.php";
$build['title']="Product";}
else{
$build['tmpl_file']="tmpl_admin_product.php";
$build['title']="Item";}

$build['tmpl'] = new Templater($site_config['path'].'templates/'.$build['tmpl_file']);

///////////////////////////////////////////////////////////////////////////////Add / Update Procedure
if(isset($_POST['action']))
{
$build['model']->prd_name = trim($_POST['prd_name']);
$build['model']->prd_site_name = trim($_POST['prd_site_name']);
$build['model']->prd_code = trim($_POST['prd_code']);
$build['model']->prd_live = trim($_POST['prd_live']);
$build['model']->prd_feature = trim($_POST['prd_feature']);
$build['model']->prd_desc = trim($_POST['prd_desc']);
$build['model']->cat_id = trim($_POST['cat_id']);
$build['model']->prdcat_id = trim($_POST['prdcat_id']);
$build['model']->prd_img = $_FILES;
$build['model']->img_id = trim($_POST['img_id']);
$build['model']->img_name = trim($_POST['img_name']);
$build['model']->img_main = trim($_POST['img_main']);

$build['model']->prd_price_id = trim($_POST['prd_price_id']);
$build['model']->price_type_id = trim($_POST['price_type_id']);
$build['model']->price = trim($_POST['price']);
$build['model']->price_code = trim($_POST['price_code']);
$build['model']->price_order = trim($_POST['price_order']);

$build['model']->pack_prd_id = trim($_POST['pack_prd_id']); //Product added to pack
$build['model']->prd_pack_id = trim($_POST['prd_pack_id']); //product_packs record
$build['model']->prd_pack_main = trim($_POST['prd_pack_main']); //product_packs record
}

if($_POST['action']=="Add"){$build['model']->add_product();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Update"){$build['model']->update_product();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Delete Confirm"){$build['model']->delete_product();}

elseif($_POST['action']=="Add Category"){$build['model']->add_category();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Delete Cat"){$build['model']->delete_category();}
elseif($_POST['action']=="Upload Image"){$build['model']->add_image();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Update Image"){$build['model']->update_image();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Delete Image"){$build['model']->delete_image();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Add Price"){$build['model']->add_price();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Update Price"){$build['model']->update_price();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Delete Price"){$build['model']->delete_price();$build['error']=$build['model']->error;}

elseif($_POST['action']=="Add Item"){$build['model']->add_packproduct();$build['error']=$build['model']->error;}
elseif($_POST['action']=="Update Item"){$build['model']->update_packproduct();}
elseif($_POST['action']=="Delete Item"){$build['model']->delete_packproduct();}
///////////////////////////////////////////////////////////////////////////////Get Data For Form
$build['model']->get_product();
///////////////////////////////////////////////////////////////////////////////Populate Template
$build['tmpl']->prd_id = $build['model']->prd_id;
$build['tmpl']->error = $build['error'];

//Select / Delete a Product
$build['tmpl']->prd_select = $build['form']->formSelect('prd_id',$build['model']->get_product_list(),$build['model']->prd_id,'Select '.$build['title'].':');
$build['tmpl']->frm_select_btn = $build['form']->formButton('select','submit',"Select");
if($_POST['action']!="Delete" and $build['model']->prd_id!="") {
$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete");
}
if($_POST['action']=="Delete") {
$build['tmpl']->frm_delete_btn = $build['form']->formButton('action','submit',"Delete Confirm");
}

//Update Product
$build['tmpl']->prd_name = $build['form']->formInput('prd_name',$build['model']->prd_name,$build['title'].' Name:',1);
$build['tmpl']->prd_site_name = $build['form']->formInput('prd_site_name',$build['model']->prd_site_name,$build['title'].' Site Name:',1);
$build['tmpl']->prd_code = $build['form']->formInput('prd_code',$build['model']->prd_code,$build['title'].' Code:');
$build['tmpl']->prd_live = $build['form']->formCheck('prd_live',$build['model']->prd_live,$build['title'].' Live:');
$build['tmpl']->prd_feature =  $build['form']->formSelect('prd_feature',$build['model']->get_feature_order($build['model']->prd_feature),$build['model']->prd_feature,'Home Feature:');

$build['tmpl']->prd_desc = $build['form']->formText('prd_desc',$build['model']->prd_desc,$build['title'].' Description:',1);
$build['tmpl']->prd_id = $build['form']->formHidden('prd_id',$build['model']->prd_id);
if($build['model']->prd_id!=""){$build['btn_act'] = "Update";}else{$build['btn_act'] = "Add";}
$build['tmpl']->frm_submit_btn1 = $build['form']->formButton('action','submit',$build['btn_act']);

if($build['model']->prd_package == "0")
{
//Add Category
$build['tmpl']->prd_cat = $build['form']->formSelect('cat_id',$build['model']->get_category_list(),null,'Select a Category:');
$build['tmpl']->frm_submit_btn2 = $build['form']->formButton('action','submit',"Add Category");

//Category List
$build['tmpl']->prd_catlist = $build['model']->get_categories();
$build['tmpl']->frm_submit_btn3 = $build['form']->formButton('action','submit',"Delete Cat");
}

if($build['model']->prd_package == "1")
{
//Pack Product List
$build['tmpl']->prd_cat = $build['form']->formSelect('pack_prd_id',$build['model']->get_packproduct_list(),null,'Select an Item:');
$build['tmpl']->frm_submit_btn2 = $build['form']->formButton('action','submit',"Add Item");

$build['packproducts'] = $build['model']->get_packproducts();
if(!empty($build['packproducts']))
{
foreach($build['packproducts'] as $build['packproduct'])
{
$i++;
$build['packproducts_list'][$i]['prd_name'] = $build['packproduct']['prd_name'];
$build['packproducts_list'][$i]['prd_pack_main'] = $build['form']->formCheck('prd_pack_main',$build['packproduct']['prd_pack_main']);
$build['packproducts_list'][$i]['prd_pack_id'] = $build['form']->formHidden('prd_pack_id',$build['packproduct']['prd_pack_id']);
}
}
$build['tmpl']->prd_prdlist = $build['packproducts_list'];
$build['tmpl']->frm_submit_btn3 = $build['form']->formButton('action','submit',"Update Item");
$build['tmpl']->frm_submit_btn4 = $build['form']->formButton('action','submit',"Delete Item");

//Add Price
$build['tmpl']->prd_price_type = $build['form']->formSelect('price_type_id',$build['model']->get_pricetype_list(),null,'Select a Price:',1);
$build['tmpl']->prd_price = $build['form']->formInput('price','','Price:',1);
$build['tmpl']->prd_price_code = $build['form']->formInput('price_code','','Price Code:');
$build['tmpl']->frm_submit_btn5 = $build['form']->formButton('action','submit',"Add Price");

//Price List
$build['prd_prices'] = $build['model']->get_prices();

if(!empty($build['prd_prices']))
{
foreach($build['prd_prices'] as $build['prd_price'])
{
$i++;
$build['prd_pricelist'][$i]['price_type_name'] = $build['prd_price']['price_type_name'];
$build['prd_pricelist'][$i]['price'] = $build['form']->formInput('price',$build['prd_price']['price'],'');
$build['prd_pricelist'][$i]['price_code'] = $build['form']->formInput('price_code',$build['prd_price']['price_code'],'');
$build['prd_pricelist'][$i]['price_order'] =  $build['form']->formSelect('price_order',$build['model']->get_price_order($build['prd_price']['price_order']),$build['prd_price']['price_order'],'');
$build['prd_pricelist'][$i]['prd_price_id'] = $build['form']->formHidden('prd_price_id',$build['prd_price']['prd_price_id']);
$build['prd_pricelist'][$i]['price_type_id'] = $build['form']->formHidden('price_type_id',$build['prd_price']['price_type_id']);		
}

$build['tmpl']->prd_pricelist = $build['prd_pricelist'];
$build['tmpl']->frm_submit_btn6 = $build['form']->formButton('action','submit',"Update Price");
$build['tmpl']->frm_submit_btn7 = $build['form']->formButton('action','submit',"Delete Price");
}

}

//Image Form
$build['tmpl']->prd_imgfile = $build['form']->formFile('prd_img','Upload Image:',1);
$build['tmpl']->frm_submit_btn8 = $build['form']->formButton('action','submit',"Upload Image");

//Image List
$build['prd_images'] = $build['model']->get_images();
if(!empty($build['prd_images']))
{
foreach($build['prd_images'] as $build['prd_image'])
{
$i++;
$build['prd_images_list'][$i]['img_name'] = $build['form']->formInput('img_name',$build['prd_image']['img_name']);
$build['prd_images_list'][$i]['img_main'] = $build['form']->formCheck('img_main',$build['prd_image']['img_main']);
$build['prd_images_list'][$i]['img_url'] = $site_config['prd_img_url'].$build['prd_image']['img_full'];
$build['prd_images_list'][$i]['img_icon_url'] = $site_config['prd_img_icon_url'].$build['prd_image']['img_full'];
$build['prd_images_list'][$i]['img_id'] = $build['form']->formHidden('img_id',$build['prd_image']['img_id']);
}
$build['tmpl']->prd_images_list = $build['prd_images_list'];
$build['tmpl']->frm_submit_btn9 = $build['form']->formButton('action','submit',"Update Image");
$build['tmpl']->frm_submit_btn10 = $build['form']->formButton('action','submit',"Delete Image");
}

//Close Link
if($build['model']->prd_id!=""){$build['link_close'] = "<a href=\"\">Close ".$build['title']."</a>";}
$build['tmpl']->link_close = $build['link_close'];

///////////////////////////////////////////////////////////////////////////////Render The Page
$page['title'] = $build['title']."s";
$page['body'] = $build['tmpl']->parse();

///////////////////////////////////////////////////////////////////////////////Tidy Up
unset($build);
?>