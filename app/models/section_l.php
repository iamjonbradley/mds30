<?php

class SectionL extends AppModel {
	
	var $name = 'SectionL';
	var $useTable = 'section_l';
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
    if (array_key_exists('L0200A', $data) && isset($data['L0200A'])) $L0200A = $data['L0200A']; else $L0200A = '';
    if (array_key_exists('L0200B', $data) && isset($data['L0200B'])) $L0200B = $data['L0200B']; else $L0200B = '';
    if (array_key_exists('L0200C', $data) && isset($data['L0200C'])) $L0200C = $data['L0200C']; else $L0200C = '';
    if (array_key_exists('L0200D', $data) && isset($data['L0200D'])) $L0200D = $data['L0200D']; else $L0200D = '';
    if (array_key_exists('L0200E', $data) && isset($data['L0200E'])) $L0200E = $data['L0200E']; else $L0200E = '';
    if (array_key_exists('L0200F', $data) && isset($data['L0200F'])) $L0200F = $data['L0200F']; else $L0200F = '';
    if (array_key_exists('L0200G', $data) && isset($data['L0200G'])) $L0200G = $data['L0200G']; else $L0200G = '';
    if (array_key_exists('L0200Z', $data) && isset($data['L0200Z'])) $L0200Z = $data['L0200Z']; else $L0200Z = '';

    /**
     * Begin Skip Patterns
     */

    if (
      isset($this->data[$this->name]['L0200Z']) && 
      $L0200A == 0 && $L0200B == 0 && $L0200C == 0 && $L0200D == 0 && 
      $L0200E == 0 && $L0200F == 0 && $L0200G == 0 && $L0200Z == 0
    ) $this->data[$this->name]['L0200Z'] = '';

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