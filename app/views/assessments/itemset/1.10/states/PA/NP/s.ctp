<h2>Section S - Pennsylvania Specific Items</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
// echo $this->Html->div('header', 'Demographic');
// echo $form->input('SectionS.S0120', array('label' => 'S0120. ZIP Code of Prior Primary Residence. <span class="normal">Enter the first five digits of the zip code</span>', 'type' => 'text', 'maxLength' => 5, 'size' => 5));
// echo $form->input('SectionS.S0123', array('label' => 'S0123. County Code of Prior Residence. <span class="normal">Enter the first five digits of the zip code</span>', 'type' => 'select', 'options' => $counties_pa, 'empty' => '( select an option )'));

echo $this->Html->div('header S8010H1', 'Discharge after Discharge');
echo $this->Html->div('header S8010H1', 'S8010H1. Picture reporting date');
echo $form->input('SectionS.S8010H1', array('label' => 'Check this item if the assessment is a Discharge Return Anticipated assessment (DRA) AND is to be used as a Dischargr Return Not Anticipated (DRNA) for Picture Date reporting requirements', 'type' => 'select', 'options' => array('No', 'Yes'), 'empty' => '( select an option )'));


echo $this->Html->div('header', 'Payment');
echo $this->Html->div('header', 'S9080. Source of Payment');
echo $form->input('SectionS.S9080A', array('label' => 'A. Is the resident Medical Assistance for MA CASE-MIX? (see instructions)', 'type' => 'select', 'options' => array('No', 'Yes'), 'empty' => '( select an option )'));
echo $form->input('SectionS.S9080B', array('label' => 'B. Date of change to/form Medical Assitance for MA CASE-MIX', 'type' => 'text', 'between' => 'Format as YYYY-MM-DD <br />', 'maxLength' => 10, 'size' => 10));
echo $form->input('SectionS.S9080C', array('label' => 'C. Recipient Number from PA ACCESS Card (must be completed if S9080A = 1)', 'type' => 'text', 'maxLength' => 10, 'size' => 10));
echo $form->input('SectionS.S9080D', array('label' => 'D. MA NF Effective date from PA/FS 162', 'type' => 'text', 'between' => 'Format as YYYY-MM-DD <br />', 'maxLength' => 10, 'size' => 10));
// echo $form->input('SectionS.S9080E', array('label' => 'E. Is the resident DAY ONE MA Eligible?', 'type' => 'select', 'options' => array('No', 'Yes'), 'empty' => '( select an option )'));
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">   &nbsp;</td>
</table>