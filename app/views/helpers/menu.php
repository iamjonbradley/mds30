<?php

App::import('Helper', array('Session'));
class MenuHelper extends AppHelper {

	public $helpers = array('Session', 'Html');

	public $tags = array(
		'li' 	=> '<li>%s</li>',
		'start'	=> '<ul>',
		'end'	=> '</ul>',
	);

	public function __construct () {
		$this->auth = self::getUser();
	}

	public function item ($title, $link, $denied = array(), $options = array()) {
		$link = $this->Html->link($title, $link, $options);

		if (!in_array($this->auth['Group']['id'], $denied))
			return sprintf($this->tags['li'], $link);
	}

	public function getUser () {
		$this->Session = new SessionHelper();
		return $this->Session->read('Auth');
	}

}