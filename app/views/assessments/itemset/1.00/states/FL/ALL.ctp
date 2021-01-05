<h2>Section S - Florida Specific Items</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'State Specific');
echo $form->input('SectionS.S9020', array('label' => 'S9020. Florida Facility FRAES', 'type' => 'text', 'maxLength' => 8, 'size' => 8));

echo $this->Html->div('header', 'Demographic');
echo $form->input('SectionS.S0140', array('label' => 'S0140. Physician license number', 'type' => 'text', 'maxLength' => 11, 'size' => 11));
echo $form->input('SectionS.S0141', array('label' => 'S0141. Physician last name', 'type' => 'text', 'maxLength' => 18, 'size' => 18));
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">   &nbsp;</td>
</table>