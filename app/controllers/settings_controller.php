<?php

App::import('Core', 'Sanitize');
class SettingsController extends AppController {

  public $name = 'Settings';

  public function beforeFilter() {
    if ($this->Auth->user('group_id') > 2) {
      $this->Session->setFlash('Sorry you do not have access to this action', 'default', array('class' => 'error'));
      $this->redirect($this->referer(), null, false);      
    }
  }

  /**
   * Index of Groups
   * @return $data array
   */
  public function index () {
    $this->paginate = array(
      'fields' => array('Setting.id', 'Setting.key', 'Setting.value'),
      'limit' => 20,
      'recursive' => -1
    );
    $data = $this->paginate('Setting');
    $this->set(compact('data'));
  }
  
  /**
   * Edit a Setting
   * @param $this->data array data to
   * @return $facilities array
   */
  public function add () {
    if (!empty($this->data)) {
      $data = Sanitize::clean($this->data);
      if ($this->Setting->save($data)) {
        $this->Session->setFlash('Successfully added Setting', 'default', array('class' => 'success'));
        $this->redirect('index', null, false);
      }
      else {
        $this->Session->setFlash('Sorry there was an error');
      }
    }
  }
  
  /**
   * Edit a Group
   * @param $id int 
   * @param $this->data array data to
   * @return $facilities array
   */
  public function edit ( $id = null ) {
    if (!empty($this->data)) {
      $data = Sanitize::clean($this->data);
      if ($this->Setting->save($data['Setting'])) {
        $this->Session->setFlash('Successfully added Setting', 'default', array('class' => 'success'));
        $this->redirect('index', null, false);
      }
      else {
        $this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
      }
    }
    if (isset($id)) {
      $this->data = $this->Setting->read(null, Sanitize::clean($id));
    }
  }
  
  /**
   * Delete a Setting
   * @param $id int this is the id of the group to bed edited
   */
  public function delete ( $id = null ) {
    if (!$id) {
      $this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
      $this->redirect($this->referer(), null, false);
    }
    $this->Setting->id = Sanitize::clean($id);
    if ($this->Setting->delete()) {
      $this->Session->setFlash('Successfully deleted Setting', 'default', array('class' => 'success'));
      $this->redirect($this->referer(), null, false);
    }
    else {
      $this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
      $this->redirect($this->referer(), null, false);
    }
  }

}
