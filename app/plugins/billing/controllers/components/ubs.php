<?php

App::import('Helper', 'Time');
class UbsComponent extends Object {
	
	var $name = 'Ubs';
	public $components = array('AssessmentType', 'Calc', 'Clock');
	public $path = null;
	public $str = '';
	
	public function generate ($conditions) {
		
		$this->RugCache = ClassRegistry::init('RugCache');
		
		$data = $this->RugCache->find('all', array(
			'conditions' => $conditions,
		));

		foreach ($data as $key => $value) {
		
			if ($value['RugCache']['isc'] != 'NT') {		
				
				$this->AssessmentType = new AssessmentTypeComponent();
				$this->Time = new TimeHelper();
			
				$replace = array(',','-');		
				
				list($year,$month,$day) = explode('-', $value['RugCache']['date_parta']);
				
				list($year,$month,$day) = explode('-', $value['RugCache']['date_ard']);
				
				$T_RUG 	= $value['RugCache']['rug_therapy'];
				$N_RUG 	= $value['RugCache']['rug_nursing'];
				$HIPPS 	= $value['RugCache']['rug_hipps'];
				$MINS 	= $value['RugCache']['minutes_ttl'];
				
				$cvr_from = '';
				if ($value['RugCache']['cvr_from'] != '0000-00-00') {
					list($year,$month,$day) = explode('-', $value['RugCache']['cvr_from']);
					$cvr_from 	= $month .'/'. $day .'/'. $year;
				}
				$cvr_end = '';
				if ($value['RugCache']['cvr_end'] != '0000-00-00') {
					list($year,$month,$day) = explode('-', $value['RugCache']['cvr_end']);
					$cvr_end	 		= $month .'/'. $day .'/'. $year;
				}
				
				$modified = $value['RugCache']['type'];
				 
				$fields = array();
				$fields['patnum']	 		= $value['Resident']['PATNUM'];
				$fields['patfname'] 	= str_replace($replace, '', $value['Resident']['PATFNAME']);
				$fields['patmi']			= str_replace($replace, '', $value['Resident']['PMI']);
				$fields['patlname'] 	= str_replace($replace, '', $value['Resident']['PATLNAME']);
				$fields['mcarenbr'] 	= $value['Resident']['MEDICARE'];
				$fields['assesstype'] = $value['RugCache']['isc'];
				$fields['asmt_lck'] 	= $this->Time->format('m/d/Y', $value['RugCache']['date_locked']);	
				$fields['partastart']	= $month .'/'. $day .'/'. $year;
				$fields['a3a']				= $month .'/'. $day .'/'. $year;
				$fields['begindate'] 	= '';
				$fields['t3mdcr'] 		= $T_RUG;
				$fields['t3state'] 		= '';
				$fields['hipps_mod'] 	= $HIPPS;
				$fields['revcode'] 		= '';
				$fields['coverdfrom'] = $cvr_from;
				$fields['coverdto'] 	= $cvr_end;
				$fields['totcvrdays'] = $value['RugCache']['cvr_days'];
				$fields['print_it'] 	= '';
				$fields['sequence'] 	= '';
				$fields['active'] 		= 'TRUE';
				$fields['float'] 			= 'FALSE';
				$fields['fltdays'] 		= 0;
				$fields['modified'] 	= $modified;
				$fields['open4edit'] 	= ($value['RugCache']['type'] == 2) ? 'TRUE' : 'FALSE' ;
				$fields['rec_type'] 	= $this->AssessmentType->pps($value);
				$fields['qtrnum'] 		= 0;
				$fields['aa8a'] 			= $value['SectionA']['A0310A'];
				$fields['aa8b'] 			= $value['SectionA']['A0310B'];
				$fields['accept_dt'] 	= $this->Time->format('m/d/Y', $value['RugCache']['modified']);
				$fields['THSU'] 			= $value['RugCache']['minutes_speech'];
				$fields['THSD'] 			= $value['SectionO']['O0400A4'];
				$fields['THSE'] 			= $value['SectionO']['O0400A6'];
				$fields['THOU'] 			= $value['RugCache']['minutes_occupational'];
				$fields['THOD'] 			= $value['SectionO']['O0400B4'];
				$fields['THOE'] 			= $value['SectionO']['O0400B6'];
				$fields['THPU'] 			= $value['RugCache']['minutes_physical'];
				$fields['THPD'] 			= $value['SectionO']['O0400C4'];
				$fields['THPE'] 			= $value['SectionO']['O0400C6'];
				$fields['THRD'] 			= (empty($value['SectionO']['O0400D1'])) ? 0 : $value['SectionO']['O0400D1'];
				$fields['THRE'] 			= $value['SectionO']['O0400D2'];

				
				if (!isset($this->content))
					$this->content = join(',', $fields) . "\r\n";
				else 
					$this->content .= join(',', $fields) . "\r\n";
			}
		}
		
		// Output the headers to download the file
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=ubrug.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $this->content;
	}	
	
}