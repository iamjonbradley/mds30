<?php

class SectionC extends AppModel {
	
	var $name = 'SectionC';
	var $useTable = 'section_c';
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
    if (array_key_exists('C0100',  $data) && isset($data['C0100']))  $C0100  = $data['C0100'];  else $C0100  = '';
    if (array_key_exists('C0200',  $data) && isset($data['C0200']))  $C0200  = $data['C0200'];  else $C0200  = '';
    if (array_key_exists('C0300A', $data) && isset($data['C0300A'])) $C0300A = $data['C0300A']; else $C0300A = '';
    if (array_key_exists('C0300B', $data) && isset($data['C0300B'])) $C0300B = $data['C0300B']; else $C0300B = '';
    if (array_key_exists('C0300C', $data) && isset($data['C0300C'])) $C0300C = $data['C0300C']; else $C0300C = '';
    if (array_key_exists('C0400A', $data) && isset($data['C0400A'])) $C0400A = $data['C0400A']; else $C0400A = '';
    if (array_key_exists('C0400B', $data) && isset($data['C0400B'])) $C0400B = $data['C0400B']; else $C0400B = '';
    if (array_key_exists('C0400C', $data) && isset($data['C0400C'])) $C0400C = $data['C0400C']; else $C0400C = '';
    if (array_key_exists('C0500',  $data) && isset($data['C0500']))  $C0500  = $data['C0500'];  else $C0500  = '';
    if (array_key_exists('C0600',  $data) && isset($data['C0600']))  $C0600  = $data['C0600'];  else $C0600  = '';

    if (array_key_exists('C0900A', $data) && isset($data['C0900A'])) $C0900A = $data['C0900A']; else $C0900A = '';
    if (array_key_exists('C0900B', $data) && isset($data['C0900B'])) $C0900B = $data['C0900B']; else $C0900B = '';
    if (array_key_exists('C0900C', $data) && isset($data['C0900C'])) $C0900C = $data['C0900C']; else $C0900C = '';
    if (array_key_exists('C0900D', $data) && isset($data['C0900D'])) $C0900D = $data['C0900D']; else $C0900D = '';
    if (array_key_exists('C0900Z', $data) && isset($data['C0900Z'])) $C0900Z = $data['C0900Z']; else $C0900Z = '';

    /**
     * Begin Skip Patterns
     */
    
    // B0100
    if ($B0100 == 1) {
      foreach ($data as $key => $value)
        $skips[] = $key;
    }

    
    if ($B0100 == 0 && $A0310G == 2 && $A0310A == 99 && $A0310B == 99) {
      $skips[] = 'C0100'; 
      $skips[] = 'C0200'; 
      $skips[] = 'C0300A'; $skips[] = 'C0300B';  $skips[] = 'C0300C'; 
      $skips[] = 'C0400A'; $skips[] = 'C0400B';  $skips[] = 'C0400C'; 
      $skips[] = 'C0500'; 
      $skips[] = 'C0600'; 
    }
    
    // C0100 - pattern
    if ($C0100 == 0) {
      $skips[] = 'C0200'; 
      $skips[] = 'C0300A'; $skips[] = 'C0300B';  $skips[] = 'C0300C'; 
      $skips[] = 'C0400A'; $skips[] = 'C0400B';  $skips[] = 'C0400C'; 
      $skips[] = 'C0500'; 
      $skips[] = 'C0600'; 
    }
    // check if resident interview was completed

    // C0500
    if ($C0100 == 1) {
      $C0500 = $C0200;
      $C0500 = $C0500 + $C0300A + $C0300B + $C0300C;
      $C0500 = $C0500 + $C0400A + $C0400B + $C0400C;

      if ($data['C0500'] != 99)
        $this->data[$this->name]['C0500'] = $C0500;
    }

    // check if staff interview was completed
    if ($C0100 == 1 && $C0600 != 1) {
      $skips[] = 'C0700'; 
      $skips[] = 'C0800'; 
      $skips[] = 'C0900A'; $skips[] = 'C0900B'; $skips[] = 'C0900C'; $skips[] = 'C0900D';  $skips[] = 'C0900Z'; 
      $skips[] = 'C1000'; 
      $this->data[$this->name]['C0500'] = $C0500;
    }

    if ($C0100 == '-') {
      $skips[] = 'C0200'; 
      $skips[] = 'C0300A'; $skips[] = 'C0300B';  $skips[] = 'C0300C'; 
      $skips[] = 'C0400A'; $skips[] = 'C0400B';  $skips[] = 'C0400C'; 
      $skips[] = 'C0500'; 
      $skips[] = 'C0600'; 
    }

    // C0900
    if ($C0900A == 0 && $C0900B == 0 && $C0900C == 0 && $C0900D == 0 && $C0900Z == '0') $this->data[$this->name]['C0900Z'] = '';

    if ($B0100 == 0 && $A0310G == 2 && $A0310A == 99 && $A0310B == 99) {
      $this->data['SectionC']['C0100'] = 0;
      $skips[] = 'C0200'; 
      $skips[] = 'C0300A'; $skips[] = 'C0300B';  $skips[] = 'C0300C'; 
      $skips[] = 'C0400A'; $skips[] = 'C0400B';  $skips[] = 'C0400C'; 
      $skips[] = 'C0500'; 
      $skips[] = 'C0600'; 
      $skips[] = 'C0600'; 
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