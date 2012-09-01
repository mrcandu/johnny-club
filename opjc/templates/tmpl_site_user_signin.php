<div class="page">

	<div class="wrap"> 

  		<div class="cont">

			<?php if (isset($this->shop)): ?>

			<ul id="shop">

				<li class="selected">1.Sign In</li>

				<li>2.Confirm</li>

				<li class="last">3.Pay</li>

			</ul>

			<div class="clear"></div>

			<?php endif; ?>

			<div class="col">

			<h1><span class="pad">Sign In</span></h1>

			<?php if (isset($this->error)): ?>

				<p class="red center"><?php echo $this->error; ?></p>

			<?php endif; ?>		

			</div>

			<div class="col last">

				<form id="user_frm" method="post">

					<?php echo $this->cust_email; ?>

                    <em class="disp_blk marg_bot left"><?php echo $this->cust_type_new; ?> I am a new customer.</em>

                    <em class="disp_blk marg_bot left"><?php echo $this->cust_type_exist; ?> I am a returning customer, and my password is:</em>

					<?php echo $this->cust_dummy_pass; ?>

					<?php echo $this->cust_pass; ?>

                    <?php echo $this->password; ?>

					<em class="disp_blk marg_bot"><a href="<?php echo $this->page_path; ?>user/forgot/">Forgotten your password?</a></em>

					<input id="action" name="action" type="hidden" value="Add">

					<input name="submit" type="submit" value="Sign In" class="btn">

				</form>

			</div>

			<div class="clear"></div>

        </div>

	</div>

</div>