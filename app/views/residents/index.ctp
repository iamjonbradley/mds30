<table width="100%">
  <tr>
    <td class="left-column resident" valign="top">
      <!-- begin menus -->
      
      <ul class="left-nav">
        <li class="menu">Menu</li>
        <li><?php echo $this->Html->link('Active', array('action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Discharged', array('action' => 'index', 'discharged'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Expired', array('action' => 'index', 'expired'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('On Leave', array('action' => 'index', 'on-leave'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('List All', array('action' => 'index', 'all'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add Resident', array('action' => 'edit'), array('escape' => false)); ?></li>
      </ul>
      
      <br />
      <?php echo $this->element('../residents/_search_form'); ?>
    </td>
    <td valign="top">
      <!-- begin groups -->
      <table width="100%">
        <tr>
          <td colspan="6"><h2>Residents</h2></td>
          <td colspan="3" class="align-right align-bottom">
            <div class="tip"></div>
            <?php 
              if (isset($this->params['url']['facility_id']) || isset($this->params['url']['lastname']) || isset($this->params['url']['firstname']) || isset($this->params['url']['status'])) 
                $params = array('facility_id' => $this->params['url']['facility_id'], 'lastname' => $this->params['url']['lastname'], 'firstname' => $this->params['url']['firstname'], 'status' => $this->params['url']['status']);
              else $params = array();
              
              $this->Paginator->options(array('url' => array_merge($params, $this->passedArgs)));
              echo $this->Paginator->prev() .' ';
              echo $this->Paginator->numbers() .' ';
              echo $this->Paginator->next(); 
            ?> 
          </td>
        </tr>
      </table>  
        
      <table  width="100%" class="results" cellspacing="0">
        
        <tr>
          <th><?php echo $paginator->sort('ID', 'id') ?></th>
          <th><?php echo $paginator->sort('Facility', 'Facility.name') ?></th>
          <th><?php echo $paginator->sort('Patient', 'PATLNAME') ?></th>
          <th><?php echo $paginator->sort('Patient #', 'PATNUM') ?></th>
          <th><?php echo $paginator->sort('Entry Date', 'ADATE') ?></th>
          <th><?php echo $paginator->sort('MCARE', 'MEDICARE') ?></th>
          <th><?php echo $paginator->sort('MCAID', 'MEDICAID') ?></th>
          <th><?php echo $paginator->sort('Payment', 'ATYPEOPAY') ?></th>
          <th><?php echo $paginator->sort('Payment Date', 'ATOPDTE') ?></th>
          <th><?php echo $paginator->sort('Payment 2', 'ATYPEOPAY2') ?></th>
          <th><?php echo $paginator->sort('Status', 'READM') ?></th>
          <th class="actions">Actions</th>
        </tr>
        
        <?php foreach ($data as $key => $value): ?>
        <tr>
          <td><?php echo ucwords(strtolower($value['Resident']['id'])); ?></td>
          <td><?php echo $value['Facility']['name']; ?></td>
          <td><?php echo ucwords(strtolower($value['Resident']['PATLNAME'] .', '. $value['Resident']['PATFNAME'])); ?></td>
          <td class="align-center"><?php echo $value['Resident']['PATNUM'] ?></td>
          <td class="align-center"><?php echo $value['Resident']['ADATE'] ?></td>
          <td class="align-center"><?php echo $value['Resident']['MEDICARE'] ?></td>
          <td class="align-center"><?php echo $value['Resident']['MEDICAID'] ?></td>
          <td class="align-center"><?php echo $value['Resident']['ATYPEOPAY'] ?></td>
          <td class="align-center"><?php echo $value['Resident']['ATOPDTE'] ?></td>
          <td class="align-center"><?php echo $value['Resident']['ATYPEOPAY2'] ?></td>
          <td class="align-center">
            <?php 
            switch ( $value['Resident']['READM'] ) {
              case 'D': $status = 'Discharged'; break;
              case 'L': $status = 'On-Leave'; break;
              case 'E': $status = 'Expired'; break;
              default: $status = 'Active';
            }
            echo $status;
            ?>
          </td>
          <td class="actions">
            <?php if ($value['Allow'] == 1 && $this->Session->read('Auth.User.group_id') != 3) { ?>
              <a href="/assessments/add/<?php echo $value['Resident']['id']; ?>/<?php echo $value['Facility']['id']; ?>">
                <img alt="add" class="tooltip" title="Click here to start a new submission" src="/img/actions/add.png" />
              </a>
            <?php } else { ?>
              <img alt="add" class="tooltip" title="Sorry you can not create a new assessment for this resident" src="/img/actions/add_invalid.png" />
            <?php } ?>
            
            <a href="/residents/edit/<?php echo $value['Resident']['id']; ?>">
              <img alt="edit" class="tooltip" title="Click here to edit the resident" src="/img/actions/edit.png" />
            </a>            
            
          </td>
        </tr>
        <?php endforeach; ?>
        
      </table>
    </td>
    
  </tr>
  
  
</table>