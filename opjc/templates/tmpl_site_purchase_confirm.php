<div class="page">
	<div class="wrap"> 
  		<div class="cont">
			<ul id="shop">
				<li class="done">1.Sign In</li>
				<li class="done">2.Confirm</li>
				<li class="selected last">3.Pay</li>
			</ul>
			<?php if (isset($this->error)): ?>
			<p class="red"><?php echo $this->error; ?></p>
			<?php endif; ?>	
			<form id="purchase" action="<?php echo $this->paypal_url; ?>" method="post">
				<input type="hidden" name="cmd" value="_xclick-subscriptions">
				<input type="hidden" name="business" value="<?php echo $this->paypal_business; ?>">
				<input type="hidden" name="lc" value="GB">
				<input type="hidden" name="item_name" value="<?php echo $this->item_name; ?>">
					<input type="hidden" name="item_number" value="<?php echo $this->item_number; ?>">
				<input type="hidden" name="no_note" value="1">
				<input type="hidden" name="no_shipping" value="1">
				<input type="hidden" name="src" value="1">
				<input type="hidden" name="a3" value="<?php echo $this->a3; ?>">
				<input type="hidden" name="p3" value="1">
				<input type="hidden" name="t3" value="<?php echo $this->t3; ?>">
				<input type="hidden" name="custom" value="<?php echo $this->custom; ?>">
				<input type="hidden" name="currency_code" value="GBP">
				<input type="hidden" name="first_name" value="<?php echo $this->first_name; ?>">
				<input type="hidden" name="last_name" value="<?php echo $this->last_name; ?>">
				<input type="hidden" name="email" value="<?php echo $this->email; ?>">
				<input type="hidden" name="address1" value="<?php echo $this->add_aline1; ?>">
				<input type="hidden" name="address2" value="<?php echo $this->add_aline2; ?>">
				<input type="hidden" name="city" value="<?php echo $this->add_city; ?>">
				<input type="hidden" name="state" value="<?php echo $this->add_county; ?>">
				<input type="hidden" name="zip" value="<?php echo $this->add_postcode; ?>">
				<input type="hidden" name="country" value="<?php echo $this->add_country; ?>">
			</form>
			Please wait ..... transfering you to Paypal. <img src="<?php echo $this->page_path; ?>images/site/loading.gif" alt="Loading" title="Loading"/>
        </div>
	</div>
</div>						