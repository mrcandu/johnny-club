<h1>Customers</h1>
<?php if (isset($this->error)): ?>
<p class="red"><?php echo $this->error; ?></p>
<?php endif; ?>	
<?php if ($this->cust_id==""): ?>
<?php echo $this->cust_id; ?>
<div class="col">
	<div class="pad_10">
 	<h2>Search Customer</h2>
	<form method="post">
		<div><?php echo $this->search_cust_id; ?></div>
		<div><?php echo $this->search_forename; ?></div>
        <div><?php echo $this->search_surname; ?></div>
        <div><?php echo $this->search_email; ?></div>
        <div><?php echo $this->search_postcode; ?></div>
		<div><?php echo $this->frm_search_btn; ?></div>
	</form> 
    <?php if ($this->search_results!=""): ?>
		<table>
			<tr>
				<th>Customer</th>
            	<th>Action</th>
			</tr>
			<?php foreach(@$this->search_results as $search_results_row): ?>
			<tr>
				<td><b><?php print $search_results_row['cust_name']."</b><br><em>".$search_results_row['cust_email']."</em><br>".$search_results_row['cust_address']; ?></td>
            	<td><form method="post"><?php print $search_results_row['cust_id']; ?><?php echo $this->frm_select_btn; ?></form></td>
        	</tr>
			<?php endforeach;?> 
		</table>		
	<?php endif; ?>  
 	</div>
</div> 
<?php endif; ?>    
<div class="col">
	<div class="pad_10">
	<h2><?php echo $this->cust_title; ?></h2>
	<form method="post">
		<div><?php echo $this->show_cust_id; ?></div>
		<div><?php echo $this->cust_created; ?></div>
		<div><?php echo $this->cust_forename; ?></div>
    	<div><?php echo $this->cust_surname; ?></div>
		<div><?php echo $this->cust_email; ?></div>
		<div><?php echo $this->cust_tel; ?></div>		
		<div><?php echo $this->cust_mobile; ?></div>
		<div><?php echo $this->cust_active; ?></div> 
		<div><?php echo $this->cust_new; ?></div> 
		<div><?php echo $this->cust_temppass; ?></div>	
		<div><?php echo $this->frm_submit_btn1; ?><?php echo $this->frm_submit_btn2; ?><?php echo $this->frm_submit_btn3; ?><?php echo $this->frm_delete_btn; ?></div>
	</form>
	<?php if (isset($this->frm_submit_btn4)): ?>
	<h3>Add Permanent Password</h3>
	<form method="post">
    	<div><?php echo $this->cust_pass; ?></div>
        <div><?php echo $this->cust_pass_check; ?></div>
		<div><?php echo $this->cust_id; ?></div>
		<div><?php echo $this->frm_submit_btn4; ?></div>
	</form>	
	<?php endif; ?>
	</div>
</div>
    	<?php if (isset($this->frm_submit_btn6)): ?>
<div class="col">
	<div class="pad_10">
    
    <?php if ($this->cust_addlist!=""): ?>
    <h2>Customer Addresses</h2>
		<table>
			<tr>
				<th>Address</th>
            	<th>Default</th>
            	<th>Action</th>
			</tr>
			<?php foreach(@$this->cust_addlist as $cust_addlist_row): ?>
			<tr>
				<td><?php print $cust_addlist_row['address']; ?></td>
				<td><?php print $cust_addlist_row['add_default']; ?></td>
            	<td><form method="post"><?php echo $this->frm_select_btn5; ?><?php echo $this->cust_id; ?><?php print $cust_addlist_row['add_id']; ?></form></td>
        	</tr>
			<?php endforeach;?> 
		</table>
		
	<?php endif; ?>
    
	<h4>Address Details</h3>
	<form method="post">
    	<div><?php echo $this->add_id; ?></div>
		<div><?php echo $this->cust_id; ?></div>
        <div><?php echo $this->add_aline1; ?></div>
		<div><?php echo $this->add_aline2; ?></div>
        <div><?php echo $this->add_city; ?></div>
		<div><?php echo $this->add_county; ?></div>
        <div><?php echo $this->add_postcode; ?></div>
		<div><?php echo $this->add_country; ?></div>
        <div><?php echo $this->add_active; ?></div>
		<div><?php echo $this->add_default; ?></div>
		<div><?php echo $this->frm_submit_btn6; ?><?php echo $this->frm_delete_btn5; ?></div>
        <div><?php echo $this->frm_submit_btn7; ?></div>
	</form>	
	</div>
</div>
	<?php endif; ?>
    
    
        <?php if ($this->cust_order_list!=""): ?>
<div class="col_wide2">
	<div class="pad_10">
    <h2>Customer Orders</h2>
		<table>
			<tr>
            	<th>Order ID</th>
				<th>Status</th>
            	<th>Details</th>
                <th>Start</th>
                <th>End</th>
                <th>Action</th>
			</tr>
			<?php foreach(@$this->cust_order_list as $cust_order_list_row): ?>
			<tr>
				<td><?php print $cust_order_list_row['order_id']; ?></td>
				<td><?php print $cust_order_list_row['order_status']; ?></td>
                <td><?php print $cust_order_list_row['order_name']; ?></td>
                <td><?php print $cust_order_list_row['order_created']; ?></td>
                <td><?php print $cust_order_list_row['order_cancelled']; ?></td>
            	<td><form action="<?php print $this->admin_url."admin_order_history/"; ?>" method="post"><?php echo $this->frm_select_btn8; ?><?php echo $this->cust_id; ?><?php print $cust_order_list_row['order_id_frm']; ?></form></td>
        	</tr>
			<?php endforeach;?> 
		</table>
	</div>
</div>		
	<?php endif; ?>
    
<div class="clear top_pad"><p><?php echo $this->link_close; ?></p></div>