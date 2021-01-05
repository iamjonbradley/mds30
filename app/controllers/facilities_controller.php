<?php

App::import('Core', array('Sanitize', 'Security'));
class FacilitiesController extends AppController {

	public $name = 'Facilities';
	public $paginate = array(
		'Facility' => array(
			'fields' => array(
				'Facility.id', 'Facility.name', 'Facility.F_CITY', 'Facility.F_STATE', 'Facility.F_PHONE', 'Facility.F_COMPANY', 'Facility.F_LOCATION', 
				'Parent.id', 'Parent.name'
			),
			'limit' => 50,
			'order' => array('Facility.id' => 'ASC'),
			'recursive' => 0
		)
	);
	
	public function counts() {
		$counts = $this->Facility->getAssessmentCounts();
		$this->set('counts', $counts);
	}

	public function beforeFilter() {
		if ($this->Auth->user('group_id') > 2) {
			$this->Session->setFlash('Sorry you do not have access to this action', 'default', array('class' => 'error'));
			$this->redirect($this->referer(), null, false);			
		}
	}

	/**
	 * Index of Facilities
	 * @return $data array
	 */
	public function index () {
		$data = $this->paginate('Facility');
		$this->set(compact('data'));
	}
	
	/**
	 * Edit a Facility
	 * @param $this->data array data to
	 * @return $facilities array
	 */
	public function add () {
		if (!empty($this->data)) {
			if ($this->Facility->save($this->data, false)) {
				$this->Session->setFlash('Successfully added Facility', 'default', array('class' => 'success'));
				$this->redirect('index', null, false);
			}
			else {
				$this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
			}
		} 
		$this->set('facilities', $this->Facility->generatetreelist());
	}
	
	/**
	 * Edit a Facility
	 * @param $id int 
	 * @param $this->data array data to
	 * @return $facilities array
	 */
	public function edit ( $id = null ) {
		if (!empty($this->data)) {
			if ($this->Facility->save($this->data['Facility'], false)) {
				$this->Session->setFlash('Successfully added Facility', 'default', array('class' => 'success'));
			}
			else {
				$this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
			}
		}
		if (isset($id)) {
			$this->Facility->unbindModel(array('hasMany' => array('Resident')));
			$this->data = $this->Facility->find('first', array(
				'conditions' => array('Facility.id' => Sanitize::clean($id)),
			));
		}
		$this->set('facilities', $this->Facility->generatetreelist());
	}
	
	/**
	 * Delete a Facility
	 * @param $id int this is the id of the facility to bed edited
	 */
	public function delete ( $id = null ) {
		if (!$id) {
			$this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
			$this->redirect($this->referer(), null, false);
		}
		$this->Facility->id = Sanitize::clean($id);
		if ($this->Facility->delete()) {
			$this->Session->setFlash('Successfully deleted Facility', 'default', array('class' => 'success'));
			$this->redirect($this->referer(), null, false);
		}
		else {
			$this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
			$this->redirect($this->referer(), null, false);
		}
	}

}
