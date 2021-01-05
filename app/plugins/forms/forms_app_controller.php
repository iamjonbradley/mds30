<?php

class FormsAppController extends AppController {

	public $cacheName = '';
	public $uses = array('Forms.Assessment');
	public $components = array('Census', 'Session');
	
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	public function beforeRender() {
		parent::beforeRender();
	}
	
}