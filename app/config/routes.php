<?php

Router::parseExtensions('json');

App::import('Component', 'Session');
$this->Session = new SessionComponent();

Router::parseExtensions('csv');

$auth = $this->Session->read('Auth.User');

if (isset($_SESSION['Auth']['User']) && $_SESSION['Auth']['User']['group_id'] == 9) 
	Router::connect('/', array('controller' => 'assessments', 'action' => 'index'));
else
	Router::connect('/', array('controller' => 'dashboard', 'action' => 'index'));

  
// application specific
Router::connect('/assessments/delete/*', array('controller' => 'assessments', 'action' => 'remove'));
Router::connect('/assessments/type/*', array('controller' => 'assessments', 'action' => 'index'));


Router::connect('/ancillary', array('controller' => 'dashboard', 'action' => 'index', 'plugin' => 'ancillary'));
Router::connect('/api/mr', array('controller' => 'mr', 'action' => 'fetch', 'plugin' => 'api'));