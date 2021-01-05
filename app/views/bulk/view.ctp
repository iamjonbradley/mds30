<h2>Bulk Submissions</h2>
<script type="text/javascript">
$(document).ready(function() {    
  $('.select-all').click(function() { 
    $('input[type=checkbox]').attr('checked', true);
  })
}); 
</script>
<table width="100%">
  <tr>
    <td class="left-column" valign="top">
      <?php echo $this->element('menus/side/bulk'); ?>
    </td>
    <td valign="top">
      <h3>Information about the Submission</h3>
      <table  width="100%" class="results">
        <tr>
          <th>ID</th>
          <th># of Assessments</th>
          <th>Filename</th>
          <th>Date Created</th>
          <th>Actions</th>
        </tr>
        <tr>
          <td class="align-center"><?php echo $bulk['Bulk']['id']; ?></td>
          <td class="align-center"><?php echo $bulk['Bulk']['count']; ?></td>
          <td class="align-center"><a href="/transmission_files/batches/<?php echo $bulk['Bulk']['filename']; ?>">Download Here</a></td>
          <td class="align-center"><?php echo $this->Time->format('m-d-Y', $bulk['Bulk']['modified']); ?></td>
          <td class="align-center"><a href="/bulk/regenerate/<?php echo $bulk['Bulk']['id']; ?>">regenerate</a></td>
        </tr>
      </table>
      
      <h3>Assessments Submitted</h3>
      <?php echo $this->Form->create('Bulk', array('url' => '/bulk/update')); ?>
      <table  width="100%" cellspacing="0" class="results">
        <tr>
          <th class="align-left"><a href="#" class="select-all">[ + ]</a></th>
          <th class="align-left">ID</th>
          <th class="align-left">Resident Name</th>
          <th class="align-left">Item Set</th>
          <th>Type</th>
          <th>Status</th>
          <th>ARD</th>
          <th>ADL</th>
          <th>Therapy</th>
          <th>T-RUG</th>
          <th>N-RUG</th>
        </tr>
        <?php
        $i = 0;
        foreach ($bulk['BulkSubmissionAssessment'] as $key => $value) {
        ?>
          <tr>
            <td>
              
              <?php 
              if ($value['Assessment']['transmission_status'] != 2) {
                echo $this->Form->hidden('Assessment.'. $i .'.id', array('value' => $value['Assessment']['id']));
                echo $this->Form->input('Assessment.'. $i .'.selected', array('type' => 'checkbox', 'div' => false, 'label' => false)); 
              }
              ?>
            </td>
            <td><?php echo $value['Assessment']['id']; ?></td>
            <td><?php echo $value['Resident']['PATFNAME']; ?> <?php echo $value['Resident']['PATLNAME']; ?></td>
            <td><?php echo $this->AssessmentType->get($value); ?></td>
            <td class="align-center">
              <?php 
              switch ($value['SectionX']['X0100']) {
                case 1: echo 'NEW';  break;
                case 2: echo 'MOD'; break;
                case 3: echo 'DEL'; break;
              }
              ?>
            </td>
            <td class="align-center">
            <?php 
              switch($value['Assessment']['transmission_status']) {
                case 0: echo 'Pending';    break;
                case 1: echo 'Trasmitted'; break;
                case 2: echo 'Accepted';   break;
                case 3: echo 'Rejected';   break;
              }
            ?>
            </td>
          <td class="time align-center"><?php echo $this->Time->format('m-d-Y', $value['SectionA']['A2300']); ?></td>
          <?php if ($value['Assessment']['type'] != 'NT') { ?>
          <td class="align-center"><?php echo $value['RugCache']['adl']; ?></td>
          <td class="align-center"><?php echo $value['RugCache']['minutes_ttl']; ?></td>
          <td class="align-center"><?php echo $value['RugCache']['rug_therapy']; ?></td>
          <td class="align-center"><?php echo $value['RugCache']['rug_nursing']; ?></td>
          <?php } else { ?>
          <td class="align-center" colspan="4">&nbsp;</td>
          <?php } ?>
          </tr>        
        <?php 
          $i++;
        }
        ?>
      </table>
      
      <?php
      echo $this->Form->input('transmission_status', array('label' => 'Select a status for the assessment(s)', 'type' => 'select', 'empty' => '----------', 'options' => array(
        1 => 'Transmitted',
        2 => 'Accepted',
        3 => 'Rejected'
      )));
      echo $this->Form->submit('Update Status');
      echo $this->Form->end();
      ?>
    </td>    
  </tr>  
</table>