<table width="100%">
  <tr>
    <td valign="top" class="left-column" valign="top">
      <!-- begin menus -->
      <?php echo $this->element('_facility_list', array('plugin' => 'reports')); ?>
      
    </td>
    <td valign="top" valign="top">
      <?php if (!empty($ticklers)) { ?>
      <?php
        switch ($this->params['controller']) {
          case 'ticklers':
            $name = ' Pending';
            break;
          case 'late':
            $name = ' that are Late';
            break;
        }

      ?>
      <h2> Assessments <?php echo $name; ?></h2>

      <table width="100%" cellspacing="0" class="results legend">
        <tr>
          <th class="align-center headers" colspan="7">
            Color Code for Tickler
          </th>
        </tr>
        <tr><td colspan="7">&nbsp;</td></tr>
        <tr>
          <td style="width: 150px; text-align: right; font-weight: bold">Working</td>
          <td style="width: 25px;" class="box working"> &nbsp; &nbsp; &nbsp; </td>
          <td style="width: 150px; text-align: right; font-weight: bold">Late</td>
          <td style="width: 25px;" class="box late"> &nbsp; &nbsp; &nbsp; </td>
          <td style="width: 150px; text-align: right; font-weight: bold">Pending</td>
          <td style="width: 25px;" class="box"> &nbsp; &nbsp; &nbsp; </td>
          <td> &nbsp; &nbsp; &nbsp; </td>
        </tr>
      </table>

      <br />

      <table width="100%" cellspacing="0" class="results">
        <?php
        foreach ($ticklers as $key => $value) {

          $y = substr($key, 0, 4);
          $m = substr($key, 4, 2);
          $d = substr($key, 6, 2);
          
          if (!empty($ticklers[$key])) {
          
            echo '<tr><th colspan="7" class="align-left">Assessments that should be started on: '. $m.'-'. $d .'-'. $y .'</th></tr>';
            echo '<tr>';  
            echo '  <th class="align-left headers">Facility</th>';  
            echo '  <th class="align-left headers">Resident ID #</th>';  
            echo '  <th class="align-left headers">Resident Name</th>';  
            echo '  <th class="align-left headers">Admit Date</th>';  
            echo '  <th class="align-left headers">Assessment Type</th>';  
            echo '  <th class="align-left headers">ARD Start</th>';  
            echo '  <th class="align-left headers">ARD End</th>';  
            echo '</tr>';  
            foreach ($value as $key2 => $value2) {
              
              $today = date('Ymd');

              $class = '';
              
              if ($value2['end'] < date('Y-m-d')) $class .= " late";

              if ($value2['working'] > 0) $class .= ' working';
              
              echo '<tr class="'. $class .'">';  
              echo '  <td>'. $value2['fac'] .'</td>';  
              echo '  <td>'. $value2['id'] .'</td>';  

              switch ($value2['working']) {
                case 0:
                  $link = $this->Html->link($value2['name'], array('controller' => 'assessments', 'action' => 'add', $value2['id'], 'plugin' => false));
                  break;
                default:
                  $link = $value2['name'];
              }
              

              echo '  <td>'. $link .'</td>';  
              
              
              echo '  <td>'. $value2['admit'] .'</td>';  
              
              if ((
                $value2['type'] == 'Quarterly or Annual'
              )) {
                echo '  <td colspan="3">'. $value2['type'] .'</td>';  
              }
              else {
                echo '  <td>'. $value2['type'] .'</td>';  
                echo '  <td>'. $value2['start'] .'</td>';  
                echo '  <td>'. $value2['end'] .'</td>';  
              }
              
              
              echo '</tr>';  
            }
          }
        }
        ?>
      </table>
      <?php } ?>
      
    </td>
    
  </tr>
  
  
</table>