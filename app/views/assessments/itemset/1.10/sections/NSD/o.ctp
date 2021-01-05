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
/**
echo $this->Html->div('header', 'Cancer Treatments');

echo $this->Html->div('misc', 'A. Chemotherapy', array('style' => 'margin-left: 0;'));

echo $form->input('SectionO.O0100A1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
echo $form->input('SectionO.O0100A2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('misc', 'B. Radiation', array('style' => 'margin-left: 0;'));
echo $form->input('SectionO.O0100B1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
echo $form->input('SectionO.O0100B2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
*/

echo $this->Html->div('header', 'Respiratory Treatments');

/**
echo $this->Html->div('misc', 'C. Oxygen therapy', array('style' => 'margin-left: 0;'));
echo $form->input('SectionO.O0100C1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
echo $form->input('SectionO.O0100C2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('misc', 'D. Suctioning', array('style' => 'margin-left: 0;'));
echo $form->input('SectionO.O0100D1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
echo $form->input('SectionO.O0100D2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
*/

echo $this->Html->div('misc', 'E. Tracheostomy care', array('style' => 'margin-left: 0;'));
echo $form->input('SectionO.O0100E1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
echo $form->input('SectionO.O0100E2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('misc', 'F. Ventilator or respirator', array('style' => 'margin-left: 0;'));
echo $form->input('SectionO.O0100F1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
echo $form->input('SectionO.O0100F2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

/**
echo $this->Html->div('misc', 'G. BiPAP/CPAP', array('style' => 'margin-left: 0;'));
echo $form->input('SectionO.O0100G1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
echo $form->input('SectionO.O0100G2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
*/

echo $this->Html->div('header', 'Other');

/**
echo $this->Html->div('misc', 'H. IV medications', array('style' => 'margin-left: 0;'));
echo $form->input('SectionO.O0100H1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
echo $form->input('SectionO.O0100H2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('misc', 'I. Transfusions', array('style' => 'margin-left: 0;'));
echo $form->input('SectionO.O0100I1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
echo $form->input('SectionO.O0100I2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('misc', 'J. Dialysis', array('style' => 'margin-left: 0;'));
echo $form->input('SectionO.O0100J1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
echo $form->input('SectionO.O0100J2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
*/

echo $this->Html->div('misc', 'K. Hospice care', array('style' => 'margin-left: 0;'));
echo $form->input('SectionO.O0100K1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
echo $form->input('SectionO.O0100K2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

/**
echo $this->Html->div('misc', 'L. Respite care', array('style' => 'margin-left: 0;'));
// echo $form->input('SectionO.O0100L1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
echo $form->input('SectionO.O0100L2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
*/
echo $this->Html->div('misc', 'M. Isolation of quarantine for active infectious disease <span class="normal">(does not include standard body/fluid precautions)</span>', array('style' => 'margin-left: 0;'));
echo $form->input('SectionO.O0100M1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
echo $form->input('SectionO.O0100M2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

/**

echo $this->Html->div('header', 'None of the Above');
echo $this->Html->div('misc', 'Z. None of the above', array('style' => 'margin-left: 0;'));
echo $form->input('SectionO.O0100Z1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
echo $form->input('SectionO.O0100Z2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
*/

echo $this->Html->div('header', 'O0250. Influenza Vaccine - <span class="normal">Refer to current version of RAI manual for current flu season and reporting period</span>');
echo $form->input('SectionO.O0250A', array('label' => 'A. <span class="normal">Did the</span> resident received the Influenza vaccine in this facility <span class="normal">for this year\'s influenza season?</span>', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No',
		1 => '1. Yes'
	)));

echo $form->input('SectionO.O0250B', array('label' => 'B. Date vaccine received:', 'type' => 'text', 'between' => 'Format as YYYY-MM-DD <br />', 'maxLength' => 10, 'size' => 10));
echo $form->input('SectionO.O0250C', array('label' => 'C. If Influenza vaccine not received, state reason', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		1 => '1. Resident not in facility during this year\'s flu season',
		2 => '2. received outside of this facility',
		3 => '3. Not eligible - medical contraindication',
		4 => '4. Offered and declined',
		5 => '5. Not offered',
		6 => '6. Inability to obtain vaccine due to declared shortage',
		9 => '9. None of the above'
	)));
	
echo $this->Html->div('header', 'O0300. Pneumococcal Vaccine');
echo $form->input('SectionO.O0300A', array('label' => 'A. Is the resident\'s Pneumococcal vaccination up to date?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No',
		1 => '1. Yes'
	)));	
echo $form->input('SectionO.O0300B', array('label' => 'B. If Pneumococcal vaccine not received, state reason', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		1 => '1. Not eligible - medical contraindication',
		2 => '2. Offered and declined',
		3 => '3. Not offered'
	)));	
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php

echo $this->Html->div('header', 'O0400. Therapies');
echo $this->Html->div('header', 'A. Speech-Language Pathology and Audiology Services');
echo $form->input('SectionO.O0400A1', array('label' => 'A1. Individual minutes', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400A2', array('label' => 'A2. Concurrent minutes', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400A3', array('label' => 'A3. Group minutes', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400A4', array('label' => 'A4. Days', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400A5', array('label' => 'A5. Therapy start date', 'div' => 'input date float-left', 'type' => 'text', 'after' => '<br />Format as YYYY-MM-DD<br />', 'maxLength' => 10, 'size' => 10));
echo $form->input('SectionO.O0400A6', array('label' => 'A6. Therapy end date - enter 8 dashes if ongoing', 'div' => 'input date float-left', 'type' => 'text', 'after' => '<br />Format as YYYY-MM-DD <br /> If ongoing please use 8 dashes exactly', 'maxLength' => 10, 'size' => 10));

echo $this->Html->div('header', 'B. Occupational Therapy');
echo $form->input('SectionO.O0400B1', array('label' => 'B1. Individual minutes', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400B2', array('label' => 'B2. Concurrent minutes', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400B3', array('label' => 'B3. Group minutes', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400B4', array('label' => 'B4. Days', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400B5', array('label' => 'B5. Therapy start date', 'div' => 'input date float-left', 'type' => 'text', 'after' => '<br />Format as YYYY-MM-DD<br />', 'maxLength' => 10, 'size' => 10));
echo $form->input('SectionO.O0400B6', array('label' => 'B6. Therapy end date - enter 8 dashes if ongoing', 'div' => 'input date float-left', 'type' => 'text', 'after' => '<br />Format as YYYY-MM-DD <br /> If ongoing please use 8 dashes exactly', 'maxLength' => 10, 'size' => 10));

echo $this->Html->div('header', 'C. Physical Therapy');
echo $form->input('SectionO.O0400C1', array('label' => 'C1. Individual minutes', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400C2', array('label' => 'C2. Concurrent minutes', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400C3', array('label' => 'C3. Group minutes', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400C4', array('label' => 'C4. Days', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400C5', array('label' => 'C5. Therapy start date', 'div' => 'input date float-left', 'type' => 'text', 'after' => '<br />Format as YYYY-MM-DD<br />', 'maxLength' => 10, 'size' => 10));
echo $form->input('SectionO.O0400C6', array('label' => 'C6. Therapy end date - enter 8 dashes if ongoing', 'div' => 'input date float-left', 'type' => 'text', 'after' => '<br />Format as YYYY-MM-DD <br /> If ongoing please use 8 dashes exactly', 'maxLength' => 10, 'size' => 10));

/**
echo $this->Html->div('header', 'D. Respiratory Therapy');
echo $form->input('SectionO.O0400D1', array('label' => 'D1. Total Minutes', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400D2', array('label' => 'D2. Days', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 1));

echo $this->Html->div('header', 'E. Psychological Therapy');
echo $form->input('SectionO.O0400E1', array('label' => 'E1. Total Minutes', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400E2', array('label' => 'E2. Days', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 1));

echo $this->Html->div('header', 'F. Recreational Therapy');
echo $form->input('SectionO.O0400F1', array('label' => 'F1. Total Minutes', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 4));
echo $form->input('SectionO.O0400F2', array('label' => 'F2. Days', 'div' => 'input text float-left', 'maxLength' => 4, 'size' => 1));
*/

echo $this->Html->div('header O0450', 'O0450. Resumption of Therapy');
echo $form->input('SectionO.O0450A', array('label' => 'Has a previous rehabilitation therapy regimen (speech, occupational, and/or physical therapy) ended, as reported on this End of Therapy OMRA, and has this regimen now resumed at exactly the same level for each discipline?', 'div' => 'O0450 input text float-left', 'type' => 'select', 'options' => array(0 => '0. No', 1 => '1. Yes'), 'empty' => '( select an option )'));
echo $form->input('SectionO.O0450B', array('label' => 'Date on which therapy regimen resumed:', 'div' => 'O0450 O0450A input date float-left', 'type' => 'text', 'after' => '<br />Format as YYYY-MM-DD', 'maxLength' => 10, 'size' => 10));


echo $this->Html->div('header', 'O0500. Restorative Nursing Programs');
echo $this->Html->div('', 'Record the <strong>number of days</strong> each of the following restorative programs was performed (for at least 15 minutes a day) in the last 7 calendar days (enter 0 if none of less than 15 minutes daily)');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Enter the number of days');

echo $this->Html->div('header', 'Technique');
echo $form->input('SectionO.O0500A', array('div' => 'input text float-single', 'label' => 'A. Range of motion (passive)', 'maxLength' => 1, 'size' => 1));
echo $form->input('SectionO.O0500B', array('div' => 'input text float-single', 'label' => 'B. Range of motion (active)', 'maxLength' => 1, 'size' => 1));
echo $form->input('SectionO.O0500C', array('div' => 'input text float-single', 'label' => 'C. Splint or brace assistance', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('header', 'Training and Skill Practice in:');
echo $form->input('SectionO.O0500D', array('div' => 'input text float-single', 'label' => 'D. Bed mobility', 'maxLength' => 1, 'size' => 1));
echo $form->input('SectionO.O0500E', array('div' => 'input text float-single', 'label' => 'E. Transfer', 'maxLength' => 1, 'size' => 1));
echo $form->input('SectionO.O0500F', array('div' => 'input text float-single', 'label' => 'F. Walking', 'maxLength' => 1, 'size' => 1));
echo $form->input('SectionO.O0500G', array('div' => 'input text float-single', 'label' => 'G. Dressing and/or grooming', 'maxLength' => 1, 'size' => 1));
echo $form->input('SectionO.O0500H', array('div' => 'input text float-single', 'label' => 'H. Eating and/or swallowing', 'maxLength' => 1, 'size' => 1));
echo $form->input('SectionO.O0500I', array('div' => 'input text float-single', 'label' => 'I. Amputation/prosthesis care', 'maxLength' => 1, 'size' => 1));
echo $form->input('SectionO.O0500J', array('div' => 'input text float-single', 'label' => 'J. Communication', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('header', 'O0600. Physician Examinations');
echo $form->input('SectionO.O0600', array('label' => '<span class="normal">Over the last 14 days,</span> on how many days did the physician (or authorized assistant or practioner) examine the resident?', 'maxLength' => 2, 'size' => 2));

echo $this->Html->div('header', 'O0700. Physician Orders');
echo $form->input('SectionO.O0700', array('label' => '<span class="normal">Over the last 14 days,</span> on how many days did the physician (or authorized assistant or practioner) change the resident\'s orders?', 'maxLength' => 2, 'size' => 2));



?>
</td>
</table>