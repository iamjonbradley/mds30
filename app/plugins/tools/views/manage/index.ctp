<h2>Change Item Set</h2>

<?php
echo $this->Form->create('Assessment', array('url' => '/tools/manage/update'));
echo $this->Form->input('id', array('type' => 'text', 'label' => 'Assessment ID #'));
echo $this->Form->input('item_subset', array('type' => 'select', 'options' => array('1.00' => '1.00', '1.10' => '1.10'), 'label' => 'Item Set'));
echo $this->Form->submit('Change Item Set');
echo $this->Form->end();
?>