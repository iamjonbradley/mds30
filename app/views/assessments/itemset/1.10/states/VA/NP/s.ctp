<h2>Section S - Virginia Specific Items</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'State Specific');
echo $this->Html->div('header', 'S9100. VA - Per Diem Reimbursement');
echo $this->Html->div('note', '<img class="note-img" src="/img/icons/lightbulb.png"> <strong>NOTE:</strong> Code for the primary source of per diem room and board reimbursement for the resident on the date indicated.');

$options = array(
  1 => 'Virginia Medicaid per diem',
  2 => 'Virginia Medicaid Specialized Care per diem',
  3 => 'Managed care organization reimbursement',
  4 => 'Other reimbursement source'  
);

echo $form->input('SectionS.S9100A', array('label' => 'A. Assessment Reference Date (A2300)', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S9100B', array('label' => 'B. Date of Entry (A1600)', 'type' => 'select', 'empty' => '( select an option )', 'options' => $options));
echo $form->input('SectionS.S9100C', array('label' => 'C. VA  - Initial Date Medicaid Per Diem <span class="normal">Initial date for primary source of per diem room and board reimbursement to be Virginia Medicaid for this stay</span>', 'type' => 'text', 'between' => 'Format as YYYY-MM-DD <br />', 'maxLength' => 10, 'size' => 10));
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">   &nbsp;</td>
</table>