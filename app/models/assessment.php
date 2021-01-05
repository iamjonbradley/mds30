<?php

class Assessment extends AppModel {
  
  public $name = 'Assessment';
  
  public $actsAs = array(
    'Task', 'Containable'
  ); 
  
  public $belongsTo = array(
    'Resident'  => array('className' => 'Resident', 'foreignKey' => false, 'conditions' => 'Resident.id = Assessment.resident'), 
    'Facility'  => array('className' => 'Facility'),
    'User'      => array('className' => 'User')
  );
  
  public $hasOne = array(
    'RugCache' => array('dependent' => true),
    'SectionA' => array('dependent' => true),
    'SectionB' => array('dependent' => true),
    'SectionC' => array('dependent' => true),
    'SectionD' => array('dependent' => true),
    'SectionE' => array('dependent' => true),
    'SectionF' => array('dependent' => true),
    'SectionG' => array('dependent' => true),
    'SectionH' => array('dependent' => true),
    'SectionI' => array('dependent' => true),
    'SectionJ' => array('dependent' => true),  
    'SectionK' => array('dependent' => true),
    'SectionL' => array('dependent' => true),
    'SectionM' => array('dependent' => true),
    'SectionN' => array('dependent' => true),
    'SectionO' => array('dependent' => true),
    'SectionP' => array('dependent' => true),
    'SectionQ' => array('dependent' => true),
    'SectionS' => array('dependent' => true),
    'SectionV' => array('dependent' => true),
    'SectionX' => array('dependent' => true),
    'SectionZ' => array('dependent' => true),
  ); 

  public function getShortStay ($facility_id = null) {
    if (!$facility_id)
      return null;

    $data = $this->find('all', array(
        'conditions' => array(
          'SectionA.A2300 >=' => '2011-10-01',
          'SectionA.A2300 <=' => '2012-03-12',
          'or' => array(
            'SectionA.A0310A' => array('01','02','03','04','05','06'),
            'SectionA.A0310B' => array('01','02','03','04','05','06'),
            'SectionA.A0310F' => array('10','11'),
          ),
          'Assessment.facility_id' => $facility_id,
          'Assessment.deleted' => 0,
          'Assessment.transmission_status' => 2
        ),
        'fields' => array('Assessment.id')
      ));

    return $data;

  }
  
  public function checkOpen ($resident) {
    $this->unbindModel(array(
      'belongsTo' => array('Resident')  
    ));
    $data = $this->find('count', array(
      'conditions' => array('Assessment.resident' => $resident, 'Assessment.locked' => 0, 'Assessment.deleted' => 0),
      'recursive' => -1  
    ));
    
    return $data;
  }
  
  public function getList($id) {
    return $this->find('list', array(
      'conditions' => array('Assessment.facility_id' => $id, 'Assessment.transmission_status >' => 0, 'Assessment.deleted' => 0),
      'fields' => array('Assessment.id'), 
      'recursive' => -1
    ));
  }
  
  public function getRecent ($facility_id = null) {
    
    return $this->find('all', array(
      'conditions' => array('Facility.id' => $this->Facility->getFacilities($facility_id), 'Assessment.deleted' => 0, 'Facility.status' => 1),
      'fields' => array(
        'Assessment.id', 'Assessment.created', 'Assessment.modified', 'Assessment.ADL', 'Assessment.ISC', 'Assessment.THERAPY_MINUTES', 'Assessment.locked', 'Assessment.transmission_status', 'Assessment.type', 
        'Resident.id', 'Resident.PATLNAME', 'Resident.PATFNAME', 
        'SectionA.A1600', 'SectionA.A2300', 'SectionA.A0900', 
        'Facility.name', 
        'User.name', 
      ),
      'order' => array('Assessment.created' => 'DESC'),
      'recursive' => 0,
      'limit' => 10
    ));
  }
  
