<?php

class ClockComponent extends Object {
  
  public $helpers = array('Html');
  
  public function ubs($assessment) {
    
    $start_date = '';
    if (!empty($assessment['SectionA']['A2400B']) && $assessment['SectionA']['A2400B'] != '--' && $assessment['SectionA']['A2400B'] != '^--') {
    	list($year,$month,$day) = explode('-', $assessment['SectionA']['A2400B']);
	    $start_date = $month .'/'. $day .'/'. $year; 
    }
    
    $clock = $this->dates($start_date);

    return $clock;
  }

  public function checkLate($id) {
    
    $this->Assessment = ClassRegistry::init('Assessment');
    
    $assessment = $this->Assessment->find('first', array(
      'conditions' => array('Assessment.id' => $id)
    )); 

    $start_date = '';
    if (!empty($assessment['SectionA']['A2400B']) && $assessment['SectionA']['A2400B'] != '--' && $assessment['SectionA']['A2400B'] != '^--') {
    	list($year,$month,$day) = explode('-', $assessment['SectionA']['A2400B']);
    	$start_date = $month .'/'. $day .'/'. $year; 
    }

    $clock = $this->dates($start_date);

    $b = '';
    if ($assessment['SectionA']['A0310B'] == '01') $b = '5';
    if ($assessment['SectionA']['A0310B'] == '02') $b = '14';
    if ($assessment['SectionA']['A0310B'] == '03') $b = '30';
    if ($assessment['SectionA']['A0310B'] == '04') $b = '60';
    if ($assessment['SectionA']['A0310B'] == '05') $b = '90';

    if (empty($b))
      return false;
      
    if (empty($assessment['SectionA']['A2300']))
      return false;

    if (strlen($assessment['SectionA']['A2300']) == 8) {
      $sm = substr($assessment['SectionA']['A2300'], 0, 2);
      $sd = substr($assessment['SectionA']['A2300'], 2, 2);
      $sy = substr($assessment['SectionA']['A2300'], 4, 4);
    }
    else {
      list($sy, $sm, $sd) = explode('-', $assessment['SectionA']['A2300']);
    }
    $new_start = $sy . $sm . $sd;

    // new ard start date
    
    list($asm, $asd, $asy) = explode('/', $clock[$b]['ard']['s']);
    $new_ard_start = $asy . $asm . $asd;

    // new ard end date
    list($esm, $esd, $esy) = explode('/', $clock[$b]['ard']['g']);
    $new_ard_end = $esy . $esm . $esd;

    if ($b == '')
      return false;

    if ($assessment['SectionX']['X0100'] != '1')
      return false;

    if ($new_start < $new_ard_start)
      return false;

    if (($new_start >= $new_ard_start) && ($new_start <= $new_ard_end))
      return false;
    else
      return true;

    return false;
    
  }
  
  public function render($resident, $id = null) {
    
    $this->Assessment = ClassRegistry::init('Assessment');
    
    $assessment = $this->Assessment->find('first', array(
      'conditions' => array('Assessment.id' => $id)
    )); 
    
    if ($id == null) {
      $assessment = $this->Assessment->getResidentLastPPS($resident);
    }

    
    $start_date = '';
    if (!empty($assessment['SectionA']['A2400B']) && $assessment['SectionA']['A2400B'] != '--' && $assessment['SectionA']['A2400B'] != '^--') {
      
      if (strlen($assessment['SectionA']['A2400B']) == 8) {
        $month  = substr($assessment['SectionA']['A2400B'], 0, 2);
        $day    = substr($assessment['SectionA']['A2400B'], 2, 2);
        $year   = substr($assessment['SectionA']['A2400B'], 4, 4);
      }
      else {
        list($year,$month,$day) = explode('-', $assessment['SectionA']['A2400B']);
      }
	    
	    $start_date = $month .'/'. $day .'/'. $year; 
    }
    else {
      $details = $this->Assessment->Resident->find('first', array(
          'conditions' => array('Resident.id' => $resident, 'Resident.ATYPEOPAY' => 'MEDICARE A'),
          'fields' => array('Resident.ATOPDTE'),
          'recursive' => -1
      ));

      if (!empty($details)) {
        list ($year, $month, $day) = explode('-', $details['Resident']['ATOPDTE']);
        $start_date = $month .'/'. $day .'/'. $year; 
      }
    }

    $clock = $this->dates($start_date, $resident);
        
    
    return $clock;
  }
  
