<?php

//Includes

include ($site_config['path'].'incfiles/functions.php'); 

include ($site_config['path'].'PHPMailer/class.phpmailer.php'); 



//Classes

include ($site_config['path'].'incfiles/class_db.php'); 

include ($site_config['path'].'incfiles/class_syslog.php');

include ($site_config['path'].'incfiles/class_form.php');

include ($site_config['path'].'incfiles/class_table.php'); 

include ($site_config['path'].'incfiles/class_template.php');

include ($site_config['path'].'incfiles/class_resize.php');

include ($site_config['path'].'incfiles/class_mail.php');

include ($site_config['path'].'incfiles/class_password.php');

include ($site_config['path'].'incfiles/class_twitter.php');



//Models

include ($site_config['path'].'model/class_product.php');

include ($site_config['path'].'model/class_category.php');

include ($site_config['path'].'model/class_categorytype.php');

include ($site_config['path'].'model/class_pricetype.php');
include ($site_config['path'].'model/class_voucher.php');

include ($site_config['path'].'model/class_site.php');

include ($site_config['path'].'model/class_customer.php');

include ($site_config['path'].'model/class_user.php');

include ($site_config['path'].'model/class_order.php');

include ($site_config['path'].'model/class_paypal.php');

include ($site_config['path'].'model/class_johnny_tweet.php');



//Connect

$site_config['connect'] = new db();

$site_config['connect']->Host = $site_config['db']['host'];

$site_config['connect']->Database = $site_config['db']['db'];

$site_config['connect']->User = $site_config['db']['user'];

$site_config['connect']->Password = $site_config['db']['pass'];

?>