<?php 

App::import('Component', array('Skip', 'Reports.Clock', 'Report'));
class CalcComponent extends Object {

  public $components = array('Reports.Clock', 'Report');

  public function __construct() {
    App::import('Component', 'Report');
    $this->Report = new ReportComponent();
  }

  public function initialize(&$controller) {
  }

  public function startup(&$controller) {
  }
  
  public function calc ($asmt) {

    App::import('Component', 'Report');
    $this->Report = new ReportComponent();
    $data = $this->Report->structureData($asmt['Assessment']['id'], $asmt['Assessment']['STATE_CD']);

    $this->sot            = $this->calcSOT($data);
    $calc['min']          = $this->calcTherapy($data);
    $calc['adl']          = $this->calcAdl($data);
    $calc['skin']         = $this->skin_treatments($data);
    $calc['depressed']    = $this->depressed($data);
    $calc['restorative']  = $this->restorative($data);
    $calc['t_rug']        = $this->calcRugTherapy($data);
    $calc['n_rug']        = $this->calcRugNonTherapy($data);
    $calc['hipps']        = $this->calcModifier($data);
    $calc['isc']          = $this->calcIsc($data);
    
    return $calc;
  }
  
  public function calcRugTherapy ($asmt) {

    $asmtData = $this->Report->structureData($asmt['Assessment']['id'], $asmt['Assessment']['STATE_CD']);
    $data = $asmtData;
    
    $this->adl      = $this->calcAdl($data);
    $skin           = $this->skin_treatments($data);
    $depressed      = $this->depressed($data);
    $restorative    = $this->restorative($data);
    $this->sot      = $this->calcSOT($data);
    $this->minutes  = $this->calcTherapy($data);


    if (!empty($this->minutes))
      $minutes = array_sum($this->minutes);
    else
      $minutes = 0;

    if ($this->sot  == 1) {

      $tdate = array();

      if (isset($data['SectionO']['O0400A5']) && !empty($data['SectionO']['O0400A5']))
        $tdate[] = $data['SectionO']['O0400A5'];

      if (isset($data['SectionO']['O0400B5']) && !empty($data['SectionO']['O0400B5']))
        $tdate[] = $data['SectionO']['O0400B5'];

      if (isset($data['SectionO']['O0400C5']) && !empty($data['SectionO']['O0400C5']))
        $tdate[] = $data['SectionO']['O0400C5'];

      sort($tdate);

      $ard = $data['SectionA']['A2300'];

      $first = $tdate[0];

      $days = self::__count_days($ard, $tdate[0]) + 1;
      
      $minutes2  = $minutes / $days;
    }

    // chcek if qualifying for a short stay rug
    $qualify = 0;
    if ($this->sot == 1) {
      if ($minutes >= 15 && $minutes <= 29) $qualify = 1;
      if ($minutes >= 30 && $minutes <= 64) $qualify = 1;
      if ($minutes >= 65 && $minutes <= 99) $qualify = 1;
      if ($minutes >= 100 && $minutes <= 143) $qualify = 1;
      if ($minutes >= 144) $qualify = 1;
    }

    if ($this->sot == 1 && $qualify == 0) {
      $this->sot = 0;
      $minutes = $minutes2;
    }
    
    $category_1 = $this->category_1 ( $data, $minutes, $restorative );     
    if ( $category_1 != false ) return $category_1;
    
    $category_2 = $this->category_2 ( $data, $minutes, $restorative );
    if ( $category_2 != false ) return $category_2;
    
    $category_3 = $this->category_3 ( $data, $minutes, $restorative );
    if ( $category_3 != false ) return $category_3;
    
    $category_4 = $this->category_4 ( $data, $minutes, $depressed );
    if ( $category_4 != false ) return $category_4;
    
    $category_5 = $this->category_5 ( $data, $minutes, $depressed, $skin );
    if ( $category_5 != false ) return $category_5;
    
    $category_6 = $this->category_6 ( $data, $minutes, $depressed );
    if ( $category_6 != false ) return $category_6;
    
    $category_7 = $this->category_7 ( $data, $minutes, $restorative );
    if ( $category_7 != false ) return $category_7;
    
    $category_8 = $this->category_8 ( $data, $minutes, $restorative );
    if ( $category_8 != false ) return $category_8;
    
    return 'AAA';
    
  }
  
  public function calcRugNonTherapy ( $data ) {
    
    $this->minutes  = $this->calcTherapy( $data );
    $this->adl    = $this->calcAdl( $data );
    $skin      = $this->skin_treatments( $data );
    $depressed    = $this->depressed( $data );
    $restorative  = $this->restorative( $data );
    $this->sot     = $this->calcSOT( $data );

    if ($this->sot  == 1) {
      $minutes = array_sum($this->minutes) / 3;
    }
    else{
      if (!empty($this->minutes)) 
        $minutes = array_sum($this->minutes);
      else $minutes = 0;
    }
    
    $category_3 = $this->category_3 ( $data, $minutes, $restorative );
    if ( $category_3 != false ) return $category_3;
    
    $category_4 = $this->category_4 ( $data, $minutes, $depressed );
    if ( $category_4 != false ) return $category_4;
    
    $category_5 = $this->category_5 ( $data, $minutes, $depressed, $skin );
    if ( $category_5 != false ) return $category_5;
    
    $category_6 = $this->category_6 ( $data, $minutes, $depressed );
    if ( $category_6 != false ) return $category_6;
    
    $category_7 = $this->category_7 ( $data, $minutes, $restorative );
    if ( $category_7 != false ) return $category_7;
    
    $category_8 = $this->category_8 ( $data, $minutes, $restorative );
    if ( $category_8 != false ) return $category_8;
    
    return 'AAA';
    
  }
  
  public function calcTherapy( $data ) {
    
    if (!isset($data['SectionO'])) return 0;
    
    $total = $this->calcMinutes($data);    
    $total_minutes = $total;

    if (($exists = is_float($total_minutes)) == true) 
      list($whole_number, $decimal) = explode('.', $total_minutes);
    else 
      $whole_number = $total_minutes;
    
    return $whole_number;
  }

  public function calcMinutes ( $data ) {
    
    if (!isset($data['SectionO'])) return 0;
    
    $total = array();
    $therapy = $data['SectionO'];
    
    if (array_key_exists('O0400A1', $therapy)) $O0400A1 = $therapy['O0400A1']; else $O0400A1 = '';
    if (array_key_exists('O0400A2', $therapy)) $O0400A2 = $therapy['O0400A2']; else $O0400A2 = '';
    if (array_key_exists('O0400A3', $therapy)) $O0400A3 = $therapy['O0400A3']; else $O0400A3 = '';
    
    if (array_key_exists('O0400B1', $therapy)) $O0400B1 = $therapy['O0400B1']; else $O0400B1 = '';
    if (array_key_exists('O0400B2', $therapy)) $O0400B2 = $therapy['O0400B2']; else $O0400B2 = '';
    if (array_key_exists('O0400B3', $therapy)) $O0400B3 = $therapy['O0400B3']; else $O0400B3 = '';
    
    if (array_key_exists('O0400C1', $therapy)) $O0400C1 = $therapy['O0400C1']; else $O0400C1 = '';
    if (array_key_exists('O0400C2', $therapy)) $O0400C2 = $therapy['O0400C2']; else $O0400C2 = '';
    if (array_key_exists('O0400C3', $therapy)) $O0400C3 = $therapy['O0400C3']; else $O0400C3 = '';
    
    // Speech-language Pathology Services
    // check for zero
    if ($O0400A2 == 0 || $O0400A2 == '') $O0400A2_C = 0;
    else $O0400A2_C = $O0400A2/2;
    // get total therapy minutes
    $total[1] = $O0400A1 + $O0400A2_C + $O0400A3;
    // get limitation
    if ($O0400A3 == 0 || $O0400A3 == '') $limitation = 0;
    else $limitation = @(($O0400A3/4)/$total[1]);
    // check if the 25% group limitation applies
    if ($limitation >= .25) {
      $total[1] = @((($O0400A1 + $O0400A2_C) * 4)/3);
    }
    
    // Occupational Therapy
    // check for zero
    if ($O0400B2 == 0 || $O0400B2 == '') $O0400B2_C = 0;
    else $O0400B2_C = $O0400B2/2;
    // get total therapy minutes
    $total[2] = $O0400B1 + $O0400B2_C + $O0400B3;
    // get limitation
    if ($O0400B3 == 0 || $O0400B3 == '') $limitation = 0;
    else $limitation = @(($O0400B3/4)/$total[2]);
    
    // check if the 25% group limitation applies
    if ($limitation >= .25) {
      $total[2] = @((($O0400B1 + $O0400B2_C) * 4)/3);
    }
    
    // Physical Therapy
    // check for zero
    if ($O0400C2 == 0 || $O0400C2 == '') $O0400C2_C = 0;
    else $O0400C2_C = $O0400C2/2;
    // get total therapy minutes
    $total[3] = $O0400C1 + $O0400C2_C + $O0400C3;
    // get limitation
    if ($O0400C3 == 0 || $O0400C3 == '') $limitation = 0;
    else $limitation = @(($O0400C3/4)/$total[3]);
    // check if the 25% group limitation applies
    if ($limitation >= .25) {
      $total[3] = @((($O0400C1 + $O0400C2_C) * 4)/3);
    }
    
    return $total;
  }
  
