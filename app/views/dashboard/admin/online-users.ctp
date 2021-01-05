<h2>Active Users (<?php echo count($data); ?>)</h2>
<table class="results" cellspacing="0" cellpadding="0">
	<tr>
		<th>Facility</th>
		<th>Group</th>
		<th>User</th>
		<th>IP Address</th>
		<th>Last Seen</th>
	</tr>
	<?php foreach ($data as $key => $value) { ?>
		<tr>
			<td><?php echo $value['Facility']['name']; ?></td>
			<td><?php echo $value['Group']['name']; ?></td>
			<td><?php echo $value['User']['name']; ?></td>
			<td><?php echo $value['Stat']['ip_address']; ?></td>
			<td><?php echo $this->Time->timeAgoInWords($value['Stat']['created']); ?></a></td>
		</tr>
	<?php } ?>
</table>