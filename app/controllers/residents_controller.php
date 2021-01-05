<?php

App::import('Core', 'Sanitize');
class ResidentsController extends AppController {

	public $name = 'Residents';
	public $helpers = array('AssessmentType', 'Reports.Clock');
	
	public function index ($status = 'active') {
		
		$conditions = array('Resident.PATNUM IS NOT NULL');
		
		// sort through filters data
		$get = $this->params['url'];
		if (!empty($get['lastname']) && $get['lastname'] != 'Lastname') $conditions['Resident.PATLNAME LIKE'] = $get['lastname'] .'%';
		if (!empty($get['firstname']) && $get['firstname'] != 'Firstname') $conditions['Resident.PATFNAME LIKE'] = $get['firstname'] .'%';
		if (!empty($get['facility_id'])) $conditions['Resident.facility_id'] =	$get['facility_id'];
		if (!empty($get['status']) && $get['status'] != 'Select Status') {
			if ($get['status'] == 'A') $conditions['Resident.READM'] = ''; else 
			$conditions['Resident.READM'] = $get['status'];
		}
		
		$named = $this->params['named'];
		if (!empty($named['lastname']) && $named['lastname'] != 'Lastname') $conditions['Resident.PATLNAME LIKE'] = $named['lastname'] .'%';
		if (!empty($named['firstname']) && $named['firstname'] != 'Firstname')	$conditions['Resident.PATFNAME LIKE'] = $named['firstname'] .'%';
		if (!empty($named['facility_id'])) $conditions['Resident.facility_id'] =	$named['facility_id'];
		if (!empty($named['status']) && $named['status'] != 'Select Status') {
			if ($named['status'] == 'A') $conditions['Resident.READM'] = ''; else 
			$conditions['Resident.READM'] = $named['status'];
		}
		
		$conditions['Resident.PATLNAME !='] = null;

		if (isset($get['status']) && $get['status'] == 'Select Status')
			$status = '';
		elseif (!isset($get['status']) && $status == '')
			$status = 'active';
		else 
			$status = $status;

		switch ($status) {
			case 'active':
				$conditions['Resident.READM'] = array('A' ,'', NULL);
				break;
			case 'discharged':
				$conditions['Resident.READM'] = 'D';
				break;
			case 'expired': 
				$conditions['Resident.READM'] = 'E';
				break;
			case 'on-leave':
				$conditions['Resident.READM'] = 'L';
				break;
		}

		// set default facility info
		$fac_id = $this->Auth->user('facility_id');
		if (empty($named['facility_id']) && empty($get['facility_id']) && $this->Auth->user('facility_id') != 1) {
			$conditions['Resident.facility_id'] = $this->Auth->user('facility_id');
    	$conditions['Resident.id LIKE'] = "%". $conditions['Resident.facility_id'] ."-%";
		}
		
		$this->set('facilities', $this->Resident->Facility->getNiceList($this->Auth->user('facility_id')));
		
		$this->paginate = array(
			'conditions' => $conditions, 
			'fields' => array(
				'Resident.id', 'Resident.PATNUM', 'Resident.PATFNAME', 'Resident.PATLNAME', 'Resident.MEDICAID', 'Resident.READM', 
				'Resident.ROOM', 'Resident.BED', 'Resident.RESNO', 'Resident.MEDICARE', 'Resident.STATION', 'Resident.ADATE',
				'Resident.ATYPEOPAY', 'ATYPEOPAY2', 'Resident.ATOPDTE',
				'Facility.id', 'Facility.name'
			),
			'recursive' => 0,
			'limit' => 25
		);
		
		$data = $this->paginate('Resident');
		
		// check if the resident can start an assessment
		foreach ($data as $key => $value) {
			$cnt = ClassRegistry::init('Assessment')->checkOpen($value['Resident']['id']);
			
			$discharge = ClassRegistry::init('Assessment')->find('first', array(
				'conditions' => array('Assessment.resident' => $value['Resident']['id']),
				'fields' => array('SectionA.A0310F'),
				'order' => array('SectionA.A2300' => 'DESC')
			));
			
			$data[$key]['Allow'] = 0;
			if ($cnt == 0) $data[$key]['Allow'] = 1;
			else $data[$key]['Allow'] = 0;
				
			if (
				$value['Resident']['READM'] == 'D' && 
				$data[$key]['Allow'] = 1 && 
				($discharge['SectionA']['A0310F'] == 10 || $discharge['SectionA']['A0310F'] == 11)
			) 
				$data[$key]['Allow'] = 0;
			else  {
				if ($cnt == 0) $data[$key]['Allow'] = 1;
				else $data[$key]['Allow'] = 0;
			}
				
		}
		
		$this->set(compact('data'));
	}
	
	public function edit($id = null) {
		
		if (!empty($this->data)) { 

			$this->data['Resident']['id'] = $this->data['Resident']['facility_id'] .'-'. $this->data['Resident']['PATNUM'];

			if (!empty($this->data['Resident']['PATNUM'])) {
				if ($this->Resident->save($this->data['Resident'], false)) {

					$this->Session->setFlash('Successfully updated the resident', 'default', array('class' => 'success'));
					$this->redirect('/residents/edit/'. $this->data['Resident']['id'], null, false);
				}
				else
					$this->Session->setFlash('Could not successfully save this resident', 'default', array('class' => 'error'));
			}
			else
				$this->Session->setFlash('Could not successfully update this resident', 'default', array('class' => 'error'));
		}
			
		$this->set('facilities', ClassRegistry::init('Facility')->getNiceList($this->Auth->user('facility_id')));
		$this->set('states', ClassRegistry::init('State')->getList());
		$this->Resident->unbindModel(array('hasMany' => array('Assessment')));
		$this->data = $this->Resident->read(null, $id);

	}
	
	public function view ($id = null) {
		$this->Resident->unbindModel(array('hasMany' => array('Assessment')));
		$data = $this->Resident->find('first', array(
			'conditions' => array('Resident.PATNUM' => Sanitize::clean($id))
		));
		$this->set(compact('data'));
	}
}
?>
