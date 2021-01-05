  <h2>Section N - Medications</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php

echo $this->Html->div('header', 'N0400. Medications Received');
echo $form->input('SectionN.N0400A', array('label' => 'A. Antipsychotic', 'type' => 'checkbox'));
echo $form->input('SectionN.N0400B', array('label' => 'B. Antianxiety', 'type' => 'checkbox'));
echo $form->input('SectionN.N0400C', array('label' => 'C. Antidepressant', 'type' => 'checkbox'));
echo $form->input('SectionN.N0400D', array('label' => 'D. Hypnotic', 'type' => 'checkbox'));
echo $form->input('SectionN.N0400E', array('label' => 'E. Anticoagulant <span class="normal">(warfarin, heparin, or low-molecular weight heparin)</span>', 'type' => 'checkbox'));
echo $form->input('SectionN.N0400F', array('label' => 'F. Antibiotic', 'type' => 'checkbox'));
echo $form->input('SectionN.N0400G', array('label' => 'G. Diuretic', 'type' => 'checkbox'));
echo $form->input('SectionN.N0400Z', array('label' => 'Z. None of the above were received', 'type' => 'checkbox'));
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php

?>
</td>
</table>