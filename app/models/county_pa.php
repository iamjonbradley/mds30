<?php

class CountyPa extends AppModel {
  
  var $name = 'CountyPa';
  var $useTable = 'counties_pa';
  
  function get() {
    $list = $this->find('list', array(
      'fields' => array('CountyPa.id', 'CountyPa.name'),
      'order' => array('CountyPa.id' => 'ASC')
    ));
    
    foreach ($list as $key => $value) {
      $item[$key] = $key .' - '. $value;
    }

    ksort($item);
    
    return $item;
  }
}
