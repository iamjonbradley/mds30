<?php

class NotifyShell extends Shell {

  public $uses = array('Notifications.Notification');
  public $tasks = array('Locked');

  static $messages = array(
    'not_accepted' => 'The Assessment # %d for resident %s needs to be accepted by CMS by %s or it will be late',
    'late' => 'The Assessment numbered %d for resident %s is %s days late to CMS'
  );

  public function main () {
    $this->Locked->execute();
  }

  public function store ($facility_id, $resident_id, $user_id, $assessment_id, $message) {
    ClassRegistry::init('Notifications.Notification')->saveNotification ($facility_id, $resident_id, $user_id, $assessment_id, $message); 
  }
  
  public function modifyDateAdd($date, $add) {
    list($y, $m, $d) = explode('-', $date);
    return date("Y-m-d", mktime(0, 0, 0, $m, $d + $add, $y));
  }
  
  public function countDays( $a, $b ) {
  
    if ($a == null || $b == null) return 0;
  
    list($gd_a['y'], $gd_a['m'], $gd_a['d']) = explode('-', $a);
    list($gd_b['y'], $gd_b['m'], $gd_b['d']) = explode('-', $b);
    
    $a_new = mktime( 12, 0, 0, $gd_a['m'], $gd_a['d'], $gd_a['y'] );
    $b_new = mktime( 12, 0, 0, $gd_b['m'], $gd_b['d'], $gd_b['y'] );
    
    $days = round( abs( $a_new - $b_new ) / 86400 );
    return $days;
  }

}