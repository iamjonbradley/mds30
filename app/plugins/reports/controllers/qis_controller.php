<?php

App::import('Core', 'Sanitize');
class QisController extends ReportsAppController {

	public $name = 'Qis';
	public $components = array('Caa', 'Calc', 'Reports.Clock', 'Excel', 'AssessmentType');
	public $helpers = array('Time', 'Number', 'AssessmentType', 'AvailableSection', 'DatePicker');
	public $uses = array();
	public $fields = array(
		'Assessment.id',
		'SectionA.A1300A',
		'SectionA.A0500C',
		'SectionA.A0500A',
		'SectionA.A2300',
		'Assessment.type'
	);
	
	public function index ($type = null) {

		$this->submitted = $this->params['url'];

		unset ($this->submitted['ext']);
		unset ($this->submitted['type']);
		unset ($this->submitted['url']);

		if (!empty($this->params['named']) && isset($this->params['named'])) {
			$this->submitted = $this->params['named'];
		}

		if (!empty ($this->submitted) && !empty($this->submitted['facility_id'])) {
			self::__setData($this->submitted);
		}
		
		// set facilities
		$allowed_facilities = array();
		$allowed_facilities = ClassRegistry::init('Facility')->getNiceList($this->Auth->user('facility_id'));
		$this->set('allowed_facilities', $allowed_facilities);
		
	}
	
	function print_report () {
		$this->layout = 'printing';
		
		self::__setData($this->params['url']);
		
		$this->render('printer');
	}

