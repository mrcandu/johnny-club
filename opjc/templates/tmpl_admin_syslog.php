<h1>System Log</h1>
<?php if (isset($this->error)): ?>
<p class="red"><?php echo $this->error; ?></p>
<?php endif; ?>	
<div class="col_full">
	<div class="pad_10">
	<?php if (!empty($this->syslog)): ?>
	<table>
		<tr>
			<th>Log ID</th>
            <th>Date</th>
           	<th>Log Type</th>
           	<th>Description</th>
			<th>User</th>
		</tr>
		<?php foreach(@$this->syslog as $syslog_row): ?>
		<tr>
			<td><?php print $syslog_row['log_id']; ?></td>
			<td><?php print date("l jS \of F Y h:i:s A",strtotime($syslog_row['log_datetime'])); ?></td>
           	<td><?php print $syslog_row['log_type']; ?></td>
           	<td><?php print $syslog_row['log_desc']; ?></td>
			<td><?php print $syslog_row['user_name']; ?></td>
       	</tr>
		<?php endforeach;?> 
	</table>
	<?php endif; ?>
	</div>
</div>
<div class="clear top_pad"></div>