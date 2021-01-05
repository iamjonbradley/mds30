<h2>Section E - Behavior</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'E0100. Psychosis');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $form->input('SectionE.E0100A', array('label' => 'A. Hallucinations <span class="normal">(perceptual experiences in the absence of real external sensory stimuli)</span>', 'type' => 'checkbox'));
echo $form->input('SectionE.E0100B', array('label' => 'B. Delusions <span class="normal">(misconceptions or beliefs that are firmly held, contrary to reality)</span>', 'type' => 'checkbox'));
echo $form->input('SectionE.E0100Z', array('label' => 'Z. None of the above', 'type' => 'checkbox'));

echo $this->Html->div('header', 'E0200. behavioral Symptom - Presence & Frequency');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Note presence of symptoms and their frequency');

$options = array(
		0 => '0. behavior not exhibited',
		1 => '1. behavior of this type occurred 1 to 3 days',
		2 => '2. behavior of this type occurred 4 to 6 days, but less than daily',
		3 => '3. behavior of this type occurred daily'
	);

echo $form->input('SectionE.E0200A', array('label' => 'A. Physical behavioral symptoms directed toward others <span class="normal">(e.g., hitting, kicking, pushing, scratching, grabbing, abusing other sexually)</span>', 'id' => 'E0200A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $form->input('SectionE.E0200B', array('label' => 'B. Verbal behavioral symptoms directed toward others <span class="normal">(e.g., threatening others, screaming at others, cursing at others)</span>', 'id' => 'E0200B', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $form->input('SectionE.E0200C', array('label' => 'C. Other behavioral symptoms not directed toward others <span class="normal">(e.g., physical symptoms such as hitting or scratching self, pacing, rummaging, public sexual acts, disrobing in public, throwing or smearing food or bodily wastes, or verbal/vocal symptoms like screaming, disruptive sounds)</span>', 'id' => 'E0200C', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));


?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php

echo $this->Html->div('header', 'E0800. Reject of Care - Presence & Frequency');
echo $form->input('SectionE.E0800', array('label' => 'Did the resident reject evaluation of care <span class="normal">(e.g., bloodwork, taking medications, ADL assistance)</span> that is necessary to achieve the resident\'s goals for health and well-being <span class="normal">Do not include behaviors that have already been addressed (e.g., by discussion or care planning with the resident or family), and/or determined to be consistent with resident values, preferences, or goals.</span>', 'id' => 'E0800', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));

echo $this->Html->div('header', 'E0900. Wandering - Presence & Frequency');
echo $form->input('SectionE.E0900', array('id' => 'E0900', 'label' => 'Has the resident wandered?', 'id' => 'E0900', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. behavior not exhibited', 
		1 => '1. behavior of this type occurred 1 to 3 days',
		2 => '2. behavior of this type occurred 4 to 6 days, but less than daily',
		3 => '3. behavior of this type occurred daily',
	)));
?>
</td>
</tr>
</table>