  public function getPrevious ($id, $resident) {
    return $this->find('all', array(
      'conditions' => array(
        'Assessment.id !=' => $id,
        'Assessment.resident' => $resident, 
        'Assessment.deleted' => 0,
        'Assessment.locked' => 1
      ),
      'fields' => array(
        'Assessment.id', 'Assessment.type', 'Assessment.created', 'Assessment.lock_date',
        'Resident.id', 'SectionA.A0900',
        'SectionA.A1600', 'SectionA.A2300', 'SectionA.A0310A', 'SectionA.A0310B', 'SectionA.A0310C', 'SectionA.A0310D', 'SectionA.A0310E', 'SectionA.A0310F', 
        'SectionC.C0500', 
        'SectionD.D0300', 
        'SectionD.D0600', 
        'SectionV.V0100A', 'SectionV.V0100B', 'SectionV.V0100C', 'SectionV.V0100D', 'SectionV.V0100E', 'SectionV.V0100F', 
        'SectionZ.Z0100B', 
      ),
      'order' => array('Assessment.id' => 'DESC'),
      'recursive' => 0,
      'limit' => 3
    ));
  }
  public function getPreviousOBRAPPS ($id, $resident) {
    $data = $this->find('first', array(
      'conditions' => array(
        'Assessment.id <' => $id,
        'Assessment.resident' => $resident, 
        'Assessment.deleted' => 0,
        'Assessment.locked' => 1,
        'or' => array(
          'SectionA.A0310A' => array('01','02','03'),
          'SectionA.A0310B' => array('01','02','03','04','05','06')
        )
      ),
      'fields' => array(
        'Assessment.id', 'Assessment.type', 'Assessment.created', 'Assessment.lock_date',
        'Resident.id', 'SectionA.A0900',
        'SectionA.A1600', 'SectionA.A2300', 'SectionA.A0310A', 'SectionA.A0310B', 'SectionA.A0310C', 'SectionA.A0310D', 'SectionA.A0310E', 'SectionA.A0310F', 
        'SectionC.C0500', 
        'SectionD.D0300', 
        'SectionD.D0600', 
        'SectionV.V0100A', 'SectionV.V0100B', 'SectionV.V0100C', 'SectionV.V0100D', 'SectionV.V0100E', 'SectionV.V0100F', 
        'SectionZ.Z0100B', 
      ),
      'order' => array('Assessment.id' => 'DESC'),
    ));

    return $data;
  }
  
  public function getPreviousLocked ($resident) {
    
    $data = $this->find('first', array(
      'conditions' => array(
        'and' => array('Assessment.resident' => $resident),
        'or' => array(
          'SectionA.A0310B' => array('01','02','03','04','05','06')
        ) 
      ),
      'fields' => array(
        'Assessment.id', 'Assessment.type', 'Assessment.created', 'Assessment.lock_date',
        'Resident.id', 'Resident.ADATE', 'Resident.PATLNAME', 'Resident.PATFNAME', 'Resident.READM', 'Resident.RDATE', 
        'Assessment.ATYPEOPAY', 'Assessment.ATYPEOPAY2', 'Assessment.ATYPEOPAY3', 'Assessment.ATYPEOPAY4', 
        'Assessment.ATOPDTE', 'Assessment.ATOPDTE2', 'Assessment.ATOPDTE3', 'Assessment.ATOPDTE4', 
        'Resident.PARTSA', 'Resident.PARTSB',
        'SectionA.id', 'SectionA.A0310A', 'SectionA.A0310B', 'SectionA.A0310C', 'SectionA.A0310D', 'SectionA.A0310E', 'SectionA.A0310F', 
        'SectionA.A1600', 'SectionA.A2400A', 'SectionA.A2400B', 'SectionA.A2400C', 'SectionA.A0900'
      ),
      'order' => array('Assessment.created' => 'DESC'),
      'limit' => 1,
    ));
    
    return $data;
  }
  
