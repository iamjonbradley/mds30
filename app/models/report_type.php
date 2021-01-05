<?php

class ReportType extends AppModel {

	var $name = 'ReportType';

	function getType ($type, $item_subset) {

		$data = $this->find('all', array(
			'conditions' => array('ReportType.'. $type => 'x', 'ReportType.item_subset' => $item_subset),
			'fields' => array('ReportType.item_subset', 'ReportType.itm_section', 'ReportType.itm_id')
		));

		foreach ($data as $key => $value) {
			$fields[] = $value['ReportType']['itm_section'] .'.'. $value['ReportType']['itm_id'];
		}

		$fields[] = 'Assessment.facility_id';
		$fields[] = 'Assessment.lock_date';
		$fields[] = 'Facility.FIDNO';
		$fields[] = 'Facility.F_STATE';
		$fields[] = 'Facility.FAC_ID'; 

		return $fields;

	}

	public function getSection ($section, $type) {
		
		if (!empty($type))
			return $this->find('list', array(
				'conditions' => array('ReportType.'. $type => 'x', 'ReportType.itm_section' => 'Section'. strtoupper($section)),
				'fields' => array('ReportType.itm_id', 'ReportType.itm_section')
			));

	}

}