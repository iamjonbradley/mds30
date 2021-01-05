<h2>Section N - Medications</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'N0300. Injections');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Please enter number of days into the below boxes');
echo $form->input('SectionN.N0300', array('id' => 'N0300', 'label' => 'Record the number of days that injections of any type <span class="normal">were received during the last 7 days or since admission/reentry if less than 7 days.</span>', 'maxLength' => 1, 'size' => 1));

echo '<div class="N0350-SKIP">';
echo $this->Html->div('header', 'N0350. Insulin');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Please enter number of days into the below boxes');
echo $this->Html->div('misc full', 'A. Insulin injections - Record the number of days that insulin injections <span class="normal">were received during the last 7 days or since admission/reentry if less than 7 days</span>');
echo $form->input('SectionN.N0350A', array('label' => 'Enter Days', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('misc full', 'B. Orders for insulin - Record the number of days the physician (or authorized assistant or practitioner) changed the resident\'s insulin orders <span class="normal">during the last 7 days or since admission/reneentry if less that 7 days</span>');
echo $form->input('SectionN.N0350B', array('label' => 'Enter Days', 'maxLength' => 1, 'size' => 1));
echo '</div>';


?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
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
</table>