<?php

class Clock extends AppModel {
  
  var $name = 'Clock';
  var $useTable = false;
  
  var $belongsTo = array(
    'Resident' => array(
      'className' => 'Resident',
      'foreignKey' => 'resident_id',
      'fields' => array('Resident.PATNUM', 'Resident.PATFNAME', 'Resident.PATLNAME')
    ),
    'Facility' => array(
      'className' => 'Facility',
      'foreignKey' => '',
      'conditions' => 'Resident.facility_id = Facility.id',
      'fields' => array('Facility.id', 'Facility.name')
    )
  );
  
  function getRecent($facility_id) {
    return $this->find('all', array(
      'conditions' => array(
        'or' => array('Clock.ard_start <= "'.date('Y-m-d') .'" AND Clock.ard_grace >= "'. date('Y-m-d') .'"'),
        'and' => array('Resident.facility_id' => $this->Resident->Facility->getFacilities($facility_id))
      ),
      'fields' => array(
        'Facility.id', 'Facility.name', 
        'Resident.PATNUM', 'Resident.PATFNAME', 'Resident.PATLNAME', 
        'Clock.type', 'Clock.ard_start', 'Clock.ard_end', 'Clock.ard_grace', 'Clock.coverage_start', 'Clock.coverage_end', 'Clock.coverage_days'
      ),
      'recursive' => 0,
      'limit' => 25,
      'order' => array('Clock.ard_grace' => 'ASC')
    ));
  }
}