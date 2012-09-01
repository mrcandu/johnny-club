<?php


////////////////////////////////////////////////////////////////////////////  Live


//Paths

$site_config['url'] = "http://onepoundjohnnyclub.com/";
$site_config['path'] = "/home/johnny/public_html/opjc/";



//DB

$site_config['db']['host'] = "localhost";
$site_config['db']['db'] = "johnny_live";
$site_config['db']['user'] = "johnny_db";
$site_config['db']['pass'] = "";



//Paypal

$site_config['paypal_url']= "https://www.paypal.com/cgi-bin/webscr";
$site_config['paypal_business'] = "";
$site_config['receiver_email'] = "sales@onepoundjohnnyclub.com";
$site_config['paypal_pdt'] = "";
$site_config['api_url'] = "https://api-3t.paypal.com/nvp";
$site_config['api_user'] = "mat_api1.onepoundjohnnyclub.com";
$site_config['api_pwd'] = "";
$site_config['api_sig'] = "";

$site_config['paypal_t3'] = "M";

//Google
$site_config['google'] = "1";


////////////////////////////////////////////////////////////////////////////

//Contact Email

$site_config['contact_email']['2']['host'] = "smtp.gmail.com";
$site_config['contact_email']['2']['port'] = 465;
$site_config['contact_email']['2']['smtp'] = "1";
$site_config['contact_email']['2']['username'] = "sales@onepoundjohnnyclub.com";
$site_config['contact_email']['2']['password'] = "";
$site_config['contact_email']['2']['from_name'] = "Johnny Sales";
$site_config['contact_email']['2']['from_email'] = "sales@onepoundjohnnyclub.com";
$site_config['contact_email']['1']['host'] = "smtp.gmail.com";
$site_config['contact_email']['1']['port'] = 465;
$site_config['contact_email']['1']['smtp'] = "1";
$site_config['contact_email']['1']['username'] = "support@onepoundjohnnyclub.com";
$site_config['contact_email']['1']['password'] = "";
$site_config['contact_email']['1']['from_name'] = "Johnny Support";
$site_config['contact_email']['1']['from_email'] = "support@onepoundjohnnyclub.com";

//Paths
$site_config['product_url'] = $site_config['url']."product/";
$site_config['admin_url'] = $site_config['url']."admin/";
$site_config['img_url'] = $site_config['url']."images/";


//Images

$site_config['prd_img_url'] = $site_config['url']."images/products/";
$site_config['prd_img_path'] = $site_config['path']."images/products/";
$site_config['prd_img_fixed'] = "1";
$site_config['prd_img_fixed_width'] = "378";
$site_config['prd_img_fixed_height'] = "378";
$site_config['prd_img_fixed_type'] = ".jpg";

$site_config['prd_img_feat_url'] = $site_config['url']."images/products/feat/";
$site_config['prd_img_feat_path'] = $site_config['path']."images/products/feat/";
$site_config['prd_img_feat_width'] = "229";
$site_config['prd_img_feat_height'] = "229";
$site_config['prd_img_feat_qty'] = "100";

$site_config['prd_img_icon_url'] = $site_config['url']."images/products/icons/";
$site_config['prd_img_icon_path'] = $site_config['path']."images/products/icons/";
$site_config['prd_img_icon_width'] = "70";
$site_config['prd_img_icon_height'] = "70";
$site_config['prd_img_icon_qty'] = "100";

//Paypal Interface
$site_config['currency'] = "GBP";
$site_config['txn_type_lu']['subscr_signup'] = 1;
$site_config['txn_type_lu']['subscr_cancel'] = 2;
$site_config['txn_type_lu']['subscr_failed'] = 3;
$site_config['txn_type_lu']['subscr_payment'] = 1;
$site_config['txn_type_lu']['subscr_eot'] = 4;
$site_config['txn_type_lu']['subscr_modify'] = 5;
$site_config['txn_type_lu']['recurring_payment_suspended_due_to_max_failed_payment'] = 3;


$site_config['payment_status_lu']['Canceled_Reversal'] = 1;
$site_config['payment_status_lu']['Completed'] = 2;
$site_config['payment_status_lu']['Created'] = 3;
$site_config['payment_status_lu']['Denied'] = 4;
$site_config['payment_status_lu']['Expired'] = 5;
$site_config['payment_status_lu']['Failed'] = 6;
$site_config['payment_status_lu']['Pending'] = 7;
$site_config['payment_status_lu']['Refunded'] = 8;
$site_config['payment_status_lu']['Reversed'] = 9;
$site_config['payment_status_lu']['Processed'] = 10;
$site_config['payment_status_lu']['Voided'] = 11;

$site_config['payment_type_lu']['echeck'] = 1;
$site_config['payment_type_lu']['instant'] = 2;	


date_default_timezone_set('Europe/London');

