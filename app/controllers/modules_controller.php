<?php

class ModulesController extends AppController {
  
  public $name= 'Modules';
  public $uses = array('Module', 'ModulePermission');
  
  public function beforeFilter() {
    $this->allowed = $this->allowed_facilities();
  }
  
  public function index () {
    
  }
  
  public function facility($id = null) {
    if (isset($this->data)) {
      // check for permission
      foreach ($this->data['ModulePermission'] as $key => $value) {
        $exists = $this->ModulePermission->find('first', array(
          'conditions' => array('ModulePermission.module_id' => $value['module_id'], 'ModulePermission.facility_id' => $value['facility_id']),
          'fields' => array('ModulePermission.id')  
        ));
        // set the id if exists
        if (!empty($exists)) $value['id'] = $exists['ModulePermission']['id'];
        // save the record
        $this->ModulePermission->save($value, false);
      }
    }
    
    $this->__listModules();
    
    $permissions = $this->ModulePermission->find('list', array(
      'conditions' => array('ModulePermission.facility_id' => $id, 'ModulePermission.allowed' => 1),
      'fields' => array('ModulePermission.module_id', 'ModulePermission.allowed')
    ));
    
    $this->set('permissions', $permissions);
    $this->set('facility', $this->allowed[$id]);
    
  }
  
  protected function __listModules() {
    $modules = $this->Module->find('list');
    $this->set(compact('modules'));
  }
}