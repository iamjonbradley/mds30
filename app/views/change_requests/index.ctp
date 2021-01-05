<!-- begin groups -->
<table width="100%">
	<tr>
	  <td valign="top" colspan="10"><h2>Current Change Requests</h2></td>
	  <td valign="top" colspan="5" class="align-right align-bottom" colspan="13">
	    <div class="tip tip-top"></div>
	    <?php 
	      echo $this->Paginator->prev() .' ';
	      echo $this->Paginator->numbers() .' ';
	      echo $this->Paginator->next(); 
	    ?> 
	  </td>
	</tr>
</table>
<table  width="100%" cellspacing="0" class="results">

	<tr>
		<th><?php echo $this->Paginator->sort('Asmt #', 'assessment_id') ?></th>
		<th><?php echo $this->Paginator->sort('User', 'user_id') ?></th>
		<th><?php echo $this->Paginator->sort('Approved', 'approved_by') ?></th>
		<th><?php echo $this->Paginator->sort('Current', 'current_lock_date') ?></th>
		<th><?php echo $this->Paginator->sort('New', 'lock_date') ?></th>
		<th><?php echo $this->Paginator->sort('Reason', 'reason') ?></th>
		<th><?php echo $this->Paginator->sort('Status', 'status') ?></th>
		<th><?php echo $this->Paginator->sort('Created', 'created') ?></th>
		<th><?php echo $this->Paginator->sort('Modified', 'modified') ?></th>
		<th>&nbsp;</th>
	</tr>

	<?php if (!empty($data)) { ?>

		<?php foreach ($data as $key => $value) { ?>
		<tr>
			<td class="align-center" width="100"><?php echo $value['ChangeRequest']['assessment_id']; ?></td>
			<td width="100"><?php echo $value['User']['name']; ?></td>
			<td><?php echo $value['ApprovedBy']['name']; ?></td>
			<td class="align-center" width="120"><?php echo $value['ChangeRequest']['current_lock_date']; ?></td>
			<td class="align-center" width="120"><?php echo $value['ChangeRequest']['lock_date']; ?></td>
			<td><?php echo str_replace('\n', '<br />', $value['ChangeRequest']['reason']); ?></td>
			<td>
			<?php 
				switch ($value['ChangeRequest']['status']) {
					case 0:
						echo 'Pending';
						break;
					case 1:
						echo 'Approved';
						break;
				} 
			?>
			</td>
			<td class="align-center" width="100"><?php echo $this->Time->timeAgoInWords($value['ChangeRequest']['created']); ?></td>
			<td class="align-center" width="100"><?php echo $this->Time->timeAgoInWords($value['ChangeRequest']['modified']); ?></td>
			<td>
				<?php
					echo $this->Html->link('Approve', array('action' => 'approve', $value['ChangeRequest']['id']));
				?>
			</td>
		</td>
		<?php } ?>

	<?php } else { ?>

		<tr>
			<td colspan="10">Sorry there are no new requests</td>
		</tr>

	<?php } ?>

</table>