//Countrys
$site_config['country']['GB'] = "United Kingdom";

//Counties
$site_config['county']['England']['Avon'] = "Avon";
$site_config['county']['England']['Bedfordshire'] = "Bedfordshire";
$site_config['county']['England']['Berkshire'] = "Berkshire";
$site_config['county']['England']['Bristol'] = "Bristol";
$site_config['county']['England']['Buckinghamshire'] = "Buckinghamshire";
$site_config['county']['England']['Cambridgeshire'] = "Cambridgeshire";
$site_config['county']['England']['Cheshire'] = "Cheshire";
$site_config['county']['England']['Cleveland'] = "Cleveland";
$site_config['county']['England']['Cornwall'] = "Cornwall";
$site_config['county']['England']['Cumbria'] = "Cumbria";
$site_config['county']['England']['Derbyshire'] = "Derbyshire";
$site_config['county']['England']['Devon'] = "Devon";
$site_config['county']['England']['Dorset'] = "Dorset";
$site_config['county']['England']['Durham'] = "Durham";
$site_config['county']['England']['East Riding of Yorkshire'] = "East Riding of Yorkshire";
$site_config['county']['England']['East Sussex'] = "East Sussex";
$site_config['county']['England']['Essex'] = "Essex";
$site_config['county']['England']['Gloucestershire'] = "Gloucestershire";
$site_config['county']['England']['Greater Manchester'] = "Greater Manchester";
$site_config['county']['England']['Hampshire'] = "Hampshire";
$site_config['county']['England']['Herefordshire'] = "Herefordshire";
$site_config['county']['England']['Hertfordshire'] = "Hertfordshire";
$site_config['county']['England']['Humberside'] = "Humberside";
$site_config['county']['England']['Isle of Wight'] = "Isle of Wight";
$site_config['county']['England']['Isles of Scilly'] = "Isles of Scilly";
$site_config['county']['England']['Kent'] = "Kent";
$site_config['county']['England']['Lancashire'] = "Lancashire";
$site_config['county']['England']['Leicestershire'] = "Leicestershire";
$site_config['county']['England']['Lincolnshire'] = "Lincolnshire";
$site_config['county']['England']['London'] = "London";
$site_config['county']['England']['Merseyside'] = "Merseyside";
$site_config['county']['England']['Middlesex'] = "Middlesex";
$site_config['county']['England']['Norfolk'] = "Norfolk";
$site_config['county']['England']['North Yorkshire'] = "North Yorkshire";
$site_config['county']['England']['North East Lincolnshire'] = "North East Lincolnshire";
$site_config['county']['England']['Northamptonshire'] = "Northamptonshire";
$site_config['county']['England']['Northumberland'] = "Northumberland";
$site_config['county']['England']['Nottinghamshire'] = "Nottinghamshire";
$site_config['county']['England']['Oxfordshire'] = "Oxfordshire";
$site_config['county']['England']['Rutland'] = "Rutland";
$site_config['county']['England']['Shropshire'] = "Shropshire";
$site_config['county']['England']['Somerset'] = "Somerset";
$site_config['county']['England']['South Yorkshire'] = "South Yorkshire";
$site_config['county']['England']['Staffordshire'] = "Staffordshire";
$site_config['county']['England']['Suffolk'] = "Suffolk";
$site_config['county']['England']['Surrey'] = "Surrey";
$site_config['county']['England']['Tyne and Wear'] = "Tyne and Wear";
$site_config['county']['England']['Warwickshire'] = "Warwickshire";
$site_config['county']['England']['West Midlands'] = "West Midlands";
$site_config['county']['England']['West Sussex'] = "West Sussex";
$site_config['county']['England']['West Yorkshire'] = "West Yorkshire";
$site_config['county']['England']['Wiltshire'] = "Wiltshire";
$site_config['county']['England']['Worcestershire'] = "Worcestershire";
$site_config['county']['Northern Ireland']['Northern Ireland'] = "Northern Ireland";
$site_config['county']['Northern Ireland']['Antrim'] = "Antrim";
$site_config['county']['Northern Ireland']['Armagh'] = "Armagh";
$site_config['county']['Northern Ireland']['Down'] = "Down";
$site_config['county']['Northern Ireland']['Fermanagh'] = "Fermanagh";
$site_config['county']['Northern Ireland']['Londonderry'] = "Londonderry";
$site_config['county']['Northern Ireland']['Tyrone'] = "Tyrone";
$site_config['county']['Scotland']['Aberdeen City'] = "Aberdeen City";
$site_config['county']['Scotland']['Aberdeenshire'] = "Aberdeenshire";
$site_config['county']['Scotland']['Angus'] = "Angus";
$site_config['county']['Scotland']['Argyll and Bute'] = "Argyll and Bute";
$site_config['county']['Scotland']['Banffshire'] = "Banffshire";
$site_config['county']['Scotland']['Borders'] = "Borders";
$site_config['county']['Scotland']['Clackmannan'] = "Clackmannan";
$site_config['county']['Scotland']['Dumfries and Galloway'] = "Dumfries and Galloway";
$site_config['county']['Scotland']['East Ayrshire'] = "East Ayrshire";
$site_config['county']['Scotland']['East Dunbartonshire'] = "East Dunbartonshire";
$site_config['county']['Scotland']['East Lothian'] = "East Lothian";
$site_config['county']['Scotland']['East Renfrewshire'] = "East Renfrewshire";
$site_config['county']['Scotland']['Edinburgh City'] = "Edinburgh City";
$site_config['county']['Scotland']['Falkirk'] = "Falkirk";
$site_config['county']['Scotland']['Fife'] = "Fife";
$site_config['county']['Scotland']['Glasgow'] = "Glasgow";
$site_config['county']['Scotland']['Highland'] = "Highland";
$site_config['county']['Scotland']['Inverclyde'] = "Inverclyde";
$site_config['county']['Scotland']['Midlothian'] = "Midlothian";
$site_config['county']['Scotland']['Moray'] = "Moray";
$site_config['county']['Scotland']['North Ayrshire'] = "North Ayrshire";
$site_config['county']['Scotland']['North Lanarkshire'] = "North Lanarkshire";
$site_config['county']['Scotland']['Orkney'] = "Orkney";
$site_config['county']['Scotland']['Perthshire and Kinross'] = "Perthshire and Kinross";
$site_config['county']['Scotland']['Renfrewshire'] = "Renfrewshire";
$site_config['county']['Scotland']['Roxburghshire'] = "Roxburghshir";
$site_config['county']['Scotland']['Shetland'] = "Shetland";
$site_config['county']['Scotland']['South Ayrshire'] = "South Ayrshire";
$site_config['county']['Scotland']['South Lanarkshire'] = "South Lanarkshire";
$site_config['county']['Scotland']['Stirling'] = "Stirling";
$site_config['county']['Scotland']['West Dunbartonshire'] = "West Dunbartonshire";
$site_config['county']['Scotland']['West Lothian'] = "West Lothian";
$site_config['county']['Scotland']['Western Isles'] = "Western Isles";
$site_config['county']['Unitary Authorities of Wales']['Blaenau Gwent'] = "Blaenau Gwent";
$site_config['county']['Unitary Authorities of Wales']['Bridgend'] = "Bridgend";
$site_config['county']['Unitary Authorities of Wales']['Caerphilly'] = "Caerphilly";
$site_config['county']['Unitary Authorities of Wales']['Cardiff'] = "Cardiff";
$site_config['county']['Unitary Authorities of Wales']['Carmarthenshire'] = "Carmarthenshire";
$site_config['county']['Unitary Authorities of Wales']['Ceredigion'] = "Ceredigion";
$site_config['county']['Unitary Authorities of Wales']['Conwy'] = "Conwy";
$site_config['county']['Unitary Authorities of Wales']['Denbighshire'] = "Denbighshire";
$site_config['county']['Unitary Authorities of Wales']['Flintshire'] = "Flintshire";
$site_config['county']['Unitary Authorities of Wales']['Gwynedd'] = "Gwynedd";
$site_config['county']['Unitary Authorities of Wales']['Isle of Anglesey'] = "Isle of Anglesey";
$site_config['county']['Unitary Authorities of Wales']['Merthyr Tydfil'] = "Merthyr Tydfil";
$site_config['county']['Unitary Authorities of Wales']['Monmouthshire'] = "Monmouthshire";
$site_config['county']['Unitary Authorities of Wales']['Neath Port Talbot'] = "Neath Port Talbot";
$site_config['county']['Unitary Authorities of Wales']['Newport'] = "Newport";
$site_config['county']['Unitary Authorities of Wales']['Pembrokeshire'] = "Pembrokeshire";
$site_config['county']['Unitary Authorities of Wales']['Powys'] = "Powys";
$site_config['county']['Unitary Authorities of Wales']['Rhondda Cynon Taff'] = "Rhondda Cynon Taff";
$site_config['county']['Unitary Authorities of Wales']['Swansea'] = "Swansea";
$site_config['county']['Unitary Authorities of Wales']['Torfaen'] = "Torfaen";
$site_config['county']['Unitary Authorities of Wales']['The Vale of Glamorgan'] = "The Vale of Glamorgan";
$site_config['county']['Unitary Authorities of Wales']['Wrexham'] = "Wrexham";
$site_config['county']['UK Offshore Dependencies']['Channel Islands'] = "Channel Islands";
$site_config['county']['UK Offshore Dependencies']['Isle of Man'] = "Isle of Man";
?>