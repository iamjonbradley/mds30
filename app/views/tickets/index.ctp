<table width="100%">
  <tr>
    <td class="left-column" valign="top">
      <!-- begin menus -->
      <?php echo $this->element('../tickets/_menu'); ?>
    </td>
    <td valign="top">      
      <table width="100%">
        <tr>
          <td colspan="6"><h2>Support Tickets</h2></td>
          <td colspan="3" class="align-right align-bottom">
            <div class="tip"></div>
            <?php 
              echo $this->Paginator->prev() .' ';
              echo $this->Paginator->numbers() .' ';
              echo $this->Paginator->next(); 
            ?> 
          </td>
        </tr>
      </table>  
      <table width="100%" cellspacing="0" class="results tickets">
        <tr>
          <th class="align-left"><?php echo $paginator->sort('#', 'id') ?></th>
          <th class="align-left"><?php echo $paginator->sort('State', 'ticket_status_id') ?></th>
          <th class="align-left"><?php echo $paginator->sort('Facility', 'Facility.name') ?></th>
          <th class="align-left"><?php echo $paginator->sort('Title', 'subject') ?></th>
          <th class="align-left"><?php echo $paginator->sort('Type', 'ticket_category_id') ?></th>
          <th class="align-left"><?php echo $paginator->sort('Dept', 'ticket_department_id') ?></th>
          <th class="align-left"><?php echo $paginator->sort('Assigned To', 'AssignedTo.name') ?></th>
          <th class="align-left">Replied Last</th>
          <th class="align-left"><?php echo $paginator->sort('Age', 'modified') ?></th>
        </tr>
        <?php        
        foreach ($data as $key => $value) {
            
          switch ($value['TicketStatus']['name']) {
            case 'closed': $status = ' class="done-ticket"'; break;
            default: $status = '';
          }
          
          
          echo '<tr>'; 
            echo '<td'. $status .'>'. $value['Ticket']['id'] .'</td>';
            echo '<td><span class="tstate '. $value['TicketStatus']['name'] .'-ticket">'. $value['TicketStatus']['name'] .'</span></td>';
            echo '<td'. $status .'>'. $value['Facility']['name'] .'</td>';
            echo '<td'. $status .'><a class="subject" href="/tickets/view/'. $value['Ticket']['id'] .'">'. $value['Ticket']['subject'] .'</a></td>';
            echo '<td'. $status .'>'. $value['TicketCategory']['name'] .'</td>';
            echo '<td'. $status .'>'. $value['TicketDepartment']['name'] .'</td>';
            echo '<td'. $status .'>'. $value['AssignedTo']['name'] .'</td>';
            echo '<td'. $status .'>'. $value['Ticket']['last'] .'</td>';
            echo '<td'. $status .'>'. $this->Time->timeAgoInWords($value['Ticket']['modified']) .'</td>';
          echo '</tr>';
          
        }
        ?>
      </table>
    </td>
    
  </tr>
  
  
</table>