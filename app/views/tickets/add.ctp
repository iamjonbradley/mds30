<table width="100%">
  <tr>
    <td class="left-column" valign="top">
      <!-- begin menus -->
      <?php echo $this->element('../tickets/_menu'); ?>
    </td>
    <td valign="top">      
      <h2>Submit a Support Ticket</h2>
      
      <p>
      <strong>RULES FOR POSTING:</strong> <br /><br />
      You must provide the following:<br />
      - Please include the Assessment ID # <br />
      - as specific as you can description of the issue
      </p>
      <?php
      if ($this->Session->read('Auth.User.group_id') != 1) unset($categories[4]);
      echo $this->Form->create('Ticket', array('type' => 'file'));
      echo $this->Form->hidden('Ticket.user_id', array('value' => $this->Session->read('Auth.User.id')));
      echo $this->Form->hidden('Ticket.ticket_status_id', array('value' => 1));
      echo $this->Form->hidden('Ticket.ticket_department_id', array('value' => 1));
      echo $this->Form->hidden('Ticket.assigned_to', array('value' => 51));
      echo $this->Form->hidden('TicketResponse.user_id', array('value' => $this->Session->read('Auth.User.id')));
      echo $this->Form->hidden('TicketResponse.ticket_status_id', array('value' => 1));
      echo $this->Form->input('Ticket.ticket_category_id', array('options' => $categories));
      echo $this->Form->input('Ticket.assessment_id', array('size' => 10, 'type' => 'text', 'label' => 'The ID # of the Assessment in the MDS System not the one on the CMS Validation Report'));
      echo $this->Form->input('Ticket.subject', array('size' => 60));
      // echo $this->Form->input('TicketResponse.image', array('type' => 'file'));     
      echo $this->Form->input('TicketResponse.body', array('cols' => 70, 'rows' => 15));      
      echo $this->Form->submit('Save');
      echo $this->Form->end();
      ?>
    </td>
    
  </tr>
  
  
</table>