<?php
$this->data = $current;

// get calcs
$rugs = array();

$rugs['therapy'] = $this->Rug->therapy ($this->data, $this->data['Assessment']['facility_id']);
$rugs['nursing'] = $this->Rug->nursing ($this->data, $this->data['Assessment']['facility_id']);
$rugs['minutes'] = $this->Rug->minutes ($this->data);
$rugs['adl']     = $this->Rug->adl ($this->data);
$rugs['sot']     = $this->Rug->sot ($this->data);

if ($rugs['sot'] == false) $current['SectionZ']['Z0100C'] = 0;
else $current['SectionZ']['Z0100C'] = 1;
?>

<style type="text/css">
  #assessments { margin-left: 3px; }
  .td_left { width: 150px; font-size: 10pt;  text-align: left; font-weight: bold; }
  .td_right { font-size: 10pt; text-align: left }
  label, input { font-size: 8pt; }
</style>
<div id="assessments">
  <div id="section">
    <h2>Create a modification</h2>
    
    <table width="100%">
    <tr>
    <td valign="top" width="48%">
      
    <h3>Current Assessment</h3>
      
    <table class="results" cellspacing="0">
      <tr>
        <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Resident</td>
        <td style="font-size: 10pt; text-align: left"><?php echo $current['Resident']['PATLNAME']; ?>, <?php echo $current['Resident']['PATFNAME']; ?></td>
      </tr>
      <tr>
        <td style="width: 150px; font-size: 10pt;  text-align: left; font-weight: bold;">Assessment Type</td>
        <td style="font-size: 10pt; text-align: left"><?php echo $this->AssessmentType->get($current); ?></td>  
      </tr>
      <tr>
        <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Facility</td>
        <td style="font-size: 10pt; text-align: left"><?php echo $current['Facility']['FNAME']; ?></td>
      </tr>
      <tr>
        <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Assessment ID #</td>
        <td style="font-size: 10pt; text-align: left"><?php echo $current['Assessment']['id']; ?></td>
      </tr>
      <?php if ($current['Assessment']['type'] != 'NT') { ?>
      <tr>
        <td style="font-size: 10pt;  text-align: left; font-weight: bold;">ARD</td>
        <td style="font-size: 10pt; text-align: left"><?php echo $current['SectionA']['A2300']; ?></td>
      </tr>
      <tr>
        <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Part A Short Stay</td>
        <td style="font-size: 10pt; text-align: left"><?php if ($rugs['sot'] == false) echo 'NO'; else echo 'YES'; ?></td>
      </tr>
      <tr>
        <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Part A Start</td>
        <td style="font-size: 10pt; text-align: left"><?php echo $current['SectionA']['A2400B']; ?></td>
      </tr>
      <tr>
        <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Entry Date</td>
        <td style="font-size: 10pt; text-align: left"><?php echo $current['SectionA']['A1600']; ?></td>
      </tr>
      <?php } ?>
    </table>
    
    </td>
    <td>&nbsp;</td>
    <td valign="top" width="48%">
      
    <h3>Reason for Modification</h3>

    <?php
    echo $this->Form->create('', array('url' => '/assessments/modify/'. $current['Assessment']['id']));

    echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
    echo $form->input('Reason.1', array('label' => 'Transcription error', 'type' => 'checkbox'));
    echo $form->input('Reason.2', array('label' => 'Data entry error', 'type' => 'checkbox'));
    echo $form->input('Reason.3', array('label' => 'Software product error', 'type' => 'checkbox'));
    echo $form->input('Reason.4', array('label' => 'Item coding error', 'type' => 'checkbox'));
    echo $form->input('Reason.5', array('label' => 'Other error requiring modification', 'type' => 'checkbox'));
    echo $form->input('Reason.6', array('label' => 'Wrong date in A2300, A2000, A1600', 'type' => 'checkbox'));
    echo $form->input('Reason.7', array('label' => 'End of Therapy - Resumption (EOT-R) date', 'type' => 'checkbox'));

    echo $this->Form->submit('Submit');
    echo $this->Form->end();
    ?>
    
    </td>
    </table>
  </div>
  
</div>