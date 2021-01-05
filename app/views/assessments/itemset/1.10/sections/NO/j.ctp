<h2>Section J - Health Conditions</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="100%">
<?php

echo $this->Html->div('header J1100', 'Other Health Conditions');
echo $this->Html->div('header J1100', 'J1100. Shortness of Breath (dyspnea)');
echo $this->Html->div('note J1100', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $this->Form->input('SectionJ.J1100C', array('label' => 'C. Shortness of breath <span class="normal">or trouble breathing</span> when lying flat', 'type' => 'checkbox'));

echo $this->Html->div('header J1550', 'J1550. Problem conditions');
echo $this->Html->div('note J1550', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $this->Form->input('SectionJ.J1550A', array('label' => 'Fever', 'type' => 'checkbox'));
echo $this->Form->input('SectionJ.J1550B', array('label' => 'Vomiting', 'type' => 'checkbox'));

?>
</td>
</table>