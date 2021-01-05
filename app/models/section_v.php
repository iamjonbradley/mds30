<?php

class SectionV extends AppModel {
	
	public $name = 'SectionV';
	public $useTable = 'section_v';
  public $actsAs = array(
  	'Logable' => array( 
	    'change' => 'full', 
	    'description_ids' => TRUE 
	  )
  ); 
	public $belongsTo = array('Assessment');
  public $ignored = array('V0200B1','V0200B2','V0200C1','V0200C2','age','validated');

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
    if (array_key_exists('A0310A', $data) && isset($data['A0310A']))  $A0310A = $data['A0310A']; else $A0310A = $this->data['SectionA']['A0310A'];
    if (array_key_exists('A0310B', $data) && isset($data['A0310B']))  $A0310B = $data['A0310B']; else $A0310B = $this->data['SectionA']['A0310B'];
    if (array_key_exists('A0310E', $data) && isset($data['A0310E']))  $A0310E = $data['A0310E']; else $A0310E = $this->data['SectionA']['A0310E'];
    if (array_key_exists('V0200A01A', $data) && isset($data['V0200A01A'])) $V0200A01A = $data['V0200A01A']; else $V0200A01A = '';
    if (array_key_exists('V0200A02A', $data) && isset($data['V0200A02A'])) $V0200A02A = $data['V0200A02A']; else $V0200A02A = '';
    if (array_key_exists('V0200A03A', $data) && isset($data['V0200A03A'])) $V0200A03A = $data['V0200A03A']; else $V0200A03A = '';
    if (array_key_exists('V0200A04A', $data) && isset($data['V0200A04A'])) $V0200A04A = $data['V0200A04A']; else $V0200A04A = '';
    if (array_key_exists('V0200A05A', $data) && isset($data['V0200A05A'])) $V0200A05A = $data['V0200A05A']; else $V0200A05A = '';
    if (array_key_exists('V0200A06A', $data) && isset($data['V0200A06A'])) $V0200A06A = $data['V0200A06A']; else $V0200A06A = '';
    if (array_key_exists('V0200A07A', $data) && isset($data['V0200A07A'])) $V0200A07A = $data['V0200A07A']; else $V0200A07A = '';
    if (array_key_exists('V0200A08A', $data) && isset($data['V0200A08A'])) $V0200A08A = $data['V0200A08A']; else $V0200A08A = '';
    if (array_key_exists('V0200A09A', $data) && isset($data['V0200A09A'])) $V0200A09A = $data['V0200A09A']; else $V0200A09A = '';
    if (array_key_exists('V0200A10A', $data) && isset($data['V0200A10A'])) $V0200A10A = $data['V0200A10A']; else $V0200A10A = '';
    if (array_key_exists('V0200A11A', $data) && isset($data['V0200A11A'])) $V0200A11A = $data['V0200A11A']; else $V0200A11A = '';
    if (array_key_exists('V0200A12A', $data) && isset($data['V0200A12A'])) $V0200A12A = $data['V0200A12A']; else $V0200A12A = '';
    if (array_key_exists('V0200A13A', $data) && isset($data['V0200A13A'])) $V0200A13A = $data['V0200A13A']; else $V0200A13A = '';
    if (array_key_exists('V0200A14A', $data) && isset($data['V0200A14A'])) $V0200A14A = $data['V0200A14A']; else $V0200A14A = '';
    if (array_key_exists('V0200A15A', $data) && isset($data['V0200A15A'])) $V0200A15A = $data['V0200A15A']; else $V0200A15A = '';
    if (array_key_exists('V0200A16A', $data) && isset($data['V0200A16A'])) $V0200A16A = $data['V0200A16A']; else $V0200A16A = '';
    if (array_key_exists('V0200A17A', $data) && isset($data['V0200A17A'])) $V0200A17A = $data['V0200A17A']; else $V0200A17A = '';
    if (array_key_exists('V0200A18A', $data) && isset($data['V0200A18A'])) $V0200A18A = $data['V0200A18A']; else $V0200A18A = '';
    if (array_key_exists('V0200A19A', $data) && isset($data['V0200A19A'])) $V0200A19A = $data['V0200A19A']; else $V0200A19A = '';
    if (array_key_exists('V0200A20A', $data) && isset($data['V0200A20A'])) $V0200A20A = $data['V0200A20A']; else $V0200A20A = '';