	private function __setData($submitted) {

		if (!empty ($submitted) && !empty($submitted['facility_id'])) {
			
			// clean the data
			$submitted = Sanitize::clean($submitted);
			
			$conditions['Assessment.facility_id'] = $submitted['facility_id'];
			
			$conditions['SectionA.A2300 >='] = $submitted['ard_start'];
			$conditions['SectionA.A2300 <='] = $submitted['ard_end'];
			$conditions['Assessment.deleted'] = 0;
			
		}

		$results = '';
		
		if (!empty($conditions) && isset($submitted['report_type']) && isset($submitted['report_type'])) {
			
			switch ($submitted['report_type']) {
					
				case 'MOBILITY':
					$conditions['or']['SectionG.G0110E1'] = 1;
					
					$this->fields[] = 'SectionG.G0110E1';
				break;
				
				case 'RESTRAINTS':
					$conditions['or']['SectionP.P0100A'] = array('1','2');
					$conditions['or']['SectionP.P0100B'] = array('1','2');
					$conditions['or']['SectionP.P0100C'] = array('1','2');
					$conditions['or']['SectionP.P0100D'] = array('1','2');
					$conditions['or']['SectionP.P0100E'] = array('1','2');
					$conditions['or']['SectionP.P0100F'] = array('1','2');
					$conditions['or']['SectionP.P0100G'] = array('1','2');
					$conditions['or']['SectionP.P0100H'] = array('1','2');
					
					$this->fields[] = 'SectionP.P0100A';
					$this->fields[] = 'SectionP.P0100B';
					$this->fields[] = 'SectionP.P0100C';
					$this->fields[] = 'SectionP.P0100D';
					$this->fields[] = 'SectionP.P0100E';
					$this->fields[] = 'SectionP.P0100F';
					$this->fields[] = 'SectionP.P0100G';
					$this->fields[] = 'SectionP.P0100H';
				break;
				
				case 'UTI':
					$conditions['SectionI.I2300'] = 1;
					
					$this->fields[] = 'SectionI.I2300';
				break;
				
				case 'FALLS':
					$conditions['SectionJ.J1800'] = 1;
					$this->fields[] = 'SectionJ.J1900A';
					$this->fields[] = 'SectionJ.J1900B';
					$this->fields[] = 'SectionJ.J1900C';
				break;
				
				case 'PAIN':
					$conditions['SectionJ.J0300'] = 1;
					
					$this->fields[] = 'SectionJ.J0300';
					$this->fields[] = 'SectionJ.J0400';
					$this->fields[] = 'SectionJ.J0500A';
					$this->fields[] = 'SectionJ.J0500B';
					$this->fields[] = 'SectionJ.J0600A';
					$this->fields[] = 'SectionJ.J0600B';
					$this->fields[] = 'SectionJ.J0100A';
    
				break;
				
				case 'WEIGHT_LOSS':
					$conditions['or']['not']['SectionK.K0300'] = 0;
					
					$this->fields[] = 'SectionK.K0300';
				break;
				
				case 'ULCERS':
					$conditions['or']['SectionM.M0300B1'] = array(1,2,3,4,5,6,7,8,9);
					$conditions['or']['SectionM.M0300C1'] = array(1,2,3,4,5,6,7,8,9);
					$conditions['or']['SectionM.M0300D1'] = array(1,2,3,4,5,6,7,8,9);
					$conditions['or']['SectionM.M0800A']	= array(1,2,3,4,5,6,7,8,9);
					$conditions['or']['SectionM.M0800B']  = array(1,2,3,4,5,6,7,8,9);
					$conditions['or']['SectionM.M0800C']  = array(1,2,3,4,5,6,7,8,9);
					
					$this->fields[] = 'SectionM.M0300B1';
					$this->fields[] = 'SectionM.M0300C1';
					$this->fields[] = 'SectionM.M0300D1';
					$this->fields[] = 'SectionM.M0800A';
					$this->fields[] = 'SectionM.M0800B';
					$this->fields[] = 'SectionM.M0800C';
				break;
				
				case 'CATHETER':
					$conditions['or']['SectionH.H0100A'] = 1;
					
					$this->fields[] = 'SectionH.H0100A';
					$this->fields[] = 'SectionI.I1550';
					$this->fields[] = 'SectionI.I1650';
					
				break;
				
				case 'OSTOMY':
					$conditions['or']['SectionH.H0100C'] = 1;
					
					$this->fields[] = 'SectionH.H0100C';
				break;
			}

			$this->paginate = array(
				'conditions' => $conditions,
				'order' => array('Resident.PATLNAME' => 'ASC', 'Resident.PATFNAME' => 'ASC', 'SectionA.A2300' => 'ASC'),
				'sort' => array('SectionA.A0500C' => 'ASC', 'SectionA.A0500A' => 'ASC', 'SectionA.A2300' => 'ASC'),
				'limit' => 5000
			);

			$this->Assessment = ClassRegistry::init('Assessment');
			$info = $this->paginate('Assessment');

			if (!empty($info)) {
			
				$results = array();
				
				foreach ($info as $key => $value) {
					
					foreach ($this->fields as $key2 => $value2) {
						list($model,$field) = explode('.', $value2);

						$results[$key][$field] = ($field == 'type') ? $this->AssessmentType->get($value) :  $value[$model][$field];
					}

					if (count($this->fields) == 6) {
						
						switch ($submitted['report_type']) {
							
							case 'BIMS':
								if ($value['SectionC']['C0100'] == 1)
									$results[$key]['BIMS'] = $value['SectionC']['C0500'];
								else
									$results[$key]['BIMS'] = '';
								break;
							
							case 'PHQ9':
								$results[$key]['D0300'] = $value['SectionD']['D0300'];
								$results[$key]['D0600'] = $value['SectionD']['D0600'];
								break;
								
							case 'MIN':
								$results[$key]['MIN'] = $value['RugCache']['minutes_ttl'];
								break;
								
							case 'VACCINE':
								$results[$key]['O0250A'] = $value['SectionO']['O0250A'];
								$results[$key]['O0250C'] = $value['SectionO']['O0250C'];
								$results[$key]['O0300A'] = $value['SectionO']['O0300A'];
								$results[$key]['O0300B'] = $value['SectionO']['O0300B'];
								break;
								
							case 'BOWELBLADDER':
								$results[$key]['H0300'] = $value['SectionH']['H0300'];
								$results[$key]['H0400'] = $value['SectionH']['H0400'];
								break;
								
							case 'ADL':
								$results[$key]['ADL'] = $calc['RugCache']['adl'];
								break;
								
							case 'REST':
								$results[$key]['REST'] = $calc['restorative'];
								break;
								
							case 'DEP':
								$results[$key]['DEP'] = $calc['depressed'];
								break;
								
								
						}
						
					}
					
				}
	
				$this->set('results', $results);
			}
		}
		
		// set facilities
		$allowed_facilities = array();
		$allowed_facilities = ClassRegistry::init('Facility')->getNiceList($this->Auth->user('facility_id'));
		$this->set('allowed_facilities', $allowed_facilities);
	}
}
?>
