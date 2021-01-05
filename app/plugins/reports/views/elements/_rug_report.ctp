
      <h2>
        RUG IV report - <?php 
                            if(isset($this->params['pass'][0])) {
                              echo $allowed_facilities[$this->params['pass'][0]];
                            }
                            else if(isset($regionalName)) {
                              echo $regionalName;
                            }
                         ?>
        <?php
         $range = '';
         
         if (!empty($this->params['url']['start'])) {
          $range .= $this->params['url']['start'];
          $range .= ' - '. $this->params['url']['end'];
        }
        
        if (!empty($range))
          echo ' | Date Range: '. $range;
        ?>
      </h2>
      <?php if (!empty($data)) { ?>
      <table class="results" cellspacing="0" width="100">
      <tr>
        <?php if(isset($regionalName)) {?>
          <th>Facility</th>
        <?php } ?> 
        <th>ID&nbsp;#</th>
        <th>Patient&nbsp;#</th>
        <th class="align-left">Resident</th>
        <th>ENTRY</th>
        <th>PART A</th>
        <th>LOCK</th>
        <th>ARD</th>
        <th>&nbsp;</th>
        <th>TYPE</th>
        <th>T-RUG</th>
        <th>T-RATE*</th>
        <th>N-RUG</th>
        <th>N-RATE*</th>
        <th>CVRS</th>
        <th>DAYS</th>
        <th></th>
      </tr>
        <?php foreach ($data as $key => $value) { ?>
          <tr>
            <?php if(isset($regionalName)) {?>
              <td class="align-center"><?php echo $value['Facility']['name']; ?></td>
            <?php } ?> 
            <td class="align-center"><?php echo $value['RugCache']['assessment_id']; ?></td>
            <td class="align-center"><?php echo $value['Resident']['PATNUM']; ?></td>
            <td>
              <?php echo ucwords(strtolower($value['Resident']['PATLNAME'])); ?>, 
              <?php echo ucwords(strtolower($value['Resident']['PATFNAME'])); ?> 
              <?php echo ucwords(strtolower($value['Resident']['PMI'])); ?>
            </td>
            <td class="align-center">
              <?php echo $this->Time->format('m/d/y', $value['RugCache']['date_entry']);?>
            </td>
            <td class="align-center">
              <?php echo $this->Time->format('m/d/y', $value['RugCache']['date_parta']);?>
            </td>
            <td class="align-center">
              <?php 
              if (!empty($value['RugCache']['date_locked']))
                echo $this->Time->format('m/d/y', $value['RugCache']['date_locked']); 
              ?>
            </td>
            <td class="align-center">
              <?php 
              if (!empty($value['RugCache']['date_ard']))
                echo $this->Time->format('m/d/y', $value['RugCache']['date_ard']); 
              ?>
            </td>
            <td class="align-center">
            <?php
            if (!empty($value['RugCache']['type'])) {
              switch ($value['RugCache']['type']) {
                case 1: echo 'N'; break;
                case 2: echo 'M'; break;
                case 3: echo 'I'; break;
              }
            }
            ?>
            </td>
            
            <td class="align-center">
              <?php 
              $type = '';
              if (!empty($value['RugCache']['type_obra'])) $type .= $value['RugCache']['type_obra'] .' ';
              if (!empty($value['RugCache']['type_pps'])) $type .= $value['RugCache']['type_pps'] .' ';
              if (!empty($value['RugCache']['type_omra'])) $type .= $value['RugCache']['type_omra'] .' ';
              if (!empty($value['RugCache']['type_tracking'])) $type .= $value['RugCache']['type_tracking'] .' ';
              echo trim($type); 
              ?>
            </td>
            <td class="align-center"><?php echo $value['RugCache']['rug_therapy'] . $value['RugCache']['rug_hipps']; ?></td>
            <td class="align-center"> <?php echo $this->Number->currency($value['RugCache']['rug_therapy_rate'], 'USD'); ?></td>
            <td class="align-center"><?php echo $value['RugCache']['rug_nursing'] . $value['RugCache']['rug_hipps']; ?></td>
            <td class="align-center"> <?php echo $this->Number->currency($value['RugCache']['rug_nursing_rate'], 'USD'); ?></td>
            
            <?php if (isset($value['RugCache']['cvr_from'])) { ?>
              <td class="align-center">
              <?php echo $this->Time->format('m/d/y', $value['RugCache']['cvr_from']); ?> -
              <?php echo $this->Time->format('m/d/y', $value['RugCache']['cvr_end']); ?>  
              <td class="align-center"><?php echo $value['RugCache']['cvr_days']; ?></td>
            <?php } else { ?>
              <td colspan="2"></td>
            <?php } ?>
            
            <td class="align-center">
            <?php 
            if ($value['Assessment']['transmission_status'] == '2') 
              echo $this->Html->image('actions/accept.png', array('alt' => 'Accepted'));
            ?>
            </td>     
          </tr>
        <?php } ?>
      </table>
      <div class="small">* Does not apply to RUG III Case Mix states. These are estimated rates and are based upon current information as of 10/22/2010.</div>
      <?php } ?>