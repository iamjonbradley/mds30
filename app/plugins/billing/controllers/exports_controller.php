<?php

App::import('Core', 'Sanitize');
class ExportsController extends BillingAppController {
	
	public $uses = array();
	public $components = array('Ubs', 'Ncs');
	
	public function index () {
		
	}
	
	public function view ($id = null) {
		if (!$id) {
			$this->redirect('index', null, false);
		}
	}

	public function generate () {

		$this->layout = 'ajax';
		if (!$this->data) {
			$this->redirect($this->referer(), null, false);
		}
		
		Controller::loadModel('Facility');
		
		$data = Sanitize::clean($this->data);
		
		$software = $this->Facility->find('first', array(
			'conditions' => array('Facility.id' => $data['Export']['facility_id']),
			'fields' => array('Facility.id', 'Facility.ap_software'),
			'recursive' => -1	
		));
		
		$component = Inflector::camelize($software['Facility']['ap_software']);
		
		$start 	 = $data['Export']['ard_start']['year'] .'-';
		$start 	.= $data['Export']['ard_start']['month'] .'-';
		$start 	.= $data['Export']['ard_start']['day'];
		
		$end 	 = $data['Export']['ard_end']['year'] .'-';
		$end 	.= $data['Export']['ard_end']['month'] .'-';
		$end 	.= $data['Export']['ard_end']['day'];

		// conditions
		$conditions['RugCache.facility_id'] 			= $data['Export']['facility_id'];
		$conditions['RugCache.date_ard >=']  				= $start;
		$conditions['RugCache.date_ard <=']  				= $end;
		$conditions['or']['RugCache.type_pps'] 			= array('5-DAY','14-DAY','30-DAY','60-DAY','90-DAY','RR');
		$conditions['or']['RugCache.type_omra'] 			= array('SOT','EOT','EOT-R','COT','SEOT');
		$conditions['RugCache.date_accepted !='] 	= '0000-00-00';

		$this->{$component}->generate($conditions);

		exit();

	}	

	
}