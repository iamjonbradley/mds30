<?php

class Quarter extends ReportsAppModel {
	
	public $useTable = 'quarterly_logs';
	
	public $belongsTo = array(
		'Resident' => array(
			'foreignKey' => 'resident_id',
			'fields' => array(
				'Resident.PATLNAME', 'Resident.PATFNAME'	
			)
		),
		'Assessment' => array(
			'foreignKey' => 'assessment_id',
			'fields' => array(
				'Assessment.lock_date'	
			)
		),
		'SectionA' => array(
			'foreignKey' => 'id',
			'fields' => array(
				'SectionA.A0310A', 'SectionA.A2300'
			)
		)	
	);
}