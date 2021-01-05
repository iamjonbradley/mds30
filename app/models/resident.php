<?php

class Resident extends AppModel {
  
  public $name = 'Resident';

  public $actsAs = array('Containable');
  
  public $belongsTo = array(
    'Facility' => array(
      'className' => 'Facility', 
      'foriegnKey' => 'facility_id', 
      'fields' => array('Facility.id', 'Facility.name')
    )
  );
  
  public $hasOne = array(
    'ResidentDrug'
  );

  public $hasMany = array(
    // 'Assessment' => array('className' => 'Assessment', 'foriegnKey' => false, 'conditions' => 'Resident.id = Assessment.resident')
    'RugCache' => array(
      'order' => array('RugCache.id DESC')
    )
  );

  public function beforeSave($opt){ 
    parent::beforeSave($opt); 
    if(isset($opt['id']) && !isset($this->data[$this->name]['id'])) { 
      $this->data[$this->name]['id'] = $opt['id']; 
    } 
    return true; 
  } 
  
  public function getActiveResidentList($facility_id = null, $type = null) {
    
    $conditions = array(
      'Resident.PATNUM IS NOT NULL',
      'Resident.id LIKE' => "%". $facility_id ."-%",
      'Resident.facility_id' => $facility_id, 
      'Resident.apartment' => 0,
      'Resident.READM' => array('', 'A')
    );
    
    if (!empty($type)) {
      $conditions['Resident.ATYPEOPAY'] = $type;
    }
    
    $conditions['Resident.APT'] = 0;
    
    $this->unbindModel(array('hasMany' => array('Assessment')));
    $data = $this->find('all', array(
      'conditions' => $conditions,
      'fields' => array(
        'Resident.id', 'Resident.ADATE', 'Resident.ATOPDTE', 'Resident.PATLNAME', 'Resident.PATFNAME',
        'Facility.name', 'Resident.PATNUM', 'Resident.ROOM', 'Resident.PMI'
      ),
      'order' => array(
        'Resident.PATLNAME' => 'ASC',
        'Resident.PATFNAME' => 'ASC',
        'Resident.PMI' => 'ASC'
      ),
      'recursive' => 1
    ));

    return $data;
  }
  
  public function getActiveMedicareResidentList($facility_id = null) {
    $this->unbindModel(array('hasMany' => array('Assessment')));
    return $this->find('all', array(
      'conditions' => array(
        'Resident.facility_id' => $facility_id, 
        'Resident.READM' => '',
        'Resident.ATYPEOPAY' => 'MEDICARE A',
		'Resident.APT' => 0
      ),
      'fields' => array('Resident.id', 'Resident.ATOPDTE', 'Resident.PATLNAME', 'Resident.PATFNAME', 'Resident.ADATE', 'Facility.NAME'),
      'recursive' => 0
    ));
  }
  
  public function getName($id) {
    $this->unbindModel(array('hasMany' => array('Assessment')));
    $resident = $this->find('first', array(
      'conditions' => array('Resident.id' => $id),
      'fields' => array('Resident.PATLNAME', 'Resident.PATFNAME'),
      'limit' => 1,
      'recrusive' => -1
    ));
    
    $name = ucwords(strtolower($resident['Resident']['PATLNAME'])) .', '. ucwords(strtolower($resident['Resident']['PATFNAME']));
    return $name;
  }
  
  public function getResident($resident) {
    $this->unbindModel(array('hasMany' => array('Assessment')));
  	$data = $this->find('first', array(
      'conditions' => array(
        'Resident.id' => $resident,
      ),
      'fields' => array(
      	'Resident.ATYPEOPAY', 'Resident.ATYPEOPAY2', 'Resident.READM', 'Resident.ATYPEOPAY3', 'Resident.ATYPEOPAY4', 
      	'Resident.ATOPDTE', 'Resident.ATOPDTE2', 'Resident.ATOPDTE3', 'Resident.ATOPDTE4', 'Resident.BDATE',
        'Resident.PATLNAME', 'Resident.PATFNAME', 'Resident.ADATE', 'Resident.MEDICARE', 'Resident.MEDICAID', 
        'Resident.facility_id', 'Resident.id', 'Resident.PMI', 'Resident.SSNUM',
        'Facility.FNAME', 'Facility.CCN', 'Facility.NPI', 'Facility.STATE_PROVIDER_NUM',
      ),
      'limit' => 1,
      'recrusive' => 0
    ));

    return $data;
  }
}
