<?php

class TestController extends AppController {
	
	public $uses = array('Assessment', 'Report');

	public function index () {
		
		$this->Assessment->unBindModel(array(
			'belongsTo' => array('User', 'Facility', 'Resident')
		));

		$assessments = $this->Assessment->find('all', array(
			'conditions' => array(
				'Assessment.facility_id' => 3,
				'Assessment.locked' => 1,
				'Assessment.transmission_status' => 2,
				'Assessment.deleted' => 0,
			),
			//'limit' => 500
		));

		echo count($assessments);
		die;

		foreach ($assessments as $assessment) {

			foreach ($assessment as $key => $value) {

					ksort($value);
				
				foreach ($value as $key2 => $value2) {

					$asmt[$key2] = $value2;
				}
			}

			$asmt['_id'] = $asmt['id']; 

			$this->Report->save($asmt, false);
		}


		die;
	}
}