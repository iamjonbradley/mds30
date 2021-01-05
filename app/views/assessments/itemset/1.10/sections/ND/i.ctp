<h2>Section I - Active Diagnoses</h2>
<?php
echo $this->Html->div('header', 'Active Diagnoses in the last 7 days - Check all that apply <br /><span class="normal">Diagnoses listed in parentheses are provided as examples and show not be considered as all-inclusive lists</span>');
?>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'Cancer');
echo $form->input('SectionI.I0100', array('label' => 'I0100. Cancer <span class="normal">(with or without metastasis)</span>', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Heart/Circulation');
echo $form->input('SectionI.I0900', array('label' => 'I0900. Peripheral Vascular Disease (PVD) or Peripheral Arterial Disease (PAD)', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Genitourinary');
echo $form->input('SectionI.I1550', array('label' => 'I1550. Neurogenic Bladder', 'type' => 'checkbox'));
echo $form->input('SectionI.I1650', array('label' => 'I1650. Obstructive Uropathy', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Infections');
echo $form->input('SectionI.I2300', array('label' => 'I2300. Urinary Tract Infection (UTI) (LAST 30 DAYS)', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Metabolic');
echo $form->input('SectionI.I2900', array('label' => 'I2900. Diabetes Mellitus (DM) <span class="normal">(e.g., diabetic retinopathy, nephropathy, and neuropathy)</span>', 'type' => 'checkbox'));

?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'Neurological');
echo $form->input('SectionI.I5250', array('label' => 'I5250. Huntington\'s Disease.', 'type' => 'checkbox'));
echo $form->input('SectionI.I5350', array('label' => 'I5350. Tourette\'s Syndrome', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Nutritional');
echo $form->input('SectionI.I5600', array('label' => 'I5600. Malnutrition <span class="normal">(protein or calorie) or at risk for malnutrition</span>', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Phychiatric/Mood Disorder');
echo $form->input('SectionI.I5700', array('label' => 'I5700. Anxiety Disorder', 'type' => 'checkbox'));
echo $form->input('SectionI.I5800', array('label' => 'I5800. Depression <span class="normal">(other then bipolar)</span>', 'type' => 'checkbox'));
echo $form->input('SectionI.I5900', array('label' => 'I5900. Manic Depression <span class="normal">(bipolar disease)</span>', 'type' => 'checkbox'));
echo $form->input('SectionI.I5950', array('label' => 'I5950. Psychotic Disorder <span class="normal">(other then schizophrenia)</span>', 'type' => 'checkbox'));
echo $form->input('SectionI.I6000', array('label' => 'I6000. Schizophrenia <span class="normal">(e.g., schizoaffective and schizophreniform disorders)</span>', 'type' => 'checkbox'));
echo $form->input('SectionI.I6100', array('label' => 'I6100. Post Traumatic Stress Disorder (PTSD)', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Other');
echo $this->Html->div('', '<strong>I8000. Additional active diagnoses</strong> <br /> <span class="normal">Enter the ICD code in the boxes below</span>');

echo $this->Html->div('', $this->Html->link('Lookup IDC 9 Codes', '/idc9_codes/search', array('class' => 'lookup_idc9')));

echo '<div style="display: block; clear: both">';
echo $form->input('SectionI.I8000A', array('id' => 'I8000A', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000A');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $form->input('SectionI.I8000B', array('id' => 'I8000B', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000B');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $form->input('SectionI.I8000C', array('id' => 'I8000C', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000C');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $form->input('SectionI.I8000D', array('id' => 'I8000D', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000D');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $form->input('SectionI.I8000E', array('id' => 'I8000E', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000E');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $form->input('SectionI.I8000F', array('id' => 'I8000F', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000F');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $form->input('SectionI.I8000G', array('id' => 'I8000G', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000G');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $form->input('SectionI.I8000H', array('id' => 'I8000H', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000H');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $form->input('SectionI.I8000I', array('id' => 'I8000I', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000I');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $form->input('SectionI.I8000J', array('id' => 'I8000J', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000J');
echo '</div>';

?>
</td>
</tr>
</table>