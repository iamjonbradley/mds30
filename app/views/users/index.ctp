<table width="100%">
  <tr>
    <td valign="top" class="left-column">
      <!-- begin menus -->
      <ul class="left-nav">
        <li class="menu">Users</li>
        <li><?php echo $this->Html->link('View Users', array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add User', array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?></li>
        <?php if ($this->Session->read('Auth.User.group_id') <= 2) { ?>
	        <li><?php echo $this->Html->link('Upload Users', array('controller' => 'users', 'action' => 'upload'), array('escape' => false)); ?></li>
      	<?php } ?>   
      </ul>
      <?php if ($this->Session->read('Auth.User.group_id') <= 2): ?>
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
      <br />
      
      <ul class="left-nav">
        <li class="menu">User Search Options</li>
        <li style="display: block">
          <?php
          echo $this->Form->create('User', array('action' => 'index', 'type' => 'get'));
          
          // start facility
          if (isset($this->params['named']['facility_id'])) $facility_id = $this->params['named']['facility_id'];
          elseif (isset($this->params['url']['facility_id'])) $facility_id = $this->params['url']['facility_id'];
          else $facility_id = '';
          echo $this->Form->input('facility_id', array('label' => false, 'empty' => ' Select Facility', 'type' => 'select', 'options' => $facilities, 'selected' => $facility_id));
          ?>
          <div class="input text">
            <?php 
						if (isset( $this->params['url']['name']) && $this->params['url']['name'] != '') $value =  $this->params['url']['name'];
					 	elseif (isset($this->params['named']['name']) && $this->params['url']['name'] != '') $facility_id = $this->params['named']['name'];
						else $value = 'Name'; ?>
            <input style="width: 90%" type="text" name="name" value="<?php echo $value; ?>" onfocus="if(this.value == '<?php echo $value; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $value; ?>';}" />
          </div>
          <?php 
          // start facility
          if (isset($this->params['named']['group_id'])) $group_id = $this->params['named']['group_id'];
          elseif (isset($this->params['url']['group_id'])) $group_id = $this->params['url']['group_id'];
          else $group_id = '';
          echo $this->Form->input('group_id', array('label' => false, 'empty' => ' Select Group', 'type' => 'select', 'options' => $groups, 'selected' => $group_id));
          echo $this->Form->submit('Filter Results');
					echo $this->Form->button('Reset', array('onclick' => 'clearForms(); return false;'));
          echo $this->Form->end();
          ?>          
        </li>
      </ul>
      <?php endif; ?>
    </td>
    <td valign="top">      
      <table>        
        <tr>
          <td><h2>Users</h2></td>
          <td class="align-right align-bottom" colspan="8"><?php echo $paginator->prev() .' '. $paginator->numbers() .' '. $paginator->next(); ?> </td>
        </tr>
      </table>
      
      <table width="100%" cellspacing="0" class="results">
        <tr>
          <th class="id"><?php echo $paginator->sort('ID', 'id') ?></th>
          <th><?php echo $paginator->sort('Group', 'group_id') ?></th>
          <th><?php echo $paginator->sort('Facility', 'facility_id') ?></th>
          <th><?php echo $paginator->sort('Name', 'name') ?></th>
          <th><?php echo $paginator->sort('Username', 'username') ?></th>
          <th><?php echo $paginator->sort('Email', 'email') ?></th>
          <th class="time"><?php echo $paginator->sort('Created', 'created') ?></th>
          <th class="time"><?php echo $paginator->sort('Modified', 'modified') ?></th>
          <th class="actions">Actions</th>
        </tr>
        
        <?php foreach ($data as $key => $value): ?>
        <tr>
          <td class="id"><?php echo $value['User']['id']; ?></td>
          <td class="align-center"><?php echo $value['Group']['name']; ?></td>
          <td class="align-center"><?php echo $value['Facility']['name']; ?></td>
          <td class="align-center"><?php echo $value['User']['name']; ?></td>
          <td class="align-center"><?php echo $value['User']['username']; ?></td>
          <td class="align-center"><?php echo $this->Text->autoLinkEmails($value['User']['email']); ?></td>
          <td class="time align-center"><?php echo $this->Time->format('m-d-y', $value['User']['created']); ?></td>
          <td class="time align-center"><?php echo $this->Time->format('m-d-y', $value['User']['modified']); ?></td>
          <td class="actions">
            <?php
            echo $this->Html->link($this->Html->image('actions/edit.png'), array('action' => 'edit', $value['User']['id']), array('escape' => false)) . ' '; 
            echo $this->Html->link($this->Html->image('actions/password.png'), array('action' => 'change_password', $value['User']['id']), array('escape' => false)) . ' ';
            echo $this->Html->link($this->Html->image('actions/delete.png'), array('action' => 'delete', $value['User']['id']), array('escape' => false), 'Are you sure?');
            ?>
          </td>
        </tr>
        <?php endforeach; ?>
        
      </table>
    </td>
    
  </tr>
  
  
</table>