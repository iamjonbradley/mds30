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
	
echo $this->Html->div('Q0300 header', 'Q0300. Resident\'s Overall Expectation');

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

?>	
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header Q0400', 'Q0400. Discharge Plan');
echo $this->Form->input('SectionQ.Q0400A', array('id' => 'Q0400A', 'label' => 'A. Is there an active discharge plan in place for the resident to return to the community', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. No',
    1 => '1. Yes'
  )));
echo $this->Form->input('SectionQ.Q0400B', array('id' => 'Q0400B', 'label' => 'B. What determination was made by the resident and the care planning team regarding discharge to the community', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. Determination not made',
    1 => '1. Discharge to community determined to be feasible',
    2 => '2. Discharge to community determined to be not feasible'
  )));
  
echo $this->Html->div('header Q0500', 'Q0500. Return to Community');
echo $this->Form->input('SectionQ.Q0500A', array('div' => 'input select Q0500A', 'label' => 'A. Has the resident been asked about returning to the community', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No',
		1 => '1. Yes - previous response was "no"',
		2 => '2. Yes - previous response was "yes"',
		3 => '3. Yes - previous response was "unknown"'
	)));
echo $this->Form->input('SectionQ.Q0500B', array('div' => 'input select Q0500B', 'label' => 'B. Ask the resident <span class="normal">(or family or significant other if resident is unable to respond):</span> "Do you want to talk to someone about the possibility of returning to the community?"', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. No',
    1 => '1. Yes',
		9 => '9. Unknown or uncertain',
	)));

echo $this->Html->div('header Q0600', 'Q0600. Referral');
echo $this->Form->input('SectionQ.Q0600', array('legend' => 'Has a referral been made to the local contact agency?', 'type' => 'radio', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No - determination has been made by the resident and the care planning team that contact is not required',
		1 => '1. No - referral not made',
		2 => '2. Yes',
	)));


?>	
</td>
</table>