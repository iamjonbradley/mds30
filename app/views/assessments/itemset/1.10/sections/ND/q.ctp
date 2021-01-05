<h2>Section Q - Participation in Assessment</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php

	
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
echo $form->input('SectionQ.Q0400A', array('id' => 'Q0400A', 'label' => 'A. Is there an active discharge plan in place for the resident to return to the community', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. No',
    1 => '1. Yes'
  )));
?>	
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'Q0600. Referral');
echo $form->input('SectionQ.Q0600', array('legend' => 'Has a referral been made to the local contact agency?', 'type' => 'radio', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No - determination has been made by the resident and the care planning team that contact is not required',
		1 => '1. No - referral not made',
		2 => '2. Yes',
	)));

?>	
</td>
</table>