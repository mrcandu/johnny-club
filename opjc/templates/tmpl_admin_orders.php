<h1>Orders</h1>

<?php if (isset($this->error)): ?>

<p class="red"><?php echo $this->error; ?></p>

<?php endif; ?>	

<div class="col">

	<div class="pad_10">

	 <h2>Search Orders</h2>

	<form action="<?php echo $this->admin_url; ?>admin_orders/" method="post">

		<div><?php echo $this->order_switch_order; ?><?php echo $this->order_switch_trans; ?></div>

		<div><?php echo $this->date_start; ?></div>

		<div><?php echo $this->date_end; ?></div>

		<div><?php echo $this->dispatch; ?></div>

        <div><?php echo $this->payment_status; ?></div>

        <div><?php echo $this->order_status; ?></div>

		<div><?php echo $this->frm_search_btn; ?></div>

        <h3>Search Batch</h3>

        <div><?php echo $this->batch_id; ?></div>

		<div><?php echo $this->frm_search_btn2; ?></div>

		<div></div>

	</form> 

	</div>

</div>

	

<div class="col_wide2">

	<div class="pad_10">	

    <h2>Search Results</h2>

    	<div><form action="<?php echo $this->admin_url; ?>admin_orders/" method="post">

		<?php echo $this->frm_search_btn3; ?>

		<?php echo $this->frm_search_btn4; ?>

		<?php echo $this->frm_search_btn5; ?>

		<?php echo $this->order_switch_order_hide; ?>

		<?php echo $this->dispatch_hide; ?>

		<?php echo $this->payment_status_hide; ?>

		<?php echo $this->order_status_hide ?>

		<?php echo $this->date_start_hide; ?>

		<?php echo $this->date_end_hide; ?>

		<?php echo $this->batch_id_hide; ?>

		</form>

		</div>

		<?php if ($this->cust_order_list!=""): ?>

		<table>

			<tr>

            	<th>Order ID</th>

				<th>Order Status</th>

            	<th>Order Details</th>
                
                <th>Order Voucher</th>

                <th>Order Start</th>

                <th>Order End</th>
                
                <th>Trans ID</th>
                
				<th>Trans Created</th>

				<th>Trans Payment Status</th>

				<th>Trans Dispatch</th>

                <th>Trans Batch</th>

                <th>Action</th>

			</tr>

			<?php foreach(@$this->cust_order_list as $cust_order_list_row): ?>

			<tr>

				<td><?php print $cust_order_list_row['order_id']; ?></td>

				<td><?php print $cust_order_list_row['order_status']; ?></td>

                <td><?php print $cust_order_list_row['order_name']; ?></td>
                
                <td><?php print $cust_order_list_row['voucher']; ?></td>

                <td><?php print $cust_order_list_row['order_created']; ?></td>

                <td><?php print $cust_order_list_row['order_cancelled']; ?></td>
                
                <td><?php print $cust_order_list_row['cnt']; ?></td>

				<td><?php print $cust_order_list_row['order_trans_created']; ?></td>

				<td><?php print $cust_order_list_row['payment_status']; ?></td>

				<td><?php print $cust_order_list_row['dispatch']; ?></td>

                <td><?php print $cust_order_list_row['batch_id']; ?></td>
				
            	<td><form action="<?php print $this->admin_url."admin_order_history/"; ?>" method="post"><?php echo $this->frm_select_btn8; ?><?php echo $this->cust_id; ?><?php print $cust_order_list_row['order_id_frm']; ?></form></td>

        	</tr>

			<?php endforeach;?> 

		</table>

		<?php endif; ?>

	</div>

</div>

<div class="clear"></div>