  public function getAssessments ($facility_id = null) {
    
    if ($facility_id != null)
      $conditions['Assessment.facility_id'] = $facility_id;
    
    $conditions['Assessment.deleted'] = 0;
    $conditions['Assessment.locked'] = 1;
    $conditions['Assessment.transmission_status'] = 2;
    $conditions['Assessment.type !='] = 'NT';
    $conditions['Assessment.resident !='] = '';
    $conditions['SectionA.A2400B NOT'] = array('', '--', '--------', '^--');
    $conditions['or']['SectionA.A0310B'] = array('01','02','03','04','05','06');
    // $conditions['or']['SectionA.A0310C'] = array('1','2','3');
    
    //if (!empty($this->params['url']['start']))
      $conditions['Assessment.lock_date >='] = '2010-01-01';
    
    // if (!empty($this->params['url']['end']))
      // $conditions['Assessment.lock_date <='] = $this->params['url']['end']['year'] .'-'. $this->params['url']['end']['month'] .'-'. $this->params['url']['end']['day'];
    
    
    $data = $this->find('all', array(
      'conditions' => $conditions,
      'fields' => array(
        'Assessment.id', 'Assessment.type', 'Assessment.created', 'Assessment.lock_date', 'Assessment.resident', 
        'Resident.id', 'Resident.ADATE', 'Resident.PATLNAME', 'Resident.PATFNAME', 'Resident.READM', 'Resident.RDATE', 
        'Resident.ATYPEOPAY', 'Resident.ATYPEOPAY2', 'Resident.ATYPEOPAY3', 'Resident.ATYPEOPAY4', 
        'Resident.ATOPDTE', 'Resident.ATOPDTE2', 'Resident.ATOPDTE3', 'Resident.ATOPDTE4', 
        'Assessment.ATYPEOPAY', 'Assessment.ATYPEOPAY2', 'Assessment.ATYPEOPAY3', 'Assessment.ATYPEOPAY4', 
        'Assessment.ATOPDTE', 'Assessment.ATOPDTE2', 'Assessment.ATOPDTE3', 'Assessment.ATOPDTE4', 
        'Resident.PARTSA', 'Resident.PARTSB',
        'SectionA.A0310A', 'SectionA.A0310B', 'SectionA.A0310C', 'SectionA.A0310D', 'SectionA.A0310E', 'SectionA.A0310F', 
        'SectionA.A1600', 'SectionA.A2400A', 'SectionA.A2400B', 'SectionA.A2400C', 'SectionA.A2300', 'SectionA.A0900'
      ),
      'order' => array('Assessment.created' => 'DESC'),
    ));
    
    return $data;
  }
  
  public function getResidentLast($resident) {
    $data = $this->find('first', array(
      'conditions' => array(
        'Assessment.resident' => $resident, 
        'Assessment.deleted' => 0,
        'Assessment.locked' => 1,
        'Assessment.transmission_status' => 2,
      ),
      'fields' => array(
        'Facility.NAME',
        'Assessment.id', 'Assessment.type', 'Assessment.created', 'Assessment.lock_date',
        'Resident.id', 'Resident.PATLNAME', 'Resident.PATFNAME', 'Resident.READM', 'Resident.facility_id',
        'Facility.name',
        'SectionA.A2300', 'SectionA.A1600', 'SectionA.A0900', 
        'SectionA.A0310A', 'SectionA.A0310B', 'SectionA.A0310C', 'SectionA.A0310D', 'SectionA.A0310E', 'SectionA.A0310F', 
        'SectionA.A1600', 'SectionA.A2400A', 'SectionA.A2400B', 'SectionA.A2400C', 'SectionA.A2300', 'SectionA.A0900'
      ),
      'order' => array('Assessment.created' => 'DESC'),
    ));

    
    return $data;
  }
  
