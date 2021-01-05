<?php

class SectionG extends AppModel {
  
  var $name = 'SectionG';
  var $useTable = 'section_g';
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
    if (array_key_exists('A0310A', $data) && isset($data['A0310A'])) $A0310A = $data['A0310A']; else $A0310A = $this->data['SectionA']['A0310A'];
    if (array_key_exists('G0600A', $data) && isset($data['G0600A'])) $G0600A = $data['G0600A']; else $G0600A = '';
    if (array_key_exists('G0600B', $data) && isset($data['G0600B'])) $G0600B = $data['G0600B']; else $G0600B = '';
    if (array_key_exists('G0600C', $data) && isset($data['G0600C'])) $G0600C = $data['G0600C']; else $G0600C = '';
    if (array_key_exists('G0600D', $data) && isset($data['G0600D'])) $G0600D = $data['G0600D']; else $G0600D = '';
    if (array_key_exists('G0600Z', $data) && isset($data['G0600Z'])) $G0600Z = $data['G0600Z']; else $G0600Z = '';
    if (array_key_exists('G0900A', $data) && isset($data['G0900A'])) $G0900A = $data['G0900A']; else $G0900A = '';
    if (array_key_exists('G0900B', $data) && isset($data['G0900B'])) $G0900B = $data['G0900B']; else $G0900B = '';

    /**
     * Begin Skip Patterns
     */

    // G0600
    if (isset($this->data[$this->name]['G0600Z']) && $G0600A == 0 && $G0600B == 0 && $G0600C == 0 && $G0600D == 0 && $G0600Z == 0) $this->data[$this->name]['G0600Z'] = '';

    // G0900
    if ($A0310A != '01') {
      $skips[] = 'G0900A';
      $skips[] = 'G0900B';
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

    ksort($this->data);

    return $skips;
  } 
  
}