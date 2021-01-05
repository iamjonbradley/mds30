<?php

App::import('Core', 'Sanitize');
class MidnightRulesController extends AppController {

	
	public function lookup () {

		$this->layout = 'ajax';
		$this->render = false;

		Controller::loadModel('Resident');

		$facility_id = Sanitize::clean($_GET['facility_id']);

		$data = $this->Resident->find('all', array(
			'conditions' => array(
				'Resident.facility_id'	=> Sanitize::clean($facility_id),
				'Resident.READM'		=> array('A' ,'', NULL)
			),
			'fields' => array('Resident.id', 'Resident.PATLNAME', 'Resident.PATFNAME'),
			'order' => array('Resident.PATLNAME' => 'ASC', 'Resident.PATFNAME' => 'ASC'),
			'recursive' => -1
		));

		foreach ($data as $key => $value) {
			$residents[$value['Resident']['id']] = $value['Resident']['PATLNAME'] .', '. $value['Resident']['PATFNAME'];
		}

		$this->set('data', $residents);
	}

	public function save () {
		if (!empty($this->data)) {
			$data = Sanitize::clean($this->data);
			$data['MidnightRule']['user_id'] = $this->Session->read('Auth.User.id');

			if ($this->MidnightRule->save($data)) {
		
				Controller::loadModel('Resident');
				
				$resident = $this->Resident->find('first', array(
					'conditions' => array('Resident.id' => Sanitize::clean($data['Resident']['id'])),
					'fields' => array('Resident.PATLNAME', 'Resident.PATFNAME'),
					'recursive' => -1
				));

				$msg  = 'Successfully record the Midnight Rule information for ';
				$msg .= $resident['Resident']['PATFNAME'] .' '. $resident['Resident']['PATLNAME'];
				$msg .= ' on '. $data['MidnightRule']['date']['month'] .'-'. $data['MidnightRule']['date']['day'] .'-'. $data['MidnightRule']['date']['year'];

				$this->Session->setFlash($msg, 'default', array('class' => 'success'));
				$this->redirect('/', null, false);
				
			}
			else {
				$this->Session->setFlash('There was an error saving the midnight rule', 'default', array('class' => 'success'));
				$this->redirect('/', null, false);
			}

		}

	}

}