<h2>Quick Jump</h2>

<table class="results" cellspacing="0" cellpadding="0">

<!-- start assessment quick jump -->
<?php 
echo $this->Form->create('Jump', array('url' => '/dashboard/jump')); 
echo $this->Form->hidden('type', array('value' => 'assessment'));
?>
<tr>
	<td class="valign-middle"><strong>Enter Assessment #</strong></td>
	<td><?php echo $this->Form->input('id', array('type' => 'text', 'div' => false, 'label' => false)); ?></td>
	<td><?php echo $this->Form->submit('Go', array('div' => false)); ?></td>
</tr>
<?php echo $this->Form->end(); ?>

<!-- start ticket quick jump -->
<?php 
echo $this->Form->create('Jump', array('url' => '/dashboard/jump')); 
echo $this->Form->hidden('type', array('value' => 'ticket'));
?>
<tr>
	<td class="valign-middle"><strong>Enter Ticket #</strong></td>
	<td><?php echo $this->Form->input('id', array('type' => 'text', 'div' => false, 'label' => false)); ?></td>
	<td><?php echo $this->Form->submit('Go', array('div' => false)); ?></td>
</tr>
<?php echo $this->Form->end(); ?>

<!-- start bulk submission quick jump -->
<?php 
echo $this->Form->create('Jump', array('url' => '/dashboard/jump')); 
echo $this->Form->hidden('type', array('value' => 'bulk'));
?>
<tr>
	<td class="valign-middle"><strong>Enter Bulk Submission #</strong></td>
	<td><?php echo $this->Form->input('id', array('type' => 'text', 'div' => false, 'label' => false)); ?></td>
	<td><?php echo $this->Form->submit('Go', array('div' => false)); ?></td>
</tr>
<?php echo $this->Form->end(); ?>


</table>