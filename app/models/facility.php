<?php

// app/models/facility.php
App::import('Component', 'Session');
class Facility extends AppModel {
  
  public $name = 'Facility';
  public $displayField = 'name';
  public $actsAs = array('Tree');
  
  public $belongsTo = array('Parent' => array('className' => 'Facility', 'foreignKey' => 'parent_id'));
  public $hasMany = array('Assessment', 'ModulePermission', 'RugRate');

  public function getInfo ($facility) {
    return $this->find('first', array('conditions' => array('Facility.id' => $facility), 'recursive' => -1));
  }
  
  public function countFacilities ($facility_id = null) {
    
    $children = $this->getFacilities($facility_id);
    
    // remove uneeded children
    unset($children[0]);
    unset($children[20]);
    unset($children[21]);
    
    $data = $this->find('list', array(
      'conditions' => array('Facility.id' => $children, 'Facility.status' => 1)
    ));
    
    $i = 0;
    foreach ($data as $key => $value) {
      $count[$i]['id']    = $key;
      $count[$i]['name']  = $value;
      $count[$i]['count'] = $this->Resident->find('count', array('conditions' => array('Resident.facility_id' => $key)));
      $i++;
    }
    return $count;
  }
  
  public function getFacilityName($id) {
    
    $this->unbindModel(array(
    'belongsTo' => array('Parent'),
    'hasOne' => array('MedicalRecordPath'),
    'hasMany' => array('Resident', 'Assessment')
    ));
    
    $facility = $this->find('first', array(
      'conditions' => array('Facility.id' => $id),
      'fields' => array('Facility.FNAME'),
      'recursive' => -1
    ));
    return $facility['Facility']['FNAME'];
  }
  
  public function getState($id) {
    
    $this->unbindModel(array(
    'belongsTo' => array('Parent'),
    'hasOne' => array('MedicalRecordPath'),
    'hasMany' => array('Resident', 'Assessment')
    ));
    
    $facility = $this->find('first', array(
      'conditions' => array('Facility.id' => $id),
      'fields' => array('Facility.F_STATE'),
      'recursive' => -1
    ));
    return $facility['Facility']['F_STATE'];
  }
  
  public function getFacilities ($facility_id = null) {
    $this->Session = new SessionComponent();

    if (empty($facility_id))
      return $this->getSafeTreeList($facility_id);
    else
      return $this->getSafeTreeList($this->Session->read('Auth.Facility.id'));
  }
  
  public function getList ($facility = null) {
    
    $this->unbindModel(array(
      'belongsTo' => array('Parent'),
      'hasOne' => array('MedicalRecordPath'),
      'hasMany' => array('Resident', 'Assessment')
    ));
    
    
    if ($facility == 1) {
      $data = $this->generatetreelist(null, null, null, '');
      foreach ($data as $key => $value) {
        $facilities[$key] = ucwords(strtolower($value));
      }
    }
      
    if ($facility != 1) {
      $children = $this->children($facility, true, array('Facility.id', 'Facility.name'));
      foreach ($children as $key => $value) {
        $facilities[$value['Facility']['id']] = ucwords(strtolower($value['Facility']['name']));
      }
      
      if (empty($children)) {
        $facilities = $this->find('list', array(
          'conditions' => array('Facility.id' => $facility, 'Facility.status' => 1),
          'fields' => array('Facility.id', 'Facility.name'),
          'recursive' => -1
        )); 
      }
    }
    
    return $facilities;
  }
  
  public function getSafeList ($facility_id = null) {
    
    $conditions['Facility.status'] = 1;
    
    if ($facility_id == 1 || $facility_id == 35 || $facility_id == 36)
      $conditions['Facility.id NOT'] = array(1, 35, 36);
    else 
      $conditions['Facility.id'] = $facility_id;
    
    return $this->find('list', array(
      'conditions' => $conditions,
      'fields' => array('Facility.id', 'Facility.name'),
      'order' => array('Facility.name'),
      'recursive' => -1
    ));
    
  }
  
  public function getNiceList ($facility_id = null) {
    return $this->getFacilities($facility_id);
  }
  
  public function getAllowedList ($facility_id = null) {
    
    $this->unbindModel(array(
      'belongsTo' => array('Parent'),
      'hasOne' => array('MedicalRecordPath'),
      'hasMany' => array('Resident', 'Assessment')
    ));
    
    
    $children = $this->getFacilities($facility_id);
    
    if (count($children) == 0) $children[0] = $facility_id;
    
    if ($facility_id == 35 || $facility_id == 36 || $facility_id == 1) {
      $children[] = $facility_id;
    }
    
    $data = $this->find('list', array(
      'conditions' => array('Facility.id' => $children, 'Facility.status' => 1),
      'fields' => array('Facility.id', 'Facility.name'),
      'order' => array('Facility.parent_id' => 'ASC', 'Facility.name' => 'ASC'),
      'recursive' => -1
    ));
    
    foreach ($data as $key => $value) {
      $facilities[$key] = ucwords(strtolower($value));
    }
    
    return $facilities;
  }
  
  public function getAssessmentCounts () {
    
    $this->Session = new SessionComponent();
    $children = $this->getFacilities($this->Session->read('Auth.Facility.id'));
    
    // set default conditions
    $conditions['Assessment.deleted'] = 0;

    $count = array();
    
    $i = 0;
    foreach ($children as $key => $value) {
      
      // get type of facility
      $fac = $this->find('first', array(
        'conditions' => array('Facility.id' => $key, 'Facility.status' => 1),
        'fields' => array('Facility.id', 'Facility.name', 'Facility.rec_type'),
        'recursive' => -1
      ));

      if ($fac['Facility']['rec_type'] == 0 ) {
        
        $conditions['Assessment.facility_id'] = $fac['Facility']['id'];
    
        $count[$i]['name']  = $fac['Facility']['name'];
        
        $conditions['Assessment.transmission_status'] = 0;
        $count[$i]['pending']   = $this->Assessment->find('count', array('conditions' => $conditions, 'recursive' => -1));
        
        $conditions['Assessment.transmission_status'] = 1;
        $count[$i]['submitted'] = $this->Assessment->find('count', array('conditions' => $conditions, 'recursive' => -1));
        
        $conditions['Assessment.transmission_status'] = 2;
        $count[$i]['accepted']  = $this->Assessment->find('count', array('conditions' => $conditions, 'recursive' => -1));
        
        $conditions['Assessment.transmission_status'] = 3;
        $count[$i]['rejected']  = $this->Assessment->find('count', array('conditions' => $conditions, 'recursive' => -1));
        
        $i++;
      }
      
    }
    
    return $count;
  }
  
}