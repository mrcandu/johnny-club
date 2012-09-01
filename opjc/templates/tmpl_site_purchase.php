<div class="page">

	<div class="wrap"> 

  		<div class="cont">

			<ul id="shop">

				<li class="done">1.Sign In</li>

				<li class="selected">2.Confirm</li>

				<li class="last">3.Pay</li>

			</ul>

			<div class="clear"></div>

			<div class="col">

				<h1 class="clear"><span class="pad">Delivery</span></h1>

				<?php if (isset($this->error)): ?>

				<p id="address_error" class="red"><?php echo $this->error; ?></p>

				<?php endif; ?>

					<form id="get_jiggy_frm" method="post">

					<p class="center">Please specify a delivery address for your subscription.</p>

					<p id="new" class="center">To add a new delivery address, click <a href="#" id="show_add_address_frm">here</a></p>

					<?php if ($this->cust_addlist!=""): ?>					

					<ul id="add_list" class="marg_top">

					<?php foreach(@$this->cust_addlist as $cust_addlist_row): ?>

						<li class="hov_no"><?php print $cust_addlist_row['add_id']; ?><?php print $cust_addlist_row['address']; ?></li>

					<?php endforeach;?> 

					</ul>

					<?php endif; ?>

					<?php print $this->prd_id; ?>

					<?php print $this->prd_item_id; ?>

					<?php print $this->prd_price_id; ?>
                    
                    <?php print $this->vcher; ?>

					<input name="action" type="hidden" value="Get Jiggy">

				</form>

				<div id="address" class="marg_top">

					<form id="add_address_frm" method="post" class="left">

                    	<?php echo $this->cust_forename; ?>

                   		<?php echo $this->cust_surname; ?>

						<?php echo $this->add_name; ?>

						<?php echo $this->add_aline1; ?>

						<?php echo $this->add_aline2; ?>

        				<?php echo $this->add_city; ?>

						<?php echo $this->add_county; ?>

       					<?php echo $this->add_postcode; ?>

						<?php echo $this->add_country; ?>

						<input name="action" type="hidden" value="Add Address">

						<input name="submit" type="submit" value="Save Address" class="btn">

						<!--<a href="#" id="add_address"><img src="<?php echo $this->page_path; ?>images/site/add_address.png" alt="Add Address" title="Add Address"/></a>-->

					</form>

				</div>

			</div>

			

			<div class="col last">				

				<div class="padblk hov_no">

				<h2><?php echo $this->product_name.": ".$this->item_name ?></h2>

				<p><?php echo $this->price_description; ?></p>

				<ul class="det">
                	<?php if ($this->v_desc!=""): ?>
                	<li class="tot"><?php echo $this->v_desc; ?></li>
					<?php endif; ?>
					<li>Sub Total: &pound;<?php echo $this->subtotal; ?></li>

					<li>P&amp;P: &pound;<?php echo $this->pandp; ?></li>

					<li class="tot">Grand Total: &pound;<?php echo $this->grandtotal; ?></li>

				</ul>

				<img id="pp_logo" src="<?php echo $this->page_path; ?>images/site/pp_logo.png" alt="Payment Methods" title="Payment Methods"/>

				<input name="submit" type="submit" value="Buy Now" class="btn marg_top" id="get_jiggy">

				</div>

			</div>

			

			<div class="clear"></div>

			

        </div>

	</div>

</div>