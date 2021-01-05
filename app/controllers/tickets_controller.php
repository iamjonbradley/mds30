<?php

App::import('Core', 'Sanitize');
class TicketsController extends AppController {
	
	public $components = array(
		'Email' => array(
			'from' => 'noreply@care.adelpo.net'
		)
	);
	public $helpers = array('Time', 'Text');
	public $uses = array('Ticket', 'User', 'TicketStatus');

	public function beforeRender () {
		parent::beforeRender();
		$this->set('statuses', $this->TicketStatus->get());
	}	
	
	public function index ($type = null) {
		
		if (!empty($type)) {
			if ($type != 'submitted')
				$conditions = array('Ticket.ticket_status_id' => $type); 
			else
				$conditions = array('Ticket.user_id' => $this->Auth->user('id'));
		}
		else $conditions = array();
		
		$children = $this->Ticket->Facility->getFacilities($this->Auth->user('facility_id'));

		if (count($children) == 0) $children[0] = $facility_id;

		$conditions['Ticket.ticket_category_id !='] = 4;

		foreach ($children as $key => $value) {
			$fac[] = $key;
		}
		
		$conditions['User.facility_id'] = $fac;

		if (!isset($_GET['keyword'])) {
			$this->paginate = array(
				'Ticket' => array(
					'conditions' => $conditions,
					'order' => array('Ticket.modified' => 'DESC'),
					'limit' => 100
				)
			);
				
			$data = $this->paginate('Ticket');
		}

		if (isset($_GET['keyword'])) {

			$get = Sanitize::clean($_GET);
			$conditions['or']['Ticket.subject LIKE'] = '%'. $get['keyword'] .'%';
			$conditions['or']['TicketResponse.body LIKE'] = '%'. $get['keyword'] .'%';

			$this->Session->write('Search.Ticket', $get);

			$this->paginate = array(
				'TicketResponse' => array(
					'conditions' => $conditions,
					'order' => array('TicketResponse.modified' => 'ASC'),
					'limit' => 500,
					'group' => 'TicketResponse.ticket_id'
				)
			);

			$data = $this->paginate('TicketResponse');
		}
		
		
		foreach ($data as $key => $value) {
			$last = $this->Ticket->TicketResponse->find('first', array(
				'conditions' => array('TicketResponse.ticket_id' => $value['Ticket']['id']),
				'fields' => array('User.name'),
				'order' => array('TicketResponse.created' => 'DESC'),
			));
			$data[$key]['Ticket']['last'] = $last['User']['name'];
		}
		
		$this->set(compact('data'));
	}
	
	public function add () {
		if (!empty($this->data)) {
			if (!empty($this->data['TicketResponse']['image']['name'])) {
				list($name, $extension) = explode('.', $this->data['TicketResponse']['image']['name']);
				$this->data['TicketResponse']['screenshot'] = md5($name) .'.'. strtolower($extension);
				copy ($this->data['TicketResponse']['image']['tmp_name'], WWW_ROOT .'screenshots'. DS . $this->data['TicketResponse']['screenshot']);
			}
			
			if ($this->Ticket->save($this->data, true)) {
				$this->data['TicketResponse']['ticket_id'] = $this->Ticket->id;
				$this->Ticket->TicketResponse->save($this->data);
				$this->Session->setFlash('Successfully added Ticket', 'default', array('class' => 'success'));
				$this->__sendEmail('new', $this->Ticket->id);
				$this->redirect('/tickets/view/'. $this->Ticket->id, null, false);
			}
			else {
				$this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
			}
		}
		$this->set('categories', $this->Ticket->TicketCategory->find('list'));
	}
	
