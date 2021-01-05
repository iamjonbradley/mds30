<?php

class ModifierHelper extends AppHelper {
  
  public function get($data) {

    $rug  = $data['SectionZ']['Z0100B'];
    $rug .= $this->__digit_1($data['SectionA']['A0310B']);
    $rug .= $this->__digit_2($data['SectionA']['A0310B'], $data['SectionA']['A0310C'], $data['SectionZ']['Z0100C']);

    if ($data['SectionZ']['Z0100B'] == 'AAA') 
      $rug = 'AAA00';

    return $rug;
  }
  
  protected function __digit_1 ($A0310B) {
    switch ($A0310B) {
      case '07': return 0; break;
      case '01': return 1; break; 
      case '06': return 1; break;
      case '02': return 2; break;
      case '03': return 3; break;
      case '04': return 4; break;
      case '05': return 5; break;
      case '99': return 6; break;
    }
  }
  
  protected function __digit_2 ($A0310B = null, $A0310C = null, $Z0100C = null) {    
    if ($A0310B == '01' || $A0310B == '02' || $A0310B == '03' || $A0310B == '04' || $A0310B == '05' || $A0310B == '06' || $A0310B == '99') return 0;
    if ($A0310B == '07' && $Z0100C == '0') return 1;
    if ($A0310B != '07' && $A0310C == '1') return 2;
    if ($A0310B == '07' && $A0310C == '1') return 3;
    if ($A0310C == '2') return 4;
    if ($A0310B != '07' && $A0310C == '3') return 5;
    if ($A0310B == '07' && $A0310C == '3') return 6;
    if ($Z0100C == '1') return 7;
  }
  
}