<?php

class SectionE extends AppModel {
	
	var $name = 'SectionE';
	var $useTable = 'section_e';
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
    if (array_key_exists('B0100',  $data) && isset($data['B0100']))  $B0100  = $data['B0100'];  else $B0100  = $this->data['SectionB']['B0100'];
    if (array_key_exists('E0100A', $data) && isset($data['E0100A'])) $E0100A = $data['E0100A']; else $E0100A = '';
    if (array_key_exists('E0100B', $data) && isset($data['E0100B'])) $E0100B = $data['E0100B']; else $E0100B = '';
    if (array_key_exists('E0100Z', $data) && isset($data['E0100Z'])) $E0100Z = $data['E0100Z']; else $E0100Z = '';
    if (array_key_exists('E0200A', $data) && isset($data['E0200A'])) $E0200A = $data['E0200A']; else $E0200A = '';
    if (array_key_exists('E0200B', $data) && isset($data['E0200B'])) $E0200B = $data['E0200B']; else $E0200B = '';
    if (array_key_exists('E0200C', $data) && isset($data['E0200C'])) $E0200C = $data['E0200C']; else $E0200C = '';
    if (array_key_exists('E0900',  $data) && isset($data['E0900']))  $E0900  = $data['E0900'];  else $E0900  = '';

    /**
     * Begin Skip Patterns
     */
    
    // B0100
    if ($B0100 == 1) {
      foreach ($data as $key => $value)
        $skips[] = $key;
    }

    // E0100
    if ($E0100A == 0 && $E0100B == 0 && $E0100Z == 0) $this->data[$this->name]['E0100Z'] = '';

    // E0200
    $E0300 = 0;
    if (in_array($E0200A, array(1,2,3))) $E0300 = 1;
    if (in_array($E0200B, array(1,2,3))) $E0300 = 1;
    if (in_array($E0200C, array(1,2,3))) $E0300 = 1;

    if ($E0300 == 0) {
      $skips[] = 'E0500A'; $skips[] = 'E0500B'; $skips[] = 'E0500C'; 
      $skips[] = 'E0600A'; $skips[] = 'E0600B'; $skips[] = 'E0600C'; 
    }

    // E0900
    if ($E0900 == 0) {
      $skips[] = 'E1000A'; $skips[] = 'E1000B';
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