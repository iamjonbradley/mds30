<table width="100%">
  <tr>
    <td class="left-column" valign="top">
      <!-- begin menus -->
      <ul class="left-nav">
        <li class="menu">Groups</li>
        <li><?php echo $this->Html->link('View Groups', array('controller' => 'groups', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add Group', array('controller' => 'groups', 'action' => 'edit'), array('escape' => false)); ?></li>
      </ul>
      <ul class="left-nav">
        <li class="menu">Users</li>
        <li><?php echo $this->Html->link('View Users', array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add User', array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Upload Users', array('controller' => 'users', 'action' => 'upload'), array('escape' => false)); ?></li>  
      </ul>
      <ul class="left-nav">
        <li class="menu">Settings</li>
        <li><?php echo $this->Html->link('View Settings', array('controller' => 'settings', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add Setting', array('controller' => 'settings', 'action' => 'add'), array('escape' => false)); ?></li>
      </ul>
    </td>
    <td valign="top">      
      <table width="100%">        
        <tr>
          <td><h2>Groups</h2></td>
          <td class="align-right align-bottom" colspan="4"><?php echo $paginator->prev() .' '. $paginator->numbers() .' '. $paginator->next(); ?> </td>
        </tr>
      </table>
        
      <table width="100%" cellspacing="0" class="results">
        <tr>
          <th class="id"><?php echo $paginator->sort('ID', 'id') ?></th>
          <th><?php echo $paginator->sort('Name', 'name') ?></th>
          <th><?php echo $paginator->sort('Parent', 'Parent.name') ?></th>
          <th class="time"><?php echo $paginator->sort('Created', 'created') ?></th>
          <th class="time"><?php echo $paginator->sort('Modified', 'modified') ?></th>
          <th class="actions">Actions</th>
        </tr>
        
        <?php foreach ($data as $key => $value): ?>
        <tr>
          <td class="id"><?php echo $value['Group']['id']; ?></td>
          <td class="align-center"><?php echo $value['Group']['name']; ?></td>
          <td class="align-center"><?php echo $value['Parent']['name']; ?></td>
          <td class="time align-center"><?php echo $this->Time->format('F d, Y g:i:s a', $value['Group']['created']); ?></td>
          <td class="time align-center"><?php echo $this->Time->format('F d, Y g:i:s a', $value['Group']['modified']); ?></td>
          <td class="actions">
            <?php
            echo $this->Html->link($this->Html->image('actions/edit.png'), array('action' => 'edit', $value['Group']['id']), array('escape' => false)) . ' ';
            echo $this->Html->link($this->Html->image('actions/delete.png'), array('action' => 'delete', $value['Group']['id']), array('escape' => false), 'Are you sure?');
            ?>
          </td>
        </tr>
        <?php endforeach; ?>
        
      </table>
    </td>
    
  </tr>
  
  
</table>