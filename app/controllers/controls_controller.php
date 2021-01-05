<?php

Configure::write('debug', 0);
class ControlsController extends AppController {
  
  public $uses = array();
  public $layout = 'ajax';
  
  public function getAge($date = null) {
    
    // set defaults  
    if (isset($this->params['url']['day']))   $d = $this->params['url']['year'];  else $d = date('d');  
    if (isset($this->params['url']['month'])) $m = $this->params['url']['month']; else $m = date('m');
    if (isset($this->params['url']['year']))  $y = $this->params['url']['year'];  else $y = date('y'); 
      
    $y_diff = date("Y") - $y;
    
    if (date('m') >= $m && date('d') >= $d) $age = $y_diff - 1;
    else $age = $y_diff;
    
    $this->set('data', $age);
  }
  
  public function set_facility($id) {
    $session = $this->Auth->user();
    $session['User']['facility_id_previous'] = $session['User']['facility_id'];
    $session['User']['facility_id'] = $id;
    $this->Session->write('Auth', $session);
    $this->redirect($this->referer(), null, false); 
  }
}
?>