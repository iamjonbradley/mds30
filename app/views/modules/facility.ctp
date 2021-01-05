<table width="100%">
  <tr>
    <td class="left-column" valign="top">
      <?php echo $this->element('menus/side/modules', array('plugin' => 'admin')); ?>
    </td>
    <td valign="top">
      <h3>Available Modules for: <?php echo $facility; ?></h3>
      <?php
        echo $this->Form->create('Module', array('url' => '/modules/facility/'. $this->params['pass'][0]));
      ?>
      <table>
        <tr>
          <th>Module Name</th>
          <th>Access</th>
        </tr>
        <?php
        foreach ($modules as $key => $value) {
          echo $this->Form->hidden('ModulePermission.'. $key .'.module_id', array('value' => $key));
          echo $this->Form->hidden('ModulePermission.'. $key .'.facility_id', array('value' => $this->params['pass'][0]));
          
          if (isset($permissions[$key])) $allowed = $permissions[$key]; else $allowed = 0;
          
          echo '<tr>';
            echo '<td>'. $value .'</td>';
            echo '<td>'. $this->Form->input('ModulePermission.'. $key .'.allowed', array('label' => false, 'div' => false, 'type' => 'select', 'options' => array(0 => 'Not Allowed', 1 => 'Allowed'), 'selected' => $allowed)) .'</td>';
          echo '</tr>';
        }    
        ?>
      </table>
      <?php
        echo $this->Form->submit('Update Facility');
        echo $this->Form->end();    
      ?>
    </td>    
  </tr>  
</table>