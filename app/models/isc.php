<?php

class Isc extends AppModel {
  
  public $name = 'Isc';

  public function get($data) {

    if (!empty($data)) {

      if (array_key_exists('A0310A', $data['SectionA']) && isset($data['SectionA']['A0310A'])) $A0310A = $data['SectionA']['A0310A']; else $A0310A = '^';
      if (array_key_exists('A0310B', $data['SectionA']) && isset($data['SectionA']['A0310B'])) $A0310B = $data['SectionA']['A0310B']; else $A0310B = '^';
      if (array_key_exists('A0310C', $data['SectionA']) && isset($data['SectionA']['A0310C'])) $A0310C = $data['SectionA']['A0310C']; else $A0310C = '^';
      if (array_key_exists('A0310F', $data['SectionA']) && isset($data['SectionA']['A0310F'])) $A0310F = $data['SectionA']['A0310F']; else $A0310F = '^';
      if (array_key_exists('A2300', $data['SectionA']) && isset($data['SectionA']['A2300'])) $A2300 = $data['SectionA']['A2300']; else $A2300 = '';
      if (array_key_exists('A1600', $data['SectionA']) && isset($data['SectionA']['A1600'])) $A1600 = $data['SectionA']['A1600']; else $A1600 = '';

      if ($A1600 >= '2012-04-01') $data['Assessment']['item_subset'] = '1.10';
      else if ($A2300 >= '2012-04-01') $data['Assessment']['item_subset'] = '1.10';
      else $data['Assessment']['item_subset'] = '1.00';

      $code = $this->find('first', array(
          'conditions' => array(
            'Isc.A0200'   => 1,
            'Isc.A0310A'  => $A0310A,
            'Isc.A0310B'  => $A0310B,
            'Isc.A0310C'  => $A0310C,
            'Isc.A0310F'  => $A0310F,
            'Isc.itemset' => $data['Assessment']['item_subset']
          ),
          'fields' => array(
            'Isc.code'
          )
        ));
    }

    return $code['Isc']['code'];
  }

}