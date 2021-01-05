<?php

App::import('Core', array('Sanitize'));
class BulkController extends AppController {
  
  public $name = 'Bulk';
  public $title_for_layout = 'Bulk Submissions';
  public $helpers = array('AssessmentType');
  public $components = array('Zip', 'Report', 'Calc');

  
  public function beforeFilter () {
    $this->Assessment = ClassRegistry::init('Assessment');  
    $this->Facility = ClassRegistry::init('Facility');
    $this->BulkSubmissionAssessment = ClassRegistry::init('BulkSubmissionAssessment');  
  }
  
  public function regenerate($id) {
    // get Bulk information
    $this->Bulk->unbindModel(array('belongsTo' => array('Facility')));
    $data = $this->Bulk->find('first', array('conditions' => array('Bulk.id' => Sanitize::clean($id))));
    
    // create new transmission files
    foreach ($data['BulkSubmissionAssessment'] as $key => $value) {
      
      
      $facility = $this->Facility->find('first', array('conditions' => array('Facility.id' => $data['Bulk']['facility_id']), 'fields' => array('Facility.F_STATE'), 'recursive' => -1));
      $this->Report->createTransmissionfile($value['assessment_id'], $facility['Facility']['F_STATE']);
    }
    
    // set filename
    $filename = WWW_ROOT .'transmission_files'. DS . 'batches' . DS . $data['Bulk']['filename'];
    
    // create the batch file
    $this->Report->createBatchFile($data, $filename, false);
    
    $this->Session->setFlash('Successfully created a new batch transmission file', 'default', array('class' => 'success'));
    $this->redirect($this->referer(), null, false);
  }

  public function add () {
    if (!empty($this->data)) {
      $data = Sanitize::clean($this->data);
      
      // save the count
      $cnt = 0;
      foreach ($data['BulkSubmissionAssessment'] as $key => $value) {
        if ($value['selected'] == 1)
          $cnt++;
      }      
      
      $data['Bulk']['count']    = $cnt;
      $data['Bulk']['user_id']  = $this->Auth->user('id');
      $data['Bulk']['filename'] = str_replace(array('.', ' '), '', microtime()) .'.zip';

      if ($cnt != 0) {
        // set the filename
        $filename = WWW_ROOT .'transmission_files'. DS . 'batches' . DS . $data['Bulk']['filename'];
        
        // save the Zip file
        $this->Bulk->save($data['Bulk'], false);
        
        // create the new transmission file
        $this->Report->createBatchFile($data, $filename);
      
      }
      
      header ('Location: /bulk/view/'. $this->Bulk->id);
      exit ();
    }
  }
   
  public function create ($id = null) {
    // get Facilities
    $facilities = ClassRegistry::init('Facility')->getFacilities($this->Auth->user('facility_id'));
    
    
      
    if (empty($id)) {
      if (count($allowed_facilities) == 1) {
        $facilities = $this->Auth->user('Auth.User.facility_id');
      }
    }
    else {
      $facilities = $id;
    }

    $this->paginate = array(
      'conditions' => array(
        'Assessment.locked' => 1, 'Assessment.transmission_status' => array(0, 3), 'Assessment.deleted' => 0, 'Assessment.facility_id' => $facilities
      ),
      'recursive' => 1,
      'limit' => 500
    );
    
    $data = $this->paginate('Assessment');
    
    foreach ($data as $key => $value) {
      
      if ($value['Assessment']['type'] != 'NT') {
        $data[$key]['rug']['trug'] = $this->Calc->calcRugTherapy ($value, $value['Assessment']['facility_id']) . $this->Calc->calcModifier($value);
        $data[$key]['rug']['nrug'] = $this->Calc->calcRugNonTherapy ($value, $value['Assessment']['facility_id']) . $this->Calc->calcModifier($value);
        $data[$key]['rug']['minutes'] = $this->Calc->calcTherapy ($value);
        $data[$key]['rug']['adl']     = $this->Calc->calcAdl ($value);
      }
      
    }
    
    // get Facilities
    $allowed_facilities = $this->allowed_facilities();
    
    $this->set(compact('data'));
  }
  
  public function search ($id = null) {
    // get Facilities
    $allowed_facilities = $this->allowed_facilities();
    
    
    if (!empty($this->data)) {
      
      
      foreach ($allowed_facilities as $key => $value) {
        $facilities[$key] = $key;
      }
      
      $conditions['BulkSubmissionAssessment.facility_id'] = $facilities;
      
      if (empty($id)) {
        if (count($allowed_facilities) == 1) {
          $conditions['BulkSubmissionAssessment.facility_id'] = $this->Auth->user('Auth.User.facility_id');
        }
      }
      else {
          $conditions['BulkSubmissionAssessment.facility_id'] = $id;
      }
      
      if (!empty($this->data['Resident']['PATLNAME']))
        $conditions['Resident.PATLNAME LIKE '] = Sanitize::clean($this->data['Resident']['PATLNAME']) .'%';
        
      if (!empty($this->data['Resident']['PATFNAME']))
        $conditions['Resident.PATFNAME LIKE '] = Sanitize::clean($this->data['Resident']['PATFNAME']) .'%';
        
      if (!empty($this->data['Assessment']['id']))
        $conditions['Assessment.id'] = Sanitize::clean($this->data['Assessment']['id']);
      
      // get the data for the view
      $this->BulkSubmissionAssessment->unBindModel(
        array(
          'belongsTo' => array('SectionA', 'SectionX', 'SectionZ')  
        )  
      );
      
      $data = $this->BulkSubmissionAssessment->find('all', array(
        'conditions' => $conditions,
        'fields' => array(
          'Bulk.id', 'Bulk.count', 'Bulk.filename', 'Bulk.created', 
          'Facility.name'
        ),
        'group' => array('BulkSubmissionAssessment.bulk_id')
      ));
      
      $this->set(compact('data'));
    } 
  }
  
