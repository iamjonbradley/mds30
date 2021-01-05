<table width="100%">
  <tr>
    <td class="left-column" valign="top">
      <!-- begin menus -->
      <?php echo $this->element('../tickets/_menu'); ?>
    </td>
    <td valign="top">      
      <style type="text/css">
        table.results tr td { font-size: 10pt; }
        table.results tr:nth-child(2n):hover td { background-color: #F5F5F5; }
        table.results tr:nth-child(2n):hover td.ticket-response { background-color: #FFF; }
        table.results tr:hover td.ticket-response { background-color: #F5F5F5; }
        table.results tr th.ticket-header { text-align: left; background-color: #333; color: #FFF; width: 100%; }
        table.results tr td.ticket-response { background-color: #FFF; color: #333; width: 100%; }
      </style>
      <table width="100%" cellspacing="0" class="results">
        <tr>
          <th width="100">Category</th>
          <th class="align-left">Subject</th>
          <th width="150" class="align-left">Status</th>
          <th width="125" class="align-left">Created</th>
          <th width="125" class="align-left">Updated</th>
        </tr>
        <?php        
          $status   = strtolower(str_replace(array('-', ' ', '_'), '', $data['TicketStatus']['name']));
          //echo '<tr class='. $status .'>'; 
          echo '<tr>'; 
            echo '<td class="align-center">'. $data['TicketCategory']['name'] .'</td>';
            echo '<td>'. $data['Ticket']['subject'] .'</td>';
            echo '<td>'. $data['TicketStatus']['name'] .'</td>';
            echo '<td>'. $this->Time->timeAgoInWords($data['Ticket']['created']) .'</td>';
            echo '<td>'. $this->Time->timeAgoInWords($data['Ticket']['modified']) .'</td>';
          echo '</tr>';
        ?>
      </table>
    
      <table width="100%" cellspacing="0" class="results">
        <tr>
          <th class="ticket-header" style="width: 18%"> Assigned To: </th>
          <td class="ticket-response"> <?php echo $data['AssignedTo']['name']; ?> </td>
        </tr>
        <tr>
          <th class="ticket-header" style="width: 18%"> Department: </th>
          <td class="ticket-response"> <?php echo $data['TicketDepartment']['name']; ?> </td>
        </tr>
        <tr>
          <th class="ticket-header" style="width: 18%"> ID #: </th>
          <td class="ticket-response"> <?php echo $data['Ticket']['assessment_id']; ?> </td>
        </tr>
      </table>
      
      <?php foreach ($data['TicketResponse'] as $key => $value) { ?>
      <table width="100%" cellspacing="0" class="results">
        <tr>
          <th class="ticket-header">
            Response # <?php echo $key + 1; ?> - 
            Posted <?php echo $this->Time->timeAgoInWords($value['created']); ?> 
            by: <?php echo $value['User']['name']; ?> (<?php echo $value['Facility']['name']; ?>)
          </th>
        </tr>
        <tr>
          <td class="ticket-response">
            <?php echo nl2br($this->Text->autoLinkUrls($value['body'])); ?> <br />
          </td>
        </tr>
      </table>
      <?php } ?>
      
      <?php if ($data['Ticket']['ticket_status_id'] != 6) { ?>
      <table width="100%" cellspacing="0" class="results">
        <tr>
          <th class="ticket-header">Post a response</th>
        </tr>
        <tr>
          <td class="ticket-response">
            <?php
            echo $this->Form->create('TicketResponse', array('url' => '/tickets/view/'. $data['Ticket']['id']));
            echo $this->Form->hidden('ticket_id', array('value' => $data['Ticket']['id']));
            echo $this->Form->hidden('Ticket.id', array('value' => $data['Ticket']['id']));
            echo $this->Form->hidden('user_id', array('value' => $this->Session->read('Auth.User.id')));
            echo $this->Form->hidden('Ticket.previous_assigned', array('value' => $data['Ticket']['assigned_to']));
            echo $this->Form->input('body', array('label' => false, 'style' => 'width: 97%; margin-left: 15px; margin-top: 8px;'));
            
            unset ($statuses[1]);
            
            if ($data['TicketCategory']['name'] != 'Notice')
              echo $this->Form->input('Ticket.ticket_status_id', array('label' => 'Status', 'empty' => 'Please update the tickets status', 'div' => 'input select ticket-option', 'options' => $statuses, 'selected' => $data['Ticket']['ticket_status_id']));
              
            if ($this->Session->read('Auth.User.facility_id') == 1) {
              echo $this->Form->input('Ticket.ticket_department_id', array('label' => 'Department', 'div' => 'input select ticket-option', 'options' => $depts, 'selected' => $data['Ticket']['ticket_department_id']));
              echo $this->Form->input('Ticket.assigned_to', array('label' => 'Assign To', 'div' => 'input select ticket-option', 'options' => $users, 'selected' => $this->Session->read('Auth.User.id')));
            }
              
            echo $this->Form->submit('Submit Response', array('style' => 'margin-left: 15px; margin-top: -5px;'));
            echo $this->Form->end();
            ?>
          </td>
        </tr>
      </table>
      <?php } ?>
    </td>    
  </tr>
  
  
</table>