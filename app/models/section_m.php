<?php

class SectionM extends AppModel {
	
	var $name = 'SectionM';
	var $useTable = 'section_m';
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
    if (array_key_exists('A0310E',  $data) && isset($data['A0310E']))  $A0310E = $data['A0310E'];   else $A0310E  = $this->data['SectionA']['A0310E'];
    if (array_key_exists('M0100A',  $data) && isset($data['M0100A']))  $M0100A  = $data['M0100A'];  else $M0100A  = '';
    if (array_key_exists('M0100B',  $data) && isset($data['M0100B']))  $M0100B  = $data['M0100B'];  else $M0100B  = '';
    if (array_key_exists('M0100C',  $data) && isset($data['M0100C']))  $M0100C  = $data['M0100C'];  else $M0100C  = '';
    if (array_key_exists('M0100Z',  $data) && isset($data['M0100Z']))  $M0100Z  = $data['M0100Z'];  else $M0100Z  = '';
    if (array_key_exists('M0210',   $data) && isset($data['M0210']))   $M0210   = $data['M0210'];   else $M0210   = '';
    if (array_key_exists('M0300B1', $data) && isset($data['M0300B1'])) $M0300B1 = $data['M0300B1']; else $M0300B1 = '';
    if (array_key_exists('M0300C1', $data) && isset($data['M0300C1'])) $M0300C1 = $data['M0300C1']; else $M0300C1 = '';
    if (array_key_exists('M0300D1', $data) && isset($data['M0300D1'])) $M0300D1 = $data['M0300D1']; else $M0300D1 = '';
    if (array_key_exists('M0300E1', $data) && isset($data['M0300E1'])) $M0300E1 = $data['M0300E1']; else $M0300E1 = '';
    if (array_key_exists('M0300F1', $data) && isset($data['M0300F1'])) $M0300F1 = $data['M0300F1']; else $M0300F1 = '';
    if (array_key_exists('M0300G1', $data) && isset($data['M0300G1'])) $M0300G1 = $data['M0300G1']; else $M0300G1 = '';
    if (array_key_exists('M0900A',  $data) && isset($data['M0900A']))  $M0900A  = $data['M0900A'];  else $M0900A  = '';

    if (array_key_exists('M1040A',  $data) && isset($data['M1040A']))  $M1040A  = $data['M1040A'];  else $M1040A  = '';
    if (array_key_exists('M1040B',  $data) && isset($data['M1040B']))  $M1040B  = $data['M1040B'];  else $M1040B  = '';
    if (array_key_exists('M1040C',  $data) && isset($data['M1040C']))  $M1040C  = $data['M1040C'];  else $M1040C  = '';
    if (array_key_exists('M1040D',  $data) && isset($data['M1040D']))  $M1040D  = $data['M1040D'];  else $M1040D  = '';
    if (array_key_exists('M1040E',  $data) && isset($data['M1040E']))  $M1040E  = $data['M1040E'];  else $M1040E  = '';
    if (array_key_exists('M1040F',  $data) && isset($data['M1040F']))  $M1040F  = $data['M1040F'];  else $M1040F  = '';
    if (array_key_exists('M1040G',  $data) && isset($data['M1040G']))  $M1040G  = $data['M1040G'];  else $M1040G  = '';
    if (array_key_exists('M1040H',  $data) && isset($data['M1040H']))  $M1040H  = $data['M1040H'];  else $M1040H  = '';
    if (array_key_exists('M1040Z',  $data) && isset($data['M1040Z']))  $M1040Z  = $data['M1040Z'];  else $M1040Z  = '';

    if (array_key_exists('M1200A',  $data) && isset($data['M1200A']))  $M1200A  = $data['M1200A'];  else $M1200A  = '';
    if (array_key_exists('M1200B',  $data) && isset($data['M1200B']))  $M1200B  = $data['M1200B'];  else $M1200B  = '';
    if (array_key_exists('M1200C',  $data) && isset($data['M1200C']))  $M1200C  = $data['M1200C'];  else $M1200C  = '';
    if (array_key_exists('M1200D',  $data) && isset($data['M1200D']))  $M1200D  = $data['M1200D'];  else $M1200D  = '';
    if (array_key_exists('M1200E',  $data) && isset($data['M1200E']))  $M1200E  = $data['M1200E'];  else $M1200E  = '';
    if (array_key_exists('M1200F',  $data) && isset($data['M1200F']))  $M1200F  = $data['M1200F'];  else $M1200F  = '';
    if (array_key_exists('M1200G',  $data) && isset($data['M1200G']))  $M1200G  = $data['M1200G'];  else $M1200G  = '';
    if (array_key_exists('M1200H',  $data) && isset($data['M1200H']))  $M1200H  = $data['M1200H'];  else $M1200H  = '';
    if (array_key_exists('M1200I',  $data) && isset($data['M1200I']))  $M1200I  = $data['M1200I'];  else $M1200I  = '';
    if (array_key_exists('M1200Z',  $data) && isset($data['M1200Z']))  $M1200Z  = $data['M1200Z'];  else $M1200Z  = '';

