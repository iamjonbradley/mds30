<?php

class SectionD extends AppModel {
	
	var $name = 'SectionD';
	var $useTable = 'section_d';
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
    if (array_key_exists('A0310A', $data) && isset($data['A0310A'])) $A0310A = $data['A0310A']; else $A0310A  = $this->data['SectionA']['A0310A'];
    if (array_key_exists('A0310B', $data) && isset($data['A0310B'])) $A0310B = $data['A0310B']; else $A0310B  = $this->data['SectionA']['A0310B'];
    if (array_key_exists('A2300', $data) && isset($data['A2300'])) $A2300 = $data['A2300']; else $A2300  = $this->data['SectionA']['A2300'];

    if ($A2300 >= '2012-04-01') {
      if (array_key_exists('A0310G', $data) && isset($data['A0310G'])) $A0310G = $data['A0310G']; else $A0310G  = $this->data['SectionA']['A0310G'];
    }
    else {
      $A0310G = '';
    }

    if (array_key_exists('B0100',   $data) && isset($data['B0100']))    $B0100   = $data['B0100'];   else $B0100   = $this->data['SectionB']['B0100'];
    if (array_key_exists('D0100',   $data) && isset($data['D0100']))    $D0100   = $data['D0100'];   else $D0100   = '';
    
    if (array_key_exists('D0200A1', $data) && isset($data['D0200A1']))  $D0200A1 = $data['D0200A1']; else $D0200A1 = '';
    if (array_key_exists('D0200B1', $data) && isset($data['D0200B1']))  $D0200B1 = $data['D0200B1']; else $D0200B1 = '';
    if (array_key_exists('D0200C1', $data) && isset($data['D0200C1']))  $D0200C1 = $data['D0200C1']; else $D0200C1 = '';
    if (array_key_exists('D0200D1', $data) && isset($data['D0200D1']))  $D0200D1 = $data['D0200D1']; else $D0200D1 = '';
    if (array_key_exists('D0200E1', $data) && isset($data['D0200E1']))  $D0200E1 = $data['D0200E1']; else $D0200E1 = '';
    if (array_key_exists('D0200F1', $data) && isset($data['D0200F1']))  $D0200F1 = $data['D0200F1']; else $D0200F1 = '';
    if (array_key_exists('D0200G1', $data) && isset($data['D0200G1']))  $D0200G1 = $data['D0200G1']; else $D0200G1 = '';
    if (array_key_exists('D0200H1', $data) && isset($data['D0200H1']))  $D0200H1 = $data['D0200H1']; else $D0200H1 = '';
    if (array_key_exists('D0200I1', $data) && isset($data['D0200I1']))  $D0200I1 = $data['D0200I1']; else $D0200I1 = '';
    if (array_key_exists('D0200A2', $data) && isset($data['D0200A2']))  $D0200A2 = $data['D0200A2']; else $D0200A2 = '';
    if (array_key_exists('D0200B2', $data) && isset($data['D0200B2']))  $D0200B2 = $data['D0200B2']; else $D0200B2 = '';
    if (array_key_exists('D0200C2', $data) && isset($data['D0200C2']))  $D0200C2 = $data['D0200C2']; else $D0200C2 = '';
    if (array_key_exists('D0200D2', $data) && isset($data['D0200D2']))  $D0200D2 = $data['D0200D2']; else $D0200D2 = '';
    if (array_key_exists('D0200E2', $data) && isset($data['D0200E2']))  $D0200E2 = $data['D0200E2']; else $D0200E2 = '';
    if (array_key_exists('D0200F2', $data) && isset($data['D0200F2']))  $D0200F2 = $data['D0200F2']; else $D0200F2 = '';
    if (array_key_exists('D0200G2', $data) && isset($data['D0200G2']))  $D0200G2 = $data['D0200G2']; else $D0200G2 = '';
    if (array_key_exists('D0200H2', $data) && isset($data['D0200H2']))  $D0200H2 = $data['D0200H2']; else $D0200H2 = '';
    if (array_key_exists('D0200I2', $data) && isset($data['D0200I2']))  $D0200I2 = $data['D0200I2']; else $D0200I2 = '';
    