  public function check ($id = null) {
    
    $data = ClassRegistry::init('Assessment')->getPreviousLocked($id);
    
    $resident = ucwords(strtolower($data['Resident']['PATLNAME'])) .', '. ucwords(strtolower($data['Resident']['PATFNAME']));

    if (!empty($data['SectionA']['A2400B'])) {
      
      $start_date = $data['SectionA']['A1600'];
      list($year,$month,$day) = explode('-', $start_date);
      $start_date = $month .'/'. $day .'/'. $year;
      
    $data['SectionA']['A2400B'] = str_replace('/', '-', $data['SectionA']['A2400B']);
    if (strlen($data['SectionA']['A2400B']) == 8) {
      $month  = substr($data['SectionA']['A2400B'], 0, 2);
      $day    = substr($data['SectionA']['A2400B'], 2, 2);
      $year   = substr($data['SectionA']['A2400B'], 4, 4);
    }
    else {
      list($year,$month,$day) = explode('-', $data['SectionA']['A2400B']);
    }
	  $edate = $month .'/'. $day .'/'. $year; 
      
	  if ($edate == '//') return $resident;
	  
      $final_grace_day = $this->__create_date($edate, 91);
      
      if ($this->__days($final_grace_day, $start_date) > 0) $clock = true;
      else $clock = false;
      
      if ($clock == true) {
        $this->Html = new HtmlHelper();
        $resident = $this->Html->link($resident, array('plugin' => 'reports', 'controller' => 'clock', 'action' => 'view', $id), array('rel' => 'facebox'));
      }
        
      return $resident;
    }
    
    return ClassRegistry::init('Resident')->getName($id);
  }

  public function dates ($start_date, $resident = null) {

    $new_date = $this->__create_date($start_date, 100);

    // check midnight rule
    $this->MidnightRule = ClassRegistry::init('MidnightRule');

    $rule = $this->MidnightRule->find('first', array(
        'MidnightRule.date BETWEEN ? AND ?' => array($start_date, $new_date),
        'MidnightRule.resident_id' => $resident
      ));

    if (!empty($rule)) {
      list($y,$m,$d) = explode('-', $rule['MidnightRule']['date']);
      $reset_date = $m .'/'. $d .'/'. $y;
    }
    else {
      $reset_date = '';
    }

    $start_date = $this->compareMidnightRule($start_date, $reset_date, '5', $resident);

    //  5 day
    $clock[5]['asmt']  = "5 Day";
    $clock[5]['ard']['s'] = $this->__create_date($start_date, 0);
    $clock[5]['ard']['e'] = $this->__create_date($start_date, 5);
    $clock[5]['ard']['g'] = $this->__create_date($start_date, 7);
    $clock[5]['cvr']['s'] = $this->__create_date($start_date, 0);
    $clock[5]['cvr']['e'] = $this->__create_date($start_date, 13);
    $clock[5]['cvr']['d'] = $this->__days($this->__create_date($start_date, 14), $this->__create_date($start_date, 0));

    $start_date = $this->compareMidnightRule($start_date, $reset_date, '14', $resident);

    //  14 day
    $clock[14]['asmt']  = "14 Day";
    $clock[14]['ard']['s'] = $this->__create_date($start_date, 12);
    $clock[14]['ard']['e'] = $this->__create_date($start_date, 14);
    $clock[14]['ard']['g'] = $this->__create_date($start_date, 17);
    $clock[14]['cvr']['s'] = $this->__create_date($start_date, 14);
    $clock[14]['cvr']['e'] = $this->__create_date($start_date, 30);
    $clock[14]['cvr']['d'] = $this->__days($this->__create_date($start_date, 30), $this->__create_date($start_date, 14));

    $start_date = $this->compareMidnightRule($start_date, $reset_date, '30', $resident);
    
    //  30 day
    $clock[30]['asmt']  = "30 Day";
    $clock[30]['ard']['s'] = $this->__create_date($start_date, 26);
    $clock[30]['ard']['e'] = $this->__create_date($start_date, 29);
    $clock[30]['ard']['g'] = $this->__create_date($start_date, 32);
    $clock[30]['cvr']['s'] = $this->__create_date($start_date, 30);
    $clock[30]['cvr']['e'] = $this->__create_date($start_date, 59);
    $clock[30]['cvr']['d'] = $this->__days($this->__create_date($start_date, 60), $this->__create_date($start_date, 30));

    $start_date = $this->compareMidnightRule($start_date, $reset_date, '60', $resident);

    //  60 day
    $clock[60]['asmt']  = "60 Day";
    $clock[60]['ard']['s'] = $this->__create_date($start_date, 56);
    $clock[60]['ard']['e'] = $this->__create_date($start_date, 59);
    $clock[60]['ard']['g'] = $this->__create_date($start_date, 62);
    $clock[60]['cvr']['s'] = $this->__create_date($start_date, 60);
    $clock[60]['cvr']['e'] = $this->__create_date($start_date, 89);
    $clock[60]['cvr']['d'] = $this->__days($this->__create_date($start_date, 90), $this->__create_date($start_date, 60));

    $start_date = $this->compareMidnightRule($start_date, $reset_date, '90', $resident);

    //  90 day
    $clock[90]['asmt']  = "90 Day";
    $clock[90]['ard']['s'] = $this->__create_date($start_date, 86);
    $clock[90]['ard']['e'] = $this->__create_date($start_date, 89);
    $clock[90]['ard']['g'] = $this->__create_date($start_date, 92);
    $clock[90]['cvr']['s'] = $this->__create_date($start_date, 90);
    $clock[90]['cvr']['e'] = $this->__create_date($start_date, 99);
    $clock[90]['cvr']['d'] = $this->__days($this->__create_date($start_date, 100), $this->__create_date($start_date, 90));

    return $clock;
  }

