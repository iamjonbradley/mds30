<?php

class SectionQ extends AppModel {
	
	var $name = 'SectionQ';
	var $useTable = 'section_q';
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
    if (array_key_exists('A1600',  $data) && isset($data['A1600']))   $A1600  = $data['A1600'];  else $A1600  = $this->data['SectionA']['A1600'];
    if (array_key_exists('A0310A', $data) && isset($data['A0310A']))  $A0310A = $data['A0310A']; else $A0310A = $this->data['SectionA']['A0310A'];
    if (array_key_exists('A0310C', $data) && isset($data['A0310C']))  $A0310C = $data['A0310C']; else $A0310C = $this->data['SectionA']['A0310C'];
    if (array_key_exists('A0310E', $data) && isset($data['A0310E']))  $A0310E = $data['A0310E']; else $A0310E = $this->data['SectionA']['A0310E'];
    if (array_key_exists('A0310F', $data) && isset($data['A0310F']))  $A0310F = $data['A0310F']; else $A0310F = $this->data['SectionA']['A0310F'];
    if (array_key_exists('Q0400A', $data) && isset($data['Q0400A']))  $Q0400A = $data['Q0400A']; else $Q0400A  = '';
    if (array_key_exists('Q0400B', $data) && isset($data['Q0400B']))  $Q0400B = $data['Q0400B']; else $Q0400B  = '';
    if (array_key_exists('Q0490', $data) && isset($data['Q0490']))  $Q0490 = $data['Q0490']; else $Q0490  = '';

    /**
     * Begin Skip Patterns
     */

    // Q0300
    if ($A0310E != 1) {
      $skips[] = 'Q0300A'; $skips[] = 'Q0300B';
    }


    // Q0490
    if ($A0310A != '02' && $A0310A != '06' && $A0310A != '99') {
      $skips[] = 'Q0490'; 
    }

    if ($Q0490 == 1) {
      $skips[] = 'Q0500A'; $skips[] = 'Q0500B'; $skips[] = 'Q0550A'; $skips[] = 'Q0550B'; 
    }

    if ($Q0400B == 2) {
      $skips[] = 'Q0500A'; $skips[] = 'Q0500B'; $skips[] = 'Q0550A'; $skips[] = 'Q0550B';
    }

    if ($this->data['Assessment']['item_subset'] == '1.10') {
      // Q0400
      if ($Q0400A == 1) {
        $skips[] = 'Q0490'; $skips[] = 'Q0500A'; $skips[] = 'Q0500B'; $skips[] = 'Q0550A'; $skips[] = 'Q0550B'; 
      }
    }
    if ($this->data['Assessment']['item_subset'] == '1.00') {

      if ($Q0400A == 1) {
        $skips[] = 'Q0400B'; $skips[] = 'Q0500A'; $skips[] = 'Q0500B';
      }

      if ($Q0400B == 1) {
        $skips[] = 'Q0500A'; $skips[] = 'Q0500B';
      }

      if ($Q0400B == 2) {
        $skips[] = 'Q0500A'; $skips[] = 'Q0500B'; $skips[] = 'Q0600';
      }

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