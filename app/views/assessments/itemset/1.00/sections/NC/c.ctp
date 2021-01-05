<h2>Section C - Cognitive Patterns</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
// C0100. Should Brief Interview for Mental Status (C0200-C0500) be Conducted?
echo $this->Html->div('header C0100', 'C0100. Should Brief Interview for Mental Status (C0200-C0500) be Conducted?');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Attempt to conduct interview with all residents');
echo $this->Form->input('SectionC.C0100', array('label' => false, 'id' => 'C0100', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No',
		1 => '1. Yes',
	)));

echo '<div class="C0100-SKIP">';
echo $this->Html->div('header', 'Brief Interview for Mental Status (BIMS)');

// Repetition of Three Words
echo $this->Html->div('header C0200', 'C0200. Repetition of Three Words');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>Note:</strong> Ask Resident: "I am going to say three words for you to remember, Please repeat the words after I have said all three. The words are: <strong>sock, blue, and bed</strong>. Now tell me the three words"');
echo $this->Form->input('SectionC.C0200', array('label' => 'Number of words repeated after first attempt', 'class' => 'cCalc', 'id' => 'C0200', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(

		0 => '0. None', 
		1 => '1. One',
		2 => '2. Two',
		3 => '3. Three',
	)));
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> After resident\'s first attempt, repeat the words use cues ("sock, something to wear; blue, a color, bed a piece of furniture"). You may repeat the words up to two more times.');

// temporal orientation
echo $this->Html->div('header C0300', 'C0300. Temporal Orientation <span class="normal">(orientation to year, month, day)</span>');

// correct year
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Ask Resident: "Please tell me what year it is right now?"');
echo $this->Form->input('SectionC.C0300A', array('label' => 'A. Able to report correct year', 'id' => 'C0300A', 'class' => 'cCalc', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(

		0 => '0. Missed by > 5 years or no answer', 
		1 => '1. Missed by 2-5 years',
		2 => '2. Missed by 1 year',
		3 => '3. Correct',
	)));
	
// correct month
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Ask Resident: "What month we are in right now?"');
echo $this->Form->input('SectionC.C0300B', array('label' => 'B. Able to report correct month', 'id' => 'C0300B', 'class' => 'cCalc', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(

		0 => '0. Missed by > 1 month or no answer', 
		1 => '1. Missed by 6 days to 1 month',
		2 => '2. Accurate by 5 days',
	)));
		
// correct day
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Ask Resident: "What day of the week is today?"');
echo $this->Form->input('SectionC.C0300C', array('label' => 'C. Able to report correct day of the week', 'id' => 'C0300C',  'class' => 'cCalc','type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(

		0 => '0. Incorrect or no answer', 
		1 => '1. Correct',
	)));
	
// Recall
echo $this->Html->div('header C0400', 'C0400. Recall');

// recall note
echo $this->Html->div('note C0400', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Ask Resident: "Let\'s go back to an earlier question. What were those words that I asked you to repeat" If unable to remember a word give cue (something to wear; a color; a piece of furniture) for that word.');

// sock
echo $this->Form->input('SectionC.C0400A', array('label' => 'A. Able to recall "sock"', 'id' => 'C0400A', 'class' => 'cCalc', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(

		0 => '0. No - Could not recall', 
		1 => '1. Yes, after cueing ("something to wear")',
		2 => '2. Yes, no cue required',
	)));
	
// sock
echo $this->Form->input('SectionC.C0400B', array('label' => 'B. Able to recall "blue"', 'id' => 'C0400B', 'class' => 'cCalc', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(

		0 => '0. No - Could not recall', 
		1 => '1. Yes, after cueing ("a color")',
		2 => '2. Yes, no cue required',
	)));
	
// sock
echo $this->Form->input('SectionC.C0400C', array('label' => 'C. Able to recall "bed"', 'id' => 'C0400C', 'class' => 'cCalc', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(

		0 => '0. No - Could not recall', 
		1 => '1. Yes, after cueing ("a piece of furniture")',
		2 => '2. Yes, no cue required',
	)));
	

// summary score
echo $this->Html->div('header C0500', 'C0500. Summary Score');
echo $this->Form->input('SectionC.C0500', array('label' => 'Enter 99 if unable to complete one or more questions of interview', 'maxLength' => 2, 'size' => 2));
echo '</div>';
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
echo '<div class="C0100-SKIP">';
// C0600. Should the Staff Assessment for Mental Status (C0700 - C1000) be Conducted?
echo $this->Html->div('header C0600', 'C0600. Should the Staff Assessment for Mental Status (C0700 - C1000) be Conducted?');
echo $this->Form->input('SectionC.C0600', array('label' => false, 'id' => 'C0600', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No (resident was able to complete interview)', 
		1 => '1. Yes (resident was unable to complete interview)', //  Continue
	)));
