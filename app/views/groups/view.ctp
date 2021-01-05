<table width="100%">
  <tr>
    <td class="left-column" valign="top">
      <!-- begin menus -->
      <ul class="left-nav">
        <li class="menu">Groups</li>
        <li><?php echo $this->Html->link('View Groups', array('controller' => 'groups', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add Group', array('controller' => 'groups', 'action' => 'aeditdd'), array('escape' => false)); ?></li>
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
          <td colspan="2" ><h2>Groups</h2></td>
        </tr>
      </table>
      <table width="100%" cellspacing="0" class="results">
        <tr>
          <td width="10%" class="leftHeader">ID:</td>
		  <td class="id"><?php echo $data['Group']['id']?></td>
        </tr>
        <tr>
          <td width="10%" class="leftHeader">Name:</td>
          <td class="align-left"><?php echo $data['Group']['name']; ?></td>
        </tr>
        <tr>        
          <td width="10%" class="leftHeader">Created:</td>
          <td class="time align-left"><?php echo $this->Time->format('F d, Y g:i:s a', $data['Group']['created']); ?></td>
        </tr>
        <tr>
          <td width="10%" class="leftHeader">Modified:</td>
          <td class="time align-left"><?php echo $this->Time->format('F d, Y g:i:s a', $data['Group']['modified']); ?></td>
		</tr>
        <tr>
          <td width="10%" class="leftHeader">Actions:</td>
          <td class="align-left">
            <?php
            echo $this->Html->link($this->Html->image('actions/edit.png'), array('action' => 'edit', $data['Group']['id']), array('escape' => false)) . ' ';
            echo $this->Html->link($this->Html->image('actions/view.png'), array('action' => 'view', $data['Group']['id']), array('escape' => false)) . ' ';
            echo $this->Html->link($this->Html->image('actions/delete.png'), array('action' => 'delete', $data['Group']['id']), array('escape' => false), 'Are you sure?');
            ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  
  
</table>