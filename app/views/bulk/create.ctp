<h2>Bulk Submissions</h2>
<table width="100%">
  <tr>
    <td class="left-column" valign="top">
      <?php echo $this->element('menus/side/bulk'); ?>
    </td>
    <td valign="top">
      <?php 
      echo $this->Form->create('Bulk', array('url' => '/bulk/add')); 
      echo $this->Form->hidden('Bulk.facility_id', array('value' => $this->Session->read('Auth.User.facility_id')));
      ?>
      <table  width="100%" cellspacing="0" class="results">
        <tr>
          <th class="align-center small"><a href="javascript:void(0);" id="select-all">[ All ]</a></th>
          <th class="align-center"><?php echo $this->Paginator->sort('Facility', 'Resident.name') ?></th>
          <th class="align-center"><?php echo $this->Paginator->sort('ID', 'Assessment.id') ?></th>
          <th class="align-left"><?php echo $this->Paginator->sort('Patient Name', 'Resident.PATLNAME') ?></th>
          <th class="align-center">Assessment Type</th>
          <th class="align-center"><?php echo $this->Paginator->sort('Report Type', 'SectionX.X0100') ?></th>
          <th class="align-center"><?php echo $this->Paginator->sort('Status', 'Assessment.transmission_status') ?></th>
          <th class="align-center"><?php echo $this->Paginator->sort('Lock Date', 'Assessment.lock_date') ?></th>
          <th class="align-center">ADL</th>
          <th class="align-center">MIN</th>
          <th class="align-center">T-RUG</th>
          <th class="align-center">N-RUG</th>
        </tr>
        <?php
        $i = 0;
        foreach ($data as $key => $value): 
        ?>
          <tr>
            <td>
              <?php 
                echo $this->Form->hidden('BulkSubmissionAssessment.'. $i .'.assessment_id', array('value' => $value['Assessment']['id']));
                echo $this->Form->hidden('BulkSubmissionAssessment.'. $i .'.resident_id', array('value' => $value['Assessment']['resident'])); 
                echo $this->Form->hidden('BulkSubmissionAssessment.'. $i .'.facility_id', array('value' => $value['Assessment']['facility_id']));
                echo $this->Form->input('BulkSubmissionAssessment.'. $i .'.selected', array('type' => 'checkbox', 'div' => false, 'label' => false)); 
              ?>
            <td class="align-center"><?php echo $value['Facility']['name']; ?></td>
            <td class="align-center"><?php echo $value['Assessment']['id']; ?></td>
            <td class="align-left"><?php echo $value['Resident']['PATLNAME']; ?>, <?php echo $value['Resident']['PATFNAME']; ?></td>
            <td class="align-center">

            <?php 
            // section a
            $str = '';
            if ($value['SectionA']['A0310A'] == '01') $str = 'ADM';
            if ($value['SectionA']['A0310A'] == '02') $str = 'QTR';
            if ($value['SectionA']['A0310A'] == '03') $str = 'ANN';
            if ($value['SectionA']['A0310A'] == '04') $str = 'SC';
            if ($value['SectionA']['A0310A'] == '05') $str = 'SCPC';
            if ($value['SectionA']['A0310A'] == '06') $str = 'SCPQ';
            if ($value['SectionA']['A0310A'] == '99') $str = '';
            
            // section b
            $b = '';
            if ($value['SectionA']['A0310B'] == '01') $b = '5-DAY';
            if ($value['SectionA']['A0310B'] == '02') $b = '14-DAY';
            if ($value['SectionA']['A0310B'] == '03') $b = '30-DAY';
            if ($value['SectionA']['A0310B'] == '04') $b = '60-DAY';
            if ($value['SectionA']['A0310B'] == '05') $b = '90-DAY';
            if ($value['SectionA']['A0310B'] == '06') $b = 'RR';
            if ($value['SectionA']['A0310B'] == '07') $b = 'UNS';
            if ($value['SectionA']['A0310B'] == '99') $b = '';
            
            if (!empty($str)) {
              if (!empty($b)) $str .= '|'. $b; 
            }
            else {
              if (!empty($b)) $str .= $b; 
            }
            
            $c = '';
            if ($value['SectionA']['A0310C'] == '1') $b = 'SOT';
            if ($value['SectionA']['A0310C'] == '2') $b = 'EOT';
            if ($value['SectionA']['A0310C'] == '3') $b = 'SOT/EOT';
            
            if (!empty($str)) {
              if (!empty($c)) $str .= '|'. $c; 
            }
            else {
              if (!empty($c)) $str .= $c; 
            }
            
            $f = '';
            if ($value['SectionA']['A0310F'] == '01') $f = 'ENT';
            if ($value['SectionA']['A0310F'] == '10') $f = 'DIS-N';
            if ($value['SectionA']['A0310F'] == '11') $f = 'DIS-A';
            if ($value['SectionA']['A0310F'] == '12') $f = 'DEATH';
            if ($value['SectionA']['A0310F'] == '99') $f = '';
            
            if (!empty($str)) {
              if (!empty($f)) $str .= '|'. $f; 
            }
            else {
              if (!empty($f)) $str .= $f; 
            }
            echo $str;
            ?>
            </td>
            <td class="align-center">
              <?php 
              if (isset($value['SectionX']['X0100'])) {
                switch ($value['SectionX']['X0100']) {
                  case 1:
                    echo 'New';
                    break;
                  case 2:
                    echo 'Mod';
                    break;
                  case 3:
                    echo 'De-Activate';
                    break;
                }
              }
              else {
                switch ($value['SectionA']['A0050']) {
                  case 1:
                    echo 'New';
                    break;
                  case 2:
                    echo 'Mod';
                    break;
                  case 3:
                    echo 'De-Activate';
                    break;
                }
              }
              ?>
            </td>
            <td class="align-center">
            <?php 
              switch($value['Assessment']['transmission_status']) {
                case 0: echo 'Pending';    break;
                case 1: echo 'Trasmitted'; break;
                case 2: echo 'Accepted';   break;
                case 3: echo 'Rejected';   break;
              }
            ?>
            </td>
          <td class="time align-center"><?php echo $this->Time->format('m-d-Y', $value['Assessment']['lock_date']); ?></td>
          
          <?php if (isset($value['rug'])) { ?>
          <td class="align-center"><?php echo $value['rug']['adl']; ?></td>
          <td class="align-center"><?php echo $value['rug']['minutes']; ?></td>
          <td class="align-center"><?php echo $value['rug']['trug']; ?></td>
          <td class="align-center"><?php echo $value['rug']['nrug']; ?></td>
          <?php } else { ?>
          <td colspan="4"></td>
          <?php } ?>
          </tr>        
        <?php 
          $i++;
        endforeach; 
        ?>
      </table>
      <?php 
      echo $this->Form->submit('Create Bulk Submission');
      echo $this->Form->end();
      ?>
    </td>    
  </tr>  
</table>