  public function calcAdl ($data = array()) {
    
    if (!isset($data['SectionG'])) return 0;
    
    if (isset($data['SectionG']['G0110A1'])) $G0110A1 = $data['SectionG']['G0110A1']; else $G0110A1 = '';
    if (isset($data['SectionG']['G0110A2'])) $G0110A2 = $data['SectionG']['G0110A2']; else $G0110A2 = '';
    if (isset($data['SectionG']['G0110B1'])) $G0110B1 = $data['SectionG']['G0110B1']; else $G0110B1 = '';
    if (isset($data['SectionG']['G0110B2'])) $G0110B2 = $data['SectionG']['G0110B2']; else $G0110B2 = '';
    if (isset($data['SectionG']['G0110I1'])) $G0110I1 = $data['SectionG']['G0110I1']; else $G0110I1 = '';
    if (isset($data['SectionG']['G0110I2'])) $G0110I2 = $data['SectionG']['G0110I2']; else $G0110I2 = '';
    if (isset($data['SectionG']['G0110H1'])) $G0110H1 = $data['SectionG']['G0110H1']; else $G0110H1 = '';
    if (isset($data['SectionG']['G0110H2'])) $G0110H2 = $data['SectionG']['G0110H2']; else $G0110H2 = '';
    
    $score = 0;
    
    // Calculate G0110A
    if ($G0110A1 == '-' || $G0110A1 == 0 || $G0110A1 == 1 || $G0110A1 == 7 || $G0110A1 == 8) $score += 0;
    if ($G0110A1 == 2) $score += 1;
    if ($G0110A1 == 3 && ($G0110A2 == '-' || $G0110A2 == 0 || $G0110A2 == 1 || $G0110A2 == 2)) $score += 2;
    if ($G0110A1 == 4 && ($G0110A2 == '-' || $G0110A2 == 0 || $G0110A2 == 1 || $G0110A2 == 2)) $score += 3;
    if (($G0110A1 == 3 || $G0110A1 == 4) && $G0110A2 == 3) $score += 4;
    
    // Calculate G0110B
    if ($G0110B1 == '-' || $G0110B1 == 0 || $G0110B1 == 1 || $G0110B1 == 7 || $G0110B1 == 8) $score += 0;
    if ($G0110B1 == 2) $score += 1;
    if ($G0110B1 == 3 && ($G0110B2 == '-' || $G0110B2 == 0 || $G0110B2 == 1 || $G0110B2 == 2)) $score += 2;
    if ($G0110B1 == 4 && ($G0110B2 == '-' || $G0110B2 == 0 || $G0110B2 == 1 || $G0110B2 == 2)) $score += 3;
    if (($G0110B1 == 3 || $G0110B1 == 4) && $G0110B2 == 3) $score += 4;
    
    // Calculate G0110C
    if ($G0110I1 == '-' || $G0110I1 == 0 || $G0110I1 == 1 || $G0110I1 == 7 || $G0110I1 == 8) $score += 0;
    if ($G0110I1 == 2) $score += 1;
    if ($G0110I1 == 3 && ($G0110I2 == '-' || $G0110I2 == 0 || $G0110I2 == 1 || $G0110I2 == 2)) $score += 2;
    if ($G0110I1 == 4 && ($G0110I2 == '-' || $G0110I2 == 0 || $G0110I2 == 1 || $G0110I2 == 2)) $score += 3;
    if (($G0110I1 == 3 || $G0110I1 == 4) && $G0110I2 == 3) $score += 4;
    
    // Calculate G0110H
    if (
      ($G0110H1 == '-' || $G0110H1 == 0 || $G0110H1 == 1 || $G0110H1 == 2 || $G0110H1 == 7 || $G0110H1 == 8) AND 
      ($G0110H2 == '-' || $G0110H2 == 0 || $G0110H2 == 1 || $G0110H2 == 8)
    ) $score += 0;
    if (
      ($G0110H1 == '-' || $G0110H1 == 0 || $G0110H1 == 1 || $G0110H1 == 2 || $G0110H1 == 7 || $G0110H1 == 8) AND 
      ($G0110H2 == 2 || $G0110H2 == 3)
    ) $score += 2;
    if (
      ($G0110H1 == 3 || $G0110H1 == 4) && 
      ($G0110H2 == '-' || $G0110H2 == 0 || $G0110H2 == 1)
    ) $score += 2;
    if ($G0110H1 == 3 && ($G0110H2 == 2 || $G0110H2 == 3)) $score += 3;
    if ($G0110H1 == 4 && ($G0110H2 == 2 || $G0110H2 == 3)) $score += 4;
    
    return $score;
  }

  public function calcIsc ($data) {
    return ClassRegistry::init('Isc')->get($data);
  }
  
  public function calcModifier($data) {
    
    $this->sot = $this->calcSOT($data);

    if (isset($data['SectionA']) && array_key_exists('A0310A', $data['SectionA'])) 
      $A0310A = $data['SectionA']['A0310A']; 
    else $A0310A = '';
    if (isset($data['SectionA']) && array_key_exists('A0310B', $data['SectionA'])) 
      $A0310B = $data['SectionA']['A0310B']; 
    else $A0310B = '';
    if (isset($data['SectionA']) && array_key_exists('A0310C', $data['SectionA'])) 
      $A0310C = $data['SectionA']['A0310C']; 
    else $A0310C = '';
    if (isset($data['SectionZ']) && array_key_exists('Z0100B', $data['SectionZ'])) 
      $Z0100B = $data['SectionZ']['Z0100B']; 
    else $Z0100B = '';
    if (isset($data['SectionO']) && array_key_exists('O0450A', $data['SectionO'])) 
      $O0450A = $data['SectionO']['O0450A']; 
    else $O0450A = '';

    $rug  = $this->modifier_digit_1($A0310B);
    $rug .= $this->modifier_digit_2($A0310A, $A0310B, $A0310C, $O0450A);
    
    return $rug;
  }
  
  public function calcDepressed ($data) {
    return $this->depressed($data);
  }
  
  public function calcRestorative ($data) {
    return $this->restorative($data);
  }
  
  public function calcSkinTreatments ($data) {
    return $this->skin_treatments($data);
  }
  
