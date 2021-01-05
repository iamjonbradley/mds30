<?php

if ($this->data['SectionV']['V0200A'. $n .'E'] == 1) {
  echo $this->Form->hidden('SectionV.V0200A'. $n .'D'); // disabled memo field
  echo $this->Html->div('fields', $this->data['SectionV']['V0200A'. $n .'D']);
  echo '<div class="input text" style="line-height: 18px"><strong>NOTICE: </strong> Locked on '. $this->data['SectionV']['V0200A'. $n .'F'] .'</div>'; // locked date notice
  echo $this->Form->hidden('SectionV.V0200A'. $n .'E'); // hide locked box
}
else {
  echo $this->Form->input('SectionV.V0200A'. $n .'D', array('label' => false, 'cols' => 50)); // memo field
  echo $this->Form->input ('SectionV.V0200A'. $n .'E', array('label' => 'Lock this Care Area Assessment')); // lock box
}
?>