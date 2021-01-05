<?php

App::import('Core', 'Sanitize');
class Idc9CodesController extends AppController {
  
  public $name = 'Idc9Codes';
  public $layout = 'ajax';
  
  public function search() {
    Configure::write('debug', 0);
    $this->layout = 'popup';
    if (!empty($this->data)) {
      $data = Sanitize::clean($this->data);
      $results = $this->Idc9Code->find('all', array(
        'conditions' => array(
          'and' => array(
            'Idc9Code.D_CODE LIKE ' => $data['Idc9Code']['D_CODE'] .'%',
            'Idc9Code.D_ABBR LIKE ' => strtoupper($data['Idc9Code']['D_ABBR']) .'%'
          )
        ),
        'fields' => array('Idc9Code.D_CODE', 'Idc9Code.D_ABBR')
      ));
      $this->set('data', $results);
    }
  }
  
  public function lookup() {
    $this->render = false;
    $code = $this->params['url']['code'];
    $data = $this->Idc9Code->find('all', array(
      'conditions' => array('Idc9Code.D_CODE LIKE' => Sanitize::clean($code) .'%'),
      'fields' => array('Idc9Code.D_CODE', 'Idc9Code.D_ABBR'),
      'limit' => 5,
      'recursive' => 0
    ));
    $this->set('data', $data);
  }
}