  public function calcSOT ($data) {

    // set the days
    $days = array();
    if (!empty($data['SectionO']['O0400A4']) && $data['SectionO']['O0400A4'] != 0) $days[$data['SectionO']['O0400A5']] = $data['SectionO']['O0400A5'];
    if (!empty($data['SectionO']['O0400B4']) && $data['SectionO']['O0400B4'] != 0) $days[$data['SectionO']['O0400B5']] = $data['SectionO']['O0400B5'];
    if (!empty($data['SectionO']['O0400C4']) && $data['SectionO']['O0400C4'] != 0) $days[$data['SectionO']['O0400C5']] = $data['SectionO']['O0400C5'];

    if (!empty($days)) {
      ksort($days);
      $this->minutes = $this->calcMinutes($data);
      $total_days = $this->__count_days(reset($days), $data['SectionA']['A2300']) + 1;
      $this->sotminutes = array_sum($this->minutes) / $total_days;
    }

    $pass = array();

    // condition 1
    if ($data['SectionA']['A0310C'] != 1)
      return false;

    // check for death in facility or a discharge assessment has been done.
    $discharge = ClassRegistry::init('Assessment')->find('count', array(
      'conditions' => array(
        'Assessment.resident' => $data['Assessment']['resident'],
        'Assessment.id >=' => $data['Assessment']['id'],
        'SectionA.A0310F' => array(10,11,12)
      )
    ));
    
    if ($discharge == 0)
      return false;
      
    // echo '[1]';
    
    // condition 2
    if ($data['SectionA']['A0310B'] != '01' && $data['SectionA']['A0310B'] != '06') 
      return false;
      
    // echo '[2]';
    
    // condition 3
    if (self::__ard_minus_parta($data['SectionA']['A2300'], $data['SectionA']['A2400B']) > 8) 
      return false;
      
    // echo '[3]';
    
    // condition 4
    if ($data['SectionA']['A2300'] != $data['SectionA']['A2400C']) 
      return false;
      
    // echo '[4]';
    
    // condition 5
    $date = array();
    if (!empty($data['SectionO']['O0400A5'])) $date[0] = $data['SectionO']['O0400A5'];
    if (!empty($data['SectionO']['O0400B5'])) $date[1] = $data['SectionO']['O0400B5'];
    if (!empty($data['SectionO']['O0400C5'])) $date[2] = $data['SectionO']['O0400C5'];

    asort($date);
    
    if (isset($date[0]) && self::__count_days($data['SectionA']['A2300'], $date[0]) > 5)
      return false;
      
    // echo '[5]';
    
    // condition 6
    $diff = array();
    
    $diff['a'] = self::__ard_minus_parta($data['SectionA']['A2400C'], $data['SectionO']['O0400A5']);
    $diff['b'] = self::__ard_minus_parta($data['SectionA']['A2400C'], $data['SectionO']['O0400B5']);
    $diff['c'] = self::__ard_minus_parta($data['SectionA']['A2400C'], $data['SectionO']['O0400C5']);

    if ($diff['a'] > 3) return false;
    if ($diff['b'] > 3) return false;
    if ($diff['c'] > 3) return false;
      
    // echo '[6]';
    
    // condition 7
    $good = array();
    if (preg_match('|-|', $data['SectionO']['O0400A6'])) $good[] = true;
    if (preg_match('|-|', $data['SectionO']['O0400B6'])) $good[] = true;
    if (preg_match('|-|', $data['SectionO']['O0400C6'])) $good[] = true;

    if (array_sum($good) == 0)
      return false;
      
    // echo '[7]';
      
    // condition 8
    $this->minutes = $this->calcTherapy($data);

    $tdate = array();

    if (isset($data['SectionO']['O0400A5']) && !empty($data['SectionO']['O0400A5']))
      $tdate[] = $data['SectionO']['O0400A5'];

    if (isset($data['SectionO']['O0400B5']) && !empty($data['SectionO']['O0400B5']))
      $tdate[] = $data['SectionO']['O0400B5'];

    if (isset($data['SectionO']['O0400C5']) && !empty($data['SectionO']['O0400C5']))
      $tdate[] = $data['SectionO']['O0400C5'];

    sort($tdate);

    $ard = $data['SectionA']['A2300'];

    $first = $tdate[0];

    $days = self::__count_days($ard, $tdate[0]) + 1;
    
    $minutes  = array_sum($this->minutes) / $days;

    // chcek if qualifying for a short stay rug
    $qualify = 0;
    if ($minutes >= 15 && $minutes < 30) 
      $qualify = 1;
    if ($minutes >= 30 && $minutes < 65) 
      $qualify = 1;
    if ($minutes >= 65 && $minutes < 100)
      $qualify = 1;
    if ($minutes >= 100 && $minutes < 144)
      $qualify = 1;
    if ($minutes >= 144)
      $qualify = 1;

    if ($qualify == 0)
      return false;
    else
      return true;
  }
  
  private function __ard_minus_parta ( $a = null, $b = null) {
    
    if (
      $a == null || $a == '--------' || $a == '__________' || 
      $b == null || $b == '--------' || $b == '__________'
    ) return false;

    if (strlen($a) == 10)
      list($a_year, $a_month, $a_day) = explode('-', $a);
    else {
      $a_month  = substr($a, 0, 2);
      $a_day    = substr($a, 2, 2);
      $a_year   = substr($a, 4, 4);
    }
    
    $b = str_replace('/', '-', $b);
    if (strlen($b) == 10) {
      list($b_year, $b_month, $b_day) = explode('-', $b);
    }
    else {
      $b_month  = substr($b, 0, 2);
      $b_day    = substr($b, 2, 2);
      $b_year   = substr($b, 4, 4);
    }
    
    $a_new = @mktime( 12, 0, 0, $a_month, $a_day, $a_year );
    $b_new = @mktime( 12, 0, 0, $b_month, $b_day, $b_year );

    $days = round( abs( $a_new - $b_new ) / 86400 );
    
    return $days;
  }
  
  private function modifier_digit_1 ($A0310B) {
    switch ($A0310B) {
      case '07': return 0; break;
      case '01': return 1; break; 
      case '06': return 1; break;
      case '02': return 2; break;
      case '03': return 3; break;
      case '04': return 4; break;
      case '05': return 5; break;
      case '99': return 6; break;
    }
  }
  
  private function modifier_digit_2 ($A0310A = null, $A0310B = null, $A0310C = null, $O0450A = null) {

    $second = 0;

    if (self::modifier_digit_1($A0310B) == 6) return 0;
      
    // digit = 0
    if (
      ($A0310B == '01' || $A0310B == '02' || $A0310B == '03' || $A0310B == '04' || $A0310B == '05' || $A0310B == '06' || $A0310B == '99') || 
      (($A0310A == '05' || $A0310A == '06' || $A0310A == '03') && $A0310B)
    ) 
    $second = 0;

    // digit = 1
    if (
      ($A0310A == '04' || $A0310A == '05' || $A0310A == '06') && $A0310C == 0 &&
      $this->sot == false
    ) 
      $second = 1;

    // digit = 2
    if ($A0310C == '1')
      $second = 2;

    // digit = 3
    if ($A0310C == '1' && ($A0310A == '04' || $A0310A == '05' || $A0310A == '06'))  
      $second = 3;

    if ($A0310C == '2')  
      $second = 4;

    if ($A0310B != '07' && $A0310C == '3')    
      $second = 5;

    if ($A0310B == '07' && $A0310C == '3')  
      $second = 6;

    if ($this->sot == '1')  
      $second = 7;

    if ($A0310C == '2' && $O0450A == '1')  
      $second = 'A';

    if ($A0310C == '3' && $O0450A == '1')  
      $second = 'A';

    if ($A0310C == '3' && $O0450A == '1' && $A0310B == '07')  
      $second = 'C';

    if ($A0310C == '4')  
      $second = 'D';

    return $second;
  }
  
  /**
   * Determines Restorative Nursing Count
   * 
   * Count the number of the following services provided 
   * for 15 or more minutes a day for 6 or more of the last 7 days:
   */
  private function restorative($data) {

    $restorative = 0;

    if (isset($data['SectionH']) && isset($data['SectionH']['H0500']) && $data['SectionH']['H0500'] != '') $H0500 = $data['SectionH']['H0500']; else $H0500 = '';
    if (isset($data['SectionH']) && isset($data['SectionH']['H0200C']) && $data['SectionH']['H0200C'] != '') $H0200C = $data['SectionH']['H0200C']; else $H0200C = '';

    if (isset($data['SectionO']) && isset($data['SectionO']['O0500A']) && $data['SectionO']['O0500A'] != '') $O0500A = $data['SectionO']['O0500A']; else $O0500A = '';
    if (isset($data['SectionO']) && isset($data['SectionO']['O0500B']) && $data['SectionO']['O0500B'] != '') $O0500B = $data['SectionO']['O0500B']; else $O0500B = '';
    if (isset($data['SectionO']) && isset($data['SectionO']['O0500C']) && $data['SectionO']['O0500C'] != '') $O0500C = $data['SectionO']['O0500C']; else $O0500C = '';
    if (isset($data['SectionO']) && isset($data['SectionO']['O0500D']) && $data['SectionO']['O0500D'] != '') $O0500D = $data['SectionO']['O0500D']; else $O0500D = '';
    if (isset($data['SectionO']) && isset($data['SectionO']['O0500E']) && $data['SectionO']['O0500E'] != '') $O0500E = $data['SectionO']['O0500E']; else $O0500E = '';
    if (isset($data['SectionO']) && isset($data['SectionO']['O0500F']) && $data['SectionO']['O0500F'] != '') $O0500F = $data['SectionO']['O0500F']; else $O0500F = '';
    if (isset($data['SectionO']) && isset($data['SectionO']['O0500G']) && $data['SectionO']['O0500G'] != '') $O0500G = $data['SectionO']['O0500G']; else $O0500G = '';
    if (isset($data['SectionO']) && isset($data['SectionO']['O0500H']) && $data['SectionO']['O0500H'] != '') $O0500H = $data['SectionO']['O0500H']; else $O0500H = '';
    if (isset($data['SectionO']) && isset($data['SectionO']['O0500I']) && $data['SectionO']['O0500I'] != '') $O0500I = $data['SectionO']['O0500I']; else $O0500I = '';
    if (isset($data['SectionO']) && isset($data['SectionO']['O0500J']) && $data['SectionO']['O0500J'] != '') $O0500J = $data['SectionO']['O0500J']; else $O0500J = '';
    
    // H0200C, H0500** Urinary toileting program and/or bowel toileting program
    if ($H0200C >= 1 || $H0500 == 1) $restorative++;
    
    // O0500A,B** Passive and/or active ROM
    if ($O0500A >= 6 || $O0500B >= 6) $restorative++;
    
    // O0500C Splint or brace assistance
    if ($O0500C >= 6) $restorative++;
     
    // O0500D,F** Bed mobility and/or walking training
    if ($O0500D >= 6 || $O0500F >= 6) $restorative++;

    // O0500E Transfer training
    if ($O0500E >= 6) $restorative += 1;

    // O0500G Dressing and/or grooming training
    if ($O0500G >= 6) $restorative += 1;

    // O0500H Eating and/or swallowing training
    if ($O0500H >= 6) $restorative += 1;

    // O0500I Amputation/prostheses care
    if ($O0500I >= 6) $restorative += 1;

    // O0500J Communication training
    if ($O0500J >= 6) $restorative += 1;

    return $restorative;
  }
  