  private function compareMidnightRule($start_date, $reset_date = null, $type = null, $resident = null) {

    // check empty
    if (empty($reset_date)) return $start_date;
    if (empty($type))       return $start_date;
    if (empty($resident))   return $start_date;

    switch ($type) {
      case 5:
        $s = $this->__create_date($start_date,   0);
        $e = $this->__create_date($start_date,  13);
        break;
      case 14:
        $s = $this->__create_date($start_date,  15);
        $e = $this->__create_date($start_date,  30);
        break;
      case 30:
        $s = $this->__create_date($start_date,  31);
        $e = $this->__create_date($start_date,  60);
        break;
      case 60:
        $s = $this->__create_date($start_date,  61);
        $e = $this->__create_date($start_date,  90);
        break;
      case 90:
        $s = $this->__create_date($start_date,  91);
        $e = $this->__create_date($start_date, 100);
        break;
    }

    // set start date
    if (preg_match('[-]', $s)) {
      list($sy, $sm, $sd) = explode('-', $s);
      $s = $sy . $sm . $sd;
    }  
    if (preg_match('[/]', $s)) {
      list($sm, $sd, $sy) = explode('/', $s);
      $s = $sy . $sm . $sd;
    }
    
    // set end date
    if (preg_match('[-]', $e)) {
      list($ey, $em, $ed) = explode('-', $e);
      $e = $ey . $em . $ed;
    }  
    if (preg_match('[/]', $e)) {
      list($em, $ed, $ey) = explode('/', $e);
      $e = $ey . $em . $ed;
    }
    
    // set reset date
    if (preg_match('[-]', $reset_date)) {
      list($ry, $rm, $rd) = explode('-', $reset_date);
      $r = $ry . $rm . $rd;
    }  
    if (preg_match('[/]', $reset_date)) {
      list($rm, $rd, $ry) = explode('/', $reset_date);
      $r = $ry . $rm . $rd;
    }

    // check for reset of 5 day
    if ($s >= $r && $e <= $r)
      $start_date = $this->__create_date($start_date, 1);

    return $start_date;

  }
  
  private function __days( $a = null, $b = null, $add = null) {
    
    if ($a == null || $b == null) return 0;

    if (!empty($sub))
      $sub = 1;
    else
      $sub = 0;

    list($gd_a['m'], $gd_a['d'], $gd_a['y']) = @explode('/', $a);
    list($gd_b['m'], $gd_b['d'], $gd_b['y']) = @explode('/', $b);
    
    $a_new = mktime( 12, 0, 0, $gd_a['m'], $gd_a['d'], $gd_a['y'] );
    $b_new = mktime( 12, 0, 0, $gd_b['m'], $gd_b['d'], $gd_b['y'] );

    $days = round( abs( $a_new - $b_new ) / 86400 );

    $days = $days + $add;

    return $days;
  }
  
  protected function __create_date($date, $add) {

    if (empty($date))
      return null;

    if (preg_match('[-]', $date)) list($y, $m, $d) = explode('-', $date);
    if (preg_match('[/]', $date)) list($m, $d, $y) = explode('/', $date);

    return date("m/d/Y", mktime(0, 0, 0, $m, $d + $add, $y));
    
  }

}
