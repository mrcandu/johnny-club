<!DOCTYPE html><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1" />

<title><?php echo $this->page_title; ?></title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>

<script src="<?php echo $this->page_path; ?>incfiles/js_site.js"></script>

<?php echo $this->jquery; ?>	

<script type="text/javascript" src="//use.typekit.net/bro5wlg.js"></script>

<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<?php if (isset($this->google)): ?>

<script src="<?php echo $this->page_path; ?>incfiles/js_google.js"></script>

<?php endif; ?>

<link rel="stylesheet" type="text/css" href="<?php echo $this->page_path; ?>style/form040313.css" media="all" />

<link rel="stylesheet" type="text/css" href="<?php echo $this->page_path; ?>style/site040313.css" media="all" />

<!--[if lte IE 6]>

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->page_path; ?>style/ie6.css" />    

<![endif]-->

</head>

<body>



<div class="wrap"> 

  <div id="user"> 

    <div id="user_in"> 

      <div class="cont"><form action="<?php echo $this->page_path; ?>user/login/" method="post" id="login_frm"><input type="hidden" name="action" value="Logoff"><p><?php echo $this->logged_in_as." ".$this->frm_login; ?></p></form></div>

    </div>

  </div>



<div class="cont">



	<a href="<?php echo $this->page_path; ?>"><img src="<?php echo $this->page_path; ?>images/site/one_pound_johnny_club.png" alt="One Pound Johnny Club" title="One Pound Johnny Club" id="logo"/></a>



    <ul id="nav">

		<li><a href="<?php echo $this->page_path; ?>">Home</a></li>

        <li><a href="<?php echo $this->page_path; ?>#options">Store</a></li>

        <li><a href="<?php echo $this->page_path; ?>about/">About Us</a></li>

        <li class="last"><a href="<?php echo $this->page_path; ?>contact/">Contact</a></li>

	</ul>

	

  <?php if (isset($this->inc_banner)): ?>

  <div id="ban"> 

  	<div id="ban_in">

		<h1>Buying our johnnies couldn't be easier...</h1>

		<div id="ban_img1" class="ban_img"><strong>Join the Club</strong><img src="<?php echo $this->page_path; ?>images/site/join_the_club.png" alt="Join the Club" title="Join the Club"/><p>Monthly subscription plans from a quid.</p></div>

		<div id="ban_img2" class="ban_img"><strong>Choose Your Weapon</strong><img src="<?php echo $this->page_path; ?>images/site/choose_your_weapon.png" alt="Choose Your Weapon" title="Choose Your Condom"/><p>Select quantity and style of condoms.</p></div>

		<div id="ban_img3" class="ban_img"><strong>Discreet Delivery</strong><img src="<?php echo $this->page_path; ?>images/site/discreet_delivery.png" alt="Discreet Delivery" title="Discreet Delivery"/><p>Your privacy is our priority!</p></div>

		<div id="ban_img4" class="ban_img"><strong>Get Jiggy</strong><img src="<?php echo $this->page_path; ?>images/site/get_jiggy.png" alt="Get Jiggy" title="Get Jiggy"/><p>Don't hang about or you'll go without!</p></div>

	<div class="clear"></div>

	</div>

  </div>

  <?php endif; ?>

  

  </div>

</div>



<div class="bar_top"></div>



<?php echo $this->page_body; ?>



<div class="bar_btm"></div>



<div class="wrap"> 

<div class="cont">



<div id="foot">



<div id="social">

<p>Lets Get Social</p>

<p><a href="https://twitter.com/OPJClub"><img src="<?php echo $this->page_path; ?>images/site/twitter.png" alt="One Pound Johnny Club on Twitter" title="One Pound Johnny Club on Twitter"/></a><a href="http://www.facebook.com/OnePoundJohnnyClub"><img src="<?php echo $this->page_path; ?>images/site/facebook.png" alt="One Pound Johnny Club on Facebook" title="One Pound Johnny Club on Facebook"/></a><a href="http://www.youtube.com/user/onepoundjohnnyclub"><img src="<?php echo $this->page_path; ?>images/site/youtube.png" alt="One Pound Johnny Club on YouTube" title="One Pound Johnny Club on YouTube"/></a></p>

</div>	



<div id="site_map">Site Map</div>

<ul>

<li><a href="<?php echo $this->page_path; ?>">Home Page</a></li>

<li><a href="<?php echo $this->page_path; ?>#options">Johnny Store</a></li>

<li><a href="<?php echo $this->page_path; ?>about/">About Us</a></li>

<li><a href="<?php echo $this->page_path; ?>contact/">Contact Us</a></li>

</ul>

<ul>

<li><a href="<?php echo $this->page_path; ?>terms/">Terms &amp; Conditions</a></li>

<li><a href="<?php echo $this->page_path; ?>privacy/">Privacy</a></li>

<li><a href="<?php echo $this->page_path; ?>user/forgot/">Reset Password</a></li>

</ul>



<div id="copy"><p>Copyright &copy; <?php echo date("Y"); ?> One Pound Johnny Club. All rights reserved.</p></div>	



</div>



</div>

</div>

</body>

</html>