	public function view ($id = null) {
		
		if (!empty($this->data)) {
				
			
			if ($this->Ticket->TicketResponse->save($this->data['TicketResponse'])) {
				$this->Ticket->save($this->data['Ticket'], false);
				$this->Session->setFlash('Successfully added the Ticket Resposne', 'default', array('class' => 'success'));
				
				if ($this->data['Ticket']['previous_assigned'] != $this->data['Ticket']['assigned_to']) {
					$this->__sendEmail('assign', $id);
				}
				
				$this->__sendEmail('response', $id);
				$this->redirect('/tickets/view/'. $id);
			}
		}
		
		$data = $this->Ticket->find('first', array(
			'conditions' => array('Ticket.id' => $id),
		));
		
		$response = $this->Ticket->TicketResponse->find('all', array(
			'conditions' => array('TicketResponse.ticket_id' => $data['Ticket']['id'])
		));
		
		foreach ($response as $key => $value) {
			$responses['TicketResponse'][$key] = $value['TicketResponse'];
			$responses['TicketResponse'][$key]['User'] = $value['User'];
			$responses['TicketResponse'][$key]['Facility'] = $value['Facility'];
		}
		
		$data['TicketResponse'] = $responses['TicketResponse'];
		
		// get id of last ticket
		$cnt = count($response);
		$latest = $cnt - 1;
		
		$depts = $this->Ticket->TicketDepartment->find('list');
		
		$users = $this->Ticket->User->getUsers();
		
		$this->set(compact('data','latest', 'depts', 'users'));
	}
	
