
      <ul class="left-nav">
        <li class="menu">Search Options</li>
        <li style="display: block">
          <?php
          echo $this->Form->create('Resident', array('url' => '/residents', 'type' => 'get'));
          
          // start facility
          if (isset($this->params['named']['facility_id'])) $facility_id = $this->params['named']['facility_id'];
          elseif (isset($this->params['url']['facility_id'])) $facility_id = $this->params['url']['facility_id'];
          else $facility_id = '';
          echo $this->Form->input('facility_id', array('label' => false, 'empty' => ' Select Facility', 'type' => 'select', 'options' => $facilities, 'selected' => $facility_id));
          ?>
          <div class="input text">
            <?php if (isset($this->data['lastname']) && !empty( $this->params['url']['lastname'])) $value =  $this->params['url']['lastname']; else $value = 'Lastname'; ?>
            <input type="text" name="lastname" size="12" value="<?php echo $value; ?>" onfocus="if(this.value == '<?php echo $value; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $value; ?>';}" />
          </div>
          <div class="input text">
            <?php if (isset($this->data['firstname']) && !empty($this->params['url']['firstname'])) $value = $this->params['url']['firstname']; else $value = 'Firstname'; ?>
            <input type="text" name="firstname" size="12" value="<?php echo $value; ?>" onfocus="if(this.value == '<?php echo $value; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $value; ?>';}" />
          </div>
          <div class="input select">
            <select name="status">
              <option>Select Status</option>
              <option value="A">Active</option>
              <option value="D">Discharged</option>
              <option value="L">On-Leave</option>
              <option value="E">Expired</option>
            </select>
          </div>
          <?php
          echo $this->Form->submit('Filter Results');
          echo $this->Form->end();
          ?>          
        </li>
      </ul>