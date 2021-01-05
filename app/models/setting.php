<?php

class Setting extends AppModel {
  
  function get () {
    return $this->find('list', array(
      'fields' => array('Setting.key', 'Setting.value')
    ));
  }
}
