<?php
echo $this->Session->flash();
echo $this->Form->create('User', array('action' => 'forgot'));
echo $this->Form->input('email');
echo $this->Form->submit('Request New Password');
echo $this->Form->end();

echo $this->Html->div('forgot', 
	$this->Html->link('Login', array('action' => 'login'))
);