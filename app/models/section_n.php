<?php

class SectionN extends AppModel {
	
	public $name = 'SectionN';
	public $useTable = 'section_n';
  public $actsAs = array(
  	'Logable' => array( 
	    'change' => 'full', 
	    'description_ids' => TRUE 
	  )
  ); 
	public $belongsTo = array('Assessment');

  public function beforeValidate () {
    parent::validateModel();
  }

  public function afterSave () {
    debug ($this->id);
    $this->Assessment->Resident->ResidentDrug->storeUpdate($this->data['SectionN']['resident_id'], $this->data['SectionN']['facility_id'], $this->data);
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
    if (array_key_exists('N0300', $data) && isset($data['N0300'])) $N0300 = $data['N0300']; else $N0300 = '';

    /**
     * Begin Skip Patterns
     */

    // N0300
    if (isset($this->data[$this->name]['N0300']) && $N0300 == 0) {
      $skips[] = 'N0350A'; $skips[] = 'N0350B'; 
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