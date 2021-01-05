<table width="100%">
  <tr>
    <td valign="top" class="left-column" valign="top">
      <!-- begin menus -->
      <?php echo $this->element('_facility_list', array('plugin' => 'reports')); ?>
    </td>
    <td valign="top" valign="top">
      <?php echo $this->element('_drug_report'); ?>
      <?php
      if (empty($report)) {
      	echo '<h3>Please select a facility to run a Drug Report</h3>';
  	  }
      ?>
    </td>
    
  </tr>
</table>