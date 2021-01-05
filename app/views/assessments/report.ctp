  
<?php echo $this->element('../assessments/_disable_inputs'); ?>
<?php 
$type = $this->AssessmentType->short($this->data);

echo $this->Form->create('Assessment', array('url' => '/assessments/report/'. $this->data['Assessment']['id'], 'id' => 'addAssessment'));
echo $this->Form->hidden('id', array('value' => $this->data['Assessment']['id']));
echo $this->Form->hidden('Assessment.item_subset', array('value' => $this->data['Assessment']['item_subset']));
echo $this->Form->hidden('assessment_id', array('value' => $this->data['Assessment']['id']));
echo $this->Form->hidden('state', array('value' => $this->data['Facility']['F_STATE']));
echo $this->Form->hidden('resident_id', array('value' => $this->data['Assessment']['resident']));
echo $this->Form->hidden('SectionA.validated', array('id' => 'SectionA-validated', 'value' => $this->data['SectionA']['validated']));
echo $this->Form->hidden('Assessment.type', array('value' => $this->data['Assessment']['type']));
echo $this->Form->hidden('age', array('id' => 'age', 'value' => $this->data['SectionA']['age']));
echo $this->Form->hidden('admitted', array('id' => 'admitted', 'value' => $this->data['SectionA']['admitted']));

echo $form->hidden('Assessment.type', array('value' => $type));


  echo $this->Form->hidden('A0050',  array('id' => 'A0050',  'value' => $this->data['SectionA']['A0050']));
  echo $this->Form->hidden('A0310A', array('id' => 'A0310A', 'value' => $this->data['SectionA']['A0310A']));
  echo $this->Form->hidden('A0310B', array('id' => 'A0310B', 'value' => $this->data['SectionA']['A0310B']));
  echo $this->Form->hidden('A0310C', array('id' => 'A0310C', 'value' => $this->data['SectionA']['A0310C']));
  echo $this->Form->hidden('A0310D', array('id' => 'A0310D', 'value' => $this->data['SectionA']['A0310D']));
  echo $this->Form->hidden('A0310E', array('id' => 'A0310E', 'value' => $this->data['SectionA']['A0310E']));
  echo $this->Form->hidden('A0310F', array('id' => 'A0310F', 'value' => $this->data['SectionA']['A0310F']));
  echo $this->Form->hidden('A0310G', array('id' => 'A0310G', 'value' => $this->data['SectionA']['A0310G']));
  echo $this->Form->hidden('A1600',  array('id' => 'A1600',  'value' => $this->data['SectionA']['A1600']));
  echo $this->Form->hidden('A2300',  array('id' => 'A2300',  'value' => $this->data['SectionA']['A2300']));
  echo $this->Form->hidden('B0100', array('id' => 'B0100',  'value' => $this->data['SectionB']['B0100']));

if ($rug_cache['sot'] == false) $this->data['SectionZ']['Z0100C'] = 0;
else $this->data['SectionZ']['Z0100C'] = 1;
?>

<div class="spacer"></div>
<?php echo $this->element('../assessments/_tabs'); ?>
<div id="assessment">
  <div id="tabs">
    <ul>
      <?php 
        $this->AvailableSection->letters(
          $this->data, 
          $this->AssessmentType->short($this->data), 
          $this->data['Facility']['F_STATE'], 
          $section, 
          $this->data['Assessment']['id']
        );
      ?>
    </ul>
  </div>
  <div id="section">
    <?php if (!in_array($this->Session->read('Auth.User.group_id'), array(9))) { ?>
      <a href="/printing/view/<?php echo $type; ?>/<?php echo $this->data['Assessment']['id']; ?>" target="new">
        <img alt="view" class="float-right" src="/img/actions/printer.png" />
      </a>
    <?php } ?>

<h2>Review &amp; Finalize Assessment</h2>

<div class="header">Validation Report</div>