    if (array_key_exists('V0200A01E', $data) && isset($data['V0200A01E'])) $V0200A01E = $data['V0200A01E']; else $V0200A01E = '';
    if (array_key_exists('V0200A02E', $data) && isset($data['V0200A02E'])) $V0200A02E = $data['V0200A02E']; else $V0200A02E = '';
    if (array_key_exists('V0200A03E', $data) && isset($data['V0200A03E'])) $V0200A03E = $data['V0200A03E']; else $V0200A03E = '';
    if (array_key_exists('V0200A04E', $data) && isset($data['V0200A04E'])) $V0200A04E = $data['V0200A04E']; else $V0200A04E = '';
    if (array_key_exists('V0200A05E', $data) && isset($data['V0200A05E'])) $V0200A05E = $data['V0200A05E']; else $V0200A05E = '';
    if (array_key_exists('V0200A06E', $data) && isset($data['V0200A06E'])) $V0200A06E = $data['V0200A06E']; else $V0200A06E = '';
    if (array_key_exists('V0200A07E', $data) && isset($data['V0200A07E'])) $V0200A07E = $data['V0200A07E']; else $V0200A07E = '';
    if (array_key_exists('V0200A08E', $data) && isset($data['V0200A08E'])) $V0200A08E = $data['V0200A08E']; else $V0200A08E = '';
    if (array_key_exists('V0200A09E', $data) && isset($data['V0200A09E'])) $V0200A09E = $data['V0200A09E']; else $V0200A09E = '';
    if (array_key_exists('V0200A10E', $data) && isset($data['V0200A10E'])) $V0200A10E = $data['V0200A10E']; else $V0200A10E = '';
    if (array_key_exists('V0200A11E', $data) && isset($data['V0200A11E'])) $V0200A11E = $data['V0200A11E']; else $V0200A11E = '';
    if (array_key_exists('V0200A12E', $data) && isset($data['V0200A12E'])) $V0200A12E = $data['V0200A12E']; else $V0200A12E = '';
    if (array_key_exists('V0200A13E', $data) && isset($data['V0200A13E'])) $V0200A13E = $data['V0200A13E']; else $V0200A13E = '';
    if (array_key_exists('V0200A14E', $data) && isset($data['V0200A14E'])) $V0200A14E = $data['V0200A14E']; else $V0200A14E = '';
    if (array_key_exists('V0200A15E', $data) && isset($data['V0200A15E'])) $V0200A15E = $data['V0200A15E']; else $V0200A15E = '';
    if (array_key_exists('V0200A16E', $data) && isset($data['V0200A16E'])) $V0200A16E = $data['V0200A16E']; else $V0200A16E = '';
    if (array_key_exists('V0200A17E', $data) && isset($data['V0200A17E'])) $V0200A17E = $data['V0200A17E']; else $V0200A17E = '';
    if (array_key_exists('V0200A18E', $data) && isset($data['V0200A18E'])) $V0200A18E = $data['V0200A18E']; else $V0200A18E = '';
    if (array_key_exists('V0200A19E', $data) && isset($data['V0200A19E'])) $V0200A19E = $data['V0200A19E']; else $V0200A19E = '';
    if (array_key_exists('V0200A20E', $data) && isset($data['V0200A20E'])) $V0200A20E = $data['V0200A20E']; else $V0200A20E = '';

    /**
     * Begin Skip Patterns
     */