    /**
     * Begin Skip Patterns
     */

    // M0100
    if (isset($this->data[$this->name]['M0100Z']) && $M0100A == 0 && $M0100B == 0 && $M0100C == 0 && $M0100Z == 0) $this->data[$this->name]['M0100Z'] = '';

    // M0210
    if (isset($this->data[$this->name]['M0210']) && $M0210 == 0) {
      $skips[] = 'M0300A'; 
      $skips[] = 'M0300B1'; $skips[] = 'M0300B2'; $skips[] = 'M0300B3'; 
      $skips[] = 'M0300C1'; $skips[] = 'M0300C2';
      $skips[] = 'M0300D1'; $skips[] = 'M0300D2';
      $skips[] = 'M0300E1'; $skips[] = 'M0300E1';
      $skips[] = 'M0300F1'; $skips[] = 'M0300F1';
      $skips[] = 'M0300G1'; $skips[] = 'M0300G1';
      $skips[] = 'M0610A'; $skips[] = 'M0610B'; $skips[] = 'M0610C';
      $skips[] = 'M0700'; 
      $skips[] = 'M0800A'; $skips[] = 'M0800B'; $skips[] = 'M0800C';
    }

    // M0300B1
    if (isset($this->data[$this->name]['M0300B1']) && $M0300B1 == 0) {
      $skips[] = 'M0300B2'; $skips[] = 'M0300B3'; 
    }

    // M0300C1
    if (isset($this->data[$this->name]['M0300C1']) && $M0300C1 == 0) $skips[] = 'M0300C2';

    // M0300D1
    if (isset($this->data[$this->name]['M0300D1']) && $M0300D1 == 0) $skips[] = 'M0300D2';

    // M0300E1
    if (isset($this->data[$this->name]['M0300E1']) && $M0300E1 == 0) $skips[] = 'M0300E2';

    // M0300F1
    if (isset($this->data[$this->name]['M0300F1']) && $M0300F1 == 0) $skips[] = 'M0300F2';

    // M0300G1
    if (isset($this->data[$this->name]['M0300G1']) && $M0300G1 == 0) $skips[] = 'M0300G2';

    // M0610
    if ($M0300C1 == 0 && $M0300D1 == 0 && $M0300F1 == 0) {
      $skips[] = 'M0610A'; $skips[] = 'M0610B'; $skips[] = 'M0610C'; 
    }

    // M0800 & M0900
    if ($A0310E != 0) {
      $skips[] = 'M0800A'; $skips[] = 'M0800B'; $skips[] = 'M0800C';
      $skips[] = 'M0900A'; $skips[] = 'M0900B'; $skips[] = 'M0900C'; $skips[] = 'M0900D';
    }

    // M0900
    if ($M0900A != 1) {
      $skips[] = 'M0900B'; $skips[] = 'M0900C'; $skips[] = 'M0900C'; $skips[] = 'M0900D';
    }

     // M1040
    if (
      isset($this->data[$this->name]['M1040Z']) && 
      $M1040A == 0 && $M1040B == 0 && $M1040C == 0 && $M1040D == 0 &&
      $M1040E == 0 && $M1040F == 0 && $M1040G == 0 && $M1040H == 0 &&
      $M1040Z == 0 
    ) $this->data[$this->name]['M1040Z'] = '';

     // M1200
    if (
      isset($this->data[$this->name]['M1200Z']) && 
      $M1200A == 0 && $M1200B == 0 && $M1200C == 0 && $M1200D == 0 && $M1200E == 0 && 
      $M1200F == 0 && $M1200G == 0 && $M1200H == 0 && $M1200I == 0 && $M1200Z == 0 
    ) $this->data[$this->name]['M1200Z'] = '';

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
          'SectionM.M0900A' != '', 'SectionI.M0900B' != ''
        ),
      ),
      'fields' => array(
        'Assessment.resident', 
        'SectionM.M0900A', 'SectionM.M0900B'
      ),
      'order' => array('Assessment.created' => 'DESC')
    ));
  }
	
}
?>