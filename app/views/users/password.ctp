<table width="100%">
  <tr>
    <td class="left-column" valign="top">
      <?php echo $this->element('menus/side/user', array('plugin' => 'admin')); ?>
    </td>
    <td valign="top">
      <h2>Change Password for: <?php echo $this->data['User']['name']; ?></h2>
      <?php
      echo $this->Form->create('User', array('action' => 'password'));
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