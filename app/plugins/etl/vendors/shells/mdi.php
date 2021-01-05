<?php

class MdiShell extends Shell {

  public $uses = array('Resident', 'Assessment', 'RugCache');

  public function deleteAll() {
    $residents = $this->Resident->find('list', array('conditions' => array('Resident.facility_id' => 44)));
    foreach ($residents as $key => $value) {
     $this->Resident->delete($key, true); 
    }
    $this->out('Residents Deleted');

    $assessments = $this->Assessment->find('list', array('conditions' => array('Assessment.facility_id' => 44)));
    foreach ($assessments as $key2 => $value2) {
     $this->Assessment->delete($key2, true); 
    }
    $this->out('Assessments Deleted');

    $rug_caches = $this->RugCache->find('list', array('conditions' => array('RugCache.facility_id' => 44)));
    foreach ($rug_caches as $key2 => $value2) {
     $this->RugCache->delete($key2, true); 
    }
    $this->out('Rug Cache Deleted');

  }

  public function main () {

    self::deleteAll();

    $this->Admission = ClassRegistry::init('Etl.Admission');
    $data = $this->Admission->find('all', array(
      'contain' => array('AssessmentControl'),
      'order' => 'Admission.AdmissionPK DESC',
      'limit' => '0, 100'
    ));
    foreach ($data as $key => $value) {
      self::structureResidentData ($value);
      self::structureAssessmentData ($value);
    }

    $this->Admission = ClassRegistry::init('Etl.Admission');
    $data = $this->Admission->find('all', array(
      'contain' => array('AssessmentControl'),
      'order' => 'Admission.AdmissionPK DESC',
      'limit' => '100, 100'
    ));
    foreach ($data as $key => $value) {
      self::structureResidentData ($value);
      self::structureAssessmentData ($value);
    }

    $this->Admission = ClassRegistry::init('Etl.Admission');
    $data = $this->Admission->find('all', array(
      'contain' => array('AssessmentControl'),
      'order' => 'Admission.AdmissionPK DESC',
      'limit' => '200, 100'
    ));
    foreach ($data as $key => $value) {
      self::structureResidentData ($value);
      self::structureAssessmentData ($value);
    }

    // self::runRugCache();

  }

  public function structureResidentData ($data) {

    $resident_id = 44 .'-'. $data['Admission']['AdmissionPK'];

    $resient = array();

    // find resident
    $resident = $this->Resident->find('first', array(
      'conditions' => array('Resident.id' => $resident_id),
      'recursive' => -1
    ));

    if (!empty($resident)) 
      $resident['Resident']['id'] = '44' .'-'. $data['Admission']['AdmissionPK'];
    else
      $this->Resident->create();

    $resident['Resident']['facility_id']  = 44;
    $resident['Resident']['PATNUM']       = $data['Admission']['AdmissionPK'];
    $resident['Resident']['PATLNAME']     = $data['Admission']['Lastname'];
    $resident['Resident']['PATFNAME']     = $data['Admission']['Firstname'];
    $resident['Resident']['BED']          = $data['ArMasterReference']['RoomNumber'];
    $resident['Resident']['PMI']          = $data['Admission']['MI'];
    $resident['Resident']['ADDRESS1']     = $data['Admission']['ResidentAddress'];
    $resident['Resident']['CITY']         = $data['Admission']['ResidentCity'];
    $resident['Resident']['STATE']        = $data['Admission']['ResidentState'];
    $resident['Resident']['ZIP']          = $data['Admission']['ResidentZip'];
    $resident['Resident']['PHONEH']       = $data['Admission']['ResidentPhone'];
    $resident['Resident']['SSNUM']        = $data['Admission']['SSN'];
    $resident['Resident']['MEDICARE']     = $data['Admission']['Medicare'];
    $resident['Resident']['MEDICAID']     = $data['Admission']['Medicaid'];
    $resident['Resident']['LEVELOCARE']   = 'SKILLED';
    $resident['Resident']['LANGUAGE']     = $data['Admission']['Language'];
    $resident['Resident']['FRNAME']       = $data['Admission']['RP_Firstname'] .' '. $data['Admission']['RP_lastname'];
    $resident['Resident']['FRELAT']       = $data['Admission']['Relationship'];
    $resident['Resident']['FRADR']        = $data['Admission']['RP_address'];
    $resident['Resident']['FRPHONEH']     = $data['Admission']['RP_phone'];
    $resident['Resident']['FRCITY']       = $data['Admission']['RP_city'];
    $resident['Resident']['FRPHONEW']     = $data['Admission']['RP_phone_work'];
    $resident['Resident']['BDATE']        = self::formatDate ($data['Admission']['Birthday']);
    $resident['Resident']['ADATE']        = $data['ArMasterReference']['AdmissionDate'];
    $resident['Resident']['ADATE']        = $data['ArMasterReference']['DischargeDate'];
    $resident['Resident']['ICD91']        = $data['ArMasterReference']['AddDx01'];
    $resident['Resident']['ICD92']        = $data['ArMasterReference']['AddDx02'];
    $resident['Resident']['ICD93']        = $data['ArMasterReference']['AddDx03'];
    $resident['Resident']['ICD94']        = $data['ArMasterReference']['AddDx04'];
    $resident['Resident']['ICD95']        = $data['ArMasterReference']['AddDx05'];
    $resident['Resident']['DIS1']         = $data['ArMasterReference']['AddDxDesc01'];
    $resident['Resident']['DIS2']         = $data['ArMasterReference']['AddDxDesc02'];
    $resident['Resident']['DIS3']         = $data['ArMasterReference']['AddDxDesc03'];
    $resident['Resident']['DIS4']         = $data['ArMasterReference']['AddDxDesc04'];
    $resident['Resident']['DIS5']         = $data['ArMasterReference']['AddDxDesc05'];
    $resident['Resident']['apartment']    = 0;

    $this->Resident->save($resident['Resident'], array('id' => $resident_id));

  }

