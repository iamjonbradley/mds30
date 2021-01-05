<h2>Section I - Active Diagnoses</h2>
<?php
echo $this->Html->div('header', 'Active Diagnoses in the last 7 days - Check all that apply <br /><span class="normal">Diagnoses listed in parentheses are provided as examples and show not be considered as all-inclusive lists</span>');
?>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'Cancer');
echo $this->Form->input('SectionI.I0100', array('label' => 'I0100. Cancer <span class="normal">(with or without metastasis)</span>', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Heart/Circulation');
echo $this->Form->input('SectionI.I0200', array('label' => 'I0200. Anemia <span class="normal">(e.g., aplastic, iron deficiency, pernicious, and sickle cell)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I0300', array('label' => 'I0300. Atrial Fibrillation or Other Dysrhythmias <span class="normal">(e.g., bradycardias and tachycardias)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I0400', array('label' => 'I0400. Coronary Artery Disease (CAD) <span class="normal">(e.g., angina, myocardial infarction, and atherosclerotic heart disease (ASHD))</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I0500', array('label' => 'I0500. Deep Venous Thrombosis (DVT), Pulmonary Embolus (PE), or Pulmonary Thrombo-Embolism (PTE)', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I0600', array('label' => 'I0600. Heart Failure <span class="normal">(e.g., congestive heart failure (CHF) and pulmonary edema)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I0700', array('label' => 'I0700. Hypertension', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I0800', array('label' => 'I0800. Orthostatic Hypotension', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I0900', array('label' => 'I0900. Peripheral Vascular Disease (PVD) or Peripheral Arterial Disease (PAD)', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Gastrointestinal');
echo $this->Form->input('SectionI.I1100', array('label' => 'I1100. Cirrhosis', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I1200', array('label' => 'I1200. Gastroesophageal Reflux Disease (GERD) or Ulcer <span class="normal">(e.g., esophageal, gastric, and peptic ulcers)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I1300', array('label' => 'I1300. Ulcerative Colitis, Crohn\'s Disease, or Inflammatory Bowel Disease', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Genitourinary');
echo $this->Form->input('SectionI.I1400', array('label' => 'I1400. Benign Prostatic Hyperplasia (BPH)', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I1500', array('label' => 'I1500. Renal Insufficiency, Renal Failure, or End-State Renal Disease (ESRD)', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I1550', array('label' => 'I1550. Neurogenic Bladder', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I1650', array('label' => 'I1650. Obstructive Uropathy', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Infections');
echo $this->Form->input('SectionI.I1700', array('label' => 'I1700. Multidrug-Resistant Organism (MDRO)', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I2000', array('label' => 'I2000. Pneumonia', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I2100', array('label' => 'I2100. Septicemia', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I2200', array('label' => 'I2200. Tuberculosis', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I2300', array('label' => 'I2300. Urinary Tract Infection (UTI) (LAST 30 DAYS)', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I2400', array('label' => 'I2400. Viral Hepatitis <span class="normal">(e.g., Hepatitis A, B, C, D, and E)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I2500', array('label' => 'I2500. Wound Infection <span class="normal">(other than foot)</span>', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Metabolic');
echo $this->Form->input('SectionI.I2900', array('label' => 'I2900. Diabetes Mellitus (DM) <span class="normal">(e.g., diabetic retinopathy, nephropathy, and neuropathy)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I3100', array('label' => 'I3100. Hyponatremia', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I3200', array('label' => 'I3200. Hyerkalemia', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I3300', array('label' => 'I3300. Hyperlipidemia <span class="normal">(e.g., hypercholesterolemia)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I3400', array('label' => 'I3400. Thyroid Disorder <span class="normal">(e.g., hypothyroidism, hyperthyroidism, and Hashimoto\'s thyroiditis)</span>', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Musculoskeletal');
echo $this->Form->input('SectionI.I3700', array('label' => 'I3700. Arthritis <span class="normal">(e.g., degenerative joint disease (DJD), osteoarthritis, and rheumatoid arthritis (RA))</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I3800', array('label' => 'I3800. Osteoporosis', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I3900', array('label' => 'I3900. Hip Fracture - <span class="normal">any hip fracture that has a relationship to current status, treatments, monitoring (e.g., sub-capital fractures, and fractures of the trochanter and femoral neck)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I4000', array('label' => 'I4000. Other Fracture', 'type' => 'checkbox'));

?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'Neurological');
echo $this->Form->input('SectionI.I4200', array('label' => 'I4200. Alzheimer\'s Disease', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I4300', array('label' => 'I4300. Aphasia', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I4400', array('label' => 'I4400. Cerebral Palsy', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I4500', array('label' => 'I4500. Cerebrovascular Accident (CVA), Transient Ischemic Attack (TIA), or Stroke', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I4800', array('label' => 'I4800. Dementia <span class="normal">(e.9. Non-Alzheimer\'s dementia such as vascular or multi-infarct dementia; mixed dementia; frontotemporal dementia such as Pick\'s disease; and dementia related to stroke, Parkinson\'s or Creutzfeldt-Jakob diseases)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I4900', array('label' => 'I4900. Hemiplegia or Hemiparesis', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I5000', array('label' => 'I5000. Paraplegia', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I5100', array('label' => 'I5100. Quadriplegia', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I5200', array('label' => 'I5200. Multiple Sclerosis (MS)', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I5250', array('label' => 'I5250. Huntington\'s Disease', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I5300', array('label' => 'I5300. Parkinson\'s Disease', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I5350', array('label' => 'I5350. Tourette\'s Syndrome', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I5400', array('label' => 'I5400. Seizure Disorder or Epilepsy', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I5500', array('label' => 'I5500. Traumatic Brain Injury', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Nutritional');
echo $this->Form->input('SectionI.I5600', array('label' => 'I5600. Malnutrition <span class="normal">(protein or calorie) or at risk for malnutrition</span>', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Phychiatric/Mood Disorder');
echo $this->Form->input('SectionI.I5700', array('label' => 'I5700. Anxiety Disorder', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I5800', array('label' => 'I5800. Depression <span class="normal">(other then bipolar)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I5900', array('label' => 'I5900. Manic Depression <span class="normal">(bipolar disease)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I5950', array('label' => 'I5950. Psychotic Disorder <span class="normal">(other then schizophrenia)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I6000', array('label' => 'I6000. Schizophrenia <span class="normal">(e.g., schizoaffective and schizophreniform disorders)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I6100', array('label' => 'I6100. Post Traumatic Stress Disorder (PTSD)', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Pulmonary');
echo $this->Form->input('SectionI.I6200', array('label' => 'I6200. Asthma, Chronic Obstructive Pulmonary Disease (COPD), or Chronic Lung Disease <span class="normal">(e.g., chronic bronchitis and restrictive lung diseases such as asbestosis)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionI.I6300', array('label' => 'I6300. Respiratory Failure', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Vision');
echo $this->Form->input('SectionI.I6500', array('label' => 'I6500. Cataracts, Glaucoma, or Macular Degeneration', 'type' => 'checkbox'));

echo $this->Html->div('header', 'None of Above');
echo $this->Form->input('SectionI.I7900', array('label' => 'I7900. None of the above active diagnoses <span class="normal">within the last 7 days</span>', 'type' => 'checkbox'));

echo $this->Html->div('header', 'Other');
echo $this->Html->div('', '<strong>I8000. Additional active diagnoses</strong> <br /> <span class="normal">Enter the ICD code in the boxes below</span>');


echo $this->Html->div('', $this->Html->link('Lookup IDC 9 Codes', '/idc9_codes/search', array('class' => 'lookup_idc9')));

echo '<div style="display: block; clear: both">';
echo $this->Form->input('SectionI.I8000A', array('id' => 'I8000A', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000A');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $this->Form->input('SectionI.I8000B', array('id' => 'I8000B', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000B');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $this->Form->input('SectionI.I8000C', array('id' => 'I8000C', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000C');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $this->Form->input('SectionI.I8000D', array('id' => 'I8000D', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000D');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $this->Form->input('SectionI.I8000E', array('id' => 'I8000E', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000E');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $this->Form->input('SectionI.I8000F', array('id' => 'I8000F', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000F');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $this->Form->input('SectionI.I8000G', array('id' => 'I8000G', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000G');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $this->Form->input('SectionI.I8000H', array('id' => 'I8000H', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000H');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $this->Form->input('SectionI.I8000I', array('id' => 'I8000I', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000I');
echo '</div>';

echo '<div style="display: block; clear: both">';
echo $this->Form->input('SectionI.I8000J', array('id' => 'I8000J', 'class' => 'float-left', 'label' => false, 'maxLength' => 8, 'size' => 8, 'div' => false));
echo $this->Html->div('I8000J');
echo '</div>';

?>
</td>
</tr>
</table>