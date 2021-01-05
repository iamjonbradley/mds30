<?php

class State extends AppModel {
  
  var $name = 'State';
  
  function getList() {
    return $this->find('list', array(
      'fields' => array('State.state_code', 'State.name')  
    ));
  }
}