  public function getResidentLastOBRA($resident) {
    $data = $this->find('first', array(
      'conditions' => array(
        'Assessment.resident' => $resident, 
        'SectionA.A0310A' => array('01', '02', '03'),
        'Assessment.locked' => 1,
      ),
      'fields' => array(
        'Facility.NAME',
        'Assessment.id', 'Assessment.type', 'Assessment.created', 'Assessment.lock_date', 'Assessment.locked',
        'Resident.id', 'Resident.PATLNAME', 'Resident.PATFNAME', 'Resident.READM', 
        'SectionA.A0310A', 'SectionA.A0310B', 'SectionA.A0310C', 'SectionA.A0310D', 'SectionA.A0310E', 'SectionA.A0310F', 
        'SectionA.A1600', 'SectionA.A2400A', 'SectionA.A2400B', 'SectionA.A2400C', 'SectionA.A2300', 'SectionA.A0900'
      ),
      'order' => array('Assessment.id' => 'DESC'),
    ));
    
    return $data;
  }

  public function getSignificatChangeOBRA ($resident) {
    $data = $this->find('first', array(
      'conditions' => array(
        'Assessment.resident' => $resident, 
        'Assessment.deleted' => 0,
        'Assessment.locked' => 1,
        'SectionA.A0310A' => '04'
      ),
      'fields' => array('SectionA.assessment_id', 'SectionA.A2300', 'SectionA.A0900', 'SectionA.A1600'),
      'order' => array('Assessment.created' => 'DESC'),
    ));
    
    return $data;
  }
  
  public function getResidentLastPPS($resident) {
    $data = $this->find('first', array(
      'conditions' => array(
        'Assessment.resident' => $resident, 
        'Assessment.deleted' => 0,
        'Assessment.locked' => 1,
        'SectionX.X0100' => 1,
        'SectionA.A0310B' => array('01','02','03','04','05','06')
      ),
      'fields' => array(
        'Assessment.id', 'Assessment.type', 'Assessment.created', 'Assessment.lock_date',
        'Resident.id', 'Resident.PATLNAME', 'Resident.PATFNAME', 'Resident.READM', 'Resident.ATOPDTE', 'Resident.ATYPEOPAY',
        'SectionA.A0310A', 'SectionA.A0310B', 'SectionA.A0310C', 'SectionA.A0310D', 'SectionA.A0310E', 'SectionA.A0310F', 
        'SectionA.A1600', 'SectionA.A2400A', 'SectionA.A2400B', 'SectionA.A2400C', 'SectionA.A2300', 'SectionA.A0900'
      ),
      'order' => array('Assessment.id' => 'DESC'),
    ));

    return $data;
  }
  
  public function getOBRA ($resident) {
    return $this->find('first', array(
      'conditions' => array(
        'Assessment.resident' => $resident, 
        'Assessment.deleted' => 0,
        'Assessment.locked' => 1,
        'Assessment.transmission_status' => 2,
        'SectionA.A0310A' => array('01','02','03')
      ),
      'fields' => array('SectionA.A0310A', 'SectionA.A2300', 'SectionA.A0310F', 'Facility.NAME', 'SectionA.A0900', 'SectionA.A1600'),
      'order' => array('Assessment.created' => 'DESC'),
    ));
  }
  
  public function getAssessment ($id) {
    return $this->find('first', array(
      'conditions' => array('Assessment.id' => $id),
      'recursive' => 0
    ));
  }

  public function checkClosedPPS($resident, $type, $start, $end) {

    $type = (string) trim($type);

    list($day,$bleh) = explode(' ', $type);
    
    switch ($day) {
      case '5':   $conditions['SectionA.A0310B'] = array('01', '06'); break;
      case '14':  $conditions['SectionA.A0310B'] = '02'; break;
      case '30':  $conditions['SectionA.A0310B'] = '03'; break;
      case '60':  $conditions['SectionA.A0310B'] = '04'; break;
      case '90':  $conditions['SectionA.A0310B'] = '05'; break;
    }

    $y = substr($start, 0, 4);
    $m = substr($start, 4, 2);
    $d = substr($start, 6, 2);

    $conditions['Assessment.resident']  = $resident;
    $conditions['SectionA.A2300 >='] = $start;
    $conditions['SectionA.A2300 <='] = $end;

    $this->unBindModel(array(
      'belongsTo' => array('Resident','Facility','User'),
      'hasOne' => array(
          'SectionB', 'SectionC', 'SectionD', 'SectionE', 'SectionF',
          'SectionG', 'SectionH', 'SectionI', 'SectionJ', 'SectionK',
          'SectionL', 'SectionM', 'SectionN', 'SectionO', 'SectionP',
          'SectionQ', 'SectionS', 'SectionV', 'SectionX', 'SectionZ'
      )
    ));

    $count['working'] = $this->find('count', array(
      'conditions' => $conditions,
    ));

    $conditions['Assessment.locked'] = 1;
     
    $count['closed'] = $this->find('count', array(
      'conditions' => $conditions,
    ));

    return $count;
  }

