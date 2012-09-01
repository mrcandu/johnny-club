<h1>Order History</h1>
<?php if (isset($this->error)): ?>
<p class="red"><?php echo $this->error; ?></p>
<?php endif; ?>	
<form action="<?php echo $this->admin_url; ?>admin_customer/" method="post">
<?php echo $this->cust_id; ?>
<?php echo $this->frm_nav_btn1; ?>
</form>
<div class="col">
	<div class="pad_10">
 	<h2>Customer Details</h2>
<table>
  <tr>
    <td>Forename:</td>
    <td><?php echo $this->cust_forename; ?></td>
  </tr>
  <tr>
    <td>Surname:</td>
    <td><?php echo $this->cust_surname; ?></td>
  </tr>
  <tr>
    <td>Email:</td>
    <td><?php echo $this->cust_email; ?></td>
  </tr>
</table>
 	<h2>Order Details</h2>
<table>
  <tr>
    <td>Order ID:</td>
    <td><?php echo $this->order_id; ?></td>
  </tr>
  <tr>
    <td>Details:</td>
    <td><?php echo $this->order_name; ?></td>
  </tr>
  <tr>
    <td>Created:</td>
    <td><?php echo $this->order_created; ?></td>
  </tr>
  <tr>
    <td>Updated</td>
    <td><?php echo $this->order_updated; ?></td>
  </tr>
  <tr>
    <td>Cancelled</td>
    <td><?php echo $this->order_cancelled; ?></td>
  </tr>
  <tr>
    <td>Status</td>
    <td><?php echo $this->order_status; ?></td>
  </tr>
  <tr>
    <td>Price</td>
    <td><?php echo $this->price; ?></td>
  </tr>
  <tr>
    <td>Delivery Charge:</td>
    <td><?php echo $this->del; ?></td>
  </tr>
  <tr>
    <td>Total Price</td>
    <td><?php echo $this->tot_price; ?></td>
  </tr>
</table>
 	<h2>Shipping Address</h2>
    <form method="post">
    	<div><?php echo $this->order_id_hidden; ?></div>
        <div><?php echo $this->add_aline1; ?></div>
        <div><?php echo $this->add_aline2; ?></div>
        <div><?php echo $this->add_city; ?></div>
        <div><?php echo $this->add_county; ?></div>
        <div><?php echo $this->add_postcode; ?></div>
        <div><?php echo $this->add_country; ?></div>
        <div><?php echo $this->frm_submit_btn1; ?></div>
    </form>
 	</div>
</div>
<?php if ($this->order_trans!=""): ?> 
<div class="col_wide">
	<div class="pad_10">
    <h2>Order Transactions</h2>
		<table>
			<tr>
				<th>Date</th>
            	<th>Type</th>
            	<th>Trans Status</th>
                <th>Dispatch Status</th>
                <th>Action</th>
			</tr>
			<?php foreach(@$this->order_trans as $order_trans_row): ?>
			<tr><form method="post">
				<td><?php print $order_trans_row['order_trans_created']; ?></td>
				<td><?php print $order_trans_row['payment_type']; ?></td>
                <td><?php print $order_trans_row['payment_status']; ?></td>
                <td><?php print $order_trans_row['dispatch']; ?></td>
            	<td><?php echo $this->frm_submit_btn2; ?><?php echo $order_trans_row['order_trans_id']; ?><?php echo $this->order_id_hidden; ?></td>
        	</tr></form>
			<?php endforeach;?> 
		</table>
	</div>
</div>
	<?php endif; ?>    
<div class="clear top_pad"><p><?php echo $this->link_close; ?></p></div>