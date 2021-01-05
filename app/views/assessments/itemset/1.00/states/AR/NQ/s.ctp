<h2>Section S - Arkansas Specific Items</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'S1100 - Disease');
echo $this->Html->div('note S1100', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply since last assessment');
echo $form->input('SectionS.S1100A', array('label' => 'A. Clostridium difficile', 'type' => 'checkbox'));
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">&nbsp;</td>
</table>