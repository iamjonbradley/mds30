  <table width="100%">
    <tr>
      <td class="left-column resident" valign="top">
      
      <ul class="left-nav">
        <li class="menu">Menu</li>
        <li><?php echo $this->Html->link('List Facilities', array('action' => 'index'), array('escape' => false)); ?></li>
        <?php if ($this->Session->read('Auth.User.group_id') == 1) { ?>
          <li><?php echo $this->Html->link('Add Facility', array('action' => 'edit'), array('escape' => false)); ?></li>
        <?php } ?>
      </ul>
        
      </td>
      <td valign="top">
        <table width="100%">
          
          <tr>
            <td colspan="4"><h2>Facilities</h2></td>
            <td class="align-right" style="vertical-align: bottom" colspan="5">
              <div class="tip"></div>
              <?php echo $paginator->prev() .' '. $paginator->numbers() .' '. $paginator->next(); ?> 
            </td>
          </tr>
        </table>      
        
        <table width="100%" cellspacing="0" class="results"> 
          <tr>
            <th class="id"><?php echo $paginator->sort('ID', 'id') ?></th>
            <th style="width: 200px"><?php echo $paginator->sort('Name', 'name') ?></th>
            <th style="width: 200px"><?php echo $paginator->sort('Parent', 'Parent.name') ?></th>
            <th><?php echo $paginator->sort('City', 'F_CITY') ?></th>
            <th><?php echo $paginator->sort('State', 'F_STATE') ?></th>
            <th><?php echo $paginator->sort('Phone', 'F_PHONE') ?></th>
            <th><?php echo $paginator->sort('Company', 'F_COMPANY') ?></th>
            <th><?php echo $paginator->sort('Location', 'F_LOCATION') ?></th>
            <?php if ($this->Session->read('Auth.User.group_id') == 1) { ?>
              <th class="actions">Actions</th>
            <?php } ?>
          </tr>
          
          <?php foreach ($data as $key => $value): ?>
          <tr>
            <td class="id"><?php echo $value['Facility']['id']; ?></td>
            <td class="id"><?php echo ucwords(strtolower($value['Facility']['name'])); ?></td>
            <td class="id"><?php echo ucwords(strtolower($value['Parent']['name'])); ?></td>
            <td class="id"><?php echo $value['Facility']['F_CITY']; ?></td>
            <td class="id"><?php echo $value['Facility']['F_STATE']; ?></td>
            <td class="id"><?php echo $value['Facility']['F_PHONE']; ?></td>
            <td class="id"><?php echo $value['Facility']['F_COMPANY']; ?></td>
            <td class="id"><?php echo $value['Facility']['F_LOCATION']; ?></td>
            <?php if ($this->Session->read('Auth.User.group_id') == 1) { ?>
              <td class="actions">
                <?php  
                echo $this->Html->link(
                  $this->Html->image(
                    'actions/edit.png', 
                    array('alt' => 'edit', 'class' => 'tooltip', 'title' => 'Click here to edit the facility')
                  ),
                  array('action' => 'edit', $value['Facility']['id']),
                  array('escape' => false)
                );
                
                echo '&nbsp';
                
                echo $this->Html->link(
                  $this->Html->image(
                    'actions/delete.png', 
                    array('alt' => 'delete', 'class' => 'tooltip', 'title' => 'Click here to delete the facility')
                  ),
                  array('action' => 'delete', $value['Facility']['id']),
                  array('escape' => false)
                );                
                
                ?>
              </td>
            <?php } ?>
          </tr>
          <?php endforeach; ?>
          
        </table>
    </td>
    
  </tr>
  
  
</table>