<h2>Section A - Identification Information</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
// faci
// facility provider numbers
echo $this->Html->div('header', 'A0100. Facility Provider Numbers');
echo $form->input('SectionA.A0100A', array('div' => 'input text float-left', 'label' => 'A. NPI Number', 'maxLength' => 10, 'size' => 10));
echo $form->input('SectionA.A0100B', array('div' => 'input text float-left', 'label' => 'B. CMS #', 'maxLength' => 12, 'size' => 12));
echo $form->input('SectionA.A0100C', array('div' => 'input text float-left', 'label' => 'C. State Provider #', 'maxLength' => 15, 'size' => 15));

// type of provider
echo $this->Html->div('header', 'A0200. Type of Provider');
echo $form->input('SectionA.A0200', array('label' => false, 'id' => 'A0200',  'type' => 'select', 'legend' => false, 'empty' => ' ', 'options' => array(
    1 => '1. Nursing Home (SNF/NF)', 
    2 => '2. Swing Bed'
  )));
  
	
// type of assessment
echo $this->Html->div('header', 'A0310. Type of Assessment');
echo $form->input('SectionA.A0310A', array('label' => 'A. Federal OBRA Reason of Assessment', 'id' => 'A0310A',  'type' => 'select', 'empty' => ' ', 'options' => array(
		'01' => '01. Admission assessment (required by day 14)', 
		'02' => '02. Quarterly review assessment', 
		'03' => '03. Annual assessment', 
		'04' => '04. Significant change in status assessment', 
		'05' => '05. Significant correction to prior comprehensive assessment', 
		'06' => '06. Significant correction to prior quarterly assessment', 
		'99' => '99. Not OBRA required assessment', 
	)));
echo $form->input('SectionA.A0310B', array('label' => 'B. PPS Assessment',  'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		'01' => '01. 5-day scheduled assessment', 
		'02' => '02. 14-day scheduled assessment', 
		'03' => '03. 30-day scheduled assessment', 
		'04' => '04. 60-day scheduled assessment', 
		'05' => '05. 90-day scheduled assessment', 
		'06' => '06. Readmission/return assessment', 
		// '07' => '07. Unscheduled assessment used for PPS(OMRA, significant or clinical change, or significant correction)', 
		'07' => '07. Unscheduled assessment used for PPS', 
		'99' => '99. Not PPS assessment', 
	)));
echo $form->input('SectionA.A0310C', array('label' => 'C. PPS Other Medical Required Assessment - OMRA',  'type' => 'select',  'escape' => false, 'empty' => ' ', 'options' => array(
		'0' => '0. No', 
		'1' => '1. Start of therapy assessment', 
		'2' => '2. End of therapy assessment', 
		'3' => '3. Both Start and End of therapy assessment', 
		'4' => '4. Change of therapy assessment.'
	)));
echo $form->input('SectionA.A0310D', array('label' => 'D. Is this a Swing Bed clinical change assessment?', 'id' => 'A0310D', 'selected' => 0, 'div' => 'A0310D input select',  'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    '^' => 'Not Applicable',
		'0' => '0. No', 
		'1' => '1. Yes', 
	)));
echo $form->input('SectionA.A0310E', array('label' => 'E. Is this assessment the first assessment (OBRA, PPS, <br />or Discharge) since the most recent admission',  'type' => 'select',  'escape' => false, 'empty' => ' ', 'options' => array(
		'0' => '0. No', 
		'1' => '1. Yes', 
	)));
echo $form->input('SectionA.A0310F', array('label' => 'F. Entry/discharge reporting', 'id' => 'A0310F',  'type' => 'select',  'escape' => false, 'empty' => ' ', 'options' => array(
		'01' => '01. Entry Record', 
		'10' => '10. Discharge assessment-return not anticipated', 
		'11' => '11. Discharge assessment-return anticipated', 
		'12' => '12. Death in facility record', 
		'99' => '99. Not entry/discharge record'
	)));
	
// submission requirement
echo $this->Html->div('header', 'A0410. Submission Requirement');
echo $form->input('SectionA.A0410', array('type' => 'select', 'label' => false, 'escape' => false, 'empty' => ' ', 'options' => array(
		1 => '1. Neither federal nor state required submission', 
		2 => '2. State but not federal required submission', 
		3 => '3. Federal required submission', 
	)));
  
// legal name of resident
echo $this->Html->div('header', 'A0500. Legal Name of Resident');
echo $form->input('SectionA.A0500A', array('id' => 'A0500A', 'div' => 'input text float-left', 'label' => 'A. First name', 'maxLength' => 12, 'size' => 12));
echo $form->input('SectionA.A0500B', array('id' => 'A0500B', 'div' => 'input text float-left', 'label' => 'B. M.I.', 'maxLength' => 1, 'size' => 1));
echo $form->input('SectionA.A0500C', array('id' => 'A0500C', 'div' => 'input text float-left', 'label' => 'C. Last Name'));
echo $form->input('SectionA.A0500D', array('id' => 'A0500D', 'div' => 'input text float-left', 'label' => 'D. Suffix', 'maxLength' => 3, 'size' => 3));

