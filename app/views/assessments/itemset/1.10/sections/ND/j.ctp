<h2>Section J - Health Conditions</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header J0100', 'J0100. Pain Management - <span class="normal">Complete for all residents, regardless of current pain level</span>');
echo $this->Html->div('J0100', 'At any time in the last <strong>5</strong> days, has the resident:');
echo $this->Form->input('SectionJ.J0100A', array('label' => 'A. Been on a scheduled pain medication regimen?', 'id' => 'J0100A', 'type' => 'select', 'empty' => ' ', 'options' => array(0 => '0. No', 1 => '1. Yes')));
echo $this->Form->input('SectionJ.J0100B', array('label' => 'B. Received PRN pain medications OR was offered and declined?', 'id' => 'J0100B', 'type' => 'select', 'empty' => ' ', 'options' => array(0 => '0. No', 1 => '1. Yes')));
echo $this->Form->input('SectionJ.J0100C', array('label' => 'C. Received non-medication intervention for pain?', 'id' => 'J0100C', 'type' => 'select', 'empty' => ' ', 'options' => array(0 => '0. No', 1 => '1. Yes')));

echo $this->Html->div('header J0200', 'J0200. Should Pain Assessment Interview be Conducted? <br /> <span class="normal">Attempt to conduct interview with all residents. If resident is comatose, skip to J1100, Shortness of Breath (dyspnea)</strong>');
echo $this->Form->input('SectionJ.J0200', array('label' => false, 'id' => 'J0200', 'type' => 'select', 'empty' => ' ', 'options' => array(0 => '0. No', 1 => '1. Yes')));

echo $this->Html->div('header J0300', 'Pain Assessment Interview');
echo $this->Html->div('header J0300', 'J0300. Pain Presence');
echo $this->Form->input('SectionJ.J0300', array('label' => '<span class="normal">Ask Resident</span> "Have you had pain or hurting at any time <span class="normal">in the last 5 days?"</span>', 'id' => 'J0300', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes', 
		9 => '9. Unable to answer', 
	)));

echo $this->Html->div('header J0400', 'J0400. Pain Frequency');
echo $this->Form->input('SectionJ.J0400', array('label' => '<span class="normal">Ask Resident</span> "How much of the time have you experianced pain or hurting <span class="normal">in the last 5 days?"</span>', 'id' => 'J0400', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		1 => '1. Almost constantly', 
		2 => '2. Frequently', 
		3 => '3. Occasionally', 
		4 => '4. Rarely', 
		9 => '9. Unable to answer', 
	)));
	
echo $this->Html->div('header J0500', 'J0500. Pain Effect on Function');
echo $this->Form->input('SectionJ.J0500A', array('label' => '<span class="normal">Ask Resident: "Over the past 5 days,</span> has pain made it hard for you to sleep at night?"', 'id' => 'J0500A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes', 
		9 => '9. Unable to answer', 
	)));

echo $this->Form->input('SectionJ.J0500B', array('label' => '<span class="normal">Ask Resident: "Over the past 5 days,</span> have you limited your day-to-day activities because of pain?"', 'id' => 'J0500B', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes', 
		9 => '9. Unable to answer', 
	)));

echo $this->Html->div('header J0600', 'J0600. Pain Intensity - <span class="normal">Administer</span> of the following pain intensity questions (A or B)');
echo $this->Html->div('J0600', 'Ask Resident: <em>"Please rate your worst pain over the last 5 days on a zero to ten scale, with zero being no pain and ten as the worst pain you can imagine." (Show resident 00 - 10 pain scale)</em> (show');
echo $this->Form->input('SectionJ.J0600A', array('label' => 'A. Numeric Rating Scale', 'id' => 'J0600A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		'00' => '00', 
		'01' => '01',
		'02' => '02',
		'03' => '03',
		'04' => '04',
		'05' => '05',
		'06' => '06',
		'07' => '07',
		'08' => '08',
		'09' => '09',
		'10' => '10',
	)));
echo $this->Html->div('J0600', 'Ask Resident: <em>"Please rate the intesity of your worst pain over the last 5 days." (Show resident verbal scale)</em> (show');
echo $this->Form->input('SectionJ.J0600B', array('label' => 'B. Verbal Descriptor Scale', 'id' => 'J0600B', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		1 => '1. Mild', 
		2 => '2. Moderate',
		3 => '3. Severe',
		4 => '4. Very Severe, horrible',
		9 => '9. Unable to answer',
	)));
echo $this->Html->div('header J0700', 'J0700. Should the Staff Assessment for Pain be Conducted?');
echo $this->Form->input('SectionJ.J0700', array('label' => false, 'id' => 'J0700', 'div' => 'input select J0700', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes',
	)));

