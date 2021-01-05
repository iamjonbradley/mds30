<?php

App::import('Core', array('Sanitize', 'File'));
class ManageController extends AppController {
  
  public $uses = array();

  public function index () {

  }

  public function update () {
    if (!empty ($this->data)) {
      $data = Sanitize::clean($this->data);
      if (ClassRegistry::init('Assessment')->save($data, false)) {
        $this->Session->setFlash('Assessment changed from to item set '. $data['Assessment']['item_subset'], 'default', array('class' => 'success'));
        $this->redirect('index');
      }
    }

  }

}