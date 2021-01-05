<?php

App::import('Core', 'Sanitize');
class RugController extends ReportsAppController {

	public $name = 'Rug';
	public $components = array('Excel', 'Caa', 'Calc', 'Reports.Clock');
	public $helpers = array('Time', 'AssessmentType', 'Number', 'Html');
	public $uses = array('RugCache');

	public function beforeFilter () {
		parent::beforeFilter();
	}
	
	public function index ($facility_id = null) {
		$this->__setData ($facility_id);
	}
	
	public function view ($facility_id = null) {
		self::index($facility_id);
		$this->render('index');
	}

	public function printer ($facility_id = null, $date_start = null, $date_end = null) {
		Configure::write('debug', 0);
		$this->layout = 'printing';
		$this->__setData ($facility_id, $date_start, $date_end);
		$this->render('print');
	}
	
	public function excel ($facility_id = null,$date_start = null, $date_end = null) {
		Configure::write('debug', 0);
		$data = $this->__setData($facility_id, $date_start, $date_end);
		
		$info[] = 'Facility,ID #,Patient #,PATLNAME, PATFNAME,ENTRY,PART A,LOCK DATE,ARD,TYPE,PPS,OMRA,T-RUG,T-RATE*,N-RUG<,N-RATE*,CVRS,DAYS,Status';
			 
		foreach ($data as $key => $value) {
			$str  = $value['Facility']['name'] .',';
			$str .= $value['Assessment']['id'] .',';
			$str .= $value['Resident']['PATNUM'] .',';
			$str .= $value['Resident']['PATLNAME']	.',';
			$str .= $value['Resident']['PATFNAME'] .',';
			$str .= $value['Resident']['ADATE'] .',';
			
			$this->Time = new TimeHelper();
			$this->Html = new HtmlHelper();
			$this->Number = new NumberHelper();
			$this->AssessmentType = new AssessmentTypeHelper();

			if ($value['Assessment']['type'] != 'NT')
				$str .= $this->Time->format('m/d/Y', $value['SectionA']['A2400B']) .',';
			else
				$str .= ',';
			
			if (!empty($value['Assessment']['lock_date']))
				$str .= $this->Time->format('m/d/Y', $value['Assessment']['lock_date']) .',';
			else
				$str .',';
			
			if (!empty($value['SectionA']['A2300']))
				$str .= $this->Time->format('m/d/Y', $value['SectionA']['A2300']) .','; 
			else
				$str .= ',';
			if (!empty($value['SectionX']['X0100'])) {
				switch ($value['SectionX']['X0100']) {
					case 1: $str .= 'NEW'; break;
					case 2: $str .= 'MOD'; break;
					case 3: $str .= 'INA'; break;
				}
			}
			else
				$str .= ',';
				
			$str .= $this->AssessmentType->pps($value) .',';
			$str .= $value['Assessment']['OMRA'] .',';
			$str .= $value['rug']['therapy'] .',';
			$str .= $this->Number->currency($value['rug']['t_rate'], 'USD') .',';
			$str .= $value['rug']['nursing'] .',';
			$str .= $this->Number->currency($value['rug']['n_rate'], 'USD') .',';
			
			if (isset($value['cvr'])) {
				$str .= $value['cvr']['from'] .' - '. $value['cvr']['to'] .',';
				$str .= $value['cvr']['days'] .',';
			}
			else {
				$str .= ',';
				$str .= ',';
			}
			
			if ($value['Assessment']['transmission_status'] == '2') 
				$str .= 'Accepted'; 
			else 
				$str .= '';	
				
			$info[] = $str;

		}
		
		$this->Excel->generate($info);
	}
		 
	private function __setData ($facility_id = null, $date_start = null, $date_end = null) {

		if (!empty($facility_id)) {

			if (empty($date_start)) 
				$start = $date_start;
			else
				$start = $this->params['url']['start'];;

			if (empty($date_end)) 
				$end = $date_start;
			else
				$end = $this->params['url']['end'];;

		}
		
		if ($facility_id != 0) {
			// get facilities
			$facilities = $this->RugCache->Facility->getNiceList($this->Auth->user('facility_id'));
		}
		else {
			// get regional/corporate facilities
			$regionalList = $this->RugCache->Facility->getFacilities($this->Auth->user('facility_id'));
			
			// Find out Regional Name...Parent of any of the facilities
			$regionalName = $this->RugCache->Facility->getName($this->Auth->user('facility_id'));
		}

		$conditions = array();
		
		if (!empty($date_start))	$conditions['RugCache.date_ard >='] = $date_start;
		if (!empty($date_end))		$conditions['RugCache.date_ard <='] = $date_end;
		
		if ($facility_id != 0) {
			 $conditions['RugCache.facility_id'] = $facility_id;
		}
		else {
			// returns an array for all the facility under regional/coroporate
			$conditions['and']['RugCache.facility_id'] = $regionalList;
		}		

		$conditions['RugCache.date_locked !='] = '0000-00-00';

		if (isset($this->params['url']['start']))
			$conditions['RugCache.date_ard >='] = $this->params['url']['start'];
		
		if (isset($this->params['url']['start']))
			$conditions['RugCache.date_ard <='] = $this->params['url']['end'];
			

		if (isset($this->params['url']['start']) || (isset($date_start) && !empty($date_start))) {
			
			$data = $this->RugCache->find('all', array(
				'conditions' => $conditions,
				'order' => array(
					'Resident.PATLNAME' => 'ASC', 
					'Resident.PATFNAME' => 'ASC', 
					'RugCache.date_locked' => 'ASC'
				),
				'recursive' => 0,
				'limit' => 250
			));
		
		}
		
		$allowed_facilities = array();
		$allowed_facilities = $this->RugCache->Facility->getNiceList($this->Auth->user('facility_id'));
		$this->set('allowed_facilities', $allowed_facilities);
		
		$this->set('facility_id', $facility_id);

		if (isset($this->params['url']['start']))
			$this->data['Report']['start'] = $this->params['url']['start'];

		if (isset($this->params['url']['end']))
			$this->data['Report']['end'] = $this->params['url']['end'];
		
		if (isset($data) && !empty($data)) {
			$this->set(compact('data', 'facilities'));
			return $data;
		}
		else {
			return null; 
		}
		
	}
	
	private function __modifyDate($date, $add) {
		list($y, $m, $d) = explode('-', $date);
		return date("m/d/Y", mktime(0, 0, 0, $m, $d + $add, $y));
	}
	
	private function __modifyDateSub($date, $add) {
		list($y, $m, $d) = explode('-', $date);
		return date("m/d/Y", mktime(0, 0, 0, $m, $d - $add, $y));
	}
	
	private function __countDays( $a = null, $b = null) {
	
		if ($a == null || $b == null) return 0;
	
		list($gd_a['m'], $gd_a['d'], $gd_a['y']) = @explode('/', $a);
		list($gd_b['m'], $gd_b['d'], $gd_b['y']) = @explode('/', $b);
		
		$a_new = mktime( 12, 0, 0, $gd_a['m'], $gd_a['d'], $gd_a['y'] );
		$b_new = mktime( 12, 0, 0, $gd_b['m'], $gd_b['d'], $gd_b['y'] );
		
		$days = round( abs( $a_new - $b_new ) / 86400 );
		return $days + 1;
	}
 
}