  private function depressed($data) {
    
    if (!isset($data['SectionD'])) return 0;
    
    if (
      ($data['SectionD']['D0300'] >= 10 && $data['SectionD']['D0300'] != 99) || 
      ($data['SectionD']['D0600'] >= 10)
    ) 
      $depressed = 1;
    else 
      $depressed = 0;
    
    return $depressed;
  }
  
  /**
   * Selected skin treatments
   */
  private function skin_treatments($data) {

    if (isset($data['SectionM']) && isset($data['SectionM']['M1200A']) && $data['SectionM']['M1200A'] != '') $M1200A = $data['SectionM']['M1200A']; else $M1200A = '';
    if (isset($data['SectionM']) && isset($data['SectionM']['M1200B']) && $data['SectionM']['M1200B'] != '') $M1200B = $data['SectionM']['M1200B']; else $M1200B = '';
    if (isset($data['SectionM']) && isset($data['SectionM']['M1200C']) && $data['SectionM']['M1200C'] != '') $M1200C = $data['SectionM']['M1200C']; else $M1200C = '';
    if (isset($data['SectionM']) && isset($data['SectionM']['M1200D']) && $data['SectionM']['M1200D'] != '') $M1200D = $data['SectionM']['M1200D']; else $M1200D = '';
    if (isset($data['SectionM']) && isset($data['SectionM']['M1200E']) && $data['SectionM']['M1200E'] != '') $M1200E = $data['SectionM']['M1200E']; else $M1200E = '';
    if (isset($data['SectionM']) && isset($data['SectionM']['M1200G']) && $data['SectionM']['M1200G'] != '') $M1200G = $data['SectionM']['M1200G']; else $M1200G = '';
    if (isset($data['SectionM']) && isset($data['SectionM']['M1200H']) && $data['SectionM']['M1200H'] != '') $M1200H = $data['SectionM']['M1200H']; else $M1200H = '';
    
    $skin = 0;

    // M1200A,B# Pressure relieving chair and/or bed
    if ($M1200A == 1 || $M1200B == 1) $skin++;
    
    // M1200C Turning/repositioning
    if ($M1200C == 1) $skin++;
    
    // M1200D Nutrition or hydration intervention
    if ($M1200D == 1) $skin++;
    
    // M1200E Ulcer care
    if ($M1200E == 1) $skin++;
    
    // M1200G Application of dressings (not to feet)
    if ($M1200G == 1) $skin++;
    
    // M1200H Application of ointments (not to feet)
    if ($M1200H == 1) $skin++;
    
    return $skin;

  }
  
  private function category_1 ($data, $minutes, $restorative) {

    $this->sot = $this->calcSOT($data);

    if (isset($data['SectionO']) && isset($data['SectionO']['O0400A4']) && $data['SectionO']['O0400A4'] != '') $O0400A4 = $data['SectionO']['O0400A4']; else $O0400A4 = 0;
    if (isset($data['SectionO']) && isset($data['SectionO']['O0400B4']) && $data['SectionO']['O0400B4'] != '') $O0400B4 = $data['SectionO']['O0400B4']; else $O0400B4 = 0;
    if (isset($data['SectionO']) && isset($data['SectionO']['O0400C4']) && $data['SectionO']['O0400C4'] != '') $O0400C4 = $data['SectionO']['O0400C4']; else $O0400C4 = 0;
    if (isset($data['SectionO']) && isset($data['SectionO']['O0100E2']) && $data['SectionO']['O0100E2'] != '') $O0100E2 = $data['SectionO']['O0100E2']; else $O0100E2 = 0;
    if (isset($data['SectionO']) && isset($data['SectionO']['O0100F2']) && $data['SectionO']['O0100F2'] != '') $O0100F2 = $data['SectionO']['O0100F2']; else $O0100F2 = 0;
    if (isset($data['SectionO']) && isset($data['SectionO']['O0100M2']) && $data['SectionO']['O0100M2'] != '') $O0100M2 = $data['SectionO']['O0100M2']; else $O0100M2 = 0;
    if (isset($data['SectionO']) && isset($data['SectionO']['Z0100C']) && $data['SectionO']['Z0100C'] != '') $Z0100C = $data['SectionO']['Z0100C']; else $Z0100C = 0;
    
    
    // Category I - Step 1
    if ($this->adl < 2)
      return false;
      
    // Category I - Step 2
    if ($O0100E2 == 0 && $O0100F2 == 0 && $O0100M2 == 0) 
      return false;
      
    // Category I - Step 3 - Ultra High Intesity Criteria
    if (
      (
        ($minutes >= 720) && 
        ($O0400A4 >= 5 || $O0400B4 >= 5 || $O0400C4 >= 5) && 
        ($O0400A4 >= 3 || $O0400B4 >= 3 || $O0400C4 >= 3)
      ) || 
      (
        ($Z0100C && $this->sot == 1) && 
        ($this->sotminutes >= 144)
      )
    ) {
      switch ($this->adl) {
        case 11: case 12: case 13: case 14: case 15: case 16: 
          return 'RUX'; break;
        case 2: case 3: case 4: case 5: case 6: case 7: case 8: case 9: case 10: 
          return 'RUL'; break;
      }
    }
      
    // Category I - Step 3 - Very High Intesity Criteria
    if (
      (($minutes >= 500) && ($O0400A4 >= 5 || $O0400B4 >= 5 || $O0400C4 >= 5)) || 
      (($Z0100C && $this->sot == 1) && ($this->sotminutes >= 100 && $this->sotminutes <= 143))
    ) {
      switch ($this->adl) {
        case 11: case 12: case 13: case 14: case 15: case 16: 
          return 'RVX'; break;
        case 2: case 3: case 4: case 5: case 6: case 7: case 8: case 9: case 10: 
          return 'RVL'; break;
      }
    }
      
    // Category I - Step 3 - High Intesity Criteria
    if (
      (($minutes >= 325) && ($O0400A4 >= 5 || $O0400B4 >= 5 || $O0400C4 >= 5)) || 
      (($Z0100C && $this->sot == 1) && ($this->sotminutes >= 65 && $this->sotminutes <= 99))
    ) {
      switch ($this->adl) {
        case 11: case 12: case 13: case 14: case 15: case 16: 
          return 'RHX'; break;
        case 2: case 3: case 4: case 5: case 6: case 7: case 8: case 9: case 10: 
          return 'RHL'; break;
      }
    }
      
    // Category I - Step 3 - Medium Intesity Criteria
    if (
      (($minutes >= 150) && (($O0400A4 + $O0400B4 + $O0400C4) >= 5)) || 
      (($Z0100C && $this->sot == 1) && ($this->sotminutes >= 30 && $this->sotminutes <= 64))
    ) {
      switch ($this->adl) {
        case 11: case 12: case 13: case 14: case 15: case 16: 
          return 'RMX'; break;
        case 2: case 3: case 4: case 5: case 6: case 7: case 8: case 9: case 10: 
          return 'RML'; break;
      }
    }
     
    // Category I - Step 3 - Low Intesity Criteria    
    if (
      (
        ($minutes >= 45) && 
        (
          ($O0400A4 + $O0400B4 + $O0400C4) >= 3) && 
          ($restorative >= 2)
        ) || 
      (
        ($Z0100C && $this->sot) == 1) && 
        ($this->sotminutes >= 15 && $this->sotminutes <= 29)
    ) {
      return 'RLX';
    }
    
    return false;
  }
  
