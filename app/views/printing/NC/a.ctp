<!-- page 1 start -->
<?php echo $this->Print->header ($data['SectionA']); ?>

<div class="spacer"></div>

<h2>MINIMUM DATA SET (MDS) - Version 3.0 <br />
RESIDENT ASSESSMENT AND CARE SCREENING <br />
Nursing Home Comprehensive (NC) Item Set</h2>

<div class="spacer"></div>

<table width="100%">
  <tr>
    <td class="header">Section A</td>
    <td class="header-normal">Identification Information</td>
  </tr>
</table>

<div class="spacer"></div>

<table width="100%">
  <tr><td class="header-main border-bottom" colspan="2">A0100. Facility Provider Numbers</td></tr>
  
  <tr>
    <td class="left border-right" rowspan="3"> </td>
    <td>
      <strong>A. National Provider Identifier (NPI):</strong> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0100A'], 10, 'right'); ?>
    </td>
  </tr>
  <tr>
    <td>
      <strong>B. CMS Certification Number (CCN):</strong> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0100B'], 12, 'right'); ?>
    </td>
  </tr>
  <tr>
    <td>
      <strong>C. State Provider Number:</strong> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0100C'], 15, 'right'); ?>
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="2">A0200. Type of Provider</td></tr>
  
  <tr>
    <td class="left border-right border-bottom align-center">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0200'], 1, 'left'); ?>
    </td>
    <td>
      <strong>A. Type of provider</strong> <br />
      <span class="tab">1. <strong>Nursing home (SNF/NF)</strong></span> <br />
      <span class="tab">2. <strong>Swing Bed</strong></span> <br />
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="2">A0310. Type of Assessment</td></tr>
  
  <tr>
    <td class="left border-right align-center top-ten" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0310A'], 2, 'left'); ?>
    </td>
    <td>
      <strong>A. Type of provider</strong> <br />
      <span class="tab">01. <strong>Admission</strong> assessment (required by day 14)</span> <br />
      <span class="tab">02. <strong>Quarterly</strong> review assessment</span> <br />
      <span class="tab">03. <strong>Annual</strong> assessment</span> <br />
      <span class="tab">04. <strong>Significant change in status</strong> assessment</span> <br />
      <span class="tab">05. <strong>Significant correction</strong> to <strong>prior comprehensive</strong> assessment</span> <br />
      <span class="tab">06. <strong>Significant correction</strong> to <strong>prior quarterly</strong> assessment</span> <br />
      <span class="tab">99. <strong>Not OBRA required</strong> assessment</span>
    </td>
  </tr>
  
  <tr>
    <td class="left border-right align-center top-ten" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0310B'], 2, 'left'); ?>
    </td>
    <td class="border-top">
      <strong>B. PPS Assessment</strong> <br />
      <span class="tab"><strong><u>PPS Scheduled Assessments for a Medicare Part A Stay</u></strong></span> <br />
      <span class="tab">01. <strong>5-day</strong> scheduled assessment</span> <br />
      <span class="tab">02. <strong>14-day</strong> scheduled assessment</span> <br />
      <span class="tab">03. <strong>30-day</strong> scheduled assessment</span> <br />
      <span class="tab">04. <strong>60-day</strong> scheduled assessment</span> <br />
      <span class="tab">05. <strong>90-day</strong> scheduled assessment</span> <br />
      <span class="tab">06. <strong>Readmission/return</strong> assessment</span> <br />
      <span class="tab"><strong><u>PPS Unscheduled Assessments for a Medicare Part A Stay</u></strong></span> <br />
      <span class="tab">07. <strong>Unscheduled assessment used for PPS</strong> (OMRA, significant or clinical change, or significant correction asssessment)</span> <br />
      <span class="tab"><strong><u>Not PPS Assessment</u></strong></span> <br />
      <span class="tab">99. <strong>Not PPS</strong> assessment</span>
    </td>
  </tr>
  
  <tr>
    <td class="left border-right align-center top-ten" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0310C'], 1, 'left'); ?>
    </td>
    <td class="border-top">
      <strong>C. PPS Other Medicare Required Assessment - OMRA</strong> <br />
      <span class="tab">0. <strong>No</strong></span> <br />
      <span class="tab">1. <strong>Start of therapy</strong> review assessment</span> <br />
      <span class="tab">2. <strong>End of therapy</strong> assessment</span> <br />
      <span class="tab">2. <strong>Both Start and End of therapy</strong> assessment</span>
    </td>
  </tr>
  
  <tr>
    <td class="left border-right align-center top-ten" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0310D'], 1, 'left'); ?>
    </td>
    <td class="border-top">
      <strong>D. Is this a Swing Bed clinical change assessment?</strong> Complete only if A0200 = 2 <br />
      <span class="tab">0. <strong>No</strong></span> <br />
      <span class="tab">1. <strong>Yes</strong></span>
    </td>
  </tr>
  
  <tr>
    <td class="left border-right align-center top-ten" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0310E'], 1, 'left'); ?>
    </td>
    <td class="border-top">
      <strong>E. Is this assessment the first assessment</strong> (OBRA, PPS, or Discharnge) <strong>since the most recent admission?</strong> <br />
      <span class="tab">0. <strong>No</strong></span> <br />
      <span class="tab">1. <strong>Yes</strong></span>
    </td>
  </tr>
  
  <tr>
    <td class="left border-right align-center top-ten" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0310F'], 2, 'left'); ?>
    </td>
    <td class="border-top">
      <strong>F. Entry/discharge reporting</strong> <br />
      <span class="tab">01. <strong>Entry</strong> record</span> <br />
      <span class="tab">10. <strong>Discharge</strong> assessment-<strong>return not anticipated</strong></span> <br />
      <span class="tab">11. <strong>Discharge</strong> assessment-<strong>return anticipated</strong></span> <br />
      <span class="tab">12. <strong>Death in facility</strong> record</span> <br />
      <span class="tab">12. <strong>Not entry/discharge</strong> record</span> 
    </td>
  </tr>
