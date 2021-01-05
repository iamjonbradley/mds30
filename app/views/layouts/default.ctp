
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
	  <?php 
	  // firstname
	  if (isset($this->data['SectionA']) && isset($this->data['Resident'])) {
      if (isset($this->data['SectionA']['A0500A']) && !empty($this->data['SectionA']['A0500A'])) $firstname = ucwords(strtolower($this->data['SectionA']['A0500A']));
      else $firstname = ucwords(strtolower($this->data['Resident']['PATFNAME']));
      // lastname
      if (isset($this->data['SectionA']['A0500C']) && !empty($this->data['SectionA']['A0500C'])) $lastname = ucwords(strtolower($this->data['SectionA']['A0500C']));
      else $lastname = ucwords(strtolower($this->data['Resident']['PATLNAME']));
      // set title
      $title = $lastname .', '. $firstname;
    }
    else {
      if ($_SERVER['SERVER_ADDR'] == '192.168.50.12' || $_SERVER['SERVER_ADDR'] == '127.0.0.1')
        $title = $title_for_layout .' | DEV';
      else
        $title = $title_for_layout .' | MDS 3';
    }
    echo $title;
		?>
	</title>
  <meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
  <meta name="ROBOTS" content="NONE" />
  <meta NAME="GOOGLEBOT" content="NOARCHIVE" />

	<?php
		echo $this->Html->meta('icon'); 

		echo $this->Html->css(array('facebox','default', 'ui', 'dropdown/dropdown.css', 'redmond/jquery-ui-1.8.20.custom.css', 'dropdown/themes/default/default.css'));

		if (isset($this->params['plugin']) && $this->params['plugin'] == 'reports')
		  echo $this->Html->css('custom');	

    echo $this->Html->script('jquery-1.7.2.min.js');
    echo $this->Html->script('date.js');
    echo $this->Html->script('jquery-ui-1.8.20.custom.min.js');
    echo $this->Html->script('jquery.calculation.js');
    echo $this->Html->script('tooltip.js');
    echo $this->Html->script('facebox.js');
    echo $this->Html->script('application.js');
    echo $this->Html->script('skip.js');

    if (isset($this->params['plugin']) && $this->params['plugin'] == 'reports') 
      echo $this->element('_custom', array('plugin' => 'reports')) ."\r\n";
      
  ?> 

</head>
  <body>
  	<div id="copy"></div>
	<div id="container">
		<div id="header">
			<h1> <img src="/img/logo.png" alt="MDS 3.0" /></h1>
			<div class="select-facility">
			<?php
			if (!empty($allowed_facilities) && is_array($allowed_facilities)) {
			  $facility = $this->Session->read('Auth.User.facility_id');
			  
			  if (count($allowed_facilities) != 1) {
  			  echo $this->Form->input('facility_id', array('value' => $facility, 'type' => 'select', 'options' => $allowed_facilities, 'div' => false, 'label' => false, 'onChange' => 'location.href="/controls/set_facility/"+this.options[this.selectedIndex].value'));
  			  echo $this->Form->label('Selected Facility:');
  		  }
			}
			?>
			</div>
		</div>
		<?php
		if (($user = $this->Session->read('Auth.User')) == true) {
      echo '<div id="mainmenu">';
		  echo $this->element('menus/main');
      echo '</div>';
		}
		?>
		<div id="content">

			<?php 
			echo $this->Session->flash();
      echo $content_for_layout; 
      ?>

		</div>
		<div id="footer">
			An Adelpo Care Product. Copyright &copy; <?php echo date('Y'); ?> Adelpo, LLC. All Rights Reserved. <br />
        v3.1.0
		</div>
	</div>
</body>
</html>