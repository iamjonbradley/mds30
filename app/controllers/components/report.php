<?php

App::import('Core', array('Sanitize', 'File'));
App::import('Component', array('AssessmentType', 'Session', 'Zip', 'Caa', 'Calc'));
class ReportComponent extends Object {
  
  public $name = 'Report';
  public $components = array('AssessmentType', 'Session', 'Zip', 'Caa', 'Calc');
  
  public function __construct() {
    $this->Assessment = ClassRegistry::init('Assessment');  
    $this->BulkSubmissionAssessment = ClassRegistry::init('BulkSubmissionAssessment');  
    $this->Bulk = ClassRegistry::init('Bulk');
    $this->AssessmentType = new AssessmentTypeComponent();
    $this->Caa = new CaaComponent();
    $this->Zip = new ZipComponent();
    $this->Session = new SessionComponent();
  }
  
  public function createTransmissionfile ($id, $state) {
    
    $data = $this->structureData($id, $state);
    
    // set facility information
    $data['Assessment']['FAC_ID'] = $data['Facility']['FAC_ID'];
    $data['Assessment']['STATE_CD'] = $data['Facility']['F_STATE'];

    // remove fields that we do not need
    $facility_id = $data['Assessment']['facility_id'];
    unset($data['Assessment']['facility_id']);
    unset($data['Facility']);
    
    // set the file information
    $filename = WWW_ROOT .'transmission_files'. DS . 'pending' . DS . $id  .'.xml';

    $type = ClassRegistry::init('Isc')->get($data);
    
    $data['Assessment']['FAC_DOC_ID'] = $data['Assessment']['id'];

    switch ($data['Assessment']['item_subset']) {
      case '1.00':
        $ITM_SET_VRSN_CD = $data['Assessment']['item_subset'];
        $SPEC_VRSN_CD = '1.00';
        $RUG_VERSION = '1.0166';
        break;
      case '1.10':
        $ITM_SET_VRSN_CD = $data['Assessment']['item_subset'];
        $SPEC_VRSN_CD = '1.10';
        $RUG_VERSION = '1.0266';
        break;
    }

    $rug_therapy = $this->Calc->calcRugTherapy($data);
    $rug_nursing = $this->Calc->calcRugNonTherapy($data);
    $rug_hipps   = $this->Calc->calcModifier($data);
    $rug_sot     = $this->Calc->calcSOT($data);
    
    if (isset($data['SectionZ'])){
      $data['SectionZ']['Z0100A'] = $rug_therapy . $rug_hipps;
      $data['SectionZ']['Z0100B'] = '1.0266';
      $data['SectionZ']['Z0100C'] = $rug_sot;

      if (empty($data['SectionZ']['Z0100C']))
      $data['SectionZ']['Z0100C'] = 0;
      
      $data['SectionZ']['Z0150A'] = $rug_nursing . $rug_hipps;
      $data['SectionZ']['Z0150B'] = '1.0266';
    }

    // save rug score
    $this->RugCache = ClassRegistry::init('RugCache');
    $this->Assessment->RugCache->update_cache($data['Assessment']['id']);
    
    unset ($data['Assessment']['id']);
    unset ($data['Assessment']['transmission_status']);
    unset ($data['Assessment']['resident']);
    unset ($data['Assessment']['type']);
    
    // get the settings
    $settings = $this->Session->read('Settings');
    
    // set software information
    $data['Assessment']['SFTWR_VNDR_ID'] = $settings['SFTWR_VNDR_ID'];
    $data['Assessment']['SFTWR_VNDR_NAME'] = $settings['SFTWR_VNDR_NAME'];
    $data['Assessment']['SFTWR_VNDR_EMAIL_ADR'] = $settings['SFTWR_VNDR_EMAIL_ADR'];
    $data['Assessment']['SFTWR_PROD_NAME'] = $settings['SFTWR_PROD_NAME'];
    $data['Assessment']['SFTWR_PROD_VRSN_CD'] = '2.0.0';
    $data['Assessment']['SFTWR_PROD_NAME'] = $settings['SFTWR_PROD_NAME'];
    $data['Assessment']['SPEC_VRSN_CD']   = $SPEC_VRSN_CD;
    $data['Assessment']['ITM_SET_VRSN_CD']  = $ITM_SET_VRSN_CD;

    // set item set information
    $data['Assessment']['ITM_SBST_CD'] = $type;

    if (
      (isset($data['SectionA']['A0050']) && $data['SectionA']['A0050'] == '3') || 
      (isset($data['SectionX']['X0100']) && $data['SectionX']['X0100'] == '3')
    ) {
      $data['Assessment']['ITM_SBST_CD'] = 'XX';
    }

      if (isset($data['SectionA']['A0310F']) && $data['SectionA']['A0310F'] != 10 && $data['SectionA']['A0310F'] != 11)
        unset($this->validate['A0310G']);
      
    if ($data['SectionA']['A0200'] == '1') {
      $data['SectionA']['A0310D'] = '^';
    }

    ksort($data);

    // loop through the data
    foreach ($data as $key => $value) {

      ksort($value);
      
      // loop through each of the models in the data
      foreach ($value as $key2 => $value2) {
      
      $value2 = str_replace('&', '', $value2);
      $value2 = trim($value2);
      
      if ( preg_match('|--------|', $value2)) $value2 = '--------';
      
      if ($key2 == 'lock_date') 	$value2 = str_replace('-', '', $value2);
      if ($key2 == 'A2300') 		$value2 = str_replace('-', '', $value2);
      if ($key2 == 'A2400B') 		$value2 = str_replace('-', '', $value2);
      if ($key2 == 'A2000') 		$value2 = str_replace('-', '', $value2);
      
      if ($key2 == 'O0250B') 		$value2 = str_replace('-', '', $value2);
      
      
      if ($key2 == 'O0400A5') 	$value2 = str_replace('-', '', $value2);
      //if ($key2 == 'O0400A6' && $value2 != '--------') 	$value2 = str_replace('-', '', $value2);
      
      if ($key2 == 'O0400B5') 	$value2 = str_replace('-', '', $value2);
      
      //if ($key2 == 'O0400B6' && $value2 != '--------') 	$value2 = str_replace('-', '', $value2);
      
      if ($key2 == 'O0400C5') 	$value2 = str_replace('-', '', $value2);
      //if ($key2 == 'O0400C6' && $value2 != '--------') 	$value2 = str_replace('-', '', $value2);
      
      
      if ($key2 == 'O0450B') 	$value2 = str_replace('-', '', $value2);
      
      
      if ($key2 == 'M0300B3' && preg_match('|--|', $value2)) $value2 = '--------';
      
      if ($key2 == 'M0300B3' && $value2 != '--------') 	$value2 = str_replace('-', '', $value2);

      if ($key2 == 'O0400A6' && $value2 != '--------') $value2 = str_replace('-', '', $value2);
      if ($key2 == 'O0400B6' && $value2 != '--------') $value2 = str_replace('-', '', $value2);
      if ($key2 == 'O0400C6' && $value2 != '--------') $value2 = str_replace('-', '', $value2);
      
      if ($key2 == 'S9080B') 		$value2 = str_replace('-', '', $value2);
      if ($key2 == 'S9080D') 		$value2 = str_replace('-', '', $value2);
      
      if ($key2 == 'Z0500B') 		$value2 = str_replace('-','',$data['Assessment']['lock_date']);
      if ($key2 == 'V0200B2') 	$value2 = str_replace('-','',$data['Assessment']['lock_date']);
      if ($key2 == 'V0200C2') 	$value2 = str_replace('-','',$data['Assessment']['lock_date']);
      
      if ($key2 == 'A0900')  		$value2 = str_replace('-','',$value2);
      if ($key2 == 'A2200')  		$value2 = str_replace('-','',$value2);
      if ($key2 == 'A1600')  		$value2 = str_replace('-','',$value2);
      if ($key2 == 'V0100C') 		$value2 = str_replace('-','',$value2);
      if ($key2 == 'X0400')  		$value2 = str_replace('-','',$value2);
      if ($key2 == 'X0500')  		$value2 = str_replace('-','',$value2);
      if ($key2 == 'X0700A') 		$value2 = str_replace('-','',$value2);
      if ($key2 == 'X0700B') 		$value2 = str_replace('-','',$value2);
      if ($key2 == 'X0700C') 		$value2 = str_replace('-','',$value2);
      if ($key2 == 'X1100E') 		$value2 = str_replace('-','',$value2);
      
      if (($key2 == 'K0200A')  && strpos($value2, '-')) $value2 = '';
      if (($key2 == 'K0200B')  && strpos($value2, '-')) $value2 = '';
      
      
      if ($key2 == 'A2400C' && strlen($value2) == 10) {
        $value2 = str_replace('-', '', $value2);
        if ($value2 == '') $value2 = '--------';
      }
      
      if ($key2 == 'I8000A' && !empty($value2)) $value2 = $this->fixIDC($value2);
      if ($key2 == 'I8000B' && !empty($value2)) $value2 = $this->fixIDC($value2);
      if ($key2 == 'I8000C' && !empty($value2)) $value2 = $this->fixIDC($value2);
      if ($key2 == 'I8000D' && !empty($value2)) $value2 = $this->fixIDC($value2);
      if ($key2 == 'I8000E' && !empty($value2)) $value2 = $this->fixIDC($value2);
      if ($key2 == 'I8000F' && !empty($value2)) $value2 = $this->fixIDC($value2);
      if ($key2 == 'I8000G' && !empty($value2)) $value2 = $this->fixIDC($value2);
      if ($key2 == 'I8000H' && !empty($value2)) $value2 = $this->fixIDC($value2);
      if ($key2 == 'I8000I' && !empty($value2)) $value2 = $this->fixIDC($value2);
      if ($key2 == 'I8000J' && !empty($value2)) $value2 = $this->fixIDC($value2);
      
      if (($key2 == 'A2000')  && preg_match('|-|', $value2)) $value2 = '';
      if (($key2 == 'A2400C') && $value2 == '') $value2 = '';
      
      if ($key2 == 'V0200B2') $value2 = str_replace('-','',$data['Assessment']['lock_date']);
      
      if (($key2 == 'O0700') && $value2 > 14) $value2 = '14';
      
      if (($key2 == 'O0600') && empty($value2)) $value2 = '0';
      if (($key2 == 'O0700') && empty($value2)) $value2 = '0';
      
      if ($key2 == 'A1300D') { 
        $value2 = str_replace(array('&', 'amp;'), '', $value2);
      }
      
      // check if the value is empty
      if (strlen($value2) == '0') {
        $value2 = '^';
      }
      
      $content[strtoupper($key2)] = trim(strtoupper($value2));
      }
    }

    // start creation of the xml files
    $xml  = '<?xml version="1.0" encoding="UTF-8"?>' ."\n";
    $xml .= '<ASSESSMENT>' ."\n";
    foreach ($content as $key => $value) {
      $xml .= "<$key>$value</$key>" ."\n";
    }
    $xml .= '</ASSESSMENT>';

    // create/open the file 
    $this->File = new File($filename, true);
    $this->File->write($xml);
    $this->File->close();
  

  }

