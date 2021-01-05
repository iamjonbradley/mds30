
<style type="text/css">
  table.results tr td.align-middle { text-align: center; vertical-align: middle; }
</style>

<div class="spacer"></div>
<div id="assessment">
  <div id="section">

<h2>Assessment Review</h2>

<table>
  <tr>
    <td valign="top">
      <table class="results" cellspacing="0">
        <tr>
          <th style="font-size: 11pt;" colspan="2">Assessment Details</th>
        </tr>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Facility</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Facility']['FNAME']; ?></td>
        </tr>
        <tr>
          <td style="width: 150px; font-size: 10pt;  text-align: left; font-weight: bold;">Assessment Type</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->AssessmentType->get($this->data); ?></td>
        </tr>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Resident</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Resident']['PATLNAME']; ?>, <?php echo $this->data['Resident']['PATFNAME']; ?></td>
        </tr>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Assessment ID #</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Assessment']['id']; ?></td>
        </tr>
        <?php if ($this->data['RugCache']['isc'] != 'NT') { ?>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">ARD</td>
          <td style="font-size: 10pt; text-align: left">
            <?php
              echo $this->data['SectionA']['A2300']; 
             ?>
          </td>
        </tr>
        <?php } ?>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Lock Date</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Assessment']['lock_date']; ?></td>
        </tr>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Entry Date</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->data['SectionA']['A1600']; ?></td>
        </tr>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Record Type</td>
          <td style="font-size: 10pt; text-align: left">
            <?php 
            switch ($this->data['RugCache']['type']) {
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
          <td style="font-size: 10pt; text-align: left"><?php echo $this->data['RugCache']['isc']; ?></td>
        </tr>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">
            Transmission Status
          </td>
          <td style="font-size: 10pt; text-align: left">
            <?php if ($this->data['Assessment']['transmission_status'] == 0) echo 'Not Transmitted'; ?>
            <?php if ($this->data['Assessment']['transmission_status'] == 1) echo 'Transmitted'; ?>
            <?php if ($this->data['Assessment']['transmission_status'] == 2) echo 'Accepted'; ?>
            <?php if ($this->data['Assessment']['transmission_status'] == 3) echo 'Rejected'; ?>
            <?php if ($this->data['Assessment']['transmission_status'] == 4) echo 'NSF (Not State or Federal)'; ?>
          </td>
        </tr>
      </table>
    </td>
    <td valign="top">
      <table class="results" cellspacing="0">
        <?php if ($type != 'NT') { ?>
        <tr>
          <th style="font-size: 11pt;" colspan="2">Billing Details</th>
        </tr>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Part A Short Stay</td>
          <td style="font-size: 10pt; text-align: left"><?php if ($this->data['RugCache']['sot'] == false) echo 'NO'; else echo 'YES'; ?></td>
        </tr>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Therapy Minutes</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->data['RugCache']['minutes_ttl']; ?></td>
        </tr>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">ADL</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->data['RugCache']['adl']; ?></td>
        </tr>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Therapy Score</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->data['RugCache']['rug_therapy']; ?></td>
        </tr>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Therapy Rate *</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->Number->currency($this->data['RugCache']['rug_therapy_rate'], 'USD'); ; ?></td>
        </tr>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Non-Therapy Score</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->data['RugCache']['rug_nursing']; ?></td>
        </tr>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Non-Therapy Rate *</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->Number->currency($this->data['RugCache']['rug_nursing_rate'], 'USD'); ; ?></td>
        </tr>
	  </tr>
	  <tr>
	    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">BIMS</td>
	    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['SectionC']['C0500']; ?></td>
	  </tr>
	  <tr>
	    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">PHQ-9 &copy;</td>
	    <td style="font-size: 10pt; text-align: left">
	    	<?php 
	    	if (
	    		$this->data['SectionD']['D0100'] == 0 || 
	    		$this->data['SectionD']['D0300'] == 0 || 
	    		$this->data['SectionD']['D0300'] == 99
	    	) {
		    	echo $this->data['SectionD']['D0600']; 
	    	}
	    	else {
		    	echo $this->data['SectionD']['D0300']; 
	    	}
		    ?>
	    </td>
	  </tr>
        <?php } ?>
        <tr>
          <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Part A Start</td>
          <td style="font-size: 10pt; text-align: left"><?php echo $this->data['SectionA']['A2400B']; ?></td>
        </tr>
      </table>
    </td>
  </tr>
</table>


<h2>Signature Sheet</h2>

<table cellspacing="0" cellpadding="4" class="results">
<tr>
  <th class="header-signature">&nbsp;&nbsp;</th>
  <th class="header-signature">Signature</th>
  <th class="header-signature">Title</td>
  <th class="header-signature">Sections</th>
  <th class="header-signature">Date</th>
</tr>

<?php
$letters = array(
  'A','B','C','D', 
  'E','F','G','H', 
  'I','J','K','L', 
);

foreach ($letters as $key => $value) {
?>

<tr>
  <td class="align-middle"><?php echo $value; ?>.</td>
  <td class="align-middle"><?php echo $form->input('SectionZ.Z0400'. $value .'1', array('label' => false, 'div' => false, 'maxLength' => 30, 'size' => 30)) ?></td>
  <td class="align-middle"><?php echo $form->input('SectionZ.Z0400'. $value .'2', array('label' => false, 'div' => false, 'maxLength' => 10, 'size' => 10)) ?></td>
  <td class="align-middle"><?php echo $form->input('SectionZ.Z0400'. $value .'3', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)) ?></td>
  <td class="align-middle"><?php echo $form->input('SectionZ.Z0400'. $value .'4', array('label' => false, 'div' => false, 'maxLength' => 15, 'size' => 15)) ?></td>
</tr>
<?php } ?>

</table>

<table cellspacing="0" cellpadding="4" class="results">
<tr>
<td>
<?php
echo $this->Html->div('header', 'Z0500. Signature of RN assessment Coordinator Verify Assessment Completion');
echo $form->input('SectionZ.Z0500A', array('label' => 'A. Signature', 'maxLength' => 30, 'size' => 30, 'div' => 'input text float-left'));
echo $form->input('SectionZ.Z0500B', array('label' => 'B. Date', 'type' => 'text', 'maxLength' => 12, 'size' => 12, 'div' => 'input text float-left', 'disabled' => 'disabled', 'value' => $this->data['Assessment']['lock_date']));
?>
</td>
</tr>
</table>