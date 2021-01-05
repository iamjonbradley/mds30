<?php

App::import('Core', 'Sanitize');
class Ticket extends AppModel {
  
  public $name = 'Ticket';
  
  public $belongsTo = array(
    'User' => array(
      'className' => 'User',
      'fields' => array('User.id', 'User.name'),
    ),
    'TicketStatus' => array(
      'className' => 'TicketStatus',
      'foreignKey' => 'ticket_status_id',
      'fields' => array('TicketStatus.id', 'TicketStatus.name')
    ),
    'TicketCategory' => array(
      'className' => 'TicketCategory',
      'foreignKey' => 'ticket_category_id',
      'fields' => array('TicketCategory.id', 'TicketCategory.name')
    ),
    'TicketDepartment' => array(
      'className' => 'TicketDepartment',
      'foreignKey' => 'ticket_department_id',
      'fields' => array('TicketDepartment.id', 'TicketDepartment.name')
    ),
    'Facility' => array(
      'className' => 'Facility',
      'foreignKey' => '',
      'conditions' => 'Facility.id = User.facility_id',
      'fields' => array('Facility.id', 'Facility.name')
    ),
    'AssignedTo' => array(
      'className' => 'User',
      'foreignKey' => '',
      'conditions' => 'AssignedTo.id = Ticket.assigned_to',
      'fields' => array('AssignedTo.id', 'AssignedTo.name')
    )
  );

  
  public $hasOne = array(
    'Last' => array(
      'className' => 'TicketResponse',
      'foreignKey' => false,
      'conditions' => array('Last.ticket_id' => 'Ticket.id'),
      'order' => array('Last.created' => 'ASC'),
      'group' => array('Last.ticket_id'),
      'limit' => 1
    ),
  );
  
  public $hasMany = array(
    'TicketResponse' => array(
      'className' => 'TicketResponse',
      'foreignKey' => 'ticket_id',
      'order' => array('TicketResponse.created' => 'ASC')
    ),
  );

  public $validate = array(
    'subject' => array(
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'message' => 'Sorry you must provide a subject.'
      )
    ),
    'assessment_id' => array(
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'message' => 'Sorry you must provide an assessment id.'
      )
    ),
    'ticket_category_id' => array(
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'message' => 'Sorry you must provide a category.'
      )
    ),
  );
  
  public function getNotices($limit = null) {
    $this->unbindModel(array('belongsTo' => array('TicketStatus', 'TicketCategory', 'User', 'Facility')));
    
    $data = $this->find('all', array(
      'conditions' => array('Ticket.ticket_category_id' => 4), 
      'order' => array('Ticket.id' => 'DESC'), 
      'limit' => $limit
    ));
    
    foreach ($data as $key => $value) {
      $data[$key]['Ticket']['body'] = $value['TicketResponse'][0]['body'];
      unset ($data[$key]['TicketResponse']);
    }
    
    return $data;
  }
  
  public function getType ($id = null) {
    return $this->find('all', array(
      'conditions' => array('Ticket.change_status_id' => Sanitize::clean($id)),
      'fields' => array(
        'TicketCategory.name',
        'Ticket.id', 'Ticket.subject', 'Ticket.body', 'Ticket.modified'
      )
    ));
  }
}
