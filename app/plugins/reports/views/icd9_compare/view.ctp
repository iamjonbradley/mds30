<table width="100%">
  <tr>
    <td valign="top" class="left-column" valign="top">
      <?php echo $this->element('_facility_list', array('plugin' => 'reports')); ?>
    <td valign="top" valign="top">
      <?php 
        if (!empty($data)) {
          
          $print = '/reports/icd9_compare/printer';
          $excel = '/reports/icd9_compare/excel';
          
          $url = '';
          
          if (isset($this->params['pass'][0])) 
            $url .= '/'. $this->params['pass'][0];
          else
            $url .= '/0';
          
          if (!empty($this->params['url']['start']))
            $url .= '/'. $this->params['url']['start']['year'] .'-'. $this->params['url']['start']['month'] .'-'. $this->params['url']['start']['day'];
          
          if (!empty($this->params['url']['end']))
            $url .= '/'. $this->params['url']['end']['year'] .'-'. $this->params['url']['end']['month'] .'-'. $this->params['url']['end']['day'];
      
      echo $this->Html->link($this->Html->image('actions/printer.png', array('class' => 'float-right', 'style' => 'padding-left: 10px')), $print . $url, array('escape' => false, 'target' => 'new'));
      echo $this->Html->link($this->Html->image('actions/excel.png', array('class' => 'float-right')), $excel . $url, array('escape' => false, 'target' => 'new'));
      }
      ?>
      <table class="results" cellspacing="0" width="100">
         <tr>
           <!-- <th rowspan="2" valign="bottom">ID#</th> -->
           <th rowspan="2" valign="bottom">Resident</th>
           <th colspan="2">ICD9</th>
           <th colspan="2">ICD9</th>
           <th colspan="2">ICD9</th>
           <th colspan="2">ICD9</th>
           <th colspan="2">ICD9</th>
           <th colspan="2">ICD9</th>
           <th colspan="2">ICD9</th>
           <th colspan="2">ICD9</th>
           <th colspan="2">ICD9</th>
           <th colspan="2">ICD9</th>
         </tr>
         <tr>
           <th style="border-left: #000 2px solid">MR</th><th style="border-right: #000 1px solid">MDS</th>
           <th style="border-left: #000 1px solid">MR</th><th style="border-right: #000 1px solid">MDS</th>
           <th style="border-left: #000 1px solid">MR</th><th style="border-right: #000 1px solid">MDS</th>
           <th style="border-left: #000 1px solid">MR</th><th style="border-right: #000 1px solid">MDS</th>
           <th style="border-left: #000 1px solid">MR</th><th style="border-right: #000 1px solid">MDS</th>
           <th style="border-left: #000 1px solid">MR</th><th style="border-right: #000 1px solid">MDS</th>
           <th style="border-left: #000 1px solid">MR</th><th style="border-right: #000 1px solid">MDS</th>
           <th style="border-left: #000 1px solid">MR</th><th style="border-right: #000 1px solid">MDS</th>
           <th style="border-left: #000 1px solid">MR</th><th style="border-right: #000 1px solid">MDS</th>
           <th style="border-left: #000 1px solid">MR</th><th style="border-right: #000 2px solid">MDS</th>
         </tr>
         <?php
         foreach ($data as $key => $value) {
           echo '<tr>';
            // echo '<td>'. $value['patnum'] .'</td>';
            echo '<td>'. $value['name'] .'</td>';
            
            echo '<td style="border-left: #000 2px solid">'. $value['MR1'] .'</td>';
            if (isset($value['MDS1'])) echo '<td style="border-right: #000 1px solid"> '. $value['MDS1'] .'</td>';
            else echo '<td style="border-right: #000 1px solid">-</td>';
            
            echo '<td style="border-left: #000 1px solid">'. $value['MR2'] .'</td>';
            if (isset($value['MDS2'])) echo '<td style="border-right: #000 1px solid">'. $value['MDS2'] .'</td>';
            else echo '<td style="border-right: #000 1px solid">-</td>';
            
            echo '<td style="border-left: #000 1px solid">'. $value['MR3'] .'</td>';
            if (isset($value['MDS3'])) echo '<td style="border-right: #000 1px solid">'. $value['MDS3'] .'</td>';
            else echo '<td style="border-right: #000 1px solid">-</td>';
            
            echo '<td style="border-left: #000 1px solid">'. $value['MR4'] .'</td>';
            if (isset($value['MDS4'])) echo '<td style="border-right: #000 1px solid">'. $value['MDS4'] .'</td>';
            else echo '<td style="border-right: #000 1px solid">-</td>';
            
            echo '<td style="border-left: #000 1px solid">'. $value['MR5'] .'</td>';
            if (isset($value['MDS5'])) echo '<td style="border-right: #000 1px solid">'. $value['MDS5'] .'</td>';
            else echo '<td style="border-right: #000 1px solid">-</td>';
            
            echo '<td style="border-left: #000 1px solid">'. $value['MR6'] .'</td>';
            if (isset($value['MDS6'])) echo '<td style="border-right: #000 1px solid">'. $value['MDS6'] .'</td>';
            else echo '<td style="border-right: #000 1px solid">-</td>';
            
            echo '<td style="border-left: #000 1px solid">'. $value['MR7'] .'</td>';
            if (isset($value['MDS7'])) echo '<td style="border-right: #000 1px solid">'. $value['MDS7'] .'</td>';
            else echo '<td style="border-right: #000 1px solid">-</td>';
            
            echo '<td>'. $value['MR8'] .'</td>';
            if (isset($value['MDS8'])) echo '<td style="border-right: #000 1px solid">'. $value['MDS8'] .'</td>';
            else echo '<td style="border-right: #000 1px solid">-</td>';
            
            echo '<td style="border-left: #000 1px solid">'. $value['MR9'] .'</td>';
            if (isset($value['MDS9'])) echo '<td style="border-right: #000 1px solid">'. $value['MDS9'] .'</td>';
            else echo '<td style="border-right: #000 1px solid">-</td>';
            
            echo '<td style="border-left: #000 1px solid">'. $value['MR10'] .'</td>';
            if (isset($value['MDS10'])) echo '<td style="border-right: #000 2px solid">'. $value['MDS10'] .'</td>';
            else echo '<td style="border-right: #000 2px solid">-</td>';
            
           echo '</tr>';
         }
         ?>
      </table>
    </td>
  </tr>
</table>