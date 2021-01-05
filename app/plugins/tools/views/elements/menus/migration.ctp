<ul class="left-nav">
  <li class="menu">Facilities</li>
  <?php
    foreach ($data as $key => $value) {
      echo '<li>'. $this->Html->link($value, '/tools/migrations/'. $this->params['action'] .'/'.  $key) .'</li>' ."\n";
    }
  ?>
</ul>
