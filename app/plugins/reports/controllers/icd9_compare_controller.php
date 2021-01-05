<?php

class Icd9CompareController extends ReportsAppController {
  
  public $uses = array();
	public $components = array('Excel');
  
  public function index () {
    
  }
  
  public function view ($facility_id) {
    
    $data = $this->__setData($facility_id);
    
    $this->set(compact('data'));
    
  }
	
	public function printer ($facility_id = null) {
    Configure::write('debug', 0);
		
    $this->layout = 'printing';
    $data = $this->__setData($facility_id);
		$this->set(compact('data'));
		
  }
	
	public function excel ($facility_id) {
    Configure::write('debug', 0);
    $data = $this->__setData($facility_id);
		
		$info[] = ',ICD9,,ICD9,,ICD9,,ICD9,,ICD9,,ICD9,,ICD9,,ICD9,,ICD9,,ICD9';
		$info[] = 'Resident,MR,MDS,MR,MDS,MR,MDS,MR,MDS,MR,MDS,MR,MDS,MR,MDS,MR,MDS,MR,MDS,MR,MDS';
       
    foreach ($data as $key => $value) {
      // structure data from residents table
      $str     = $value['name'] .',';
   
	    $str    .= $value['MR1'] .',';
   		if(!empty($value['MDS1']))
				$str    .= $value['MDS1'] .',';
			else
				$str 		.= ',';
				
      $str    .= $value['MR2'] .',';
			if(!empty($value['MDS2']))
				$str    .= $value['MDS2'] .',';
			else
				$str 		.= ',';

      $str    .= $value['MR3'] .',';
			if(!empty($value['MDS3']))
				$str    .= $value['MDS3'] .',';
			else
				$str 		.= ',';
      
			$str    .= $value['MR4'] .','; 
			if(!empty($value['MDS4']))
				$str    .= $value['MDS4'] .',';
			else
				$str 		.= ',';
			
      $str    .= $value['MR5'] .','; 
			if(!empty($value['MDS5']))
				$str    .= $value['MDS5'] .',';
			else
				$str 		.= ',';				
			
			$str    .= $value['MR6'] .','; 
			if(!empty($value['MDS6']))
				$str    .= $value['MDS6'] .',';
			else
				$str 		.= ',';
						
      $str    .= $value['MR7'] .','; 
			if(!empty($value['MDS7']))
				$str    .= $value['MDS7'] .',';
			else
				$str 		.= ',';
			
      $str    .= $value['MR8'] .',';
			if(!empty($value['MDS8']))
				$str    .= $value['MDS8'] .',';
			else
				$str 		.= ',';
			
      $str    .= $value['MR9'] .','; 
			if(!empty($value['MDS9']))
				$str    .= $value['MDS9'] .',';
			else
				$str 		.= ',';
			
      $str    .= $value['MR10'] .',';
			if(!empty($value['MDS10']))
				$str    .= $value['MDS10'] .',';
			else
				$str 		.= ',';
				
			$info[] = $str;
    }
        
    $this->Excel->generate($info);
  }
	
	private function __setData($facility_id) {
    
    Controller::loadModel('Resident');
    Controller::loadModel('Assessment');
    
    $residents = $this->Resident->find('all', array(
      'conditions' => array(
        'Facility.id' => $facility_id,
        'Resident.READM' => ''
      ),
      'fields' => array(
        'Resident.id', 'Resident.PATFNAME', 'Resident.PATLNAME', 'Resident.PATNUM',
        'Resident.ICD91', 'Resident.ICD92', 'Resident.ICD93', 'Resident.ICD94', 'Resident.ICD95', 
        'Resident.ICD96', 'Resident.ICD97', 'Resident.ICD98', 'Resident.ICD99', 'Resident.ICD910'
      ),
      'order' => array('Resident.PATLNAME' => 'ASC', 'Resident.PATFNAME' => 'ASC')
    ));

    foreach ($residents as $key => $value) {
      $id = $value['Resident']['id'];

      // structure data from residents table
      $data[$id]['id']      = $value['Resident']['id'];
      $data[$id]['patnum']  = $value['Resident']['PATNUM'];
      $data[$id]['name']    = $value['Resident']['PATLNAME'] .' '. $value['Resident']['PATFNAME'];
      $data[$id]['MR1']     = $value['Resident']['ICD91'];
      $data[$id]['MR2']     = $value['Resident']['ICD92'];
      $data[$id]['MR3']     = $value['Resident']['ICD93'];
      $data[$id]['MR4']     = $value['Resident']['ICD94'];
      $data[$id]['MR5']     = $value['Resident']['ICD95'];
      $data[$id]['MR6']     = $value['Resident']['ICD96'];
      $data[$id]['MR7']     = $value['Resident']['ICD97'];
      $data[$id]['MR8']     = $value['Resident']['ICD98'];
      $data[$id]['MR9']     = $value['Resident']['ICD99'];
      $data[$id]['MR10']    = $value['Resident']['ICD910'];
      
			
      foreach ($data[$id] as $key => $value) {
        if (!empty($value)) {
          if (preg_match('|MR|', $key)) {
            @list($first, $second) = explode('.', $value);
            
            $first = str_replace('^', '', $first);
            $second = str_replace('^', '', $second);
            
            if (strlen($second) == 1) $second = $second .'0';
            if (strlen($second) == 0) $second = '00';
             
            $data[$id][$key] =  $first .'.'. $second;
          }
        }
      }
        
      // get latest section i from MDS
      $assessment = $this->Assessment->SectionI->findLast($id);
      
      if (!empty($assessment)) {
        

        $data[$id]['MDS1'] = $assessment['SectionI']['I8000A'];
        $data[$id]['MDS2'] = $assessment['SectionI']['I8000B'];
        $data[$id]['MDS3'] = $assessment['SectionI']['I8000C'];
        $data[$id]['MDS4'] = $assessment['SectionI']['I8000D'];
        $data[$id]['MDS5'] = $assessment['SectionI']['I8000E'];
        $data[$id]['MDS6'] = $assessment['SectionI']['I8000F'];
        $data[$id]['MDS7'] = $assessment['SectionI']['I8000G'];
        $data[$id]['MDS8'] = $assessment['SectionI']['I8000H'];
        $data[$id]['MDS9'] = $assessment['SectionI']['I8000I'];
        $data[$id]['MDS10'] = $assessment['SectionI']['I8000J'];
      
        foreach ($data[$id] as $key => $value) {
          
          if (!empty($value)) {
            if (preg_match('|MDS|', $key)) {
              @list($first, $second) = explode('.', $value);
            
              $first = str_replace('^', '', $first);
              $second = str_replace('^', '', $second);
              
              if (strlen($second) == 1) $second = $second .'0';
              if (strlen($second) == 0) $second = '00';
               
              $data[$id][$key] =  $first .'.'. $second;
            }
          }
        }


      }
      
    }
    
    return $data;
    
  }
  
  
  
}