    if (array_key_exists('D0500A1', $data) && isset($data['D0500A1']))  $D0500A1 = $data['D0500A1']; else $D0500A1 = '';
    if (array_key_exists('D0500B1', $data) && isset($data['D0500B1']))  $D0500B1 = $data['D0500B1']; else $D0500B1 = '';
    if (array_key_exists('D0500C1', $data) && isset($data['D0500C1']))  $D0500C1 = $data['D0500C1']; else $D0500C1 = '';
    if (array_key_exists('D0500D1', $data) && isset($data['D0500D1']))  $D0500D1 = $data['D0500D1']; else $D0500D1 = '';
    if (array_key_exists('D0500E1', $data) && isset($data['D0500E1']))  $D0500E1 = $data['D0500E1']; else $D0500E1 = '';
    if (array_key_exists('D0500F1', $data) && isset($data['D0500F1']))  $D0500F1 = $data['D0500F1']; else $D0500F1 = '';
    if (array_key_exists('D0500G1', $data) && isset($data['D0500G1']))  $D0500G1 = $data['D0500G1']; else $D0500G1 = '';
    if (array_key_exists('D0500H1', $data) && isset($data['D0500H1']))  $D0500H1 = $data['D0500H1']; else $D0500H1 = '';
    if (array_key_exists('D0500I1', $data) && isset($data['D0500I1']))  $D0500I1 = $data['D0500I1']; else $D0500I1 = '';
    if (array_key_exists('D0500A2', $data) && isset($data['D0500A2']))  $D0500A2 = $data['D0500A2']; else $D0500A2 = '';
    if (array_key_exists('D0500B2', $data) && isset($data['D0500B2']))  $D0500B2 = $data['D0500B2']; else $D0500B2 = '';
    if (array_key_exists('D0500C2', $data) && isset($data['D0500C2']))  $D0500C2 = $data['D0500C2']; else $D0500C2 = '';
    if (array_key_exists('D0500D2', $data) && isset($data['D0500D2']))  $D0500D2 = $data['D0500D2']; else $D0500D2 = '';
    if (array_key_exists('D0500E2', $data) && isset($data['D0500E2']))  $D0500E2 = $data['D0500E2']; else $D0500E2 = '';
    if (array_key_exists('D0500F2', $data) && isset($data['D0500F2']))  $D0500F2 = $data['D0500F2']; else $D0500F2 = '';
    if (array_key_exists('D0500G2', $data) && isset($data['D0500G2']))  $D0500G2 = $data['D0500G2']; else $D0500G2 = '';
    if (array_key_exists('D0500H2', $data) && isset($data['D0500H2']))  $D0500H2 = $data['D0500H2']; else $D0500H2 = '';
    if (array_key_exists('D0500I2', $data) && isset($data['D0500I2']))  $D0500I2 = $data['D0500I2']; else $D0500I2 = '';
    if (array_key_exists('D0500J2', $data) && isset($data['D0500J2']))  $D0500J2 = $data['D0500J2']; else $D0500J2 = '';

    /**
     * Begin Skip Patterns
     */
    
    // B0100
    if ($B0100 == 1) {
      $skips[] = 'D0100';
      $skips[] = 'D0200A1'; $skips[] = 'D0200A2'; $skips[] = 'D0200B1'; $skips[] = 'D0200B2'; 
      $skips[] = 'D0200C1'; $skips[] = 'D0200C2'; $skips[] = 'D0200D1'; $skips[] = 'D0200D2'; 
      $skips[] = 'D0200E1'; $skips[] = 'D0200E2'; $skips[] = 'D0200F1'; $skips[] = 'D0200F2'; 
      $skips[] = 'D0200G1'; $skips[] = 'D0200G2'; $skips[] = 'D0200H1'; $skips[] = 'D0200H2'; 
      $skips[] = 'D0200I1'; $skips[] = 'D0200I2'; 
      $skips[] = 'D0300'; 
      $skips[] = 'D0350'; 
      $skips[] = 'D0350'; 
    }

    // C0100 - pattern
    if ($D0100 == 0) {
      $skips[] = 'D0200A1'; $skips[] = 'D0200A2'; $skips[] = 'D0200B1'; $skips[] = 'D0200B2'; 
      $skips[] = 'D0200C1'; $skips[] = 'D0200C2'; $skips[] = 'D0200D1'; $skips[] = 'D0200D2'; 
      $skips[] = 'D0200E1'; $skips[] = 'D0200E2'; $skips[] = 'D0200F1'; $skips[] = 'D0200F2'; 
      $skips[] = 'D0200G1'; $skips[] = 'D0200G2'; $skips[] = 'D0200H1'; $skips[] = 'D0200H2'; 
      $skips[] = 'D0200I1'; $skips[] = 'D0200I2'; 
      $skips[] = 'D0300'; 
      $skips[] = 'D0350'; 
    }
    // check if resident interview was completed

    $D0300  = 0;

