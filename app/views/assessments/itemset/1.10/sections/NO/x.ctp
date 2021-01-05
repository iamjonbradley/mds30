<h2>Section X - Correction Request</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo '<div class="X0100-SKIP">';
echo $this->Html->div('', 'Identification of Record to be Modified/Inactivated <span class="normal">The following items identify the existing assessment record that is in error. In this section, reproduce the information EXACTLY as it appeared on the existing record, even if the information is incorrect. This information is necessary to locate the exist record in the National MDS Database.</span>');

echo $this->Html->div('header', 'X0150. Type of Provider');
echo $form->input('SectionX.X0150', array('label' => false, 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		1 => '1. Nursing home (SNF/NF)',
		2 => '2. Swing Bed'
	)));
	
$X0200A = (empty($this->data['SectionX']['X0200A'])) ? $this->data['SectionA']['A0500A'] : $this->data['SectionX']['X0200A'];
$X0200C = (empty($this->data['SectionX']['X0200C'])) ? $this->data['SectionA']['X0200C'] : $this->data['SectionX']['X0200C'];
$X0500 = (empty($this->data['SectionX']['X0500'])) ? $this->data['Resident']['X0500'] : $this->data['SectionX']['X0500'];

echo $this->Html->div('header', 'X0200. Name of Resident <span class="normal">on existing record to be modified/inactivated</span>');
echo $form->input('SectionX.X0200A', array('div' => 'input text float-left', 'label' => 'A. First name', 'maxLength' => 12, 'size' => 12, 'value' => $X0200A));
echo $form->input('SectionX.X0200C', array('div' => 'input text float-left', 'label' => 'C. Last name', 'maxLength' => 18, 'size' => 18, 'value' => $X0200C));

echo $this->Html->div('header', 'X0300. Gender');

echo $form->input('SectionX.X0300', array('label' => false, 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		1 => '1. Male',
		2 => '2. Female'
	)));
	
echo $this->Html->div('header', 'X0400. Birth Date');
echo $form->input('SectionX.X0400', array('label' => false, 'maxLength' => 10, 'size' => 10, 'between' => '<span class="small">Format as YYYY-MM-DD</span> <br />'));

echo $this->Html->div('header', 'X0500. Social Security Number');
echo $form->input('SectionX.X0500', array('label' => false, 'maxLength' => 9, 'size' => 9, 'value' => str_replace('-', '', $X0500)));

echo $this->Html->div('header', 'X0600. Type of Assessment <span class="normal">on existing record to be modified/inactivated</span> ');
echo $form->input('SectionX.X0600A', array('label' => 'A. Federal OBRA reason for Assessment', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		'01' => '01. Admission',
		'02' => '02. Quarterly',
		'03' => '03. Annual',
		'04' => '04. Significant change in status',
		'05' => '05. Significant correction to prior comprehensive assessment',
		'06' => '06. Significant correction to prior quarterly assessment',
		'99' => '99. Not OBRA required',
	)));
echo $form->input('SectionX.X0600B', array('label' => 'B. PPS Assessment <br /> <u>PPS Scheduled Assessments for a Medicare Part A Stay</u>', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		'01' => '01. 5-day',
		'02' => '02. 14-day',
		'03' => '03. 30-day',
		'04' => '04. 60-day',
		'05' => '05. 90-day',
		'06' => '06. Readmission/return',
		'07' => '07. Unscheduled assessment used for PPS',
		'99' => '99. Not PPS',
	)));
echo $form->input('SectionX.X0600C', array('label' => 'C. PPS Other Medicare Required Assessment - OMRA', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No',
		1 => '1. State of therapy',
		2 => '2. End of therapy',
		3 => '3. Both Start and End of therapy',
		4 => '4. Change of therapy'
	)));
echo $form->input('SectionX.X0600D', array('label' => 'D. Is this a Swing Bed clinical change assessment?', 'type' => 'select', 'selected' => 0, 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No',
		1 => '1. Yes',
	)));
echo $form->input('SectionX.X0600F', array('label' => 'F. Entry/discharge reporting?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		'01' => '01. Entry record',
		'10' => '10. Discharge assessment-return not anticipated',
		'11' => '11. Discharge assessment-return anticipated',
		'12' => '12. Death in facility record',
		'99' => '99. Not entry/discharge record',
	)));
echo '</div>';
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php

echo $this->Html->div('header X0700', 'X0700. Date on existing record to be modified/inactivated');
echo $this->Html->div('note X0700', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Complete only one');
echo $form->input('SectionX.X0700A', array('div' => 'input text float-left', 'label' => 'A. Assessment Date',  'maxLength' => 10, 'size' => 10, 'between' => '<span class="small">Format as YYYY-MM-DD</span> <br />'));
echo $form->input('SectionX.X0700B', array('div' => 'input text float-left', 'label' => 'B. Discharge Date',  'maxLength' => 10, 'size' => 10, 'between' => '<span class="small">Format as YYYY-MM-DD</span> <br />'));
echo $form->input('SectionX.X0700C', array('div' => 'input text float-left', 'label' => 'C. Entry Date',  'maxLength' => 10, 'size' => 10, 'between' => '<span class="small">Format as YYYY-MM-DD</span> <br />'));

echo $this->Html->div('header X0800', 'Correction Attestation Section');
echo $this->Html->div('header X0800', 'X0800. Correction Number');
echo $form->input('SectionX.X0800', array('label' => 'Enter the number of correction requests to modify/inactivate the existing record, including the present one', 'maxLength' => 2, 'size' => 2));

echo $this->Html->div('header X0900' , 'X0900. Reasons for Modification');
echo $this->Html->div('note X0900', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $form->input('SectionX.X0900A', array('label' => 'A. Transcription error', 'type' => 'checkbox'));
echo $form->input('SectionX.X0900B', array('label' => 'B. Data entry error', 'type' => 'checkbox'));
echo $form->input('SectionX.X0900C', array('label' => 'C. Software product error', 'type' => 'checkbox'));
echo $form->input('SectionX.X0900D', array('label' => 'D. Item coding error', 'type' => 'checkbox'));
echo $form->input('SectionX.X0900E', array('label' => 'E. End of Therapy - Resumption (EOT-R) date', 'type' => 'checkbox'));
echo $form->input('SectionX.X0900Z', array('label' => 'Z. Other error requiring modification', 'type' => 'checkbox'));

echo $this->Html->div('header X1050', 'X1050. Reasons for Inactivation');
echo $this->Html->div('note X1050', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $form->input('SectionX.X1050A', array('label' => 'A. Event did not occur', 'type' => 'checkbox'));
echo $form->input('SectionX.X1050Z', array('label' => 'Z. Other error requiring inactivation', 'type' => 'checkbox'));

echo $this->Html->div('header X1100', 'X1100. RN Assessment Coordinator Attestation of Completion');
echo $form->input('SectionX.X1100A', array('div' => 'input text float-left', 'label' => 'A. First name', 'maxLength' => 12, 'size' => 12));
echo $form->input('SectionX.X1100B', array('div' => 'input text float-left', 'label' => 'B. Last Name', 'maxLength' => 18, 'size' => 18));
echo $form->input('SectionX.X1100C', array('div' => 'input text float-left', 'label' => 'C. Title', 'maxLength' => 10, 'size' => 10));
echo $form->input('SectionX.X1100E', array('div' => 'input date float-left', 'label' => 'E. Date',  'maxLength' => 10, 'size' => 10, 'between' => '<span class="small">Format as YYYY-MM-DD</span> <br />'));
?>	
</td>
</tr>
</table>