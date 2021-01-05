<?php

class SectionJ extends AppModel {
	
	var $name = 'SectionJ';
	var $useTable = 'section_j';
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
    if (array_key_exists('A0310E', $data) && isset($data['A0310E'])) $A0310E = $data['A0310E']; else $A0310E  = $this->data['SectionA']['A0310E'];
    if (array_key_exists('A2300', $data) && isset($data['A2300'])) $A2300 = $data['A2300']; else $A2300  = $this->data['SectionA']['A2300'];

    if ($A2300 >= '2012-04-01') {
      if (array_key_exists('A0310G', $data) && isset($data['A0310G'])) $A0310G = $data['A0310G']; else $A0310G  = $this->data['SectionA']['A0310G'];
    }
    else {
      $A0310G = '';
    }

    if (array_key_exists('B0100', $data) && isset($data['B0100'])) $B0100 = $data['B0100']; else $B0100  = $this->data['SectionB']['B0100'];

    if (array_key_exists('J0200', $data) && isset($data['J0200'])) $J0200 = $data['J0200']; else $J0200 = '';
    if (array_key_exists('J0300', $data) && isset($data['J0300'])) $J0300 = $data['J0300']; else $J0300 = '';
    if (array_key_exists('J0400', $data) && isset($data['J0400'])) $J0400 = $data['J0400']; else $J0400 = '';
    if (array_key_exists('J0600A', $data) && isset($data['J0600A'])) $J0600A = $data['J0600A']; else $J0600A = '';
    if (array_key_exists('J0600B', $data) && isset($data['J0600B'])) $J0600B = $data['J0600B']; else $J0600B = '';


    
    if (array_key_exists('J0800A', $data) && isset($data['J0800A'])) $J0800A = $data['J0800A']; else $J0800A = '';
    if (array_key_exists('J0800B', $data) && isset($data['J0800B'])) $J0800B = $data['J0800B']; else $J0800B = '';
    if (array_key_exists('J0800C', $data) && isset($data['J0800C'])) $J0800C = $data['J0800C']; else $J0800C = '';
    if (array_key_exists('J0800D', $data) && isset($data['J0800D'])) $J0800D = $data['J0800D']; else $J0800D = '';
    if (array_key_exists('J0800Z', $data) && isset($data['J0800Z'])) $J0800Z = $data['J0800Z']; else $J0800Z = '';

    if (array_key_exists('J1100A', $data) && isset($data['J1100A'])) $J1100A = $data['J1100A']; else $J1100A = '';
    if (array_key_exists('J1100B', $data) && isset($data['J1100B'])) $J1100B = $data['J1100B']; else $J1100B = '';
    if (array_key_exists('J1100C', $data) && isset($data['J1100C'])) $J1100C = $data['J1100C']; else $J1100C = '';
    if (array_key_exists('J1100D', $data) && isset($data['J1100D'])) $J1100D = $data['J1100D']; else $J1100D = '';
    if (array_key_exists('J1100Z', $data) && isset($data['J1100Z'])) $J1100Z = $data['J1100Z']; else $J1100Z = '';

    if (array_key_exists('J1550A', $data) && isset($data['J1550A'])) $J1550A = $data['J1550A']; else $J1550A = '';
    if (array_key_exists('J1550B', $data) && isset($data['J1550B'])) $J1550B = $data['J1550B']; else $J1550B = '';
    if (array_key_exists('J1550C', $data) && isset($data['J1550C'])) $J1550C = $data['J1550C']; else $J1550C = '';
    if (array_key_exists('J1550D', $data) && isset($data['J1550D'])) $J1550D = $data['J1550D']; else $J1550D = '';
    if (array_key_exists('J1550Z', $data) && isset($data['J1550Z'])) $J1550Z = $data['J1550Z']; else $J1550Z = '';

    if (array_key_exists('J1800', $data) && isset($data['J1800'])) $J1800 = $data['J1800']; else $J1800 = '';

    /**
     * Begin Skip Patterns
     */

