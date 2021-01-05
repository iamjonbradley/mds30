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
// echo $this->Html->div('header', 'Cancer Treatments');

// echo $this->Html->div('misc', 'A. Chemotherapy', array('style' => 'margin-left: 0;'));

// echo $form->input('SectionO.O0100A1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
// echo $form->input('SectionO.O0100A2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

// echo $this->Html->div('misc', 'B. Radiation', array('style' => 'margin-left: 0;'));
// echo $form->input('SectionO.O0100B1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
// echo $form->input('SectionO.O0100B2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

// echo $this->Html->div('header', 'Respiratory Treatments');

// echo $this->Html->div('misc', 'C. Oxygen therapy', array('style' => 'margin-left: 0;'));
// echo $form->input('SectionO.O0100C1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
// echo $form->input('SectionO.O0100C2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

// echo $this->Html->div('misc', 'D. Suctioning', array('style' => 'margin-left: 0;'));
// echo $form->input('SectionO.O0100D1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
// echo $form->input('SectionO.O0100D2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('misc', 'E. Tracheostomy care', array('style' => 'margin-left: 0;'));
// echo $form->input('SectionO.O0100E1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
echo $form->input('SectionO.O0100E2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('misc', 'F. Ventilator or respirator', array('style' => 'margin-left: 0;'));
// echo $form->input('SectionO.O0100F1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
echo $form->input('SectionO.O0100F2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

// echo $this->Html->div('misc', 'G. BiPAP/CPAP', array('style' => 'margin-left: 0;'));
// echo $form->input('SectionO.O0100G1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
// echo $form->input('SectionO.O0100G2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

// echo $this->Html->div('header', 'Other');

// echo $this->Html->div('misc', 'H. IV medications', array('style' => 'margin-left: 0;'));
// echo $form->input('SectionO.O0100H1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
// echo $form->input('SectionO.O0100H2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

// echo $this->Html->div('misc', 'I. Transfusions', array('style' => 'margin-left: 0;'));
// echo $form->input('SectionO.O0100I1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
// echo $form->input('SectionO.O0100I2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

// echo $this->Html->div('misc', 'J. Dialysis', array('style' => 'margin-left: 0;'));
// echo $form->input('SectionO.O0100J1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
// echo $form->input('SectionO.O0100J2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('misc', 'K. Hospice care', array('style' => 'margin-left: 0;'));
// echo $form->input('SectionO.O0100K1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
echo $form->input('SectionO.O0100K2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

// echo $this->Html->div('misc', 'L. Respite care', array('style' => 'margin-left: 0;'));
// echo $form->input('SectionO.O0100L1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
// echo $form->input('SectionO.O0100L2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('misc', 'M. Isolation of quarantine for active infectious disease <span class="normal">(does not include standard body/fluid precautions)</span>', array('style' => 'margin-left: 0;'));
// echo $form->input('SectionO.O0100M1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
echo $form->input('SectionO.O0100M2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

// echo $this->Html->div('header', 'None of the Above');

// echo $this->Html->div('misc', 'Z. None of the above', array('style' => 'margin-left: 0;'));
// echo $form->input('SectionO.O0100Z1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
// echo $form->input('SectionO.O0100Z2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('header', 'O0250. Influenza Vaccine - <span class="normal">Refer to current version of RAI manual for current flu season and reporting period</span>');
echo $form->input('SectionO.O0250A', array('label' => 'A. <span class="normal">Did the</span> resident received the Influenza vaccine in this facility <span class="normal">for this year\'s influenza season?</span>', 'type' => 'select', 'escape' => false, 'empty' => '( select an option )', 'options' => array(
		0 => '0. No',
		1 => '1. Yes'
	)));

echo $form->input('SectionO.O0250B', array('label' => 'B. Date vaccine received:', 'type' => 'text', 'between' => 'Format as YYYY-MM-DD<br />', 'maxLength' => 10, 'size' => 10));
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

echo $this->Html->div('header', 'O0600. Physician Examinations');
echo $form->input('SectionO.O0600', array('label' => '<span class="normal">Over the last 14 days,</span> on how many days did the physician (or authorized assistant or practioner) examine the resident?', 'maxLength' => 2, 'size' => 2));

echo $this->Html->div('header', 'O0700. Physician Orders');
echo $form->input('SectionO.O0700', array('label' => '<span class="normal">Over the last 14 days,</span> on how many days did the physician (or authorized assistant or practioner) change the resident\'s orders?', 'maxLength' => 2, 'size' => 2));



?>
</td>
</table>