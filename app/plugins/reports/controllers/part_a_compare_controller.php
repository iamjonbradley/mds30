<?php

class PartACompareController extends AppController {

	public $name = 'PartACompare';
	public $uses = array();

	public function beforeFilter () {
		Controller::loadModel('Assessment');
	}

	public function index () {
		
	}

	public function view ($facility_id) {
		
		if (empty($facility_id))
			$this->redirect('index', null, false);

		if (!empty($facility_id)) {

		    $this->Assessment->unBindModel(
			    array(
			      	'belongsTo' => array('User'),
			      	'hasOne' => array(
			          	'SectionB', 'SectionC', 'SectionD', 'SectionE', 'SectionF',
			          	'SectionG', 'SectionH', 'SectionI', 'SectionJ', 'SectionK',
			          	'SectionL', 'SectionM', 'SectionN', 'SectionO', 'SectionP',
			          	'SectionQ', 'SectionS', 'SectionV', 'SectionX', 'SectionZ'
			      	)
			    ),
			    false
		    );
		     
		    $this->paginate = array(
				'conditions' => array(
					'Assessment.facility_id' => $facility_id,
					'Assessment.ATOPDTE != SectionA.A2400B', 
					'Assessment.ATYPEOPAY' => 'MEDICARE A',
					'SectionA.A2400B !=' => null,
					'and' => array(
						'SectionA.A2400B != ""',
					)
				),
				'fields' => array(
					'Assessment.id', 'Assessment.LOCK_DATE', 'Assessment.id', 'Assessment.ATOPDTE',
					'Facility.FNAME',
					'Resident.id', 'Resident.PATFNAME', 'Resident.PATLNAME',
					'SectionA.A2400B', 'SectionA.A2300', 'SectionA.A0310B'
				),
				'limit' => 1000
			);

			$data = $this->paginate('Assessment');
			
			$this->set(compact('data'));
		}

	}

}