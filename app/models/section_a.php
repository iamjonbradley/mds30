<?php

class SectionA extends AppModel {
	
	var $name = 'SectionA';
	var $useTable = 'section_a';
	var $actsAs = array(
	  	'Logable' => array( 
		    'change' => 'full', 
		    'description_ids' => TRUE 
		  )
	  ); 
	var $belongsTo = array('Assessment');

	var $dates = array('A0900','A1600','A2200','A2300','A2400B','A2400C');
	var $optional = array('A0500D');

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
		if (array_key_exists('A0200',  $data) && isset($data['A0200']))  $A0200  = $data['A0200'];  else $A0200  = '';
		if (array_key_exists('A0900',  $data) && isset($data['A0900']))  $A0900  = $data['A0900'];  else $A0900  = '';
		if (array_key_exists('A0310A', $data) && isset($data['A0310A'])) $A0310A = $data['A0310A']; else $A0310A = '';
		if (array_key_exists('A0310F', $data) && isset($data['A0310F'])) $A0310F = $data['A0310F']; else $A0310F = '';
		if (array_key_exists('A1500',  $data) && isset($data['A1500']))  $A1500  = $data['A1500'];  else $A1500  = '';
		if (array_key_exists('A1000A', $data) && isset($data['A1000A'])) $A1000A = $data['A1000A']; else $A1000A = '';
		if (array_key_exists('A1000B', $data) && isset($data['A1000B'])) $A1000B = $data['A1000B']; else $A1000B = '';
		if (array_key_exists('A1000C', $data) && isset($data['A1000C'])) $A1000C = $data['A1000C']; else $A1000C = '';
		if (array_key_exists('A1000D', $data) && isset($data['A1000D'])) $A1000D = $data['A1000D']; else $A1000D = '';
		if (array_key_exists('A1000E', $data) && isset($data['A1000E'])) $A1000E = $data['A1000E']; else $A1000E = '';
		if (array_key_exists('A1000F', $data) && isset($data['A1000F'])) $A1000F = $data['A1000F']; else $A1000F = '';
		if (array_key_exists('A1100A', $data) && isset($data['A1100A'])) $A1100A = $data['A1100A']; else $A1100A = '';
		if (array_key_exists('A1550A', $data) && isset($data['A1550A'])) $A1550A = $data['A1550A']; else $A1550A = '';
		if (array_key_exists('A1550B', $data) && isset($data['A1550B'])) $A1550B = $data['A1550B']; else $A1550B = '';
		if (array_key_exists('A1550C', $data) && isset($data['A1550C'])) $A1550C = $data['A1550C']; else $A1550C = '';
		if (array_key_exists('A1550D', $data) && isset($data['A1550D'])) $A1550D = $data['A1550D']; else $A1550D = '';
		if (array_key_exists('A1550E', $data) && isset($data['A1550E'])) $A1550E = $data['A1550E']; else $A1550E = '';
		if (array_key_exists('A1550Z', $data) && isset($data['A1550Z'])) $A1550Z = $data['A1550Z']; else $A1550Z = '';
		if (array_key_exists('A2200',  $data) && isset($data['A2200']))  $A2200  = $data['A2200'];  else $A2200  = '';
		if (array_key_exists('A2400A', $data) && isset($data['A2400A'])) $A2400A = $data['A2400A']; else $A2400A = '';

		// set required calculations
		$AGE = parent::getAge($A0900);

    /**
     * Begin Skip Patterns
     */

    $skips[] = 'B0100';
    $skips[] = 'A0500B';
    $skips[] = 'A0500D';

  	// A0310D
  	if ($A0200 != 2) $skips[] = 'A0310D';
  	// A0310G
  	if ($A0310F!= 10 && $A0310F != 11)  $skips[] = 'A0310G';
  	// A1100
  	if ($A1100A == 0)  $skips[] = 'A1100B';
  	// A1500
  	if ($A0310A != '01' && $A0310A != '03' && $A0310A != '04' && $A0310A != '05') $skips[] = 'A1500'; 
  	// A1510
  	if ($A0310A != '01' && $A0310A != '03' && $A0310A != '04' && $A0310A != '05') $skips[] = 'A1510';
  	// A1550 
  	if (($AGE >= 22 && $A0310A != '01') || ($AGE <= 21 && $A0310A != '01' && $A0310A != '03' && $A0310A != '04' && $A0310A != '05')) {
  		$skips[] = 'A1550A'; $skips[] = 'A1550B'; $skips[] = 'A1550C';
  		$skips[] = 'A1550D'; $skips[] = 'A1550E'; $skips[] = 'A1550Z';
  	}
  	if ($A1550A == 0 && $A1550B == 0 && $A1550C == 0 && $A1550D == 0 && $A1550E == 0 && $A1550Z == 0) $this->data['SectionA']['A1550Z'] = '';
    // A1500
    if ($A1500 == 0 || $A1500 == 9 || $A1500 == '') {
      $skips[] = 'A1510A'; $skips[] = 'A1510B'; $skips[] = 'A1510C'; $skips[] = 'A1510C';
    }
  	// A2000
  	if ($A0310F != 10 && $A0310F != 11 && $A0310F != 12) $skips[] = 'A2000';
  	// A2100
  	if ($A0310F != 10 && $A0310F != 11 && $A0310F != 12) $skips[] = 'A2100';
  	// A2200
  	if ($A2200 != '05' && $A2200 != '06') $skip[] = 'A2200';
  	// A2400B
  	if ($A2400A == 0) { $skips[] = 'A2400B'; $skips[] = 'A2400C'; }

    if ($this->data['Assessment']['item_subset'] == '1.00') {
      if ($A0310A == '02'|| $A0310A == '03' || $A0310A == '04' || $A0310A == '05' || $A0310A == '06' || $A0310A == '99') {
        $skips[] = 'A1500';
      }
    }


    if ($A0310A == '02' || $A0310A == '06' || $A0310A == '99') 
      $skips[] = 'A1500';

    $skips[] = 'V0100SHOW';
    


    /**
     * End Skip Patterns
     */
		foreach ($this->data['SectionA'] as $key => $value) {
			if (in_array($key, $skips)) $this->data[$this->name][$key] = '';
		}
    
    return $skips;
	} 
	
}