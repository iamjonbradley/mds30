<table width="100%">
  <tr>
    <td class="left-column" valign="top">
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
    <td valign="top">
      <!-- begin groups -->
      <table width="100%">
        
        <tr>
          <td><h2>Settings</h2></td>
          <td class="align-right align-bottom" colspan="4"><?php echo $paginator->prev() .' '. $paginator->numbers() .' '. $paginator->next(); ?> </td>
        </tr>
      </table>
      
      <table  width="100%" cellspacing="0" class="results">
        
        <tr>
          <th><?php echo $paginator->sort('Key', 'key') ?></th>
          <th><?php echo $paginator->sort('Value', 'value') ?></th>
          <th class="actions">Edit</th>
        </tr>
        
        <?php foreach ($data as $key => $value): ?>
        <tr>
          <td class="align-center"><?php echo $value['Setting']['key']; ?></td>
          <td class="align-center"><?php echo $value['Setting']['value']; ?></td>
          <td class="actions">
            <?php
            echo $this->Html->link($this->Html->image('actions/edit.png'), array('action' => 'edit', $value['Setting']['id']), array('escape' => false)) . ' ';
            echo $this->Html->link($this->Html->image('actions/delete.png'), array('action' => 'delete', $value['Setting']['id']), array('escape' => false), 'Are you sure?');
            ?>
          </td>
        </tr>
        <?php endforeach; ?>
        
      </table>
    </td>
    
  </tr>
  
  
</table>