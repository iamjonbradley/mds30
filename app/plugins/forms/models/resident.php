<?php

class Resident extends FormsAppModel {
	
	public $name = 'Resident';
	
	public $belongsTo = array(
		'Facility' => array(
			'className' => 'Facility',
			'foriegnKey' => 'facility_id',
			'fields' => array('Facility.id', 'Facility.name')
		)
	);
	
	public function getActiveResidentList($facility_id = null, $type = null) {
		
		$conditions = array(
			'Resident.facility_id' => $facility_id, 
			'Resident.READM' => ''
		);
		
		if (!empty($type)) {
			$conditions['Resident.ATYPEOPAY'] = $type;
		}
		
		$data =  $this->find('all', array(
			'conditions' => $conditions,
			'fields' => array(
				'Resident.id',			'Resident.ADATE', 	'Resident.ATOPDTE', 	'Resident.PATLNAME', 
				'Resident.PATFNAME', 	'Resident.PATNUM', 	'Facility.name', 		'Resident.ATYPEOPAY',	
				'Resident.PATNUM', 		'Resident.ROOM', 	'Resident.PMI', 		'Resident.READM'
			),
			'recursive' => 1,
			'order' => array('Resident.PATLNAME' => 'ASC', 'Resident.PATFNAME' => 'ASC', 'Resident.PMI' => 'ASC')
		));

		return $data;
	}
	
}