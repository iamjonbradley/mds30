<?php

App::import('Core', 'Sanitize');
class AuthController extends ApiAppController {

  public $uses = array('ApiToken');

  public function index () {
    $data = $this->ApiToken->find('all');
    $this->set(compact('data'));
  }

  public function add () {
    return $this->edit();
  }

  public function edit ($id = null) {

    if (isset($this->data)) {
      $data = Sanitize::clean($this->data);
      if ($this->ApiToken->save($this->data)) {
        $this->Session->setFlash('Saved', 'default', array('class' => 'success'));
        $this->redirect('index', null, false);
      }
      else {
        $this->Session->setFlash('Invalid data', 'default', array('class' => 'error'));
      }
    }

    if ($id)
      $this->data = $this->ApiToken->find('all');

  }

}