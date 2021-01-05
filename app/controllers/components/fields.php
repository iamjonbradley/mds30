<?php

class FieldsComponent extends Object {
  
  public $name = 'Fields';
  
  public function clean($data) {
    $fields = ClassRegistry::init('ReportType')->find('list', array(
      'conditions' => array('ReportType.'. $data['Assessment']['type'] => 'x'),
      'fields' => array('ReportType.itm_id', 'ReportType.itm_section')
    ));
    
    foreach ($fields as $key => $value) {
      $field[] = $value .'.'. $key;
    }
    
    $allowed = implode(',', $field);
    
    $allowed .= ',Assessment.resident';
    $allowed .= ',Assessment.type';
    $allowed .= ',Assessment.id';
    $allowed .= ',Assessment.lock_date';
    $allowed .= ',Facility.FAC_ID';
    $allowed .= ',Facility.F_STATE';
    
    $ass = ClassRegistry::init('Assessment')->find('first', array(
      'conditions' => array('Assessment.id' => $data['Assessment']['id']),
      'fields' => array($allowed)
    ));
    
    $ass['SectionA']['age'] = self::__getAge(trim($ass['SectionA']['A0900']));
    
    if (isset($ass['SectionO']))
      $ass['SectionO']['day_diff'] = self::__count_days($ass['SectionA']['A2300'], $ass['SectionA']['A1600']); 
        
    return $ass;
  }  
  
  private function __getAge($date = null) {
    if (empty($date)) return $age;

    list($y, $m, $d) = explode('-', $date);
    $y_diff = date("Y") - $y;
    if (date('m') >= $m && date('d') >= $d) $age = $y_diff - 1;
    else $age = $y_diff;
    return $age;
  }
  
  private function __count_days ( $a = null, $b = null) {
    
    if ($a == null || $b == null) return 0;
    
    if (strlen($a) == 8) {
      $gd_a['year'] = substr($a, 0, 4);
      $gd_a['mon']  = substr($a, 4, 2);
      $gd_a['mday'] = substr($a, 6, 2);
    }
    else {
      list($gd_a['year'], $gd_a['mon'], $gd_a['mday']) = explode('-', $a);
    }
    
    if (strlen($b) == 8) {
      $gd_b['year'] = substr($b, 0, 4);
      $gd_b['mon']  = substr($b, 4, 2);
      $gd_b['mday'] = substr($b, 6, 2);
    }
    else {
      list($gd_b['year'], $gd_b['mon'], $gd_b['mday']) = explode('-', $b);
    }
    
    $a_new = @mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
    $b_new = @mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );

    $days = round( abs( $a_new - $b_new ) / 86400 );
    return $days;
  }
  
  
}
