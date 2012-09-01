<div class="page">
	<div class="wrap"> 
  		<div class="cont">
        	<h1><span class="pad">Update Password</span></h1>
			<div class="col">
				<?php if (isset($this->error)): ?>
				<p class="red center"><?php echo $this->error; ?></p>
				<?php endif; ?>
                <p>Please confirm your email address and update your account password.</p>
			</div>
			<div class="col last">
				<form id="user_frm" method="post">
					<?php echo $this->cust_email; ?>
					<?php echo $this->cust_pass; ?>
					<?php echo $this->cust_dummy_pass; ?>
					<?php echo $this->cust_pass_check; ?>
					<?php echo $this->cust_dummy_pass_check; ?>
                    <?php echo $this->cust_hash; ?>
                    <?php echo $this->password; ?>
					<input id="action" name="action" type="hidden" value="Pass">
					<input name="submit" type="submit" value="Update Pass" class="btn"> or <a href="<?php echo $this->page_path; ?>user/login/">Return to login</a>
				</form>
			</div>
			<div class="clear"></div>
        </div>
	</div>
</div>