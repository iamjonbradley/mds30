<h2>Section P - Restraints</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'P0100. Physical Restraints');

$options = array(
	0 => '0. Not used',
	1 => '1. Used less than daily',
	2 => '2. Used daily'	
);

echo $this->Html->div('', 'Physical restraints are any manual method or physical or mechanical device, material or equipment attached or adjacent to the resident\'s body that the individual cannot remove easily which restricts freedom of movement or normal access to one\'s body');

echo $this->Html->div('header', 'Used in Bed');
echo $this->Form->input('SectionP.P0100A', array('label' => 'A. Bed rail', 'type' => 'select', 'escape' => false, 'empty' => '', 'options' => $options));
echo $this->Form->input('SectionP.P0100B', array('label' => 'B. Trunk restraint', 'type' => 'select', 'escape' => false, 'empty' => '', 'options' => $options));
echo $this->Form->input('SectionP.P0100C', array('label' => 'C. Limb restraint', 'type' => 'select', 'escape' => false, 'empty' => '', 'options' => $options));
echo $this->Form->input('SectionP.P0100D', array('label' => 'D. Other', 'type' => 'select', 'escape' => false, 'empty' => '', 'options' => $options));
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'P0100. Physical Restraints - continued');
echo $this->Html->div('', 'Physical restraints are any manual method or physical or mechanical device, material or equipment attached or adjacent to the resident\'s body that the individual cannot remove easily which restricts freedom of movement or normal access to one\'s body');

echo $this->Html->div('header', 'Used in Chair or Out of Bed');
echo $this->Form->input('SectionP.P0100E', array('label' => 'E. Trunk restraint', 'type' => 'select', 'escape' => false, 'empty' => '', 'options' => $options));
echo $this->Form->input('SectionP.P0100F', array('label' => 'F. Limb restraint', 'type' => 'select', 'escape' => false, 'empty' => '', 'options' => $options));
echo $this->Form->input('SectionP.P0100G', array('label' => 'G. Chair prevents rising', 'type' => 'select', 'escape' => false, 'empty' => '', 'options' => $options));
echo $this->Form->input('SectionP.P0100H', array('label' => 'H. Other', 'type' => 'select', 'escape' => false, 'empty' => '', 'options' => $options));

?>
</td>
</table>