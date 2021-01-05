<h2>Section L - Oral/Dental Status</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'L0200. Dental');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $form->input('SectionL.L0200A', array('label' => 'A. Broken or loosely fitting full or partial denture <span class="normal">(chipped, cracked, uncleanable, or loose)</span>', 'type' => 'checkbox'));
echo $form->input('SectionL.L0200B', array('label' => 'B. No natural teeth or tooth fragment(s) <span class="normal">(edentulous)</span>', 'type' => 'checkbox'));
echo $form->input('SectionL.L0200C', array('label' => 'C. Abnormal mouth tissue <span class="normal">(ulcers, masses, oral lesions, including under denture or partial if one is worn)</span>', 'type' => 'checkbox'));
echo $form->input('SectionL.L0200D', array('label' => 'D. Obvious or likely cavity or broken natural teeth', 'type' => 'checkbox'));
echo $form->input('SectionL.L0200E', array('label' => 'E. Inflamed or bleeding gums or loose natural teeth', 'type' => 'checkbox'));
echo $form->input('SectionL.L0200F', array('label' => 'F. Mouth or facial pain, discomfort or difficulty with chewing', 'type' => 'checkbox'));
echo $form->input('SectionL.L0200G', array('label' => 'G. Unable to examine', 'type' => 'checkbox'));
echo $form->input('SectionL.L0200Z', array('label' => 'Z. None of the above were present', 'type' => 'checkbox'));
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
  
?>
</td>
</table>