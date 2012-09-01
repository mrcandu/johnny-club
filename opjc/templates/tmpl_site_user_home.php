<div class="page">

	<div class="wrap"> 

  		<div class="cont">

			<h1><span class="pad adapt">Your Subscriptions</span></h1>

			<?php if (isset($this->error)): ?>

			<p class="red center"><?php echo $this->error; ?></p>

			<?php endif; ?>

			<?php if (isset($this->success)): ?>

			<p class="green center"><?php echo $this->success; ?></p>

			<?php endif; ?>

			<p class="center">You can manage your subscriptions from here. Need more johnnies? <em><a href="<?php echo $this->page_path; ?>#options">Add another subscription.</a></em></p>

			<div class="col">

				<?php if ($this->orders_list!=""): ?>

				<h3 class="marg_bot"><span class="pad">Current Subscriptions</span></h3>	

				<?php foreach(@$this->orders_list as $orders_list_row): ?>

				<div id="order<?php print $orders_list_row['order_id']; ?>" class="padblk hov">

				<h2 class="left"><span class="arrow"><img id="tog_show_order<?php print $orders_list_row['order_id']; ?>" src="<?php echo $this->page_path; ?>images/site/arrow_left.png"><img id="tog_hide_order<?php print $orders_list_row['order_id']; ?>" src="<?php echo $this->page_path; ?>images/site/arrow_down.png" class="disp_n"></span><?php print $orders_list_row['prd_name']; ?> : <?php print $orders_list_row['prd_item_name']; ?></h2>

				<div class="det disp_n">

				<p><?php print $orders_list_row['order_name']; ?></p>

				<p>Delivery: <?php print $orders_list_row['address']; ?></p>

				<ul>

					<li>Status: <strong><?php print $orders_list_row['order_status']; ?></strong></li>

					<li>Started: <strong><?php print $orders_list_row['order_created']; ?></strong></li>

					<li>Price Plan: <strong><?php print $orders_list_row['tot_price']; ?></strong></li>

					<li>Payments to Date: <strong><?php print $orders_list_row['payments']; ?></strong></li>

					<li>Last Payment: <strong><?php print $orders_list_row['order_trans_created']; ?></strong></li>

					<li>Last Payment Delivery Status: <strong><?php print $orders_list_row['dispatch']; ?></strong></li>

				</ul>

				<form method="post" action="<?php echo $this->page_path; ?>user/home/">

				<?php if ($orders_list_row['cancel_pend']!="1"): ?>

				<input name="submit" type="submit" value="Cancel" class="btn marg_top disp_blk" id="can_order<?php print $orders_list_row['order_id']; ?>" >

				<input name="submit" type="submit" value="Confirm Cancel" class="btn marg_top disp_blk red_back" style="display:none;" id="ccan_order<?php print $orders_list_row['order_id']; ?>">

				<?php endif; ?>

				<input id="action" name="action" type="hidden" value="Cancel">

				<input name="order_hash" type="hidden" value="<?php print $orders_list_row['order_hash']; ?>">

				</form>

				</div>

				</div>

				<?php endforeach;?> 

				<?php endif; ?>

			</div>

			

			<div class="col last">				

				<?php if ($this->cancelled_list!=""): ?>

				<h3 class="marg_bot"><span class="pad">Cancelled Subscriptions</span></h3>	

				<?php foreach(@$this->cancelled_list as $cancelled_list_row): ?>

				<div id="order<?php print $cancelled_list_row['order_id']; ?>" class="padblk hov">

				<h2 class="left"><?php print $cancelled_list_row['prd_name']; ?> : <?php print $cancelled_list_row['prd_item_name']; ?><span class="arrow"><img id="tog_show_order<?php print $cancelled_list_row['order_id']; ?>" src="<?php echo $this->page_path; ?>images/site/arrow_left.png"><img id="tog_hide_order<?php print $cancelled_list_row['order_id']; ?>" src="<?php echo $this->page_path; ?>images/site/arrow_down.png" class="disp_n"></span></h2>

				<div class="det disp_n">

				<p><?php print $cancelled_list_row['order_name']; ?></p>

				<p>Delivery: <?php print $cancelled_list_row['address']; ?></p>

				<ul>

					<li>Status: <strong><?php print $cancelled_list_row['order_status']; ?></strong></li>

					<li>Started: <strong><?php print $cancelled_list_row['order_created']; ?></strong></li>

					<li>Cancelled: <strong><?php print $cancelled_list_row['order_cancelled']; ?></strong></li>

					<li>Price Plan: <strong><?php print $cancelled_list_row['tot_price']; ?></strong></li>

					<li>Payments to Date: <strong><?php print $cancelled_list_row['payments']; ?></strong></li>

					<li>Last Payment: <strong><?php print $cancelled_list_row['order_trans_created']; ?></strong></li>

					<li>Last Payment Delivery Status: <strong><?php print $cancelled_list_row['dispatch']; ?></strong></li>

				</ul>

				</div>

				</div>

				<?php endforeach;?> 

				<?php endif; ?>



			</div>

			

			<div class="clear"></div>

        </div>

	</div>

</div>