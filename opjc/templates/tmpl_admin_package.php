<h1>Products</h1>
<?php if (isset($this->error)): ?>
<p class="red"><?php echo $this->error; ?></p>
<?php endif; ?>	
<div class="col">
	<div class="pad_10">
	<h2>Select Product</h2>	
	<form method="post">
		<div><?php echo $this->prd_select; ?></div>
		<div><?php echo $this->frm_select_btn; ?><?php echo $this->frm_delete_btn; ?></div>
	</form>
	<h2>Product Details</h2>
	<form method="post">
		<div><?php echo $this->prd_name; ?></div>
		<div><?php echo $this->prd_code; ?></div>
    	<div><?php echo $this->prd_live; ?></div>
		<div><?php echo $this->prd_feature; ?></div>
		<div><?php echo $this->prd_desc; ?></div>
    	<div><?php echo $this->prd_id; ?></div>
		<div><?php echo $this->frm_submit_btn1; ?></div>
	</form>
	</div>
</div>

	<?php if (isset($this->link_close)): ?>
<div class="col">
	<div class="pad_10">
	<?php endif; ?>
	
	<?php if (isset($this->link_close)): ?>
	<h3>Product Items</h3>
	<form method="post">
		<div><?php echo $this->prd_cat; ?></div>
    	<div><?php echo $this->prd_id; ?></div>
		<div><?php echo $this->frm_submit_btn2; ?></div>
	</form>
	<?php endif; ?>
	
	<?php if ($this->prd_prdlist!=""): ?>
		<table>
			<tr>
				<th>Item Name</th>
            	<th>Default</th>
            	<th>Action</th>
			</tr>
			<?php foreach(@$this->prd_prdlist as $prd_prdlist_row): ?>
			<tr>
				<td><form method="post"><?php print $prd_prdlist_row['prd_name']; ?></td>
				<td><?php print $prd_prdlist_row['prd_pack_main']; ?></td>
            	<td><?php echo $this->frm_submit_btn3; ?><?php echo $this->frm_submit_btn4; ?><?php echo $this->prd_id; ?><?php echo $prd_prdlist_row['prd_pack_id']; ?></form></td>
        	</tr>
			<?php endforeach;?> 
		</table>
	<?php endif; ?>
		
	<?php if (isset($this->prd_price) and isset($this->link_close)): ?>
	<h3>Product Price Options</h3>
	<form method="post">
		<div><?php echo $this->prd_price_type; ?></div>
    	<div><?php echo $this->prd_price; ?></div>
		<div><?php echo $this->prd_price_code; ?></div>
		<div><?php echo $this->prd_id; ?></div>
		<div><?php echo $this->frm_submit_btn5; ?></div>
	</form>
	<?php endif; ?>
	
	<?php if ($this->prd_pricelist!=""): ?>
		<table>
			<tr>
				<th>Price Type</th>
            	<th>Price</th>
				<th>Code</th>
				<th>Order</th>
            	<th>Action</th>
			</tr>
			<?php foreach(@$this->prd_pricelist as $prd_pricelist_row): ?>
			<tr>
				<td><form method="post"><?php print $prd_pricelist_row['price_type_name']; ?></td>
				<td><?php print $prd_pricelist_row['price']; ?></td>
				<td><?php print $prd_pricelist_row['price_code']; ?></td>
				<td><?php print $prd_pricelist_row['price_order']; ?></td>
            	<td><?php echo $this->frm_submit_btn6; ?><?php echo $this->frm_submit_btn7; ?><?php echo $this->prd_id; ?><?php echo $prd_pricelist_row['prd_price_id']; ?><?php echo $prd_pricelist_row['price_type_id']; ?></form></td>
        	</tr>
			<?php endforeach;?> 
		</table>
	<?php endif; ?>
	
	<?php if (isset($this->link_close)): ?>	
	</div>
</div>
<div class="col">
	<div class="pad_10">
	<h4>Product Images</h4>
	<form method="post" enctype="multipart/form-data">
		<div><?php echo $this->prd_imgfile; ?></div>
    	<div><?php echo $this->prd_id; ?></div>
		<div><?php echo $this->frm_submit_btn8; ?></div>
	</form>
	<?php endif; ?>

	<?php if (!empty($this->prd_images_list)): ?>
	<table>
		<tr>
			<th>Image Name</th>
            <th>Image</th>
           	<th>Default</th>
           	<th>Action</th>
		</tr>
		<?php foreach(@$this->prd_images_list as $prd_images_list_row): ?>
		<tr>
			<td><form method="post"><?php print $prd_images_list_row['img_name']; ?></td>
			<td><img src="<?php print $prd_images_list_row['img_icon_url']; ?>" /></td>
           	<td><?php print $prd_images_list_row['img_main']; ?></td>
           	<td><?php print $prd_images_list_row['img_id']; ?><?php echo $this->prd_id; ?><?php echo $this->frm_submit_btn9; ?><?php echo $this->frm_submit_btn10; ?></form></td>
       	</tr>
		<?php endforeach;?> 
	</table>
	<?php endif; ?>
	<?php if (isset($this->link_close)): ?>
	</div>
</div>
	<?php endif; ?>
<div class="clear top_pad"><p><?php echo $this->link_close; ?></p></div>