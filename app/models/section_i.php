<?php

class SectionI extends AppModel {
	
	var $name = 'SectionI';
	var $useTable = 'section_i';
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

    if (array_key_exists('I0900',  $data) && isset($data['I0900']))  $I0900  = $data['I0900'];  else $I0900  = '';
    if (array_key_exists('I5350',  $data) && isset($data['I5350']))  $I5350  = $data['I5350'];  else $I5350  = '';
    if (array_key_exists('I8000A', $data) && isset($data['I8000A'])) $I8000A = $data['I8000A']; else $I8000A = '';
    if (array_key_exists('I8000B', $data) && isset($data['I8000B'])) $I8000B = $data['I8000B']; else $I8000B = '';
    if (array_key_exists('I8000C', $data) && isset($data['I8000C'])) $I8000C = $data['I8000C']; else $I8000C = '';
    if (array_key_exists('I8000D', $data) && isset($data['I8000D'])) $I8000D = $data['I8000D']; else $I8000D = '';
    if (array_key_exists('I8000E', $data) && isset($data['I8000E'])) $I8000E = $data['I8000E']; else $I8000E = '';
    if (array_key_exists('I8000F', $data) && isset($data['I8000F'])) $I8000F = $data['I8000F']; else $I8000F = '';
    if (array_key_exists('I8000G', $data) && isset($data['I8000G'])) $I8000G = $data['I8000G']; else $I8000G = '';
    if (array_key_exists('I8000H', $data) && isset($data['I8000H'])) $I8000H = $data['I8000H']; else $I8000H = '';
    if (array_key_exists('I8000I', $data) && isset($data['I8000I'])) $I8000I = $data['I8000I']; else $I8000I = '';
    if (array_key_exists('I8000J', $data) && isset($data['I8000J'])) $I8000J = $data['I8000J']; else $I8000J = '';

    /**
     * Begin Skip Patterns
     */

    // clear I8000
    if ($I8000A == '') $skips[] = 'I8000A'; if ($I8000B == '') $skips[] = 'I8000B'; if ($I8000C == '') $skips[] = 'I8000C'; 
    if ($I8000D == '') $skips[] = 'I8000D'; if ($I8000E == '') $skips[] = 'I8000E'; if ($I8000F == '') $skips[] = 'I8000F'; 
    if ($I8000G == '') $skips[] = 'I8000G'; if ($I8000H == '') $skips[] = 'I8000H'; if ($I8000I == '') $skips[] = 'I8000I'; 
    if ($I8000J == '') $skips[] = 'I8000J'; 

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

  function findLast($id) {
    return $this->find('first', array(
      'conditions' => array(
        'Assessment.resident' => $id,
        'or' => array(
          'SectionI.I8000A' != '', 'SectionI.I8000B' != '', 'SectionI.I8000C' != '', 'SectionI.I8000D' != '', 
          'SectionI.I8000E' != '', 'SectionI.I8000F' != '', 'SectionI.I8000G' != '', 'SectionI.I8000H' != '', 
          'SectionI.I8000I' != '', 'SectionI.I8000J' != '', 
        ),
      ),
      'fields' => array(
        'Assessment.resident', 
        'SectionI.I8000A', 'SectionI.I8000B', 'SectionI.I8000C', 'SectionI.I8000D', 'SectionI.I8000E', 
        'SectionI.I8000F', 'SectionI.I8000G', 'SectionI.I8000H', 'SectionI.I8000I', 'SectionI.I8000J', 
      ),
      'order' => array('Assessment.created' => 'DESC')
    ));
  }
	
}