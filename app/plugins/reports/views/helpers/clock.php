<?php

App::import('Component', 'Reports.Clock');
class ClockHelper extends AppHelper {
  
  var $components = array('Reports.Clock');
  var $helpers = array('Html');
  
  function __construct () {
    $this->Assessment = ClassRegistry::init('Assessment');
  }
  
  function check ($id = null) {
    $this->Clock = new ClockComponent();
    return $this->Clock->check($id);
  }
  
  function checkLate ($id = null) {
    $this->Clock = new ClockComponent();
    return $this->Clock->checkLate($id);
  }
  
}