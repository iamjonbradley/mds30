<h2>Midnight Rule</h2>

<table class="results" cellspacing="0" cellpadding="0">
	<tr>
		<td class="no-hover">
			<strong>Directions</strong> 
			<br /><br />
			<ol>
				<li>Select a facility</li>
				<li>Select a resident</li>
				<li>Select the date the resident was out of the facility</li>
				<li>Click go to record the date the resident was out</li>
			</ol> 
			<br />
			<?php

			echo $this->Form->create('MidnightRule', array(
				'class' => 'midnight-rule',
				'action' => 'save'
			));

			echo $this->Form->input('facility_id', array(
				'label'		=> false,
				'div'		=> false,
				'options'	=> $allowed_facilities,
				'empty'		=> ' select a facility ',
				'class'		=> 'select-float facility'
			));

			echo $this->Form->input('resident_id', array(
				'label'		=> false,
				'div'		=> false,
				'options'	=> $results['residents'],
				'empty'		=> ' select a resident ',
				'class'		=> 'select-float residents',
			));

			echo $this->Form->input('date', array(
				'label'		=> false,
				'div'		=> false,
				'type'		=> 'date',
				'format'	=> 'njY',
				'monthNames'=>  false,
				'separator'	=> '',
				'class'		=> 'select-float date'
			));

			echo $this->Form->submit('Go', array(
				'label'		=> false,
				'div'		=> false,
				'class'		=> 'select-float go float-submit',
			));

			?>
			<br />
		</td>
	</tr>
</table>
