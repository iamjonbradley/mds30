<h2>Section Q - Participation in Assessment</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
$A0310E = '';
echo $this->Form->hidden('A0310E', array('value' => $this->data['SectionA']['A0310E'], 'id' => 'A0310E'));
echo $this->Html->div('header', 'Q0100. Participation in Assessment');
echo $this->Form->input('SectionQ.Q0100A', array('label' => 'A. Resident participated in assessment', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No',
		1 => '1. Yes'
	)));
echo $this->Form->input('SectionQ.Q0100B', array('label' => 'B. Family or significant other participated in assessment', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. No',
    1 => '1. Yes',
		9 => '9. No family or signification other'
	)));
echo $this->Form->input('SectionQ.Q0100C', array('label' => 'C. Guardian or legally authorized representative participated in assessment', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. No',
    1 => '1. Yes',
		9 => '9. No guardian or legally authorized representative'
	)));
	
echo $this->Html->div('header Q0300', 'Q0300. Resident\'s Overall Expectation');
echo $this->Form->input('SectionQ.Q0300A', array('label' => 'A. Resident\'s overall goal established during assessment process', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    1 => '1. Expects to be discharged to the community',
    2 => '2. Expects to remain in this facility',
    3 => '3. Expects to be discharged to another facility/institution',
    9 => '9. Unknown or uncertain'
  )));
echo $this->Form->input('SectionQ.Q0300B', array('label' => 'B. Indicate information source for Q0300A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    1 => '1. Resident',
    2 => '2. Family or significant other',
    3 => '3. Guardian or legally authorized representative',
    9 => '9. None of the above'
  )));

echo $this->Html->div('header', 'Q0400. Discharge Plan');
echo $this->Form->input('SectionQ.Q0400A', array('label' => 'A. Is there an active discharge plan in place for the resident to return to the community', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. No',
    1 => '1. Yes'
  )));
?>	
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php

echo $this->Html->div('header Q0490', 'Q0490. Resident\'s Preference to Avoid Being Asked Question Q0500B.');
echo $this->Form->input('SectionQ.Q0490', array('label' => 'Does the resident\'s clinical record document a request that this question be asked only on comprehensive assessments?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. No',
    1 => '1. Yes',
    8 => '8. Information not available.'
  )));
  
echo $this->Html->div('header Q0500', 'Q0500. Return to Community');
echo $this->Form->input('SectionQ.Q0500B', array('label' => 'B. Ask the resident <span class="normal">(or family or significant other if resident is unable to respond):</span> "Do you want to talk to someone about the possibility of returning to the community?"', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. No',
    1 => '1. Yes',
		9 => '9. Unknown or uncertain',
	)));

echo $this->Html->div('header Q0550', 'Q0550. Resident\'s Preference to Avoid Being Asked Question Q0500B Again.');
echo $this->Form->input('SectionQ.Q0550A', array( 'label' => 'A. Does the resident (or family or significant other or guardian, if resident is unable to respond) want to be asked about returning to the community on all assessments? (Rather than only on comprehensive assessments.', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. No',
    1 => '1. Yes',
    8 => '8. Information not available.',
  )));echo $this->Form->input('SectionQ.Q0550B', array('label' => 'B. Indicate information source for Q0550A.', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    1 => '1. Resident',
    2 => '2. If not resident, then family or significant other',
    3 => '3. If not resident, family or significant other, then guardian or legally authorized representative',
    8 => '8. No information source available',
  )));

echo $this->Html->div('header', 'Q0600. Referral');
echo $this->Form->input('SectionQ.Q0600', array('legend' => 'Has a referral been made to the local contact agency?', 'type' => 'radio', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No - determination has been made by the resident and the care planning team that contact is not required',
		1 => '1. No - referral not made',
		2 => '2. Yes',
	)));


?>	
</td>
</table>