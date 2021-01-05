<?php

class SectionO extends AppModel {
	
	var $name = 'SectionO';
	var $useTable = 'section_o';
  var $actsAs = array(
  	'Logable' => array( 
	    'change' => 'full', 
	    'description_ids' => TRUE 
	  )
  ); 
	var $belongsTo = array('Assessment');

  public function beforeValidate () {
    parent::validateModel();
  }

  public function skipPatterns ($data = array()) {

    if (!empty($data))
      $this->data = $data;

    if (!isset($this->data[$this->name]))
        return array();
      
    $data = $this->data[$this->name];

    // set default skip array
    $skips = array();

    /**
     * Set the variables we need for validation
     */

    // set fields to check
    if (array_key_exists('A1600',   $data) && isset($data['A1600']))   $A1600   = $data['A1600'];   else $A1600   = $this->data['SectionA']['A1600'];
    if (array_key_exists('A2300',   $data) && isset($data['A2300']))   $A2300   = $data['A2300'];   else $A2300   = $this->data['SectionA']['A2300'];
    if (array_key_exists('A0310A',  $data) && isset($data['A0310A']))  $A0310A  = $data['A0310A'];  else $A0310A  = $this->data['SectionA']['A0310A'];
    if (array_key_exists('A0310B',  $data) && isset($data['A0310B']))  $A0310B  = $data['A0310B'];  else $A0310B  = $this->data['SectionA']['A0310B'];
    if (array_key_exists('A0310C',  $data) && isset($data['A0310C']))  $A0310C  = $data['A0310C'];  else $A0310C  = $this->data['SectionA']['A0310C'];
    if (array_key_exists('A0310F',  $data) && isset($data['A0310F']))  $A0310F  = $data['A0310F'];  else $A0310F  = $this->data['SectionA']['A0310F'];
    if (array_key_exists('O0100A1', $data) && isset($data['O0100A1'])) $O0100A1 = $data['O0100A1']; else $O0100A1 = '';
    if (array_key_exists('O0100B1', $data) && isset($data['O0100B1'])) $O0100B1 = $data['O0100B1']; else $O0100B1 = '';
    if (array_key_exists('O0100C1', $data) && isset($data['O0100C1'])) $O0100C1 = $data['O0100C1']; else $O0100C1 = '';
    if (array_key_exists('O0100D1', $data) && isset($data['O0100D1'])) $O0100D1 = $data['O0100D1']; else $O0100D1 = '';
    if (array_key_exists('O0100E1', $data) && isset($data['O0100E1'])) $O0100E1 = $data['O0100E1']; else $O0100E1 = '';
    if (array_key_exists('O0100F1', $data) && isset($data['O0100F1'])) $O0100F1 = $data['O0100F1']; else $O0100F1 = '';
    if (array_key_exists('O0100G1', $data) && isset($data['O0100G1'])) $O0100G1 = $data['O0100G1']; else $O0100G1 = '';
    if (array_key_exists('O0100H1', $data) && isset($data['O0100H1'])) $O0100H1 = $data['O0100H1']; else $O0100H1 = '';
    if (array_key_exists('O0100I1', $data) && isset($data['O0100I1'])) $O0100I1 = $data['O0100I1']; else $O0100I1 = '';
    if (array_key_exists('O0100J1', $data) && isset($data['O0100J1'])) $O0100J1 = $data['O0100J1']; else $O0100J1 = '';
    if (array_key_exists('O0100K1', $data) && isset($data['O0100K1'])) $O0100K1 = $data['O0100K1']; else $O0100K1 = '';
    if (array_key_exists('O0100M1', $data) && isset($data['O0100M1'])) $O0100M1 = $data['O0100M1']; else $O0100M1 = '';
    if (array_key_exists('O0100Z1', $data) && isset($data['O0100Z1'])) $O0100Z1 = $data['O0100Z1']; else $O0100Z1 = '';
    if (array_key_exists('O0100A2', $data) && isset($data['O0100A2'])) $O0100A2 = $data['O0100A2']; else $O0100A2 = '';
    if (array_key_exists('O0100B2', $data) && isset($data['O0100B2'])) $O0100B2 = $data['O0100B2']; else $O0100B2 = '';
    if (array_key_exists('O0100C2', $data) && isset($data['O0100C2'])) $O0100C2 = $data['O0100C2']; else $O0100C2 = '';
    if (array_key_exists('O0100D2', $data) && isset($data['O0100D2'])) $O0100D2 = $data['O0100D2']; else $O0100D2 = '';
    if (array_key_exists('O0100E2', $data) && isset($data['O0100E2'])) $O0100E2 = $data['O0100E2']; else $O0100E2 = '';
    if (array_key_exists('O0100F2', $data) && isset($data['O0100F2'])) $O0100F2 = $data['O0100F2']; else $O0100F2 = '';
    if (array_key_exists('O0100G2', $data) && isset($data['O0100G2'])) $O0100G2 = $data['O0100G2']; else $O0100G2 = '';
    if (array_key_exists('O0100H2', $data) && isset($data['O0100H2'])) $O0100H2 = $data['O0100H2']; else $O0100H2 = '';
    if (array_key_exists('O0100I2', $data) && isset($data['O0100I2'])) $O0100I2 = $data['O0100I2']; else $O0100I2 = '';
    if (array_key_exists('O0100J2', $data) && isset($data['O0100J2'])) $O0100J2 = $data['O0100J2']; else $O0100J2 = '';
    if (array_key_exists('O0100K2', $data) && isset($data['O0100K2'])) $O0100K2 = $data['O0100K2']; else $O0100K2 = '';
    if (array_key_exists('O0100L2', $data) && isset($data['O0100L2'])) $O0100L2 = $data['O0100L2']; else $O0100L2 = '';
    if (array_key_exists('O0100M2', $data) && isset($data['O0100M2'])) $O0100M2 = $data['O0100M2']; else $O0100M2 = '';
    if (array_key_exists('O0100Z2', $data) && isset($data['O0100Z2'])) $O0100Z2 = $data['O0100Z2']; else $O0100Z2 = '';
    if (array_key_exists('O0250A',  $data) && isset($data['O0250A']))  $O0250A  = $data['O0250A'];  else $O0250A  = '';
    if (array_key_exists('O0250B',  $data) && isset($data['O0250B']))  $O0250B  = $data['O0250B'];  else $O0250B  = '';
    if (array_key_exists('O0300A',  $data) && isset($data['O0300A']))  $O0300A  = $data['O0300A'];  else $O0300A  = '';
    if (array_key_exists('O0300A',  $data) && isset($data['O0300A']))  $O0300A  = $data['O0300A'];  else $O0300A  = '';
    if (array_key_exists('O0400A1', $data) && isset($data['O0400A1'])) $O0400A1 = $data['O0400A1']; else $O0400A1 = '';
    if (array_key_exists('O0400A2', $data) && isset($data['O0400A2'])) $O0400A2 = $data['O0400A2']; else $O0400A2 = '';
    if (array_key_exists('O0400A3', $data) && isset($data['O0400A3'])) $O0400A3 = $data['O0400A3']; else $O0400A3 = '';
    if (array_key_exists('O0400A4', $data) && isset($data['O0400A4'])) $O0400A4 = $data['O0400A4']; else $O0400A4 = '';
    if (array_key_exists('O0400B1', $data) && isset($data['O0400B1'])) $O0400B1 = $data['O0400B1']; else $O0400B1 = '';
    if (array_key_exists('O0400B2', $data) && isset($data['O0400B2'])) $O0400B2 = $data['O0400B2']; else $O0400B2 = '';
    if (array_key_exists('O0400B3', $data) && isset($data['O0400B3'])) $O0400B3 = $data['O0400B3']; else $O0400B3 = '';
    if (array_key_exists('O0400B4', $data) && isset($data['O0400B4'])) $O0400B4 = $data['O0400B4']; else $O0400B4 = '';
    if (array_key_exists('O0400C1', $data) && isset($data['O0400C1'])) $O0400C1 = $data['O0400C1']; else $O0400C1 = '';
    if (array_key_exists('O0400C2', $data) && isset($data['O0400C2'])) $O0400C2 = $data['O0400C2']; else $O0400C2 = '';
    if (array_key_exists('O0400C3', $data) && isset($data['O0400C3'])) $O0400C3 = $data['O0400C3']; else $O0400C3 = '';
    if (array_key_exists('O0400C4', $data) && isset($data['O0400C4'])) $O0400C4 = $data['O0400C4']; else $O0400C4 = '';
    if (array_key_exists('O0400D1', $data) && isset($data['O0400D1'])) $O0400D1 = $data['O0400D1']; else $O0400D1 = '';
    if (array_key_exists('O0400E1', $data) && isset($data['O0400E1'])) $O0400E1 = $data['O0400E1']; else $O0400E1 = '';
    if (array_key_exists('O0400F1', $data) && isset($data['O0400F1'])) $O0400F1 = $data['O0400F1']; else $O0400F1 = '';
    if (array_key_exists('O0450A', $data) && isset($data['O0450A'])) $O0450A = $data['O0450A']; else $O0450A = '';

    /**
     * Begin Skip Patterns
     */

    $admitted = parent::countDays($A1600, $A2300);

    if ($admitted >= 14) {
      $skips[] = 'O0100A1'; $skips[] = 'O0100B1'; $skips[] = 'O0100C1'; $skips[] = 'O0100D1'; $skips[] = 'O0100E1';
      $skips[] = 'O0100F1'; $skips[] = 'O0100G1'; $skips[] = 'O0100H1'; $skips[] = 'O0100I1'; $skips[] = 'O0100J1';
      $skips[] = 'O0100K1'; $skips[] = 'O0100M1'; $skips[] = 'O0100Z1';
    }
    else {
      if (
        isset ($this->data[$this->name]['O0100Z1']) && 
        $O0100A1 == 0 && $O0100B1 == 0 && $O0100C1 == 0 && $O0100D1 == 0 && $O0100E1 == 0 && 
        $O0100F1 == 0 && $O0100G1 == 0 && $O0100H1 == 0 && $O0100I1 == 0 && $O0100J1 == 0 && 
        $O0100K1 == 0 && $O0100M1 == 0 && $O0100Z1 == 0
      ) $this->data[$this->name]['O0100Z1'] = '';
    }

    if (
      isset($this->data[$this->name]['O0100Z2']) && 
      $O0100A2 == 0 && $O0100B2 == 0 && $O0100C2 == 0 && $O0100D2 == 0 && $O0100E2 == 0 && 
      $O0100F2 == 0 && $O0100G2 == 0 && $O0100H2 == 0 && $O0100I2 == 0 && $O0100J2 == 0 && 
      $O0100K2 == 0 && $O0100L2 == 0 && $O0100M2 == 0 && $O0100Z2 == 0
    ) $this->data[$this->name]['O0100Z2'] = '';

    // O0250A
      if ($O0250A == 0) $skips[] = 'O0250B';
      if ($O0250A == 1) $skips[] = 'O0250C';

    // O0300
    if ($O0300A == 1) $skips[] = 'O0300B';

    // O0400A
    if ($this->data['Assessment']['type'] != 'ND') {
      if (($O0400A1 + $O0400A2 + $O0400A3) == 0) {
        $skips[] = 'O0400A4'; $skips[] = 'O0400A5'; $skips[] = 'O0400A6'; 
      }

      // O0400B
      if (($O0400B1 + $O0400B2 + $O0400B3) == 0) {
        $skips[] = 'O0400B4'; $skips[] = 'O0400B5'; $skips[] = 'O0400B6'; 
      }

      // O0400C
      if (($O0400C1 + $O0400C2 + $O0400C3) == 0) {
        $skips[] = 'O0400C4'; $skips[] = 'O0400C5'; $skips[] = 'O0400C6'; 
      }
    }

    if ($O0400A4 == 0) {
      $skips[] = 'O0400A5'; $skips[] = 'O0400A6';
    }
    if ($O0400B4 == 0) {
      $skips[] = 'O0400B5'; $skips[] = 'O0400B6';
    }
    if ($O0400C4 == 0) {
      $skips[] = 'O0400C5'; $skips[] = 'O0400C6';
    }

    // O0400D1
    if (
      $this->data['Assessment']['type'] == 'NC'
      ) {
      if ($O0400D1 == 0) $skips[] = 'O0400D2';

      // O0400E1
      if ($O0400E1 == 0) $skips[] = 'O0400E2';

      // O0400F1
      if ($O0400F1 == 0) $skips[] = 'O0400F2';
    }

    // O0450
    if ($A0310C != 2 && $A0310C != 3) {
      $skips[] = 'O0450A'; $skips[] = 'O0450B'; 
    }
    
    if ($A0310C != 2 && $A0310C != 3 && $A0310F != 99) {
      $skips[] = 'O0450A'; $skips[] = 'O0450B'; 
    }
    
    if ($A0310F != 99) {
      $skips[] = 'O0450A'; $skips[] = 'O0450B'; 
    }

    if ($O0450A == 0) {
      $skips[] = 'O0450B'; 
    }

    /**
     * Default skips
     */
    $skips[] = 'A0310G';
    $skips[] = 'B0100';
    $skips[] = 'V0100SHOW';

    /**
     * End Skip Patterns
     */

    foreach ($this->data[$this->name] as $key => $value) {
      if (in_array($key, $skips)) $this->data[$this->name][$key] = '';
    }

    return $skips;
  } 

  function findLast($id) {
    return $this->find('first', array(
      'conditions' => array(
        'Assessment.resident' => $id,
        'or' => array(
          'SectionO.O0250A' != '', 'SectionO.O0250B' != '', 'SectionO.O0250C' != '',
          'SectionO.O0300A' != '', 'SectionO.O0300B' != '', 
        ),
      ),
      'fields' => array(
        'Assessment.resident', 
        'SectionO.O0250A', 'SectionO.O0250B', 'SectionO.O0250C', 
        'SectionO.O0300A', 'SectionO.O0300B',
      ),
      'order' => array('Assessment.created' => 'DESC')
    ));
  }

}
