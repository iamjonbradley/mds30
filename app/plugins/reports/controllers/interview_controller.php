<?php

App::import('Core', 'Sanitize');
class InterviewController extends AppController {

	public $name = 'Interview';
	public $components = array('Excel', 'Caa', 'Calc');
	public $helpers = array('AssessmentType');
	public $uses = array();
	
	public function index ($facility_id = null) {
    $this->__setData($facility_id);
		$allowed_facilities = array();
		$allowed_facilities = ClassRegistry::init('Facility')->getNiceList($this->Auth->user('facility_id'));
		$this->set('allowed_facilities', $allowed_facilities);
		$this->set('facility_id', $facility_id);
	}
  
  public function view ($facility_id = null) {
    self::index($facility_id);
    $this->render('index');
  }
		
	public function printer ($facility_id = null,$date_start = null, $date_end = null) {
		Configure::write('debug', 0);
		$this->layout = 'printing';
		$this->__setData($facility_id, $date_start, $date_end);
	}
  
  public function excel ($facility_id = null,$date_start = null, $date_end = null) {
    $data = $this->__setData($facility_id, $date_start, $date_end);
    
    $info[] = 'Assessment #, PATNUM, Last Name, First Name, ARD Date, C0100, D0100, J0200';
    
    foreach ($data as $key => $value) {
      $str  = $value['Assessment']['id'] .',';     
      $str .= $value['Resident']['PATNUM'] .',';      
      $str .= $value['Resident']['PATLNAME'] .',';    
      $str .= $value['Resident']['PATFNAME'] .',';     
      $str .= $value['SectionA']['A2300'] .',';     
      $str .= $value['SectionC']['C0100'] .',';     
      $str .= $value['SectionD']['D0100'] .',';     
      $str .= $value['SectionJ']['J0200'];
      $info[] = $str;
      
    }
    
    $this->Excel->generate($info);
  }
  
  private function __setData($facility_id = null,$date_start = null, $date_end = null) {
    
    // get models
    $this->Assessment = ClassRegistry::init('Assessment');
    $this->Facility = ClassRegistry::init('Facility');
    $this->Resident = ClassRegistry::init('Resident');
    
    // get facilities
    $facilities = $this->Facility->getNiceList($this->Auth->user('facility_id'));
    
    $conditions = array();
      
    if (!empty($facility_id)) $conditions['Assessment.facility_id']  = $facility_id;
    if (!empty($date_start))  $conditions['Assessment.lock_date >='] = $date_start;
    if (!empty($date_end))    $conditions['Assessment.lock_date <='] = $date_end;

    $conditions['Assessment.resident !='] = '';
    
    $conditions['or']['SectionC.C0100'] = array('0');
    $conditions['or']['SectionD.D0100'] = array('0');
    $conditions['or']['SectionJ.J0200'] = array('0');
    
    if (!empty($this->params['url']['start']))
      $conditions['Assessment.lock_date >='] = $this->params['url']['start']['year'] .'-'. $this->params['url']['start']['month'] .'-'. $this->params['url']['start']['day'];
    
    if (!empty($this->params['url']['end']))
      $conditions['Assessment.lock_date <='] = $this->params['url']['end']['year'] .'-'. $this->params['url']['end']['month'] .'-'. $this->params['url']['end']['day'];
    
    if (!empty($facility_id)) {
        $data = ClassRegistry::init('Assessment')->find('all', array(
          'conditions' => $conditions,
          'order' => array('Resident.PATLNAME' => 'ASC'),
          'group' => 'Assessment.id',
          'recursive' => 0,
          'limit' => 250
        ));
    }
    
    $this->set(compact('data', 'facilities'));
    
    if (isset($data) && empty($data))
      return $data;
    else
      return null;  
  }
}
?>
