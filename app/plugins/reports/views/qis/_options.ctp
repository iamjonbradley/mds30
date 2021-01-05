
	  <?php  
	  echo $this->Form->create('Report', array('type' => 'get', 'url' => '/reports/qis'));
	  echo $this->Form->hidden('Report.type', array('value' => 'qi'));
	  ?>
	  <!-- faclity reports -->
	  <ul class="left-nav">
		<li class="menu">Required Items</li>
		<li>
		  <?php
			echo $this->Form->input('Assessment.facility_id', array('empty' => 'SELECT A FACILITY', 'label' => 'Facility', 'type' => 'select', 'options' => $allowed_facilities));
			echo $this->Form->input('Report.ard_start');
			echo $this->Form->input('Report.ard_end');
		  ?>
		</li>
		<li class="menu">Report Type</li>
		<li>
		  <table border="0">
			<tr>
			  <td style="padding-top: 8px">
			<tr>
			  <td colspan="3">
				<?php 
				echo $this->Form->input('Report.report_type', array(
					'type' => 'select', 
					'label' => false, 
					'empty' => '( select an option )',
					'options' => array(
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
					)
				)); 
				?>
			  </td>
			</tr>
		  </table>
		</li>
		<li class="menu">Optional Fields</li>
		<li>
		  <table border="0">
			<tr>
			  <td valign="top">
				<?php echo $this->Form->input('Resident.STATION', array('type' => 'checkbox', 'label' => 'Unit')); ?>
			  </td>
			  <td valign="top">
				<?php echo $this->Form->input('Resident.BED', array('type' => 'checkbox', 'label' => 'Bed')); ?>
			  </td>
			  <td valign="top">
				<?php echo $this->Form->input('Resident.ROOM', array('type' => 'checkbox', 'label' => 'Room')); ?>
			  </td>
			</tr>
		  </table>
		  
		</li>
		<li><?php echo $this->Form->submit('Generate Report'); ?></li>
	  </ul>
	  <?php echo $this->Form->end(); ?>