echo '</div>';
echo '<div class="C0600-SKIP">';
echo $this->Html->div('header', 'Staff Assessment for Mental Status');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Do not conduct if Brief interview for Mental Status (C0200-C0500) was completed');

echo $this->Html->div('header C0700', 'C0700. Short-term Memory OK');
echo $this->Form->input('SectionC.C0700', array('label' => 'Seems or appears to recall after 5 minutes', 'id' => 'C0700', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. Memory OK', 
		1 => '1. Memory Problem',
	)));

echo $this->Html->div('header C0800', 'C0800. Long-term Memory OK');
echo $this->Form->input('SectionC.C0800', array('label' => 'Seems or appears to recall long past', 'id' => 'C0800', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. Memory OK', 
		1 => '1. Memory Problem',
	)));

echo $this->Html->div('header C0900', 'C0900. Memory/Recall Ability');
echo $this->Html->div('note C0900', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that the resident was normal able to recall');
echo $this->Form->input('SectionC.C0900A', array('label' => 'A. Current season', 'type' => 'checkbox'));
echo $this->Form->input('SectionC.C0900B', array('label' => 'B. Location of own room', 'type' => 'checkbox'));
echo $this->Form->input('SectionC.C0900C', array('label' => 'C. Staff names and faces', 'type' => 'checkbox'));
echo $this->Form->input('SectionC.C0900D', array('label' => 'D. That he or she is in a nursing home', 'type' => 'checkbox'));
echo $this->Form->input('SectionC.C0900Z', array('label' => 'Z. None of the above <span class="normal">were recalled</span>', 'type' => 'checkbox'));

echo $this->Html->div('header C1000', 'C1000.Congnitivie Skills for Daily Decision Making');
echo $this->Form->input('SectionC.C1000', array('label' => 'Made decisions regarding tasks of daily life', 'id' => 'C1000', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. Independent - decisions consistent/reasonable',
		1 => '1. Modified independence - some difficult in new situations only',
    2 => '2. Moderately impaired - decisions poor; cues/supervision required',
    3 => '3. Severely impaired - never/rarely made decisions',
	)));
	
echo '</div>';
	
echo $this->Html->div('header', 'Delirium');
echo $this->Html->div('header C1300', 'C1300. Signs and Symptoms of Delirium (from CAMS&copy)');
echo $this->Html->div('note C1300', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Code <strong>after completing</strong> Brief interview for Mental Status or Staff Assessment, and reviewing medical record');

echo $this->Form->input('SectionC.C1300A', array('label' => 'A. Inattention <span class="normal">- Did the resident have difficulty focusing attention (easily distracted, out of touch, or difficulty following what was said)?', 'id' => 'C1300A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. Behavior not present',
		1 => '1. Behavior continuously present, does not fluctuate',
		2 => '2. Behavior present, fluctuates (comes and goes, changes in severity)',
	)));
	
echo $this->Form->input('SectionC.C1300B', array('label' => 'B. Disorganized thinking <span class="normal">- Was the resident\'s thinking disorganized or incoherent (rambling or irrelevant conversation, unclear or illogical flow of ideas, or unpredictable switching from subject to subject)?', 'id' => 'C1300B', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. Behavior not present',
    1 => '1. Behavior continuously present, does not fluctuate',
    2 => '2. Behavior present, fluctuates (comes and goes, changes in severity)',
	)));
	
echo $this->Form->input('SectionC.C1300C', array('label' => 'C. Altered level of consciousness <span class="normal"> Did the resident have altered level of consciousness (e.g., </span>vigilant <span class="normal"> startled easily to any sound or touch; </span>lethargic <span class="normal">- repeatedly dozed off when being asked questions, but responded to voice or touch; </span>stuporous<span class="normal"> - very difficult to arouse and keep aroused for the interview; </span>comatose <span class="normal">- could not be aroused)?</span>', 'id' => 'C1000C', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. Behavior not present',
    1 => '1. Behavior continuously present, does not fluctuate',
    2 => '2. Behavior present, fluctuates (comes and goes, changes in severity)',
	)));
	
echo $this->Form->input('SectionC.C1300D', array('label' => 'D. Psychomotor retardation <span class="normal">- Did the resident have an unusually decreased level of activity such as sluggishness, staring into space, staying in one position, moving very slowly?</span>', 'id' => 'C1300D', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. Behavior not present',
    1 => '1. Behavior continuously present, does not fluctuate',
    2 => '2. Behavior present, fluctuates (comes and goes, changes in severity)',
	)));
	
	
echo $this->Html->div('header C1600', 'C1600. Acute Onset Mental Status Change');
echo $this->Form->input('SectionC.C1600', array('label' => 'Is there evidence of acute change in mental status <span class="normal"> from the resident\'s baseline?</span>', 'id' => 'C1600', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No',
		1 => '1. Yes',
	)));


?>
</td>
</tr>
</table>