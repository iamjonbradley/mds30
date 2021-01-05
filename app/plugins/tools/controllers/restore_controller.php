<?php

// set the default paths
define('IMPORT',    TMP     .'import'.    DS);
define('PENDING',   IMPORT  .'pending'.   DS);
define('PROCESSED', IMPORT  .'processed'. DS);

App::import('Core', array('Xml', 'Set', 'Folder', 'File')); 
class RestoreController extends AppController {
  
  public $components = array('Validation', 'Caa');
  public $uses = array('Assessment', 'Resident', 'CarePlan', 'SectionV');
  public $layout = 'ajax';
  
  function index () {
    // $this->fix_care_plans();
    $this->import_transmission_files();
  }
  
  function care_plans () {
	  
	  $data = $this->CarePlan->find('all', array('recursive' => -1));
	  
	  foreach ($data as $key => $value) {
	    $info['SectionV'] = $value['CarePlan'];
	    $info['SectionV']['id'] = $value['CarePlan']['assessment_id'];
	    $this->SectionV->save($info['SectionV'], false);
	  }
    
  }
  
  function fix_care_plans () {
    $data = $this->SectionV->find('all', array(
      'recursive' => -1  
    ));
    
    foreach ($data as $key => $value) {
      $careplan = $value['SectionV'];
      $this->CarePlan->create();
      $this->CarePlan->save($careplan, false);
    }
  }
  
  function import_transmission_files () {
    $assessments = $this->Assessment->find('list', array(
      'fields' => array('Assessment.id', 'Assessment.facility_id'),
      'recursive' => -1
    ));
    
    foreach ($assessments as $key => $value) {
      
      $file = $key .'.xml';
      
      // grab the new file
      $this->File = new File(PENDING . $file);
      
      // process the file if it exists
      if ($this->File->exists()) {
        // copy the file to pending import
        copy (PENDING . $file, IMPORT . $file);
        
        // process the migration file
        $this->migration($key, $value);
        
        // copy the file to processed
        copy (IMPORT . $file, PROCESSED . $file);
        
        // remove the processed file
        unlink (IMPORT  . $file);
      }
      
    }
    
  }
  
  function migration ($file, $facility_id) {
    
    // set the filename of what to grab
	  $filename = IMPORT . $file .'.xml';
    $xml = new Xml($filename);
    $xmlAsArray = Set::reverse($xml);
    $xmlAsArray = $xml->toArray();
    $info= $xmlAsArray['ASSESSMENT'];
    
    // fix all teh dates
    $info = $this->__fixAllDates($info);
    
    // set assessment details
    $data['Assessment']['id']                   = $file;
    
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
      
      if (is_array($value)) $value = $value[0];
      
      // get the first letter of the key 
      $letter = substr($key, 0, 1);
      $data['Section'. $letter][$key] = $value;
      $data['Section'. $letter]['id'] = $file;
      $data['Section'. $letter]['assessment_id'] = $file;
      $data['Section'. $letter]['validated'] = 1;
      
      
      ksort($data['Section'. $letter]);
    }
    
    ksort($data);
    
	  $this->Assessment->create();
    $this->Assessment->saveAll($data, array('validate' => false));
  }
  
  private function __fixAllDates($info) {
    
    // fix the dates
    if (isset($info['A0900']))    $info['A0900']    = $this->__fixDate($info['A0900']);
    if (isset($info['A1600']))    $info['A1600']    = $this->__fixDate($info['A1600']);
    if (isset($info['A2300']))    $info['A2300']    = $this->__fixDate($info['A2300']);
    if (isset($info['A2400B']))   $info['A2400B']   = $this->__fixDate($info['A2400B']);
    if (isset($info['A2400C']))   $info['A2400C']   = $this->__fixDate($info['A2400C']);
    if (isset($info['V0100C']))   $info['V0100C']   = $this->__fixDate($info['V0100C']);
    if (isset($info['V0200B2']))  $info['V0200B2']  = $this->__fixDate($info['V0200B2']);
    if (isset($info['V0200C2']))  $info['V0200C2']  = $this->__fixDate($info['V0200C2']);
    if (isset($info['Z0500B']))   $info['Z0500B']   = $this->__fixDate($info['Z0500B']);
    
    // reversed dates
    if(isset($info['O0250B']))    $info['O0250B']   = $this->__reverse($info['O0250B']);
    if(isset($info['O0400A5']))   $info['O0400A5']  = $this->__reverse($info['O0400A5']);
    if(isset($info['O0400A6']))   $info['O0400A6']  = $this->__reverse($info['O0400A6']);
    if(isset($info['O0400B5']))   $info['O0400B5']  = $this->__reverse($info['O0400B5']);
    if(isset($info['O0400B6']))   $info['O0400B6']  = $this->__reverse($info['O0400B6']);
    if(isset($info['O0400C5']))   $info['O0400C5']  = $this->__reverse($info['O0400C5']);
    if(isset($info['O0400C6']))   $info['O0400C6']  = $this->__reverse($info['O0400C6']);
    
    return $info;
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