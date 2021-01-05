<?php

class DrugUsageShell extends Shell {  

	public $uses = array('Assessment', 'ResidentDrug');

	public function main () {
		$data = $this->Assessment->find('all', array(
			'fields' => array('Assessment.resident', 'Assessment.facility_id'),
			'contain' => array(
				'SectionN' => array(
					'fields' => array(
						'SectionN.N0350A','SectionN.N0410A','SectionN.N0410B','SectionN.N0410C',
						'SectionN.N0410D','SectionN.N0410E','SectionN.N0410F','SectionN.N0410G', 
					)
				)
			)
		));

		foreach ($data as $key => $value) {
			$this->ResidentDrug->storeUpdate($value['Assessment']['resident'], $value['Assessment']['facility_id'], $value);
		}
	}

}