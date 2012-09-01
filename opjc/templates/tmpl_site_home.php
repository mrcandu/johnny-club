<div id="mid">
	<div class="wrap"> 
  		<div class="cont">
			<h2><strong>One Pound Johnny Club - </strong>Safe shaggin' from just one pound a month! Get Jiggy Today...</h2>	
            
            
  <div id="promo"> 
  	<div id="promo_in">
		<h1>Buy one month, get one free!</h1>
	</div>
  </div>
            	
        	<?php if (isset($this->feat_product_list)): ?>	
        	<h3><a name="options"></a>Johnny Options</h3>           
            <div id="opt">
				<?php foreach(@$this->feat_product_list as $feat_product_list_row): ?>
				<div id="opt_img4" class="opt_img<?php echo $feat_product_list_row['last']; ?>">
					<a href="<?php echo $feat_product_list_row['prd_link']; ?>"><img src="<?php echo $feat_product_list_row['img_full']; ?>" alt="<?php echo $feat_product_list_row['prd_alt']; ?>" title="<?php echo $feat_product_list_row['prd_alt']; ?>"/><span class="det"><?php echo $feat_product_list_row['prd_name']; ?></span></a>
					<div class="price">
						<p><?php echo $feat_product_list_row['price']; ?></p>
					</div>
				</div>
            	<?php endforeach;?> 
			<div class="clear"></div>
			</div>
			<?php endif; ?>
            <div id="twitter"><p><img src="<?php echo $this->page_path; ?>images/site/twitter_bird.png" alt="Twitter Bird" title="Twitter Bird"/><?php echo $this->tweet; ?></p></div>	
            
        </div>
	</div>
</div>
