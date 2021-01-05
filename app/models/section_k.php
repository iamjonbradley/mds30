<?php

class SectionK extends AppModel {
	
	var $name = 'SectionK';
	var $useTable = 'section_k';
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
    if (array_key_exists('A2300', $data) && isset($data['A2300'])) $A2300 = $data['A2300']; else $A2300  = $this->data['SectionA']['A2300'];

    if ($A2300 >= '2012-04-01') {
      if (array_key_exists('A0310G', $data) && isset($data['A0310G'])) $A0310G = $data['A0310G']; else $A0310G  = $this->data['SectionA']['A0310G'];
    }
    else {
      $A0310G = '';
    }

    if (array_key_exists('A1600', $data) && isset($data['A1600'])) $A1600 = $data['A1600']; else $A1600  = $this->data['SectionA']['A1600'];
    if (array_key_exists('A2300', $data) && isset($data['A2300'])) $A2300 = $data['A2300']; else $A2300  = $this->data['SectionA']['A2300'];
    if (array_key_exists('K0100A',  $data) && isset($data['K0100A']))  $K0100A  = $data['K0100A'];  else $K0100A  = '';
    if (array_key_exists('K0100B',  $data) && isset($data['K0100B']))  $K0100B  = $data['K0100B'];  else $K0100B  = '';
    if (array_key_exists('K0100C',  $data) && isset($data['K0100C']))  $K0100C  = $data['K0100C'];  else $K0100C  = '';
    if (array_key_exists('K0100D',  $data) && isset($data['K0100D']))  $K0100D  = $data['K0100D'];  else $K0100D  = '';
    if (array_key_exists('K0100Z',  $data) && isset($data['K0100Z']))  $K0100Z  = $data['K0100Z'];  else $K0100Z  = '';

    if (array_key_exists('K0510A1',  $data) && isset($data['K0510A1']))  $K0510A1  = $data['K0510A1'];  else $K0510A1  = '';
    if (array_key_exists('K0510B1',  $data) && isset($data['K0510B1']))  $K0510B1  = $data['K0510B1'];  else $K0510B1  = '';
    if (array_key_exists('K0510C1',  $data) && isset($data['K0510C1']))  $K0510C1  = $data['K0510C1'];  else $K0510C1  = '';
    if (array_key_exists('K0510D1',  $data) && isset($data['K0510D1']))  $K0510D1  = $data['K0510D1'];  else $K0510D1  = '';
    if (array_key_exists('K0510Z1',  $data) && isset($data['K0510Z1']))  $K0510Z1  = $data['K0510Z1'];  else $K0510Z1  = '';

    if (array_key_exists('K0510A2',  $data) && isset($data['K0510A2']))  $K0510A2  = $data['K0510A2'];  else $K0510A2  = '';
    if (array_key_exists('K0510B2',  $data) && isset($data['K0510B2']))  $K0510B2  = $data['K0510B2'];  else $K0510B2  = '';
    if (array_key_exists('K0510C2',  $data) && isset($data['K0510C2']))  $K0510C2  = $data['K0510C2'];  else $K0510C2  = '';
    if (array_key_exists('K0510D2',  $data) && isset($data['K0510D2']))  $K0510D2  = $data['K0510D2'];  else $K0510D2  = '';
    if (array_key_exists('K0510Z2',  $data) && isset($data['K0510Z2']))  $K0510Z2  = $data['K0510Z2'];  else $K0510Z2  = '';
    if (array_key_exists('K0500A',   $data) && isset($data['K0500A']))   $K0500A   = $data['K0500A'];   else $K0500A   = '';
    if (array_key_exists('K0500B',   $data) && isset($data['K0500B']))   $K0500B   = $data['K0500B'];   else $K0500B   = '';

    /**
     * Begin Skip Patterns
     */


    if (isset($this->data[$this->name]['K0100Z']) && $K0100A == 0 && $K0100B == 0 && $K0100C == 0 && $K0100D == 0 && $K0100Z == 0) $this->data[$this->name]['K0100Z'] = '';
    if (isset($this->data[$this->name]['K0510Z1']) && $K0510A1 == 0 && $K0510B1 == 0 && $K0510C1 == 0 && $K0510D1 == 0 && $K0510Z1 == 0) $this->data[$this->name]['K0510Z1'] = '';

    if (isset($this->data[$this->name]['K0510Z2'])) {
      if ($K0510A2 == 0 && $K0510B2 == 0 && $K0510C2 == 0 && $K0510D2 == 0 && $K0510Z2 == 0) { 
        $this->data[$this->name]['K0510Z2'] = '';
      }
    }

    if (parent::countDays($A1600, $A2300) >= 7) {
      $K0510A1 = 0; $K0510B1 = 0; $K0510C1 = 0; $K0510D1 = 0; $K0510Z1 = 0;
      $skips[] = 'K0510A1'; $skips[] = 'K0510B1'; $skips[] = 'K0510C1'; $skips[] = 'K0510D1'; $skips[] = 'K0510Z1'; 
    } 

    if ($K0510Z1 == 1) {
      $this->data[$this->name]['K0510A1'] = 0; $this->data[$this->name]['K0510B1'] = 0; 
      $this->data[$this->name]['K0510C1'] = 0; $this->data[$this->name]['K0510D1'] = 0; 
    }

    if ($K0510Z2 == 1) {
      $this->data[$this->name]['K0510A2'] = 0; $this->data[$this->name]['K0510B2'] = 0; 
      $this->data[$this->name]['K0510C2'] = 0; $this->data[$this->name]['K0510D2'] = 0; 
    }

    if ($A0310G == 2 && $A0310A == '99' && $A0310B == '99') {
      $skips[] = 'K0510C1'; $skips[] = 'K0510C2'; $skips[] = 'K0510C3'; $skips[] = 'K0510C1'; 
    }


    if ($K0510A1 == 0 && $K0510A2 == 0 && $K0510B1 == 0 && $K0510B2 == 0 && $K0510B2 == 0 && $this->data['Assessment']['item_subset'] == '1.10') {
      $skips[] = 'K0700A'; $skips[] = 'K0700B'; 
    }

    if (($K0500A == 0 && $K0500B == 0) && $this->data['Assessment']['item_subset'] == '1.00') {
      $skips[] = 'K0700A'; $skips[] = 'K0700B'; 
    }

    if (
      $A0310G == 2 && 
      ($A0310A != '01' && $A0310A != '02' && $A0310A != '03' && $A0310A != '04' && $A0310A != '05' && $A0310A != '06') && 
      ($A0310B != '01' && $A0310B != '02' && $A0310B != '03' && $A0310B != '04' && $A0310B != '05' && $A0310B != '06' && $A0310B != '07')
    ) {
      $skips[] = 'K0510C1'; $skips[] = 'K0510C2'; 
      $skips[] = 'K0510D1'; $skips[] = 'K0510D2'; 
      $skips[] = 'K0510Z1'; $skips[] = 'K0510Z2'; 
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