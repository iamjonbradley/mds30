<h2>Section F - Preferences for Customary Routine and Activites</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'F0300. Should interview for Daily and Activity Preferences be Conducted? <span class="normal">- Attempt to interview all residents able to communicate. If resident is unable to complete, attempt to complete interview with family cmember of significant other.</span>');
echo $this->Form->input('SectionF.F0300', array('label' => false, 'id' => 'F0300', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No (resident is rarely/never understood and family/significant other not available)', 
		1 => '1. Yes',
	)));
	
$options = array(
		1 => '1. Very Important',
		2 => '2. Somewhat important',
		3 => '3. Not very important',
		4 => '4. Not important at all',
		5 => '5. Important, but can\'t do or no choice',
		9 => '9. No response or non-responsive'
	);
echo $this->Html->div('header F0400', 'F0400. Interview for Daily Preferences');
echo $this->Html->div('note F0400', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Show resident the response options and say: <strong>"While you are in the facility..."</strong>');
echo $this->Form->input('SectionF.F0400A', array('label' => 'A. <span class="normal">How important is it for you to</span> choose what clothes to wear?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionF.F0400B', array('label' => 'B. <span class="normal">How important is it for you to</span> take care of your personal belongings or things?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionF.F0400C', array('label' => 'C. <span class="normal">How important is it for you to</span> choose between a tub bath, shower, bed bath, or sponge bath?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionF.F0400D', array('label' => 'D. <span class="normal">How important is it for you to</span> have snacks available between meals?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionF.F0400E', array('label' => 'E. <span class="normal">How important is it for you to</span> choose your own bedtime?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionF.F0400F', array('label' => 'F. <span class="normal">How important is it for you to</span> have your family or a close friend involved in discussion about your care?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionF.F0400G', array('label' => 'G. <span class="normal">How important is it for you to</span> be able to use the phone in private?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionF.F0400H', array('label' => 'H. <span class="normal">How important is it for you to</span> have a place to lock your things to keep them safe?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));

echo $this->Html->div('header F0500', 'F0500. Interview for Activity Preferences');
echo $this->Html->div('note F0500', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Show resident the response options and say: <strong>"While you are in the facility..."</strong>');
echo $this->Form->input('SectionF.F0500A', array('label' => 'A. <span class="normal">How important is it for you to</span> have books, newspapers, and magazines to read?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionF.F0500B', array('label' => 'B. <span class="normal">How important is it for you to</span> listen to music you like?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionF.F0500C', array('label' => 'C. <span class="normal">How important is it for you to</span> be around animals such as pets?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionF.F0500D', array('label' => 'D. <span class="normal">How important is it for you to</span> keep up with the news?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionF.F0500E', array('label' => 'E. <span class="normal">How important is it for you to</span> do things with groups of people?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionF.F0500F', array('label' => 'F. <span class="normal">How important is it for you to</span> do your favorite activites?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionF.F0500G', array('label' => 'G. <span class="normal">How important is it for you to</span> go outside to get fresh air when the weather is good?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionF.F0500H', array('label' => 'H. <span class="normal">How important is it for you to</span> participate in religious services or practices?', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));

echo $this->Html->div('header F0600', 'F0600. Daily and Activity Preferences Primary Respondent');
echo $this->Form->input('SectionF.F0600', array('label' => 'Indicate primary respondent <span class="small">for Daily and Activity Preferences</span>', 'id' => 'F0600', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		1 => '1. Resident', 
		2 => '2. Family or significant other (close friend or other representative)',
		9 => '9. Interview could not be completed by resident or family/significant other'
	)));
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
	
	
echo $this->Html->div('header F0700', 'F0700. Should the Staff Assessment of daily and Activity Preferences be Conducted?');
echo $this->Form->input('SectionF.F0700', array('label' => false, 'id' => 'F0700', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes'
	)));
	
echo $this->Html->div('header F0800', 'F0800. Staff Assessments of Daily and Activity Preferences');
echo $this->Html->div('note F0800', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Do not conduct if interview for Daily and Activity Preferences was completed');

echo $this->Html->div('header F0800', 'Resident Prefers:');
echo $this->Html->div('note F0800', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $this->Form->input('SectionF.F0800A', array('label' => 'A. Choosing clothes to wear', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800B', array('label' => 'B. Caring for personal belongings', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800C', array('label' => 'C. Receiving tub bath', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800D', array('label' => 'D. Receiving shower', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800E', array('label' => 'E. Receiving bed bath', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800F', array('label' => 'F. Receiving sponge bath', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800G', array('label' => 'G. Snacks between meals', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800H', array('label' => 'H. Staying up past 8:00 p.m.', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800I', array('label' => 'I. Family or significant other involvement in care discussions', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800J', array('label' => 'J. Use of phone in private', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800K', array('label' => 'K. Place to lock personal belongings', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800L', array('label' => 'L. Reading books, newspapers, or magazines', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800M', array('label' => 'M. Listening to music', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800N', array('label' => 'N. Being around animals such as pets', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800O', array('label' => 'O. Keeping up with the news', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800P', array('label' => 'P. Doing things with groups of people', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800Q', array('label' => 'Q. Participating in favorite activities', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800R', array('label' => 'R. Spending time away from the nursing home', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800S', array('label' => 'S. Spending time outdoors', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800T', array('label' => 'T. Participating in religious activities or practices', 'type' => 'checkbox'));
echo $this->Form->input('SectionF.F0800Z', array('label' => 'Z. None of the above', 'type' => 'checkbox'));
?>
</td>
</tr>
</table>

