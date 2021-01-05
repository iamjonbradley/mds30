<?php

App::import('Core', array('Xml', 'Set', 'Folder', 'File')); 
class LogsController extends AppController {
  
  public $components = array('Validation', 'Caa');
  public $uses = array('Log', 'LogCopy');
  
  public function parse () {
    $data = $this->LogCopy->find('all', array(
      'conditions' => array(
        'LogCopy.change !=' => '',
        'LogCopy.model NOT' => array('Assessment', 'User', 'Bulk', 'BulkSubmissionAssessment')
      ),
    ));
    
    $i = 0;
    foreach ($data as $key => $value) {
      $this->__setRecord($value['LogCopy']);
      $i++;
    }
  }
  
  public function __setRecord ($data) {
    $model = $data['model'];
    $repair[$model] = $this->__getChanges($data['change']);
    $repair[$model]['id'] = $data['assessment_id'];
    $repair[$model]['assessment_id'] = $data['assessment_id'];
    
    if (!empty($data['assessment_id']) && !empty($data['change'])) {
      ClassRegistry::init($model)->save($repair[$model], false);
    }
  }
  
  public function __getChanges ($data) {
    
    $changes = explode(',', $data);
    
    foreach ($changes as $key => $value) {
      list ($var, $val) = explode('=>', $value);
      
      $val = str_replace(array('(', ')'), '', $val);
      $val = trim($val); 
      
      list ($field, $bleh) = explode('(', str_replace(' ', '', $var));
      
      $change[$field] = $val;
    }
    
    return $change;
  }
  
}