<?php

App::import('Core', array('Xml', 'Set', 'Folder', 'File')); 
App::import('Component',array('Caa', 'Skip')); 
class ImportFacilitiesShell extends Shell {  

  function main() {
		// get facility id from the command line parameter
		$this->facility_id = $this->args[0];
		
		$this->Caa =& new CaaComponent(null);
		$this->Skip =& new SkipComponent(null);
    $this->Assessment = ClassRegistry::init('Assessment');
    $this->Resident    = ClassRegistry::init('Resident');
		
		$data = $this->__readFolder();
			
		// save the assessment data
		$i = 0;
		foreach ($data as $key => $value) {
			$info = $this->__parseFile($value);
			if (!empty($info)) {
				$this->migration($info, $value, $this->facility_id);
				$i++;
			}
		}
	}  
  
  function migration ($info, $file, $facility_id) {
		
    // set the filename of what to grab
    $info = $this->__fixAllDates($info);

    // set assessment details
    $data['Assessment']['ASMT_SYS_CD']          = $info['ASMT_SYS_CD'];
    $data['Assessment']['ITM_SBST_CD']          = $info['ITM_SBST_CD'];
    $data['Assessment']['ITM_SET_VRSN_CD']      = $info['ITM_SET_VRSN_CD'];
    $data['Assessment']['SPEC_VRSN_CD']         = $info['SPEC_VRSN_CD'];
    $data['Assessment']['PRODN_TEST_CD']        = $info['PRODN_TEST_CD'];
    $data['Assessment']['STATE_CD']             = $info['STATE_CD'];
    $data['Assessment']['FAC_ID']               = $info['FAC_ID'];
    $data['Assessment']['SFTWR_VNDR_ID']        = $info['SFTWR_VNDR_ID'];
    $data['Assessment']['SFTWR_VNDR_NAME']      = $info['SFTWR_VNDR_NAME'];
    $data['Assessment']['SFTWR_VNDR_EMAIL_ADR'] = $info['SFTWR_VNDR_EMAIL_ADR'];
    $data['Assessment']['SFTWR_PROD_NAME']      = $info['SFTWR_PROD_NAME'];
    $data['Assessment']['SFTWR_PROD_VRSN_CD']   = $info['SFTWR_PROD_VRSN_CD'];
    $data['Assessment']['FAC_DOC_ID']           = $info['FAC_DOC_ID'];
    $data['Assessment']['transmission_status']  = 0;
    $data['Assessment']['resident']             = $facility_id.'-'. $info['A1300A'];
    $data['Assessment']['facility_id']          = $facility_id;
    $data['Assessment']['validated']            = 1;
    $data['Assessment']['deleted']              = 0;
    $data['Assessment']['locked']               = 1;
    $data['Assessment']['type']                 = $info['ITM_SBST_CD'];

	
		//set Resident 
		$resident_data = $this->Resident->find('first', array(
      'conditions' => array('Resident.id' => $info['A1300A'])
    ));
    
    $resident_data['Resident']['id'] = $facility_id.'-'. $info['A1300A'];

    $resident_data['Resident']['PATFNAME']    = $info['A0500A'];
    $resident_data['Resident']['PMI']         = $info['A0500B'];
    $resident_data['Resident']['PATLNAME']    = $info['A0500C'];

    $resident_data['Resident']['PATNUM']      = $info['A1300A'];
    $resident_data['Resident']['READM']       = '';

    $resident_data['Resident']['ROOM']        = $info['A1300B'];
    $resident_data['Resident']['SSNUM']       = $info['A0600A'];
    $resident_data['Resident']['MEDICARE']    = $info['A0600B'];
    $resident_data['Resident']['MEDICAID']    = $info['A0700'];
		$resident_data['Resident']['facility_id'] = $facility_id;	

		$this->Resident->save($resident_data, false);
		
    // unset details not needed anywhere else
    unset($info['ASMT_SYS_CD']);
    unset($info['ITM_SBST_CD']);
    unset($info['ITM_SET_VRSN_CD']);
    unset($info['SPEC_VRSN_CD']);
    unset($info['PRODN_TEST_CD']);
    unset($info['STATE_CD']);
    unset($info['FAC_ID']);
    unset($info['SFTWR_VNDR_ID']);
    unset($info['SFTWR_VNDR_NAME']);
    unset($info['SFTWR_VNDR_EMAIL_ADR']);
    unset($info['SFTWR_PROD_NAME']);
    unset($info['SFTWR_PROD_VRSN_CD']);
    unset($info['FAC_DOC_ID']);
    unset($info['LOCK_DATE']);
    unset($info['TRANSMISSION_STATUS']);
   // unset($info['RESIDENT']);

    foreach ($info as $key => $value) {
      
      if ($value == '^') $value = '';
      
      // get the first letter of the key 
      $letter = substr($key, 0, 1);
      $data['Section'. $letter][$key] = $value;
      $data['Section'. $letter]['id'] = '';
      $data['Section'. $letter]['assessment_id'] = '';
      $data['Section'. $letter]['validated'] = 1;
      ksort($data['Section'. $letter]);
    }
        

    if (isset($info['Z0500B'])) {
      $date = $info['Z0500B'];
      
      // set lock date
      $file = str_replace('.xml','', $file);
      $lockdate  = substr($date, 4, 4) .'-';
      
      if (strlen($date) == 7) {
        $lockdate  = substr($date, 3, 4) .'-';
        $lockdate .= substr($date, 0, 2) .'-';
        $lockdate .= '0'. substr($date, 2, 1);
      }
      else {
        $lockdate  = substr($date, 4, 4) .'-';
        $lockdate .= substr($date, 0, 2) .'-';
        $lockdate .= substr($date, 2, 2);
      }
      
      $data['Assessment']['lock_date'] = $lockdate;
      
      if (isset($data['SectionZ']['Z0500B']))
        $data['Assessment']['lock_date'] = $data['SectionZ']['Z0500B'];
    }
			
		// check to see if field is an array if so set it as a field so it can be properly saved	
		if (isset($data['SectionA']) && is_array($data['SectionA']['A0310A'])) {

			if($data['SectionA']['A0310A'][0] == '03') {
				$data['SectionA']['A0310A'] = "03";
			}
			else if ($data['SectionA']['A0310A'][0] == '01') {
				$data['SectionA']['A0310A'] = "01";
			}
		}

    $data['Assessment']['transmission_status'] = 2;

    // set resident information
    $data['Resident']['id'] = $facility_id.'-'. $info['A1300A'];
    $data['Resident']['facility_id'] = $facility_id;
    $data['Resident']['PATFNAME'] = $info['A0500A'];
    $data['Resident']['PATLNAME'] = $info['A0500C'];

    ksort($data);

	  $this->Assessment->create();
    $this->Assessment->save($data['Assessment'], array('validate' => false));

    unset ($data['Assessment']);
    unset ($data['Resident']);

    foreach ($data as $key => $value) {
      $this->Model = ClassRegistry::init($key);
      $this->Model->create();
      $data[$key]['id'] = $this->Assessment->id;
      $data[$key]['assessment_id'] = $this->Assessment->id;
      $this->Model->save($data[$key], array('validate' => false));
    }
  }
  
