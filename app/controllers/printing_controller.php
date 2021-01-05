<?php
App::import('Core', 'Sanitize');
class PrintingController extends AppController {
 
  public $uses = array(); 
	public $components = array('Caa', 'Calc', 'Reports.Clock');
  public $helpers = array('Time', 'Number', 'AssessmentType', 'AvailableSection');
  public $layout = 'printing';
  
  public function view($type = 'NC', $id, $section = null) {
    $this->Assessment = ClassRegistry::init('Assessment');
    $this->Assessment->unbindModel(array('belongsTo' => array('User')));
    $this->data = ClassRegistry::init('Assessment')->find('first', array('conditions' => array('Assessment.id' => $id)));
    $this->data = $this->Caa->report($this->data);
		
	$this->set('counties_pa', ClassRegistry::init('CountyPa')->get());

    if (!empty($section))
      $this->set(compact('section'));
  }
  
  public function caa ($id = null, $sectionNum = null) {
		
		// set to false in case printing all CAA's 
		$single = false;
		
		// $sectionNum will only have a value if user is printing otherwise null
		if( $sectionNum == null ) {
				
			$data = ClassRegistry::init('SectionV')->find('first', array(
				'conditions' => array('SectionV.assessment_id' => $id),
				'recursive' => -1
			));
		}
		else {
			$section = "V0200A" .$sectionNum. "A";
			$sectionValue = "V0200A" .$sectionNum. "D";
			$sectionLock = "V0200A" .$sectionNum. "F";
		
			$sectionVfields = "SectionV." .$section. ",SectionV." .$sectionValue. ",SectionV." .$sectionLock;

			$data = ClassRegistry::init('SectionV')->find('first', array(
				'conditions' => array('SectionV.assessment_id' => $id),
				'fields' => array('SectionV.assessment_id', $sectionVfields),
				'recursive' => -1
			));
			
			// set to true we're printing one CAA 
			$single = true;
		}
		
		$assessment = ClassRegistry::init('Assessment')->find('first', array(
			'conditions' => array('Assessment.id' => $data['SectionV']['assessment_id']),
			'fields' => array('Assessment.resident', 'Assessment.lock_date', 'Assessment.type'),
			'recursive' => -1  
		));
    
    $resident = ClassRegistry::init('Resident')->find('first', array(
      'conditions' => array('Resident.id' => $assessment['Assessment']['resident']),
      'fields' => array('Resident.PATFNAME', 'Resident.PATLNAME'),
      'recursive' => -1
    ));
    
    $this->set(compact('data', 'assessment', 'resident', 'single'));
  }

}