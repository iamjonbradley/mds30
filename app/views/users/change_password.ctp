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
      <?php if ($this->Session->read('Auth.User.group_id') <= 2): ?>
      <ul class="left-nav">
        <li class="menu">Groups</li>
        <li><?php echo $this->Html->link('View Groups', array('controller' => 'groups', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add Group', array('controller' => 'groups', 'action' => 'add'), array('escape' => false)); ?></li>
      </ul>
      <ul class="left-nav">
        <li class="menu">Settings</li>
        <li><?php echo $this->Html->link('View Settings', array('controller' => 'settings', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add Setting', array('controller' => 'settings', 'action' => 'add'), array('escape' => false)); ?></li>
      </ul>
      <?php endif; ?>
    </td>
    <td valign="top">
      <h2>Change Password for: <?php echo $this->data['User']['name']; ?></h2>
      <?php
      echo $this->Form->create('User', array('controller' => 'users', 'action' => 'change_password'));
      echo $this->Form->hidden('id');
      echo $this->Form->hidden('name');
      echo $this->Form->input('password_new', array('type' => 'password', 'value' => null));
      echo $this->Form->input('password_confirm', array('type' => 'password', 'value' => null));
      echo $this->Form->submit('Change Password');
      echo $this->Form->end();
      ?>
    </td>
  </tr>
</table