  private function category_2 ($data, $minutes, $restorative) {

    $this->sot = $this->calcSOT($data);

    if ($this->sot == false)
      $this->sot = 0;

    if (isset($data['SectionO']) && isset($data['SectionO']['O0400A4']) && $data['SectionO']['O0400A4'] != '') $O0400A4 = $data['SectionO']['O0400A4']; else $O0400A4 = 0;
    if (isset($data['SectionO']) && isset($data['SectionO']['O0400B4']) && $data['SectionO']['O0400B4'] != '') $O0400B4 = $data['SectionO']['O0400B4']; else $O0400B4 = 0;
    if (isset($data['SectionO']) && isset($data['SectionO']['O0400C4']) && $data['SectionO']['O0400C4'] != '') $O0400C4 = $data['SectionO']['O0400C4']; else $O0400C4 = 0;
    
    
    // Category II - Step 1 - Ultra High Intesity Criteria
    
    // set first discipline
    if ($O0400A4 >= 5) $disc['a']['first'] = 1; else $disc['a']['first'] = 0;
    if ($O0400B4 >= 5) $disc['b']['first'] = 1; else $disc['b']['first'] = 0;
    if ($O0400C4 >= 5) $disc['c']['first'] = 1; else $disc['c']['first'] = 0;
    
    // set second discipline
    if ($O0400A4 >= 3) $disc['a']['second'] = 1; else $disc['a']['second'] = 0;
    if ($O0400B4 >= 3) $disc['b']['second'] = 1; else $disc['b']['second'] = 0;
    if ($O0400C4 >= 3) $disc['c']['second'] = 1; else $disc['c']['second'] = 0;
    
    // check if disiplines are good
    $discipline = 0;
    if ($disc['a']['first'] == 1 && ($disc['b']['second'] == 1 || $disc['c']['second'] == 1)) $discipline = 1;
    if ($disc['b']['first'] == 1 && ($disc['a']['second'] == 1 || $disc['c']['second'] == 1)) $discipline = 1;
    if ($disc['c']['first'] == 1 && ($disc['a']['second'] == 1 || $disc['b']['second'] == 1)) $discipline = 1;

    if (
      ($minutes >= 720 &&  $discipline == 1) || 
      ($this->sot == 1 && $this->sotminutes >= 144)
    ) {

      switch ($this->adl) {
        case 11: case 12: case 13: case 14: case 15: case 16: 
          return 'RUC'; break;
        case 6: case 7: case 8: case 9: case 10: 
          return 'RUB'; break;
        case 0: case 1: case 2: case 3: case 4: case 5:
          return 'RUA'; break;
      }
    }
    
    
    // Category II - Step 1 - Very High Intesity Criteria
    if (
      (($minutes >= 500) && ($O0400A4 >= 5 || $O0400B4 >= 5 || $O0400C4 >= 5)) || 
      ($this->sot == 1 && ($this->sotminutes >= 100 && $this->sotminutes <= 143))
    ) {
      switch ($this->adl) {
        case 11: case 12: case 13: case 14: case 15: case 16: 
          return 'RVC'; break;
        case 6: case 7: case 8: case 9: case 10: 
          return 'RVB'; break;
        case 0: case 1: case 2: case 3: case 4: case 5:
          return 'RVA'; break;
      }
    }
    // Category II - Step 1 - High Intesity Criteria
    if (
      ($minutes >= 325 && ($O0400A4 >= 5 || $O0400B4 >= 5 || $O0400C4 >= 5)) || 
      ($this->sot == 1 && $this->sotminutes >= 65 && $this->sotminutes < 100)
    ) {
      switch ($this->adl) {
        case 11: case 12: case 13: case 14: case 15: case 16: 
          return 'RHC'; break;
        case 6: case 7: case 8: case 9: case 10: 
          return 'RHB'; break;
        case 0: case 1: case 2: case 3: case 4: case 5:
          return 'RHA'; break;
      }
    }
  
    // Category II - Step 1 - Medium Intesity Criteria
    if (
      (($minutes >= 150) && (($O0400A4 + $O0400B4 + $O0400C4) >= 5)) || 
      ($this->sot == 1 && ($this->sotminutes >= 30 && $this->sotminutes < 65))
    ) {


      switch ($this->adl) {
        case 11: case 12: case 13: case 14: case 15: case 16: 
          return 'RMC'; break;
        case 6: case 7: case 8: case 9: case 10: 
          return 'RMB'; break;
        case 0: case 1: case 2: case 3: case 4: case 5:
          return 'RMA'; break;
      }

    }
      
    // Category I - Step 3 - Low Intesity Criteria    
    $t_days = 0;
    if (isset($data['SectionO']['O0400A4']) && $data['SectionO']['O0400A4']) $t_days = $data['SectionO']['O0400A4'];
    if (isset($data['SectionO']['O0400B4']) && $data['SectionO']['O0400B4']) $t_days = $t_days + $data['SectionO']['O0400B4'];
    if (isset($data['SectionO']['O0400C4']) && $data['SectionO']['O0400C4']) $t_days = $t_days + $data['SectionO']['O0400C4'];
        
    if (
      ($minutes >= 45 && $t_days >= 3 && $restorative >= 2) || 
      ($this->sot == 1 && $this->sotminutes >= 15 && $this->sotminutes <= 29)
    ) {
      switch ($this->adl) {
        case 11: case 12: case 13: case 14: case 15: case 16: 
          return 'RLB'; break;
        case 0: case 1: case 2: case 3: case 4: case 5: case 6: case 7: case 8: case 9: case 10: 
          return 'RLA'; break;
      }
    }
    
    return false;
  }
  
  private function category_3 ($data, $minutes, $restorative)  {
    
    if (!isset($data['SectionO'])) return false;
    
    // Category III - Step 1
    if (
      (array_key_exists('O0100E2', $data['SectionO']) && $data['SectionO']['O0100E2'] == 0) && 
      (array_key_exists('O0100F2', $data['SectionO']) && $data['SectionO']['O0100F2'] == 0) && 
      (array_key_exists('O0100M2', $data['SectionO']) && $data['SectionO']['O0100M2'] == 0)
    ) 
      return false;
    
    // Category III - Step 2
    if ( $this->adl < 2 )
      return false;
    
    // Category III - Step 3
    if ((isset($data['SectionO']['O0100E2']) && $data['SectionO']['O0100E2'] == 1) && (isset($data['SectionO']['O0100F2']) && $data['SectionO']['O0100F2'] == 1)) return 'ES3';
    if ((isset($data['SectionO']['O0100E2']) && $data['SectionO']['O0100E2'] == 1) || (isset($data['SectionO']['O0100F2']) && $data['SectionO']['O0100F2'] == 1)) return 'ES2';
    if ((isset($data['SectionO']['O0100M2']) && $data['SectionO']['O0100M2'] == 1) && (isset($data['SectionO']['O0100E2']) && $data['SectionO']['O0100E2'] == 0) && (isset($data['SectionO']['O0100F2']) && $data['SectionO']['O0100F2'] == 0)) return 'ES1';
    
    return false;
  }
  