</table>
<!-- page 1 end -->
<div style="page-break-after:always;"> </div>
<!-- page 2 start -->
<?php echo $this->Print->header ($data['SectionA']); ?>
<div class="spacer"></div>

<table width="100%">
  <tr>
    <td class="header">Section A</td>
    <td class="header-normal">Identification Information</td>
  </tr>
</table>

<div class="spacer"></div>

<table width="100%">
  <tr><td class="header-main border-bottom border-top" colspan="3">A0410. Submission Requirement</td></tr>
  <tr>
    <td class="left border-right align-center top-ten" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0410'], 1, 'left'); ?>
    </td>
    <td class="border-top" colspan="2">
      <span class="tab">1. <strong>Neither federal nor state required submission</strong></span> <br />
      <span class="tab">2. <strong>Sate but not federal required submission</strong> (FOR NURSING HOME ONLY)</span> <br />
      <span class="tab">3. <strong>Federal required submission</strong></span> <br />
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="3">A0500. Legal name of Resident</td></tr>
  
  <tr>
    <td class="left border-right" rowspan="2"> </td>
    <td>
      <strong>A. First name:</strong> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0500A'], 12, 'right'); ?>
    </td>
    <td>
      <strong>B. Middle initial:</strong> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0500B'], 1, 'right'); ?>
    </td>
  </tr>
  <tr>
    <td>
      <strong>C. Last name:</strong> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0500C'], 18, 'right'); ?>
    </td>
    <td>
      <strong>D. Suffix:</strong> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0500D'], 3, 'right'); ?>
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="3">A0600. Social Security and Medicare Numbers</td></tr>
  
  <tr>
    <td class="left border-right" rowspan="2"> </td>
    <td colspan="2">
      <strong>A. Social Security Number:</strong> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0600A'], 9, 'right'); ?>
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <strong>B. Medicare number</strong> (or comparable railroad insurance numbers):<br />
      <?php  echo $this->Print->field($data['SectionA']['A0600B'], 12, 'right'); ?>
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="3">A0700. Medicaid Number <span class="normal">- Enter "+" if pending, "N" if not a Medicaid recipient</span></td></tr>
  
  <tr>
    <td class="left border-right"> </td>
    <td colspan="2">
      <?php  echo $this->Print->field($data['SectionA']['A0700'], 14, 'right'); ?>
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="3">A0800. Gender</td></tr>
  
  <tr>
    <td class="left border-right align-center top-ten" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A0800'], 1, 'left'); ?>
    </td>
    <td class="border-top" colspan="2">
      <span class="tab">1. <strong>Male</strong></span> <br />
      <span class="tab">2. <strong>Female</strong></span>
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="3">A0900. Birth Date</td></tr>
  
  <tr>
    <td class="left border-right"> </td>
    <td colspan="2">
      <?php  echo $this->Print->field($data['SectionA']['A0900'], 10, 'right'); ?>
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="3">A1000. Race/Ethnicity</td></tr>
  <tr><td colspan="3" class="border-bottom"><img src="/img/arrow.png" alt="" /> <strong>Check all that apply</strong></td></tr>
  <tr>
    <td class="left border-right align-center" valign="top">
      <?php  echo $this->Print->check($data['SectionA']['A1000A'], 1, 'left'); ?>
    </td>
    <td class="border-top" colspan="2">
     <strong>A. American Indian or Alaska Native</strong>
    </td>
  </tr>  
  <tr>
    <td class="left border-right align-center" valign="top">
      <?php  echo $this->Print->check($data['SectionA']['A1000B'], 1, 'left'); ?>
    </td>
    <td class="border-top" colspan="2">
     <strong>B. Asian</strong>
    </td>
  </tr>
  <tr>
    <td class="left border-right align-center" valign="top">
      <?php  echo $this->Print->check($data['SectionA']['A1000C'], 1, 'left'); ?>
    </td>
    <td class="border-top" colspan="2">
     <strong>C. Black or African American</strong>
    </td>
  </tr>
  <tr>
    <td class="left border-right align-center" valign="top">
      <?php  echo $this->Print->check($data['SectionA']['A1000D'], 1, 'left'); ?>
    </td>
    <td class="border-top" colspan="2">
     <strong>D. Hispanic or Latino</strong>
    </td>
  </tr>
  <tr>
    <td class="left border-right align-center" valign="top">
      <?php  echo $this->Print->check($data['SectionA']['A1000E'], 1, 'left'); ?>
    </td>
    <td class="border-top" colspan="2">
     <strong>E. Native Hawaiian or Other Pacific Islander</strong>
    </td>
  </tr>
  <tr>
    <td class="left border-right align-center" valign="top">
      <?php  echo $this->Print->check($data['SectionA']['A1000F'], 1, 'left'); ?>
    </td>
    <td class="border-top" colspan="2">
     <strong>F. White</strong>
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="3">A1100. Language</td></tr>
  
  <tr>
    <td class="left border-right align-center  top-ten" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A1100A'], 1, 'left'); ?>
    </td>
    <td colspan="2">
      <strong>A. Does the resident need or want an interpreter to communicate with a doctor or health care staff?</strong> <br />
      <span class="tab">0. <strong>No</strong></span> <br />
      <span class="tab">1. <strong>Yes</strong> &rarr; Specify in A1100B, Preferred language</span> <br />
      <span class="tab">9. <strong>Unable to Determine</strong></span>
    </td>
  </tr>
  <tr>
    <td class="left border-right"> </td>
    <td colspan="2">
      <strong>B. Preferred language</strong>:<br />
      <?php  echo $this->Print->field($data['SectionA']['A1100B'], 15, 'right'); ?>
    </td>
  </tr>
