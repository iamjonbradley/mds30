<?php

App::import('Core', array('Xml', 'Set', 'Folder', 'File')); 
App::import('Component',array('Caa', 'Skip')); 
class UpdateQuaterlyLogsShell extends Shell {  

	function main() {

		$this->Quarter = ClassRegistry::init('QuarterlyLog');
		$this->Assessment = ClassRegistry::init('Assessment');
		
		$data = $this->Assessment->find('all', array(
			'conditions' => array(
				'SectionA.A0310A' => array('01', '02', '03', '04'),
				'Assessment.locked' => true,
				'Assessment.transmission_status' => 2
			),
			'fields' => array(
				'Assessment.id', 'Assessment.lock_date',
				'Resident.id',
				'SectionA.A0310A', 'SectionA.A2300'
			)	
		));
		
		foreach ($data as $key => $value) {
			
			switch ($value['SectionA']['A0310A']) {
				case '01':	$quarter['type'] = 'ADM';	break;
				case '02':	$quarter['type'] = 'Q';		break;
				case '03':	$quarter['type'] = 'A';		break;
				case '04':	$quarter['type'] = 'SC';		break;
			}
			
			$quarter['assessment_id']	= $value['Assessment']['id'];
			$quarter['resident_id']		= $value['Resident']['id'];
			$quarter['ard']				= $value['SectionA']['A2300'];
			
			$this->Quarter->create();
			$this->Quarter->save($quarter, false);
			
		}
	}

}