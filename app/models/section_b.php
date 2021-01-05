<?php

class SectionB extends AppModel {
	
	var $name = 'SectionB';
	var $useTable = 'section_b';
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
    if (array_key_exists('B0100',  $data) && isset($data['B0100']))  $B0100  = $data['B0100'];  else $B0100  = '';

    /**
     * Default skips
     */
    $skips[] = 'A0310G';
    $skips[] = 'V0100SHOW';

    /**
     * Begin Skip Patterns
     */

    if ($B0100 == 1) {
      $skips[] = 'B0200'; $skips[] = 'B0300'; $skips[] = 'B0600'; 
      $skips[] = 'B0700'; $skips[] = 'B0800'; $skips[] = 'B1000'; 
      $skips[] = 'B1200'; 
    }

    /**
     * End Skip Patterns
     */

    foreach ($this->data[$this->name] as $key => $value) {
      if (in_array($key, $skips)) $this->data[$this->name][$key] = '';
    }

    return $skips;
  } 
	
}