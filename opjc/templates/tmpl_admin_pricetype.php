<h1>Price Type</h1>
<div class="col">
	<div class="pad_10">
	<h2>Select Price Type</h2>
	<?php if (isset($this->error)): ?>
	<p class="red"><?php echo $this->error; ?></p>
	<?php endif; ?>
	<form method="post">
		<div><?php echo $this->pricetype_select; ?></div>
		<div><?php echo $this->frm_select_btn; ?><?php echo $this->frm_delete_btn; ?></div>
	</form>
	<h2>Price Type Details</h2>
	<form method="post">
		<div><?php echo $this->price_type_name; ?></div>
		<div><?php echo $this->price_type_code; ?></div>
		<div><?php echo $this->price_type_desc; ?></div>
		<div><?php echo $this->price_type_recur; ?></div>
		<div><?php echo $this->price_type_months; ?></div>
		<div><?php echo $this->price_type_handling; ?></div>
		<div><?php echo $this->price_type_delivery; ?></div>
    	<div><?php echo $this->price_type_id; ?></div>
		<div><?php echo $this->frm_submit_btn1; ?></div>
	</form>
	</div>
</div>
<div class="clear top_pad"><p><?php echo $this->link_close; ?></p></div>