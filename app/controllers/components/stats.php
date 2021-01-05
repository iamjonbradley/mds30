<?php

class StatsComponent extends Object {
  
  public $components = array('Auth');
  
  public function initialize(&$controller) {
    
    // set user details
    $this->stats['Stat']['user_id'] = $this->Auth->user('id');
    $this->stats['Stat']['group_id'] = $this->Auth->user('group_id');
    $this->stats['Stat']['facility_id'] = $this->Auth->user('facility_id');
    
    // set base details
    $this->stats['Stat']['controller'] = $controller->name;
    $this->stats['Stat']['action'] = $controller->action;
    
    // set pagination results
    if (isset($controller->params['named']['page']) && !empty($controller->params['named']['page'])) $this->stats['Stat']['page'] = $controller->params['named']['page'];
    else $this->stats['Stat']['page'] = '';
    
    if (isset($controller->params['named']['sort']) && !empty($controller->params['named']['sort'])) $this->stats['Stat']['sort'] = $controller->params['named']['sort'];
    else $this->stats['Stat']['sort'] = '';
    
    if (isset($controller->params['named']['direction']) && !empty($controller->params['named']['direction'])) $this->stats['Stat']['direction'] = $controller->params['named']['direction'];
    else $this->stats['Stat']['direction'] = '';
    
    // set passed parameters
    if (isset($controller->params['pass'][0]) && !empty($controller->params['pass'][0])) $this->stats['Stat']['param_1'] = $controller->params['pass'][0];  
    else $this->stats['Stat']['param_1'] = '';
    
    if (isset($controller->params['pass'][1]) && !empty($controller->params['pass'][1])) $this->stats['Stat']['param_2'] = $controller->params['pass'][1]; 
    else $this->stats['Stat']['param_2'] = '';
    
    if (isset($controller->params['pass'][2]) && !empty($controller->params['pass'][2])) $this->stats['Stat']['param_3'] = $controller->params['pass'][2];
    else $this->stats['Stat']['param_3'] = '';
      
    // set host information
    $this->stats['Stat']['ip_address']          = @$_SERVER['REMOTE_ADDR'];
    $this->stats['Stat']['url']                 = @$_SERVER['REQUEST_URI'];
    $this->stats['Stat']['agent']               = @$_SERVER['HTTP_USER_AGENT'];
    $this->stats['Stat']['Facility']['name']    = ClassRegistry::init('Facility')->getName($this->Auth->user('facility_id'));
    $this->stats['Stat']['Group']['name']       = ClassRegistry::init('Group')->getName($this->Auth->user('group_id'));
    $this->stats['Stat']['User']['name']        = ClassRegistry::init('User')->getName($this->Auth->user('id'));
  }
  
  public function startup () {
    ClassRegistry::init('Stat')->save($this->stats, false);
  }
  
  public function save () {
  }
  
}