	private function __sendEmail($type, $id) {
		
		App::import('Helper', array('Time', 'Text'));
		$this->Time = new TimeHelper();
		$this->Text = new TextHelper();
		
		switch ($type) {
			case 'response':
				// get last response
				$data = $this->Ticket->TicketResponse->find('all', array(
					'conditions' => array('TicketResponse.ticket_id' => $id),
					'order' => array('TicketResponse.id' => 'ASC')
				));
				
				// who are we notifying
				$this->Email->to			= $data[count($data) - 2]['User']['email'];
				
				// get who is replying
				$ttl_replies = count($data);
				
				// subject
				$this->Email->subject	= $data[$ttl_replies-1]['TicketDepartment']['name'] .' - ';				 // set the department
				$this->Email->subject .= strtoupper($data[$ttl_replies-1]['TicketStatus']['name']) .' | '; // set the status
				$this->Email->subject .= $data[$ttl_replies-1]['User']['name'] .' ';											 // set who sent the ticket
				$this->Email->subject .= '('. $data[$ttl_replies-1]['Facility']['name'] .') | ';					 // set the facility
				$this->Email->subject .= 'Ticket # '. $data[$ttl_replies-1]['Ticket']['id'];							 // set the ticket information
				
				// structure the email message
				$msg	= '-----------------------------------------------------------' . "\n";
				$msg .= '										 TICKET DETAILS ' . "\n";							 
				$msg .= '-----------------------------------------------------------' . "\n";
				$msg .= '' . "\n";
				$msg .= 'Posted On:			 '. $data[0]['TicketResponse']['created'] . "\n";
				$msg .= 'Posted By:			 '. $data[0]['User']['name'] .' ('. $data[0]['Facility']['name'] .')' . "\n";
				$msg .= 'Department:			'. $data[0]['TicketDepartment']['name']. "\n";
				$msg .= 'Current Status:	'. $data[0]['TicketStatus']['name']. "\n";
				$msg .= 'Assigned To:		 '. $data[0]['AssignedTo']['name']. "\n";
				$msg .= 'Subject:				 '. $data[0]['Ticket']['subject']. "\n";
				$msg .= 'Assessment ID #: '. $data[0]['Ticket']['assessment_id']. "\n";
				$msg .= '' . "\n";
				$msg .= '-----------------------------------------------------------' . "\n";
				$msg .= '													ISSUE '. "\n";
				$msg .= '-----------------------------------------------------------' . "\n";
				$msg .= '' . "\n";
				$msg .= nl2br($this->Text->autoLinkUrls($data[0]['TicketResponse']['body'])) . "\n";
				$msg .= '' . "\n";
				$msg .= '-----------------------------------------------------------' . "\n";
				
				for ($i = 1; $i < $ttl_replies; $i++) {
					$msg .= '												REPLY # '. $i .' '. "\n";
					$msg .= '-----------------------------------------------------------' . "\n";
					$msg .= '' . "\n";
					$msg .= 'Replied On:			 '. $data[$i]['TicketResponse']['created'] . "\n";
					$msg .= 'Replied By:			 '. $data[$i]['User']['name'] .' ('. $data[$i]['Facility']['name'] .')' . "\n";
					$msg .= 'Reply Status:		 '. $data[$i]['TicketStatus']['name']. "\n";
					$msg .= '' . "\n";
					$msg .= '-----------------------------------------------------------' . "\n";
					$msg .= '												 RESPONSE '. "\n";
					$msg .= '-----------------------------------------------------------' . "\n";
					$msg .= '' . "\n";
					$msg .= nl2br($this->Text->autoLinkUrls($data[$i]['TicketResponse']['body'])) . "\n";
					$msg .= '' . "\n";
					$msg .= '-----------------------------------------------------------' . "\n";
				}

				break;
				
			case 'assign':
				// get last response
				$data = $this->Ticket->TicketResponse->find('all', array(
					'conditions' => array('TicketResponse.ticket_id' => $id),
					'order' => array('TicketResponse.id' => 'ASC')
				));
				
				// who are we notifying
				$this->Email->to			= $data[0]['AssignedTo']['email'];
				
				// subject
				$this->Email->subject = 'Ticket Assignement - ('. $data[0]['TicketStatus']['name'] .') Ticket #'. $id .' - '. $data[0]['Ticket']['subject'];
				
				// structure the email message
				$msg = '' . "\n";
				foreach ($data as $key => $value) {
					$msg .= '-----------------------------------------------------------' . "\n";
					$msg .= 'Response # '. ($key + 1) .' - Posted '. $this->Time->timeAgoInWords($value['TicketResponse']['created']);
					$msg .=' - '. $value['TicketStatus']['name']. "\n";
					$msg .= '-----------------------------------------------------------' . "\n";
					$msg .= '' . "\n";
					$msg .= nl2br($this->Text->autoLinkUrls($value['TicketResponse']['body'])) . "\n";
					$msg .= ' ---- ' . "\n";
					$msg .= $value['User']['name'] .' ('. $value['Facility']['name'] .')' . "\n";
					$msg .= '' . "\n";
				}
				break;
		
			case 'new':
				// get last response
				$data = $this->Ticket->TicketResponse->find('first', array(
					'conditions' => array('TicketResponse.ticket_id' => $id),
					'order' => array('TicketResponse.id' => 'ASC')
				));
				
				// who are we notifying
				$this->Email->to			= $data['AssignedTo']['email'];
				
				$this->Email->cc			= array('shannon.t@it-mgt.com');
				
				// subject
				$this->Email->subject	= $data['TicketDepartment']['name'] .' - ';				 // set the department
				$this->Email->subject .= strtoupper($data['TicketStatus']['name']) .' | '; // set the status
				$this->Email->subject .= $data['User']['name'] .' ';											 // set who sent the ticket
				$this->Email->subject .= '('. $data['Facility']['name'] .') | ';					 // set the facility
				$this->Email->subject .= 'Ticket # '. $data['Ticket']['id'];							 // set the ticket information
				
				// structure the email message
				$msg	= '-----------------------------------------------------------' . "\n";
				$msg .= '										 TICKET DETAILS ' . "\n";							 
				$msg .= '-----------------------------------------------------------' . "\n";
				$msg .= '' . "\n";
				$msg .= 'Posted On:			 '. $data['TicketResponse']['created'] . "\n";
				$msg .= 'Posted By:			 '. $data['User']['name'] .' ('. $data['Facility']['name'] .')' . "\n";
				$msg .= 'Department:			'. $data['TicketDepartment']['name']. "\n";
				$msg .= 'Ticket Status:	 '. $data['TicketStatus']['name']. "\n";
				$msg .= 'Assigned To:		 '. $data['AssignedTo']['name']. "\n";
				$msg .= 'Subject:				 '. $data['Ticket']['subject']. "\n";
				$msg .= 'Assessment ID #: '. $data['Ticket']['assessment_id']. "\n";
				$msg .= '' . "\n";
				$msg .= '-----------------------------------------------------------' . "\n";
				$msg .= '												ISSUE '. "\n";
				$msg .= '-----------------------------------------------------------' . "\n";
				$msg .= '' . "\n";
				$msg .= nl2br($this->Text->autoLinkUrls($data['TicketResponse']['body'])) . "\n";
				$msg .= '' . "\n";
				$msg .= '-----------------------------------------------------------' . "\n";
				
				break;
		}
		
		$this->Email->send($msg);
	}

}