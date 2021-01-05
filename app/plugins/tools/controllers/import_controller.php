<?php

Configure::write('debug', 2);
App::import('Core', array('Xml', 'Set', 'Folder', 'File')); 
class ImportController extends AppController {
  
  public $components = array('Validation', 'Caa');
  public $uses = array('Assessment', 'Resident');
  
  
  function index ($facility_id) {
    $data = $this->__readFolder();
    
    // save the assessment data
    $i = 0;
    foreach ($data as $key => $value) {
      
	    $info = $this->__parseFile($value);

	    if (!empty($info)) {
        $this->migration($info, $value, $facility_id);
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
    $data['Assessment']['transmission_status']  = 2;
    $data['Assessment']['resident']             = $facility_id.'-'. $info['A1300A'];
    $data['Assessment']['facility_id']          = $facility_id;
    $data['Assessment']['validated']            = 1;
    $data['Assessment']['deleted']              = 0;
    $data['Assessment']['locked']               = 1;
    $data['Assessment']['type']                 = $info['ITM_SBST_CD'];
    
    
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
    unset($info['RESIDENT']);

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
    
    // set lock date
    $file = str_replace('.xml','', $file);
    list($fac,$ass,$type,$date) = explode('_', $file);

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
    
    $data = $this->Caa->report($data);
    ksort($data);
    
	  $this->Assessment->create();
    $this->Assessment->saveAll($data, array('validate' => false));
    echo $this->Assessment->id .'<br>';
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