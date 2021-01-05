<?php

class MidnightRule extends AppModel {
	
	function checkDates($start, $end, $resident_id, $facility_id) {
		
		return $this->find('count', array(
			'conditions' => array(
				'MidnightRule.resident_id' => $resident_id,
				'MidnightRule.facility_id' => $facility_id,
				'MidnightRule.date >=' => $start,
				'MidnightRule.date <=' => $end,
			)
		));

	}
}