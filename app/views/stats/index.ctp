<table width="100%">
  <tr>
    <td valign="top" width="200px">
      <h2>Filters</h2>
      <?php
      echo $this->Form->create('Stat', array('url' => '/stats', 'type' => 'get'));
      echo $this->Form->input('group_id', array('label' => false, 'empty' => ' Select User Level ', 'type' => 'select', 'options' => $groups));
      echo $this->Form->input('user_id', array('label' => false, 'empty' => ' Select User ', 'type' => 'select', 'options' => $users));
      echo $this->Form->submit('Filter Results');
      echo $this->Form->end();
      ?>
    </td>
    <td width="50px">&nbsp;</td>
    <td valign="top">
      <table width="100%">
        <tr>
          <td valign="top" colspan="10"><h2>User Logs</h2></td>
          <td valign="top" colspan="5" class="align-right align-bottom" colspan="13">
            <?php 
              if (isset($this->params['url']['group_id']) || isset($this->params['url']['user_id'])) $params = array('group_id' => $this->params['url']['group_id'], 'user_id' => $this->params['url']['user_id']);
              else $params = array();
              
              $this->Paginator->options(array('url' => array_merge($params, $this->passedArgs)));
              echo $this->Paginator->prev() .' ';
              echo $this->Paginator->numbers() .' ';
              echo $this->Paginator->next(); 
            ?> 
          </td>
        </tr>
      </table>
      
      <table cellspacing="0" width="100%" class="results">
        <tr>
          <th><?php echo $this->Paginator->sort('Facility', 'Facility.name') ?></th>
          <th><?php echo $this->Paginator->sort('User Level', 'Group.name') ?></th>
          <th><?php echo $this->Paginator->sort('User', 'User.name') ?></th>
          <th><?php echo $this->Paginator->sort('Controller', 'controller') ?></th>
          <th><?php echo $this->Paginator->sort('Action', 'action') ?></th>
          <th>Params</th>
          <th><?php echo $this->Paginator->sort('Sort', 'sort') ?></th>
          <th><?php echo $this->Paginator->sort('Direction', 'direction') ?></th>
          <th><?php echo $this->Paginator->sort('Page', 'page') ?></th>
          <th><?php echo $this->Paginator->sort('IP Address', 'ip_address') ?></th>
          <th><?php echo $this->Paginator->sort('Created', 'created') ?></th>
        </tr>
        <?php foreach ($data as $key => $value): ?>
          <tr>
            <td class="align-center"><?php echo $value['Facility']['name']; ?></td>
            <td class="align-center"><?php echo $value['Group']['name']; ?></td>
            <td class="align-center"><?php echo $value['User']['name']; ?></td>
            <td class="align-center"><?php echo $value['Stat']['controller']; ?></td>
            <td class="align-center"><?php echo $value['Stat']['action']; ?></td>
            <td class="align-center"><?php echo $value['Stat']['param_1']; ?>/<?php echo $value['Stat']['param_2']; ?>/<?php echo $value['Stat']['param_3']; ?></td>
            <td class="align-center"><?php echo $value['Stat']['sort']; ?></td>
            <td class="align-center"><?php echo $value['Stat']['direction']; ?></td>
            <td class="align-center"><?php echo $value['Stat']['page']; ?></td>
            <td class="align-center"><?php echo $value['Stat']['ip_address']; ?></td>
            <td class="align-center"><?php echo $this->Time->format('m-d-Y h:i a', $value['Stat']['created']); ?></td>
          </tr>  
        <?php endforeach; ?>
      </table>
    </td>
  </tr>
</table>


