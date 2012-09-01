<h1>Admin User</h1>
<?php if (isset($this->error)): ?>
<p class="red"><?php echo $this->error; ?></p>
<?php endif; ?>	
<div class="col">
	<div class="pad_10">
	<h2>Select Item</h2>
	<form method="post">
		<div><?php echo $this->user_select; ?></div>
		<div><?php echo $this->frm_select_btn; ?><?php echo $this->frm_delete_btn; ?></div>
	</form>
	<h2>Admin User Details</h2>
	<form method="post">
		<div><?php echo $this->user_id; ?></div>
		<div><?php echo $this->user_created; ?></div>
		<div><?php echo $this->user_forename; ?></div>
    	<div><?php echo $this->user_surname; ?></div>
		<div><?php echo $this->user_email; ?></div>
		<div><?php echo $this->user_active; ?></div> 
		<div><?php echo $this->user_new; ?></div> 
		<div><?php echo $this->user_temppass; ?></div>	
		<div><?php echo $this->frm_submit_btn1; ?><?php echo $this->frm_submit_btn2; ?><?php echo $this->frm_submit_btn3; ?><?php echo $this->frm_delete_btn; ?></div>
	</form>
	<?php if (isset($this->frm_submit_btn4)): ?>
	<h3>Add Permanent Password</h3>
	<form method="post">
    	<div><?php echo $this->user_pass; ?></div>
        <div><?php echo $this->user_pass_check; ?></div>
		<div><?php echo $this->user_id; ?></div>
		<div><?php echo $this->frm_submit_btn4; ?></div>
	</form>	
	<?php endif; ?>
	</div>
</div>
<div class="clear top_pad"><p><?php echo $this->link_close; ?></p></div>