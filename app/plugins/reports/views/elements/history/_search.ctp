      <ul class="left-nav">
        <li class="menu">Sort by Date</li>
        <li>
          <?php
          echo $this->Form->create('Log', array('url' => '/reports/histories/view/'. $facility_id));
          echo $this->Form->input('user_id', array('type' => 'select', 'empty' => 'Select a user', 'label' => 'Select a user', 'options' => $users));
          echo $this->Form->input('start', array('label' => 'Start Date', 'type' => 'date', 'format' => 'm-d-Y', 'monthNames' => false));
          echo $this->Form->input('end', array('label' => 'End Date', 'type' => 'date', 'format' => 'm-d-Y', 'monthNames' => false));
          echo $this->Form->submit('Filter');
          echo $this->Form->end();
          ?>
        </li>
      </ul>