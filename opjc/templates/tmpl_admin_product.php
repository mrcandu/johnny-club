<h1>Items</h1>
<?php if (isset($this->error)): ?>
<p class="red"><?php echo $this->error; ?></p>
<?php endif; ?>	
<div class="col">
	<div class="pad_10">
	<h2>Select Item</h2>
	<form method="post">
		<div><?php echo $this->prd_select; ?></div>
		<div><?php echo $this->frm_select_btn; ?><?php echo $this->frm_delete_btn; ?></div>
	</form>
	<h2>Item Details</h2>
	<form method="post">
		<div><?php echo $this->prd_name; ?></div>
		<div><?php echo $this->prd_site_name; ?></div>
		<div><?php echo $this->prd_code; ?></div>
    	<div><?php echo $this->prd_live; ?></div>
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
		
	<?php if (isset($this->prd_cat) and isset($this->link_close)): ?>
	<h3>Item Categories</h3>
	<form method="post">
		<div><?php echo $this->prd_cat; ?></div>
    	<div><?php echo $this->prd_id; ?></div>
		<div><?php echo $this->frm_submit_btn2; ?></div>
	</form>
	<?php endif; ?>
	
	<?php if ($this->prd_catlist!=""): ?>
		<table>
			<tr>
				<th>Category Type</th>
            	<th>Category</th>
            	<th>Delete</th>
			</tr>
			<?php foreach(@$this->prd_catlist as $prd_catlist_row): ?>
			<tr>
				<td><?php print $prd_catlist_row['cattype_desc']; ?></td>
				<td><?php print $prd_catlist_row['cat_desc']; ?></td>
            	<td><form method="post"><?php echo $this->frm_submit_btn3; ?><?php echo $this->prd_id; ?><input name="prdcat_id" id="prdcat_id" type="hidden" value="<?php print $prd_catlist_row['prdcat_id']; ?>" /></form></td>
        	</tr>
			<?php endforeach;?> 
		</table>
		
	<?php endif; ?>
			
	<?php if (isset($this->link_close)): ?>	
	</div>
</div>
<div class="col">
	<div class="pad_10">
	<h4>Item Images</h4>
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