<?php

class TicklerComponent extends Object {

	public $components = array('Reports.Clock');

	public function startup(&$controller) {
		$this->Resident    = ClassRegistry::init('Resident');
		$this->Assessment  = ClassRegistry::init('Assessment');
	}
	
	public function getMedicaid ($tickler = array(), $facility_id = null, $i = 0) {
	
		// get facilitiy children
		$facilities = $this->Resident->Facility->getFacilities($facility_id);
		
		// get the residents list
		$residents = $this->Resident->getActiveResidentList($facility_id);
		
		foreach ($residents as $key => $value) {

			// get all quaterly assessment
			$asmts = $this->Assessment->find('all', array(
				'conditions' => array(
					'SectionA.A0310A' => array('01','02','03'),
					'Assessment.resident' => $value['Resident']['id'],
					'Assessment.locked' => 1, 
					'SectionX.X0100 !=' => 2
				),
				'fields' => array('SectionA.A2300', 'SectionA.A0310A'),
				'order' => array('SectionA.A2300' => 'DESC')
			));
			
			$cnt = count ($asmts);
			
			$asmt = array();
			foreach ($asmts as $key2 => $value2) {
				$asmt[$value2['SectionA']['A2300']] = $value2['SectionA']['A0310A'];
			}
				
			if ($cnt == 0) {
				$type = 'Admission';
			}
			else {
				switch ($asmts[0]['SectionA']['A0310A']) {
					case '03':
					case '01':
						$type = 'Quaterly';
						break;
					case '02':
						if (
							(isset($asmts[0]['SectionA']['A0310A']) && $asmts[0]['SectionA']['A0310A'] == '02') && 
							(isset($asmts[1]['SectionA']['A0310A']) && $asmts[1]['SectionA']['A0310A'] == '02') && 
							(isset($asmts[2]['SectionA']['A0310A']) && $asmts[2]['SectionA']['A0310A'] == '02') 
						)
							$type = 'Annual';
						else
							$type = 'Quarterly';
						break;
					default:
						$type = 'Quaterly';
				}
			
				// check for SC since last comprehensive
				$sc = $this->Assessment->find('first', array(
					'conditions' => array(
						'SectionA.A0310A' => '04',
						'Assessment.resident' => $value['Resident']['id'],
						'SectionA.A2300 >=' => $asmts[0]['SectionA']['A2300'],
						'Assessment.locked' => 1, 
						'SectionX.X0100 !=' => 2
					),
					'fields' => array('SectionA.A2300', 'SectionA.A0310A'),
					'order' => array('SectionA.A2300' => 'DESC')
				));
				
				$start = $asmts[0]['SectionA']['A2300'];
				
				if (!empty($sc)) {
					$type = 'Quaterly';
					$start = $sc['SectionA']['A2300']; 
				}
			}
			
			$this->clock = array();
			
			// reset for admission
			if ($type == 'Admission') {
				$start = $value['Resident']['ADATE'];
				
				list($year, $month, $day) = explode('-', $start);
				
				$clean_s = $this->__date($month .'/'. $day .'/'. $year, 0);
				$clean_e = $this->__date($month .'/'. $day .'/'. $year, 13);
			}
			else {
				
				list($year, $month, $day) = explode('-', $start);
				
				$clean_s = $this->__date($month .'/'. $day .'/'. $year, 77);
				$clean_e = $this->__date($month .'/'. $day .'/'. $year, 92);
				
			}
			
			// set the resident name
			$name = $value['Resident']['PATLNAME'] .', '. $value['Resident']['PATFNAME'];				
			
			$date = '';
			$this->clock['id']       = $value['Resident']['id'];
			$this->clock['fac']      = $value['Facility']['name'];
			$this->clock['name']     = $name;
			$this->clock['type']     = $type;
			$this->clock['start']    = $clean_s;        
			$this->clock['end']      = $clean_e;
			$this->clock['done']     = '';
			$this->clock['admit']    = $value['Resident']['ADATE'];
			
			if ($clean_s != '00000000' && $clean_s != '0000-00-00' && $clean_s >= '20101001') {
				$tickler[$clean_s][$i] = $this->clock;
				$i++;
			}	
		
		}
	
		$data['i']    = $i;
		$data['data'] = $tickler;
		
		return $data;
	
	}
	
