<?php

class AssessmentTypeHelper extends AppHelper {
  
  public $name = 'AssessmentType';
  
  public function get($data = array()) { 
    $atype = '';
    if ($data['SectionA']['A0310A'] == '01') $atype = 'ADM';
    if ($data['SectionA']['A0310A'] == '02') $atype = 'QTR';
    if ($data['SectionA']['A0310A'] == '03') $atype = 'ANN';
    if ($data['SectionA']['A0310A'] == '04') $atype = 'SC';
    if ($data['SectionA']['A0310A'] == '05') $atype = 'SCPC';
    if ($data['SectionA']['A0310A'] == '06') $atype = 'SCPQ';
    if ($data['SectionA']['A0310A'] == '99') $atype = '';
    
    // section b
    $b = '';
    if ($data['SectionA']['A0310B'] == '01') $b = '5-DAY';
    if ($data['SectionA']['A0310B'] == '02') $b = '14-DAY';
    if ($data['SectionA']['A0310B'] == '03') $b = '30-DAY';
    if ($data['SectionA']['A0310B'] == '04') $b = '60-DAY';
    if ($data['SectionA']['A0310B'] == '05') $b = '90-DAY';
    if ($data['SectionA']['A0310B'] == '06') $b = 'RR';
    if ($data['SectionA']['A0310B'] == '07') $b = 'UNS';
    if ($data['SectionA']['A0310B'] == '99') $b = '';
    
    if (!empty($atype))  { if (!empty($b)) $atype .= '|'. $b; } 
    else  { if (!empty($b)) $atype .= $b; }
    
    $c = '';
    if ($data['SectionA']['A0310C'] == '1') $c = 'SOT';
    if ($data['SectionA']['A0310C'] == '2') $c = 'EOT';
    if ($data['SectionA']['A0310C'] == '3') $c = 'SOT/EOT';
    if ($data['SectionA']['A0310C'] == '4') $c = 'COT';
    
    if (!empty($atype))  { if (!empty($c)) $atype .= '|'. $c; } 
    else  { if (!empty($c)) $atype .= $c; }
    
    $f = '';
    if ($data['SectionA']['A0310F'] == '01') $f = 'ENT';
    if ($data['SectionA']['A0310F'] == '10') $f = 'DIS-N';
    if ($data['SectionA']['A0310F'] == '11') $f = 'DIS-A';
    if ($data['SectionA']['A0310F'] == '12') $f = 'DEATH';
    if ($data['SectionA']['A0310F'] == '99') $f = '';
    
    if (!empty($atype))  { if (!empty($f)) $atype .= '|'. $f; } 
    else  { if (!empty($f)) $atype .= $f; }
    
    return $atype;
  }
  
  
  public function short($data) {
    $type = ClassRegistry::init('Isc')->get($data);

    return $type;
  }
}
?>