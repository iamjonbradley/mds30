<?php if (isset($results) && !empty($results)) { ?>
	<h2>
		QIS Report - 
		<?php
		$type = $this->params['url']['report_type'];
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
		?>
	</h2>
	<table class="results" cellspacing="0">
	<?php
		include(APP .'plugins/reports/views/qis/_headers.ctp');
		include(APP .'plugins/reports/views/qis/_data.ctp');
		?>
	</table>
<?php } ?>