      <!-- begin menus -->
      <ul class="left-nav">
        <li class="menu">Menu</li>
        
        <?php if($this->params['action'] != 'create') { ?>
        <?php
        $url = '/bulk/create';
        if (!empty($this->params['pass'][0])) $url .= '/'. $this->params['pass'][0];
        ?>
        <li><?php echo $this->Html->link('Create Batch File', $url, array('escape' => false)); ?></li>
        <?php } ?>
        
        <?php if($this->params['action'] != 'index') { ?>
        <?php
        $url = '/bulk/index';
        if (!empty($this->params['pass'][0])) $url .= '/'. $this->params['pass'][0];
        ?>
        <li><?php echo $this->Html->link('Bulk Submissions', $url, array('escape' => false)); ?></li>
        <?php } ?>
        
        
      </ul>
      <br />
      
      <ul class="left-nav">
        <li class="menu">Search Submission Files</li>
        <li style="display: block">
          <?php
          
        $search  = '/bulk/search';
        if (!empty($this->params['pass'][0])) $search .= '/'. $this->params['pass'][0];
          echo $this->Form->create('Search', array('url' => $search, 'id' => 'filter', 'type' => 'post'));
          echo $this->Form->input('Resident.PATFNAME', array('label' => 'First name'));
          echo $this->Form->input('Resident.PATLNAME', array('label' => 'Last name'));
          echo $this->Form->input('Assessment.id', array('label' => 'Assessment #', 'type' => 'text'));
          echo $this->Form->submit('Filter Results');
          echo $this->Form->end();
          ?>          
        </li>
      </ul>
      
      <?php if (count($allowed_facilities) != 1) { ?>
      <br />
      <ul class="left-nav">
        <li class="menu">Facilities</li>
        <?php
          foreach ($allowed_facilities as $key => $value) {
            echo '<li>'. $this->Html->link($value, '/bulk/'. $this->params['action'] .'/'.  $key) .'</li>' ."\n";
          }
        ?>
      </ul>
      <?php } ?>