<?php

App::import('Component',array('Calc', 'Cmi', 'Email')); 
class MongoShell extends Shell {  

	public $uses = array('Assessment', 'Report');
	public $tasks = array('Dump');

	public $months = array(
		'01' => 'Jan.', '02' => 'Feb.', '03' => 'Mar.', '04' => 'Apr.', '05' => 'May.', '06' => 'Jun.', 
		'07' => 'Jul.', '08' => 'Aug.', '09' => 'Sep.', '10' => 'Oct.', '11' => 'Nov.', '12' => 'Dec.'
	);

	public $divider = "---------------------------------------------------------------";

	public $output = '';
 
	public function initialize() {
		$this->_welcome();
		$this->out("MDS Mongo DB Export Shell");
		$this->hr();
	}

	public function startup() {

		$this->Calc =& new CalcComponent(null);
		$this->Cmi =& new CmiComponent(null);

	}

	public function main () {

		foreach ($this->months as $key => $value) {
			self::process($key, '2011');
		}

		foreach (array(10,11,12) as $key => $value) {
			self::process($key, '2010');
		}
		
		$msg  = $this->out("Peak memory usage for the script : ". $this->convert(memory_get_peak_usage(true))) 			."\r";
		$msg .= $this->out($this->divider) 																				."\r";
		$msg .= $this->out("                            FINISHED                           				") 				."\r";
		$msg .= $this->out($this->divider) 																				."\r";

		$this->output .= $msg;
		
	}

	public function process($month, $year) {

		$msg  = $this->out('Starting import for '. $year .'-'. $month .'-01 - '.$year .'-'. $month .'-31') 				."\r";

		$this->output .= $msg;

		$assessments = array();
		$assessment = array();

	    $this->Assessment = ClassRegistry::init('Assessment');
		
		$this->Assessment->unBindModel(array(
			'belongsTo' => array('User', 'Resident')
		));

		$assessments = $this->Assessment->find('all', array(
			'conditions' => array(
				'SectionA.A2300 >=' => $year .'-'. $month .'-01',
				'SectionA.A2300 <=' => $year .'-'. $month .'-31',
			)
		));

		foreach ($assessments as $assessment) {

			$asmt_data 	= $assessment;
			$state 		= $assessment['Facility']['F_STATE'];
			$fac_name 	= $assessment['Facility']['name'];

			unset($assessment['Facility']);

			$asmt = array();
			$record = array();

			foreach ($assessment as $key => $value) {

				ksort($value);
				
				foreach ($value as $key2 => $value2) {

					$asmt[$key2] = $value2;
				}
			}

			$record['Assessment'] = $asmt;
			$record['RUGIV'] = $this->Calc->calcAll($asmt_data);

			if ($state == 'PA') {
				$record['CMI-PA'] = $this->Cmi->calc($asmt_data);
			}

			$record['_id']				= $asmt_data['Assessment']['id'];
			$record['id']				= $asmt_data['Assessment']['id'];
			$record['assessment_id'] 	= $asmt_data['Assessment']['id'];
			$record['state'] 			= $state;
			$record['fac_name'] 		= $fac_name;
			$record['resident_id'] 		= $record['Assessment']['resident_id'];
			$record['facility_id'] 		= $record['Assessment']['facility_id'];

			$this->Report = ClassRegistry::init('Report');
			$this->Report->create();
			$this->Report->save($record, false);

			$this->Dump->execute();

			self::__purge_arrays();
		}

		$msg  = $this->out('finished for '. $year .'-'. $month .'-01 - '.$year .'-'. $month .'-31') 					."\r";
		$msg .= $this->out('imported '. $this->Report->find('count') .' records') 										."\r";

		$msg .= $this->out($this->divider)																				."\r";
		$msg .= $this->out("memory usuage, we're using ". $this->convert(memory_get_usage(true))) 						."\r";

		self::__purge_arrays();

		unset($assessments);

		$msg .= $this->out("memory usuage, after clearing objects ". $this->convert(memory_get_usage(true))) 			."\r";
		$msg .= $this->out($this->divider) 																				."\r";

		$this->output .= $msg;

	}

	private function __purge_arrays () {

		unset($record);
		unset($assessment);
		unset($key); 	unset($key2);
		unset($value); unset($value2);
		unset($asmt);
		
	}

	private function __full_purge_arrays () {

		self::__purge_arrays();
		unset($assessments);
		
	}

	private function convert($size) {
	    $unit=array('b','kb','mb','gb','tb','pb');
	    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
	 }

	private function formatBytes($bytes, $precision = 2) { 
	    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

	    $bytes = max($bytes, 0); 
	    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
	    $pow = min($pow, count($units) - 1); 

	    // Uncomment one of the following alternatives
	    // $bytes /= pow(1024, $pow);
	    // $bytes /= (1 << (10 * $pow)); 

	    return round($bytes, $precision) . ' ' . $units[$pow]; 
	} 

}