<div class="page">
	<div class="wrap"> 
  		<div class="cont">
			<?php if (isset($this->shop)): ?>
			<ul id="shop">
				<li class="selected">1.Sign Up</li>
				<li>2.Confirm</li>
				<li class="last">3.Pay</li>
			</ul>
			<div class="clear"></div>
			<?php endif; ?>
			<div class="col">
				<h1><span class="pad">Log In</span></h1>
				<?php if (isset($this->error)): ?>
				<p class="red center"><?php echo $this->error; ?></p>
				<?php endif; ?>
				<p class="center">Not a member? <a href="<?php echo $this->page_path; ?>user/signup/" class="big">Sign Up</a></p>
			</div>
			<div class="col last">
				<form id="user_frm" method="post">
					<?php echo $this->cust_email; ?>
					<?php echo $this->cust_dummy_pass; ?>
					<?php echo $this->cust_pass; ?>
                    <?php echo $this->password; ?>
					<em class="disp_blk marg_bot"><a href="<?php echo $this->page_path; ?>user/forgot/">Forgotten your password?</a></em>
					<input id="action" name="action" type="hidden" value="Login">
					<input name="submit" type="submit" value="Log In" class="btn">
				</form>
			</div>
			<div class="clear"></div>
        </div>
	</div>
</div>