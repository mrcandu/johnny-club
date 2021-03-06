<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Thanks for your order!</title>

<style type="text/css">
body {margin:0;padding:0;font-family:Courier New,Arial;font-size: 16px;color:#333;font-smooth:always;background-color:#333;}
.wrap{width:600px;margin: 0 auto;background-color:rgb(250,246,246);}
.cont{padding:7px 28px 14px 28px;}
.wood{background-color:#333;background:url(http://files.onepoundjohnnyclub.com/images/wood_floor_small.jpg);}
.wood .cont{padding:9px;}
.wood h1{padding:22px 0 22px 100px;color:#fff;font-size:2.5em;background:url(http://files.onepoundjohnnyclub.com/images/one_pound_johnny_club_small.png);margin:0;background-repeat:no-repeat;background-position:center left;}
.wood img{vertical-align:middle;}
.line{height:7px;background-color:rgb(232,230,230);margin:0 0 0 0;}
a {color:#333;text-decoration:underline;}
@media (max-width: 600px) {
.wrap{width:100%;}
}
</style>
</head>

<body>
	<div class="wrap">
    	<div class="wood">
        	<div class="cont">
            	<h1>Thanks for your order!</h1>
            </div>
        </div>
        <div class="line">
        </div>
    	<div class="cont">
<p>Hi <?php print $this->cust_forename; ?>, </p>
<p>Thanks for your order! Welcome to a world of no-hassle safe shaggin'!</p>
<p>Your order details:</p>
<p><?php print $this->order_name; ?></p>
<p>Delivered to:<br><?php print $this->delivery; ?></p>
<p>We'll get your first batch out pronto as we know you're looking to get jiggy 
  as soon as possible!</p>
<p>You can check the status of your order at anytime by logging into the site.</p>
<p>Safe Shaggin'</p>
<p>Team Johnny<br>
<a href="http://onepoundjohnnyclub.com">onepoundjohnnyclub.com</a></p>

</div>
        <div class="line">
        </div>
    	<div class="wood">
        	<div class="cont">
            	<img src="http://files.onepoundjohnnyclub.com/images/social.png" alt="Social Links" title="Social Links">
                <a href="https://twitter.com/OPJClub"><img src="http://files.onepoundjohnnyclub.com/images/twitter.png" alt="Twitter" title="Twitter"></a>
                <a href="http://www.facebook.com/OnePoundJohnnyClub"><img src="http://files.onepoundjohnnyclub.com/images/facebook.png" alt="Facebook" title="Facebook"></a>
                <a href="http://www.youtube.com/user/onepoundjohnnyclub"><img src="http://files.onepoundjohnnyclub.com/images/youtube.png" alt="You Tube" title="You Tube"></a>
            </div>
        </div>
    </div>
</body>
</html>