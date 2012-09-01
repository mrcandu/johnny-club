<h1>Vouchers</h1>

<div class="col">

	<div class="pad_10">

	<h2>Select Voucher</h2>

	<?php if (isset($this->error)): ?>

	<p class="red"><?php echo $this->error; ?></p>

	<?php endif; ?>

	<form method="post">

		<div><?php echo $this->voucher_select; ?></div>

		<div><?php echo $this->frm_select_btn; ?><?php echo $this->frm_delete_btn; ?></div>

	</form>

	<h2>Vouchers</h2>

	<form method="post">

		<div><?php echo $this->v_code; ?></div>

		<div><?php echo $this->v_desc; ?></div>

		<div><?php echo $this->v_live; ?></div>

    	<div><?php echo $this->v_id; ?></div>

		<div><?php echo $this->frm_submit_btn1; ?></div>

	</form>

	</div>

</div>

<div class="clear top_pad"><p><?php echo $this->link_close; ?></p></div>