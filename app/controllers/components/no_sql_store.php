<?php

class NoSqlStoreComponent extends Object {

	public $components = array('Calc', 'Cmi');
	public $asmt 		= '';
	public $assessment 	= '';
	
	function format ($data) {
		
		$asmt_data = $data;
		$state = $data['Facility']['F_STATE'];
		$fac_name = $data['Facility']['name'];

		unset($data['Facility']);
		
		foreach ($data as $key => $value) {

			ksort($value);
			
			foreach ($value as $key2 => $value2) {

				$this->asmt[$key2] = $value2;
			}
		}

		$this->assessment['Assessment'] 	= $this->asmt;
		$this->assessment['RUGIV'] 			= $this->Calc->calcAll($asmt_data);

		if ($state == 'PA') {
			$this->assessment['CMI-PA'] 	= $this->Cmi->calc($asmt_data);
		}

		$this->assessment['_id']			= $asmt_data['Assessment']['id'];
		$this->assessment['id']				= $asmt_data['Assessment']['id'];
		$this->assessment['state'] 			= $state;
		$this->assessment['fac_name'] 		= $fac_name;
		$this->assessment['assessment_id'] 	= $asmt_data['Assessment']['id'];
		$this->assessment['resident_id'] 	= $this->assessment['Assessment']['resident_id'];
		$this->assessment['facility_id'] 	= $this->assessment['Assessment']['facility_id'];

    	$this->Report = ClassRegistry::init('Report');
		$this->Report->save($this->assessment, false);

	}
}