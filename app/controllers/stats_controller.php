<?php

class StatsController extends AppController {
  
  public $name = 'Stats';
  public $helpers = array('Time');
  
  public function beforeFilter() {
    if ($this->Auth->user('group_id') != 1)
      $this->redirect($this->referer());
  }
  
  public function index () {
    
    $conditions = array();
    
    // sort through filters data
    $get = $this->params['url'];
    if (!empty($get['group_id'])) $conditions[] = array('Stat.group_id' => $get['group_id']);
    if (!empty($get['user_id']))  $conditions[] = array('Stat.user_id'  => $get['user_id']);
    
    $named = $this->params['named'];
    if (!empty($named['group_id'])) $conditions[] = array('Stat.group_id' => $named['group_id']);
    if (!empty($named['user_id']))  $conditions[] = array('Stat.user_id'  => $named['user_id']);
    
    // set the conditions
    $this->paginate = array(
      'conditions' => $conditions,
      'limit' => '25',
      'callbacks' => true,
      'order' => array('Stat.created' => 'DESC')
    );
    
    $data = $this->paginate('Stat');
    
    // get the list of other data
    $groups = $this->Stat->Group->find('list', array('order' => array('Group.id' => 'ASC')));
    $users = $this->Stat->User->find('list', array('order' => array('User.name' => 'ASC')));
    
    // set the data
    $this->set(compact('data', 'groups', 'users'));
  }
}
