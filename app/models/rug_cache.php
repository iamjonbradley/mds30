<?php


App::import('Component', 'Reports.Clock');
App::import('Component', 'Calc');
App::import('Component', 'Caa');
class RugCache extends AppModel {

  public $actAs = array('Containable');

  public $belongsTo = array(
    'Assessment' => array(
      'foreignKey' => 'assessment_id',
      'fields' => array('Assessment.id','Assessment.transmission_status')
    ),  
    'Resident' => array(
      'fields' => array('Resident.id', 'Resident.PATLNAME', 'Resident.PATFNAME', 'Resident.PMI', 'Resident.PATNUM')
    ), 
    'Facility' => array(
      'foreignKey' => 'facility_id',
      'fields' => array('Facility.name','Facility.code','Facility.F_STATE')
    ), 
  );

  public $hasOne = array(
    'SectionA' => array(
      'foreignKey' => false,
      'conditions' => 'RugCache.assessment_id = SectionA.assessment_id',
      'fields' => array('SectionA.A0310A','SectionA.A0310B')
    ), 
    'SectionO' => array(
      'foreignKey' => false,
      'conditions' => 'RugCache.assessment_id = SectionO.assessment_id',
      'fields' => array(
        'SectionO.O0400A4','SectionO.O0400A6','SectionO.O0400B4','SectionO.O0400B6','SectionO.O0400C4','SectionO.O0400C6',
        'SectionO.O0400D1','SectionO.O0400D2'
      )
    )
  );

  public function getRug($assessment_id) {
    return $this->find('first', array(
      'conditions' => array('RugCache.assessment_id' => $assessment_id)
    ));
  }