  public function structureAssessmentData ($data) {

    $resident_id = $data['Admission']['AdmissionPK'];

    foreach ($data['AssessmentControl'] as $key => $value) {

      $info = array();
      $info['Assessment']['facility_id'] = 44;
      $info['Assessment']['resident'] = 44 .'-'. $resident_id;
      $info['Assessment']['locked'] = $value['LockedForSubmissionFlag'];
      $info['Assessment']['transmission_status'] = 2;
      $info['Assessment']['deleted'] = 0;
      $info['Assessment']['validated'] = 0;
      $info['Assessment']['created'] = $value['DateSubmission'];
      $info['Assessment']['modified'] = $value['DateSubmission'];
      $info['Assessment']['asmt_type'] = 'NC';
      $info['Assessment']['lock_date'] = $value['DateSubmission'];

      $section = array();
      foreach ($value['Answers'] as $key3 => $answer) {

        $section_name = 'Section' . substr($answer['Question']['QuestionName'], 0, 1);
        $section[$section_name][trim($answer['Question']['QuestionName'])] = self::cleanData (trim($answer['AssessmentAnswer']['Answer']));

      }

      // Section A 
      if (isset($section['SectionA']['A0900']))   $section['SectionA']['A0900']    = self::formatDate ($section['SectionA']['A0900']);
      if (isset($section['SectionA']['A1600']))   $section['SectionA']['A1600']    = self::formatDate ($section['SectionA']['A1600']);
      if (isset($section['SectionA']['A2000']))   $section['SectionA']['A2000']    = self::formatDate ($section['SectionA']['A2000']);
      if (isset($section['SectionA']['A2200']))   $section['SectionA']['A2200']    = self::formatDate ($section['SectionA']['A2200']);
      if (isset($section['SectionA']['A2300']))   $section['SectionA']['A2300']    = self::formatDate ($section['SectionA']['A2300']);
      if (isset($section['SectionA']['A2400B']))  $section['SectionA']['A2400B']   = self::formatDate ($section['SectionA']['A2400B']);
      if (isset($section['SectionA']['A2400C']))  $section['SectionA']['A2400C']   = self::formatDate ($section['SectionA']['A2400C']);

      // Section M 
      if (isset($section['SectionM']['M0300B3'])) $section['SectionM']['M0300B3']  = self::formatDate ($section['SectionM']['M0300B3']);

      // Section O
      if (isset($section['SectionO']['O0250B']))  $section['SectionO']['O0250B']   = self::formatDate ($section['SectionO']['O0250B']);
      if (isset($section['SectionO']['O0400A5'])) $section['SectionO']['O0400A5']  = self::formatDate ($section['SectionO']['O0400A5']);
      if (isset($section['SectionO']['O0400A6'])) $section['SectionO']['O0400A6']  = self::formatDate ($section['SectionO']['O0400A6']);
      if (isset($section['SectionO']['O0400B5'])) $section['SectionO']['O0400B5']  = self::formatDate ($section['SectionO']['O0400B5']);
      if (isset($section['SectionO']['O0400B6'])) $section['SectionO']['O0400B6']  = self::formatDate ($section['SectionO']['O0400B6']);
      if (isset($section['SectionO']['O0400C5'])) $section['SectionO']['O0400C5']  = self::formatDate ($section['SectionO']['O0400C5']);
      if (isset($section['SectionO']['O0400C6'])) $section['SectionO']['O0400C6']  = self::formatDate ($section['SectionO']['O0400C6']);
      if (isset($section['SectionO']['O0450B']))  $section['SectionO']['O0450B']   = self::formatDate ($section['SectionO']['O0450B']);

      // Section V
      if (isset($section['SectionV']['V0100C']))  $section['SectionV']['V0100C']   = self::formatDate ($section['SectionV']['V0100C']);
      if (isset($section['SectionV']['V0200B2'])) $section['SectionV']['V0200B2']  = self::formatDate ($section['SectionV']['V0200B2']);
      if (isset($section['SectionV']['V0200C2'])) $section['SectionV']['V0200C2']  = self::formatDate ($section['SectionV']['V0200C2']);

      // Section X
      if (isset($section['SectionX']['X0400']))   $section['SectionX']['X0400']    = self::formatDate ($section['SectionX']['X0400']);
      if (isset($section['SectionX']['X0500']))   $section['SectionX']['X0500']    = self::formatDate ($section['SectionX']['X0500']);
      if (isset($section['SectionX']['X0700A']))  $section['SectionX']['X0700A']   = self::formatDate ($section['SectionX']['X0700A']);
      if (isset($section['SectionX']['X0700B']))  $section['SectionX']['X0700B']   = self::formatDate ($section['SectionX']['X0700B']);
      if (isset($section['SectionX']['X0700C']))  $section['SectionX']['X0700C']   = self::formatDate ($section['SectionX']['X0700C']);
      if (isset($section['SectionX']['X1100E']))  $section['SectionX']['X1100E']   = self::formatDate ($section['SectionX']['X1100E']);

      // Section Z
      if (isset($section['SectionZ']['Z0500B'])) $section['SectionZ']['Z0500B']    = self::formatDate ($section['SectionZ']['Z0500B']);

      if (isset($section['SectionA']['A2300'])) {

        // set the conditions
        $conditions = array(
          'SectionA.A2300' => $section['SectionA']['A2300'],
          'SectionA.A0310A' => $section['SectionA']['A0310A'],
          'SectionA.A0310B' => $section['SectionA']['A0310B'],
          'SectionA.A0310C' => $section['SectionA']['A0310C'],
          'SectionA.A0310D' => $section['SectionA']['A0310D'],
          'SectionA.A0310E' => $section['SectionA']['A0310E'],
          'SectionA.A0310F' => $section['SectionA']['A0310F']
        );

        // check for A0050
        if (isset($section['SectionA']['A0050']) && !empty($section['SectionA']['A0050']))
          $conditions['SectionA.A0050'] = $section['SectionA']['A0050'];

        // check for X0100
        if (isset($section['SectionX']['X0100']) && !empty($section['SectionX']['X0100']))
          $conditions['SectionX.X0100'] = $section['SectionX']['X0100'];

        // check if the assessment exists
        $exists = $this->Assessment->find('first', array(
          'conditions' => $conditions,
          'fields' => array('Assessment.id')
        ));    

        // set the id if it exists
        if (!empty($exists)) $info['Assessment']['id'] = $exists['Assessment']['id']; 
        // create a new id
        else $this->Assessment->create();

        // create the new assessment
        $this->Assessment->save($info['Assessment'], false);

        foreach ($section as $key => $value) {
          $section[$key]['id'] = $this->Assessment->id;
          $section[$key]['assessment_id'] = $this->Assessment->id;
          $section[$key]['validated'] = 1;
          $this->Assessment->{$key}->create();
          $this->Assessment->{$key}->save($section[$key], false);
        }

        $this->Assessment->RugCache->update_cache($this->Assessment->id);

      }
      
    }

  }

  private function runRugCache () {
    $assessments = $this->Assessment->find('list', array(
      'conditions' => array(
        'Assessment.deleted' => 0,
        'Assessment.facility_id' => 44
      ),
      'fields' => array('Assessment.id', 'Assessment.modified'),
      'order' => 'Assessment.id DESC'
    ));
    foreach ($assessments as $key => $value) {
      $this->Assessment->RugCache->update_cache($key, $value);
    }
  }

  private function cleanData ($data) {
    switch ($data) {
      case '-':     return '--------'; break;
      case '0000':  return 0;          break;
      case '^':     return null;       break;
      default:      return $data;
    }
  }

  private function formatDate ($date) {
    if (empty($date) || $date == '--------') return $date;

    if (preg_match('|/|', $date))
      list ($m, $d, $y) = explode('/', $date);

    if (preg_match('|-|', $date))
      return $date;

    if (!preg_match('|/|', $date) && !preg_match('|-|', $date))
      return date('Y-m-d', $date);

    if (strlen($m) == 1) $m = '0'.  $m;
    if (strlen($d) == 1) $d = '0'.  $d;
    if (strlen($y) == 2) $y = '20'. $y;
    return $y .'-'. $m .'-'. $d;
  }
}