    // V0200A01A
    if ($V0200A01A == 0) { 
      $this->data[$this->name]['V0200A01B'] = '0'; $skips[] = 'V0200A01C'; 
    }
    if ($V0200A02A == 0) { $this->data[$this->name]['V0200A02B'] = '0'; $skips[] = 'V0200A02C'; }
    if ($V0200A03A == 0) { $this->data[$this->name]['V0200A03B'] = '0'; $skips[] = 'V0200A03C'; }
    if ($V0200A04A == 0) { $this->data[$this->name]['V0200A04B'] = '0'; $skips[] = 'V0200A04C'; }
    if ($V0200A05A == 0) { $this->data[$this->name]['V0200A05B'] = '0'; $skips[] = 'V0200A05C'; }
    if ($V0200A06A == 0) { $this->data[$this->name]['V0200A06B'] = '0'; $skips[] = 'V0200A06C'; }
    if ($V0200A07A == 0) { $this->data[$this->name]['V0200A07B'] = '0'; $skips[] = 'V0200A07C'; }
    if ($V0200A08A == 0) { $this->data[$this->name]['V0200A08B'] = '0'; $skips[] = 'V0200A08C'; }
    if ($V0200A09A == 0) { $this->data[$this->name]['V0200A09B'] = '0'; $skips[] = 'V0200A09C'; }
    if ($V0200A10A == 0) { $this->data[$this->name]['V0200A10B'] = '0'; $skips[] = 'V0200A10C'; }
    if ($V0200A11A == 0) { $this->data[$this->name]['V0200A11B'] = '0'; $skips[] = 'V0200A11C'; }
    if ($V0200A12A == 0) { $this->data[$this->name]['V0200A12B'] = '0'; $skips[] = 'V0200A12C'; }
    if ($V0200A13A == 0) { $this->data[$this->name]['V0200A13B'] = '0'; $skips[] = 'V0200A13C'; }
    if ($V0200A14A == 0) { $this->data[$this->name]['V0200A14B'] = '0'; $skips[] = 'V0200A14C'; }
    if ($V0200A15A == 0) { $this->data[$this->name]['V0200A15B'] = '0'; $skips[] = 'V0200A15C'; }
    if ($V0200A16A == 0) { $this->data[$this->name]['V0200A16B'] = '0'; $skips[] = 'V0200A16C'; }
    if ($V0200A17A == 0) { $this->data[$this->name]['V0200A17B'] = '0'; $skips[] = 'V0200A17C'; }
    if ($V0200A18A == 0) { $this->data[$this->name]['V0200A18B'] = '0'; $skips[] = 'V0200A18C'; }
    if ($V0200A19A == 0) { $this->data[$this->name]['V0200A19B'] = '0'; $skips[] = 'V0200A19C'; }
    if ($V0200A20A == 0) { $this->data[$this->name]['V0200A21B'] = '0'; $skips[] = 'V0200A20C'; }

    // get current assessment caas
    $caa = $this->find('first', array(
      'conditions' => array('SectionV.id' => $this->data['Assessment']['id']),
      'recursive' => -1
    ));

