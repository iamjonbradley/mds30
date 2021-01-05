<h2>Section E - Behavior</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'E0100. Psychosis');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $this->Form->input('SectionE.E0100A', array('label' => 'A. Hallucinations <span class="normal">(perceptual experiences in the absence of real external sensory stimuli)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionE.E0100B', array('label' => 'B. Delusions <span class="normal">(misconceptions or beliefs that are firmly held, contrary to reality)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionE.E0100Z', array('label' => 'Z. None of the above', 'type' => 'checkbox'));


echo $this->Html->div('header', 'E0200. behavioral Symptom - Presence & Frequency');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Note presence of symptoms and their frequency');

$options = array(
    ' ' => '-',
		0 => '0. Behavior not exhibited',
		1 => '1. Behavior of this type occurred 1 to 3 days',
		2 => '2. Behavior of this type occurred 4 to 6 days, but less than daily',
		3 => '3. Behavior of this type occurred daily'
	);

echo $this->Form->input('SectionE.E0200A', array('label' => 'A. Physical behavioral symptoms directed toward others <span class="normal">(e.g., hitting, kicking, pushing, scratching, grabbing, abusing other sexually)</span>', 'id' => 'E0200A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionE.E0200B', array('label' => 'B. Verbal behavioral symptoms directed toward others <span class="normal">(e.g., threatening others, screaming at others, cursing at others)</span>', 'id' => 'E0200B', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionE.E0200C', array('label' => 'C. Other behavioral symptoms not directed toward others <span class="normal">(e.g., physical symptoms such as hitting or scratching self, pacing, rummaging, public sexual acts, disrobing in public, throwing or smearing food or bodily wastes, or verbal/vocal symptoms like screaming, disruptive sounds)</span>', 'id' => 'E0200C', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));

echo $this->Html->div('header', 'E0300. Overall Presence of behavioral Symptoms');

$yesno = array(0 => '0. No', 1 => '1. Yes');
echo $this->Form->input('SectionE.E0300', array('id' => 'E0300', 'label' => 'Were any behavioral symptoms in questions E0200 coded 1, 2, 3', 'id' => 'E0300', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $yesno));

echo '<div class="E0300-SKIP">';
echo $this->Html->div('header', 'E0500. Impact on Resident');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Did any of the identified symptom(s)');
echo $this->Form->input('SectionE.E0500A', array('id' => 'E0500A', 'label' => 'A. Put the resident at significant risk for physical illness or injury?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $yesno));
echo $this->Form->input('SectionE.E0500B', array('id' => 'E0500B', 'label' => 'B. Significantly interfere with resident\'s care?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $yesno));
echo $this->Form->input('SectionE.E0500C', array('id' => 'E0500C', 'label' => 'C. Significantly interfere with the resident\'s participation in activities or social interactions?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $yesno));
echo '</div>';

?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
echo '<div class="E0300-SKIP">';
echo $this->Html->div('header', 'E0600. Impact on Others');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Did any of the identified symptom(s)');
echo $this->Form->input('SectionE.E0600A', array('label' => 'A. Put others at significant risk for physical injury?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $yesno));
echo $this->Form->input('SectionE.E0600B', array('label' => 'B. Significantly intrude on the privacy or activity of others?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $yesno));
echo $this->Form->input('SectionE.E0600C', array('label' => 'C. Significantly disrupt care or living environment?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $yesno));
echo '</div>';

echo $this->Html->div('header', 'E0800. Reject of Care - Presence & Frequency');
echo $this->Form->input('SectionE.E0800', array('label' => 'Did the resident reject evaluation of care <span class="normal">(e.g., bloodwork, taking medications, ADL assistance)</span> that is necessary to achieve the resident\'s goals for health and well-being <span class="normal">Do not include behaviors that have already been addressed (e.g., by discussion or care planning with the resident or family), and/or determined to be consistent with resident values, preferences, or goals.</span>', 'id' => 'E0800', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));

echo $this->Html->div('header', 'E0900. Wandering - Presence & Frequency');
echo $this->Form->input('SectionE.E0900', array('id' => 'E0900', 'label' => 'Has the resident wandered?', 'id' => 'E0900', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. Behavior not exhibited', 
		1 => '1. Behavior of this type occurred 1 to 3 days',
		2 => '2. Behavior of this type occurred 4 to 6 days, but less than daily',
		3 => '3. Behavior of this type occurred daily',
	)));

echo '<div class="E0900-SKIP">';
echo $this->Html->div('header', 'E1000. Wandering - Impact');

echo $this->Form->input('SectionE.E1000A', array('label' => 'A. Does the wandering place the resident at significant risk of getting to a patientially dangerous place <span class="small">(e.g., stairs, outside of the facility)?', 'id' => 'E1000A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $yesno));
echo $this->Form->input('SectionE.E1000B', array('label' => 'B. Does the wandering significantly intrude on the privacy or activities of others?', 'id' => 'E1000B', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $yesno));
echo '</div>';

echo $this->Html->div('header', 'E1100. Change in Behavior or Other Symptoms');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Consider all of the symptoms assessed in items E0100 through E1000');

echo $this->Form->input('SectionE.E1100', array('label' => 'How does resident\'s current behavior status, care rejection, or wandering <strong>compare to prior assessment (OBRA or PPS)</strong>?', 'id' => 'E1100', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. Same', 
		1 => '1. Improved',
		2 => '2. Worse',
		3 => '3. N/A because no prior MDS assessment',
	)));
?>
</td>
</tr>
</table>

