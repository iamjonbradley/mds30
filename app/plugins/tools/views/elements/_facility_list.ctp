<ul id="facility_menu" class="left-nav">
  <li class="menu">
    Select A Facility
  </li>
  <?php
  foreach ($allowed_facilities as $key => $value) {
    if (isset($this->params['pass'][0]) && $this->params['pass'][0] == $key)
      $name = '&raquo; <span class="selected">'. $value .'</span>';
    else
      $name = $value;
      
    echo '<li>'. $this->Html->link($name, array('action' => 'edit', $key), array('escape' => false)) .'</li>' ."\n";
  }
  ?>
</ul>