<?php
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_site_home.php');

//Featured Products
$build['product'] = new product();
$build['products'] = $build['product']->get_feat_packages();

foreach($build['products'] as $build['products_row'])
{
$i++;
$build['product_list'][$i]['prd_name'] = $build['products_row']['prd_name'];
$build['product_list'][$i]['prd_alt'] = $build['products_row']['img_name'];
$build['product_list'][$i]['prd_link'] = $site_config['product_url'].$build['products_row']['prd_link']."/";
$build['product_list'][$i]['img_full'] = $site_config['prd_img_feat_url'].$build['products_row']['img_full'];
$build['product']->prd_id = $build['products_row']['prd_id'];
$build['product']->get_delivery();
if(!empty($build['product']->delivery_cost)){$build['del_cost'] = " + P&amp;P";}else{$build['del_cost'] = " Inc. P&amp;P";}
$build['product_list'][$i]['price'] = "&pound;".$build['product']->get_min_price()."/Month".$build['del_cost'];
}

$build['product_list'][$i]['last'] = " last";
$build['tmpl']->feat_product_list = $build['product_list'];

//Twitter
$build['twitter'] = new johnny_tweet();
$build['twitter']->show_tweet();
$build['tmpl']->tweet = $build['twitter']->tweet;

$page['title'] = "One Pound Johnny Club - Subscription Condoms";
$page['body'] = $build['tmpl']->parse();
///////////////////////////////////////////////////////////////////////////////Tidy Up
unset($build);
?>