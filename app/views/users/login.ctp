<?php
if ($blocked == false) {
  
  echo $this->Session->flash('auth');
  echo $this->Form->create('User', array('action' => 'login'));
  echo $this->Form->input('username');
  echo $this->Form->input('password');
  echo $this->Form->submit('Login');
  echo $this->Form->end();

}

echo $this->Html->div('forgot', 
	$this->Html->link('Forgot your password ?', array('action' => 'forgot'))
);