  private function category_4 ($data, $minutes, $depressed)  {
    
    if (isset($data['SectionB']) && isset($data['SectionB']['B0100']) && $data['SectionB']['B0100'] != '') $B0100 = $data['SectionB']['B0100']; else $B0100 = '';

    if (isset($data['SectionG']) && isset($data['SectionG']['G0110A1']) && $data['SectionG']['G0110A1'] != '') $G0110A1 = $data['SectionG']['G0110A1']; else $G0110A1 = '';
    if (isset($data['SectionG']) && isset($data['SectionG']['G0110B1']) && $data['SectionG']['G0110B1'] != '') $G0110B1 = $data['SectionG']['G0110B1']; else $G0110B1 = '';
    if (isset($data['SectionG']) && isset($data['SectionG']['G0110H1']) && $data['SectionG']['G0110H1'] != '') $G0110H1 = $data['SectionG']['G0110H1']; else $G0110H1 = '';
    if (isset($data['SectionG']) && isset($data['SectionG']['G0110I1']) && $data['SectionG']['G0110I1'] != '') $G0110I1 = $data['SectionG']['G0110I1']; else $G0110I1 = '';
    
    if (isset($data['SectionI']) && isset($data['SectionI']['I2100']) && $data['SectionI']['I2100'] != '') $I2100 = $data['SectionI']['I2100']; else $I2100 = '';
    if (isset($data['SectionI']) && isset($data['SectionI']['I2900']) && $data['SectionI']['I2900'] != '') $I2900 = $data['SectionI']['I2900']; else $I2900 = '';
    if (isset($data['SectionI']) && isset($data['SectionI']['I5100']) && $data['SectionI']['I5100'] != '') $I5100 = $data['SectionI']['I5100']; else $I5100 = '';
    if (isset($data['SectionI']) && isset($data['SectionI']['I6200']) && $data['SectionI']['I6200'] != '') $I6200 = $data['SectionI']['I6200']; else $I6200 = '';
    if (isset($data['SectionI']) && isset($data['SectionI']['I2000']) && $data['SectionI']['I2000'] != '') $I2000 = $data['SectionI']['I2000']; else $I2000 = '';

    if (isset($data['SectionJ']) && isset($data['SectionJ']['J1100C']) && $data['SectionJ']['J1100C'] != '') $J1100C = $data['SectionJ']['J1100C']; else $J1100C = '';
    if (isset($data['SectionJ']) && isset($data['SectionJ']['J1550A']) && $data['SectionJ']['J1550A'] != '') $J1550A = $data['SectionJ']['J1550A']; else $J1550A = '';
    if (isset($data['SectionJ']) && isset($data['SectionJ']['J1550B']) && $data['SectionJ']['J1550B'] != '') $J1550B = $data['SectionJ']['J1550B']; else $J1550B = '';

    if (isset($data['SectionK']) && isset($data['SectionK']['K0300']) && $data['SectionK']['K0300'] != '') $K0300 = $data['SectionK']['K0300']; else $K0300 = '';
    if (isset($data['SectionK']) && isset($data['SectionK']['K0500A']) && $data['SectionK']['K0500A'] != '') $K0500A = $data['SectionK']['K0500A']; else $K0500A = '';
    if (isset($data['SectionK']) && isset($data['SectionK']['K0510A2']) && $data['SectionK']['K0510A2'] != '') $K0510A2 = $data['SectionK']['K0510A2']; else $K0510A2 = '';
    if (isset($data['SectionK']) && isset($data['SectionK']['K0700A']) && $data['SectionK']['K0700A'] != '') $K0700A = $data['SectionK']['K0700A']; else $K0700A = '';
    if (isset($data['SectionK']) && isset($data['SectionK']['K0700B']) && $data['SectionK']['K0700B'] != '') $K0700B = $data['SectionK']['K0700B']; else $K0700B = '';
    if (isset($data['SectionK']) && isset($data['SectionK']['J1550B']) && $data['SectionK']['J1550B'] != '') $J1550B = $data['SectionK']['J1550B']; else $J1550B = '';
    if (isset($data['SectionK']) && isset($data['SectionK']['J1550B']) && $data['SectionK']['J1550B'] != '') $J1550B = $data['SectionK']['J1550B']; else $J1550B = '';

    if (isset($data['SectionN']) && isset($data['SectionN']['N0350A']) && $data['SectionN']['N0350A'] != '') $N0350A = $data['SectionN']['N0350A']; else $N0350A = '';
    if (isset($data['SectionN']) && isset($data['SectionN']['N0350B']) && $data['SectionN']['N0350B'] != '') $N0350B = $data['SectionN']['N0350B']; else $N0350B = '';

    if (isset($data['SectionO']) && isset($data['SectionO']['O0400D2']) && $data['SectionO']['O0400D2'] != '') $O0400D2 = $data['SectionO']['O0400D2']; else $O0400D2 = '';

    // Category IV - Step 1
    $coded = 0;
    if (
      $B0100 == 1 &&
      (
        ($G0110A1 == 4 && $G0110B1 == 4 && $G0110H1 == 4 && $G0110I1 == 4) ||  
        ($G0110A1 == 8 && $G0110B1 == 8 && $G0110H1 == 8 && $G0110I1 == 8)
      )
    )
      $coded += 1;
    
    if ($I2100 == 1) $coded += 1;
    
    if (
      $I2900== 1 && 
      ($N0350A == 7 && $N0350B >= 2)
    ) $coded += 1;
    
    if ($I5100 == 1 && $this->adl >= 5) $coded += 1;
    if ($K0500A == 1) $coded += 1;
    if ($K0510A2 == 1) $coded += 1;
    if ($O0400D2 == 7) $coded += 1;
    if ($I6200 == 1 && $J1100C== 1) $coded += 1;
    if (
      ($J1550A == 1 && $I2000 == 1) || 
      ($J1550A == 1 && $J1550B == 1) || 
      ($J1550A == 1 && ($K0300 == 1 || $K0300 == 2)) || 
      ($J1550A == 1 && ($K0700A == 3) || ($K0700A == 2 && $K0700B == 1))
    ) $coded += 1;

    if ($coded == 0) return false;
      
    switch ($this->adl) {
      case 15: case 16:
        if ( $depressed == 1 ) return 'HE2'; else return 'HE1'; break;
      case 11: case 12: case 13: case 14:
        if ( $depressed == 1 ) return 'HD2'; else return 'HD1'; break;
      case 6: case 7: case 8: case 9: case 10:
        if ( $depressed == 1 ) return 'HC2'; else return 'HC1'; break;
      case 2: case 3: case 4: case 5:
        if ( $depressed == 1 ) return 'HB2'; else return 'HB1'; break;
    }
    
    return false;
  }
  
