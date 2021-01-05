      <ul class="left-nav">
        <li class="menu">Menu</li>
        <li><?php echo $this->Html->link('All Ticket', array('controller' => 'tickets', 'action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('My Tickets', array('controller' => 'tickets', 'action' => 'index', 'submitted'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add Ticket', array('controller' => 'tickets', 'action' => 'add'), array('escape' => false)); ?></li>
      </ul>
      <p>&nbsp;</p>
      <ul class="left-nav">
        <li class="menu">Filter Results</li>
        <?php
        foreach ($statuses as $key => $value) {
          echo '<li>';
          echo $this->Html->link(ucwords($value), array('controller' => 'tickets', 'action' => 'index', $key), array('escape' => false));
          echo '</li>';
        }

        ?>
      </ul>
      <?php
      $search = $this->Session->read('Search.Ticket');
      if (!empty($search)) {
      ?>
      <p>&nbsp;</p>
      <ul class="left-nav">
        <li class="menu">Last Search</li>
        <?php
          echo '<li>';
          echo $this->Html->link($search['keyword'], '/tickets?keyword='. $search['keyword']);
          echo '</li>';
        ?>
      </ul>
      <?php
      }
      ?>
      <p>&nbsp;</p>
      <ul class="left-nav">
        <li class="menu">Search</li>
        <li>
        <?php
        echo $this->Form->create('Ticket', array('action' => 'index', 'type' => 'get'));
        echo $this->Form->input('keyword', array('size' => 12));
        echo $this->Form->submit('Search');
        echo $this->Form->end();
        ?>
        </li>
      </ul>