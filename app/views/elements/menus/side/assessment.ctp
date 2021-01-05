      <!-- begin menus -->
      <ul class="left-nav">
        <li class="menu">Browse By Status</li>
        <li<?php if ($type == 0) echo ' class="accepted"'; ?>>
          <?php echo $this->Html->link('Not Transmitted', array('action' => 'type', 0), array('escape' => true)); ?>
        </li>
        <li<?php if ($type == 1) echo ' class="accepted"'; ?>>
          <?php echo $this->Html->link('Transmitted', array('action' => 'type', 1), array('escape' => false)); ?>
        </li>
        <li<?php if ($type == 2) echo ' class="accepted"'; ?>>
          <?php echo $this->Html->link('Accepted', array('action' => 'type', 2), array('escape' => false)); ?>
        </li>
        <li<?php if ($type == 3) echo ' class="accepted"'; ?>>
          <?php echo $this->Html->link('Rejected', array('action' => 'type', 3), array('escape' => false)); ?>
        </li>
        <li<?php if ($type == 4) echo ' class="accepted"'; ?>>
          <?php echo $this->Html->link('NSF (Not State or Federal)', array('action' => 'type', 4), array('escape' => false)); ?>
        </li>
        <li<?php if ($type == 9) echo ' class="accepted"'; ?>>
          <?php echo $this->Html->link('Browse All Assessments', array('action' => 'type', 9), array('escape' => false)); ?>
        </li>
        <?php if ($this->Session->read('Auth.User.group_id') < 3) { ?>
        <li<?php if ($type == 99) echo ' class="accepted"'; ?>>
          <?php echo $this->Html->link('Deleted', array('action' => 'type', 99), array('escape' => false)); ?>
        </li>
        <?php } ?>
      </ul>
      
      <br />
      
      <ul class="left-nav">
        <li class="menu">Filter Results</li>
        <li style="display: block">
          <?php
          
          echo $this->Form->create('Assessment', array('url' => '/assessments/type/'. $type, 'id' => 'filter', 'type' => 'get'));
          // start facility
          if (isset($this->params['named']['facility_id'])) $facility_id = $this->params['named']['facility_id'];
          elseif (Isset($this->params['url']['facility_id'])) $facility_id = $this->params['url']['facility_id'];
          else $facility_id = '';
          echo $this->Form->input('facility_id', array('label' => false, 'empty' => ' Select Facility', 'type' => 'select', 'options' => $allowed_facilities, 'selected' => $facility_id));
          ?>
          <div class="input text">
            <?php if (isset($this->data['lastname']) && !empty( $this->params['url']['lastname'])) $value =  $this->params['url']['lastname']; else $value = 'Lastname'; ?>
            <input type="text" name="lastname" style="width:155px" value="<?php echo $value; ?>" onfocus="if(this.value == '<?php echo $value; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $value; ?>';}" />
          </div>
          <div class="input text">
            <?php if (isset($this->data['firstname']) && !empty($this->params['url']['firstname'])) $value = $this->params['url']['firstname']; else $value = 'Firstname'; ?>
            <input type="text" name="firstname" style="width:155px" value="<?php echo $value; ?>" onfocus="if(this.value == '<?php echo $value; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $value; ?>';}" />
          </div>
          <?php
          echo $this->Form->submit('Filter Results');
          echo $this->Form->end();
          ?>          
        </li>
      </ul>