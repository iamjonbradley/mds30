<ul id="nav" class="dropdown dropdown-horizontal">


	<?php if (!in_array($this->Session->read('Auth.User.group_id'), array(9))) { ?>
	<li><a href="/">Home</a></li>
	<?php } ?>

	<?php 

	echo $this->Menu->item(
		'Residents', 
		array('plugin' => false, 'controller' => 'residents', 'action' => 'index'),
		array(4,5,9)
	); 
	echo $this->Menu->item(
		'Assessments', 
		array('plugin' => false, 'controller' => 'assessments', 'action' => 'index'), 
		array(4,5)
	); 
	echo $this->Menu->item(
		'Bulk Submission Files', 
		array('plugin' => false, 'controller' => 'bulk', 'action' => 'index'), 
		array(4,5,9)
	); 
	?>


	<?php if (!in_array($this->Session->read('Auth.User.group_id'), array(9))) { ?>
	<li class="dir">Reports
		<ul>
			<?php
			echo $this->Menu->item(
				'RUG Report', 
				array('plugin' => 'reports', 'controller' => 'rug', 'action' => 'index'),
				array(9)
			); 

			if (
				in_array($this->Session->read('Auth.User.group_id'), array(1,2)) ||
				$this->Session->read('Auth.Facility.F_STATE') == 'PA'||
				$this->Session->read('Auth.Facility.id') == '35'
			) {
				echo $this->Menu->item(
					'<span class="new">BETA</span> &nbsp; CMI Report', 
					array('plugin' => 'beta', 'controller' => 'cmi', 'action' => 'index'), 
					array(9),
					array('escape' => false)
				); 
			}

			echo $this->Menu->item(
				'QIS Report', 
				array('plugin' => 'reports', 'controller' => 'qis', 'action' => 'index'), 
				array(4,5,9)
			); 
			echo $this->Menu->item(
				'Tickler', 
				array('plugin' => 'reports', 'controller' => 'ticklers', 'action' => 'index'), 
				array(4,5,9)
			); 
			echo $this->Menu->item(
				'Change Reports', 
				array('plugin' => 'reports', 'controller' => 'histories', 'action' => 'index'), 
				array(4,5,8,9)
			); 
			echo $this->Menu->item(
				'Late', 
				array('plugin' => 'reports', 'controller' => 'late', 'action' => 'index'), 
				array(4,5,8,9)
			); 
			echo $this->Menu->item(
				'Part A Compare', 
				array('plugin' => 'reports', 'controller' => 'part_a_compare', 'action' => 'index'),
				array(9)
			); 
			echo $this->Menu->item(
				'ICD 9 Code Compare', 
				array('plugin' => 'reports', 'controller' => 'icd9_compare', 'action' => 'index'),
				array(9)
			); 
			echo $this->Menu->item(
				'Interviewed', 
				array('plugin' => 'reports', 'controller' => 'interview', 'action' => 'index'), 
				array(4,5,9)
			); 
			echo $this->Menu->item(
				'Drug Report', 
				array('plugin' => 'reports', 'controller' => 'drug', 'action' => 'index'), 
				array(4,5,9)
			); 
			?>

		</ul>
	</li>
	<?php } ?>

	<li class="dir">Forms
		<ul>
			<?php 
			echo $this->Menu->item(
				'672 Report', 
				array('plugin' => 'forms', 'controller' => 'census_and_conditions', 'action' => 'index'), 
				array(4,5,9)
			); 
			echo $this->Menu->item(
				'672 Report Details', 
				array('plugin' => 'forms', 'controller' => 'census_detail', 'action' => 'index'), 
				array(4,5)
			); 
			/**
			echo $this->Menu->item(
				'802 Roster Matrix', 
				array('plugin' => 'forms', 'controller' => 'roster_matrix', 'action' => 'index'), 
				array(4,5)
			); 
			*/
			echo $this->Menu->item(
				'Ancillary Form', 
				array('plugin' => 'forms', 'controller' => 'ancillary', 'action' => 'index'), 
				array(9)
			); 
			?>
		</ul>
	</li>

	<?php if (!in_array($this->Session->read('Auth.User.group_id'), array(9))) { ?>
	<?php
	echo $this->Menu->item(
		'AR', 
		array('plugin' => 'billing', 'controller' => 'exports', 'action' => 'index')
	); 
	?>
	<?php } ?>

	<?php
	echo $this->Menu->item(
		'RUG Rates', 
		array('plugin' => 'tools', 'controller' => 'rugs', 'action' => 'edit')
	); 
	?>
	
	
	<?php if (!in_array($this->Session->read('Auth.User.group_id'), array(5,8,9))) { ?>
	<li class="dir">Admin
		<ul>
			<?php
			echo $this->Menu->item(
				'Users', 
				array('plugin' => false, 'controller' => 'users', 'action' => 'index'), 
				array(5,8,9)
			); 
			echo $this->Menu->item(
				'Groups', 
				array('plugin' => false, 'controller' => 'groups', 'action' => 'index'), 
				array(4,5,6,7,8,9)
			); 
			echo $this->Menu->item(
				'Facilities', 
				array('plugin' => false, 'controller' => 'facilities', 'action' => 'index'), 
				array(4,5,6,7,8,9)
			); 
			echo $this->Menu->item(
				'Migrations', 
				array('plugin' => 'tools', 'controller' => 'migrations', 'action' => 'index'), 
				array(4,5,6,7,8,9)
			); 
			echo $this->Menu->item(
				'Stats', 
				array('plugin' => false, 'controller' => 'stats', 'action' => 'index'), 
				array(4,5,6,7,8,9)
			); 
			echo $this->Menu->item(
				'Sync Status', 
				array('plugin' => false, 'controller' => 'sync', 'action' => 'index'), 
				array(4,5,6,7,8,9)
			); 
			echo $this->Menu->item(
				'Change Requests', 
				array('plugin' => false, 'controller' => 'change_requests', 'action' => 'index'), 
				array(4,5,6,7,8,9)
			); 
			?>
		</ul>
	</li>
	<?php } ?>

	<?php if (!in_array($this->Session->read('Auth.User.group_id'), array(9))) { ?>
	<?php
	echo $this->Menu->item(
		'Tickets', 
		array('plugin' => false, 'controller' => 'tickets', 'action' => 'index')
	); 
	?>
	<?php } ?>
	
	<?php if (!in_array($this->Session->read('Auth.User.group_id'), array(9))) { ?>
	<li class="dir">My Account
		<ul>
			<?php
			echo $this->Menu->item(
				'Change Password', 
				array('plugin' => false, 'controller' => 'users', 'action' => 'password')
			); 
			?>
		</ul>
	</li>
	<?php } ?>

	<?php
	echo $this->Menu->item(
		'Logout', 
		array('plugin' => false, 'controller' => 'users', 'action' => 'logout')
	); 
	?>
</ul>