</table>
<!-- page 2 end -->
<div style="page-break-after:always;"> </div>
<!-- page 3 start -->
<?php echo $this->Print->header ($data['SectionA']); ?>
<div class="spacer"></div>

<table width="100%">
  <tr>
    <td class="header">Section A</td>
    <td class="header-normal">Identification Information</td>
  </tr>
</table>

<div class="spacer"></div>

<table width="100%">

  <tr><td class="header-main border-bottom border-top" colspan="3">A1200. Language</td></tr>
  
  <tr>
    <td class="left border-right align-center  top-ten" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A1200'], 1, 'left'); ?>
    </td>
    <td colspan="2">
      <span class="tab">1. <strong>Never married</strong></span> <br />
      <span class="tab">2. <strong>Married</strong></span> <br />
      <span class="tab">3. <strong>Widowed</strong></span> <br />
      <span class="tab">4. <strong>Seperated</strong></span> <br />
      <span class="tab">5. <strong>Divorced</strong></span>
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="2">A1300. Optional Resident Items</td></tr>
  
  <tr>
    <td class="left border-right" rowspan="4"> </td>
    <td>
      <strong>A. Medical record number:</strong> <br />
      <?php  echo $this->Print->field($data['SectionA']['A1300A'], 12, 'right'); ?>
    </td>
  </tr>
  <tr>
    <td>
      <strong>B. Room number:</strong> <br />
      <?php  echo $this->Print->field($data['SectionA']['A1300B'], 10, 'right'); ?>
    </td>
  </tr>
  <tr>
    <td>
      <strong>C. Name by which resident prefers to be addressed:</strong> <br />
      <?php  echo $this->Print->field($data['SectionA']['A1300C'], 23, 'right'); ?>
    </td>
  </tr>
  <tr>
    <td>
      <strong>D. Lifetime occupations(s):</strong> - put "/" between two occupations: <br />
      <?php  echo $this->Print->field($data['SectionA']['A1300D'], 23, 'right'); ?>
    </td>
  </tr>

  <tr>
    <td class="header-main border-bottom border-top" colspan="3">
    A1500. Preadmission Screening and Resident Review (PASRR) <br />
    <span class="normal">Complete only if A0310A = 01</span>
    </td>
  </tr>
  
  <tr>
    <td class="left border-right align-center  top-ten" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A1500'], 1, 'left'); ?>
    </td>
    <td colspan="2">
      <strong>Has the resident been evaluated by Level II PASRR and determined to have serious mental illness and/or mental retardation or a related condition?</strong> <br />
      <span class="tab">0. <strong>No</strong></span> <br />
      <span class="tab">1. <strong>Yes</strong></span> <br />
      <span class="tab">9. <strong>Not a Medicaid certified unit</strong></span>
    </td>
  </tr>

  
  <tr>
    <td class="header-main border-bottom border-top" colspan="3">
      A1550. Conditions Related to MR/DD Status <br />
      <span class="normal">If the resident is 22 years of age or older, completeo nly if A0310A = 1</span> <br />
      <span class="normal">If the resident is 21 years of age or younger, complete only if A0310A = 01, 03, 04, or 05</span> 
    </td>
  </tr>
  <tr>
    <td colspan="3" class="border-bottom">
      <img src="/img/arrow.png" alt="" /> <strong>Check all conditions that are related to MR/DD status</strong> that were manifested before age 22, and are likely to continue indefinitely
    </td>
  </tr>
  <tr>
    <td class="left border-right align-center" valign="top"></td>
    <td class="header-main border-top" colspan="2"><strong>MR/DD With Organic Conditions</strong></td>
  </tr>  
  <tr>
    <td class="left border-right align-center" valign="top"><?php  echo $this->Print->check($data['SectionA']['A1550A'], 1, 'left'); ?></td>
    <td class="border-top" colspan="2"><strong>A. Down Syndrome</strong></td>
  </tr>
  <tr>
    <td class="left border-right align-center" valign="top"><?php  echo $this->Print->check($data['SectionA']['A1550B'], 1, 'left'); ?></td>
    <td class="border-top" colspan="2"><strong>B. Autism</strong></td>
  </tr>
  <tr>
    <td class="left border-right align-center" valign="top"><?php  echo $this->Print->check($data['SectionA']['A1550C'], 1, 'left'); ?></td>
    <td class="border-top" colspan="2"><strong>C. Epilepsy</strong></td>
  </tr>
  <tr>
    <td class="left border-right align-center" valign="top"><?php  echo $this->Print->check($data['SectionA']['A1550D'], 1, 'left'); ?></td>
    <td class="border-top" colspan="2"><strong>D. Other organic condition related to MR/DD</strong></td>
  </tr>
  <tr>
    <td class="left border-right align-center" valign="top"></td>
    <td class="header-main border-top" colspan="2"><strong>MR/DD Without Organic Conditions</strong></td>
  </tr>  
  <tr>
    <td class="left border-right align-center" valign="top"><?php  echo $this->Print->check($data['SectionA']['A1550E'], 1, 'left'); ?></td>
    <td class="border-top" colspan="2"><strong>E. MR/DD with no organic condition</strong></td>
  </tr>
  <tr>
    <td class="left border-right align-center" valign="top"></td>
    <td class="header-main border-top" colspan="2"><strong>No MR/DD</strong></td>
  </tr>  
  <tr>
    <td class="left border-right align-center" valign="top"><?php  echo $this->Print->check($data['SectionA']['A1550Z'], 1, 'left'); ?></td>
    <td class="border-top" colspan="2"><strong>Z. None of the above</strong></td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="3">A1600. Entry Date (date of this admission/reentry into the facility)</td></tr>
  
  <tr>
    <td class="left border-right"> </td>
    <td colspan="2">
      <?php  echo $this->Print->field($data['SectionA']['A1600'], 10, 'right'); ?>
    </td>
  </tr>

  <tr><td class="header-main border-bottom border-top" colspan="3">A1700. Type of Entry</td></tr>
  <tr>
    <td class="left border-right align-center" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A1700'], 1, 'left'); ?>
    </td>
    <td class="border-top" colspan="2">
      <span class="tab">1. <strong>Admission</strong></span> <br />
      <span class="tab">2. <strong>Reentry</strong>
    </td>
  </tr>
