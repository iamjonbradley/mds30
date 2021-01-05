
      <?php if (isset($facility_name)) { ?>
        <h2>Drug report - <?php echo $facility_name; ?></h2> 
      <?php } else { ?>
        <h2>Drug report</h2> 
      <?php } ?>
      
      <table class="results" cellspacing="0" width="100">
      <?php 

      if (!empty($report)) { 

        foreach ($report as $key => $value) {
          echo '<tr>' ."\r\n";
          echo '  <td colspan="8" id="drug-'. $key .'" class="drug-header">';
          echo '    <strong>'. $key .'</strong> - ';
          echo '    Residents on this drug: '. count($value) .' ';
          echo '  </td>' ."\r\n";
          echo '</tr>' ."\r\n";

          echo '<tr class="drug-hide drug-'. $key .'">' ."\r\n";
          echo '  <th>Resident #</th>' ."\r\n";
          echo '  <th>Last Assessment</th>' ."\r\n";
          echo '  <th>Last Name</th>' ."\r\n";
          echo '  <th>First Name</th>' ."\r\n";
          echo '  <th># of Days</th>' ."\r\n";
          echo '  <th>ARD</th>' ."\r\n";
          echo '  <th>Lock Date</th>' ."\r\n";
          echo '</tr>' ."\r\n";

          ksort($value);
          foreach ($value as $key2 => $value2) {
            if (!empty($value2)) {
              echo '<tr class="drug-hide drug-'. $key .'">' ."\r\n";
              echo '  <td>'. $value2['Resident']['PATNUM'] .'</td>' ."\r\n";
              echo '  <td>'. $value2['RugCache']['assessment_id'] .'</td>' ."\r\n";
              echo '  <td>'. $value2['Resident']['PATLNAME'] .'</td>' ."\r\n";
              echo '  <td>'. $value2['Resident']['PATFNAME'] .'</td>' ."\r\n";
              echo '  <td>'. $value2['value'] .'</td>' ."\r\n";
              echo '  <td>'. $value2['RugCache']['date_ard'] .'</td>' ."\r\n";
              echo '  <td>'. $value2['RugCache']['date_locked'] .'</td>' ."\r\n";
              echo '</tr>' ."\r\n";
            }
          }

        }
      }
      ?>
      </table>