<table class="results" cellspacing="0">
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Resident</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Resident']['PATLNAME']; ?>, <?php echo $this->data['Resident']['PATFNAME']; ?></td>

    <td> &nbsp; </td>
    <td style="width: 150px; font-size: 10pt;  text-align: left; font-weight: bold;">Assessment Type</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->AssessmentType->get($this->data); ?></td>  
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Facility</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Facility']['FNAME']; ?></td>
    <td> &nbsp; </td>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Assessment ID #</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Assessment']['id']; ?></td>
  </tr>
  <?php if ($type != 'NT') { ?>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">ARD</td>
    <td style="font-size: 10pt; text-align: left">
      <?php
        echo $this->data['SectionA']['A2300']; 
       ?>
    </td>
    <td> &nbsp; </td>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Part A Short Stay</td>
    <td style="font-size: 10pt; text-align: left"><?php if ($rug_cache['sot'] == false) echo 'NO'; else echo 'YES'; ?></td>
  </tr>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Part A Start</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->data['SectionA']['A2400B']; ?></td>
    <td> &nbsp; </td>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Entry Date</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->data['SectionA']['A1600']; ?></td>
        </tr>
  <?php } ?>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Lock Date</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Assessment']['lock_date']; ?></td>
    <td> &nbsp; </td>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Record Type</td>
    <td style="font-size: 10pt; text-align: left">
      <?php 
      switch ($rug_cache['type']) {
        case 1: $type = 'NEW'; break;  
        case 2: $type = 'MODIFICATION'; break;  
        case 3: $type = 'INACTIVATION'; break;  
        default: $type = '';
      }
      echo $type;
      ?>
      
    </td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Item Set</td>
    <td style="font-size: 10pt; text-align: left">
      <?php echo $rug_cache['isc']; ?>
    </td>
    <td> &nbsp; </td>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Facility</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Facility']['FNAME']; ?></td>
  </tr>
  <?php if ($type != 'NT') { ?>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Therapy Minutes</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $rug_cache['minutes_ttl']; ?></td>
    <td> &nbsp; </td>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">ADL</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $rug_cache['adl']; ?></td>
  <tr>
  </tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Therapy Score</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $rug_cache['rug_therapy'].$rug_cache['rug_hipps']; ?></td>
    <td> &nbsp; </td>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Therapy Rate *</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->Number->currency($rug_cache['rug_therapy_rate'], 'USD'); ; ?></td>
  <tr>
  </tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Non-Therapy Score</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $rug_cache['rug_nursing'].$rug_cache['rug_hipps']; ?></td>
    <td> &nbsp; </td>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Non-Therapy Rate *</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->Number->currency($rug_cache['rug_nursing_rate'], 'USD'); ; ?></td>
  </tr>
  </tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">BIMS</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['SectionC']['C0500']; ?></td>
    <td> &nbsp; </td>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">PHQ-9 &copy;</td>
    <td style="font-size: 10pt; text-align: left">
    	<?php 
    	if (
    		$this->data['SectionD']['D0100'] == 0 || 
    		$this->data['SectionD']['D0300'] == 0 || 
    		$this->data['SectionD']['D0300'] == 99
    	) {
	    	$phq = $this->data['SectionD']['D0600']; 
    	}
    	else {
	    	$phq = $this->data['SectionD']['D0300']; 
    	}
      if (empty($phq)) echo 0;
      else echo $phq;
	    ?>
    </td>
  </tr>
  <?php } ?>
  <?php if ($this->data['Assessment']['locked'] == 1) { ?>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">
      Transmission File
      <?php if ($this->data['Assessment']['transmission_status'] != 2) { ?>
       <br /> <span class="small">( <a href="/assessments/regenerate/<?php echo $this->data['Assessment']['id']; ?>/<?php echo $this->data['Facility']['F_STATE']; ?>">regenerate</a> )</span>
      <?php } ?>
    </td>
    <td style="font-size: 10pt; text-align: left">
      <a href="/transmission_files/pending/<?php echo $this->data['Assessment']['id']; ?>.xml" target="new">click here</a>
    </td>
    <td> &nbsp; </td>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">
      Transmission Status
    </td>
    <td style="font-size: 10pt; text-align: left">
      <?php
      $url = '';
      ?>
      <?php 
      // if ($this->data['Assessment']['transmission_status'] != 2 || $this->Session->read('Auth.User.id') > 3) { 
      ?>
      <select name="data['Assessment][transmission_status]"  onchange="location.href='/assessments/update/<?php echo $this->data['Assessment']['id'] ?>/'+this.options[this.selectedIndex].value">
        <option value=0 <?php if ($this->data['Assessment']['transmission_status'] == 0) echo 'selected="selected"' ?>>Not Transmitted</option>
        <option value=1 <?php if ($this->data['Assessment']['transmission_status'] == 1) echo 'selected="selected"' ?>>Transmitted</option>
        <option value=2 <?php if ($this->data['Assessment']['transmission_status'] == 2) echo 'selected="selected"' ?>>Accepted</option>
        <option value=3 <?php if ($this->data['Assessment']['transmission_status'] == 3) echo 'selected="selected"' ?>>Rejected</option>
        <option value=4 <?php if ($this->data['Assessment']['transmission_status'] == 4) echo 'selected="selected"' ?>>NSF (Not State or Federal)</option>
      </select>
      <?php 
      // } else { 
      //   echo 'Accepted';
      // }  
      ?>
    </td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="5" style="font-size: 10pt; text-align: left">
      <?php echo $this->Html->link('Print a Signature Page', array('action' => 'report', $this->data['Assessment']['id'], 'print'), array('target' => 'new')); ?>
    </td>
  </tr>
</table>
<div class="small">* This is an estimate and are based upon current information as of 10/22/2010.</div>

<?php if ( !empty($this->data['Assessment']['lock_date']) && in_array($this->Session->read('Auth.User.group_id'), array(1,2,3,6)) ) { ?>

<table class="results" cellspacing="0">
  <tr>
    <td colspan="5" style="font-size: 10pt; text-align: left">
      <?php echo $this->Html->link('Change the lock date', array('action' => 'change_lock_date', $this->data['Assessment']['id'])); ?>
    </td>
  </tr>
</table>

<?php } ?>

<?php if ($this->data['Assessment']['transmission_status'] != 1) { ?>
<div>
  <h3>Finalize Assessment</h3>
  <strong>
    Is this information correct? If this information is correct, please click finalize assessment, otherwise please go back and review the items that were 
    submitted before continuing.
  </strong>
</div>
<?php } ?>
    <?php 
        if (($this->data['Assessment']['transmission_status'] == 0) || ($this->data['Assessment']['transmission_status'] == 3)) {
          if ($this->data['Assessment']['validated'] == 1) {
            echo $this->Form->hidden('finished.end', array('value' => 1));
            echo $this->Form->submit('Finalize Assessment');
          }
          else {
            echo $this->Form->hidden('finished.validate', array('value' => 1));
            echo $this->Form->submit('Validate Assessment');
          }
        }
    ?>
  </div>
</div>
<?php echo $form->end(); ?>