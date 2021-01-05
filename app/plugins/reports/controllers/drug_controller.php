<?php

App::import('Core', 'Sanitize');
class DrugController extends ReportsAppController {

	public $name = 'Drug';
	public $uses = array('Resident');

	public function beforeFilter () {
		parent::beforeFilter();
	}
	
	public function index () {
      

	}
	
	public function view ($facility_id = null) {
		self::__setData($facility_id);
		$this->render('index');
	}

	public function printer ($facility_id = null) {
		Configure::write('debug', 0);
		$this->layout = 'printing';
		$this->__setData ($facility_id, $date_start, $date_end);
		$this->render('print');
	}
		 
	private function __setData ($facility_id = null) {

		// get models
		$residents = $this->Resident->find('all', array(
      'conditions' => array(
        'Resident.PATNUM IS NOT NULL',
        'Resident.id LIKE' => "%". $facility_id ."-%",
        'Resident.facility_id' => $facility_id, 
        'Resident.apartment' => 0,
        'Resident.READM' => array('', 'A')
      ),
      'fields' => array('Resident.id', 'Resident.facility_id', 'Resident.PATLNAME','Resident.PATNUM','Resident.PATFNAME','Resident.READM'),
      'contain' => array(
        'Facility' => array(
          'fields' => array('Facility.name')
        ),
        'ResidentDrug' => array(
          'fields' => array('ResidentDrug.N0350A','ResidentDrug.N0410A','ResidentDrug.N0410B','ResidentDrug.N0410C','ResidentDrug.N0410D','ResidentDrug.N0410E','ResidentDrug.N0410F','ResidentDrug.N0410G')
        )
      )
    ));

		foreach ($residents as $key => $resident) {

			// set medications
      $N0350A = $resident['ResidentDrug']['N0350A'];
      $N0410A = $resident['ResidentDrug']['N0410A'];
      $N0410B = $resident['ResidentDrug']['N0410B'];
      $N0410C = $resident['ResidentDrug']['N0410C'];
      $N0410D = $resident['ResidentDrug']['N0410D'];
      $N0410E = $resident['ResidentDrug']['N0410E'];
      $N0410F = $resident['ResidentDrug']['N0410F'];
      $N0410G = $resident['ResidentDrug']['N0410G'];

      $report_key = $resident['Resident']['PATLNAME'] .'_'. $resident['Resident']['id'];

      foreach ($resident as $key => $value) {
        $rug_cache = $this->Resident->RugCache->find('first', array(
          'conditions' => array('RugCache.resident_id' => $resident['Resident']['id']),
          'order' => array('RugCache.assessment_id DESC'),
          'recursive' => -1
        ));
        $resident['RugCache'] = $rug_cache['RugCache'];
      }

      // Insulin
      if ($N0350A != 0) { 
        $report['Insulin'][$report_key] = $resident; 
        $report['Insulin'][$report_key]['value'] = $N0350A; 
        ksort($report['Insulin']);
      }
      // Antipsychotic
      if ($N0410A != 0) { 
        $report['Antipsychotic'][$report_key] = $resident;
        $report['Antipsychotic'][$report_key]['value'] = $N0410A; 
        ksort($report['Antipsychotic']); 
      }
      // Antianxiety
      if ($N0410B != 0) { 
        $report['Antianxiety'][$report_key] = $resident; 
        $report['Antianxiety'][$report_key]['value'] = $N0410B; 
        ksort($report['Antianxiety']);
      }
      // Antidepressant
      if ($N0410C != 0) { 
        $report['Antidepressant'][$report_key] = $resident; 
        $report['Antidepressant'][$report_key]['value'] = $N0410C; 
        ksort($report['Antidepressant']);
      }
      // Hypnotic
      if ($N0410D != 0) { 
        $report['Hypnotic'][$report_key] = $resident; 
        $report['Hypnotic'][$report_key]['value'] = $N0410D; 
        ksort($report['Hypnotic']);
      }
      // Anticoagulant
      if ($N0410E != 0) { 
        $report['Anticoagulant'][$report_key] = $resident; 
        $report['Anticoagulant'][$report_key]['value'] = $N0410E; 
        ksort($report['Anticoagulant']);
      }
      // Antibiotic
      if ($N0410F != 0) { 
        $report['Antibiotic'][$report_key] = $resident; 
        $report['Antibiotic'][$report_key]['value'] = $N0410F; 
        ksort($report['Antibiotic']);
      }
      // Diuretic
      if ($N0410G != 0) { 
        $report['Diuretic'][$report_key] = $resident; 
        $report['Diuretic'][$report_key]['value'] = $N0410G; 
        ksort($report['Diuretic']);
      }

		}

    ksort($report);

		$this->set(compact('report', 'facility_name'));
		
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