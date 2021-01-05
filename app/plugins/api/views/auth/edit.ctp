<?php

echo $this->Form->create('ApiToken', array('url' => array('controller' => 'auth', 'action' => 'edit')));
echo $this->Form->hidden('id');
echo $this->Form->input('project');
echo $this->Form->input('ip_address');

if (empty($this->data['ApiToken']['token']))
  $token = sha1(md5(microtime()));
else
  $token = $this->data['ApiToken']['token'];

echo $this->Form->input('token_value', array('value' => $token, 'size' => 50, 'label' => 'Token', 'disabled' => 'disabled'));
echo $this->Form->hidden('token', array('value' => $token));
echo $this->Form->submit();
echo $this->Form->end();