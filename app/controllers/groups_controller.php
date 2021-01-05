<?php

App::import('Core', 'Sanitize');
class GroupsController extends AppController {

  public $name = 'Groups';

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
  public function index ($id = null) {
    $this->paginate = array(
      'fields' => array(
        'Group.id', 'Group.name', 'Group.created', 'Group.modified',
        'Parent.name'        
      ),
      'recursive' => 0
    );
    $data = $this->paginate('Group');
    $this->set(compact('data'));
  }
  
  /**
   * Index of Groups
   * @return $data array
   */
  public function view ($id = null) {
	if (isset($id)) {
      $data = $this->Group->read(null, Sanitize::clean($id));
	  $this->set(compact('data'));	

	}
	else {
	
	  $this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));		
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
      if ($this->Group->save($data['Group'])) {
        $this->Session->setFlash('Successfully added Group', 'default', array('class' => 'success'));
        $this->redirect('index', null, false);
      }
      else {
        $this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
      }
    }
    if (isset($id)) {
      $this->data = $this->Group->read(null, Sanitize::clean($id));
    }
      $this->set('groups', $this->Group->generatetreelist($this->Auth->user('group_id')));
  }
  
  /**
   * Delete a Group
   * @param $id int this is the id of the group to bed edited
   */
  public function delete ( $id = null ) {
    if (!$id) {
      $this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
      $this->redirect($this->referer(), null, false);
    }
    $this->Group->id = Sanitize::clean($id);
    if ($this->Group->delete()) {
      $this->Session->setFlash('Successfully deleted Group', 'default', array('class' => 'success'));
      $this->redirect($this->referer(), null, false);
    }
    else {
      $this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
      $this->redirect($this->referer(), null, false);
    }
  }

}
