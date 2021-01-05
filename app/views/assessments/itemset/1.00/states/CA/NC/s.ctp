<h2>Section S - California Specific Items</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $form->input('SectionS.S9040A', array('label' => 'S9040A - Does resident have a California POLST form in chart?', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(0 => '0. No', 1 => '1. Yes')));
echo $form->input('SectionS.S9040B', array('label' => 'S9040B - CA ‐ Item selected in California POLST Section A', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
	1 => '1 - Attempt resuscitation/CPR', 
	2 => '2 - Do not attempt resuscitation/DNR', 
	9 => '9 - Not completed'
)));
echo $form->input('SectionS.S9040C', array('label' => 'S9040C - CA ‐ Item selected in California POLST Section B', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
	1 => '1 - Comfort measures only is checked', 
	2 => '2 - Limited additional interventions is the only box checked', 
	3 => '3 - Limited additional interventions AND "Transfer to hospital only if comfort needs cannot be met in current location" are BOTH checked"', 
	4 => '4 - Full Treatment is checked', 
	9 => '9 - Not completed'
)));
echo $form->input('SectionS.S9040D', array('label' => 'S9040D - CA ‐ item selected in California POLST Section C', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
	1 => '1 - No artificial means of nutrition, including feeding tubes', 
	2 => '2 - Trial period of artificial nutrition including feeding tubes', 
	3 => '3 - Long term artificial nutrition including feeding tubes', 
	9 => '9 - Not completed'
)));
echo $form->input('SectionS.S9040E', array('label' => 'S9040E - CA ‐ POLST Section D ‐ Signature of Physician', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
	0 => '0 - No', 
	1 => '1 - Yes', 
)));
echo $form->input('SectionS.S9040F', array('label' => 'S9040F - CA ‐ POLST Section D ‐ Signature by Patient or Decisionmaker', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
	0 => '0 - No', 
	1 => '1 - Yes', 
)));
echo $form->input('SectionS.S9040G', array('label' => 'S9040G - Discussed with in California POLST Section D', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
	1 => '1 - Patient', 
	2 => '2 - Legally Recognized Decisionmaker', 
	9 => '9 - Not completed', 
)));
echo $form->input('SectionS.S9040H', array('label' => 'S9040H - California POLST Section D‐ Advance Directive: ', 'type' => 'select', 'empty' => '( select an option )', 'options' => array(
	1 => '1 - Advance directive available and reviewed', 
	2 => '2 - Advance directive not available', 
	3 => '3 - No advance directive', 
	9 => '9 - Not completed', 
)));





echo $form->input('SectionS.S9040C', array('label' => 'S9040C - CA ‐ Item selected in California POLST Section B', 'type' => 'select', 'empty' => '( select an option )', 'options' => array('0. No', '1. Yes')));
echo $form->input('SectionS.S9040D', array('label' => 'S9040D - Does resident have a California POLST form in chart?', 'type' => 'select', 'empty' => '( select an option )', 'options' => array('0. No', '1. Yes')));
echo $form->input('SectionS.S9040E', array('label' => 'S9040E - Does resident have a California POLST form in chart?', 'type' => 'select', 'empty' => '( select an option )', 'options' => array('0. No', '1. Yes')));
echo $form->input('SectionS.S9040F', array('label' => 'S9040F - Does resident have a California POLST form in chart?', 'type' => 'select', 'empty' => '( select an option )', 'options' => array('0. No', '1. Yes')));
echo $form->input('SectionS.S9040G', array('label' => 'S9040G - Does resident have a California POLST form in chart?', 'type' => 'select', 'empty' => '( select an option )', 'options' => array('0. No', '1. Yes')));
echo $form->input('SectionS.S9040H', array('label' => 'S9040H - Does resident have a California POLST form in chart?', 'type' => 'select', 'empty' => '( select an option )', 'options' => array('0. No', '1. Yes')));

?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">&nbsp;</td>
</table>