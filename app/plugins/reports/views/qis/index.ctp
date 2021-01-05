<table width="100%">
  <tr>
    <td valign="top" class="left-column no-border" valign="top">
      <?php include(APP .'plugins/reports/views/qis/_options.ctp'); ?>
    </td>
    <td valign="top" valign="top">
    <h2>
    	QIS Report - 
    	<?php
	    if (isset($results) && !empty($results)) { 
        if (isset($this->params['url']['report_type']))   $type = $this->params['url']['report_type'];
        if (isset($this->params['named']['report_type'])) $type = $this->params['named']['report_type'];
	    	$qis = array(
  				'SKIN' => 'Skin Treatments',
  				'MIN' => 'Therapy Minutes',
  				'WEIGHT_LOSS' => 'Weight Loss',
  				'OSTOMY' => 'Ostomy',
  				'BIMS' => 'BIMS',
  				'ADL' => 'ADL',
  				'PHQ9' => 'PHQ-9',
  				'ULCERS' => 'Ulcers',
  				'PAIN' => 'Pain',
  				'FALLS' => 'Falls',
  				'UTI' => 'UTI',
  				'MOBILITY' => 'Mobility',
  				'CATHETER' => 'Catheter',
  				'VACCINE' => 'Vaccines',
  				'DEP' => 'Depressed',
  				'REST' => 'Restorative Services',
  				'RESTRAINTS' => 'Restraints',
  				'BOWELBLADDER' => 'Bowel and Bladder'
			);
			echo $qis[$type];
		}
    	?>
	</h2>
    <?php 
    if (isset($results) && !empty($results)) { 

      $url  = 'print_report';
      $url .= '?facility_id='.  $this->params['url']['facility_id'];
      $url .= '&type='.         $this->params['url']['type'];
      $url .= '&ard_start='.    $this->params['url']['ard_start'];
      $url .= '&ard_end='.      $this->params['url']['ard_end'];
      $url .= '&report_type='.  $this->params['url']['report_type'];
      $url .= '&STATION='.      $this->params['url']['STATION'];
      $url .= '&BED='.          $this->params['url']['BED'];
      $url .= '&ROOM='.         $this->params['url']['ROOM'];

      echo $this->Html->link($this->Html->image('actions/printer.png', array('class' => 'float-right' ,'style' => 'padding-left: 10px')), $url, array('escape' => false, 'target' => 'new'));
    ?>
      
    <table class="results" cellspacing="0">
      <?php
      include(APP .'plugins/reports/views/qis/_headers.ctp');
      include(APP .'plugins/reports/views/qis/_data.ctp');
      ?>
    </table>
    <?php } ?>
      <?php
      if (!isset($results) && empty($results)) { 
      	echo '<h2>How to Run a QIS Report</h2>';
      	echo '
      	<ol>
      		<li>Select the facility you wish to run a report for.</li>
      		<li>Select an ARD date range.</li>
      		<li>Select the Report Type.</li>
      		<li>Select any optional	fields.</li>
      		<li>Click Generate Report</li>
      	</ol>
      	<br />
      	';
      	echo '<h3>Standard fields on every report</h3>';
      	echo '
      	<ul>
      		<li>Last name </li>
      		<li>First name </li>
      		<li>Patient Number </li>
      		<li>Assessment Number </li>
      		<li>ARD </li>
      		<li>Assessment Type </li>
      	</ul>
      	';
  	  }
      ?>
    </td>
    
  </tr>
</table>