    if (!empty($caa)) {
      
      if (array_key_exists('V0200A01E', $caa[$this->name]) && isset($caa[$this->name]['V0200A01E'])) $V0200A01E = $caa[$this->name]['V0200A01E']; else $V0200A01E = '';
      if (array_key_exists('V0200A02E', $caa[$this->name]) && isset($caa[$this->name]['V0200A02E'])) $V0200A02E = $caa[$this->name]['V0200A02E']; else $V0200A02E = '';
      if (array_key_exists('V0200A03E', $caa[$this->name]) && isset($caa[$this->name]['V0200A03E'])) $V0200A03E = $caa[$this->name]['V0200A03E']; else $V0200A03E = '';
      if (array_key_exists('V0200A04E', $caa[$this->name]) && isset($caa[$this->name]['V0200A04E'])) $V0200A04E = $caa[$this->name]['V0200A04E']; else $V0200A04E = '';
      if (array_key_exists('V0200A05E', $caa[$this->name]) && isset($caa[$this->name]['V0200A05E'])) $V0200A05E = $caa[$this->name]['V0200A05E']; else $V0200A05E = '';
      if (array_key_exists('V0200A06E', $caa[$this->name]) && isset($caa[$this->name]['V0200A06E'])) $V0200A06E = $caa[$this->name]['V0200A06E']; else $V0200A06E = '';
      if (array_key_exists('V0200A07E', $caa[$this->name]) && isset($caa[$this->name]['V0200A07E'])) $V0200A07E = $caa[$this->name]['V0200A07E']; else $V0200A07E = '';
      if (array_key_exists('V0200A08E', $caa[$this->name]) && isset($caa[$this->name]['V0200A08E'])) $V0200A08E = $caa[$this->name]['V0200A08E']; else $V0200A08E = '';
      if (array_key_exists('V0200A09E', $caa[$this->name]) && isset($caa[$this->name]['V0200A09E'])) $V0200A09E = $caa[$this->name]['V0200A09E']; else $V0200A09E = '';
      if (array_key_exists('V0200A10E', $caa[$this->name]) && isset($caa[$this->name]['V0200A10E'])) $V0200A10E = $caa[$this->name]['V0200A10E']; else $V0200A10E = '';
      if (array_key_exists('V0200A11E', $caa[$this->name]) && isset($caa[$this->name]['V0200A11E'])) $V0200A11E = $caa[$this->name]['V0200A11E']; else $V0200A11E = '';
      if (array_key_exists('V0200A12E', $caa[$this->name]) && isset($caa[$this->name]['V0200A12E'])) $V0200A12E = $caa[$this->name]['V0200A12E']; else $V0200A12E = '';
      if (array_key_exists('V0200A13E', $caa[$this->name]) && isset($caa[$this->name]['V0200A13E'])) $V0200A13E = $caa[$this->name]['V0200A13E']; else $V0200A13E = '';
      if (array_key_exists('V0200A14E', $caa[$this->name]) && isset($caa[$this->name]['V0200A14E'])) $V0200A14E = $caa[$this->name]['V0200A14E']; else $V0200A14E = '';
      if (array_key_exists('V0200A15E', $caa[$this->name]) && isset($caa[$this->name]['V0200A15E'])) $V0200A15E = $caa[$this->name]['V0200A15E']; else $V0200A15E = '';
      if (array_key_exists('V0200A16E', $caa[$this->name]) && isset($caa[$this->name]['V0200A16E'])) $V0200A16E = $caa[$this->name]['V0200A16E']; else $V0200A16E = '';
      if (array_key_exists('V0200A17E', $caa[$this->name]) && isset($caa[$this->name]['V0200A17E'])) $V0200A17E = $caa[$this->name]['V0200A17E']; else $V0200A17E = '';
      if (array_key_exists('V0200A18E', $caa[$this->name]) && isset($caa[$this->name]['V0200A18E'])) $V0200A18E = $caa[$this->name]['V0200A18E']; else $V0200A18E = '';
      if (array_key_exists('V0200A19E', $caa[$this->name]) && isset($caa[$this->name]['V0200A19E'])) $V0200A19E = $caa[$this->name]['V0200A19E']; else $V0200A19E = '';
      if (array_key_exists('V0200A20E', $caa[$this->name]) && isset($caa[$this->name]['V0200A20E'])) $V0200A20E = $caa[$this->name]['V0200A20E']; else $V0200A20E = '';

      if ($V0200A01A == 0) { $this->data[$this->name]['V0200A01B'] = '0'; $skips[] = 'V0200A01C'; }
      if ($V0200A02A == 0) { $this->data[$this->name]['V0200A02B'] = '0'; $skips[] = 'V0200A02C'; }
      if ($V0200A03A == 0) { $this->data[$this->name]['V0200A03B'] = '0'; $skips[] = 'V0200A03C'; }
      if ($V0200A04A == 0) { $this->data[$this->name]['V0200A04B'] = '0'; $skips[] = 'V0200A04C'; }
      if ($V0200A05A == 0) { $this->data[$this->name]['V0200A05B'] = '0'; $skips[] = 'V0200A05C'; }
      if ($V0200A06A == 0) { $this->data[$this->name]['V0200A06B'] = '0'; $skips[] = 'V0200A06C'; }
      if ($V0200A07A == 0) { $this->data[$this->name]['V0200A07B'] = '0'; $skips[] = 'V0200A07C'; }
      if ($V0200A08A == 0) { $this->data[$this->name]['V0200A08B'] = '0'; $skips[] = 'V0200A08C'; }
      if ($V0200A09A == 0) { $this->data[$this->name]['V0200A09B'] = '0'; $skips[] = 'V0200A09C'; }
      if ($V0200A10A == 0) { $this->data[$this->name]['V0200A10B'] = '0'; $skips[] = 'V0200A10C'; }
      if ($V0200A11A == 0) { $this->data[$this->name]['V0200A11B'] = '0'; $skips[] = 'V0200A11C'; }
      if ($V0200A12A == 0) { $this->data[$this->name]['V0200A12B'] = '0'; $skips[] = 'V0200A12C'; }
      if ($V0200A13A == 0) { $this->data[$this->name]['V0200A13B'] = '0'; $skips[] = 'V0200A13C'; }
      if ($V0200A14A == 0) { $this->data[$this->name]['V0200A14B'] = '0'; $skips[] = 'V0200A14C'; }
      if ($V0200A15A == 0) { $this->data[$this->name]['V0200A15B'] = '0'; $skips[] = 'V0200A15C'; }
      if ($V0200A16A == 0) { $this->data[$this->name]['V0200A16B'] = '0'; $skips[] = 'V0200A16C'; }
      if ($V0200A17A == 0) { $this->data[$this->name]['V0200A17B'] = '0'; $skips[] = 'V0200A17C'; }
      if ($V0200A18A == 0) { $this->data[$this->name]['V0200A18B'] = '0'; $skips[] = 'V0200A18C'; }
      if ($V0200A19A == 0) { $this->data[$this->name]['V0200A19B'] = '0'; $skips[] = 'V0200A19C'; }
      if ($V0200A20A == 0) { $this->data[$this->name]['V0200A21B'] = '0'; $skips[] = 'V0200A20C'; }
    }
    
