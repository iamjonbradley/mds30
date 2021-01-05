<?php

class CensusComponent extends Object {
	
	public $name = 'Census';

	public $report_name = 'Resident Census and Conditions of Residents';

	public $full_fields = array(
		'ADL - Independent' => array(
			'F79' => 'F79 - Bathing',
			'F82' => 'F82 - Dressing',
			'F85' => 'F85 - Transferring',
			'F88' => 'F88 - Toilet Use',
			'F91' => 'F91 - Eating'
		),
		'ADL - Assist of One or Two Staff' => array(
			'F80' => 'F80 - Bathing',
			'F83' => 'F83 - Dressing',
			'F86' => 'F86 - Transferring',
			'F89' => 'F89 - Toilet Use',
			'F92' => 'F92 - Eating',
		),
		'ADL - Dependent' => array(
			'F81' => 'F81 - Bathing',
			'F84' => 'F84 - Dressing',
			'F87' => 'F87 - Transferring',
			'F90' => 'F90 - Toilet Use',
			'F93' => 'F93 - Eating'
		),
		'A. Bowel/Bladder Status' => array(
			'F94' => 'F94 - With indwelling or external catheter',
			'F95' => 'F95 - Of total number of residents with catheters,  were present on admission.',
			'F96' => 'F96 - Occasionally or frequently incontinent of bladder',
			'F97' => 'F97 - Occasionally or frequently incontinent of bowel',
			'F98' => 'F98 - On individually written bladder training program ',
			'F99' => 'F99 - On individually written bowel training program'
		),
		'B. Mobility' => array(
			'F100' => 'F100 - Bedfast all or most of time',
			'F101' => 'F101 - In chair all or most of time',
			'F102' => 'F102 - Independently ambulatory',
			'F103' => 'F103 - Ambulation with assistance or assistive device',
			'F104' => 'F104 - Physically restrained',
			'F105' => 'F105 - Of total number of residents restrained, were admitted with orders for restraints.',
			'F106' => 'F106 - With contractures',
			'F107' => 'F107 - Of total number of residents with contractures, had contractures on admission.',
		),
		'C. Mental Status' => array(
			'F108' => 'F108 - With mental retardation',
			'F109' => 'F109 - With documented signs and symptoms of depression',
			'F110' => 'F110 - With documented psychiatric diagnosis (exclude dementias and depression)',
			'F111' => 'F111 - Dementia: multi-infarct, senile, Alzheimer’s type, or other than Alzheimer’s type',
			'F112' => 'F112 - With behavioral symptoms',
			'F113' => 'F113 - Of the total number of residents with behavioral symptoms, the total number receiving a behavior management program',
			'F114' => 'F114 - Receiving health rehabilitative services for MI/MR',
		),
		'D. Skin Integrity' => array(
			'F115' => 'F115 - With pressure sores (exclude Stage I)',
			'F116' => 'F116 - Of the total number of residents with pressure sores excluding Stage I, how many residents had pressure sores on admission?',
			'F117' => 'F117 - Receiving preventive skin care',
			'F118' => 'F118 - With rashes ',
		),
		'E. Special Care' => array(
			'F119' => 'F119 - Receiving hospice care benefit',
			'F120' => 'F120 - Receiving radiation therapy',
			'F121' => 'F121 - Receiving chemotherapy',
			'F122' => 'F122 - Receiving dialysis',
			'F123' => 'F123 - Receiving intravenous therapy, parenteral nutrition, and/or blood transfusion',
			'F124' => 'F124 - Receiving respiratory treatment',
			'F125' => 'F125 - Receiving tracheostomy care',
			'F126' => 'F126 - Receiving ostomy care',
			'F127' => 'F127 - Receiving suctioning',
			'F128' => 'F128 - Receiving injections (exclude vitamin B12 injections)',
			'F129' => 'F129 - Receiving tube feedings',
			'F130' => 'F130 - Receiving mechanically altered diets including pureed and all chopped food (not only meat)',
			'F131' => 'F131 - Receiving specialized rehabilitative services (Physical therapy, speech-language therapy, occupational therapy)',
			'F132' => 'F132 - Assistive devices while eating',
		),
		'F. Medications' => array(
			'F138' => 'F138 - Receiving antibiotics',
			'F139' => 'F139 - On pain management program',
			'F133' => 'F133 - Receiving any psychoactive medication',
			'F134' => 'F134 - Receiving antipsychotic medications',
			'F135' => 'F135 - Receiving antianxiety medications',
			'F136' => 'F136 - Receiving antidepressant medications',
			'F137' => 'F137 - Receiving hypnotic medications',
			'F140' => 'F140 - With unplanned significant weight loss/gain',
			'F141' => 'F141 - Who do not communicate in the dominant language of the facility (include those who use sign language)',
			'F143' => 'F143 - Who use non-oral communication devices',
			'F143' => 'F143 - With advance directives',
			'F144' => 'F144 - Received influenza immunization',
			'F145' => 'F145 - Received pneumococcal vaccine',
		),
	);

	public function initialize(&$controller) {
		$this->info = $controller;
	}

	public function structureData($data, $facility) {

		switch ($this->info->name) {
			case 'CensusDetail':
				$report = self::__setDetailData($data);
				$extra = ' - Resident Details';
				break;
			case 'CensusAndConditions':
				$report = self::__setConditionsData($data);
				$extra = ' - CMS-672';
				break;
			default:
				$extra = '';
		}

		$report['details']['name'] = $this->report_name . $extra;
		$report['details']['facility'] = ucwords(strtolower(ClassRegistry::init('Facility')->getFacilityName($facility)));

		return $report;

	}

	private function __setConditionsData ($data) {

	    foreach ($data as $key => $value) {
	      if ($key != 'info')
	        $this->data['Survey'][$key] = count($value);
	    }

	    $report['data'] = array_merge($this->data['Survey'], $data['info']);

		return $report;
		
	}

	private function __setDetailData ($data) {
		
		foreach ($this->full_fields as $key => $value) {
			foreach ($value as $key2 => $value2) {
				if(isset($data[$key2])) 
					$report['data'][$key][$value2] = $data[$key2];
			}
		}

		return $report;
		
	}

}
