<!DOCTYPE html">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<title><?php echo $this->page_title; ?></title>       

		<script src="http://code.jquery.com/jquery-latest.js"></script>

        <script src="<?php echo $this->page_path; ?>incfiles/js_admin.js"></script>

       	<link href="<?php echo $this->page_path; ?>style/main.css" rel="stylesheet" type="text/css">



	</head>

	<body>

		<div class="grey2">

        <ul class="menu">

			<li><a href="<?php print $this->admin_url; ?>">Home</a></li>

            <li><span class="menu_head">Products</span>

				<ul>

					<li><a href="<?php print $this->admin_url."admin_product/"; ?>">Products</a></li>

            		<li><a href="<?php print $this->admin_url."admin_item/"; ?>">Items</a></li>

					<li><a href="<?php print $this->admin_url."admin_category/"; ?>">Categories</a></li>

					<li><a href="<?php print $this->admin_url."admin_categorytype/"; ?>">Category Types</a></li>

					<li><a href="<?php print $this->admin_url."admin_pricetype/"; ?>">Price Types</a></li>
                    
                    <li><a href="<?php print $this->admin_url."admin_voucher/"; ?>">Vouchers</a></li>

        		</ul>

			</li>

			<li><a href="<?php print $this->admin_url."admin_customer/"; ?>">Customers</a></li>

			<li><span class="menu_head">Orders</span>

				<ul>

					<li><a href="<?php print $this->admin_url."admin_orders/"; ?>">Orders Search</a></li>

					<li><a href="<?php print $this->admin_url."admin_orders/dispatch/"; ?>">Due for Dispatch</a></li>

				</ul>

			</li>

			<li><span class="menu_head">Site</span>

				<ul>

					<li><a href="<?php print $this->admin_url."admin_syslog/"; ?>">Admin Log</a></li>

                    <li><a href="<?php print $this->admin_url."admin_user/"; ?>">Admin User</a></li>

        		</ul>

			</li>

        </ul><div class="right"><form method="post" action="<?php echo $this->frm_logoff_url; ?>">Logged in as: <strong><?php echo $this->logged_in_as."</strong> ".$this->frm_logoff; ?></form></div>

		<div class="clear"></div>

		</div>

		

		<div class="clear"></div>

    	<div class="mar_20 grey">

        	<div class="pad_20">       

				<?php echo $this->page_body; ?>

        	</div>

		</div>

	</body>

</html>