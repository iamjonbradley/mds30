<h2>Section K - Swallowing/Nutritional Status</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php

echo $this->Html->div('header', 'K0200. Height and Weight - <span class="normal">While measuring, if the number is X.1 - X.4 round down; X.5 or greater round up</span>');

echo $form->input('SectionK.K0200A', array('label' => 'A. Height <span class="normal">(in inches). Record most recent height measure since admission</span>', 'maxLength' => 2, 'size' => 2));
echo $form->input('SectionK.K0200B', array('label' => 'B. Weight <span class="normal">(in pounds). Base weight on most recent measure in last 30 days; measure weight constantly, according to standard facility practice (e.g., in a.m. after voiding, before meal, with shoes off, etc.)</span>', 'maxLength' => 3, 'size' => 3));

echo $this->Html->div('header', 'K0300. Weight Loss');
echo $form->input('SectionK.K0300', array('label' => 'Loss of 5% or more in the last month or loss of 10% or more in the last 6 months', 'id' => 'K0300', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No or unknown', 
		1 => '1. Yes, on physician-prescribed weight-loss regimen',
		2 => '2. Yes, not on physician-prescribed weight-loss regimen',
	)));


?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php

echo $this->Html->div('header', 'K0510. Nutritional Approaches.');

echo $this->Html->div('misc', 'A. Parenteral/IV feeding.', array('style' => 'margin-left: 0;'));
echo $this->Form->input('SectionK.K0510A1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
echo $this->Form->input('SectionK.K0510A2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('misc', 'B. Feeding tube', array('style' => 'margin-left: 0;'));
echo $this->Form->input('SectionK.K0510B1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
echo $this->Form->input('SectionK.K0510B2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('misc', 'C. Mechanically altered diet', array('style' => 'margin-left: 0;'));
echo $this->Form->input('SectionK.K0510C1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
echo $this->Form->input('SectionK.K0510C2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('misc', 'D. Therapeutic diet', array('style' => 'margin-left: 0;'));
echo $this->Form->input('SectionK.K0510D1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
echo $this->Form->input('SectionK.K0510D2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));

echo $this->Html->div('misc', 'Z. None of the above.', array('style' => 'margin-left: 0;'));
echo $this->Form->input('SectionK.K0510Z1', array('label' => 'While NOT a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left column_one'));
echo $this->Form->input('SectionK.K0510Z2', array('label' => 'While a Resident', 'type' => 'checkbox', 'div' => 'input checkbox float-left'));
/**
echo '<div id="K0700">';
echo $this->Html->div('header', 'K0700. Percent Intake by Artificial Route');

echo $form->input('SectionK.K0700A', array('label' => 'A. Proportion of total calories the resident received through parenteral or tube feeding', 'id' => 'K0700A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		1 => '1. 25% or less', 
		2 => '2. 26-50%',
		3 => '3. 51% or more',
	)));

echo $form->input('SectionK.K0700B', array('label' => 'B. Average fluid intake per day by IV or tube feeding', 'id' => 'K0700B', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		1 => '1. 500 cc/day or less', 
		2 => '2. 501 cc/day or more',
	)));
echo '</div>';
*/
?>
</td>
</table>