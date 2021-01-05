<h2>Section D - Mood</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header D0100', 'D0100. Should Resident Mood Interview be Conducted? <span class="normal"> - Attempt to conduct interview with all residents</span>');
echo $this->Form->input('SectionD.D0100', array('label' => false, 'id' => 'D0100', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No (resident is rarely/never understood)', 
		1 => '1. Yes', 
	)));
echo '<div class="D0100-SKIP">';

echo $this->Html->div('header D0200', 'D0200. Resident Mood Interview (PHQ-9&reg;)');
echo $this->Html->div('note D0200', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>Note:</strong> "Over the last 2 weeks, have you been bothered by any of the following problems?"');
echo $this->Html->div('note D0200', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>Note:</strong> "If Yes,ask the resident: "About <strong>how often</strong> have you been bothered by this?""');

// set options
$options = array(
	0 => array(

		0 => '0. No', 
	  1 => '1. Yes', 
	  9 => '9. No Response'
	),
	1 => array(

		0 => '0. Never or 1 day', 
	  1 => '1. 2-6 days (several days)', 
	  2 => '2. 7-11 days (half or more of the days)', 
	  3 => '3. 12-14 days (nearly every day)'
	)
);

echo $this->Html->div('header D0200', 'A. Little interest or pleasure in doing things');
echo $this->Form->input('SectionD.D0200A1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0200A2', array('label' => 'Symptom Frequency', 'class' => 'column2', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0200', 'B. Feeling down, depressed, or hopeless');
echo $this->Form->input('SectionD.D0200B1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0200B2', array('label' => 'Symptom Frequency' ,'class' => 'column2', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0200', 'C. Trouble falling or staying asleep, or sleeping too much');
echo $this->Form->input('SectionD.D0200C1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0200C2', array('label' => 'Symptom Frequency', 'class' => 'column2', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0200', 'D. Feeling tired or having little energy');
echo $this->Form->input('SectionD.D0200D1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0200D2', array('label' => 'Symptom Frequency', 'class' => 'column2', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0200', 'E. Poor appetite or overeating');
echo $this->Form->input('SectionD.D0200E1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0200E2', array('label' => 'Symptom Frequency', 'class' => 'column2', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0200', 'F. Feeling bad about yourself - or that you are a failure or have let yourself or your family down');
echo $this->Form->input('SectionD.D0200F1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0200F2', array('label' => 'Symptom Frequency', 'class' => 'column2', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0200', 'G. Trouble concentrating on things, such as reading the newspaper or watching television');
echo $this->Form->input('SectionD.D0200G1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0200G2', array('label' => 'Symptom Frequency', 'class' => 'column2', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0200', 'H. Moving or speaking so slowly that other people could have noticed. Or the opposite - being so figety or restless that you have been moving around a lot more then usual');
echo $this->Form->input('SectionD.D0200H1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0200H2', array('label' => 'Symptom Frequency', 'class' => 'column2', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0200', 'I. Thoughts that you would be better off dead, or of hurting yourself in some way');
echo $this->Form->input('SectionD.D0200I1', array('id' => 'D0200I1', 'label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0200I2', array('label' => 'Symptom Frequency', 'class' => 'column2', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

// summary score
echo $this->Html->div('header D0300', 'D0300. Total Severity Score');
echo $this->Form->input('SectionD.D0300', array('label' => 'Enter 99 if unable to complete one or more questions of interview (i.e., Symptom Frequency is blank for 3 or more items).', 'maxLength' => 2, 'size' => 2));

echo $this->Html->div('header D0350', 'D0350. Safety Notification <span class="normal"> - Complete only if D0200I1 = 1 indicating possibility of resident self harm');
echo $this->Form->input('SectionD.D0350', array('label' => 'Was responsible staff or provider informed that there is a potential for resident self harm?', 'id' => 'D0350', 'div' => 'input select D0350', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes', 
	)));
echo '</div>';
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php

echo '<div class="D0500-SKIP">';
echo $this->Html->div('header D0500', 'D0500. Staff Assessment of Resident Mood (PHQ-9-OV&copy;) <span class="normal"> - Do not conduct if Resident Mood Interview (D0200-D0300) was completed</span>');
echo $this->Html->div('header D0500', 'Over the last 2 weeks, did the resident have any of the following problems or behaviors?');

// set options
$options = array(
	// symptom presence
	0 => array(0 => '0. No', 1 => '1. Yes'),
	// symptom frequency
	1 => array(0 => '0. Never or 1 day', 1 => '1. 2-6 days (several days)', 2 => '2. 7-11 days (half or more of the days)', 3 => '3. 12-14 days (nearly every day)')
);

echo $this->Html->div('header D0500', 'A. Little interest or pleasure in doing things');
echo $this->Form->input('SectionD.D0500A1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0500A2', array('label' => 'Symptom Frequency', 'class' => 'column2B', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0500', 'B. Feeling or appearing down, depressed, or hopeless');
echo $this->Form->input('SectionD.D0500B1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0500B2', array('label' => 'Symptom Frequency', 'class' => 'column2B', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0500', 'C. Trouble falling or staying asleep, or sleeping too much');
echo $this->Form->input('SectionD.D0500C1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0500C2', array('label' => 'Symptom Frequency', 'class' => 'column2B', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0500', 'D. Feeling tired of having little energy');
echo $this->Form->input('SectionD.D0500D1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0500D2', array('label' => 'Symptom Frequency', 'class' => 'column2B', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0500', 'E. Poor appetite or overeating');
echo $this->Form->input('SectionD.D0500E1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0500E2', array('label' => 'Symptom Frequency','class' => 'column2B',  'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0500', 'F. Indicating that s/he feels bad about self, is a failure, or has let self or family down');
echo $this->Form->input('SectionD.D0500F1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0500F2', array('label' => 'Symptom Frequency', 'class' => 'column2B', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0500', 'G. Trouble concentrating on things, such as reading the newspaper or watching television');
echo $this->Form->input('SectionD.D0500G1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0500G2', array('label' => 'Symptom Frequency', 'class' => 'column2B', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0500', 'H. Moving or speaking so slowly that other people have noticed. Or the opposite - being so fidgety or restless that s/he has been moving around a lot more than usual');
echo $this->Form->input('SectionD.D0500H1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0500H2', array('label' => 'Symptom Frequency', 'class' => 'column2B', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0500', 'I. States that life isn\'t worth living, wishing for death, or attempts to harm self');
echo $this->Form->input('SectionD.D0500I1', array('id' => 'D0500I1', 'label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0500I2', array('label' => 'Symptom Frequency', 'class' => 'column2B', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

echo $this->Html->div('header D0500', 'J. Being short-tempered, easily annoyed');
echo $this->Form->input('SectionD.D0500J1', array('label' => 'Symptom Presence', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[0]));
echo $this->Form->input('SectionD.D0500J2', array('label' => 'Symptom Frequency', 'class' => 'column2B', 'div' => 'input select float-left', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options[1]));

// summary score
echo $this->Html->div('header D0600', 'D0600. Total Severity Score');
echo $this->Form->input('SectionD.D0600', array('label' => 'Enter 99 if unable to complete one or more questions of interview (i.e., Symptom Frequency is blank for 3 or more items).', 'maxLength' => 2, 'size' => 2));


echo $this->Html->div('header D0650', 'D0650. Saftey Notification <span class="normal"> - Complete only if D0500I1 = 1 indicating possibility of resident self harm');
echo $this->Form->input('SectionD.D0650', array('label' => 'Was responsible staff or provider informed that there is a potential for resident self harm?', 'id' => 'D0650', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes', 
	)));
	echo '</div>';
?>
</td>
</tr>
</table>