  public function update_cache($assessment_id = null) {


    $rug_cache_id = $this->getRug($assessment_id);

    $this->Caa = new CaaComponent();
    $data = $this->Caa->trigger($assessment_id);

    if (!empty($data) && isset($data['SectionA']) && !empty($data['Assessment']['type'])) {

      $this->Calc = new CalcComponent();
      $rug_therapy = $this->Calc->calcRugTherapy($data);
      $rug_nursing = $this->Calc->calcRugNonTherapy($data);
      $rug_hipps   = $this->Calc->calcModifier($data);
      $rug_sot     = $this->Calc->calcSOT($data);
      $rug_adl     = $this->Calc->calcAdl($data);
      $rug_minutes = $this->Calc->calcTherapy($data);

      $rug_cache = array();
      if (!empty($rug_cache_id)) $rug_cache['id'] = $rug_cache_id['RugCache']['id'];
      else $this->create();

      // get coverage dates
      $rug_cache = self::__calculateCVR ($data, $rug_cache);
      // get coverage dates for end of therapy
      if ($data['SectionA']['A0310C'] == 2)
        $rug_cache = self::__calculateEOT ($data, $rug_cache);
      // get coverage dates for change of therapy
      if ($data['SectionA']['A0310C'] == 4) 
        $rug_cache = self::__calculateCOT ($data, $rug_cache);

      $a = '';
      if ($data['SectionA']['A0310A'] == '01') $a = 'ADM';
      if ($data['SectionA']['A0310A'] == '02') $a = 'QTR';
      if ($data['SectionA']['A0310A'] == '03') $a = 'ANN';
      if ($data['SectionA']['A0310A'] == '04') $a = 'SCS';
      if ($data['SectionA']['A0310A'] == '05') $a = 'SCPC';
      if ($data['SectionA']['A0310A'] == '06') $a = 'SCPQ';

      $b = '';
      if ($data['SectionA']['A0310B'] == '01') $b = '5-DAY';
      if ($data['SectionA']['A0310B'] == '02') $b = '14-DAY';
      if ($data['SectionA']['A0310B'] == '03') $b = '30-DAY';
      if ($data['SectionA']['A0310B'] == '04') $b = '60-DAY';
      if ($data['SectionA']['A0310B'] == '05') $b = '90-DAY';
      if ($data['SectionA']['A0310B'] == '06') $b = 'RR';
      if ($data['SectionA']['A0310B'] == '07') $b = 'UNS';

      $c = '';
      if ($data['SectionA']['A0310C'] == '1') $c = 'SOT';
      if ($data['SectionA']['A0310C'] == '2') $c = 'EOT';
      if ($data['SectionA']['A0310C'] == '3') $c = 'SEOT';
      if ($data['SectionA']['A0310C'] == '4') $c = 'COT';
      if ($data['SectionO']['O0450A'] == '1') $c = 'EOT-R';

      $e = '';
      if ($data['SectionA']['A0310F'] == '01') $e = 'ENT';
      if ($data['SectionA']['A0310F'] == '10') $e = 'DIS';
      if ($data['SectionA']['A0310F'] == '11') $e = 'DIS-R';
      if ($data['SectionA']['A0310F'] == '12') $e = 'DEATH';

      $t_rate = ClassRegistry::init('RugRate')->find('first', array(
        'conditions' => array('Rug.name' => $rug_therapy, 'RugRate.facility_id' => $data['Assessment']['facility_id']),
        'fields' => array('RugRate.rate'),
      ));

      $n_rate = ClassRegistry::init('RugRate')->find('first', array(
        'conditions' => array('Rug.name' => $rug_nursing, 'RugRate.facility_id' => $data['Assessment']['facility_id']),
        'fields' => array('RugRate.rate'),
      ));

      $rug_cache['assessment_id']         = $data['Assessment']['id'];
      $rug_cache['resident_id']           = $data['Assessment']['resident'];
      $rug_cache['facility_id']           = $data['Assessment']['facility_id'];
      $rug_cache['isc']                   = $data['Assessment']['type'];
      $rug_cache['type_obra']             = $a;
      $rug_cache['type_pps']              = $b;
      $rug_cache['type_omra']             = $c;
      $rug_cache['type_tracking']         = $e;
      $rug_cache['rug_therapy']           = $rug_therapy;
      $rug_cache['rug_therapy_rate']      = $t_rate['RugRate']['rate'];
      $rug_cache['rug_nursing']           = $rug_nursing;
      $rug_cache['rug_nursing_rate']      = $n_rate['RugRate']['rate'];
      $rug_cache['rug_hipps']             = $rug_hipps;
      $rug_cache['minutes_physical']      = $rug_minutes[1];
      $rug_cache['minutes_occupational']  = $rug_minutes[2];
      $rug_cache['minutes_speech']        = $rug_minutes[3];
      $rug_cache['minutes_ttl']           = array_sum($rug_minutes);
      $rug_cache['sot']                   = $rug_sot;
      $rug_cache['adl']                   = $rug_adl;
      $rug_cache['type']                  = (!empty($data['SectionA']['A0050'])) ? $data['SectionA']['A0050'] : $data['SectionX']['X0100'];
      $rug_cache['deleted']               = $data['Assessment']['deleted'];
      $rug_cache['date_ard']              = (!empty($data['SectionA']['A2300'])) ? $data['SectionA']['A2300'] : '';
      $rug_cache['date_entry']            = (!empty($data['SectionA']['A1600'])) ? $data['SectionA']['A1600'] : '';
      $rug_cache['date_parta']            = (!empty($data['SectionA']['A2400B'])) ? $data['SectionA']['A2400B'] : '';
      $rug_cache['date_locked']           = (!empty($data['Assessment']['lock_date'])) ? $data['Assessment']['lock_date'] : '';
      $rug_cache['date_accepted']         = ($data['Assessment']['transmission_status'] == 2) ? $data['Assessment']['lock_date'] : '';
      $this->save($rug_cache, false);

      unset($data);

      return $rug_cache;
    }

  }

  private function __calculateCVR ($data, $rug_cache) {

    if (isset($data['SectionA']['A0310B']) && !empty($data['SectionA']['A0310B'])) {

      $b = '';
      if ($data['SectionA']['A0310B'] == '01') $b = '5';
      if ($data['SectionA']['A0310B'] == '02') $b = '14';
      if ($data['SectionA']['A0310B'] == '03') $b = '30';
      if ($data['SectionA']['A0310B'] == '04') $b = '60';
      if ($data['SectionA']['A0310B'] == '05') $b = '90';
      if ($data['SectionA']['A0310B'] == '06') $b = '5';

      if (!empty($b)) {

        $this->Clock = new ClockComponent();
        $cvr_dates = $this->Clock->render($data['Resident']['id'], $data['Assessment']['id']);

        if (!empty($cvr_dates[$b]['cvr']['s'])) {
          list($m,$d,$y) = explode('/', $cvr_dates[$b]['cvr']['s']);
          $rug_cache['cvr_from'] = $y .'-'. $m .'-'. $d;

          list($m,$d,$y) = @explode('/', $cvr_dates[$b]['cvr']['e']);
          $rug_cache['cvr_end']  = $y .'-'. $m .'-'. $d;

          $rug_cache['cvr_days'] = $cvr_dates[$b]['cvr']['d'];
        }

      }
    }

    unset($data);

    return $rug_cache;

  }

