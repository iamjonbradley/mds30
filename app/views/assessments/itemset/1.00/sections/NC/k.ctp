<h2>Section K - Swallowing/Nutritional Status</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php

echo $this->Html->div('header', 'K0100. Swallowing Disorder <br /> <span class="normal">Signs and symptoms of possible swallowing disorder</span>');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $this->Form->input('SectionK.K0100A', array('label' => 'A. Loss of liquids/solids from mouth when eating or drinking', 'type' => 'checkbox'));
echo $this->Form->input('SectionK.K0100B', array('label' => 'B. Holding food in mouth/cheeks or residual food in mouth after meals', 'type' => 'checkbox'));
echo $this->Form->input('SectionK.K0100C', array('label' => 'C. Coughing or choking during meals or when swallowing medications', 'type' => 'checkbox'));
echo $this->Form->input('SectionK.K0100D', array('label' => 'D. Complaints of difficulty or pain with swallowing', 'type' => 'checkbox'));
echo $this->Form->input('SectionK.K0100Z', array('label' => 'Z. None of the above', 'type' => 'checkbox'));

echo $this->Html->div('header', 'K0200. Height and Weight - <span class="normal">While measuring, if the number is X.1 - X.4 round down; X.5 or greater round up</span>');

echo $this->Form->input('SectionK.K0200A', array('label' => 'A. Height <span class="normal">(in inches). Record most recent height measure since admission</span>', 'maxLength' => 2, 'size' => 2));
echo $this->Form->input('SectionK.K0200B', array('label' => 'B. Weight <span class="normal">(in pounds). Base weight on most recent measure in last 30 days; measure weight constantly, according to standard facility practice (e.g., in a.m. after voiding, before meal, with shoes off, etc.)</span>', 'maxLength' => 3, 'size' => 3));

echo $this->Html->div('header', 'K0300. Weight Loss');
echo $this->Form->input('SectionK.K0300', array('label' => 'Loss of 5% or more in the last month or loss of 10% or more in the last 6 months', 'id' => 'K0300', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No or unknown', 
		1 => '1. Yes, on physician-prescribed weight-loss regimen',
		2 => '2. Yes, not on physician-prescribed weight-loss regimen',
	)));


?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'K0500. Nutritional Approaches');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $this->Form->input('SectionK.K0500A', array('label' => 'A. Parenteral/lV feeding', 'id' => 'K0500A', 'type' => 'checkbox'));
echo $this->Form->input('SectionK.K0500B', array('label' => 'B. Feeding tube <span class="normal">- nasogastric or abdominal (PEG)</span>', 'id' => 'K0500B', 'type' => 'checkbox'));
echo $this->Form->input('SectionK.K0500C', array('label' => 'C. Mechanically altered diet <span class="normal">- require change in texture of food or liquids (e.g., pureed food, thickened liquids)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionK.K0500D', array('label' => 'D. Therapeutic diet <span class="normal">(e.g., low salt, diabetic, low cholesterol)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionK.K0500Z', array('label' => 'Z. None of the above', 'type' => 'checkbox'));

echo '<div id="K0700">';
echo $this->Html->div('header', 'K0700. Percent Intake by Artificial Route');

echo $this->Form->input('SectionK.K0700A', array('label' => 'A. Proportion of total calories the resident received through parenteral or tube feeding', 'id' => 'K0700A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		1 => '1. 25% or less', 
		2 => '2. 26-50%',
		3 => '3. 51% or more',
	)));

echo $this->Form->input('SectionK.K0700B', array('label' => 'B. Average fluid intake per day by IV or tube feeding', 'id' => 'K0700B', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		1 => '1. 500 cc/day or less', 
		2 => '2. 501 cc/day or more',
	)));
echo '</div>';
?>
</td>
</table>