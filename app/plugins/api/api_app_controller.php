<?php

class ApiAppController extends AppController {
	
	public $components = array(
    'RequestHandler',
    'Auth'
  );

	public function beforeFilter() {
    $this->Auth->allow('*');
		$this->RequestHandler->setContent('json', 'text/x-json');
    if (self::verify ($this->params['pass'][0], $_SERVER['REMOTE_ADDR']) == false) die;
  }

  public function verify ($token, $ip) {
    return ClassRegistry::init('Api.ApiToken')->checkAuth($token, $ip);
  }
	
}