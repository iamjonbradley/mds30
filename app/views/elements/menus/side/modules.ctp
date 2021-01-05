      
      <?php if (count($allowed_facilities) != 1) { ?>
      <ul class="left-nav">
        <li class="menu">Module Menu</li>
        <?php
          foreach ($allowed_facilities as $key => $value) {
            echo '<li>'. $this->Html->link($value, array('action' => 'facility', $key)) .'</li>' ."\n";
          }
        ?>
      </ul>
      <?php } ?>