<?php

class SectionX extends AppModel {
	
	var $name = 'SectionX';
	var $useTable = 'section_x';
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

    if (isset($data['X0100'])) {
      if (array_key_exists('A0050', $data) && isset($data['A0050'])) $A0050 = $data['X0100']; else $A0050 = $this->data['SectionX']['X0100'];
    }
    else {
      if (array_key_exists('A0050', $data) && isset($data['A0050'])) $A0050 = $data['A0050']; else $A0050 = $this->data['SectionA']['A0050'];
    }


    if ($this->data['Assessment']['type'] == 'NT' && $A0050 == 1 && !isset($data['X0100'])) 
      return $skips;


    if (array_key_exists('X0150',  $data) && isset($data['X0150']))  $X0150  = $data['X0150'];  else $X0150  = '';
    if (array_key_exists('X0600F', $data) && isset($data['X0600F'])) $X0600F = $data['X0600F']; else $X0600F = '';
    if (array_key_exists('X0700A', $data) && isset($data['X0700A'])) $X0700A = $data['X0700A']; else $X0700A = '';
    if (array_key_exists('X0700B', $data) && isset($data['X0700B'])) $X0700B = $data['X0700B']; else $X0700B = '';
    if (array_key_exists('X0700C', $data) && isset($data['X0700C'])) $X0700C = $data['X0700C']; else $X0700C = '';

    if (array_key_exists('X0900A', $data) && isset($data['X0900A'])) $X0900A = $data['X0900A']; else $X0900A = '';
    if (array_key_exists('X0900B', $data) && isset($data['X0900B'])) $X0900B = $data['X0900B']; else $X0900B = '';
    if (array_key_exists('X0900C', $data) && isset($data['X0900C'])) $X0900C = $data['X0900C']; else $X0900C = '';
    if (array_key_exists('X0900D', $data) && isset($data['X0900D'])) $X0900D = $data['X0900D']; else $X0900D = '';
    if (array_key_exists('X0900E', $data) && isset($data['X0900E'])) $X0900E = $data['X0900E']; else $X0900E = '';
    if (array_key_exists('X0900Z', $data) && isset($data['X0900Z'])) $X0900Z = $data['X0900Z']; else $X0900Z = '';

    /**
     * Begin Skip Patterns
     */

    // X0100

    // X0100
    if ($A0050 == 1) {
      $skips[] = 'X0150';
      $skips[] = 'X0200A'; $skips[] = 'X0200B'; $skips[] = 'X0200C';
      $skips[] = 'X0300';
      $skips[] = 'X0400';
      $skips[] = 'X0500';
      $skips[] = 'X0600A'; $skips[] = 'X0600B'; $skips[] = 'X0600C'; $skips[] = 'X0600D'; $skips[] = 'X0600F';
      $skips[] = 'X0700A'; $skips[] = 'X0700B'; $skips[] = 'X0700C';
      $skips[] = 'X0800';
      $skips[] = 'X0900A'; $skips[] = 'X0900B'; $skips[] = 'X0900C'; $skips[] = 'X0900D'; $skips[] = 'X0900E'; $skips[] = 'X0900Z';
      $skips[] = 'X1050A'; $skips[] = 'X1050Z';
      $skips[] = 'X1100A'; $skips[] = 'X1100B'; $skips[] = 'X1100C'; $skips[] = 'X1100D'; $skips[] = 'X1100E';
    }

    if ($A0050 == 2) {
      $skips[] = 'X1050A'; $skips[] = 'X1050Z'; 
    }

    // X0600D
    if ($X0150 != 2) $skips[] = 'X0600D';

    // X0700A
    if ($X0600F != '99') $skips[] = 'X0700A';

    // X0700B
    if ($X0600F != '10' && $X0600F != '11' && $X0600F != '12') $skips[] = 'X0700B';

    // X0700C
    if ($X0600F != '01') $skips[] = 'X0700C';

    // X0900
    if ($A0050 != 2) {
      $skips[] = 'X0900A'; $skips[] = 'X0900B'; $skips[] = 'X0900C'; 
      $skips[] = 'X0900D'; $skips[] = 'X0900E'; $skips[] = 'X0900Z'; 
    }
    else {
      if ($X0900A == 0 && $X0900B == 0 && $X0900C == 0 && $X0900D == 0 && $X0900E == 0 && $X0900Z == 0)
        $this->data[$this->name]['X0900Z'] = '';
    }

    if ($this->data['Assessment']['type'] == 'NT') {
      $skips[] = 'A2300';
    }

    if ($this->data['Assessment']['item_subset'] == '1.00' && $A0050 == 1) {
      $skips[] = 'B0100';
      $skips[] = 'A2300';
      $skips[] = 'A2300';
      $skips[] = 'A2300';
      $skips[] = 'X0900A'; $skips[] = 'X0900B'; $skips[] = 'X0900C'; 
      $skips[] = 'X0900D'; $skips[] = 'X0900E'; $skips[] = 'X0900Z'; 
    }

    /**
     * Default skips
     */
    $skips[] = 'A2300';
    $skips[] = 'A0310G';
    $skips[] = 'V0100SHOW';
    $skips[] = 'B0100';

    /**
     * End Skip Patterns
     */

    foreach ($this->data[$this->name] as $key => $value) {
      if (in_array($key, $skips)) $this->data[$this->name][$key] = '';
    }

    return $skips;
  } 
  
}