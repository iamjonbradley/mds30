
      <!-- begin menus -->
      
      <ul class="left-nav">
        <li class="menu">Menu</li>
        <li><?php echo $this->Html->link('List Residents', array('action' => 'index'), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link('Add Resident', array('action' => 'edit'), array('escape' => false)); ?></li>
      </ul>
      
      <br />
      
      <?php echo $this->element('../residents/_search_form'); ?>