	public function getMedicare ($tickler = array(), $facility_id = null, $i = 0) {
	
		if (!empty($facility_id)) {
			
			$reslist = $this->Resident->getActiveResidentList($facility_id, 'MEDICARE A');
			
			foreach ($reslist as $key => $value) {

				list ($year, $month, $day) = explode ('-', $value['Resident']['ATOPDTE']);
				
				$start_date = $month .'/'. $day .'/'. $year; 
				
				// set the resident name
				$name = $value['Resident']['PATLNAME'] .', '. $value['Resident']['PATFNAME'];
				
				$info = ClassRegistry::init('Assessment')->getResidentLast($value['Resident']['id']);
				
				if (
					$info['SectionA']['A0310F'] != '10' && 
					$info['SectionA']['A0310F'] != '11' && 
					$info['SectionA']['A0310F'] != '12' 
				) {
				
					if (isset($info['SectionA']['A2400B'])) {
					    // set start date
					    if (preg_match('[-]', $info['SectionA']['A2400B'])) {
					    	list($sy, $sm, $sd) = explode('-', $info['SectionA']['A2400B']);
							$start_date = $sm .'/'. $sd .'/'. $sy; 
					    }  
					    if (preg_match('[/]', $info['SectionA']['A2400B'])) {
					    	list($sm, $sd, $sy) = explode('/', $info['SectionA']['A2400B']);
							$start_date = $sm .'/'. $sd .'/'. $sy; 
					    }
					}

					$clock_dates = $this->Clock->dates($start_date, $value['Resident']['id']);

					foreach ($clock_dates as $key2 => $value2) {
						
						if (!empty($value2['cvr']['s'])) {
							list($sm, $sd, $sy) = explode('/', $value2['ard']['s']);
							list($em, $ed, $ey) = explode('/', $value2['ard']['g']);

						
							$this->new_clock['id']       = $value['Resident']['id'];
							$this->new_clock['name']     = $name;
							$this->new_clock['type']     = $value2['asmt'];
							$this->new_clock['start']    = $sy . $sm . $sd;
							$this->new_clock['end']      = $ey . $em . $ed;
							$this->new_clock['fac']      = $value['Facility']['name'];
							$this->new_clock['admit']    = $value['Resident']['ADATE'];							
							
							$tickler[$sy . $sm . $sd][] = $this->new_clock;
						}
						
					}
				
				}
				
				$i++;

			}
			
			ksort($tickler);
		
		}
		
		$data['i']    = $i;
		$data['data'] = $tickler;
		
		return $data;
	
	}
	
	private function __reverse($date) {
		$date = str_replace('-', '', $date);
		$date = substr($date,4,4) . substr($date,0,4);
		return $date;
	}
	
	private function __days( $a = null, $b = null) {
	
		if ($a == null || $b == null) return 0;
	
		list($gd_a['m'], $gd_a['d'], $gd_a['y']) = @explode('/', $a);
		list($gd_b['m'], $gd_b['d'], $gd_b['y']) = @explode('/', $b);
		
		$a_new = mktime( 12, 0, 0, $gd_a['m'], $gd_a['d'], $gd_a['y'] );
		$b_new = mktime( 12, 0, 0, $gd_b['m'], $gd_b['d'], $gd_b['y'] );
		
		$days = round( abs( $a_new - $b_new ) / 86400 );
		return $days + 1;
	}
	
	protected function __date($date, $add) {
		list($month, $day, $year) = explode('/', $date);
		return date("Ymd", mktime(0, 0, 0, $month, $day + $add, $year));
	}
	
	protected function __subDate($date, $subtract) {
		list($month, $day, $year) = explode('/', $date);
		return date("Ymd", mktime(0, 0, 0, $month, $day - $subtract, $year));
	}
	
	private function __quarters($entry, $ard) {
		$datediff = (strtotime($ard) - strtotime($entry));
		return round($datediff / 7776000);
	}

}