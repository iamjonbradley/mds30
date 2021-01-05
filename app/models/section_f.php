<?php

class SectionF extends AppModel {
	
	var $name = 'SectionF';
	var $useTable = 'section_f';
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
    if (array_key_exists('B0100', $data) && isset($data['B0100'])) $B0100 = $data['B0100']; else $B0100 = '';
    if (array_key_exists('F0300', $data) && isset($data['F0300'])) $F0300 = $data['F0300']; else $F0300 = '';
    if (array_key_exists('F0700', $data) && isset($data['F0700'])) $F0700 = $data['F0700']; else $F0700 = '';

    if (array_key_exists('F0400A', $data) && isset($data['F0400A'])) $F0400A = $data['F0400A']; else $F0400A = '';
    if (array_key_exists('F0400B', $data) && isset($data['F0400B'])) $F0400B = $data['F0400B']; else $F0400B = '';
    if (array_key_exists('F0400C', $data) && isset($data['F0400C'])) $F0400C = $data['F0400C']; else $F0400C = '';
    if (array_key_exists('F0400D', $data) && isset($data['F0400D'])) $F0400D = $data['F0400D']; else $F0400D = '';
    if (array_key_exists('F0400E', $data) && isset($data['F0400E'])) $F0400E = $data['F0400E']; else $F0400E = '';
    if (array_key_exists('F0400F', $data) && isset($data['F0400F'])) $F0400F = $data['F0400F']; else $F0400F = '';
    if (array_key_exists('F0400G', $data) && isset($data['F0400G'])) $F0400G = $data['F0400G']; else $F0400G = '';
    if (array_key_exists('F0400H', $data) && isset($data['F0400H'])) $F0400H = $data['F0400H']; else $F0400H = '';

    if (array_key_exists('F0500A', $data) && isset($data['F0500A'])) $F0500A = $data['F0500A']; else $F0500A = '';
    if (array_key_exists('F0500B', $data) && isset($data['F0500B'])) $F0500B = $data['F0500B']; else $F0500B = '';
    if (array_key_exists('F0500C', $data) && isset($data['F0500C'])) $F0500C = $data['F0500C']; else $F0500C = '';
    if (array_key_exists('F0500D', $data) && isset($data['F0500D'])) $F0500D = $data['F0500D']; else $F0500D = '';
    if (array_key_exists('F0500E', $data) && isset($data['F0500E'])) $F0500E = $data['F0500E']; else $F0500E = '';
    if (array_key_exists('F0500F', $data) && isset($data['F0500F'])) $F0500F = $data['F0500F']; else $F0500F = '';
    if (array_key_exists('F0500G', $data) && isset($data['F0500G'])) $F0500G = $data['F0500G']; else $F0500G = '';
    if (array_key_exists('F0500H', $data) && isset($data['F0500H'])) $F0500H = $data['F0500H']; else $F0500H = '';



    /**
     * Begin Skip Patterns
     */
    
    // B0100
    if ($B0100 == 1) {
      foreach ($this->data['SectionF'] as $key => $value)
        $skips[] = $key;
    }

    // F0300
    if ($F0300 == 0) {
      $skips[] = 'F0400A'; $skips[] = 'F0400B'; $skips[] = 'F0400C'; $skips[] = 'F0400D'; 
      $skips[] = 'F0400E'; $skips[] = 'F0400F'; $skips[] = 'F0400G'; $skips[] = 'F0400H'; 
      $skips[] = 'F0500A'; $skips[] = 'F0500B'; $skips[] = 'F0500C'; $skips[] = 'F0500D'; 
      $skips[] = 'F0500E'; $skips[] = 'F0500F'; $skips[] = 'F0500G'; $skips[] = 'F0500H'; 
      $skips[] = 'F0600'; 
      $skips[] = 'F0700'; 
    }
    else {
      $F0400_99 = 0;
      if ($F0400A == 9) $F0400_99++; if ($F0400E == 9) $F0400_99++; if ($F0400B == 9) $F0400_99++; if ($F0400F == 9) $F0400_99++; 
      if ($F0400C == 9) $F0400_99++; if ($F0400G == 9) $F0400_99++; if ($F0400D == 9) $F0400_99++; if ($F0400H == 9) $F0400_99++;

      $F0500_99 = 0;
      if ($F0500A == 9) $F0500_99++; if ($F0500E == 9) $F0500_99++; if ($F0500B == 9) $F0500_99++; if ($F0500F == 9) $F0500_99++; 
      if ($F0500C == 9) $F0500_99++; if ($F0500G == 9) $F0500_99++; if ($F0500D == 9) $F0500_99++; if ($F0500H == 9) $F0500_99++;

      if (($F0400_99 + $F0500_99) < 2) {
        $F0700 = 0;
        $this->data[$this->name]['F0700'] = 0;
      }
    }

    if (!in_array('F0700', $skips) && $F0700 == 0) {
      $skips[] = 'F0800A'; $skips[] = 'F0800B'; $skips[] = 'F0800C'; $skips[] = 'F0800D'; 
      $skips[] = 'F0800E'; $skips[] = 'F0800F'; $skips[] = 'F0800G'; $skips[] = 'F0800H'; 
      $skips[] = 'F0800I'; $skips[] = 'F0800J'; $skips[] = 'F0800K'; $skips[] = 'F0800L'; 
      $skips[] = 'F0800M'; $skips[] = 'F0800N'; $skips[] = 'F0800O'; $skips[] = 'F0800P'; 
      $skips[] = 'F0800Q'; $skips[] = 'F0800R'; $skips[] = 'F0800S'; $skips[] = 'F0800T'; 
      $skips[] = 'F0800Z'; 
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