<table width="100%">
  <tr>
    <td valign="top" class="left-column" valign="top">
      <?php 
      echo $this->element('history'. DS .'_search', array('plugin' => 'reports', 'facility_id' => $facility_id, 'users' => $users)); 
      echo $this->element('_facility_list', array('plugin' => 'reports')); 
      ?>
    </td>
    <td valign="top" valign="top">
      <h2>Changes done by <?php echo $users[$this->data['Log']['user_id']]; ?></h2>
      <table class="results" cellspacing="0">
        <tr>
          <th class="align-left">#</th>
          <th class="align-left">Resident</th>
          <th class="align-left">Assessment #</th>
          <th class="align-left">Section</th>
          <th class="align-left">Action</th>
          <th class="align-left">Date</th>
          <th class="align-left">View</th>
        </tr>
        <?php foreach ($data as $key => $value) { ?>
          <tr>
            <td><?php echo $value['Log']['id']; ?></td>
            <td><?php echo $value['Resident']['PATLNAME'] .', '. $value['Resident']['PATFNAME']; ?></td>
            <td><?php echo $value['Log']['model_id']; ?></td>
            <td><?php echo $value['Log']['model']; ?></td>
            <td>
              <?php
                switch ($value['Log']['change']) {
                  case 'edit':
                    echo 'Updated Section';
                    break;
                  case 'add':
                    echo 'Started Section';
                    break; 
                }
               ?>
            </td>
            <td><?php echo $this->Time->timeAgoInWords ($value['Log']['created']); ?></td>
            <td>
              <?php 
                $section = str_replace('Section', '', $value['Log']['model']);
                $section = strtolower($section);
                $link = array('controller' => 'assessments', 'action' => 'add', $section, $value['Log']['model_id'], 'plugin' => false);
                echo $this->Html->link('View Section', $link);
              ?>
            </td>
          </tr>
        <?php } ?>
      </table>
    </td>
  </tr>
</table>