  public function structureData ($id) {
    // get the information from assessment
    $info = ClassRegistry::init('Assessment')->find('first', array(
      'conditions' => array('Assessment.id' => Sanitize::clean($id)),
      'fields' => array(
      'Facility.F_STATE',
      'SectionA.A0200', 'SectionA.A0310A', 'SectionA.A0310B', 'SectionA.A0310C', 'SectionA.A0310D', 'SectionA.A0310E', 'SectionA.A0310F', 
      'SectionA.A2300', 'SectionA.A1600', 'SectionA.A0900',
      'Assessment.id', 'Assessment.type', 'Assessment.item_subset'
      ),
      'recursive' => -2
    ));

    $state = $info['Facility']['F_STATE'];
    
    // set the fields
    $type = $info['Assessment']['type'];
    $fields = ClassRegistry::init('ReportType')->getType($info['Assessment']['type'], $info['Assessment']['item_subset']);

    $fields[] = 'Assessment.id';
    $fields[] = 'Assessment.type';
    
    // set fields for PA
    if ($state == 'PA') {
      if ($type == 'NT') {
        $fields[] = 'SectionS.S0120'; $fields[] = 'SectionS.S0123'; $fields[] = 'SectionS.S9080E';
      }
      if ($type == 'ND') {
        $fields[] = 'SectionS.S0120'; $fields[] = 'SectionS.S0123'; $fields[] = 'SectionS.S9080E'; $fields[] = 'SectionS.S8010H1';
      }
      $fields[] = 'SectionS.S9080A'; $fields[] = 'SectionS.S9080B'; $fields[] = 'SectionS.S9080C'; $fields[] = 'SectionS.S9080D'; 
      $fields[] = 'SectionS.S9080D';  $fields[] = 'SectionS.S8010H1';
    }
    
    // set fields for FL
    if ($state == 'FL') {
      if ($type == 'NC' || $type == 'NQ' || $type == 'NP' || $type == 'NT') {
      $fields[] = 'SectionS.S9100A'; $fields[] = 'SectionS.S9100B'; $fields[] = 'SectionS.S9100C';
      }
    }
    
    // set fields for IL
    if ($state == 'IL') {
      if ($type == 'NC') {
      $fields[] = 'SectionS.S2010';  $fields[] = 'SectionS.S2011';  $fields[] = 'SectionS.S4000A'; $fields[] = 'SectionS.S4000B';
      $fields[] = 'SectionS.S4000C'; $fields[] = 'SectionS.S4000D'; $fields[] = 'SectionS.S4010A'; $fields[] = 'SectionS.S4010B';
      $fields[] = 'SectionS.S4010C'; $fields[] = 'SectionS.S4010D'; $fields[] = 'SectionS.S4010E'; $fields[] = 'SectionS.S4500';
      $fields[] = 'SectionS.S4510A'; $fields[] = 'SectionS.S4510B'; $fields[] = 'SectionS.S4510C'; $fields[] = 'SectionS.S4510D';
      $fields[] = 'SectionS.S4510E'; $fields[] = 'SectionS.S4510F'; $fields[] = 'SectionS.S9000';  $fields[] = 'SectionS.S9001';
      $fields[] = 'SectionS.S9002A'; $fields[] = 'SectionS.S9002B'; $fields[] = 'SectionS.S9002C'; $fields[] = 'SectionS.S9002D';
      $fields[] = 'SectionS.S9002E'; $fields[] = 'SectionS.S9002F'; $fields[] = 'SectionS.S9002G'; $fields[] = 'SectionS.S9002H';
      $fields[] = 'SectionS.S9002i'; $fields[] = 'SectionS.S9003';
      }
      if ($type == 'NQ') {
      // set S
      $fields[] = 'SectionE.E0300';   $fields[] = 'SectionE.E0500A';  $fields[] = 'SectionE.E0500B';   $fields[] = 'SectionE.E0500C';  
      $fields[] = 'SectionE.E0600A'; $fields[] = 'SectionE.E0600B';  $fields[] = 'SectionE.E0600C';  $fields[] = 'SectionE.E1000A';   
      $fields[] = 'SectionE.E1000B';  $fields[] = 'SectionE.E1100'; $fields[] = 'SectionF.F0300';   $fields[] = 'SectionF.F0400A';  
      $fields[] = 'SectionF.F0400B';   $fields[] = 'SectionF.F0400C';  $fields[] = 'SectionF.F0400D'; $fields[] = 'SectionF.F0400E';  
      $fields[] = 'SectionF.F0400F';  $fields[] = 'SectionF.F0400G';   $fields[] = 'SectionF.F0400H';  $fields[] = 'SectionF.F0500A'; 
      $fields[] = 'SectionF.F0500B';  $fields[] = 'SectionF.F0500C';  $fields[] = 'SectionF.F0500D';   $fields[] = 'SectionF.F0500E';  
      $fields[] = 'SectionF.F0500F'; $fields[] = 'SectionF.F0500G';  $fields[] = 'SectionF.F0500H';  $fields[] = 'SectionF.F0600';  
      $fields[] = 'SectionF.F0700';   $fields[] = 'SectionF.F0800A'; $fields[] = 'SectionF.F0800B';  $fields[] = 'SectionF.F0800C';  
      $fields[] = 'SectionF.F0800D';   $fields[] = 'SectionF.F0800E';  $fields[] = 'SectionF.F0800F'; $fields[] = 'SectionF.F0800G';  
      $fields[] = 'SectionF.F0800H';  $fields[] = 'SectionF.F0800I';   $fields[] = 'SectionF.F0800J';  $fields[] = 'SectionF.F0800K'; 
      $fields[] = 'SectionF.F0800L';  $fields[] = 'SectionF.F0800M';  $fields[] = 'SectionF.F0800N';   $fields[] = 'SectionF.F0800O';  
      $fields[] = 'SectionF.F0800P'; $fields[] = 'SectionF.F0800Q';  $fields[] = 'SectionF.F0800R';  $fields[] = 'SectionF.F0800S';   
      $fields[] = 'SectionF.F0800T';  $fields[] = 'SectionF.F0800Z'; $fields[] = 'SectionH.H0200A';  $fields[] = 'SectionH.H0200B';  
      $fields[] = 'SectionH.H0600';  $fields[] = 'SectionI.I0100';   $fields[] = 'SectionI.I0300'; $fields[] = 'SectionI.I0400';   
      $fields[] = 'SectionI.I0500';   $fields[] = 'SectionI.I0900';  $fields[] = 'SectionI.I1100';   $fields[] = 'SectionI.I1200'; 
      $fields[] = 'SectionI.I1300';   $fields[] = 'SectionI.I1400';   $fields[] = 'SectionI.I1500';  $fields[] = 'SectionI.I3400';   
      $fields[] = 'SectionI.I3700'; $fields[] = 'SectionI.I3800';   $fields[] = 'SectionI.I5350';   $fields[] = 'SectionI.I6500';  
      $fields[] = 'SectionI.I7900';   $fields[] = 'SectionJ.J1300'; $fields[] = 'SectionL.L0200B';  $fields[] = 'SectionL.L0200C';  
      $fields[] = 'SectionL.L0200D';   $fields[] = 'SectionL.L0200E';  $fields[] = 'SectionL.L0200G'; $fields[] = 'SectionL.L0200Z';  
      $fields[] = 'SectionN.N0400E';  $fields[] = 'SectionN.N0400F';   $fields[] = 'SectionN.N0400G';  $fields[] = 'SectionN.N0400Z'; 
      $fields[] = 'SectionO.O0100G1'; $fields[] = 'SectionO.O0100G2'; $fields[] = 'SectionO.O0100K1';  $fields[] = 'SectionO.O0100L2'; 
      $fields[] = 'SectionO.O0100M1'; $fields[] = 'SectionO.O0100Z1'; $fields[] = 'SectionO.O0100Z2'; $fields[] = 'SectionO.O0400D1';  
      $fields[] = 'SectionO.O0400E1'; $fields[] = 'SectionO.O0400F1'; $fields[] = 'SectionO.O0400F2'; $fields[] = 'SectionS.S2010';   
      $fields[] = 'SectionS.S2011';
      }
      
    }
    $fields[] = 'Assessment.transmission_status';
    $fields[] = 'Assessment.resident';
    $fields[] = 'Facility.FAC_ID';
    $fields[] = 'Facility.F_STATE';
    
    // get the appropriate fields from the database
    $data = $this->Assessment->find('first', array(
      'conditions' => array('Assessment.id' => $id),
      'fields' => $fields,
      'limit' => 1
    ));

    foreach ($data as $key => $value) {
      if (preg_match('|Section|', $key) && $key != 'SectionZ') {
        $skips[$key] = ClassRegistry::init($key)->skipPatterns($data);
      }
    }

    foreach ($data as $key => $value) {
      foreach ($value as $key2 => $value2) {
        if (isset($skips[$key]) && in_array($key2, $skips[$key])) {
          $data[$key][$key2] = '';
        }
      }
    }

    if (isset($data['SectionA']['A0050']) && $data['SectionA']['A0050'] == 1) {
      foreach ($data['SectionX'] as $key => $value) {
        $data['SectionX'][$key] = '';
      }
    }

    $data = $this->Caa->report($data);

    return $data;

  }
  