  /**
   * CATEGORY V: SPECIAL CARE LOW
   * RUG-IV, 66-GROUP HIERARCHICAL CLASSIFICATION
   * 
   * Tube feeding classification requirements:
   *  (1) K0700A is 51% or more of total calories OR
   *  (2) K0700A is 26% to 50% of total calories and K0700B is 501 cc or more per day fluid enteral intake in the last 7 days.
   */
  private function category_5 ($data, $minutes, $depressed, $skin) {

    if (array_key_exists('SectionI', $data) && array_key_exists('I4400',   $data['SectionI']) && isset($data['SectionI']['I4400']))   $I4400   = $data['SectionI']['I4400'];   else $I4400   = '';
    if (array_key_exists('SectionI', $data) && array_key_exists('I5200',   $data['SectionI']) && isset($data['SectionI']['I5200']))   $I5200   = $data['SectionI']['I5200'];   else $I5200   = '';
    if (array_key_exists('SectionI', $data) && array_key_exists('I5300',   $data['SectionI']) && isset($data['SectionI']['I5300']))   $I5300   = $data['SectionI']['I5300'];   else $I5300   = '';
    if (array_key_exists('SectionI', $data) && array_key_exists('I6300',   $data['SectionI']) && isset($data['SectionI']['I6300']))   $I6300   = $data['SectionI']['I6300'];   else $I6300   = '';

    if (array_key_exists('SectionO', $data) && array_key_exists('O0100C2', $data['SectionO']) && isset($data['SectionO']['O0100C2'])) $O0100C2 = $data['SectionO']['O0100C2']; else $O0100C2 = '';
      
    if (array_key_exists('SectionK', $data) && array_key_exists('K0500B',  $data['SectionK']) && isset($data['SectionK']['K0500B']))  $K0500B  = $data['SectionK']['K0500B'];  else $K0500B  = '';
    if (array_key_exists('SectionK', $data) && array_key_exists('K0510B',  $data['SectionK']) && isset($data['SectionK']['K0510B']))  $K0510B  = $data['SectionK']['K0510B'];  else $K0510B  = '';
    if (array_key_exists('SectionK', $data) && array_key_exists('K0700A',  $data['SectionK']) && isset($data['SectionK']['K0700A']))  $K0700A  = $data['SectionK']['K0700A'];  else $K0700A  = '';
    if (array_key_exists('SectionK', $data) && array_key_exists('K0700B',  $data['SectionK']) && isset($data['SectionK']['K0700B']))  $K0700B  = $data['SectionK']['K0700B'];  else $K0700B  = '';

    if (array_key_exists('SectionM', $data) && array_key_exists('M0300B1', $data['SectionM']) && isset($data['SectionM']['M0300B1'])) $M0300B1 = $data['SectionM']['M0300B1']; else $M0300B1 = '';
    if (array_key_exists('SectionM', $data) && array_key_exists('M0300C1', $data['SectionM']) && isset($data['SectionM']['M0300C1'])) $M0300C1 = $data['SectionM']['M0300C1']; else $M0300C1 = '';
    if (array_key_exists('SectionM', $data) && array_key_exists('M0300D1', $data['SectionM']) && isset($data['SectionM']['M0300D1'])) $M0300D1 = $data['SectionM']['M0300D1']; else $M0300D1 = '';
    if (array_key_exists('SectionM', $data) && array_key_exists('M0300F1', $data['SectionM']) && isset($data['SectionM']['M0300F1'])) $M0300F1 = $data['SectionM']['M0300F1']; else $M0300F1 = '';
    if (array_key_exists('SectionM', $data) && array_key_exists('M1030',   $data['SectionM']) && isset($data['SectionM']['M1030']))   $M1030   = $data['SectionM']['M1030'];   else $M1030   = '';
    if (array_key_exists('SectionM', $data) && array_key_exists('M0300B1', $data['SectionM']) && isset($data['SectionM']['M0300B1'])) $M0300B1 = $data['SectionM']['M0300B1']; else $M0300B1 = '';
    if (array_key_exists('SectionM', $data) && array_key_exists('M1040A',  $data['SectionM']) && isset($data['SectionM']['M1040A']))  $M1040A  = $data['SectionM']['M1040A'];  else $M1040A  = '';
    if (array_key_exists('SectionM', $data) && array_key_exists('M1040B',  $data['SectionM']) && isset($data['SectionM']['M1040B']))  $M1040B  = $data['SectionM']['M1040B'];  else $M1040B  = '';
    if (array_key_exists('SectionM', $data) && array_key_exists('M1040C',  $data['SectionM']) && isset($data['SectionM']['M1040C']))  $M1040C  = $data['SectionM']['M1040C'];  else $M1040C  = '';
    if (array_key_exists('SectionM', $data) && array_key_exists('M1200I',  $data['SectionM']) && isset($data['SectionM']['M1200I']))  $M1200I  = $data['SectionM']['M1200I'];  else $M1200I  = '';

    if (array_key_exists('SectionO', $data) && array_key_exists('O0100B2', $data['SectionO']) && isset($data['SectionO']['O0100B2'])) $O0100B2 = $data['SectionO']['O0100B2']; else $O0100B2 = '';
    if (array_key_exists('SectionO', $data) && array_key_exists('O0100J2', $data['SectionO']) && isset($data['SectionO']['O0100J2'])) $O0100J2 = $data['SectionO']['O0100J2']; else $O0100J2 = '';
      
      // check if coded
    $coded = 0;

    // Cerebral palsy, with ADL score >=5
    if ($I4400 == 1 && $this->adl >= 5) $coded++;
    // Multiple sclerosis, with ADL score >=5
    if ($I5200 == 1 && $this->adl >= 5) $coded++;
    // Parkinson’s disease, with ADL score >=5
    if ($I5300 == 1 && $this->adl >= 5) $coded++;
    // Respiratory failure and oxygen therapy while a resident
    if ($I6300 == 1 && $O0100C2 == 1) $coded++;
    // Feeding tube*
    if ($K0700A == 3 || ($K0700A == 2 && $K0700B == 2)) $coded++; 
    // Two or more stage 2 pressure ulcers with two or more selected skin treatments**
    if ($M0300B1 >= 2 && $skin >= 2)  $coded++;
    // Any stage 3 or 4 pressure ulcer with two or more selected skin treatments**
    if (($M0300C1 > 0 || $M0300D1 > 0 || $M0300F1 > 0) && $skin >= 2) $coded++;
    // Two or more venous/arterial ulcers with two or more selected skin treatments**
    if ($M1030 >= 2  && $skin >= 2) $coded++;
    // 1 stage 2 pressure ulcer and 1 venous/arterial ulcer with 2 or more selected skin treatments**
    if ($M1030 >= 2 && $M0300B1 >= 1 && $skin >= 2) $coded++;
    // Foot infection, diabetic foot ulcer or other open lesion of foot with application of dressings to the feet
    if (
      ($M1040A == 1 && $M1200I == 1) || 
      ($M1040B == 1 && $M1200I == 1) || 
      ($M1040C == 1 && $M1200I == 1)
    ) $coded++;
    // Radiation treatment while a resident
    if ($O0100B2 == 1) $coded++;
    // Dialysis treatment while a resident
    if ($O0100J2 == 1) $coded++;

    if ($coded == 0) return false;
    
    switch ($this->adl) {
      case 15: case 16:
        if ( $depressed == 1 ) return 'LE2'; else return 'LE1'; break;
      case 11: case 12: case 13: case 14:
        if ( $depressed == 1 ) return 'LD2'; else return 'LD1'; break;
      case 6: case 7: case 8: case 9: case 10:
        if ( $depressed == 1 ) return 'LC2'; else return 'LC1'; break;
      case 2: case 3: case 4: case 5:
        if ( $depressed == 1 ) return 'LB2'; else return 'LB1'; break;
    }
      
    return false;
  }

/**
 * 
 * CATEGORY VI: CLINICALLY COMPLEX
 * RUG-IV, 66-GROUP HIERARCHICAL CLASSIFICATION
 * 
 * Selected Skin Treatments
 *   M1200F Surgical wound care
 *   M1200G Application of dressing (not to feet)
 *   M1200H Application of ointments (not to feet)
 */
  private function category_6 ($data, $minutes, $depressed) {


    if (isset($data['SectionD']) && isset($data['SectionD']['D0300']) && $data['SectionD']['D0300'] != '') $D0300 = $data['SectionD']['D0300']; else $D0300 = '';
    if (isset($data['SectionD']) && isset($data['SectionD']['D0600']) && $data['SectionD']['D0600'] != '') $D0600 = $data['SectionD']['D0600']; else $D0600 = '';
    
    if (isset($data['SectionI']) && isset($data['SectionI']['I2000']) && $data['SectionI']['I2000'] != '') $I2000 = $data['SectionI']['I2000']; else $I2000 = '';
    if (isset($data['SectionI']) && isset($data['SectionI']['I4900']) && $data['SectionI']['I4900'] != '') $I4900 = $data['SectionI']['I4900']; else $I4900 = '';
    
    if (isset($data['SectionM']) && isset($data['SectionM']['M1040D']) && $data['SectionM']['M1040D'] != '') $M1040D = $data['SectionM']['M1040D']; else $M1040D = '';
    if (isset($data['SectionM']) && isset($data['SectionM']['M1040E']) && $data['SectionM']['M1040E'] != '') $M1040E = $data['SectionM']['M1040E']; else $M1040E = '';
    if (isset($data['SectionM']) && isset($data['SectionM']['M1040F']) && $data['SectionM']['M1040F'] != '') $M1040F = $data['SectionM']['M1040F']; else $M1040F = '';
    if (isset($data['SectionM']) && isset($data['SectionM']['M1200F']) && $data['SectionM']['M1200F'] != '') $M1200F = $data['SectionM']['M1200F']; else $M1200F = '';
    if (isset($data['SectionM']) && isset($data['SectionM']['M1200G']) && $data['SectionM']['M1200G'] != '') $M1200G = $data['SectionM']['M1200G']; else $M1200G = '';
    if (isset($data['SectionM']) && isset($data['SectionM']['M1200H']) && $data['SectionM']['M1200H'] != '') $M1200H = $data['SectionM']['M1200H']; else $M1200H = '';

    if (isset($data['SectionO']) && isset($data['SectionO']['O0100A2']) && $data['SectionO']['O0100A2'] != '') $O0100A2 = $data['SectionO']['O0100A2']; else $O0100A2 = '';
    if (isset($data['SectionO']) && isset($data['SectionO']['O0100C2']) && $data['SectionO']['O0100C2'] != '') $O0100C2 = $data['SectionO']['O0100C2']; else $O0100C2 = '';
    if (isset($data['SectionO']) && isset($data['SectionO']['O0100H2']) && $data['SectionO']['O0100H2'] != '') $O0100H2 = $data['SectionO']['O0100H2']; else $O0100H2 = '';
    if (isset($data['SectionO']) && isset($data['SectionO']['O0100I2']) && $data['SectionO']['O0100I2'] != '') $O0100I2 = $data['SectionO']['O0100I2']; else $O0100I2 = '';

    $coded = 0;

    // Condition 1;
    if ($I2000 == '1') $coded++;
    // Condition 2;
    if ( ($I4900 == '1') AND ($this->adl >= 5) ) $coded++;
    // Condition 3;
    if (
      ($M1040D && ($M1200F >= 1 || $M1200G >= 1 || $M1200H >= 1)) || 
      ($M1040E && ($M1200F >= 1 || $M1200G >= 1 || $M1200H >= 1)) 
    )  $coded++;
    // Condition 4;
    if ($M1040F == '1') $coded++;
    // Condition 5;
    if ($O0100A2 == '1') $coded++;
    // Condition 6;
    if ($O0100C2 == '1') $coded++;
    // Condition 7;
    if ($O0100H2 == '1') $coded++;
    // Condition 8;
    if ($O0100I2 == '1') $coded++;

    if ($coded == 0) return false;


    if ($D0300 >= 10 && $D0300 != 99)  $depressed = 1;
    else if ($D0600 >= 10)             $depressed = 1;
    else                               $depressed = 0;

    switch ($this->adl) {
      case 15: case 16:
        if ( $depressed == 1 ) return 'CE2'; else return 'CE1'; break;
      case 11: case 12: case 13: case 14:
        if ( $depressed == 1 ) return 'CD2'; else return 'CD1'; break;
      case 6: case 7: case 8: case 9: case 10:
        if ( $depressed == 1 ) return 'CC2'; else return 'CC1'; break;
      case 2: case 3: case 4: case 5:
        if ( $depressed == 1 ) return 'CB2'; else return 'CB1'; break;
      case 0: case 1:           
        if ( $depressed == 1 ) return 'CA2'; else return 'CA1'; break;
    }
  }
  