    // C0500
    if ($D0100 == 1) {
      $D0300 = $D0200A2 + $D0200B2 + $D0200C2 + $D0200D2 + $D0200E2 + $D0200F2 + $D0200G2 + $D0200H2 + $D0200I2;

      // check if empty
      $D0300_EMPTY = 0;
      if ($D0200A1 == 9) { $D0300_EMPTY++; $skips[] = 'D0200A2'; }
      if ($D0200B1 == 9) { $D0300_EMPTY++; $skips[] = 'D0200B2'; }
      if ($D0200C1 == 9) { $D0300_EMPTY++; $skips[] = 'D0200C2'; }
      if ($D0200D1 == 9) { $D0300_EMPTY++; $skips[] = 'D0200D2'; }
      if ($D0200E1 == 9) { $D0300_EMPTY++; $skips[] = 'D0200E2'; }
      if ($D0200F1 == 9) { $D0300_EMPTY++; $skips[] = 'D0200F2'; }
      if ($D0200G1 == 9) { $D0300_EMPTY++; $skips[] = 'D0200G2'; }
      if ($D0200H1 == 9) { $D0300_EMPTY++; $skips[] = 'D0200H2'; }
      if ($D0200I1 == 9) { $D0300_EMPTY++; $skips[] = 'D0200I2'; }

      if ($D0300_EMPTY >= 3) 
        $D0300 = 99;
        
      $this->data[$this->name]['C0900Z'] = $D0300;

    }

    $D0300_99 = 0;
    if ($D0200A1 == 9) $D0300_99++;
    if ($D0200B1 == 9) $D0300_99++;
    if ($D0200C1 == 9) $D0300_99++;
    if ($D0200D1 == 9) $D0300_99++;
    if ($D0200E1 == 9) $D0300_99++;
    if ($D0200F1 == 9) $D0300_99++;
    if ($D0200G1 == 9) $D0300_99++;
    if ($D0200H1 == 9) $D0300_99++;
    if ($D0200I1 == 9) $D0300_99++;
    $D0300 = 0;

    $D0300 = $D0200A2 + $D0200B2 + $D0200C2 + $D0200D2 + $D0200E2 + $D0200F2 + $D0200G2 + $D0200H2 + $D0200I2;
    if ($D0300_99 == 1) $D0300 = $D0300 * 1.125;
    if ($D0300_99 == 2) $D0300 = $D0300 * (9/(9-$D0300_99));
    if ($D0300_99 >= 3) $D0300 = 99;

    $D0300 = round($D0300);

    $this->data[$this->name]['D0300'] = $D0300;

    // check if staff interview was completed
    if ($D0300 == 1 && $D0300 != 99) {
      $skips[] = 'D0500A1'; $skips[] = 'D0500A2'; 
      $skips[] = 'D0500B1'; $skips[] = 'D0500B2'; 
      $skips[] = 'D0500C1'; $skips[] = 'D0500C2'; 
      $skips[] = 'D0500D1'; $skips[] = 'D0500D2'; 
      $skips[] = 'D0500E1'; $skips[] = 'D0500E2'; 
      $skips[] = 'D0500F1'; $skips[] = 'D0500F2'; 
      $skips[] = 'D0500G1'; $skips[] = 'D0500G2'; 
      $skips[] = 'D0500H1'; $skips[] = 'D0500H2'; 
      $skips[] = 'D0500I1'; $skips[] = 'D0500I2'; 
      $skips[] = 'D0500J1'; $skips[] = 'D0500J2'; 
    }

    if ($D0100 == 1 && $D0300 != 99) {
      $skips[] = 'D0500A1'; $skips[] = 'D0500A2'; 
      $skips[] = 'D0500B1'; $skips[] = 'D0500B2'; 
      $skips[] = 'D0500C1'; $skips[] = 'D0500C2'; 
      $skips[] = 'D0500D1'; $skips[] = 'D0500D2'; 
      $skips[] = 'D0500E1'; $skips[] = 'D0500E2'; 
      $skips[] = 'D0500F1'; $skips[] = 'D0500F2'; 
      $skips[] = 'D0500G1'; $skips[] = 'D0500G2'; 
      $skips[] = 'D0500H1'; $skips[] = 'D0500H2'; 
      $skips[] = 'D0500I1'; $skips[] = 'D0500I2'; 
      $skips[] = 'D0500J1'; $skips[] = 'D0500J2'; 
      $skips[] = 'D0600';
    }

    if ($D0300 == 99 || $D0100 == 0) {
      $D0600 = $D0500A2 + $D0500B2 + $D0500C2 + $D0500D2 + $D0500E2 + $D0500F2 + $D0500G2 + $D0500H2 + $D0500I2 + $D0500J2;
      $this->data[$this->name]['D0600'] = $D0600;
    }

    if ($D0200I1 != 1) $skips[] = 'D0350';
    if ($D0500I1 != 1) $skips[] = 'D0650';

    if (
      $A0310G == 2 && 
      $this->data['Assessment']['type'] != 'NOD' && 
      ($A0310A != '01' && $A0310A != '02' && $A0310A != '03' && $A0310A != '04' && $A0310A != '05' && $A0310A != '06') && 
      ($A0310B != '01' && $A0310B != '02' && $A0310B != '03' && $A0310B != '04' && $A0310B != '05' && $A0310B != '06')
    ) {
      foreach ($data as $key => $value) {
        $skips[] = $key;
      }
    }
    
    // B0100
    if ($B0100 == 1) {
      foreach ($data as $key => $value) {
        $skips[] = $key;
      }
      $skips[] = 'D0100';
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
  
}