</table>
<!-- page 3 end -->
<div style="page-break-after:always;"> </div>
<!-- page 4 start -->
<?php echo $this->Print->header ($data['SectionA']); ?>
<div class="spacer"></div>

<table width="100%">
  <tr>
    <td class="header">Section A</td>
    <td class="header-normal">Identification Information</td>
  </tr>
</table>

<div class="spacer"></div>

<table width="100%">
  <tr><td class="header-main border-bottom border-top" colspan="3">A1800. Entered From</td></tr>
  <tr>
    <td class="left border-right align-center top-ten" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A1800'], 2, 'left'); ?>
    </td>
    <td class="border-top" colspan="2">
      <span class="tab">01. <strong>Community</strong> (private home/apt., board/care, assisted living, group home)</span> <br />
      <span class="tab">02. <strong>Another nursing home or swing bed</strong></span> <br />
      <span class="tab">03. <strong>Acute hospital</strong></span> <br />
      <span class="tab">04. <strong>Psychiatric hospital</strong></span> <br />
      <span class="tab">05. <strong>Inpatient rehabilitation facility</strong></span> <br />
      <span class="tab">06. <strong>MR/DD facility</strong></span> <br />
      <span class="tab">07. <strong>Hospice</strong></span> <br />
      <span class="tab">99. <strong>Other</strong></span>
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="3">A2000. Discharge Date <br /><span class="normal">Complete only if A0310F - 10, 11, or 12</span></td></tr>
  
  <tr>
    <td class="left border-right"> </td>
    <td colspan="2">
      <?php  echo $this->Print->field($data['SectionA']['A2000'], 10, 'right'); ?>
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="3">A2100. Discharge Status</td></tr>
  <tr>
    <td class="left border-right align-center top-ten" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A2100'], 2, 'left'); ?>
    </td>
    <td class="border-top" colspan="2">
      <span class="tab">01. <strong>Community</strong> (private home/apt., board/care, assisted living, group home)</span> <br />
      <span class="tab">02. <strong>Another nursing home or swing bed</strong></span> <br />
      <span class="tab">03. <strong>Acute hospital</strong></span> <br />
      <span class="tab">04. <strong>Psychiatric hospital</strong></span> <br />
      <span class="tab">05. <strong>Inpatient rehabilitation facility</strong></span> <br />
      <span class="tab">06. <strong>MR/DD facility</strong></span> <br />
      <span class="tab">07. <strong>Hospice</strong></span> <br />
      <span class="tab">08. <strong>Deceased</strong></span> <br />
      <span class="tab">99. <strong>Other</strong></span>
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="3">A2200. Previous Assessment Reference Date for Significant Correction <br /><span class="normal">Complete only if A0310A = 05 or 06</span></td></tr>
  
  <tr>
    <td class="left border-right"> </td>
    <td colspan="2">
      <?php  echo $this->Print->field($data['SectionA']['A2200'], 10, 'right'); ?>
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="3">A2300. Assessment Reference Date</td></tr>
  
  <tr>
    <td class="left border-right"> </td>
    <td colspan="2">
      <strong>Observation and date:</strong> <br />
      <?php  echo $this->Print->field($data['SectionA']['A2300'], 8, 'right'); ?>
    </td>
  </tr>
  
  <tr><td class="header-main border-bottom border-top" colspan="3">A2400. Medicare Stay</td></tr>
  <tr>
    <td class="left border-right align-center top-ten" valign="top">
      <span class="small">Enter Code</span> <br />
      <?php  echo $this->Print->field($data['SectionA']['A2400A'], 1, 'left'); ?>
    </td>
    <td class="border-top" colspan="2">
      <strong>A. Has the resident had a Medicare-covered stay since the most recent entry?</strong> <br />
      <span class="tab">0. <strong>No</strong> &rarr; Skkip to B0100, Comatose</span> <br />
      <span class="tab">1. <strong>Yes</strong> &rarr; Continue to A2400B, Start date of most recent Medicare stay</span>
    </td>
  </tr>
  
  <tr>
    <td class="left border-right"> </td>
    <td colspan="2">
      <strong>B. Start date of most recent Medicare stay:</strong> <br />
      <?php  echo $this->Print->field($data['SectionA']['A2400B'], 8, 'right'); ?>
    </td>
  </tr>
  
  <tr>
    <td class="left border-right"> </td>
    <td colspan="2">
      <strong>C. End date of most recent Medicare stay:</strong> - Enter dashes if stay is ongoing: <br />
      <?php  echo $this->Print->field($data['SectionA']['A2400C'], 8, 'right'); ?>
    </td>
  </tr>
  
</table>
<!-- page 4 end -->