<?php

class CmiController extends BetaAppController {
	
	public $components = array('Reports.Cmi', 'Reports.Calc');
	public $uses = array('Assessment');

	public function index ($facility_id = null) {

		$this->set ('facility_id', $facility_id);

		$this->__setFac();
	}

	public function view () {

		if (
			(isset($this->params['url']['facility_id']) && !empty($this->params['url']['facility_id'])) && 
			(isset($this->params['url']['start']) && !empty($this->params['url']['start'])) && 
			(isset($this->params['url']['end']) && !empty($this->params['url']['end']))
		) {
			
			$f  = $this->params['url']['facility_id'];

			$s  = $this->params['url']['start']['year'] .'-';
			$s .= $this->params['url']['start']['month'] .'-';
			$s .= $this->params['url']['start']['day'];

			$e  = $this->params['url']['end']['year'] .'-';
			$e .= $this->params['url']['end']['month'] .'-';
			$e .= $this->params['url']['end']['day'];

			$data = $this->__setDate($f, $s, $e);

			$this->set(compact('data'));
		}

		$this->__setFac();

	}

	private function __setFac() {
		$facs = ClassRegistry::init('Facility')->find('list', array(
			'conditions' => array('Facility.F_STATE' => 'PA'),
			'fields' => array('Facility.id', 'Facility.name')
		));
		$this->set('cmi_facs', $facs);
	}

	private function __setDate($facility, $start, $end) {
		
		$data = $this->Assessment->find('all', array(
			'conditions' => array(
				'Assessment.facility_id' => $facility,
				'SectionA.A2300 <=' => $end,
				'Assessment.locked' => 1,
				'Assessment.deleted' => 0,
				'SectionA.A0310F !=' => '01',
				'SectionA.A2300 >=' => $start
			),
			'order' => array('Resident.PATLNAME' => 'ASC', 'Resident.PATFNAME' => 'ASC', 'SectionA.A2300' => 'ASC'),
		));
	

		foreach ($data as $key => $value) {

			$calc[$key]['Cmi'] = $this->Cmi->calc($value);

			$calc[$key]['RUGIV']['Therapy']		= $this->Calc->calcRugTherapy ($value, $facility);
			$calc[$key]['RUGIV']['Nursing']		= $this->Calc->calcRugNonTherapy ($value, $facility);
			$calc[$key]['RUGIV']['Modifier']	= $this->Calc->calcModifier($value);

			$calc[$key]['Resident']['PATLNAME']	= $value['Resident']['PATLNAME'];
			$calc[$key]['Resident']['PATFNAME']	= $value['Resident']['PATFNAME'];
			$calc[$key]['Resident']['PMI']		= $value['Resident']['PMI'];
			$calc[$key]['Resident']['PATNUM']	= $value['Resident']['PATNUM'];

			$calc[$key]['Facility']['name']		= $value['Facility']['name'];

			$calc[$key]['SectionA']['A2300']	= $value['SectionA']['A2300'];

			$t = array();
			if ($value['SectionA']['A0310A'] == '01') $t[] = 'ADM';
			if ($value['SectionA']['A0310A'] == '02') $t[] = 'QTR';
			if ($value['SectionA']['A0310A'] == '03') $t[] = 'ANN';
			if ($value['SectionA']['A0310A'] == '04') $t[] = 'SC';
			if ($value['SectionA']['A0310A'] == '05') $t[] = 'SC-COMP';
			if ($value['SectionA']['A0310A'] == '06') $t[] = 'SC-QTR';

			if ($value['SectionA']['A0310B'] == '01') $t[] = '5';
			if ($value['SectionA']['A0310B'] == '02') $t[] = '14';
			if ($value['SectionA']['A0310B'] == '03') $t[] = '30';
			if ($value['SectionA']['A0310B'] == '04') $t[] = '60';
			if ($value['SectionA']['A0310B'] == '05') $t[] = '90';
			if ($value['SectionA']['A0310B'] == '06') $t[] = 'RR';
			if ($value['SectionA']['A0310B'] == '06') $t[] = 'UNS';

			if ($value['SectionA']['A0310C'] == '1')  $t[] = 'EOT';
			if ($value['SectionA']['A0310C'] == '2')  $t[] = 'SOT';
			if ($value['SectionA']['A0310C'] == '3')  $t[] = 'SOT/EOT';
			if ($value['SectionA']['A0310C'] == '4')  $t[] = 'COT';

			if ($value['SectionA']['A0310F'] == '10') $t[] = 'DIS-R';
			if ($value['SectionA']['A0310F'] == '11') $t[] = 'DIS-A';
			if ($value['SectionA']['A0310F'] == '12') $t[] = 'DEATH';

			$type = implode($t, ' | ');

			$calc[$key]['Assessment']['id']		= $value['Assessment']['id'];
			$calc[$key]['Assessment']['type']	= $type;

		}


		return $calc;
		
	}


}