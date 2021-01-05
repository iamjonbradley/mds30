<?php

class ClockController extends ReportsAppController {
  
  var $uses = array('Resident');
  var $layout = 'ajax';
  var $components = array('Reports.Clock');
  
  function view ($id = null) {
    
    $clock = $this->Clock->render($id);
    
    $this->set(compact('clock'));
  }
  
}