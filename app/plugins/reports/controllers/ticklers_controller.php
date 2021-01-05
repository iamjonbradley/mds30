<?php

App::import('Core', 'Cache');
class TicklersController extends ReportsAppController {
	
	public $name = 'Ticklers';
	public $uses = array('Facility', 'Resident', 'Assessment');
	public $components = array('Tickler');
	public $helpers = array('Cache', 'Time');
	public $clock = array();
	
	public function index ($facility_id = null) {
		$ticklers = $this->__getData ($facility_id);
		$this->set('ticklers', $ticklers);
	}
	
	public function view ($facility_id = null) {
		self::index($facility_id);
		$this->render('index');
	}

	private function __getData ($facility_id = null) {

		if (!empty($facility_id)) {
			
			if ($facility_id == 'all') 
				$facility_id = $this->Auth->user('facility_id');
			
			$data = $this->Tickler->getMedicaid (array(), $facility_id);
			$data = $this->Tickler->getMedicare ($data['data'], $facility_id, $data['i']);

			$ticklers = $data['data'];
			
			foreach ($ticklers as $key => $value) { 
				$new = date("Ymd", mktime(0, 0, 0, date('m')-1, date('d'), date('Y')));
				if ($key < $new) unset($ticklers[$key]);
			}

			foreach ($ticklers as $key => $value) {
				foreach ($value as $key2 => $value2) {
					
					$s_y = substr($value2['start'], 0, 4);
					$s_m = substr($value2['start'], 4, 2);
					$s_d = substr($value2['start'], 6, 2);
					$s = $s_y .'-'. $s_m .'-'. $s_d;
					
					$e_y = substr($value2['end'], 0, 4);
					$e_m = substr($value2['end'], 4, 2);
					$e_d = substr($value2['end'], 6, 2);
					$e = $e_y .'-'. $e_m .'-'. $e_d;

					$count = 0;

					switch ($value2['type']) {
						case '5 Day':	case '14 Day': case '30 Day': 
						case '60 Day': case '90 Day': case '60 Day':
							$count	= $this->Assessment->checkClosedPPS($value2['id'], $value2['type'], $s, $e);
							break;
						default:
							$count = $this->Assessment->checkClosedOBRA($value2['id'], $value2['type'], $s, $e);
					}

					$ticklers[$key][$key2]['start']	= $s_y .'-'. $s_m .'-'. $s_d;
					$ticklers[$key][$key2]['end']	= $e_y .'-'. $e_m .'-'. $e_d;

					$ticklers[$key][$key2]['working'] = $count['working'];
					$ticklers[$key][$key2]['done']	  = $count['closed'];

					$ticklers[$key][$key2]['start']	= $s_y .'-'. $s_m .'-'. $s_d;
					$ticklers[$key][$key2]['end']	= $e_y .'-'. $e_m .'-'. $e_d;

					if ($ticklers[$key][$key2]['done'] > 0) 
						unset($ticklers[$key][$key2]);

				}
			}			
		}

		if (empty($ticklers))
			$ticklers = array();

		return $ticklers;
	}
	
	protected function __subDate($date, $subtract) {
		list($y, $m, $d) = explode('-', $date);
		return date("Ymd", mktime(0, 0, 0, $m, $d - $subtract, $y));
	}

}