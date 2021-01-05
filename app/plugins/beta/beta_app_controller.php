<?php

class BetaAppController extends AppController {
  
  public function beforeFilter() {
    parent::beforeFilter();
  }
  
  public function beforeRender() {
    parent::beforeRender();
  }
  
  public function getUsersList ($facility_id = null) {
    
    if ($facility_id == null)
      $facility_id = parent::setSafeFacilityList();
    
    $data = ClassRegistry::init('User')->find('list',  array(
      'conditions' => array('User.facility_id' => $facility_id),
      'fields' => array('User.id', 'User.name')
    ));
    asort($data);
    foreach ($data as $key => $value) {
      $data[$key] =  ucwords(strtolower($value));
    }
    return $data;
  }
  
}