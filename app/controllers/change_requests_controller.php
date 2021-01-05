<?php

class ChangeRequestsController extends AppController {

	public $helpers = array('Time');
	public $components = array('Report');

	public function beforeFilter () {
		parent::beforeFilter();
	}

	public function beforeRender () {
		parent::beforeRender();
	}
	
	public $paginate = array(
			'order' => array(
				'ChangeRequest.id' => 'DESC'
			),
			'conditions' => array(
				'ChangeRequest.status' => 0
			)
		);

	public function index () {
		$data = $this->paginate('ChangeRequest');
		$this->set(compact('data'));
	}

	public function approve ($id = null) {
		
		$data = $this->ChangeRequest->find('first', array(
				'conditions' => array('ChangeRequest.id' => $id),
				'fields' => array(
					'Assessment.id', 'Assessment.facility_id',
					'User.name', 'User.email',
					'Facility.F_STATE',
					'ChangeRequest.id', 'ChangeRequest.lock_date', 'ChangeRequest.current_lock_date', 'ChangeRequest.reason'
				),
			));
		
		// who are we notifying
		$this->Email->to		= $data['User']['email'];
		$this->Email->subject	= 'Change Request Approved';	
		
		// structure the email message
		$msg	= '-----------------------------------------------------------' . "\n";
		$msg .= '                 CHANGE APPROVAL DETAILS ' . "\n";							 
		$msg .= '-----------------------------------------------------------' . "\n";
		$msg .= '' . "\n";
		$msg .= 'Assessment ID#:     '. $data['Assessment']['id'] . "\n";
		$msg .= 'Requested By:       '. $data['User']['name'] . "\n";
		$msg .= 'Approved By:        '. $this->Auth->user('name') . "\n";
		$msg .= 'Current Lock Date:  '. $data['ChangeRequest']['current_lock_date'] . "\n";
		$msg .= 'Status:             Approved' . "\n";
		$msg .= 'New Lock Date:      '. $data['ChangeRequest']['lock_date'] . "\n";
		$msg .= 'Reason:             ' . "\n";
		$msg .= '' . "\n";
		$msg .= str_replace('\n', '<br />', $data['ChangeRequest']['reason']) . "\n";
		$msg .= '' . "\n";
		$msg .= '-----------------------------------------------------------' . "\n";
		
		//$this->Email->send($msg);

		$asmt['Assessment']['id'] = $data['Assessment']['id'];
		$asmt['Assessment']['lock_date'] = $data['ChangeRequest']['lock_date'];
		$this->ChangeRequest->Assessment->save($asmt['Assessment']);

		$chng['ChangeRequest']['id'] = $data['ChangeRequest']['id'];
		$chng['ChangeRequest']['status'] = 1;
		$chng['ChangeRequest']['approved_by'] = $this->Auth->user('id');
		$this->ChangeRequest->save($chng['ChangeRequest']);

		$this->Report->createTransmissionfile($data['Assessment']['id'], $data['Facility']['F_STATE']);

		$this->Session->setFlash('Change Approved, User Notified', 'default', array('class' => 'success'));
		$this->redirect(array('action' => 'index'), null, false);

	}

}