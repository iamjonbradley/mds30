
<table width="100%">
  <tr>
    <td valign="top" class="left-column" valign="top">
      <?php echo $this->element('_facility_list', array('plugin' => 'reports')); ?>
    </td>
    <td valign="top" valign="top">
    	<?php 
    	echo $this->Html->link(
	    	$this->Html->image('actions/printer.png', array('class' => 'float-right', 'style' => 'padding-left: 10px')), 	
	    	array('action' => 'export', $facility), 
	    	array('escape' => false, 'target' => 'new')
	    );
      	?>
 		<?php echo $this->element('census_detail/_report'); ?>
    </td>
  </tr>
</table>