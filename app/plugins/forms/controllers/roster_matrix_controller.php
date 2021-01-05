<?php
class RosterMatrixController extends FormsAppController {

	public $name = 'RosterMatrix';
	public $uses = array('Forms.Assessment');
	public $components = array('Census');
	public $helpers = array('Vertical', 'Cache');
	public $cacheAction = array(
			'view/' => '+1 hour'
		);

	public function beforeFilter () {
		$this->Auth->allow('view');
		parent::beforeFilter();
	}

	public function index () {
		
	}

	public function view ($id = null) {
		Configure::write('debug', 0);
		if (!$id) 
			$this->redirect('index', null, false);
			

		$data = $this->Assessment->get802Detail($id);


		$this->layout = 'printing3';

		$this->set(compact('data'));
	}

}