  public function index ($id = null) {
    $allowed_facilities = parent::allowed_facilities();
    
    if (count($allowed_facilities) == 1 && $id == null) {
      $this->redirect('/bulk/index/'. $this->Auth->user('facility_id'), null, false);
    }
    
    
    foreach ($allowed_facilities as $key => $value) {
      $facilities[$key] = $key;
    }
    
    if (!empty($id)) {
    
      // get the data for the view
      $data = $this->Bulk->find('all', array(
        'conditions' => array('Bulk.facility_id' => $id),
        'fields' => array(
          'Bulk.id', 'Bulk.count', 'Bulk.filename', 'Bulk.created', 
          'Facility.name'
        ),
        'order' => array('Bulk.id' => 'DESC'),
      ));
      
    }
    
    // set the data
    $this->set(compact('data'));
  }
  
  public function view ($id = null) {
    $allowed_facilities = $this->allowed_facilities();
    
    // check if the id exists
    if (!$id) {
      $this->redirect('index', null, false);
    }
    
    $this->Bulk->Facility->unbindModel(array(
      'belongsTo' => array('Parent'),
      'hasOne' => array('MedicalRecordPath'),
      'hasMany' => array('Resident', 'Assessment')
    ));
    $this->Bulk->User->unbindModel(array(
      'belongsTo' => array('Facility', 'Group')
    ));
    $bulk = $this->Bulk->find('first', array(
      'conditions' => array('Bulk.id' => $id),
      'recursive' => 1
    ));
    
    foreach ($bulk['BulkSubmissionAssessment'] as $key => $value) {
      $info = ClassRegistry::init('Assessment')->getAssessment($value['assessment_id']);
      
      $bulk['BulkSubmissionAssessment'][$key] = $info;
      
    }

    // set the data
    $this->set(compact('bulk'));
  }

  public function update () {
    if (!empty($this->data)) {
      $data = Sanitize::clean($this->data);
      
      if ($data['Bulk']['transmission_status'] == '') {
        $this->Session->setFlash('Sorry you have to select a status to update the assessment(s).', 'default', array('class' => 'error'));
        $this->redirect($this->referer(), null, false);        
      }
      
      $cnt = 0;
      foreach ($data['Assessment'] as $key => $value) {
        if ($value['selected'] != 0)
          $cnt++;
      }
      
      if ($cnt != 0) {
        $i = 0;
        foreach ($data['Assessment'] as $key => $value) {
          
          $status = $this->Assessment->find('first', array(
            'conditions' => array('Assessment.id' => $value['id']),
          ));
          
          if ($value['selected'] == 1) {
            // set new status
            $value['transmission_status'] = $data['Bulk']['transmission_status'];
            
            if ($value['transmission_status'] == 3) 
            
            if ($status['Assessment']['transmission_status'] != 2) $this->Assessment->save($value);
              
            if ($value['transmission_status'] == '2') { 
              $value['locked'] = 1;
              $value['transmission_status'] = 2;
              $this->Assessment->save($value);
              
              
              if (
              	$status['SectionA']['A0310A'] == '01' ||  $status['SectionA']['A0310A'] == '02' || 
                $status['SectionA']['A0310A'] == '03' ||  $status['SectionA']['A0310A'] == '04'|| 
                $status['SectionA']['A0310A'] == '05' ||  $status['SectionA']['A0310A'] == '06'
              ) {

        				$this->QuarterlyLog = ClassRegistry::init('QuarterlyLog');
        				
        				$quater['assessment_id']	= $status['Assessment']['id'];
        				$quater['resident_id']		= $status['Resident']['id'];
        				$quater['ard']				    = $status['SectionA']['A2300'];

                switch ($status['SectionA']['A0310A'] ) {
                  case '01':
                    $quater['type'] = 'ADM';
                    break;
                  case '02':
                    $quater['type'] = 'Q';
                    break;
                  case '03':
                    $quater['type'] = 'A';
                    break;
                  case '04':
                  case '05':
                  case '06':
                    $quater['type'] = 'S';
                    break;
                }

                // check if already exists
                $find = $this->QuarterlyLog->find('first', array(
                  'conditions' => array(
                    'QuarterlyLog.type'          => $quater['type'],
                    'QuarterlyLog.assessment_id' => $status['Assessment']['id'],
                    'QuarterlyLog.resident_id'   => $status['Resident']['id'],
                    'QuarterlyLog.ard'           => $status['SectionA']['A2300'],
                  ),
                  'recursive' => -1
                ));



                if (empty($find) == 0) {
                  $this->Quarter->create();
                  $this->Quarter->save($quater, false);
                }
        				
              }
              
            }
          }
        }
        $this->Session->setFlash('The selected assessment(s) have been updated.', 'default', array('class' => 'success'));
        $this->redirect($this->referer(), null, false);
      }
      else {
        $this->Session->setFlash('Sorry you can not update nothing.', 'default', array('class' => 'error'));
        $this->redirect($this->referer(), null, false);
      }
    }
    else {
      $this->Session->setFlash('Sorry you can not update nothing.', 'default', array('class' => 'error'));
      $this->redirect($this->referer(), null, false);
    }
  }
}
