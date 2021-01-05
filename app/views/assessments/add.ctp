

<style type="text/css">
  #assessments { margin-left: 3px; }
  .td_left { width: 150px; font-size: 10pt;  text-align: left; font-weight: bold; }
  .td_right { font-size: 10pt; text-align: left }
  label, input { font-size: 8pt; }
</style>
<div id="assessments">
  <div id="section">
    <h2>Please select the type of assessment you wish to complete</h2>
    
    <table width="100%">
    <tr>
    <td valign="top" width="48%">
      
    <h3>Default Information</h3>
      
    <table class="results" cellspacing="0">
      <tr>
        <td class="td_left">Resident</td>
        <td class="td_right"><?php echo ucwords(strtolower($resident['Resident']['PATLNAME'] .', '. $resident['Resident']['PATFNAME'])); ?></td>
      </tr>
      <tr>
        <td class="td_left">Entry Date</td>
        <td class="td_right"><?php echo $resident['Resident']['ADATE']; ?></td>
      </tr>
      <tr>
        <td class="td_left">Facility</td>
        <td class="td_right"><?php echo $facility['Facility']['name']; ?></td>
      </tr>
      <tr>
        <td class="td_left">NPI #</td>
        <td class="td_right"><?php echo $facility['Facility']['NPI']; ?></td>
      </tr>
      <tr>
        <td class="td_left">CCN #</td>
        <td class="td_right"><?php echo $facility['Facility']['CCN']; ?></td>
      </tr>
      <tr>
        <td class="td_left">State Provider #</td>
        <td class="td_right"><?php echo $facility['Facility']['STATE_PROVIDER_NUM']; ?></td>
      </tr>
      <tr>
        <td class="td_left">Medicare #</td>
        <td class="td_right"><?php echo $resident['Resident']['MEDICARE']; ?></td>
      </tr>
      <tr>
        <td class="td_left">Medicaid #</td>
        <td class="td_right"><?php echo $resident['Resident']['MEDICAID']; ?></td>
      </tr>
    </table>
    
    </td>
    <td>&nbsp;</td>
    <td valign="top" width="48%">
      
    <h3>Assessment Information</h3>
    
    <?php
    echo $this->Form->create('Assessment', array('url' => 'add/'. $resident['Resident']['id'] .'/'. $resident['Resident']['facility_id']));
    echo $this->Form->hidden('SectionA.A0100A');
    echo $this->Form->hidden('SectionA.A0100B');
    echo $this->Form->hidden('SectionA.A0100C');
    echo $this->Form->hidden('SectionA.A0200');
    
    echo $this->Form->hidden('Assessment.resident', array('value' => $resident['Resident']['id']));
    echo $this->Form->hidden('Assessment.transmission_status', array('value' => 0));
    echo $this->Form->hidden('Assessment.locked', array('value' => 0));
    echo $this->Form->hidden('Assessment.itemset', array('value' => '1.10'));
    echo $this->Form->hidden('Assessment.facility_id', array('value' => $resident['Resident']['facility_id']));


    echo $this->Form->input('SectionA.A2300', array('label' => 'Assessment Reference Date', 'class' => 'A2300', 'div' => 'input text A2300','type' => 'text', 'between' => 'Format as YYYY-MM-DD<br />', 'maxLength' => 10, 'size' => 10));
    
    // type of assessment
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
    	
    if ($this->data['SectionA']['A0200'] != 1) {
      echo $form->input('SectionA.A0310D', array('label' => 'D. Is this a Swing Bed clinical change assessment?', 'id' => 'A0310D', 'selected' => 0, 'div' => 'A0310D input select',  'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
          '^' => 'Not Applicable',
      		'0' => '0. No', 
      		'1' => '1. Yes', 
      	)));
    }
    else {
      echo $this->Form->hidden('SectionA.A0310D', array('value' => '^'));
    }    	
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
    echo $form->input('SectionA.A0310G', array('label' => 'G. Type of Discharge',  'type' => 'select',  'escape' => false, 'empty' => ' ', 'options' => array(
        '1' => '1. Planned', 
        '1' => '2. Unplanned', 
      )));
    
    
    echo $this->Form->submit('Start Assessment');
    echo $this->Form->end();
    ?>
    
    </td>
    </table>
  </div>
  
</div>