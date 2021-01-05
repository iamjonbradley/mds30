<h2>Section V - Care Area Assessments (CAA) Summary</h2>

<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php

echo $this->Form->hidden('SectionV.A0310E', array('value' => $this->data['SectionA']['A0310E']));
echo '<div class="V0100-SKIP">';
echo $this->Html->div('header', 'V0100. Items from the Most Recent Prior OBRA or Scheduled PPS Assessment');
echo $this->Form->input('SectionV.V0100A', array('label' => 'A. Prior Asessment Federal OBRA Reason for Assessment', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		'01' => '01. Admission assessment (required by day 14)',
		'02' => '02. Quarterly review assessment',
		'03' => '03. Annual assessment',
		'04' => '04. Significant change in status assessment',
		'05' => '05. Significant correction to prior comprehensive assessment',
		'06' => '06. Significant correction to prior quarterly assessment',
		'99' => '99. Not OBRA requred assessment',
	)));
echo $this->Form->input('SectionV.V0100B', array('label' => 'B. Prior Asessment PPS Reason for Assessment', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		'01' => '01. 5-day scheduled assessment',
		'02' => '02. 14-day scheduled assessment',
		'03' => '03. 30-day scheduled assessment',
		'04' => '04. 60-day scheduled assessment',
		'05' => '05. 90-day scheduled assessment',
		'06' => '06. Readmission/return assessment',
		'07' => '07. Unscheduled assessment used for PPS',
		'99' => '99. Not PPS assessment',
	)));
echo $this->Form->input('SectionV.V0100C', array('label' => 'C. Prior Assessment Reference Date', 'type' => 'text', 'between' => 'Format as YYYY-MM-DD<br />', 'maxLength' => 10, 'size' => 10));
echo $this->Form->input('SectionV.V0100D', array('label' => 'D. Prior Assessment Brief Interview for Mental status (BIMS) Summary Score', 'maxLength' => 2, 'size' => 2));
echo $this->Form->input('SectionV.V0100E', array('label' => 'E. Prior Assessment Reisdent Mood Interview (PHQ-9&copy;) Total Severity Score', 'maxLength' => 2, 'size' => 2));
echo $this->Form->input('SectionV.V0100F', array('label' => 'F. Prior Assessment Staff Assessment of Resident Mood (PHQ-9-OV) Total Severity Score', 'maxLength' => 2, 'size' => 2));
echo '</div>';

echo $this->Html->div('header', 'V0200. CAAs and Care Planning');
?>
<style>
  .results tr td input[type="checkbox"]  { float: none; }
  .results tr th a { display: inline; padding: 0; }
</style>
1. Check column A if Care Area is triggered. 
<br><br>
2. For each triggered Care Area, indicate whether a new care plan, care plan revision, or continuation of current care plan is necessary to address the problem(s) identified in your assessment of the care area. The Addressed in Care Plan column must be completed within 7 days of completing the RAI (MDS and CAA(s)). Check column B if the triggered care area is addressed in the care plan. 
<br><br>
3. Indicate in the Location and Date of CAA Information column where information related to the CAA can be found. CAA documentation should include information on the complicating factors, risks, and any referrals for this resident for this care area.
<?php

echo $this->Html->div('header', 'A. CAA Results');
?>
<table cellspacing="0" cellpadding="0" width="100%" class="results">
  <tr>
    <th class="align-top">CARE AREA</th>
    <th>A. <br> <span class="small">CARE AREA TRIGGERED</span></th>
    <th>B. <br> <span class="small">ADDRESSED IN CARE PLAN</span></th>
    <th class="align-top">
      LOCATION AND DATE OF CAA INFORMATION <br /><br />
      <span class="small"><strong>NOTE: </strong> To add care plan <a href="/assessments/caa/<?php echo $this->data['Assessment']['id']; ?>">click here</a>.</span>
    </th>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">01. Delirium</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A01A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A01B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A01C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">02. Congitive Loss/Dementia</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A02A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A02B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A02C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">03. Visual Function</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A03A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A03B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A03C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">04. Communication</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A04A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A04B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A04C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">05. ADL Functional/Rehabilitation Potential</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A05A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A05B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A05C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">06. Urinary Incontinence and Indwelling Catheter</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A06A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A06B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A06C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">07. Psychosocial Well-Being</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A07A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A07B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A07C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">08. Mood State</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A08A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A08B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A08C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">09. Behavioral Symptoms</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A09A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A09B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A09C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">10. Activites</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A10A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A10B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A10C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">11. Falls</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A11A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A11B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A11C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">12. Nutritional Status</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A12A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A12B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A12C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">13. Feeding Tubes</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A13A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A13B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A13C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">14. Dehydration/Fluid Maintenance</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A14A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A14B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A14C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">15. Dental Care</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A15A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A15B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A15C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">16. Pressure Ulcer</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A16A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A16B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A16C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">17. Psychotropic Drug Use</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A17A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A17B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A17C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">18. Physical Restraints</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A18A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A18B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A18C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">19. Pain</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A19A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A19B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A19C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
  <tr>
    <td class="valign-middle bold align-left" width="40%">20. Return to Community Referral</td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A20A', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold bg-gray"><?php echo $this->Form->input('SectionV.V0200A20B', array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
    <td class="valign-middle align-center bold" width="40%"><?php echo $this->Form->input('SectionV.V0200A20C', array('label' => false, 'div' => false, 'maxLength' => 20, 'size' => 20)); ?></td>
  </tr>
</table>
<?php
echo $this->Html->div('header', 'Signature of RN Coordinator for CAA Process and Date Signed');
echo $this->Form->input('SectionV.V0200B1', array('label' => 'B1. Signature', 'div' => 'input text float-left', 'maxLength' => 30, 'size' => 30));
echo $this->Form->input('SectionV.V0200B2', array('label' => 'B2. Date', 'div' => 'input text float-left', 'type' => 'text', 'after' => '&nbsp;&nbsp;&nbsp; Format as YYYY-MM-DD<br />', 'maxLength' => 10, 'size' => 10));

echo $this->Html->div('header', 'Signature of Person Completing Care Plan and Date Signed');
echo $this->Form->input('SectionV.V0200C1', array('label' => 'C1. Signature', 'div' => 'input text float-left', 'maxLength' => 30, 'size' => 30));
echo $this->Form->input('SectionV.V0200C2', array('label' => 'C2. Date', 'div' => 'input text float-left', 'type' => 'text', 'after' => '&nbsp;&nbsp;&nbsp; Format as YYYY-MM-DD<br />', 'maxLength' => 10, 'size' => 10));

?>
</td>
</tr>
</table>