?>
</td> 
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php

echo $this->Html->div('header J1100', 'Other Health Conditions');
echo $this->Html->div('header J1100', 'J1100. Shortness of Breath (dyspnea)');
echo $this->Html->div('note J1100', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $this->Form->input('SectionJ.J1100A', array('label' => 'A. Shortness of breath <span class="normal">or trouble breathing</span> with exertion (e.g., walking, bathing, transferring)', 'type' => 'checkbox'));
echo $this->Form->input('SectionJ.J1100B', array('label' => 'B. Shortness of breath <span class="normal">or trouble breathing</span> when sitting at rest', 'type' => 'checkbox'));
echo $this->Form->input('SectionJ.J1100C', array('label' => 'C. Shortness of breath <span class="normal">or trouble breathing</span> when lying flat', 'type' => 'checkbox'));
echo $this->Form->input('SectionJ.J1100Z', array('label' => 'Z. None of the above', 'type' => 'checkbox'));
	
echo $this->Html->div('header J1400', 'J1400. Prognosis');
echo $this->Html->div('J1400', 'Does the resident have a condition or chronic disease that may result in a <strong>life expectancy of less than 6 months?</strong> (requires physician documentation)');
echo $this->Form->input('SectionJ.J1400', array('label' => false, 'id' => 'J1400', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes',
	)));

echo $this->Html->div('header J1550', 'J1550. Problem conditions');
echo $this->Html->div('note J1550', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $this->Form->input('SectionJ.J1550A', array('label' => 'Fever', 'type' => 'checkbox'));
echo $this->Form->input('SectionJ.J1550B', array('label' => 'Vomiting', 'type' => 'checkbox'));
echo $this->Form->input('SectionJ.J1550C', array('label' => 'Dehydrated', 'type' => 'checkbox'));
echo $this->Form->input('SectionJ.J1550D', array('label' => 'Internal bleeding', 'type' => 'checkbox'));
echo $this->Form->input('SectionJ.J1550Z', array('label' => 'None of the above', 'type' => 'checkbox'));

echo $this->Html->div('header J1700', 'J1700. Fall History on Admission');

echo $this->Form->input('SectionJ.J1700A', array('label' => 'A. <span class="normal">Did the resident have a fall any time in the </span>last month <span class="normal">prior to admission?</span>', 'id' => 'J1700A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes',
		9 => '9. Unable to determine',
	)));
	
echo $this->Form->input('SectionJ.J1700B', array('label' => 'B. <span class="normal">Did the resident have a fall any time in the </span>last 2-6 months <span class="normal">prior to admission?</span>', 'id' => 'J1700B', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes',
		9 => '9. Unable to determine',
	)));
	
echo $this->Form->input('SectionJ.J1700C', array('label' => 'C. <span class="normal">Did the resident have any </span>fracture related to a fall in the 6 months <span class="normal">prior to admission?</span>', 'id' => 'J1700C', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes',
		9 => '9. Unable to determine',
	)));
echo '</div>';

echo $this->Html->div('header J1800', 'J1800. <strong>Any Falls Since Admission or Prior Assessment (OBRA, PPS, Discharge),</strong> which ever is more recent');
echo $this->Form->input('SectionJ.J1800', array('label' => '<span class="normal">Has the resident </span>had any falls since admission or prior assessment<span class="normal"> (OBRA, PPS, or Discharge), whichever is more recent?</span>', 'id' => 'J1800', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes',
	)));

echo $this->Html->div('header J1900', 'J1900. Number of Falls Since Admission or Prior Assesment (OBRA, PPS, or Discharge), <span class="normal">whichever is more recent</span>');

echo $this->Form->input('SectionJ.J1900A', array('label' => 'A. No injury - <span class="normal">no evidence of any injury is noted on physical assessment by the nurse or primary care clinician; no complaints of pain or injury by the resident; no change in the resident\'s behavior is noted after the fall</span>', 'id' => 'J1900A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. None', 
		1 => '1. One',
		2 => '2. Two or more',
	)));
	
echo $this->Form->input('SectionJ.J1900B', array('label' => 'B. Injury (except major) - <span class="normal">skin tears, abrasions, lacerations, superficial bruises, hematomas and sprains; or any fall-related injury that causes the resident to complain of pain</span>', 'id' => 'J1900B', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. None', 
		1 => '1. One',
		2 => '2. Two or more',
	)));
	
echo $this->Form->input('SectionJ.J1900C', array('label' => 'C. Major Injury - <span class="normal">bone fractures, joint dislocations, closed head injuries with altered conciousness, subdural hematoma</span>', 'id' => 'J1900C', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. None', 
		1 => '1. One',
		2 => '2. Two or more',
	)));
echo '</div>';
?>
</td>
</table>