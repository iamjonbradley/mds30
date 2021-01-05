

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

?>
</td>
</tr>
</table>