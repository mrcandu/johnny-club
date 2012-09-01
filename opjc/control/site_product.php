<?php

$build['product'] = new product();

$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_site_product.php');

$build['form'] = new form(1);



$build['product']->prd_link = $_GET['ctrl2'];

$build['product']->get_product();



if(isset($_POST))

{

$build['product']->main_prd_id = trim($_POST['prd_item_id']);

}



//Item Details

$build['tmpl']->prd_id = $build['form']->formHidden('prd_id',$build['product']->prd_id);

$build['tmpl']->prd_name = $build['product']->prd_name;

$build['tmpl']->prd_desc_html = $build['product']->prd_desc_html;

$build['tmpl']->prd_image = $site_config['prd_img_url'].$build['product']->img_full;

$build['tmpl']->prd_image_name = $build['product']->image_name;

$build['tmpl']->page_path = $site_config['url'];



//Items Select

$build['items_select'] = $build['product']->get_packproducts_list();

if(sizeof($build['items_select'])>1)

{

$build['tmpl']->prd_item_id = $build['form']->formSelect('prd_item_id',$build['items_select'],$build['product']->main_prd_id,'',null,'1');

}

else

{

$build['tmpl']->prd_item_id = $build['form']->formHidden('prd_item_id',key($build['items_select']));

}

////



////Items List

$build['items'] = $build['product']->get_packproducts();

if(!empty($build['items']))

{

foreach($build['items'] as $build['items_row'])

{

$i++;

$build['items_list'][$i]['prd_id'] = $build['items_row']['prd_id'];

$build['items_list'][$i]['prd_name'] = $build['items_row']['prd_site_name'];

$build['items_list'][$i]['prd_desc_html'] = $build['items_row']['prd_desc_html'];

}

$build['tmpl']->items_list = $build['items_list'];



//Items List Images

$build['items_list_imgs'] = $build['product']->get_package_images();

if(!empty($build['items_list_imgs']))

{

foreach($build['items_list_imgs'] as $build['items_list_imgs_row'])

{

$i++;

$build['item_images'][$build['items_list_imgs_row']['prd_id']][$i]['img_icon_full'] = $site_config['prd_img_icon_url'].$build['items_list_imgs_row']['img_full'];

$build['item_images'][$build['items_list_imgs_row']['prd_id']][$i]['img_full'] = $site_config['prd_img_url'].$build['items_list_imgs_row']['img_full'];

$build['item_images'][$build['items_list_imgs_row']['prd_id']][$i]['img_name'] = $build['items_list_imgs_row']['img_name'];

}

$build['tmpl']->item_images = $build['item_images'];

}



//Product Prices

$build['prd_prices'] = $build['product']->get_pricetype_list2();

if(!empty($build['prd_prices']))

{

if(sizeof($build['prd_prices'])>1)

{

$build['tmpl']->prd_prices = $build['form']->formSelect('prd_price_id',$build['prd_prices'],$_POST['prd_price_id'],'',null,'1');

$build['tmpl']->prd_price = "From &pound;".$build['product']->get_min_price()." / Month";

}

else

{

$build['tmpl']->prd_prices = $build['form']->formHidden('prd_price_id',key($build['prd_prices']));

$build['tmpl']->prd_price = "&pound;".$build['product']->get_min_price()." / Month";

}

if(!empty($build['product']->delivery_cost)){

$build['tmpl']->prd_price .= " + P&amp;P";

}

else

{

$build['tmpl']->prd_price .= " INC. P&amp;P";

}

}



}

$build['tmpl']->voucher = $build['form']->formInput('vcherval','Voucher Code','');
$build['tmpl']->vcher = $build['form']->formHidden('vcher','');

$build['tmpl']->page_path = $site_config['url'];

////



$page['title'] = $build['product']->prd_name." | One Pound Johnny Club";

$page['jquery'] = '<script src="'.$site_config['url'].'incfiles/js_site_product_040313.js"></script>';

$page['body'] = $build['tmpl']->parse();

///////////////////////////////////////////////////////////////////////////////Tidy Up

unset($build);

?>