<?php

class AssessmentTypeComponent extends Object {
  
  public $name = 'AssessmentType';
  
  public function get($value = array()) { 
    $atype = '';
    if ($value['SectionA']['A0310A'] == '01') $atype = 'ADM';
    if ($value['SectionA']['A0310A'] == '02') $atype = 'QTR';
    if ($value['SectionA']['A0310A'] == '03') $atype = 'ANN';
    if ($value['SectionA']['A0310A'] == '04') $atype = 'SC';
    if ($value['SectionA']['A0310A'] == '05') $atype = 'SCPC';
    if ($value['SectionA']['A0310A'] == '06') $atype = 'SCPQ';
    if ($value['SectionA']['A0310A'] == '99') $atype = '';
    
    // section b
    $b = '';
    if ($value['SectionA']['A0310B'] == '01') $b = '5-DAY';
    if ($value['SectionA']['A0310B'] == '02') $b = '14-DAY';
    if ($value['SectionA']['A0310B'] == '03') $b = '30-DAY';
    if ($value['SectionA']['A0310B'] == '04') $b = '60-DAY';
    if ($value['SectionA']['A0310B'] == '05') $b = '90-DAY';
    if ($value['SectionA']['A0310B'] == '06') $b = 'RR';
    if ($value['SectionA']['A0310B'] == '07') $b = 'UNS';
    if ($value['SectionA']['A0310B'] == '99') $b = '';
    
    if (!empty($atype))  { if (!empty($b)) $atype .= '|'. $b; } 
    else  { if (!empty($b)) $atype .= $b; }
    
    $c = '';
    if ($value['SectionA']['A0310C'] == '1') $c = 'SOT';
    if ($value['SectionA']['A0310C'] == '2') $c = 'EOT';
    if ($value['SectionA']['A0310C'] == '3') $c = 'SOT/EOT';
    if ($value['SectionA']['A0310C'] == '4') $c = 'COT';
    
    if (!empty($atype))  { if (!empty($c)) $atype .= '|'. $c; } 
    else  { if (!empty($c)) $atype .= $c; }
    
    $f = '';
    if ($value['SectionA']['A0310F'] == '01') $f = 'ENT';
    if ($value['SectionA']['A0310F'] == '10') $f = 'DIS-N';
    if ($value['SectionA']['A0310F'] == '11') $f = 'DIS-A';
    if ($value['SectionA']['A0310F'] == '12') $f = 'DEATH';
    if ($value['SectionA']['A0310F'] == '99') $f = '';
    
    if (!empty($atype))  { if (!empty($f)) $atype .= '|'. $f; } 
    else  { if (!empty($f)) $atype .= $f; }
    
    return $atype;
  }
  
  public function pps($data) {
    // section b
    $b = '';
    if ($data['SectionA']['A0310B'] == '01') $b = '5';
    if ($data['SectionA']['A0310B'] == '02') $b = '14';
    if ($data['SectionA']['A0310B'] == '03') $b = '30';
    if ($data['SectionA']['A0310B'] == '04') $b = '60';
    if ($data['SectionA']['A0310B'] == '05') $b = '90';
    if ($data['SectionA']['A0310B'] == '06') $b = 'RR';
    if ($data['SectionA']['A0310B'] == '07') $b = 'UNS';
    if ($data['SectionA']['A0310B'] == '99') $b = '';
    return $b;
  }
  
  public function short($data) {
    $type = ClassRegistry::init('Isc')->get($data);

    if (array_key_exists('SectionX', $data) && isset($data['SectionX']) && $data['SectionX']['X0100'] == '3') 
      $type = 'XX';

    return $type;
  }
}
?>