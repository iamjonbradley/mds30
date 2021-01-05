<table width="100%">
  <tr>
    <td valign="top" class="left-column" valign="top">
      <!-- begin menus -->
      <?php echo $this->element('_facility_list', array('plugin' => 'reports')); ?>
      
    </td>
    <td valign="top" valign="top">
    	
    	<h2>Generate an export for AR</h2>
    	<h3>Facility: <?php echo $allowed_facilities[$this->params['pass'][0]]; ?></h3>
    	
    	<?php
    	echo $this->Form->create('Export', array('action' => 'generate'));
    	echo $this->Form->hidden('facility_id', array('value' => $this->params['pass'][0]));
    	echo $this->Form->input('ard_start', array('label' => 'ARD Start Date', 'type' => 'date', 'format' => 'm-d-Y'));
    	echo $this->Form->input('ard_end', array('label' => 'ARD End Date', 'type' => 'date', 'format' => 'm-d-Y'));
    	echo $this->Form->submit('Create');
    	echo $this->Form->end();
    	?>
      
    </td>
    
  </tr>
  
  
</table>