<table width="100%">
  <tr>
    <td valign="top" class="left-column" valign="top">
      <!-- begin menus -->
      <?php if (isset($this->params['pass'][0])) { ?>
      <ul class="left-nav">
        <li class="menu">Sort by Date</li>
        <li>
          <?php
          echo $this->Form->create('Report', array('url' => '/reports/interview/index/'. $facility_id, 'type' => 'get'));
          echo $this->Form->input('start', array('label' => 'Start Date', 'type' => 'date', 'format' => 'm-d-Y', 'monthNames' => false));
          echo $this->Form->input('end', array('label' => 'End Date', 'type' => 'date', 'format' => 'm-d-Y', 'monthNames' => false));
          echo $this->Form->submit('Filter');
          echo $this->Form->end();
          ?>
        </li>
      </ul>
      <br />
      <?php } ?>
      <?php echo $this->element('_facility_list', array('plugin' => 'reports')); ?>
      
    </td>
    <td valign="top" valign="top">
      <?php 
        if (!empty($data)) {
          
          $print = '/reports/interview/printer';
          $excel = '/reports/interview/excel';
          
          $ext = '';
          
          if (isset($this->params['pass'][0])) 
            $ext .= '/'. $this->params['pass'][0];
          
          if (!empty($this->params['url']['start']))
            $ext .= '/'. $this->params['url']['start']['year'] .'-'. $this->params['url']['start']['month'] .'-'. $this->params['url']['start']['day'];
          
          if (!empty($this->params['url']['end']))
            $ext .= '/'. $this->params['url']['end']['year'] .'-'. $this->params['url']['end']['month'] .'-'. $this->params['url']['end']['day'];
      
           
      
      echo $this->Html->link($this->Html->image('actions/printer.png', array('class' => 'float-right' ,'style' => 'padding-left: 10px')), $print . $ext, array('escape' => false, 'target' => 'new')) . '&nbsp;&nbsp;&nbsp;';
      echo $this->Html->link($this->Html->image('actions/excel.png', array('class' => 'float-right')), $excel . $ext, array('escape' => false, 'target' => 'new'));
      }
      ?>
      <h2>
        Interview report - <?php if(isset($this->params['pass'][0])) echo $allowed_facilities[$this->params['pass'][0]]; ?>
        <?php
         $range = '';
         
         if (!empty($this->params['url']['start'])) {
          $range .= $this->params['url']['start']['year'] .'-'. $this->params['url']['start']['month'] .'-'. $this->params['url']['start']['day'];
          $range .= ' - '. $this->params['url']['end']['year'] .'-'. $this->params['url']['end']['month'] .'-'. $this->params['url']['end']['day'];
        }
        
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