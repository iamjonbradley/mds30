<h2>
  Interview report - <?php if(isset($this->params['pass'][0])) echo $facilities[$this->params['pass'][0]]; ?>
  <?php
   $range = '';
   
   if (!empty($this->params['pass'][1]))
    $range .= $this->params['pass'][1] .' - '. $this->params['pass'][2];
    
  if (!empty($range))
    echo ' | Date Range: '. $range;
  ?>
</h2>
<?php if (!empty($data)) { ?>
 <table class="results" cellspacing="0" width="100">
    <tr>
      <th>ID #</th>
      <th>Patient #</th>
      <th class="align-left">Resident</th>
        <th>ARD</th>
      <th>Section C - C0100</th>
      <th>Section D - D0100</th>
      <th>Section J - J0200</th>
    </tr>
    
  <?php foreach ($data as $key => $value) { ?>
          <tr>
            <td class="align-center"><?php echo $value['Assessment']['id']; ?></td>
            <td class="align-center"><?php echo $value['Resident']['PATNUM']; ?></td>
            <td>
              <?php echo ucwords(strtolower($value['Resident']['PATLNAME'])); ?>, 
              <?php echo ucwords(strtolower($value['Resident']['PATFNAME'])); ?> 
              <?php echo ucwords(strtolower($value['Resident']['PMI'])); ?>
            </td>
            <td class="align-center"><?php echo $value['SectionA']['A2300']; ?></td>
            <td class="align-center"><?php if ($value['SectionC']['C0100'] == 0) echo 'No'; else echo 'Yes'; ?></td>
            <td class="align-center"><?php if ($value['SectionD']['D0100'] == 0) echo 'No'; else echo 'Yes'; ?></td>
            <td class="align-center"><?php if ($value['SectionJ']['J0200'] == 0) echo 'No'; else echo 'Yes'; ?></td>
          </tr>
        <?php } ?>
      </table>
      <div class="small"></div>
      <?php } ?>
    </td>
    
  </tr>
</table>