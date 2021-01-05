
<?php echo $this->element('census_conditions/_css'); ?>
<table width="100%">
  <tr>
    <td valign="top" class="left-column" valign="top">
      <?php echo $this->element('_facility_list', array('plugin' => 'reports')); ?>
    </td>
    <td valign="top" valign="top">
      <?php 
      if ($this->data['Survey']['bad_date'] > 0) {
      ?>
      <div id="flashMessage" class="error">
        Sorry there are over <?php echo $this->data['Survey']['bad_date']; ?> assessments that were used that are over 7 days old. Please edit the fields below to ensure corrected data.
      </div>
      <?php
        
      }
      echo $this->element('census_conditions/_form'); 
      ?>
    </td>
  </tr>
</table>