  public function checkClosedOBRA($resident, $type, $date_s, $date_e = null) {
    
    $conditions['Assessment.resident']    = $resident;
    $conditions['SectionA.A2300 BETWEEN ? AND ?']      = array($date_s, $date_e);
    $conditions['or']['SectionX.X0100'] = array('SectionA.A0050' => 1, 'SectionX.X0100' => 1);
    $conditions['SectionA.A0310A']  = array('01', '02', '03', '04');

    $this->unBindModel(array(
      'belongsTo' => array('Resident','Facility','User'),
      'hasOne' => array(
          'SectionB', 'SectionC', 'SectionD', 'SectionE', 'SectionF',
          'SectionG', 'SectionH', 'SectionI', 'SectionJ', 'SectionK',
          'SectionL', 'SectionM', 'SectionN', 'SectionO', 'SectionP',
          'SectionQ', 'SectionS', 'SectionV', 'SectionZ'
      )
    ));

    $count['working'] = $this->find('count', array(
      'conditions' => $conditions,
    ));

    $conditions['Assessment.locked'] = 1;
     
    $count['closed'] = $this->find('count', array(
      'conditions' => $conditions,
    ));

    return $count;
  }
	
	public function assessmentDueDate($resident, $type) {
    
		$add = 0;
		
    switch (strtolower($type)) {
      case '5 day':   $conditions['SectionA.A0310B'] = '01'; $add = 5; break;
      case '14 day':  $conditions['SectionA.A0310B'] = '02'; $add = 14; break;
      case '30 day':  $conditions['SectionA.A0310B'] = '03'; $add = 30; break;
      case '60 day':  $conditions['SectionA.A0310B'] = '04'; $add = 60; break;
      case '90 day':  $conditions['SectionA.A0310B'] = '05'; $add = 90; break;
    }
    
    $conditions['Assessment.resident'] = $resident;
		$conditions['SectionA.A2300'] = null;
    
    $results = $this->find('first', array(
      'conditions' => $conditions,
			'fields' => array('SectionA.A1600'),
    ));
		
		$date = null;
		if(!empty($results)) {
			
			$date = $this->__date($results['SectionA']['A1600'], $add);
			
			$e_y = substr($date, 0, 4);
      $e_m = substr($date, 4, 2);
      $e_d = substr($date, 6, 2);
      $e = $e_y .'-'. $e_m .'-'. $e_d;
			
			$date = $e;
		}

		return $date;		   
  }
	
	protected function __date($date, $add) {
    list($year, $month, $day ) = explode('-', $date);
    return date("Ymd", mktime(0, 0, 0, $month, $day + $add, $year));
  }
	
	public function getCountResidentOBRA($resident) {
		$count = $this->find('count', array(
      'conditions' => array(
        'Assessment.resident' => $resident, 
        'SectionA.A0310A' => array('01', '02', '03')
      ),
      
    ));
				
		return $count;
	}
  
  protected function __create_date($date, $add) {
    list($year, $month, $day) = explode('-', $date);
    return date("Y-m-d", mktime(0, 0, 0, $month, $day + $add, $year));
  }

  protected function __addDate($date, $add) {
    list($year, $month, $day) = explode('-', $date);
    return date("Y-m-d", mktime(0, 0, 0, $month, $day + $add, $year));
  }

  protected function __removeDate($date, $add) {
    list($year, $month, $day) = explode('-', $date);
    return date("Y-m-d", mktime(0, 0, 0, $month, $day - $add, $year));
  }

}