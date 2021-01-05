<?php

if ($this->data['SectionV']['V0200A'. $n .'E'] == 1) {
  echo $this->Form->hidden('SectionV.V0200A'. $n .'D'); // disabled memo field
  echo $this->Html->div('fields', $this->data['SectionV']['V0200A'. $n .'D'], array('style' => 'width: 99%'));
  echo '<div class="input text" style="line-height: 18px"><strong>NOTICE: </strong> Locked on '. $this->data['SectionV']['V0200A'. $n .'F'] .'</div>'; // locked date notice
  echo $this->Form->hidden('SectionV.V0200A'. $n .'E'); // hide locked box
}
else {
  echo $this->Form->input('SectionV.V0200A'. $n .'D', array(
  		'label' => false, 
		'id' => 'V0200A'. $n .'-input',
  		'style' => 'width: 100%'
  	)); // memo field
  echo $this->Form->input ('SectionV.V0200A'. $n .'E', array(  // lock box
  		'label' => 'Lock CAA',
	  	'type' => 'checkbox',
  		'div' => array(
  			'style' => 'width: 195px; float: left;'	
  		)
  	));
  echo $this->Form->input ('SectionV.V0200A'. $n .'.clear', array(  // clear contents
	  	'label' => 'Clear CAA', 
	  	'type' => 'checkbox',
		'id' => 'V0200A'. $n,
		'class' => 'clear-caa',
	  	'style' => 'padding-right: 10px;',
  		'div' => array(
  			'style' => ' float: right;'	
  		)
  	));
}
?>