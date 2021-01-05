<h2>Section H - Bladder and Bowel</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'H0100. Appliances');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $form->input('SectionH.H0100A', array('label' => 'A. Indewilling catheter <span class="normal">(including suprapublic catheter and enphrostomy tube)</span>', 'type' => 'checkbox'));
echo $form->input('SectionH.H0100B', array('label' => 'B. External catheter', 'type' => 'checkbox'));
echo $form->input('SectionH.H0100C', array('label' => 'C. Ostomy <span class="normal">(including urostomy, ileostomy, and colostomy)</span>', 'type' => 'checkbox'));
echo $form->input('SectionH.H0100D', array('label' => 'D. Intermittent catheterization', 'type' => 'checkbox'));
echo $form->input('SectionH.H0100Z', array('label' => 'Z. None of the above', 'type' => 'checkbox'));

echo $this->Html->div('header', 'H0200. Urinary Toileting Program');
/**
echo $form->input('SectionH.H0200A', array('label' => 'A. Has a trial of a tolieting program (e.g., scheduled toileting, prompted voiding, or bladder training) <span class="normal">been attempted on admission/reentry or since urinary incontinence was noted in this facility?</span>', 'id' => 'H0200A',  'type' => 'select',  'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes',
		9 => '9. Unable to determine'
	)));
	
echo $form->input('SectionH.H0200B', array('label' => 'B. Response - <span class="normal">What was the resident\'s response to the trial program?</span>', 'id' => 'H0200B',  'type' => 'select','div' => 'input select H0200B', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No improvement', 
		1 => '1. Decreased wetness',
		2 => '2. Completely dry (continent)',
		9 => '9. Unable to determine or trial in progress'
	)));
*/

echo $form->input('SectionH.H0200C', array('div' => 'input select H0200C', 'label' => 'C. Current Toileting program or trial - <span class="normal">Is a toileting program (e.g., scheduled toileting, prompted voiding, or bladder training) currently being used to manage the resident\'s urinary continence?</span>', 'id' => 'H0200C',  'type' => 'select',  'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes',
	)));
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'H0300. Urinary Continence');
echo $form->input('SectionH.H0300', array('label' => 'Urinary continence <span class="normal">Select the one category that best describes the resident</span>', 'id' => 'H0300', 'type' => 'radio', 'legend' => false, 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. Always continent', 
		1 => '1. Occasionally incontinent (less than 7 episodes of incontinence)',
    2 => '2. Frequently incontinent (7 or more episodes of urinary incontinence, but atleast one episode of continent voiding)',
    3 => '3. Always incontinent (no episodes of continent voiding)',
		9 => '9. Not rated, resident had a catheter (indwelling, condom), urinary ostomy, or no urine output for the entire 7 days',
	)));

echo $this->Html->div('header', 'H0400. Bowel Continence');
echo $form->input('SectionH.H0400', array('legend' => 'Bowel Continence <span class="normal">Select the one category that best describes the resident</span>', 'id' => 'H0400', 'type' => 'radio', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. Always continent', 
    1 => '1. Occasionally incontinent (one episode of bowel incontinence)',
    2 => '2. Frequently incontinent (2 or more episodes of bowel incontinence, but at least one continent bowel movement)',
    3 => '3. Always incontinent (no episodes of continent bowel movements)',
    9 => '9. Not rated, resident had an ostomy or did not have a bowel movement for the entire 7 days',
  )));


echo $this->Html->div('header', 'H0500. Bowel Toileting Program');
echo $form->input('SectionH.H0500', array('label' => 'Is a toileting program currently being used to manage the resident\'s bowel continence?', 'id' => 'H0500',  'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes',
	)));
	
/**
echo $this->Html->div('header', 'H0600. Bowel Patterns');
echo $form->input('SectionH.H0600', array('label' => 'Constipation present?', 'id' => 'H0600',  'type' => 'select', 'legend' => false, 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes',
	)));
*/
?>
</td>
</table>