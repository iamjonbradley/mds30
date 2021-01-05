<table width="100%">
  <tr>
    <td valign="top" class="left-column" valign="top">
      <!-- begin menus -->
      
      <?php
          if (count($allowed_facilities) == 1) {
          	foreach ($allowed_facilities as $key => $value) {
          		$facility_id = $key;
          	}
          }
         if (isset($facility_id)) {
      ?>
      <ul class="left-nav">
        <li class="menu">Sort by Date</li>
        <li>
          <?php
	          echo $this->Form->create('Report', array('url' => '/reports/rug/index/'. $facility_id, 'type' => 'get'));
	          echo $this->Form->input('start');
	          echo $this->Form->input('end');
	          echo $this->Form->submit('Filter');
	          echo $this->Form->end();
          ?>
        </li>
      </ul>
      <br />
      <?php } ?>
      <?php echo $this->element('_facility_list', array('plugin' => 'reports')); ?>
    </td>
    <td valign="top" valign="top">
      <?php 
        if (!empty($data)) {
          
          $print = '/reports/rug/printer';
          $excel = '/reports/rug/excel';
          
          $url = '';
          
          if (isset($this->params['pass'][0])) 
            $url .= '/'. $this->params['pass'][0];
					else
						$url .= '/0';
          
          if (!empty($this->params['url']['start']))
            $url .= '/'. $this->params['url']['start'];
          
          if (!empty($this->params['url']['end']))
            $url .= '/'. $this->params['url']['end'];
      
      echo $this->Html->link($this->Html->image('actions/printer.png', array('class' => 'float-right', 'style' => 'padding-left: 10px')), $print . $url, array('escape' => false, 'target' => 'new'));
      //echo $this->Html->link($this->Html->image('actions/excel.png', array('class' => 'float-right')), $excel . $url, array('escape' => false, 'target' => 'new'));
      }
      ?>
      <?php echo $this->element('_rug_report'); ?>
      <?php
      if (!$facility_id || empty($data)) {
      	echo '<h3>How to Run a RUG Report</h3>';
      	echo '
      	<ol>
      		<li>Select the facility you wish to run a report for.</li>
      		<li>Select an ARD date range.</li>
      		<li>Click Filter</li>
      	</ol>
      	';
  	  }
      ?>
    </td>
    
  </tr>
</table>