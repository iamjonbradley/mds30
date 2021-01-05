<?php

class TicketResponse extends AppModel {
  
  var $name = 'TicketResponse';
  
  var $belongsTo = array(
    'User' => array(
      'className' => 'User',
      'limit' => 1
    ),
    'Ticket' => array(
      'className' => 'Ticket',
      'limit' => 1
    ),
    'Facility' => array(
      'className' => 'Facility',
      'foreignKey' => '',
      'conditions' => 'Facility.id = User.facility_id',
      'fields' => array('Facility.id', 'Facility.name'),
      'limit' => 1
    ),
    'AssignedTo' => array(
      'className' => 'User',
      'foreignKey' => '',
      'conditions' => 'AssignedTo.id = Ticket.assigned_to',
      'fields' => array('AssignedTo.id', 'AssignedTo.name', 'AssignedTo.email')
    ),
    'TicketStatus' => array(
      'className' => 'TicketStatus',
      'foreignKey' => '',
      'conditions' => 'Ticket.ticket_status_id = TicketStatus.id',
      'fields' => array('TicketStatus.id', 'TicketStatus.name')
    ),
    'TicketCategory' => array(
      'className' => 'TicketCategory',
      'foreignKey' => '',
      'conditions' => 'Ticket.ticket_category_id = TicketCategory.id',
      'fields' => array('TicketCategory.id', 'TicketCategory.name')
    ),
    'TicketDepartment' => array(
      'className' => 'TicketDepartment',
      'foreignKey' => '',
      'conditions' => 'Ticket.ticket_department_id = TicketDepartment.id',
      'fields' => array('TicketDepartment.id', 'TicketDepartment.name')
    ),
  );

  var $validate = array(
    'body' => array(
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'message' => 'Sorry you must tell us what is your issue..'
      )
    )
  );

}