<div class="page">
	<div class="wrap"> 
  		<div class="cont">
			<h1><span class="pad">Contact Us</span></h1>
			<div class="col">
				<?php if (isset($this->error)): ?>
				<p class="red center"><?php echo $this->error; ?></p>
				<?php endif; ?>
				<?php if (isset($this->success)): ?>
				<p class="green center"><?php echo $this->success; ?></p>
				<?php endif; ?>
				<p>Thanks for taking the time to get in touch with us. Here at One Pound Johnny Club, we take our customer's shaggin' needs seriously and will ensure a reply within 24 hours... if not before.</p>
				<form id="user_frm" method="post" class="marg_top">
					<?php echo $this->enq_forename; ?>
					<?php echo $this->enq_surname; ?>
					<?php echo $this->enq_email; ?>
					<?php echo $this->enq_enq; ?>
					<?php echo $this->spam; ?>
					<input id="action" name="action" type="hidden" value="Enquiry">
				</form>	
			</div>
			<div class="col last">
				<form method="post">
					<h3 class="marg_bot"><span class="pad">Anti Spam</span></h3>
					<div class="padblk hov_no">
                    <?php echo $this->spam2; ?>
					</div>
					<input id="get_jiggy" name="submit" type="submit" value="Submit Enquiry" class="btn marg_top">
				</form>
			</div>
			<div class="clear"></div>
        </div>
	</div>
</div>