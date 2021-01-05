

<h2>Section B - Hearing, Speech, Vision</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top">
<?php
// Comatose
echo $this->Html->div('header B0100', 'B0100. Comatose');
echo $this->Form->input('SectionB.B0100', array('label' => 'Persistent vegetative state/no discernible consciousness', 'id' => 'B0100',  'type' => 'select',  'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes', // skip to G0110
	)));

echo '<div class="B0100-SKIP">';
// Hearing
echo $this->Html->div('header B0200', 'B0200. Hearing');
echo $this->Form->input('SectionB.B0200', array('label' => 'Ability to hear <span class="normal">(with hearing aid or hearing appliances if normally used)</span>', 'id' => 'B0200',  'type' => 'select',  'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. Adequate - no difficulty in normal conversation, social interaction, listening to TV', 
		1 => '1. Minimal Difficulty - difficulty in some environments(e.g., when person speaks softly or setting is noisy)',
		2 => '2. Moderate Difficulty - speaker has to increase volume and speak distinctly',
		3 => '3. Highly impaired - absence of useful hearing',
	)));

// Hearing Aid
echo $this->Html->div('header B0300', 'B0300. Hearing Aid');
echo $this->Form->input('SectionB.B0300', array('label' => 'Hearing aid or other hearing appliance used <span class="normal">in completing B0200, Hearing</span>', 'id' => 'B0300',  'type' => 'select',  'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. No', 
		1 => '1. Yes', 
	)));

// Speech Clarity
echo $this->Html->div('header B0600', 'B0600. Speech Clarity');
echo $this->Form->input('SectionB.B0600', array('label' => 'Select best description of speech pattern', 'id' => 'B0600',  'type' => 'select',  'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. Clear Speech - distinct intelligible words', 
		1 => '1. Unclear speech - slurred or mumbled words', 
		2 => '2. No speech - absence of spoken words', 
	)));
echo '</div>';
echo '<div class="B0100-SKIP">';

// Makes Self Understood
echo $this->Html->div('header B0700', 'B0700. Makes Self Understood');
echo $this->Form->input('SectionB.B0700', array('label' => 'Select best description of speech pattern', 'class' => 'B0700',  'type' => 'select',  'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. Understood', 
		1 => '1. Usually understood - diffculting communicating some words or finishing thoughts but is able if prompted or given time', 
		2 => '2. Sometimes understood - ability is limited to making concrete requests', 
		3 => '3. Rarely/never understood', 
	)));
	
// Ability to Understand Others
echo $this->Html->div('header B0800', 'B0800. Ability to Understand Others');
echo $this->Form->input('SectionB.B0800', array('label' => 'Understanding verable content, however able <span class="small">(with hearing aid or device if used)</span>', 'id' => 'B0800',  'type' => 'select',  'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. Understands - clear comprehension', 
		1 => '1. Usually understands - misses some part/intent of message but comprehends most conversation', 
		2 => '2. Sometimes understands - responds adequately to simple, direct communication only', 
		3 => '3. Rarely/never understands', 
	)));
	
// Vision
echo $this->Html->div('header B1000', 'B1000. Vision');
echo $this->Form->input('SectionB.B1000', array('label' => 'Ability to see in adequate light <span class="small">(with glasses or other visual appliances)</span>', 'id' => 'B1000',  'type' => 'select',  'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. Adequate - sees fine detail, including regular print in newspapers/books', 
		1 => '1. Impaired - sees large print, but not regular print in newspapers/books', 
		2 => '2. Moderately impaired - limited vision; not able to see newspaper headlines but can identify objects', 
		3 => '3. Highly impaired - object identification in question, but eyes appear to follow objects', 
		4 => '4. Severely impaired - no vision or sees only light, colors or shapes; eyes do not appear to follow objects' 
	)));

// Corrective Lenses
echo $this->Html->div('header B1200', 'B1200. Corrective Lenses');
echo $this->Form->input('SectionB.B1200', array('label' => 'Corrective Lenses (contacts, glasses, or magnifying glass) used <span class="normal">in completing B1000 Vision</span>', 'id' => 'B1200',  'type' => 'select',  'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. No', 
		1 => '1. Yes', // skip to G0110
	)));
echo '</div>';
?>
</td>
</tr>
</table>