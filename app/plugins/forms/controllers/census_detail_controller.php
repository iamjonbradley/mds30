<?php

class CensusDetailController extends FormsAppController {

  public $name = 'CensusDetail';
  public $uses = array('Forms.Assessment');

  public function beforeFilter () {
    parent::beforeFilter();
  }

  public function index () {
    

  }

  public function view ($facility = null) {

    Controller::loadModel('Form.Assessment');

  	$data = $this->Assessment->getResidentCensusDetail($facility);

  	$cleaned = $this->Census->structureData($data, $facility);

  	$this->set(compact('cleaned', 'facility'));

  }

  public function export ($facility) {
    $this->layout = 'print';
    $cleaned = Cache::read($this->cacheName);
    $this->set('cleaned', $cleaned);
  }

  public function refresh($facility) {
    Cache::delete($this->cacheName);
    $this->Session->setFlash('Cache Deleted', 'default', array('class' => 'success'));
    $this->redirect(array('action' => 'view', $facility), null, false);
  }

}