    // check previous for V0100
    if (isset($data['resident_id'])) {
      $previous = $this->Assessment->getPrevious($this->id, $data['resident_id']);
    }
    else {
      $previous = $this->Assessment->getPrevious($this->data['Assessment']['id'], $this->data['Assessment']['resident']);
    }

    if (!empty($previous)) {

      if (count($previous) == 1 && $previous[0]['Assessment']['type'] == 'NT') {
        $V0100SHOW = 0;
      }
      else if (count($previous) > 1 && $previous[0]['Assessment']['type'] == 'NT') {
        $V0100SHOW = 0;
      }
      else if (count($previous) == 0) {
        $V0100SHOW = 0;
      }
      else if ($previous[0]['Assessment']['type'] == 'NQ' || $previous[0]['Assessment']['type'] == 'NC' || $previous[0]['Assessment']['type'] == 'NP') {
       $V0100SHOW = 1;
      }
      else {
       $V0100SHOW = 1;
      }

    }
    else {
      $V0100SHOW = 1;
    }

    if (
      ($A0310E == 0 && $V0100SHOW == 1) && 
      (
        $A0310A == '01' || $A0310A == '02' || $A0310A == '03' || $A0310A == '04' || $A0310A == '05' || $A0310A == '06' || 
        $A0310B == '01' || $A0310B == '02' || $A0310B == '03' || $A0310B == '04' || $A0310B == '05' || $A0310B == '06' 
      )
    ) {
      $hide_V0100 = 0;
    }
    else {
      $hide_V0100 = 1;
    }

    // V0100
    if ($A0310E != 0) {
      $skips[] = 'V0100A'; $skips[] = 'V0100B'; $skips[] = 'V0100C'; $skips[] = 'V0100D'; $skips[] = 'V0100E'; $skips[] = 'V0100F'; 
    }
    if ($A0310E != 0 && !in_array($A0310A, array('01','02','03','04','05','06')) && !in_array($A0310B, array('01','02','03','04','05','06'))) {
      $skips[] = 'V0100A'; $skips[] = 'V0100B'; $skips[] = 'V0100C'; $skips[] = 'V0100D'; $skips[] = 'V0100E'; $skips[] = 'V0100F'; 
    }
    if ($hide_V0100 == true) {  
      $skips[] = 'V0100A'; $skips[] = 'V0100B'; $skips[] = 'V0100C'; $skips[] = 'V0100D'; $skips[] = 'V0100E'; $skips[] = 'V0100F'; 
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