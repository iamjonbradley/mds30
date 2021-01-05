<?php

class HistoriesController extends ReportsAppController {
  
  public $name = 'Histories';
  public $uses = array();
  
  public function beforeFilter () {
    parent::beforeFilter();
    Controller::loadModel('User');
    Controller::loadModel('Facility');
  }
  
  public function index ($facility_id = null) {
    self::setData($facility_id);
  }
  
  public function view ($facility_id = null) {
    self::setData($facility_id);
    
    if (!isset($this->data))
      $this->render('index');
    
  }
  
  private function setData ($facility_id = null) {
    
    $data = null;
    
    if (!empty($this->data)) {    
      Controller::loadModel('Log');
      
      // clean post data
      $conditions['Log.user_id'] = $this->data['Log']['user_id'];
      
      // set start
      $start = $this->data['Log']['start']['year'] .'-'. $this->data['Log']['start']['month'] .'-'. $this->data['Log']['start']['day'];
      $conditions['Log.created >='] = $start;
      
      // set end
      $end = $this->data['Log']['end']['year'] .'-'. $this->data['Log']['end']['month'] .'-'. $this->data['Log']['end']['day'];
      $conditions['Log.created <='] = $end;
      
      // set model to look up
      $conditions['Log.model !='] = 'Assessment';
      
      // check the logs
      $data = $this->Log->find('all', array(
        'conditions' => $conditions,
        'group' => 'Log.model_id'
      ));
    }   
    
    
    self::setUsers($facility_id);
    $this->set(compact('facility_id', 'data'));
  }
  
  private function setUsers ($facility_id = null) {
    $data = parent::getUsersList($facility_id);
    $this->set('users', $data);
  }
}