  private function category_7 ($data, $minutes, $restorative) {

    if ($this->adl > 5) return false;
    
    $skip_to_3 = 0;
    $skip_to_4 = 0;
    $skip_to_5 = 0;
    $skip_to_6 = 0;
    $skip_to_7 = 0;

    // step 2 skips    
    if (isset($data['SectionC']['C0100']) && $data['SectionC']['C0100'] == 0)  $skip_to_3 = 1; else $skip_to_3 = 0;
    
    if ($skip_to_3 == 0) {
      
      if (isset($data['SectionC']['C0500']) && $data['SectionC']['C0500'] <= 9)  $skip_to_5 = 1; else $skip_to_5 = 0;
      
      if ($skip_to_5 == 0) {
        if (isset($data['SectionC']['C0500']) && $data['SectionC']['C0500'] == 99) $skip_to_3 = 1; else $skip_to_3 = 0;
        
        if (
          (isset($data['SectionC']['C0500']) && $data['SectionC']['C0500'] != 99) && 
          (isset($data['SectionC']['C0500']) && $data['SectionC']['C0500'] > 9)
        ) $skip_to_4 = 1; else $skip_to_4 = 0;
      }
    }   
    
    $impared_one = 0;
    if (isset($data['SectionB']['B0700']) && $data['SectionB']['B0700'] > 0)  $impared_one += 1;
    if (isset($data['SectionC']['C0700']) && $data['SectionC']['C0700'] == 1) $impared_one += 1;
    if (isset($data['SectionC']['C0100']) && $data['SectionC']['C1000'] > 0)  $impared_one += 1;
    
    $impared_two = 0;
    if (isset($data['SectionB']['B0700']) && $data['SectionB']['B0700'] >= 2) $impared_two += 1;
    if (isset($data['SectionC']['C0100']) && $data['SectionC']['C1000'] >= 2) $impared_two += 1;
    
    if ($skip_to_4 == 0 && $skip_to_5 == 0) {
      $coded = 0;
      if (
        (
          isset($data['SectionB']['B0100']) && $data['SectionB']['B0100'] == 1 && 
          (
            isset($data['SectionG']['G0110A1']) && $data['SectionG']['G0110A1'] == 4 || 
            isset($data['SectionG']['G0110A1']) && $data['SectionG']['G0110A1'] == 8
          )
        ) && 
        (
          isset($data['SectionB']['B0100']) && $data['SectionB']['B0100'] == 1 && 
          (
            isset($data['SectionG']['G0110B1']) && $data['SectionG']['G0110B1'] == 4 || 
            isset($data['SectionG']['G0110B1']) && $data['SectionG']['G0110B1'] == 8
          )
        ) && 
        (
          isset($data['SectionB']['B0100']) && $data['SectionB']['B0100'] == 1 && 
          (
            isset($data['SectionG']['G0110H1']) && $data['SectionG']['G0110H1'] == 4 ||
            isset($data['SectionG']['G0110H1']) && $data['SectionG']['G0110H1'] == 8
          )
        ) && 
        (
          isset($data['SectionB']['B0100']) && $data['SectionB']['B0100'] == 1 && 
          (
            isset($data['SectionG']['G0110I1']) && $data['SectionG']['G0110I1'] == 4 || 
            isset($data['SectionG']['G0110I1']) && $data['SectionG']['G0110I1'] == 8
          )
         )
      ) $coded += 1;
    
      if (isset($data['SectionC']['C1000']) && $data['SectionC']['C1000'] == 3) $coded += 1;
      if ($impared_one >= 2 && $impared_two >= 1) $coded += 1;
      
      if ($coded >= 1) $skip_to_5 = true; else $skip_to_5 = false;
    }
    
    if ($skip_to_5 == false) {
      $symptoms = 0;
      if (isset($data['SectionE']['E0100A']) && $data['SectionE']['E0100A'] == 1) $symptoms += 1;
      if (isset($data['SectionE']['E0100B']) && $data['SectionE']['E0100B'] == 1) $symptoms += 1;
      if (isset($data['SectionE']['E0200A']) && $data['SectionE']['E0200A'] == 2 || isset($data['SectionE']['E0200A']) && $data['SectionE']['E0200A'] == 3) $symptoms += 1;
      if (isset($data['SectionE']['E0200C']) && $data['SectionE']['E0200B'] == 2 || isset($data['SectionE']['E0200A']) && $data['SectionE']['E0200A'] == 3) $symptoms += 1;
      if (isset($data['SectionE']['E0200A']) && $data['SectionE']['E0200C'] == 2 || isset($data['SectionE']['E0200A']) && $data['SectionE']['E0200A'] == 3) $symptoms += 1;
      if (isset($data['SectionE']['E0800']) && $data['SectionE']['E0800']  == 2 || isset($data['SectionE']['E0200A']) && $data['SectionE']['E0200A'] == 3) $symptoms += 1;
      if (isset($data['SectionE']['E0900']) && $data['SectionE']['E0900']  == 2 || isset($data['SectionE']['E0200A']) && $data['SectionE']['E0200A'] == 3) $symptoms += 1;
      if ($symptoms == 0) return false;
    }
    
    switch ($this->adl) {
      case 2: case 3: case 4: case 5:
        if ( $restorative >= 2 ) return 'BB2'; 
        if ( $restorative == 0 || $restorative == 1 ) return 'BB1'; 
        break;
      case 0: case 1:
        if ( $restorative >= 2 ) return 'BA2'; 
        if ( $restorative == 0 || $restorative == 1 ) return 'BA1'; 
        break;
    }
    
  }
  
  private function category_8 ($data, $minutes, $restorative) {

    switch ($this->adl) {
      case 15: case 16:
        if ( $restorative >= 2 ) return  'PE2';
        if ( $restorative == 0 || $restorative == 1 ) return  'PE1';
        break;
      case 11: case 12: case 13: case 14:
        if ( $restorative >= 2 ) return  'PD2';
        if ( $restorative == 0 || $restorative == 1 ) return  'PD1';
        break;
      case 6: case 7: case 8: case 9: case 10:
        if ( $restorative >= 2 ) return  'PC2';
        if ( $restorative == 0 || $restorative == 1 ) return  'PC1';
        break;
      case 2: case 3: case 4: case 5:
        if ( $restorative >= 2 ) return  'PB2';
        if ( $restorative == 0 || $restorative == 1 ) return  'PB1';
        break; 
      case 0: case 1:
        if ( $restorative >= 2 ) return  'PA2';
        if ( $restorative == 0 || $restorative == 1 ) return  'PA1';
        break;
    }
    
  }
  
  private function __date($date, $add) {
    list($month, $day, $year) = explode('/', $date);
    return date("Ymd", mktime(0, 0, 0, $month, $day + $add, $year));
  }
  
  private function __count_days ( $a = null, $b = null) {
    
    if ($a == null || $b == null) return 0;
    
    // start date
      if (preg_match('[-]', $a)) list($ay, $am, $ad) = explode('-', $a); 
      if (preg_match('[/]', $a)) list($am, $ad, $ay) = explode('/', $a);    
    
      // end date
      if (preg_match('[-]', $b)) list($by, $bm, $bd) = explode('-', $b); 
      if (preg_match('[/]', $b)) list($bm, $bd, $by) = explode('/', $b);
      
    $a_new = @mktime( 12, 0, 0, $am, $ad, $ay);
    $b_new = @mktime( 12, 0, 0, $bm, $bd, $by);

    $days = round( abs( $b_new - $a_new ) / 86400 );  

    return $days;
  }

  private function __late($id, $A0310B, $X0100) {

    $this->Clock = new ClockComponent();

    $b = '';
    if ($A0310B == '01') $b = '5';
    if ($A0310B == '02') $b = '14';
    if ($A0310B == '03') $b = '30';
    if ($A0310B == '04') $b = '60';
    if ($A0310B == '05') $b = '90';

    if ($b == '')
      return false;

    if ($X0100 != '1')
      return false;

    //if (in_array($A0310B, array('01','02','03','04','05','06')))
    //  return $this->Clock->checkLate($id);
    //else 
      return false;
  }
   
}