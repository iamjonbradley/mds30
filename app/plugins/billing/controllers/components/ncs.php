<?php

class NcsComponent extends Object {
	
	public $name = 'Ncs';
	public $components = array('AssessmentType', 'Calc', 'Clock');
	public $path = null;
	public $str = '';
	public $content = '';
	
	public function generate ($conditions) {
		
		$this->RugCache = ClassRegistry::init('RugCache');
		$this->path = WWW_ROOT .'billing'. DS .'ncs'. DS .'%s'. DS .'mds_import.csv';
		
		$data = $this->RugCache->find('all', array(
			'conditions' => $conditions,
		));
		
		foreach ($data as $key => $value) {
		
			if ($value['RugCache']['isc'] != 'NT') {		
			
				$replace = array(',','-');		
				
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
				
				list($year,$month,$day) = explode('-', $value['RugCache']['date_ard']);
				
				$fields = array();
				$fields[] 	= str_replace($replace, '', $value['Resident']['PATLNAME']);
				$fields[] 	= str_replace($replace, '', $value['Resident']['PATFNAME']);
				$fields[] 	= $this->formatSSN($value['Resident']['SSNUM']);
				$fields[] 	= $T_RUG . $HIPPS;
				$fields[] 	= $month .'/'. $day .'/'. $year;
				$fields[]	= 	$cvr_from;
				$fields[] 	= $cvr_end;
				$fields[] 	= $HIPPS;
				
				if (!isset($this->content))
					$this->content = join(',', $fields) . "\r\n";
				else 
					$this->content .= join(',', $fields) . "\r\n";
				
			}
		}
		
		// Output the headers to download the file
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=mds_export.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $this->content;
	}	
	
    function formatSSN($ssn) {
        $ssn = str_replace('-', '', $ssn);
        return substr($ssn, 0, 3) .'-'. substr($ssn, 3, -4) .'-'. substr($ssn, 5, 4);
    }
	
}