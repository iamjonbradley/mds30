<table>
  <tr>
    <td class="left-column">
      <!-- begin menus -->
      <ul class="left-nav">
        <li class="menu">Settings</li>
        <li><?php echo $this->Html->link('View Settings', array('controller' => 'settings', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add Setting', array('controller' => 'settings', 'action' => 'add'), array('escape' => false)); ?></li>
      </ul>
      <ul class="left-nav">
        <li class="menu">Users</li>
        <li><?php echo $this->Html->link('View Users', array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add User', array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Upload Users', array('controller' => 'users', 'action' => 'upload'), array('escape' => false)); ?></li>   
      </ul>
      <ul class="left-nav">
        <li class="menu">Groups</li>
        <li><?php echo $this->Html->link('View Groups', array('controller' => 'groups', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add Group', array('controller' => 'groups', 'action' => 'add'), array('escape' => false)); ?></li>
      </ul>      
    </td>
    <td>
      <h2>Edit Setting</h2>

      <?php
      echo $this->Form->create('Setting');
      echo $this->Form->hidden('id');
      echo $this->Form->input('key');
      echo $this->Form->input('value');
      echo $this->Form->submit('Submit');
      echo $this->Form->end();
      ?>
    </td>
  </tr>
</table
      