  private function __fixAllDates($info) {
    
    // A2300
    if (isset($info['A0900'])) $info['A0900'] = $this->__fixDate($info['A0900']);
    if (isset($info['A1600'])) $info['A1600'] = $this->__fixDate($info['A1600']);
    if (isset($info['A2300'])) $info['A2300'] = $this->__fixDate($info['A2300']);
    if (isset($info['A2400B'])) $info['A2400B'] = $this->__fixDate($info['A2400B']);
    if (isset($info['A2400C'])) $info['A2400C'] = $this->__fixDate($info['A2400C']);
    if (isset($info['V0100C'])) $info['V0100C'] = $this->__fixDate($info['V0100C']);
    if (isset($info['V0200B2'])) $info['V0200B2'] = $this->__fixDate($info['V0200B2']);
    if (isset($info['V0200C2'])) $info['V0200C2'] = $this->__fixDate($info['V0200C2']);
    if (isset($info['Z0500B'])) $info['Z0500B'] = $this->__fixDate($info['Z0500B']);
    
    // reversed dates
    if(isset($info['O0250B'])) $info['O0250B'] = $this->__reverse($info['O0250B']);
    if(isset($info['O0400A5'])) $info['O0400A5'] = $this->__reverse($info['O0400A5']);
    if(isset($info['O0400A6'])) $info['O0400A6'] = $this->__reverse($info['O0400A6']);
    if(isset($info['O0400B5'])) $info['O0400B5'] = $this->__reverse($info['O0400B5']);
    if(isset($info['O0400B6'])) $info['O0400B6'] = $this->__reverse($info['O0400B6']);
    if(isset($info['O0400C5'])) $info['O0400C5'] = $this->__reverse($info['O0400C5']);
    if(isset($info['O0400C6'])) $info['O0400C6'] = $this->__reverse($info['O0400C6']);
   
    return $info;
  }
  
  private function __readFolder() {
    $this->dir = TMP .'import'. DS;
    $this->Folder = new Folder($this->dir);
    $data = $this->Folder->read();
    return $data[1];
  }
  
  private function __parseFile($file) {
	  $filename = $this->dir . $file;
    $xml = new Xml($filename);
    $xmlAsArray = Set::reverse($xml);
    $xmlAsArray = $xml->toArray();
    return $xmlAsArray['ASSESSMENT'];
  }
  
  private function __fixDate($date) {
    $n  = substr($date, 0, 4) .'-';
    $n .= substr($date, 4, 2) .'-';
    $n .= substr($date, 6, 2);
    return $n;
  }
  
  private function __reverse($date) {
    $date = str_replace('-', '', $date);
    $date = substr($date,4,4) . substr($date,0,4);
    return $date;
  }
}