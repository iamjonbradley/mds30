<?php

class CensusAndConditionsController extends FormsAppController {

  public $name = 'CensusAndConditions';
  public $uses = array('Forms.Assessment');

  public function beforeFilter () {
    parent::beforeFilter();
  }
  
  public function index () {
    
  }

  public function view ($facility = null) {


    $data = $this->Assessment->getResidentCensusDetail($facility, $facility);

    $this->data = $this->Census->structureData($data, $facility);

    $this->data['Survey'] = $this->data['data'];

    $this->set(compact('facility'));
  }  

  public function export($facility = null) {
    $this->layout = 'print';
    $cleaned = Cache::read($this->cacheName);
    $this->set(compact('facility'));
  }

  public function refresh($facility) {
    Cache::delete($this->name . $facility);
    $this->Session->setFlash('Cache Deleted', 'default', array('class' => 'success'));
    $this->redirect(array('action' => 'view', $facility), null, false);
  }
}