    if ($B0100 == 1) {
      $skips[] = 'J0200'; 
      $skips[] = 'J0300'; 
      $skips[] = 'J0400'; 
      $skips[] = 'J0500A'; $skips[] = 'J0500B'; 
      $skips[] = 'J0600A'; $skips[] = 'J0600B'; 
      $skips[] = 'J0700'; 
      $skips[] = 'J0800A'; $skips[] = 'J0800B';  $skips[] = 'J0800C';  $skips[] = 'J0800D'; $skips[] = 'J0800Z'; 
      $skips[] = 'J0850'; 
    }
    
    // B0100
    if ($J0200 == 0) {
      $skips[] = 'J0300'; 
      $skips[] = 'J0400'; 
      $skips[] = 'J0500A'; $skips[] = 'J0500B'; 
      $skips[] = 'J0600A'; $skips[] = 'J0600B'; 
      $skips[] = 'J0700'; 
    }
    if ($J0200 != 0 && $J0300 == 0) {
      $skips[] = 'J0400'; 
      $skips[] = 'J0500A'; $skips[] = 'J0500B'; 
      $skips[] = 'J0600A'; $skips[] = 'J0600B'; 
      $skips[] = 'J0700'; 
      $skips[] = 'J0800A'; $skips[] = 'J0800B';  $skips[] = 'J0800C';  $skips[] = 'J0800D'; $skips[] = 'J0800Z'; 
      $skips[] = 'J0850'; 
    }
    if ($J0300 == 9) {
      $skips[] = 'J0400'; 
      $skips[] = 'J0500A'; $skips[] = 'J0500B'; 
      $skips[] = 'J0600A'; $skips[] = 'J0600B'; 
      $skips[] = 'J0700'; 
    }

    if (!empty($this->data[$this->name]['J0400']) && in_array($J0400, array(1,2,3,4))) {
      $skips[] = 'J0800A'; $skips[] = 'J0800B';  $skips[] = 'J0800C';  $skips[] = 'J0800D'; $skips[] = 'J0800Z'; 
      $skips[] = 'J0850'; 
    }

    if (isset($this->data[$this->name]['J0800Z']) && $J0800A == 0 && $J0800B == 0 && $J0800C == 0 && $J0800D == 0 && $J0800Z == 0) $this->data[$this->name]['J0800Z'] = '';
    if (isset($this->data[$this->name]['J1100Z']) && $J1100A == 0 && $J1100B == 0 && $J1100C == 0 && $J1100Z == 0) $this->data[$this->name]['J1100Z'] = '';
    if (isset($this->data[$this->name]['J1550Z']) && $J1550A == 0 && $J1550B == 0 && $J1550C == 0 && $J1550D == 0 && $J1550Z == 0) $this->data[$this->name]['J1550Z'] = '';

    if ($J1800 == 0) {
      $skips[] = 'J1900A'; $skips[] = 'J1900B'; $skips[] = 'J1900C'; 
    }

    if ($A0310A != '01' && $A0310E != '1') {
      $skips[] = 'J1700A'; $skips[] = 'J1700B'; $skips[] = 'J1700C';
    }

    if ($J0600A == '' && $J0600B != '') {
      $skips[] = 'J0600A';
    }

    if ($J0600A != '' && $J0600B == '') {
      $skips[] = 'J0600B';
    }


    if ($J0800Z == 1) {
      $skips[] = 'J0850';
    }

    if (
      $A0310G == 2 && 
      $A0310A != '01' && $A0310A != '02' && $A0310A != '03' && $A0310A != '04' && $A0310A != '05' && $A0310A != '06' && 
      $A0310B != '01' && $A0310B != '02' && $A0310B != '03' && $A0310B != '04' && $A0310B != '05' && $A0310B != '06' && $A0310B != '07'
    ) {
      $skips[] = 'J0200';
      $skips[] = 'J0300';
      $skips[] = 'J0400';
      $skips[] = 'J0500A';
      $skips[] = 'J0500B';
      $skips[] = 'J0600A';
      $skips[] = 'J0600B';
    }

    if (isset($data['J0800Z']) && $data['J0800Z'] == 1) $skips[] = 'J0850';

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