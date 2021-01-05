<h2>Section S - Illinois Specific Items</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'Medication Refusal');
echo $this->Html->div('header', 'S2010. Resident refused to  take some or all or prescribed medication in the last 3 days');
echo $form->input('SectionS.S2010', array('label' => false, 'type' => 'select', 'empty' => '( select an option )', 'options' => array('0. No', '1. Yes')));

echo $this->Html->div('header', 'S2011. Resident required staff supporting/promptin 3 or more times to take medication in the last 3 days');
echo $form->input('SectionS.S2011', array('label' => false, 'type' => 'select', 'empty' => '( select an option )', 'options' => array('0. No', '1. Yes')));

?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">&nbsp;</td>
</table>