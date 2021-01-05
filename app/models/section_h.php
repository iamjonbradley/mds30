<?php

class SectionH extends AppModel {
	
	var $name = 'SectionH';
	var $useTable = 'section_h';
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
    if (array_key_exists('H0200A',  $data) && isset($data['H0200A']))  $H0200A  = $data['H0200A'];  else $H0200A  = '';

    /**
     * Begin Skip Patterns
     */

    // H0200
    if ($H0200A != '') {
      if ($H0200A == 0) {
        $skips[] = 'H0200B'; $skips[] = 'H0200C'; 
      }
      if ($H0200A == 9) {
        $skips[] = 'H0200C'; 
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