  public function createBatchFile($data, $filename, $check_selected = true) {
    
    // check if the file exists already
    $this->File = new File($filename);
    // delete the file if it exists
    if ($this->File->exists()) unlink($filename);
    // close the file
    $this->File->close();
      
    // create the Zip file
    $this->Zip->begin($filename);
    
    // loop through assessments
    foreach ($data['BulkSubmissionAssessment'] as $key => $value) {
      
      $status = $this->Assessment->find('first', array(
      'conditions' => array('Assessment.id' => $value['assessment_id']),
      'fields' => array('Assessment.transmission_status'),
      'recursive' => -1
      ));
      
      // check if the item was selected
      if ($check_selected == true && $value['selected'] == '1') {
      
      // set the added information
      $value['bulk_id'] = $this->Bulk->id;
      
      // Save the Assessment
      $this->BulkSubmissionAssessment->create();
      $this->BulkSubmissionAssessment->save($value);
      
      // add file to assessment
      $this->__addFileToZip($value['assessment_id']);
      // update the Assessment to transmitted
      
      if ($status['Assessment']['transmission_status'] != 2)
        $this->Assessment->save(array('id' => $value['assessment_id'], 'locked' => 1, 'transmission_status' => 1));
      
      }
      // if not looking for selected files
      if ($check_selected == false) {
      $this->__addFileToZip($value['assessment_id']);
      // update the Assessment to transmitted
      
      if ($status['Assessment']['transmission_status'] != 2)
        $this->Assessment->save(array('id' => $value['assessment_id'], 'locked' => 1, 'transmission_status' => 1));
      }
      
    
    }

    // close the Zip file
    $this->Zip->close();
  }
  
  private function __addFileToZip($id) {
    $filename = WWW_ROOT .'transmission_files'. DS .'pending'. DS . $id .'.xml';
    $this->Zip->addFile($filename, $id .'.xml');
  }

  public function fixIDC($value) {
    if (strrpos($value, '.') == false) $value = $value .'.';
    list($start, $end) = explode('.', $value);
    if (strlen($end) != 2) {
      $e = '';
      for ($i = strlen($end); $i < 2; $i++) { $e .= '^'; }
      $end = $end . $e;
    }
    if (strlen($start) != 7) {
      $s = '';
      for ($i = strlen($start); $i < 5; $i++) { $s .= '^'; }
      $start = $s . $start;
    }
    
    return $start .'.'. $end;
  }
}