// social security and medicare numbers
echo $this->Html->div('header', 'A0600. Social Security and MEdicare Numbers');
echo $form->input('SectionA.A0600A', array('div' => 'input text float-left', 'label' => 'A. SSN', 'maxLength' => 9, 'size' => 9));
echo $form->input('SectionA.A0600B', array('div' => 'input text float-left', 'label' => 'B. Medicare/Insurance #', 'maxLength' => 12, 'size' => 12));


// medicaid number
echo $this->Html->div('header', 'A0700. Medicaid Number <span class="normal">- Enter "+" if pending, "N" if not a Medicaid recipient</span>');
echo $form->input('SectionA.A0700', array('label' => false,));

// gender
echo $this->Html->div('header', 'A0800. Gender');
$gender = '';
if (empty($this->data['SectionA']['A0800']) &&$this->data['Resident']['SEX'] == 'M') $gender = 1;
elseif (empty($this->data['SectionA']['A0800']) && $this->data['Resident']['SEX'] == 'F') $gender = 2;
else $gender = $this->data['SectionA']['A0800'];
echo $form->input('SectionA.A0800', array('type' => 'select', 'label' => false,  'selected' => $gender, 'escape' => false, 'empty' => ' ', 'options' => array(
    1 => '1. Male', 
    2 => '2. Female', 
  )));
	
// birth date
echo $this->Html->div('header', 'A0900. Birth Date');
echo $form->input('SectionA.A0900', array('label' => false, 'type' => 'text'));

// race/ethnicity
echo $this->Html->div('header', 'A1000. Race/Ethnicity <span class="normal">( check all that apply )</span>');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $form->input('SectionA.A1000A', array('label' => 'A. American Indian or Alaska native', 'type' => 'checkbox'));
echo $form->input('SectionA.A1000B', array('label' => 'B. Asian', 'type' => 'checkbox'));
echo $form->input('SectionA.A1000C', array('label' => 'C. Black or African American', 'type' => 'checkbox'));
echo $form->input('SectionA.A1000D', array('label' => 'D. Hispanic or Latino', 'type' => 'checkbox'));
echo $form->input('SectionA.A1000E', array('label' => 'E. Native Hawaiian or Other Pacific Islander', 'type' => 'checkbox'));
echo $form->input('SectionA.A1000F', array('label' => 'F. White', 'type' => 'checkbox'));
	
// language
/**
echo $this->Html->div('header', 'A1100. Language');
echo $form->input('SectionA.A1100A', array('label' => 'A. Does the resident need or want an interpreter to communicate with a doctor or health care staff?', 'id' => 'A1100A',  'type' => 'select', 'legend' => false, 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes - Specify in Preferred Language', // if this is selected show A1100B else hide
		9 => '9. Unable to Dertemine', 
	)));
echo $form->input('SectionA.A1100B', array('label' => 'B. Preferred Language', 'div' => 'A1100B input text'));
*/
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php


// martial status
echo $this->Html->div('header', 'A1200. Maritial Status');
$MARSTAT = '';
if ($this->data['SectionA']['A1200'] == ' ') $MARSTAT = 1;
elseif ($this->data['SectionA']['A1200'] == 'N') $MARSTAT = 1;
elseif ($this->data['SectionA']['A1200'] == 'M') $MARSTAT = 2;
elseif ($this->data['SectionA']['A1200'] == 'W') $MARSTAT = 3;
elseif ($this->data['SectionA']['A1200'] == 'S') $MARSTAT = 4;
elseif ($this->data['SectionA']['A1200'] == 'D') $MARSTAT = 5;
else $MARSTAT = $this->data['SectionA']['A1200'];

echo $form->input('SectionA.A1200', array('type' => 'select', 'label' => false, 'selected' => $MARSTAT, 'escape' => false, 'empty' => ' ', 'options' => array(
		1 => '1. Never married', 
		2 => '2. Married', 
		3 => '3. Widowed', 
		4 => '4. Separated', 
		5 => '5. Divorced', 
	)));
  
// optional resident items
echo $this->Html->div('header', 'A1300. Optional Resident Items');
echo $form->input('SectionA.A1300A', array('label' => 'A. Medical Records #', 'maxLength' => 10, 'size' => 10));
echo $form->input('SectionA.A1300B', array('label' => 'B. Room #', 'maxLength' => 12, 'size' => 12));
echo $form->input('SectionA.A1300C', array('label' => 'C. Name by which resident prefers to be addressed', 'maxLength' => 23, 'size' => 23));
echo $form->input('SectionA.A1300D', array('label' => 'D. Lifetime occupation(s) <span class="normal">- put "/" between two occupations</span>', 'maxLength' => 23, 'size' => 23));