  private function __calculateCOT ($data, $rug_cache) {

    $cvr_from = self::__modifyDateSub($data['SectionA']['A2300'], 6);
    
    $rug_cache['cvr_from'] = $cvr_from;
    
    if (empty($b)) {
      list($y,$m,$d) = explode('-', $data['SectionA']['A2300']);
      
      $rug_cache['cvr_end']   = $m .'/'. $d .'/'. $y;
    }

    if (preg_match ('|-|', $cvr_from)) {
      $rug_cache['cvr_end']   = $data['SectionA']['A2300'];
      $rug_cache['cvr_days'] = self::__countDaysDash($cvr_from, $rug_cache['cvr_end']);
    }

    else {
      $rug_cache['cvr_days'] = self::__countDays($cvr_from, $rug_cache['cvr_end']);
    }

    unset($data);

    return $rug_cache;
  }

  private function __calculateEOT ($data, $rug_cache) {

    if (isset($data['SectionA']['A0310B']) && !empty($data['SectionA']['A0310B'])) {

      // get last pps assessment
      $last_asmt = $this->Assessment->find('first', array(
        'conditions' => array(
          'Resident.id' => $data['Assessment']['resident'],
          'SectionA.A2300 <=' => $data['SectionA']['A2300'],
          'SectionA.A0310B' => array('01','02','03','04','05')
        ),
        'fields' => array('Assessment.id', 'SectionA.A2300', 'SectionA.A0310B', 'Resident.id'),
        'order' => array('SectionA.A2300' => 'DESC')
      ));

      $b = '';
      if ($last_asmt['SectionA']['A0310B'] == '01') $b = '5';
      if ($last_asmt['SectionA']['A0310B'] == '02') $b = '14';
      if ($last_asmt['SectionA']['A0310B'] == '03') $b = '30';
      if ($last_asmt['SectionA']['A0310B'] == '04') $b = '60';
      if ($last_asmt['SectionA']['A0310B'] == '05') $b = '90';
      if ($last_asmt['SectionA']['A0310B'] == '06') $b = '5';

      $this->Clock = new ClockComponent();
      $cvr_dates = $this->Clock->render($last_asmt['Resident']['id'], $last_asmt['Assessment']['id']);

      if (!empty($cvr_dates[$b]['cvr']['s'])) {
        list($m,$d,$y) = explode('/', $cvr_dates[$b]['cvr']['s']);
        $rug_cache['cvr_from'] = $y .'-'. $m .'-'. $d;

        list($m,$d,$y) = @explode('/', $cvr_dates[$b]['cvr']['e']);
        $rug_cache['cvr_end']  = $y .'-'. $m .'-'. $d;
        $rug_cache['cvr_days'] = $cvr_dates[$b]['cvr']['d'];
      }

      
      $cvr_from = $data['SectionA']['A2300'];
      
      $rug_cache['cvr_from'] = $cvr_from;
      $rug_cache['cvr_days'] = self::__countDaysDash($cvr_from, $rug_cache['cvr_end']);

    }

    unset($data);
    unset($last_asmt);

    return $rug_cache;
  } 
  
  private function __modifyDate($date, $add) {
    list($y, $m, $d) = explode('-', $date);
    return date("Y-m-d", mktime(0, 0, 0, $m, $d + $add, $y));
  }
  
  private function __modifyDateSub($date, $add) {
    list($y, $m, $d) = explode('-', $date);
    return date("Y-m-d", mktime(0, 0, 0, $m, $d - $add, $y));
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

  
  private function __countDaysDash( $a = null, $b = null) {
  
    if ($a == null || $b == null) return 0;
  
    list($gd_a['y'], $gd_a['m'], $gd_a['d']) = @explode('-', $a);
    list($gd_b['y'], $gd_b['m'], $gd_b['d']) = @explode('-', $b);
    
    $a_new = mktime( 12, 0, 0, $gd_a['m'], $gd_a['d'], $gd_a['y'] );
    $b_new = mktime( 12, 0, 0, $gd_b['m'], $gd_b['d'], $gd_b['y'] );
    
    $days = round( abs( $a_new - $b_new ) / 86400 );
    return $days + 1;
  }

}