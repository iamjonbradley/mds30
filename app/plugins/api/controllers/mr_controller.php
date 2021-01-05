<?php

class MrController extends ApiAppController {
  
  public $uses = array('RugCache');
  
  public $components = array('Auth', 'Calc', 'Reports.Clock', 'Reports.Tickler');

  public function beforeFilter () { parent::beforeFilter(); }

  public function fetch ($token, $function, $facility_id, $resident_id = null) {

    switch ($function) {
      case 'resident':
        $result = self::resident ($facility_id, $resident_id);
        break;
      case 'facility':
        $result = self::facility ($facility_id);
        break;
      case 'search':
        $result = self::search ($facility_id);
        break;
    }

    if (empty($result)) {
      echo null;
    }
    else {
      $data = $this->__setData ($result);
      header('Content-Type: application/json');
      echo json_encode($data);
    }
    
  } 

  public function search ($token, $facility_id) {

    $conditions = array(
      'RugCache.facility_id' => Sanitize::clean($facility_id), 
      'RugCache.deleted' => 0,
      'RugCache.date_accepted !=' => '0000-00-00'
    );

    if (isset($this->params['named']['resident'])) {
      $conditions['Resident.PATNUM'] = $this->params['named']['resident'];
    }

    if (isset($this->params['named']['modified'])) {
      $conditions['RugCache.modified >='] = $this->params['named']['modified'];
    }
    
    return $this->RugCache->find('all', array(
      'conditions' => $conditions,
      'order' => array('RugCache.date_locked' => 'ASC')
    ));
    
  } 

  public function facility ($facility_id) {
    
    return $this->RugCache->find('all', array(
      'conditions' => array(
        'RugCache.facility_id' => Sanitize::clean($facility_id), 
        'RugCache.deleted' => 0,
        'RugCache.date_accepted !=' => '0000-00-00'
      ),
      'order' => array('RugCache.date_locked' => 'ASC')
    ));
    
  } 

  public function resident ($facility_id = null, $resident_id = null) {
    
    return $this->RugCache->find('all', array(
      'conditions' => array(
        'RugCache.PATNUM' => Sanitize::clean($facility_id) .'-'. Sanitize::clean($resident_id),
        'RugCache.facility_id' => Sanitize::clean($facility_id), 
        'RugCache.deleted' => 0,
        'RugCache.date_accepted !=' => '0000-00-00'
      ),
      'order' => array('RugCache.date_locked' => 'ASC')
    ));
    
  } 

     
  private function __setData ($data) {

    foreach ($data as $key => $value) {

      $return[$key]['assessment_id'] = $value['RugCache']['assessment_id'];
      $return[$key]['resident'] = $value['Resident']['id'];
      $return[$key]['lock_date'] = $value['RugCache']['date_locked'];
      $return[$key]['ard'] = $value['RugCache']['date_ard'];

      $return[$key]['from'] = $value['RugCache']['cvr_from'];
      $return[$key]['to']   = $value['RugCache']['cvr_end'];
      $return[$key]['days'] = $value['RugCache']['cvr_days'];

      $return[$key]['PARTA'] = $value['RugCache']['date_parta'];
      $return[$key]['ENTRY'] = $value['RugCache']['date_entry'];
      
      $return[$key]['T_RUG'] = $value['RugCache']['rug_therapy'];
      $return[$key]['N_RUG'] = $value['RugCache']['rug_nursing'];
      $return[$key]['modifier'] = $value['RugCache']['rug_hipps'];

      $return[$key]['status'] = $value['RugCache']['date_parta'];
      
    }

    return $return;
    
  }
  
  private function __modifyDate($date, $add) {
    list($y, $m, $d) = explode('-', $date);
    return date("m/d/Y", mktime(0, 0, 0, $m, $d + $add, $y));
  }
  
  private function __modifyDateSub($date, $add) {
    list($y, $m, $d) = explode('-', $date);
    return date("m/d/Y", mktime(0, 0, 0, $m, $d - $add, $y));
  }
  
  private function __countDays( $a = null, $b = null) {
  
    if ($a == null || $b == null) return 0;
  
    list($gd_a['m'], $gd_a['d'], $gd_a['y']) = @explode('/', $a);
    list($gd_b['m'], $gd_b['d'], $gd_b['y']) = @explode('/', $b);
    
    $a_new = mktime( 12, 0, 0, $gd_a['m'], $gd_a['d'], $gd_a['y'] );
    $b_new = mktime( 12, 0, 0, $gd_b['m'], $gd_b['d'], $gd_b['y'] );
    
    $days = round( abs( $a_new - $b_new ) / 86400 );
    return $days + 1;
  }
  
}