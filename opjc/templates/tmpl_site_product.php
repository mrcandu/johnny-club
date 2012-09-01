<div class="page">

	<div class="wrap"> 

  		<div class="cont">

        	

			<div id="bread"><a href="<?php echo $this->page_path; ?>#options"><img src="<?php echo $this->page_path; ?>images/site/back_to_products.png" alt="Back to Products" title="Back to Products"/></a></div>

				<h1><span class="pad"><?php echo $this->prd_name; ?></span></h1>

				<div class="col small">

					<div id="prd_image"><img id="prd_img" src="<?php echo $this->prd_image; ?>" alt="<?php echo $this->prd_name; ?>" title="<?php echo $this->prd_name; ?>"/></div>					

					<div id="prd_icon">	

					<?php if ($this->items_list!=""): ?>

					<?php foreach(@$this->items_list as $items_list_row): ?>

					<?php if ($this->item_images!=""): ?>

						<ul id="itemimg<?php print $items_list_row['prd_id']; ?>" class="item_image_list" style="display:none;">

							<?php foreach($this->item_images[$items_list_row['prd_id']] as $item_images_row): ?>

							<li class="icon"><a href="<?php echo $item_images_row['img_full']; ?>" title="<?php echo $item_images_row['img_name']; ?>"><img src="<?php echo $item_images_row['img_icon_full']; ?>" alt="<?php echo $item_images_row['img_name']; ?>" title="<?php echo $item_images_row['img_name']; ?>"/></a></li>

               				<?php endforeach;?>						

						</ul>					

					<?php endif; ?>

					<?php endforeach;?> 

					<?php endif; ?>

					</div>

				</div>

				

				<div class="col wide last">

					

					<?php echo $this->prd_desc_html; ?>

					<h2 class="marg_top"><?php echo $this->prd_price; ?></h2>

                    <h2 class="marg_bot red">Buy one month, get one free! **</h2>

					

					<form id="prd_frm" action="<?php echo $this->page_path; ?>purchase/" method="post">

						<?php echo $this->prd_id; ?>

						<?php echo $this->prd_item_id; ?>

						<?php echo $this->prd_prices; ?>
                        
                        <?php echo $this->vcher; ?>

					</form>

					

          			<?php if ($this->items_list!=""): ?>

					<?php foreach(@$this->items_list as $items_list_row): ?>

					<div id="item<?php print $items_list_row['prd_id']; ?>" style="display:none;">

						<h3 class="marg_top"><span class="pad"><?php echo $items_list_row['prd_name']; ?></span></h3>

						<?php print $items_list_row['prd_desc_html']; ?>

					</div>

					<?php endforeach;?> 

					<?php endif; ?>

                    <p>** Buy one month get one free - For new customers only. You will be sent an extra month's worth of condoms in your first month free of charge.</p>
                    
                    <h3 class="marg_top"><span class="pad">Do you have a voucher code?</span></h3>
					<div id="voucher"><?php echo $this->voucher; ?><form><input name="submit" type="submit" value="Apply" class="btn red_back vcher" id="get_vcher"></form></div>
					<div id="vresult" class="left red"></div>
                    
					<form class="left marg_top"><input name="submit" type="submit" value="Buy Now" class="btn" id="get_jiggy"></form>

      				<!--<a href="#" id="get_jiggy"><img src="<?php echo $this->page_path; ?>/images/site/get_jiggy_button.png" alt="Get Jiggy" title="Get Jiggy"/></a>-->

				</div>

				

            	<div class="clear"></div>

				

			</div>

        </div>

	</div>

</div>

