<?php

class TicketStatus extends AppModel {
  
  var $name = 'TicketStatus';

  public function get () {
  	return $this->find('list', array(
  			'fields' => array('TicketStatus.id', 'TicketStatus.name'),
  			'order' => array('TicketStatus.order' => 'ASC')
	  	));
  }

}