// pre admission screening and resident review (PASRR)
echo $this->Html->div('header A1500', 'A1500. Preadmission Screening and Resident Review (PASRR)');
echo $form->input('SectionA.A1500', array('label' => 'Has the resident been evaluated by Level II PASRR and determined to have a serious mental illness and/or mental retardation or a related condition?',  'type' => 'select', 'escape' => false, 'div' => 'A1500 input select', 'empty' => ' ', 'options' => array(
		'0' => '0. No', 
		'1' => '1. Yes', 
		'9' => '9. Not a Medicaid certified unit', 
	)));
	
// conditions related to mr/dd status
/**
echo $this->Html->div('header A1550', 'A1550. Conditions Related to MR/DD Status');

echo $this->Html->div('note A1550', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE: Check all conditions that are related to MR/DD status</strong> that were manifested before age 22, and are likely to continue indefinitely');
echo $this->Html->div('misc A1550', 'MR/DD With Organic Condition');
echo $form->input('SectionA.A1550A', array('label' => 'A. Down Syndrome', 'type' => 'checkbox', 'div' => 'A1550 input checkbox'));
echo $form->input('SectionA.A1550B', array('label' => 'B. Autism', 'type' => 'checkbox', 'div' => 'A1550 input checkbox'));
echo $form->input('SectionA.A1550C', array('label' => 'C. Epilepsy', 'type' => 'checkbox', 'div' => 'A1550 input checkbox'));
echo $form->input('SectionA.A1550D', array('label' => 'D. Other organic condition related to MR/DD', 'type' => 'checkbox', 'div' => 'A1550 input checkbox'));
echo $this->Html->div('misc A1550', 'MR/DD Without Organic Condition');
echo $form->input('SectionA.A1550E', array('label' => 'E. MR/DD with no organic condition', 'type' => 'checkbox', 'div' => 'A1550 input checkbox'));
echo $this->Html->div('misc A1550', 'No MR/DD');
echo $form->input('SectionA.A1550Z', array('label' => 'Z. None of the Above', 'type' => 'checkbox', 'div' => 'A1550 input checkbox'));
*/

// entry date
echo $this->Html->div('header A1600', 'A1600. Entry Date (date of this admission/reentry into the facility)');
echo $form->input('SectionA.A1600', array('label' => false, 'type' => 'text'));

// pre admission screening and resident review (PASRR)
echo $this->Html->div('header A1700', 'A1700. Type of Entry');
echo $form->input('SectionA.A1700', array('label' => false,  'type' => 'select', 'legend' => false, 'escape' => false, 'div' => 'A1700 input select', 'empty' => ' ', 'options' => array(
    1 => '1. Admission', 
    2 => '2. Reentry', 
  )));
  
// entered form
echo $this->Html->div('header A1800', 'A1800. Entered From');
echo $form->input('SectionA.A1800', array( 'type' => 'select', 'label' => false, 'escape' => false, 'empty' => ' ', 'options' => array(
		'01' => '01. Community (private home/apt., board/care, assisted living, group home)', 
		'02' => '02. Another nursing home or swing bed', 
		'03' => '03. Acute hospital', 
		'04' => '04. Psychiatric hospital', 
		'05' => '05. Inpatient rehabilitation facility', 
		'06' => '05. MR/DD facility',  
		'07' => '07. Hospice',  
		'99' => '99. Other', 
	)));

// discharge date
echo $this->Html->div('header A2000', 'A2000. Discharge Date');
echo $form->input('SectionA.A2000', array('label' => false, 'type' => 'text'));

// discharge status
echo $this->Html->div('header A2100', 'A2100. Discharge Status');
echo $form->input('SectionA.A2100', array('label' => false, 'div' => 'input select A2100',  'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		'^' => 'Not Applicable', 
		'01' => '01. Community (private home/apt., board/care, assisted living, group home)', 
		'02' => '02. Another nursing home or swing bed', 
		'03' => '03. Acute hospital', 
		'04' => '04. Psychiatric hospital', 
		'05' => '05. Inpatient rehabilitation facility', 
		'06' => '05. MR/DD facility',  
    '07' => '07. Hospice',  
    '08' => '08. Deceased',  
		'99' => '99. Other', 
	)));

// Assessment Reference Date
echo $this->Html->div('header A2300', 'A2300. Assessment Reference Date');
echo $form->input('SectionA.A2300', array('label' => false, 'type' => 'text'));

// medicare stay
echo $this->Html->div('header A2400', 'A2400. Medicare Stay');
echo $form->input('SectionA.A2400A', array('id' => 'A2400A', 'label' => 'A. Has the resident had a Medicare-covered stay since the most recent entry?',  'type' => 'select', 'legend' => false, 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes', 
	)));
echo $form->input('SectionA.A2400B', array('label' => false, 'type' => 'text'));
echo $form->input('SectionA.A2400C', array('label' => false, 'type' => 'text'));
?>
</td>
</tr>
</table>