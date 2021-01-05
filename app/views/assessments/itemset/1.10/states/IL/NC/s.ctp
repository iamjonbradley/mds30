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

echo $this->Html->div('header', 'Mental Health/Substance Abuse');
echo $this->Html->div('header', 'S4000. Harm to Self or Others');
echo $form->input('SectionS.S4000A', array('label' => 'A. Self-injurious attempt (Code for most recent instance)', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
  '0. Never', 
  '1. Attempt more than 1 year ago', 
  '2. Attempt in the last year',
  '3. Attempt in the last 7 days',
  '4. Attempt within the last 3 days',
)));
echo $form->input('SectionS.S4000B', array('label' => 'B. Intent of any self-injurious attempt was to kill him/herself', 'type' => 'select', 'empty' => '( select an option )', 'options' => array('0. No', '1. Yes')));
echo $form->input('SectionS.S4000C', array('label' => 'C. Considered performing a self-injurious act in the last 30 days', 'type' => 'select', 'empty' => '( select an option )', 'options' => array('0. No', '1. Yes')));
echo $form->input('SectionS.S4000D', array('label' => 'D. Family/caregiver/friend/staff expresses concern that resident is at risk for self injury', 'type' => 'select', 'empty' => '( select an option )', 'options' => array('0. No', '1. Yes')));

echo $this->Html->div('header', 'S4010. Harm to Self or Others');
echo $this->Html->div('note', '<img class="note-img" src="/img/icons/lightbulb.png"> <strong>NOTE:</strong> Number of days of the following type of supervision in the last 3 days. If none, code"0".');

echo $form->input('SectionS.S4010A', array('label' => 'A. Checked at hourly intervals', 'maxLength' => 1, 'size' => 1));
echo $form->input('SectionS.S4010B', array('label' => 'B. Checked at 15-minute intervals', 'maxLength' => 1, 'size' => 1));
echo $form->input('SectionS.S4010C', array('label' => 'C. Checked at 5-minute intervals', 'maxLength' => 1, 'size' => 1));
echo $form->input('SectionS.S4010D', array('label' => 'D. Constant Observation for less than or equal to 1 hour', 'maxLength' => 1, 'size' => 1));
echo $form->input('SectionS.S4010E', array('label' => 'Constant Observation for more than 1 hour ', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('header', 'Substance Abuse &amp; Excessive Behaviors');
echo $form->input('SectionS.S4500', array('label' => 'S4500. Alcohol - code for the highest number of drinks in any single sitting episode in the last 14 days', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
  '0. None', 
  '1. One', 
  '2. Two to Four', 
  '3. Five or more', 
)));
echo $this->Html->div('header', 'S4510. Substance abuse time since any use the following:');
$options = array(
  '0. Never or more than one year ago',
  '1. Within the last year',
  '2. Within last 3 months',
  '3. Within last month',
  '4. Within the last 7 days',
  '5. Within the last 3 days',
);
echo $form->input('SectionS.S4510A', array('label' => 'A. Inhalants', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S4510B', array('label' => 'B. Hallucinogens', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S4510C', array('label' => 'C. Cocain and crack', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S4510D', array('label' => 'D. Stimulants', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S4510E', array('label' => 'E. Opiates', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S4510F', array('label' => 'F. Cannabis', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'State Specific');
echo $this->Html->div('header', 'S9000. IL - Skills Training was provided in accordiance with Illinois DPH Section 300.4050) a) 1) A- D and 300.4050 a) 4) and Illinois DPA Section 147, Table A');
echo $form->input('SectionS.S9000', array('label' => false, 'type' => 'select', 'empty' => '( select an option )', 'options' => array('0. No', '1. Yes')));

echo $this->Html->div('header', 'S9002. IL - If answered Yes to S9001, proceed with psychiatric service items below, If answered No, do not proceed.');
echo $this->Html->div('note', '<img class="note-img" src="/img/icons/lightbulb.png"> <strong>NOTE:</strong> Check all that apply:');
$options = array('0. Unchecked', '1. Checked');
echo $form->input('SectionS.S9002A', array('label' => 'A. Schizophrenia', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S9002B', array('label' => 'B. Delusional disorder', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S9002C', array('label' => 'C. Schizoaffective disorder', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S9002D', array('label' => 'D. Psychotic disorder not otherwise specified', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S9002E', array('label' => 'E. Bipolar I mixed, Manic, and Depressed', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S9002F', array('label' => 'F. Bipolar Disorder II', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S9002G', array('label' => 'G. Cyclothymic Disorder', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S9002H', array('label' => 'H. Bipolar Disorder not otherwise specified', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S9002I', array('label' => 'I. Major depression, recurrent', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));

echo $this->Html->div('header', 'S9003. IL - Ancillary Provider Services');
echo $form->input('SectionS.S9003', array('label' => 'Does resident receive direct services delivered by non-facility providers to meet requirements of Illinois Subpart S? <span class="normal">(exclude only medical/psychiatric management by primary psychiatrist/physician)</span>', 'type' => 'select', 'empty' => '( select an option )', 'options' => array('0. No', '1. Yes')));
?>
  
</td>
</table>