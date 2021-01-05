<h2>Section O - Special Treatments and Procedures</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'O0100. Special Treatments, Procedures and Programs');
$options = array(
	1 => 'While NOT a Resident',
	2 => 'While a Resident'	
);

echo $this->Html->div('misc', 'K. Hospice care', array('style' => 'margin-left: 0;'));
echo $form->input('SectionO.O0100K2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('header', 'O0250. Influenza Vaccine - <span class="normal">Refer to current version of RAI manual for current flu season and reporting period</span>');
echo $form->input('SectionO.O0250A', array('label' => 'A. <span class="normal">Did the</span> resident received the Influenza vaccine in this facility <span class="normal">for this year\'s influenza season?</span>', 'type' => 'select', 'escape' => false, 'empty' => '( select an option )', 'options' => array(
		0 => '0. No',
		1 => '1. Yes'
	)));

echo $form->input('SectionO.O0250C', array('label' => 'C. If Influenza vaccine not received, state reason', 'type' => 'select', 'escape' => false, 'empty' => '( select an option )', 'options' => array(
		1 => '1. Resident not in facility during this year\'s flu season',
		2 => '2. received outside of this facility',
		3 => '3. Not eligible - medical contraindication',
		4 => '4. Offered and declined',
		5 => '5. Not offered',
		6 => '6. Inability to obtain vaccine due to declared shortage',
		9 => '9. None of the above'
	)));
	
echo $this->Html->div('header', 'O0300. Pneumococcal Vaccine');
echo $form->input('SectionO.O0300A', array('label' => 'A. Is the resident\'s Pneumococcal vaccination up to date?', 'type' => 'select', 'escape' => false, 'empty' => '( select an option )', 'options' => array(
		0 => '0. No',
		1 => '1. Yes'
	)));	
echo $form->input('SectionO.O0300B', array('label' => 'B. If Pneumococcal vaccine not received, state reason', 'type' => 'select', 'escape' => false, 'empty' => '( select an option )', 'options' => array(
		1 => '1. Not eligible - medical contraindication',
		2 => '2. Offered and declined',
		3 => '3. Not offered'
	)));	
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php

echo $this->Html->div('header O0400', 'O0400. Therapies');
echo $this->Html->div('header O0400A', 'A. Speech-Language Pathology and Audiology Services');
echo $this->Form->input('SectionO.O0400A4', array('label' => 'A4. Days', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $this->Form->input('SectionO.O0400A5', array('label' => 'A5. Therapy start date', 'div' => 'input date float-left', 'type' => 'text', 'maxLength' => 10, 'size' => 10));
echo $this->Form->input('SectionO.O0400A6', array('label' => 'A6. Therapy end date - enter 8 dashes if ongoing', 'div' => 'input date float-left', 'type' => 'text', 'maxLength' => 10, 'size' => 10));

echo $this->Html->div('header O0400B', 'B. Occupational Therapy');
echo $this->Form->input('SectionO.O0400B4', array('label' => 'B4. Days', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $this->Form->input('SectionO.O0400B5', array('label' => 'B5. Therapy start date', 'div' => 'input date float-left', 'type' => 'text', 'maxLength' => 10, 'size' => 10));
echo $this->Form->input('SectionO.O0400B6', array('label' => 'B6. Therapy end date - enter 8 dashes if ongoing', 'div' => 'input date float-left', 'type' => 'text', 'maxLength' => 10, 'size' => 10));

echo $this->Html->div('header O0400C', 'C. Physical Therapy');
echo $this->Form->input('SectionO.O0400C4', array('label' => 'C4. Days', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $this->Form->input('SectionO.O0400C5', array('label' => 'C5. Therapy start date', 'div' => 'input date float-left', 'type' => 'text', 'maxLength' => 10, 'size' => 10));
echo $this->Form->input('SectionO.O0400C6', array('label' => 'C6. Therapy end date - enter 8 dashes if ongoing', 'div' => 'input date float-left', 'type' => 'text', 'maxLength' => 10, 'size' => 10));

?>
</td>
</table>