<table width="100%">
  <tr>
    <td valign="top" class="left-column" valign="top">
      <?php echo $this->element('menus/side/assessment'); ?>

      <div class="tip"></div>
    </td>
    <td valign="top" valign="top">
      <!-- begin groups -->
      <table width="100%">
        <tr>
          <td valign="top" colspan="10"><h2>Assessments</h2></td>
          <td valign="top" colspan="5" class="align-right align-bottom" colspan="13">
            <div class="tip tip-top"></div>
            <?php 
              if (isset($this->params['url']['facility_id']) || isset($this->params['url']['lastname']) || isset($this->params['url']['firstname'])) 
                $params = array('facility_id' => $this->params['url']['facility_id'], 'lastname' => $this->params['url']['lastname'], 'firstname' => $this->params['url']['firstname']);
              else $params = array();
              
              $this->Paginator->options(array('url' => array_merge($params, $this->passedArgs)));
              echo $this->Paginator->prev() .' ';
              echo $this->Paginator->numbers() .' ';
              echo $this->Paginator->next(); 
            ?> 
          </td>
        </tr>
      </table>
      <table  width="100%" cellspacing="0" class="results">
        
        <tr>
          <th class="align-left"><?php echo $this->Paginator->sort('ID', 'Assessment.id') ?></th>
          <th class="align-left"><?php echo $this->Paginator->sort('Facility', 'Facility.name') ?></th>
          <th class="align-left"><?php echo $this->Paginator->sort('Resident', 'Resident.PATLNAME') ?></th>
          <!-- <th><?php echo $this->Paginator->sort('Entry', 'SectionA.A1600') ?></th> -->
          <!-- <th><?php echo $this->Paginator->sort('SS', 'SectionZ.Z0100C') ?></th> -->
          <th>Minutes</th>
          <th>ADL</th>
          <th>T-RUG</th>
          <th>N-RUG</th>
          <th>A Type</th>
          <th><?php echo $this->Paginator->sort('ARD', 'SectionA.A2300') ?></th>
          <th> </th>
          <th><?php echo $this->Paginator->sort('Lock Date', 'Assessment.lock_date') ?></th>
          <th><?php echo $this->Paginator->sort('Status', 'Assessment.transmission_status') ?></th>
          <th><?php echo $this->Paginator->sort('Age', 'modified') ?></th>
          <th class="actions">Actions</th>
        </tr>
        
        <?php 
        if (empty($data)) {
          echo '<tr>
            <td colspan="14" style="font-size: 120%; color: #FF0000; text-align: center">
              Please select a facility to view assessments or choose another folder for assessments
            </td>
          </tr>';
        }
        else {
          foreach ($data as $key => $value) {
            $type = $this->AssessmentType->short($value); 
            
          ?>
          <tr>
            <td valign="top"><?php echo $value['Assessment']['id']; ?></td>
            <td valign="top"><?php echo ucwords(strtolower($value['Facility']['name'])); ?></td>
            <td valign="top"><?php echo ucwords(strtolower($value['Resident']['PATLNAME'] .', '. $value['Resident']['PATFNAME'])); ?></td>
            <!--<td valign="top" class="align-center"><?php echo $this->Time->format('m/d/y', $value['SectionA']['A1600']); ?></td> -->
            <!--
            <td valign="top" class="align-center">
              <?php
              switch ($value['SectionZ']['Z0100C']) {
                case 1: echo 'Yes'; break;
                default: echo 'No';
              }
               ?>
            </td>
            -->
            <td valign="top" class="align-center"> <?php echo $value['RugCache']['minutes_ttl']; ?></td>
            <td valign="top" class="align-center"> <?php echo $value['RugCache']['adl']; ?></td>
            <td valign="top" class="align-center"> <?php if ($type != 'NT') echo $value['RugCache']['rug_therapy'] . $value['RugCache']['rug_hipps']; else echo 'N/A'; ?></td>
            <td valign="top" class="align-center"> <?php if ($type != 'NT') echo $value['RugCache']['rug_nursing'] . $value['RugCache']['rug_hipps']; else echo 'N/A'; ?></td>
            <td valign="top" class="align-center">
              <?php 
                switch ($value['RugCache']['type']) {
                  case 1: $type = 'NEW - '; break;  
                  case 2: $type = 'MOD - '; break;  
                  case 3: $type = 'INA - '; break;  
                  default: $type = '';
                }
              // section a
              echo $type . $this->AssessmentType->get($value);
              // echo $str;
              ?>
            </td>
            <td valign="top">
              <?php
              echo $value['RugCache']['date_ard'];
              ?>
            </td>
            <td valign="top" class="align-center">
              <?php 
                switch($value['Assessment']['locked']) {
                  case 0:
                    $locked = '<img src="/img/actions/lock_open.png" alt="open" class="tooltip" title="Not Locked" />';
                    break;
                  case 1:
                    $locked = '<img src="/img/actions/lock.png" alt="locked" class="tooltip" title="Locked" />';
                    break;
                }
                echo $locked; 
              ?>
            </td>
            <td valign="top" class="time align-center">
              <?php 
              if ($value['RugCache']['date_locked'] != '0000-00-00')
                echo $this->Time->format('Y-m-d', $value['RugCache']['date_locked']); 
              ?>
              
            </td>
            <td valign="top" class="align-center">
              <?php
                  switch($value['Assessment']['transmission_status']) {
                    case 0: echo '';    break;
                    case 1: echo '<img class="tooltip" src="/img/actions/transmit.png"alt="transmit" title="Transmitted"  />'; break;
                    case 2: echo '<img class="tooltip" src="/img/actions/transmit_blue.png" alt="accepted" title="Accepted" />';   break;
                    case 3: echo '<img class="tooltip" src="/img/actions/transmit_error.png"alt="invalid" title="Rejected" />';   break;
                  }
              ?>
            </td>
            <td valign="top" class="time align-center"><?php echo $this->Time->timeAgoInWords($value['Assessment']['modified'], array('end' => '+1year', 'format' => 'Y-m-d')); ?></td>
            <td valign="top" class="actions">
              <?php
              // edit assessments
              if (!in_array($this->Session->read('Auth.User.group_id'), array(9))) {
                if ($value['Assessment']['transmission_status'] != 2)
                  echo '<a href="/assessments/edit/a/'. $value['Assessment']['id'] .'"><img alt="edit" class="tooltip" title="Click here to edit this assessment" src="/img/actions/edit.png" /></a> <span class="space">&nbsp;</span>';   
                else  
                  echo '<img alt="edit" class="tooltip" title="Editing of this assessment is not permitted" src="/img/actions/edit_invalid.png" /> <span class="space">&nbsp;</span>';
              }

              // view report
                echo '<a href="/assessments/report/'. $value['Assessment']['id'] .'"><img alt="view" class="tooltip" title="Click here to view the report" src="/img/actions/report.png" /></a> <span class="space">&nbsp;</span>';

              if (!in_array($this->Session->read('Auth.User.group_id'), array(9))) {
                // view caas
                $letter = $this->AvailableSection->getLetters($this->AssessmentType->short($value), $this->data['Facility']['F_STATE']);

                $caa = 0;
                foreach ($letter as $key2 => $value2) 
                  if ($value2 == 'v') $caa++;

                if ($caa == 1)
                  echo '<a href="/assessments/caa/'. $value['Assessment']['id'] .'"><img alt="view" class="tooltip" title="Click here to view this CAA\'s" src="/img/actions/caa.png" /></a> <span class="space">&nbsp;</span>';
                else
                  echo '<img alt="CAA" class="tooltip" title="CAA\'s Not Applicable"  src="/img/actions/caa_invalid.png" /> <span class="space">&nbsp;</span>';

                if ($value['Assessment']['transmission_status'] == 2)
                  echo '<a href="/assessments/modify/'. $value['Assessment']['id'] .'"><img alt="modify" class="tooltip" title="Click here to modify this assessment" src="/img/actions/modify.png" /></a> <span class="space">&nbsp;</span>';
                else 
                  echo '<img alt="modify" class="tooltip" title="Modification of this assessment is not permitted"  src="/img/actions/modify_invalid.png" /> <span class="space">&nbsp;</span>';

  							echo '<a href="/assessments/history/'. $value['Assessment']['id'] .'"><img alt="view" class="tooltip" title="Click here to view this change log history for this assessment" src="/img/actions/history.png" /></a> <span class="space">&nbsp;</span>';
                
                if (!isset($this->params['pass'][0])) {
                  $this->params['pass'][0] = 0;
                }
              }

              // delete assessment
              if (!in_array($this->Session->read('Auth.User.group_id'), array(9))) {
                if ($this->params['pass'][0] != 99) {
                  if (
                  	in_array($this->Session->read('Auth.User.group_id'), array(1,2,3,6)) || 
                  	($value['Assessment']['transmission_status'] != 1 || $value['Assessment']['transmission_status'] != 2)
                  )
                    echo '<a href="/assessments/delete/'. $value['Assessment']['id'] .'" onclick="return confirm(\'Are you sure?\');"><img alt="delete" class="tooltip" title="Click here to delete this assessment" src="/img/actions/delete.png" /></a>';
                  else 
                    echo '<a href="#"><img alt="delete" class="tooltip" title="Deleting of this assessment is not permitted"  src="/img/actions/delete_invalid.png" /></a>';
                }
                else {
                  echo '<a href="/assessments/undelete/'. $value['Assessment']['id'] .'" onclick="return confirm(\'Are you sure?\');"><img alt="undo" class="tooltip" title="Undo Deleting of this assessment"  src="/img/actions/undo.png" /></a>';
                }
              }
              ?>
            </td>
          </tr>
          <?php 
          } 
        }
        ?>
        
      </table>
    </td>
    
  </tr>
  
  
</table>