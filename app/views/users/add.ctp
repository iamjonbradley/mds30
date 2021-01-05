<table>
  <tr>
    <td class="left-column" valign="top">
      <!-- begin menus -->
      <ul class="left-nav">
        <li class="menu">Users</li>
        <li><?php echo $this->Html->link('View Users', array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add User', array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Upload Users', array('controller' => 'users', 'action' => 'upload'), array('escape' => false)); ?></li>  
      </ul>
      <?php if ($this->Session->read('Auth.User.group_id') <= 2) { ?>
      <ul class="left-nav">
        <li class="menu">Groups</li>
        <li><?php echo $this->Html->link('View Groups', array('controller' => 'groups', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add Group', array('controller' => 'groups', 'action' => 'edit'), array('escape' => false)); ?></li>
      </ul>
      <ul class="left-nav">
        <li class="menu">Settings</li>
        <li><?php echo $this->Html->link('View Settings', array('controller' => 'settings', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add Setting', array('controller' => 'settings', 'action' => 'add'), array('escape' => false)); ?></li>
      </ul>
      <?php } ?>
    </td>
    <td valign="top">
      <h2>Add User</h2>
      <?php
      echo $this->Form->create('User');
      echo $this->Form->input('facility_id', array('options' => $facilities, 'empty' => '( select a facility )', 'escape' => false));
      echo $this->Form->input('group_id', array('options' => $groups, 'empty' => '( select a group )'));
      echo $this->Form->input('name');
      echo $this->Form->input('username');
      echo $this->Form->input('password');
      echo $this->Form->input('email');
      echo $this->Form->input('status');
      echo $this->Form->submit('Submit');
      echo $this->Form->end();
      ?>
    </td>
  </tr>
</table
