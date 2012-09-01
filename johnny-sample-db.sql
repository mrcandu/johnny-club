-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2014 at 06:02 AM
-- Server version: 5.5.38-35.2
-- PHP Version: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `johnny_live`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cat_desc` char(20) NOT NULL,
  `cattype_id` smallint(6) NOT NULL,
  `cat_link` char(20) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_desc`, `cattype_id`, `cat_link`) VALUES
(1, 'Safex', 1, 'safex'),
(2, 'Condom', 2, 'condom'),
(3, 'Climax Delay', 3, 'climax-delay'),
(4, 'Sensitive', 3, 'sensitive'),
(5, 'Flavoured', 3, 'flavoured'),
(6, 'Mates', 1, 'mates'),
(7, 'Thin', 3, 'thin'),
(9, 'Latex Free', 3, 'latex-free');

-- --------------------------------------------------------

--
-- Table structure for table `category_type`
--

CREATE TABLE IF NOT EXISTS `category_type` (
  `cattype_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cattype_desc` char(20) NOT NULL,
  PRIMARY KEY (`cattype_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category_type`
--

INSERT INTO `category_type` (`cattype_id`, `cattype_desc`) VALUES
(1, 'Brand'),
(2, 'Product Type'),
(3, 'Condom Style');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_forename` char(35) NOT NULL,
  `cust_surname` char(35) NOT NULL,
  `cust_email` char(128) NOT NULL,
  `cust_tel` char(15) NOT NULL,
  `cust_mobile` char(15) NOT NULL,
  `cust_pass` char(32) NOT NULL,
  `cust_active` char(1) NOT NULL,
  `cust_reset` char(1) NOT NULL,
  `cust_created` datetime NOT NULL,
  `cust_update` datetime NOT NULL,
  `cust_hash` char(32) NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_forename`, `cust_surname`, `cust_email`, `cust_tel`, `cust_mobile`, `cust_pass`, `cust_active`, `cust_reset`, `cust_created`, `cust_update`, `cust_hash`) VALUES
(1, 'Foo', 'Bar', 'foo@bar.com', '', '', '882b3cb40fb1644cd2584f8f05d11f7b', '1', '', '2012-09-08 14:21:08', '2012-09-08 14:50:37', '403732d1e4f4f532f8d1c8415067e3cb');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE IF NOT EXISTS `customer_address` (
  `add_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) NOT NULL,
  `add_name` char(70) NOT NULL,
  `add_aline1` char(35) NOT NULL,
  `add_aline2` char(35) NOT NULL,
  `add_city` char(35) NOT NULL,
  `add_county` char(35) NOT NULL,
  `add_postcode` char(8) NOT NULL,
  `add_country` char(2) NOT NULL,
  `add_active` char(1) NOT NULL,
  `add_default` char(1) NOT NULL,
  PRIMARY KEY (`add_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`add_id`, `cust_id`, `add_name`, `add_aline1`, `add_aline2`, `add_city`, `add_county`, `add_postcode`, `add_country`, `add_active`, `add_default`) VALUES
(1, 1, 'Foo Bar', '9 Foo Bar Lane', '', 'Hampton', 'Middlesex', 'TW1 1SR', 'GB', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_subject` char(50) NOT NULL,
  `email_body` text NOT NULL,
  `email_to_email` char(35) NOT NULL,
  `email_to_name` char(35) NOT NULL,
  `email_from_id` tinyint(4) NOT NULL,
  `email_batch` datetime DEFAULT NULL,
  `email_sent` char(1) DEFAULT NULL,
  PRIMARY KEY (`email_id`),
  KEY `batch_sent` (`email_batch`,`email_sent`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`email_id`, `email_subject`, `email_body`, `email_to_email`, `email_to_name`, `email_from_id`, `email_batch`, `email_sent`) VALUES
(95, 'Thanks for your order!', '<!DOCTYPE html>\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\r\n<meta name="viewport" content="width=device-width, initial-scale=1" />\r\n<title>Thanks for your order!</title>\r\n\r\n<style type="text/css">\r\nbody {margin:0;padding:0;font-family:Courier New,Arial;font-size: 16px;color:#333;font-smooth:always;background-color:#333;}\r\n.wrap{width:600px;margin: 0 auto;background-color:rgb(250,246,246);}\r\n.cont{padding:7px 28px 14px 28px;}\r\n.wood{background-color:#333;background:url(http://files.onepoundjohnnyclub.com/images/wood_floor_small.jpg);}\r\n.wood .cont{padding:9px;}\r\n.wood h1{padding:22px 0 22px 100px;color:#fff;font-size:2.5em;background:url(http://files.onepoundjohnnyclub.com/images/one_pound_johnny_club_small.png);margin:0;background-repeat:no-repeat;background-position:center left;}\r\n.wood img{vertical-align:middle;}\r\n.line{height:7px;background-color:rgb(232,230,230);margin:0 0 0 0;}\r\na {color:#333;text-decoration:underline;}\r\n@media (max-width: 600px) {\r\n.wrap{width:100%;}\r\n}\r\n</style>\r\n</head>\r\n\r\n<body>\r\n	<div class="wrap">\r\n    	<div class="wood">\r\n        	<div class="cont">\r\n            	<h1>Thanks for your order!</h1>\r\n            </div>\r\n        </div>\r\n        <div class="line">\r\n        </div>\r\n    	<div class="cont">\r\n<p>Hi Sean, </p>\r\n<p>Thanks for your order! Welcome to a world of no-hassle safe shaggin''!</p>\r\n<p>Your order details:</p>\r\n<p>3 Pack: Mates Variety Pack, Pay Monthly Subscription - &pound; 1.90 / Month</p>\r\n<p>Delivered to:<br>Sean O''Beirne<br>Sean O''Beirne 1-8 Block N<br>James Watson Hall, White swan road<br>Portsmouth<br>Hampshire<br>PO1 2BF</p>\r\n<p>We''ll get your first batch out pronto as we know you''re looking to get jiggy \r\n  as soon as possible!</p>\r\n<p>You can check the status of your order at anytime by logging into the site.</p>\r\n<p>Safe Shaggin''</p>\r\n<p>Team Johnny<br>\r\n<a href="http://onepoundjohnnyclub.com">onepoundjohnnyclub.com</a></p>\r\n\r\n</div>\r\n        <div class="line">\r\n        </div>\r\n    	<div class="wood">\r\n        	<div class="cont">\r\n            	<img src="http://files.onepoundjohnnyclub.com/images/social.png" alt="Social Links" title="Social Links">\r\n                <a href="https://twitter.com/OPJClub"><img src="http://files.onepoundjohnnyclub.com/images/twitter.png" alt="Twitter" title="Twitter"></a>\r\n                <a href="http://www.facebook.com/OnePoundJohnnyClub"><img src="http://files.onepoundjohnnyclub.com/images/facebook.png" alt="Facebook" title="Facebook"></a>\r\n                <a href="http://www.youtube.com/user/onepoundjohnnyclub"><img src="http://files.onepoundjohnnyclub.com/images/youtube.png" alt="You Tube" title="You Tube"></a>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</body>\r\n</html>', 'Sean.4reds@hotmail.co.uk', 'Sean O''Beirne', 2, '2013-10-05 12:32:01', '2');

-- --------------------------------------------------------

--
-- Table structure for table `lookup`
--

CREATE TABLE IF NOT EXISTS `lookup` (
  `lu_id` tinyint(4) NOT NULL,
  `lu_key` tinyint(4) NOT NULL,
  `lu_desc` char(35) NOT NULL,
  UNIQUE KEY `lu_id` (`lu_id`,`lu_key`),
  UNIQUE KEY `lu_id_lu_key` (`lu_id`,`lu_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lookup`
--

INSERT INTO `lookup` (`lu_id`, `lu_key`, `lu_desc`) VALUES
(1, 1, 'Awaiting Dispatch'),
(1, 2, 'In Dispatch'),
(1, 3, 'Items Dispatched'),
(1, 4, 'Order Cancelled - Refunded'),
(2, 1, 'Canceled Reversal'),
(2, 2, 'Completed'),
(2, 3, 'Created'),
(2, 4, 'Denied'),
(2, 5, 'Expired'),
(2, 6, 'Failed'),
(2, 7, 'Pending'),
(2, 8, 'Refunded'),
(2, 9, 'Reversed'),
(2, 10, 'Processed'),
(2, 11, 'Voided'),
(3, 1, 'Live'),
(3, 2, 'Cancelled'),
(3, 3, 'Failed'),
(3, 5, 'End of Term'),
(3, 6, 'Modified'),
(3, 7, 'Cancellation Pending'),
(4, 1, 'Echeck'),
(4, 2, 'Instant Payment');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_hash` char(32) NOT NULL,
  `subscr_id` char(19) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `order_name` char(127) NOT NULL,
  `order_code` char(4) NOT NULL,
  `order_created` datetime NOT NULL,
  `order_updated` datetime NOT NULL,
  `order_cancelled` datetime NOT NULL,
  `order_status` tinyint(4) NOT NULL,
  `prd_id` smallint(6) NOT NULL,
  `prd_item_id` smallint(6) NOT NULL,
  `prd_price_id` smallint(6) NOT NULL,
  `add_name` char(70) NOT NULL,
  `add_aline1` char(35) NOT NULL,
  `add_aline2` char(35) NOT NULL,
  `add_city` char(35) NOT NULL,
  `add_county` char(35) NOT NULL,
  `add_postcode` char(8) NOT NULL,
  `add_country` char(35) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `del` decimal(9,2) NOT NULL,
  `tot_price` decimal(9,2) NOT NULL,
  `v_code` char(10) NOT NULL,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_hash` (`order_hash`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_hash`, `subscr_id`, `cust_id`, `order_name`, `order_code`, `order_created`, `order_updated`, `order_cancelled`, `order_status`, `prd_id`, `prd_item_id`, `prd_price_id`, `add_name`, `add_aline1`, `add_aline2`, `add_city`, `add_county`, `add_postcode`, `add_country`, `price`, `del`, `tot_price`, `v_code`) VALUES
(1, '67b6bde0f632dc9d1a258cc1a8391383', 'I-EXCT69BV70D5', 1, '3 Pack: Mates King Size, Pay Monthly Subscription', 'KI3', '2012-09-08 14:23:15', '2012-09-08 14:47:45', '2012-09-08 14:47:45', 2, 1, 11, 1, 'Foo Bar', '9 Foor Bar Lane', '', 'Hampton', 'Middlesex', 'TW12 2QR', 'GB', '1.00', '0.90', '1.90', '');
-- --------------------------------------------------------

--
-- Table structure for table `order_batch`
--

CREATE TABLE IF NOT EXISTS `order_batch` (
  `batch_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`batch_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `order_batch`
--

INSERT INTO `order_batch` (`batch_id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `order_stage`
--

CREATE TABLE IF NOT EXISTS `order_stage` (
  `order_hash` char(32) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `order_created` datetime NOT NULL,
  `add_id` int(11) NOT NULL,
  `prd_id` smallint(6) NOT NULL,
  `prd_item_id` smallint(6) NOT NULL,
  `prd_price_id` smallint(6) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `del` decimal(9,2) NOT NULL,
  `tot_price` decimal(9,2) NOT NULL,
  `order_new` char(1) NOT NULL,
  `v_code` char(10) NOT NULL,
  PRIMARY KEY (`order_hash`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_trans`
--

CREATE TABLE IF NOT EXISTS `order_trans` (
  `order_trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `txn_id` char(20) NOT NULL,
  `payment_status` tinyint(4) NOT NULL,
  `payment_type` tinyint(4) NOT NULL,
  `order_trans_created` datetime NOT NULL,
  `order_trans_updated` datetime NOT NULL,
  `dispatch` tinyint(4) NOT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `dispatch_no` mediumint(9) NOT NULL,
  PRIMARY KEY (`order_trans_id`),
  UNIQUE KEY `order_id_and_trans` (`order_id`,`txn_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `order_trans`
--

INSERT INTO `order_trans` (`order_trans_id`, `order_id`, `txn_id`, `payment_status`, `payment_type`, `order_trans_created`, `order_trans_updated`, `dispatch`, `batch_id`, `dispatch_no`) VALUES
(1, 1, '08S60408SE647250P', 8, 2, '2012-09-08 14:23:15', '2012-09-08 22:16:45', 4, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `paypal_error`
--

CREATE TABLE IF NOT EXISTS `paypal_error` (
  `paypal_id` int(11) NOT NULL AUTO_INCREMENT,
  `error_code` tinyint(4) NOT NULL,
  `paypal_report` text NOT NULL,
  PRIMARY KEY (`paypal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `paypal_error`
--

INSERT INTO `paypal_error` (`paypal_id`, `error_code`, `paypal_report`) VALUES
(1, 4, '--------------------------------------------------------------------------------\n[01/16/2013 9:38 AM] - https://www.paypal.com/cgi-bin/webscr (curl)\n--------------------------------------------------------------------------------\nHTTP/1.1 200 OK\r\nX-Frame-Options: SAMEORIGIN\r\nStrict-Transport-Security: max-age=14400\r\nStrict-Transport-Security: max-age=14400\r\nContent-Type: text/html; charset=UTF-8\r\nDate: Wed, 16 Jan 2013 09:38:52 GMT\r\nContent-Length: 8\r\nConnection: close\r\nSet-Cookie: cwrClyrK4LoCV1fydGbAxiNL6iG=idbBKlimejNdomSkUiygeRxB2TE7JtN2hO0J-81Hu6_TJ_RASMTRWRnHNDMkxhLe7OWwloqrrGlG1RFv8zXce4GxfvZOhIpVkfdj0fzB_Or94XJu49dQbJ-WXD1YCMFylDljD0%7cUgIi3lWaCxPs9ANoGN82cxCN33w0C0kAfdjtlznsZ6UlmzGgzqGlk_wEa3VLdxFNYpL1bm%7c_feHNyeT2ZFuHZigtxm1-M4RtcGapTLe6VcpE8ks0gSNKTIUG1VJbRVA4XDROAZziePRm0%7c1358329132; domain=.paypal.com; path=/; Secure; HttpOnly\r\nSet-Cookie: cookie_check=yes; expires=Sat, 14-Jan-2023 09:38:52 GMT; domain=.paypal.com; path=/; Secure; HttpOnly\r\nSet-Cookie: navcmd=_notify-validate; domain=.paypal.com; path=/; Secure; HttpOnly\r\nSet-Cookie: navlns=0.0; expires=Tue, 11-Jan-2033 09:38:52 GMT; domain=.paypal.com; path=/; Secure; HttpOnly\r\nSet-Cookie: Apache=10.73.8.134.1358329131953045; path=/; expires=Fri, 09-Jan-43 09:38:51 GMT\r\nSet-Cookie: X-PP-SILOVER=773171ffd3ead328a3fd20d7a015ffd5863af7429974993dd69e6a4c8f549f5b9e95be448d7252811404caa6a760a5ea3236d2bbad9ba6ca8a0ec9ffc26954df078f10ae93c52237820849dd92ef35d57fa1b8fe3149a236185ec3c0e3cdc85f47e2b4d4a064fd7dae0c886ce35a8d38\r\nSet-Cookie: Apache=10.73.8.49.1358329131941623; path=/; expires=Fri, 09-Jan-43 09:38:51 GMT\r\nSet-Cookie: TSe9a623=5b9d90d3f0148fb14c1fccd85b2a60551ee9b3492f09942450f6752ba0e24589c6da0350634137d16081497ffaa6df6385ae782bba64fcf83ecccf34b4608ba78b09f182318f6e137e695bedb4608ba74c87c1a9; Path=/\r\nSet-Cookie: aksession=1358329432~id=cookieT6YpCgHBulfUVCVcoJryQWwCE/rhkuD1KJwf4Xlkmqqz6/eVOJbdoRwQkvvmlYbAVtTaliJDVmQLmRzo5F56Hlw5KvyeA2rNWL08JG4BtUJoa5yn4nW+joyaVR7NaivyQfH0aDgVi10=; expires=Wed, 16-Jan-2013 09:43:52 GMT; path=/; domain=.paypal.com\r\n\r\nVERIFIED\n--------------------------------------------------------------------------------\npayment_cycle            Monthly\ntxn_type                 recurring_payment_suspended_due_to_max_failed_payment\nlast_name                Maddox\nnext_payment_date        N/A\nresidence_country        GB\ninitial_payment_amount   0.00\ncurrency_code            GBP\ntime_created             10:46:46 Sep 10, 2012 PDT\nverify_sign              Aldyb89Z6jAV6J9yb2M.-iErREd3AhEbdSiNZdf2pVPUn1hnMFr-oMDo\nperiod_type               Regular\npayer_status             verified\ntax                      0.00\npayer_email              maddoxhxcrocks@hotmail.co.uk\nfirst_name               Tiffany\nreceiver_email           sales@onepoundjohnnyclub.com\npayer_id                 JJ4DUD7CZAVKE\nproduct_type             1\nshipping                 0.00\namount_per_cycle         1.90\nprofile_status           Suspended\ncustom                   774b23a8c161d55d0251ef3386c064fa\ncharset                  windows-1252\nnotify_version           3.7\namount                   1.90\noutstanding_balance      1.90\nrecurring_payment_id     I-ACNWSBRTFBJF\nproduct_name             3 Pack: Mates Variety Pack, Pay Monthly Subscription\nipn_track_id             5390c0c27fd5b\n\n\n');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_log`
--

CREATE TABLE IF NOT EXISTS `paypal_log` (
  `paypal_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_hash` char(32) NOT NULL,
  `paypal_report` text NOT NULL,
  PRIMARY KEY (`paypal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=271 ;

--
-- Dumping data for table `paypal_log`
--

INSERT INTO `paypal_log` (`paypal_id`, `order_hash`, `paypal_report`) VALUES
(1, '67b6bde0f632dc9d1a258cc1a8391383', 'business: sales@onepoundjohnnyclub.com\r\ncharset: UTF-8\r\ncharset_original: windows-1252\r\ncustom: 67b6bde0f632dc9d1a258cc1a8391383\r\nfirst_name: Matthew\r\nitem_name: 3 Pack: Mates King Size, Pay Monthly Subscription\r\nitem_number: KI3\r\nlast_name: Cohen\r\nmc_currency: GBP\r\nmc_fee: 0.15\r\nmc_gross: 1.90\r\nnum_offers: 0\r\npayer_email: mrcandu@tinyworld.co.uk\r\npayer_id: BSHMKLKG6GH28\r\npayer_status: verified\r\npayment_date: 06:22:35 Sep 08, 2012 PDT\r\npayment_fee: \r\npayment_gross: \r\npayment_status: Completed\r\npayment_type: instant\r\npos_transaction_type: \r\nprotection_eligibility: Ineligible\r\nreceipt_reference_number: \r\nreceiver_email: sales@onepoundjohnnyclub.com\r\nreceiver_id: ZHE7H8BW295TU\r\nresidence_country: GB\r\nstore_id: \r\nsubscr_id: I-EXCT69BV70D5\r\nterminal_id: \r\ntransaction_subject: 3 Pack: Mates King Size, Pay Monthly Subscription\r\ntxn_id: 08S60408SE647250P\r\ntxn_type: subscr_payment\r\n');
-- --------------------------------------------------------

--
-- Table structure for table `price_type`
--

CREATE TABLE IF NOT EXISTS `price_type` (
  `price_type_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `price_type_code` char(3) NOT NULL,
  `price_type_name` char(35) NOT NULL,
  `price_type_months` char(2) NOT NULL,
  `price_type_recur` char(1) NOT NULL,
  `price_type_handling` char(1) NOT NULL,
  `price_type_delivery` char(1) NOT NULL,
  `price_type_desc` char(50) NOT NULL,
  PRIMARY KEY (`price_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `price_type`
--

INSERT INTO `price_type` (`price_type_id`, `price_type_code`, `price_type_name`, `price_type_months`, `price_type_recur`, `price_type_handling`, `price_type_delivery`, `price_type_desc`) VALUES
(13, '3', '3 Pack - Monthly Sub', '0', '1', '', '', '3 Pack of Condoms - Pay Monthly Subscription'),
(11, '6', '6 Pack - Monthly Sub', '0', '1', '', '', '6 Pack of Condoms - Pay Monthly Subscription'),
(12, '12', '12 Pack - Monthly Sub', '0', '1', '', '', '12 Pack of Condoms - Pay Monthly Subscription'),
(16, '', 'Delivery', '0', '', '', '1', 'Delivery'),
(17, '', 'Monthly Subscription', '0', '', '', '', 'Pay Monthly Subscription');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `prd_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `prd_code` char(4) NOT NULL,
  `prd_package` char(1) NOT NULL,
  `prd_name` char(30) NOT NULL,
  `prd_site_name` char(30) NOT NULL,
  `prd_link` char(30) NOT NULL,
  `prd_live` char(1) NOT NULL,
  `prd_feature` char(1) NOT NULL,
  PRIMARY KEY (`prd_id`),
  UNIQUE KEY `prd_link` (`prd_link`),
  KEY `pack_live_feat` (`prd_package`,`prd_live`,`prd_feature`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prd_id`, `prd_code`, `prd_package`, `prd_name`, `prd_site_name`, `prd_link`, `prd_live`, `prd_feature`) VALUES
(1, '', '1', '3 Pack', '', '3-pack', '1', '1'),
(2, '', '1', '6 Pack', '', '6-pack', '1', '2'),
(3, '', '1', '12 Pack', '', '12-pack', '1', '3'),
(4, '', '1', 'SKYN', '', 'skyn', '1', '4'),
(5, 'IN3', '0', 'Mates Intensity 3x', 'Mates Intensity', 'mates-intensity-3x', '1', ''),
(6, 'SK', '0', 'Mates SKYN', 'Mates SKYN', 'mates-skyn', '1', ''),
(7, 'NA3', '0', 'Mates Natural 3x', 'Mates Natural', 'mates-natural-3x', '1', ''),
(8, 'OR3', '0', 'Mates Original 3x', 'Mates Original', 'mates-original-3x', '1', ''),
(9, 'FL3', '0', 'Mates Flavour 3x', 'Mates Flavour', 'mates-flavour-3x', '1', ''),
(10, 'TH3', '0', 'Mates Ultra Thin 3x', 'Mates Ultra Thin', 'mates-ultra-thin-3x', '', ''),
(11, 'KI3', '0', 'Mates King Size 3x', 'Mates King Size', 'mates-king-size-3x', '1', ''),
(12, 'VA3', '0', 'Mates Variety Pack 3x', 'Mates Variety Pack', 'mates-variety-pack-3x', '1', ''),
(14, 'FL12', '0', 'Mates Flavour 12x', 'Mates Flavour', 'mates-flavour-12x', '1', ''),
(13, 'FL6', '0', 'Mates Flavour 6x', 'Mates Flavour', 'mates-flavour-6x', '1', ''),
(15, 'IN6', '0', 'Mates Intensity 6x', 'Mates Intensity', 'mates-intensity-6x', '1', ''),
(16, 'IN12', '0', 'Mates Intensity 12x', 'Mates Intensity', 'mates-intensity-12x', '1', ''),
(17, 'KI6', '0', 'Mates King Size 6x', 'Mates King Size', 'mates-king-size-6x', '1', ''),
(18, 'KI12', '0', 'Mates King Size 12x', 'Mates King Size', 'mates-king-size-12x', '1', ''),
(19, 'NA6', '0', 'Mates Natural 6x', 'Mates Natural', 'mates-natural-6x', '1', ''),
(20, 'NA12', '0', 'Mates Natural 12x', 'Mates Natural', 'mates-natural-12x', '1', ''),
(21, 'OR6', '0', 'Mates Original 6x', 'Mates Original', 'mates-original-6x', '1', ''),
(22, 'OR12', '0', 'Mates Original 12x', 'Mates Original', 'mates-original-12x', '1', ''),
(23, 'TH6', '0', 'Mates Ultra Thin 6x', 'Mates Ultra Thin', 'mates-ultra-thin-6x', '', ''),
(24, 'TH12', '0', 'Mates Ultra Thin 12x', 'Mates Ultra Thin', 'mates-ultra-thin-12x', '1', ''),
(25, 'VA6', '0', 'Mates Variety Pack 6x', 'Mates Variety Pack', 'mates-variety-pack-6x', '1', ''),
(26, 'VA1', '0', 'Mates Variety Pack 12x', 'Mates Variety Pack', 'mates-variety-pack-12x', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

CREATE TABLE IF NOT EXISTS `product_cat` (
  `prdcat_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `prd_id` smallint(6) NOT NULL,
  `cat_id` smallint(6) NOT NULL,
  PRIMARY KEY (`prdcat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `product_cat`
--

INSERT INTO `product_cat` (`prdcat_id`, `prd_id`, `cat_id`) VALUES
(1, 5, 6),
(2, 5, 4),
(3, 5, 2),
(4, 6, 6),
(5, 6, 2),
(6, 6, 7),
(7, 7, 6),
(8, 8, 6),
(9, 9, 6),
(10, 10, 6),
(11, 10, 7),
(12, 11, 6),
(13, 12, 6),
(14, 13, 6),
(15, 13, 5),
(16, 14, 5),
(33, 14, 6),
(18, 15, 6),
(19, 16, 6),
(20, 17, 6),
(21, 18, 6),
(22, 19, 6),
(23, 20, 6),
(24, 21, 6),
(25, 22, 6),
(26, 23, 6),
(27, 23, 7),
(28, 24, 6),
(29, 24, 7),
(30, 25, 6),
(31, 26, 6),
(32, 14, 2),
(34, 9, 5),
(35, 9, 2),
(36, 13, 2),
(37, 16, 4),
(38, 16, 2),
(39, 15, 4),
(40, 15, 2),
(41, 18, 2),
(42, 11, 2),
(43, 17, 2),
(44, 20, 2),
(45, 7, 2),
(46, 19, 2),
(47, 22, 2),
(48, 8, 2),
(49, 21, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_desc`
--

CREATE TABLE IF NOT EXISTS `product_desc` (
  `prd_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `prd_desc` text NOT NULL,
  `prd_desc_html` text NOT NULL,
  PRIMARY KEY (`prd_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `product_desc`
--

INSERT INTO `product_desc` (`prd_id`, `prd_desc`, `prd_desc_html`) VALUES
(1, 'For the occasional shagger.\r\n\r\nMonthly subscription delivering 3 johnnies discreetly to your door. \r\n\r\nChoose your type of johnny below or go for the variety pack for that bedroom drawer surprise! \r\n\r\nÂ£1 for the johnnies, Â£0.90 to get them to you. That''s Â£1.90 per month.', '<p>For the occasional shagger.</p>\n\n<p>Monthly subscription delivering 3 johnnies discreetly to your door. </p>\n\n<p>Choose your type of johnny below or go for the variety pack for that bedroom drawer surprise! </p>\n\n<p>Â£1 for the johnnies, Â£0.90 to get them to you. That''s Â£1.90 per month.</p>'),
(2, 'For the busy lover.\r\n\r\nMonthly subscription delivering 6 condoms discreetly to your door.\r\n\r\nChoose your type of johnny below or go for the variety pack for that bedroom drawer surprise!\r\n\r\nÂ£3.50 per month. Postage & Packaging included.', '<p>For the busy lover.</p>\n\n<p>Monthly subscription delivering 6 condoms discreetly to your door.</p>\n\n<p>Choose your type of johnny below or go for the variety pack for that bedroom drawer surprise!</p>\n\n<p>Â£3.50 per month. Postage &amp; Packaging included.</p>'),
(3, 'For the bedroom Olympian.\r\n\r\nMonthly subscription delivering 12 condoms discreetly to your door.\r\n\r\nChoose your type of johnny below or go for the variety pack for that bedroom drawer surprise!\r\n\r\nOnly Â£6 per month. Postage & Packaging included.', '<p>For the bedroom Olympian.</p>\n\n<p>Monthly subscription delivering 12 condoms discreetly to your door.</p>\n\n<p>Choose your type of johnny below or go for the variety pack for that bedroom drawer surprise!</p>\n\n<p>Only Â£6 per month. Postage &amp; Packaging included.</p>'),
(4, 'The Marvin Gaye of condoms.\r\n\r\nMade from Sensoprene, this non-latex johnny combines extra sensation with premium strength. The closest thing to wearing nothing.\r\n\r\nChoose below whether you want 6 or 12 delivered discreetly to your door.\r\n\r\nThis condom will change everything.', '<p>The Marvin Gaye of condoms.</p>\n\n<p>Made from Sensoprene, this non-latex johnny combines extra sensation with premium strength. The closest thing to wearing nothing.</p>\n\n<p>Choose below whether you want 6 or 12 delivered discreetly to your door.</p>\n\n<p>This condom will change everything.</p>'),
(5, 'Maximum stimulation for both partners\r\n\r\nFeatures:\r\n \r\n- Raised ribs AND studs \r\n- Shaped condom \r\n- Non-spermicidally lubricated', '<p>Maximum stimulation for both partners</p>\n\n<p>Features:<br />\n <br />\n- Raised ribs AND studs <br />\n- Shaped condom <br />\n- Non-spermicidally lubricated</p>'),
(6, 'Experience the pleasure of a condom that: \r\n\r\n-   Is non-latex\r\n-   Is clinically proven to enhance sensation\r\n-   Includes a long lasting, ultra smooth lubricant\r\n-   Combines the strength of premium latex with the sensitivity of the real thing', '<p>Experience the pleasure of a condom that: </p>\n\n<p>- Is non-latex<br />\n- Is clinically proven to enhance sensation<br />\n- Includes a long lasting, ultra smooth lubricant<br />\n- Combines the strength of premium latex with the sensitivity of the real thing</p>'),
(7, 'The ultimate for a perfectly natural feeling.\r\n\r\nFeatures:\r\n\r\n-   Natural Feeling\r\n-   Extra Comfort\r\n-   Non-Spermicidally Lubricated\r\n-   Easy-Fit', '<p>The ultimate for a perfectly natural feeling.</p>\n\n<p>Features:</p>\n\n<p>- Natural Feeling<br />\n- Extra Comfort<br />\n- Non-Spermicidally Lubricated<br />\n- Easy-Fit</p>'),
(8, 'The original Mates condom.\r\n\r\nFeatures:\r\n\r\n-   Natural Feeling\r\n-   Extra Comfort & Security\r\n-   Non-Spermicidally Lubricated\r\n-   Easy-Fit', '<p>The original Mates condom.</p>\n\n<p>Features:</p>\n\n<p>- Natural Feeling<br />\n- Extra Comfort &amp; Security<br />\n- Non-Spermicidally Lubricated<br />\n- Easy-Fit</p>'),
(9, 'Add a bit of flavour into the bedroom. We send you a selection from Strawberry, Banana, Chocolate, Vanilla, Mint & Blueberry. \r\n\r\nFeatures:\r\n\r\n-   Natural Feeling\r\n-   Non-Spermicidally Lubricated\r\n-   Easy-Fit', '<p>Add a bit of flavour into the bedroom. We send you a selection from Strawberry, Banana, Chocolate, Vanilla, Mint &amp; Blueberry. </p>\n\n<p>Features:</p>\n\n<p>- Natural Feeling<br />\n- Non-Spermicidally Lubricated<br />\n- Easy-Fit</p>'),
(10, 'So thin it''s like wearing nothing at all!\r\n\r\nFeatures:\r\n\r\n-   Maximum Sensitivity\r\n-   Natural Feeling\r\n-   Non-Spermicidally Lubricated\r\n-   Easy-Fit', '<p>So thin it''s like wearing nothing at all!</p>\n\n<p>Features:</p>\n\n<p>- Maximum Sensitivity<br />\n- Natural Feeling<br />\n- Non-Spermicidally Lubricated<br />\n- Easy-Fit</p>'),
(11, 'For the larger gent.\r\n\r\nFeatures:\r\n\r\n-   Natural Feeling\r\n-   Extra Comfort for larger sizes\r\n-   Non-Spermicidally Lubricated\r\n-   Easy-Fit', '<p>For the larger gent.</p>\n\n<p>Features:</p>\n\n<p>- Natural Feeling<br />\n- Extra Comfort for larger sizes<br />\n- Non-Spermicidally Lubricated<br />\n- Easy-Fit</p>'),
(12, 'Mates Variety condoms offer a great selection from our best selling condoms.*\r\n\r\nFeatures:\r\n\r\n-   Assorted Mates Condoms\r\n-   Non-Spermicidally lubricated\r\n\r\n*Not including Mates Skyn Range.', '<p>Mates Variety condoms offer a great selection from our best selling condoms.*</p>\n\n<p>Features:</p>\n\n<p>- Assorted Mates Condoms<br />\n- Non-Spermicidally lubricated</p>\n\n<p>*Not including Mates Skyn Range.</p>'),
(14, 'Add a bit of flavour into the bedroom. We send you a selection from Strawberry, Banana, Chocolate, Vanilla, Mint & Blueberry. \r\n\r\nFeatures:\r\n\r\n-   Natural Feeling\r\n-   Non-Spermicidally Lubricated\r\n-   Easy-Fit', '<p>Add a bit of flavour into the bedroom. We send you a selection from Strawberry, Banana, Chocolate, Vanilla, Mint &amp; Blueberry. </p>\n\n<p>Features:</p>\n\n<p>- Natural Feeling<br />\n- Non-Spermicidally Lubricated<br />\n- Easy-Fit</p>'),
(13, 'Add a bit of flavour into the bedroom. We send you a selection from Strawberry, Banana, Chocolate, Vanilla, Mint & Blueberry. \r\n\r\nFeatures:\r\n\r\n-   Natural Feeling\r\n-   Non-Spermicidally Lubricated\r\n-   Easy-Fit', '<p>Add a bit of flavour into the bedroom. We send you a selection from Strawberry, Banana, Chocolate, Vanilla, Mint &amp; Blueberry. </p>\n\n<p>Features:</p>\n\n<p>- Natural Feeling<br />\n- Non-Spermicidally Lubricated<br />\n- Easy-Fit</p>'),
(15, 'Maximum stimulation for both partners\r\n\r\nFeatures:\r\n \r\n- Raised ribs AND studs \r\n- Shaped condom \r\n- Non-spermicidally lubricated', '<p>Maximum stimulation for both partners</p>\n\n<p>Features:<br />\n <br />\n- Raised ribs AND studs <br />\n- Shaped condom <br />\n- Non-spermicidally lubricated</p>'),
(16, 'Maximum stimulation for both partners\r\n\r\nFeatures:\r\n \r\n-   Raised ribs AND studs \r\n-   Shaped condom \r\n-   Non-spermicidally lubricated', '<p>Maximum stimulation for both partners</p>\n\n<p>Features:<br />\n <br />\n- Raised ribs AND studs <br />\n- Shaped condom <br />\n- Non-spermicidally lubricated</p>'),
(17, 'For the larger gent.\r\n\r\nFeatures:\r\n\r\n-	Natural Feeling\r\n-	Extra Comfort for larger sizes\r\n-	Non-Spermicidally Lubricated\r\n-	Easy-Fit', '<p>For the larger gent.</p>\n\n<p>Features:</p>\n\n<p>-	Natural Feeling<br />\n-	Extra Comfort for larger sizes<br />\n-	Non-Spermicidally Lubricated<br />\n-	Easy-Fit</p>'),
(18, 'For the larger gent.\r\n\r\nFeatures:\r\n\r\n-   Natural Feeling\r\n-   Extra Comfort for larger sizes\r\n-   Non-Spermicidally Lubricated\r\n-   Easy-Fit', '<p>For the larger gent.</p>\n\n<p>Features:</p>\n\n<p>- Natural Feeling<br />\n- Extra Comfort for larger sizes<br />\n- Non-Spermicidally Lubricated<br />\n- Easy-Fit</p>'),
(19, 'The ultimate for a perfectly natural feeling.\r\n\r\nFeatures:\r\n\r\n-   Natural Feeling\r\n-   Extra Comfort\r\n-   Non-Spermicidally Lubricated\r\n-   Easy-Fit', '<p>The ultimate for a perfectly natural feeling.</p>\n\n<p>Features:</p>\n\n<p>- Natural Feeling<br />\n- Extra Comfort<br />\n- Non-Spermicidally Lubricated<br />\n- Easy-Fit</p>'),
(20, 'The ultimate for a perfectly natural feeling.\r\n\r\nFeatures:\r\n\r\n-   Natural Feeling\r\n-   Extra Comfort\r\n-   Non-Spermicidally Lubricated\r\n-   Easy-Fit', '<p>The ultimate for a perfectly natural feeling.</p>\n\n<p>Features:</p>\n\n<p>- Natural Feeling<br />\n- Extra Comfort<br />\n- Non-Spermicidally Lubricated<br />\n- Easy-Fit</p>'),
(21, 'The original Mates condom.\r\n\r\nFeatures:\r\n\r\n-   Natural Feeling\r\n-   Extra Comfort & Security\r\n-   Non-Spermicidally Lubricated\r\n-   Easy-Fit', '<p>The original Mates condom.</p>\n\n<p>Features:</p>\n\n<p>- Natural Feeling<br />\n- Extra Comfort &amp; Security<br />\n- Non-Spermicidally Lubricated<br />\n- Easy-Fit</p>'),
(22, 'The original Mates condom.\r\n\r\nFeatures:\r\n\r\n-   Natural Feeling\r\n-   Extra Comfort & Security\r\n-   Non-Spermicidally Lubricated\r\n-   Easy-Fit', '<p>The original Mates condom.</p>\n\n<p>Features:</p>\n\n<p>- Natural Feeling<br />\n- Extra Comfort &amp; Security<br />\n- Non-Spermicidally Lubricated<br />\n- Easy-Fit</p>'),
(23, 'So thin it''s like wearing nothing at all!\r\n\r\nFeatures:\r\n\r\n-   Maximum Sensitivity\r\n-   Natural Feeling\r\n-   Non-Spermicidally Lubricated\r\n-   Easy-Fit', '<p>So thin it''s like wearing nothing at all!</p>\n\n<p>Features:</p>\n\n<p>- Maximum Sensitivity<br />\n- Natural Feeling<br />\n- Non-Spermicidally Lubricated<br />\n- Easy-Fit</p>'),
(24, 'So thin it''s like wearing nothing at all!\r\n\r\nFeatures:\r\n\r\n-   Maximum Sensitivity\r\n-   Natural Feeling\r\n-   Non-Spermicidally Lubricated\r\n-   Easy-Fit', '<p>So thin it''s like wearing nothing at all!</p>\n\n<p>Features:</p>\n\n<p>- Maximum Sensitivity<br />\n- Natural Feeling<br />\n- Non-Spermicidally Lubricated<br />\n- Easy-Fit</p>'),
(25, 'Mates Variety condoms offer a great selection from our best selling condoms.*\r\n\r\nFeatures:\r\n\r\n-   Assorted Mates Condoms\r\n-   Non-Spermicidally lubricated\r\n\r\n*Not including Mates Skyn Range.', '<p>Mates Variety condoms offer a great selection from our best selling condoms.*</p>\n\n<p>Features:</p>\n\n<p>- Assorted Mates Condoms<br />\n- Non-Spermicidally lubricated</p>\n\n<p>*Not including Mates Skyn Range.</p>'),
(26, 'Mates Variety condoms offer a great selection from our best selling condoms.*\r\n\r\nFeatures:\r\n\r\n-   Assorted Mates Condoms\r\n-   Non-Spermicidally lubricated\r\n\r\n*Not including Mates Skyn Range.', '<p>Mates Variety condoms offer a great selection from our best selling condoms.*</p>\n\n<p>Features:</p>\n\n<p>- Assorted Mates Condoms<br />\n- Non-Spermicidally lubricated</p>\n\n<p>*Not including Mates Skyn Range.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE IF NOT EXISTS `product_image` (
  `img_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `prd_id` smallint(6) NOT NULL,
  `img_main` char(1) NOT NULL,
  `img_width` smallint(6) NOT NULL,
  `img_height` smallint(6) NOT NULL,
  `img_type` char(4) NOT NULL,
  `img_name` char(35) NOT NULL,
  `img_link` char(35) NOT NULL,
  `img_size` mediumint(9) NOT NULL,
  `img_full` char(45) NOT NULL,
  PRIMARY KEY (`img_id`),
  KEY `prd_id` (`prd_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`img_id`, `prd_id`, `img_main`, `img_width`, `img_height`, `img_type`, `img_name`, `img_link`, `img_size`, `img_full`) VALUES
(1, 14, '1', 378, 378, '.jpg', 'Mates Flavours 12 Pack', 'mates-flavour-12x_1', 41772, 'mates-flavour-12x_1.jpg'),
(2, 9, '1', 378, 378, '.jpg', 'Mates Flavours 3 Pack', 'mates-flavour-3x_2', 50817, 'mates-flavour-3x_2.jpg'),
(3, 13, '1', 378, 378, '.jpg', 'Mates Flavours 6 Pack', 'mates-flavour-6x_3', 43268, 'mates-flavour-6x_3.jpg'),
(4, 16, '1', 378, 378, '.jpg', 'Mates Intensity 12 Pack', 'mates-intensity-12x_4', 39789, 'mates-intensity-12x_4.jpg'),
(5, 5, '1', 378, 378, '.jpg', 'Mates Intensity 3 Pack', 'mates-intensity-3x_5', 52616, 'mates-intensity-3x_5.jpg'),
(6, 15, '1', 378, 378, '.jpg', 'Mates Intensity 6 Pack', 'mates-intensity-6x_6', 42610, 'mates-intensity-6x_6.jpg'),
(29, 11, '1', 378, 378, '.jpg', 'Mates King Size 3 Pack', 'mates-king-size-3x_29', 32698, 'mates-king-size-3x_29.jpg'),
(30, 17, '1', 378, 378, '.jpg', 'Mates King Size 6 Pack', 'mates-king-size-6x_30', 32698, 'mates-king-size-6x_30.jpg'),
(10, 20, '1', 378, 378, '.jpg', 'Mates Natural 12 Pack', 'mates-natural-12x_10', 49092, 'mates-natural-12x_10.jpg'),
(11, 7, '1', 378, 378, '.jpg', 'Mates Natural 3 Pack', 'mates-natural-3x_11', 61530, 'mates-natural-3x_11.jpg'),
(12, 19, '1', 378, 378, '.jpg', 'Mates Natural 6 Pack', 'mates-natural-6x_12', 49421, 'mates-natural-6x_12.jpg'),
(13, 22, '1', 378, 378, '.jpg', 'Mates Original 12 Pack', 'mates-original-12x_13', 40226, 'mates-original-12x_13.jpg'),
(14, 8, '1', 378, 378, '.jpg', 'Mates Original 3 Pack', 'mates-original-3x_14', 51453, 'mates-original-3x_14.jpg'),
(15, 21, '1', 378, 378, '.jpg', 'Mates Original 6 Pack', 'mates-original-6x_15', 41911, 'mates-original-6x_15.jpg'),
(16, 6, '1', 378, 378, '.jpg', 'Mates SKYN 6 Pack', 'mates-skyn_16', 50498, 'mates-skyn_16.jpg'),
(17, 6, '', 378, 378, '.jpg', 'Mates SKYN 12 Pack', 'mates-skyn_17', 50189, 'mates-skyn_17.jpg'),
(18, 24, '1', 378, 378, '.jpg', 'Mates Ultra Thin 12 Pack', 'mates-ultra-thin-12x_18', 41458, 'mates-ultra-thin-12x_18.jpg'),
(19, 10, '1', 378, 378, '.jpg', 'Mates Ultra Thin 3 Pack', 'mates-ultra-thin-3x_19', 51839, 'mates-ultra-thin-3x_19.jpg'),
(20, 23, '1', 378, 378, '.jpg', 'Mates Ultra Thin 6 Pack', 'mates-ultra-thin-6x_20', 43763, 'mates-ultra-thin-6x_20.jpg'),
(21, 26, '1', 378, 378, '.jpg', 'Mates Variety 12 Pack', 'mates-variety-pack-12x_21', 42834, 'mates-variety-pack-12x_21.jpg'),
(22, 12, '1', 378, 378, '.jpg', 'Mates Variety 3 Pack', 'mates-variety-pack-3x_22', 52748, 'mates-variety-pack-3x_22.jpg'),
(23, 25, '1', 378, 378, '.jpg', 'Mates Variety 6 Pack', 'mates-variety-pack-6x_23', 45004, 'mates-variety-pack-6x_23.jpg'),
(24, 1, '1', 378, 378, '.jpg', '3 Pack Condoms', '3-pack_24', 52748, '3-pack_24.jpg'),
(25, 2, '1', 378, 378, '.jpg', '6 Pack Condoms', '6-pack_25', 45004, '6-pack_25.jpg'),
(26, 3, '1', 378, 378, '.jpg', '12 Pack Condoms', '12-pack_26', 42834, '12-pack_26.jpg'),
(27, 4, '1', 378, 378, '.jpg', 'SKYN Condoms', 'skyn_27', 50498, 'skyn_27.jpg'),
(28, 18, '1', 378, 378, '.jpg', 'Mates King Size 12 Pack', 'mates-king-size-12x_28', 26842, 'mates-king-size-12x_28.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_packs`
--

CREATE TABLE IF NOT EXISTS `product_packs` (
  `prd_pack_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `prd_pack_main` char(1) NOT NULL,
  `pack_id` smallint(6) NOT NULL,
  `prd_id` smallint(6) NOT NULL,
  PRIMARY KEY (`prd_pack_id`),
  UNIQUE KEY `pack_prd_id` (`pack_id`,`prd_id`),
  KEY `pack_id` (`pack_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `product_packs`
--

INSERT INTO `product_packs` (`prd_pack_id`, `prd_pack_main`, `pack_id`, `prd_id`) VALUES
(1, '', 1, 5),
(35, '', 2, 21),
(40, '', 3, 24),
(4, '1', 4, 6),
(5, '', 1, 9),
(29, '', 3, 18),
(28, '', 2, 17),
(27, '', 1, 11),
(26, '', 3, 16),
(25, '', 2, 15),
(41, '1', 3, 26),
(39, '', 3, 22),
(38, '', 3, 20),
(37, '1', 2, 25),
(36, '', 2, 23),
(23, '', 2, 13),
(34, '', 2, 19),
(33, '1', 1, 12),
(32, '', 1, 10),
(31, '', 1, 8),
(30, '', 1, 7),
(24, '', 3, 14);

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE IF NOT EXISTS `product_price` (
  `prd_price_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `prd_id` smallint(6) NOT NULL,
  `price_type_id` smallint(6) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `price_order` tinyint(4) NOT NULL,
  `price_code` char(4) NOT NULL,
  PRIMARY KEY (`prd_price_id`),
  KEY `prd_id` (`prd_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`prd_price_id`, `prd_id`, `price_type_id`, `price`, `price_order`, `price_code`) VALUES
(1, 1, 17, '1.00', 1, ''),
(2, 1, 16, '0.90', 0, ''),
(3, 3, 17, '6.00', 1, ''),
(4, 2, 17, '3.50', 1, ''),
(5, 4, 11, '5.00', 1, '6'),
(6, 4, 12, '8.00', 2, '12');

-- --------------------------------------------------------

--
-- Table structure for table `sys_log`
--

CREATE TABLE IF NOT EXISTS `sys_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_datetime` datetime NOT NULL,
  `log_type` varchar(30) NOT NULL,
  `log_desc` varchar(150) NOT NULL,
  `log_key` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sys_user`
--

CREATE TABLE IF NOT EXISTS `sys_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_forename` char(35) NOT NULL,
  `user_surname` char(35) NOT NULL,
  `user_email` char(128) NOT NULL,
  `user_pass` char(32) NOT NULL,
  `user_temppass` char(9) NOT NULL,
  `user_usetemp` char(1) NOT NULL,
  `user_new` char(1) NOT NULL,
  `user_level` int(11) NOT NULL,
  `user_active` char(1) NOT NULL,
  `user_created` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sys_user`
--

INSERT INTO `sys_user` (`user_id`, `user_forename`, `user_surname`, `user_email`, `user_pass`, `user_temppass`, `user_usetemp`, `user_new`, `user_level`, `user_active`, `user_created`) VALUES
(1, 'Matthew', 'Cohen', 'mccandu@gmail.com', '882b3cb40fb1644cd2584f8f05d11f7b', '', '', '', 0, '1', '2012-08-04 17:11:50'),
(5, 'Chris', 'Brownridge', 'chris@onepoundjohnnyclub.com', '790dfb3d4da0766099308b8c918cd0a5', '', '', '', 0, '1', '2012-08-27 21:10:46'),
(6, 'Raj', 'Shanker', 'raj@onepoundjohnnyclub.com', '06168977556c98c39c7d190bc17cd10d', '', '', '', 0, '1', '2012-08-27 21:11:18'),
(7, 'Nick', 'Brownridge', 'njbrownridge@gmail.com', '4b42bf11fa89345c8abd951f31dd32aa', '', '', '', 0, '1', '2012-09-09 22:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `tweet`
--

CREATE TABLE IF NOT EXISTS `tweet` (
  `tweet` varchar(400) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tweet`
--

INSERT INTO `tweet` (`tweet`) VALUES
('RAIN...AGAIN?! Just make sure you use a brolly. <a href="http://t.co/vVsyDtu1hC">ow.ly/lVLCJ</a> <a href="http://search.twitter.com/search?q=safesex">#safesex</a> <a href="http://search.twitter.com/search?q=condoms">#condoms</a> <a href="http://search.twitter.com/search?q=rain">#rain</a>');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE IF NOT EXISTS `voucher` (
  `v_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `v_code` char(10) CHARACTER SET utf8 NOT NULL,
  `v_desc` varchar(100) CHARACTER SET utf8 NOT NULL,
  `v_live` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`v_id`),
  UNIQUE KEY `v_code` (`v_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`v_id`, `v_code`, `v_desc`, `v_live`) VALUES
(3, 'condom1', 'Double Johnnies (We send you double the condoms every other month extra free! New customers only)', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
