<div class="page">
	<div class="wrap"> 
  		<div class="cont">
			<div class="col">
				<h1><span class="pad">Reset Pass</span></h1>
			<?php if (isset($this->error)): ?>
				<p class="red center"><?php echo $this->error; ?></p>
				<?php endif; ?>
				<?php if (isset($this->success)): ?>
				<p class="green center"><?php echo $this->success; ?></p>
				<?php endif; ?>
				<p>Please enter your email address and we'll send you instructions on how to reset your password.</p>
				<form id="user_frm" method="post" class="marg_top">
				<?php echo $this->cust_email; ?>
				<?php echo $this->spam; ?>
				<input id="action" name="action" type="hidden" value="Forgot">
				</form>	
			</div>
			<div class="col last">
				<form method="post">
					<h3 class="marg_bot"><span class="pad">Anti Spam</span></h3>
					<div class="padblk hov_no">
                    <?php echo $this->spam2; ?>
					</div>
					<input id="get_jiggy" name="submit" type="submit" value="Reset Pass" class="btn"> or <a href="<?php echo $this->page_path; ?>user/login/">Return to login</a>
				</form>
			</div>
			<div class="clear"></div>
        </div>
	</div>
</div>