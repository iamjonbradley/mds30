<?php

App::import('Core', array('Sanitize', 'File'));
class AssessmentsController extends AppController {
  
  public $name = 'Assessments';
  public $components = array(
    'Error', 'Email', 'RequestHandler', 'Session', 
    'Caa', 'Calc', 'AssessmentType', 'Report', 
    'Reports.Clock', 
    //'NoSqlStore'
  );
  public $helpers = array('Reports.Clock', 'Time', 'Number', 'AssessmentType', 'AvailableSection', 'Rug', 'Menu');
  static $letters = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 's', 'v', 'x', 'z');
  
  public function index ($type = 0) 
  {
    // lastname get
    if (!empty($this->params['url']['lastname']) && $this->params['url']['lastname'] != 'Lastname') 
      $conditions['Resident.PATLNAME LIKE'] = '%'. $this->params['url']['lastname'] .'%';
      
    // firstname get
    if (!empty($this->params['url']['firstname']) && $this->params['url']['firstname'] != 'Firstname') 
      $conditions['Resident.PATFNAME LIKE'] = '%'. $this->params['url']['firstname'] .'%';
      
    // facility get
    if (!empty($this->params['url']['facility_id'])) 
      $conditions['Resident.facility_id'] = $this->params['url']['facility_id'];
    
    // lastname named
    if (!empty($this->params['named']['lastname']) && $this->params['named']['lastname'] != 'Lastname') 
      $conditions['Resident.PATLNAME LIKE'] = '%'. $this->params['named']['lastname'] .'%';
      
    // firstname named
    if (!empty($this->params['named']['firstname']) && $this->params['named']['firstname'] != 'Firstname')  
      $conditions['Resident.PATFNAME LIKE'] = '%'. $this->params['named']['firstname'] .'%';
      
    // facility named
    if (!empty($this->params['named']['facility_id'])) 
      $conditions['Resident.facility_id'] = $this->params['named']['facility_id'];
    
    // set default facility 'named']['facility_id']) && empty($this->params['url']['facility_id'])) 
			$conditions['Resident.facility_id'] = $this->Session->read('Auth.User.facility_id');
		
		if ($type == 0) $conditions['Assessment.transmission_status'] = 0;
		if ($type == 1) $conditions['Assessment.transmission_status'] = 1;
		if ($type == 2) $conditions['Assessment.transmission_status'] = 2;
		if ($type == 3) $conditions['Assessment.transmission_status'] = 3;
		if ($type == 4) $conditions['Assessment.transmission_status'] = 4;
		
		if ($type != 99)
			$conditions['Assessment.deleted'] = 0;
		else 
			$conditions['Assessment.deleted'] = 1;

		$this->paginate = array(
			'conditions' => $conditions,
			'fields' => array(
				'DISTINCT Assessment.id', 'Assessment.created', 'Assessment.resident', 'Assessment.modified', 'Assessment.locked', 'Assessment.lock_date', 'Assessment.transmission_status', 'Assessment.type', 
				'Assessment.item_subset',
				'Resident.id', 'Resident.PATLNAME', 'Resident.PATFNAME', 
				'Facility.name', 	'Facility.F_STATE',
				'SectionA.A0310A', 	'SectionA.A0310B', 	'SectionA.A0310C', 'SectionA.A0310D', 'SectionA.A0310E', 'SectionA.A0310F', 
				'SectionA.A0500A', 	'SectionA.A0500B', 	'SectionA.A0500C', 'SectionA.A0500D', 'SectionA.A1600', 'SectionA.A2300', 'SectionA.A0050', 
				'SectionX.X0100', 
				'SectionZ.Z0100B', 'SectionZ.Z0150B', 'SectionZ.Z0100C',
        'RugCache.*'
			),
			// 'group' => 'Assessment.id',
			'limit' => 20,
			'order' => array('Assessment.modified' => 'DESC')
		);
		
		$data = $this->paginate('Assessment');
		
		$allowed_facilities = array();
		$allowed_facilities = ClassRegistry::init('Facility')->getNiceList($this->Auth->user('facility_id'));
		$this->set('allowed_facilities', $allowed_facilities);
		
		$this->set(compact('data', 'type'));
	}
	
	public function updatePay($facility) 
	{
		$assessments = $this->Assessment->getAssessments($facility);
		
		foreach ($assessments as $key => $value) {
			
			$value['Assessment']['ATYPEOPAY']	= $value['Resident']['ATYPEOPAY'];
			$value['Assessment']['ATYPEOPAY2']	= $value['Resident']['ATYPEOPAY2'];
			$value['Assessment']['ATYPEOPAY3']	= $value['Resident']['ATYPEOPAY3'];
			$value['Assessment']['ATYPEOPAY4']	= $value['Resident']['ATYPEOPAY4'];
			$value['Assessment']['ATOPDTE']		= $value['Resident']['ATOPDTE'];
			$value['Assessment']['ATOPDTE2']	= $value['Resident']['ATOPDTE2'];
			$value['Assessment']['ATOPDTE3']	= $value['Resident']['ATOPDTE3'];
			$value['Assessment']['ATOPDTE4']	= $value['Resident']['ATOPDTE4'];
			
			$this->Assessment->save($value['Assessment']);	
			
		}
	}

  /**
   * Creates a modification for use in editing an assessment
   *
   * @params $id
   */
	public function modify ($id = null) 
	{

    // get assessment
    $assessment = $this->Assessment->find('first', array(
      'conditions' => array('Assessment.id' => Sanitize::clean($id))
    )); 

    if (!empty($this->data))
    {

      unset($assessment['User']);
      unset($assessment['Assessment']['transmission_status']);

      // create inactivation
      if ($this->data['Reason'][6] == 1) {
        $asmt[0]                                      = $assessment;
        $asmt[0]['Assessment']['asmt_type']           = 3; 
        $asmt[0]['SectionA']['A0050']                 = 3;
        unset($asmt[0]['Assessment']['id']);

        $msg = 'A In-activation and ';
      }

      // create the modification
      $asmt[1]                                      = $assessment;
      $asmt[1]['Assessment']['asmt_type']           = 2; 
      $asmt[1]['SectionA']['A0050']                 = 2;
      unset($asmt[1]['Assessment']['id']);

      $msg .= 'A Modification was created for you.';

      foreach ($asmt as $key => $value) 
      {

        $this->Assessment->create();
        $this->Assessment->save($asmt[$key]['Assessment'], false);

        // set assessment details
        $asmt[$key]['Assessment']['id']                   = $this->Assessment->id;
        $asmt[$key]['Assessment']['previous_id']          = $id;

        if ($this->data['Reason'][6] == 1)
          $asmt[$key]['Assessment']['lock_date']            = ''; 
        
        $asmt[$key]['Assessment']['transmission_status']  = 0;
        $asmt[$key]['Assessment']['created']              = 1;
        $asmt[$key]['Assessment']['updated']              = 1;
        $asmt[$key]['Assessment']['locked']               = 0;

        // set section x
        $asmt[$key]['SectionX']['X0150']                  = $assessment['SectionA']['A0200'];
        $asmt[$key]['SectionX']['X0200A']                 = $assessment['SectionA']['A0500A'];
        $asmt[$key]['SectionX']['X0200B']                 = $assessment['SectionA']['A0500C'];
        $asmt[$key]['SectionX']['X0300']                  = $assessment['SectionA']['A0800'];
        $asmt[$key]['SectionX']['X0400']                  = $assessment['SectionA']['A0900'];
        $asmt[$key]['SectionX']['X0500']                  = $assessment['SectionA']['A0600A'];
        $asmt[$key]['SectionX']['X0600A']                 = $assessment['SectionA']['A0310A'];
        $asmt[$key]['SectionX']['X0600B']                 = $assessment['SectionA']['A0310B'];
        $asmt[$key]['SectionX']['X0600C']                 = $assessment['SectionA']['A0310C'];
        $asmt[$key]['SectionX']['X0600D']                 = $assessment['SectionA']['A0310D'];
        $asmt[$key]['SectionX']['X0600E']                 = $assessment['SectionA']['A0310E'];
        $asmt[$key]['SectionX']['X0600F']                 = $assessment['SectionA']['A0310F'];

        $asmt[$key]['SectionX']['X0700A']                 = $assessment['SectionA']['A2300'];
        $asmt[$key]['SectionX']['X0700B']                 = $assessment['SectionA']['A2200'];
        $asmt[$key]['SectionX']['X0700C']                 = $assessment['SectionA']['A1600'];

        $asmt[$key]['SectionX']['X0800']                  = $key + 1;
        

        foreach ($value as $key2 => $value2) 
        {

          $asmt[$key][$key2]['id']                  = $this->Assessment->id;
          $asmt[$key][$key2]['assessment_id']       = $this->Assessment->id;
          $asmt[$key][$key2]['validated']           = 0; 

          if ($key2 != 'Resident' || $key2 != 'Facility' || $key2 != 'User')
            ClassRegistry::init($key2)->save($asmt[$key][$key2], false);

        }

      }


      $this->Session->setFlash(ucwords($msg), 'default', array('class' => 'success'));
      $this->redirect('index', null, false);

    }

		$this->set('current', $assessment);


	}
	
	public function ajaxSave($section = null, $id = null) 
	{
		Configure::write('debug', 0);
		$this->RequestHandler->isAjax();
		return true;
	}
	
	public function add ($id = null, $facno = null) 
	{
		
		if (!empty($this->data)) {
			
			$type = $this->Calc->calcIsc($this->data);
																				
			$this->data['Assessment']['type'] = $type;
			$resident = $this->Assessment->Resident->getResident($this->data['Assessment']['resident']);
			
			$this->data['Assessment']['ATYPEOPAY']	= $resident['Resident']['ATYPEOPAY'];
			$this->data['Assessment']['ATYPEOPAY2']	= $resident['Resident']['ATYPEOPAY2'];
			$this->data['Assessment']['ATYPEOPAY3']	= $resident['Resident']['ATYPEOPAY3'];
			$this->data['Assessment']['ATYPEOPAY4']	= $resident['Resident']['ATYPEOPAY4'];
			$this->data['Assessment']['ATOPDTE']	= $resident['Resident']['ATOPDTE'];
			$this->data['Assessment']['ATOPDTE2']	= $resident['Resident']['ATOPDTE2'];
			$this->data['Assessment']['ATOPDTE3']	= $resident['Resident']['ATOPDTE3'];
			$this->data['Assessment']['ATOPDTE4']	= $resident['Resident']['ATOPDTE4'];

			if ($this->data['SectionA']['A2300'] >= '2012-04-01') {
				$item_subset = '1.10';
				$this->data['SectionA']['A0500'] = 1;
			}

			if ($this->data['SectionA']['A2300']  < '2012-04-01') {
				$item_subset = '1.00';
				$this->data['SectionX']['X0100'] = 1;
			}

			$this->data['Assessment']['item_subset'] = $item_subset;
			
			// get previous assessment
			$prev = $this->Assessment->find('first', array(
				'conditions' => array(
          'Assessment.resident' => $this->data['Assessment']['resident'], 
          'Assessment.locked' => 1, 
          'Assessment.deleted' => 0
        ),
				'order' => array('Assessment.id' => 'DESC')
			));
			
			if ($type != '--') {
				$this->Assessment->save($this->data['Assessment'], false);	

        $new_id = $this->Assessment->id;

				// set section A			
				if (isset($prev['SectionA']) && !empty($prev['SectionA'])) {
					// unset crap data
					unset($prev['SectionA']['A0100A']);
					unset($prev['SectionA']['A0100B']);
					unset($prev['SectionA']['A0100C']);
					unset($prev['SectionA']['A0200']);
					unset($prev['SectionA']['A0310A']);
					unset($prev['SectionA']['A0310B']);
					unset($prev['SectionA']['A0310C']);
					unset($prev['SectionA']['A0310D']);
					unset($prev['SectionA']['A0310E']);
					unset($prev['SectionA']['A0310F']);
					unset($prev['SectionA']['A2300']);
					unset($prev['SectionA']['validated']);
					
					$this->data['SectionA'] = array_merge($this->data['SectionA'], $prev['SectionA']);
					
				}
				
				$fac = ClassRegistry::init('Facility')->find('first', array(
						'conditions' => array('Facility.id' => $this->data['Assessment']['facility_id']),
						'fields' => array(
							'Facility.NPI', 'Facility.CCN', 'Facility.STATE_PROVIDER_NUM'
						),
            'recursive' => -1
					));

        $this->data['SectionA']['id']             = $new_id; // id of the assessment
        $this->data['SectionA']['assessment_id']  = $new_id; // related assessment id
        $this->data['SectionA']['A0410']          = 3; // type of submission required
				
        if (empty($prev['Assessment']) && !isset($prev['Assessment'])) {
          // get resident data for this resident
          $res = $this->Assessment->Resident->getResident($this->data['Assessment']['resident']);

          list($facility_id,$medrec) = explode('-', $this->data['Assessment']['resident']);

          $this->data['SectionA']['A0100A']         = $fac['Facility']['NPI']; // npi number

          $this->data['SectionA']['A0100B']         = $fac['Facility']['CCN']; // ccn number
          $this->data['SectionA']['A0100C']         = $fac['Facility']['STATE_PROVIDER_NUM'];
          $this->data['SectionA']['A1600']          = $res['Resident']['ADATE']; // entry date
          $this->data['SectionA']['A0900']          = $res['Resident']['BDATE']; // birthday
          $this->data['SectionA']['A0500A']         = $res['Resident']['PATFNAME']; // first name
          $this->data['SectionA']['A0500B']         = $res['Resident']['PMI']; // middle name
          $this->data['SectionA']['A0500C']         = $res['Resident']['PATLNAME']; // last name
          $this->data['SectionA']['A0600A']         = str_replace('-', '', $res['Resident']['SSNUM']); // social securtiy number
          $this->data['SectionA']['A0600B']         = $res['Resident']['MEDICARE']; // medicare number
          $this->data['SectionA']['A0700']          = $res['Resident']['MEDICAID']; // medicaid number
          $this->data['SectionA']['A1300A']          = $medrec; // medical records number

        }

        ksort($this->data['SectionA']);
				
				$this->Assessment->SectionA->save($this->data['SectionA'], false);

				$SectionI = $this->Assessment->SectionI->findLast($id);
				$SectionI['SectionI']['id'] = $new_id;
				$SectionI['SectionI']['assessment_id'] = $new_id;
				$this->Assessment->SectionI->save($SectionI['SectionI'], false);

				$SectionO								= $this->Assessment->SectionO->findLast($id);
				$SectionO['SectionO']['id']				= $new_id;
				$SectionO['SectionO']['assessment_id']	= $new_id;
				$this->Assessment->SectionO->save($SectionO['SectionO'], false);

				$SectionM								= $this->Assessment->SectionM->findLast($id);
				$SectionM['SectionM']['id']				= $new_id;
				$SectionM['SectionM']['assessment_id']	= $new_id;
				$this->Assessment->SectionM->save($SectionM['SectionM'], false);

				$SectionS								= $this->Assessment->SectionS->findLast($id);
				$SectionS['SectionS']['id']				= $new_id;
				$SectionS['SectionS']['assessment_id']	= $new_id;
				$this->Assessment->SectionS->save($SectionS['SectionS'], false);
				
				$this->redirect('/assessments/edit/a/'. $new_id, null, false);
			}
			else {
				$this->Session->setFlash('Sorry this is an invalid combination for an Assessment', 'default', array('class' => 'error'));
			}
		}
		$resident = $this->Assessment->Resident->getResident($id);
		
		$facility = $this->Assessment->Facility->find('first', array(
			'conditions' => array('Facility.id' => $resident['Resident']['facility_id']),
			'fields' => array('Facility.F_STATE', 'Facility.TYPE', 'Facility.name', 'Facility.id', 'Facility.NPI', 'Facility.CCN', 'Facility.STATE_PROVIDER_NUM'),
			'recursive' => -1
		));
		
		// setting new Assessment
		$this->data['Assessment']['resident']				= $id;
		$data->data['Assessment']['transmission_status']	= 0;
		$data->data['Assessment']['locked']					= 0;
		$data->data['Assessment']['facility_id']			= $facno;
		
		// setting new Section A
		$this->data['SectionA']['A0100A']					= $facility['Facility']['NPI'];
		$this->data['SectionA']['A0100B']					= $facility['Facility']['CCN'];
		$this->data['SectionA']['A0100C']					= $facility['Facility']['STATE_PROVIDER_NUM'];
		$this->data['SectionA']['A0200']					= $facility['Facility']['TYPE'];
		
		$this->set(compact('facility', 'resident'));
	}
	
	/**
	 * Add Medical Short-stay Assessment
	 */
	public function edit ($section = null, $id = null) {
		// set section
		if (empty($section)) $section = 'a';
		
		$this->set('id', $id);
		
		if (!empty($this->data)) {

			// check if allowed to update
			$assessment = $this->Assessment->find('first', array(
				'conditions' => array('Assessment.id' => $id),
				'fields' => array('Assessment.resident', 'Assessment.id', 'Assessment.locked', 'Assessment.transmission_status'),
				'recursive' => -1
			));
			
			$allowed = 0;
			if ($assessment['Assessment']['locked'] == 0)			    $allowed = 1;
			if ($assessment['Assessment']['transmission_status'] == 3)	$allowed = 1;
			
			$sections = array_keys($this->data);
			
			if ($allowed == 0 || $allowed == 1) {
					
				$data = Sanitize::clean( $this->data );

				$this->Model = ClassRegistry::init('Section'. strtoupper($section));

				// get resident
				$resident = $this->Assessment->Resident->find('first', array(
					'conditions' => array('Resident.id' => $assessment['Assessment']['resident']),
					'recursive' => -1
				));
				
				$validated = false;
				$this->Model->save($data, $validated);
				$this->Model->set($data);

				if($this->Model->validates() == true)  
				{
					$validated = true;

					$this->Session->setFlash('This section was saved successfully.', 'default', array('class' => 'success'));
				}
				else
					$this->Session->setFlash('This section could not be validated, but was saved', 'default', array('class' => 'warning'));		

				$data[$this->Model->name]['validated'] = $validated;

        $this->Assessment->RugCache->update_cache($id);
				$this->Model->save($data);

				// save the type
				if ($sections[0] == 'SectionA') 
					$type = $this->__saveType($id);	 
			}

			$this->set(compact('data'));
		}

		$this->data = $this->Caa->trigger($id);

		$this->Assessment->save(array('id' => $id, 'user_id' => $this->Auth->user('id')), false);
		$this->set('section', $section);
		
		// get residents
		$resident = $this->Assessment->Resident->find('first', array(
			'conditions' => array('Resident.id' => $this->data['Resident']['id']),
			'recursive' => -1
		));
		
		if ($section == 's' && $this->data['Facility']['F_STATE'] == 'PA') 
			$this->set('counties_pa', ClassRegistry::init('CountyPa')->get());

		$type = $this->Calc->calcIsc ($this->data);
		
		$previous = $this->Assessment->getPrevious($id, $this->data['Assessment']['resident']);

		$this->set('previous', $previous);

		$this->data['Assessment']['type'] = $type;

		if ($this->data['Assessment']['type'] == '--' || $this->data['Assessment']['type'] == '') {
			$this->Session->setFlash('Invalid Assessment Type', 'default', array('class' => 'error'));

			if ($section != 'a')
				 header('Location: /assessments/edit/a/'. $id);
		}

		// get the previous assessment
		$previous = $this->Assessment->find('first', array(
			'conditions' => array(
				'Assessment.id !=' => $id,
				'Resident.id' => $this->data['Assessment']['resident'],
				'Assessment.locked' => 1,
				'Assessment.deleted' => 0,
				'or' => array(
					'SectionA.A0310A' => array('01','02','03','04','05','06'),
					'SectionA.A0310B' => array('01','02','03','04','05','06','07'),
				)
			),
			'fields' => array(
				'SectionA.A0310A', 'SectionA.A0310B', 'SectionA.A2300', 
				'SectionC.C0500',
				'SectionD.D0300', 'SectionD.D0600'
			),
			'order' => array('Assessment.id' => 'DESC')
		));

		if (!empty($previous) && empty($this->data['SectionV']['V0100A'])) {
			$this->data['SectionV']['V0100A'] = $previous['SectionA']['A0310A'];
			$this->data['SectionV']['V0100B'] = $previous['SectionA']['A0310B'];
			$this->data['SectionV']['V0100C'] = $previous['SectionA']['A2300'];
			if ($previous['SectionC']['C0500'] == '') $this->data['SectionV']['V0100D'] = 0; else $this->data['SectionV']['V0100D'] = $previous['SectionC']['C0500'];
			if ($previous['SectionD']['D0300'] == '') $this->data['SectionV']['V0100E'] = 0; else $this->data['SectionV']['V0100E'] = $previous['SectionD']['D0300'];
			$this->data['SectionV']['V0100F'] = $previous['SectionD']['D0600'];
		}

	}	
	
	public function report ($id = null, $print = false) 
	{

		// set section Z
		if (isset($this->data['finished']['validate']) && $this->data['finished']['validate'] == 1) {
			// check for the validation

			$assessment = $this->Assessment->find('first', array(
				'conditions' => array('Assessment.id' => $id),
				'fields' => array('Assessment.facility_id', 'Assessment.item_subset'),
				'recursive' => -1
			));

			$facility = ClassRegistry::init('Facility')->find('first', array(
				'conditions' => array('Facility.id' => $assessment['Assessment']['facility_id']),
				'facilities' => array('Facility.F_STATE'),
				'recursive' => -1
			));

			$type = $this->__saveType($id);

			if ($this->__checkValidation ($id, $type, $facility['Facility']['F_STATE'], $assessment['Assessment']['item_subset']) == 1) {
				$this->Session->setFlash( 'This assessment has been completely validated.', 'default', array('class' => 'info'));
				$this->Assessment->save(array('id' => $id, 'validated' => 1), false);
			}
			else {
				$this->Session->setFlash('Sorry this assessment could not be validated.', 'default', array('class' => 'info'));
			}
		}

		if (isset($this->data['finished']['end']) && $this->data['finished']['end'] == 1) {

			$assessment = $this->Assessment->find('first', array(
				'conditions' => array('Assessment.id' => $id),
				'recursive' => -1
			));

			$facility = ClassRegistry::init('Facility')->find('first', array(
				'conditions' => array('Facility.id' => $assessment['Assessment']['facility_id']),
				'facilities' => array('Facility.F_STATE'),
				'recursive' => -1
			));

			if (empty($assessment['Assessment']['lock_date'])) {
				$assessment['Assessment']['lock_date'] = date('Y-m-d');
				$assessment['Assessment']['locked'] = 1;
				$this->Assessment->save($assessment['Assessment']);
			}
			else {
				$assessment['Assessment']['locked'] = 1;
				$this->Assessment->save($assessment['Assessment']);
			}
			 
			$this->Report->createTransmissionfile($id, $facility['Facility']['F_STATE']);

			$this->Session->setFlash('This assessment is now locked from further modifications. ', 'default', array('class' => 'info'));
		}
		
		$this->data = $this->Caa->trigger($id);

    $rug_cache = $this->Assessment->RugCache->update_cache($id);
    $this->set('rug_cache', $rug_cache);

		$previous = $this->Assessment->getPrevious($id, $this->data['Assessment']['resident']);
		$this->set('previous', $previous);
		
		$this->set('section', 'r');

		if ($print == 'print') {
			$this->layout = 'printing';
			$this->render('print');
		}

	}
	
	public function change_lock_date ($id = null) 
	{
		Controller::loadModel('ChangeRequest');

		if (!empty($this->data)) {
			$this->ChangeRequest->save(Sanitize::clean($this->data));
			$this->Session->setFlash('Change Request recieved and we have been notified', 'default', array('class' => 'success'));

			$user = $this->Assessment->User->find('first', array(
					'conditions' => array('User.id' => $this->data['ChangeRequest']['user_id']),
					'fields' => array('User.name'),
					'recursive' => -1
				));
		
			// who are we notifying
			$this->Email->to		= 'jonathan.b@it-mgt.com';
			$this->Email->subject	= 'Change Request submitted';	
			
			// structure the email message
			$msg	= '-----------------------------------------------------------' . "\n";
			$msg .= '										 CHANGE DETAILS ' . "\n";							 
			$msg .= '-----------------------------------------------------------' . "\n";
			$msg .= '' . "\n";
			$msg .= 'Assessment ID#:	 '. $this->data['ChangeRequest']['assessment_id'] . "\n";
			$msg .= 'Requested By:	     '. $user['Resident']['name'] . "\n";
			$msg .= 'Current Lock Date:  '. $this->data['ChangeRequest']['current_lock_date'] . "\n";
			$msg .= 'New Lock Date:      '. $this->data['ChangeRequest']['lock_date'] . "\n";
			$msg .= 'Reason:             '. $this->data['ChangeRequest']['reason'] . "\n";
			$msg .= '' . "\n";
			$msg .= '-----------------------------------------------------------' . "\n";
			
			$this->Email->send($msg);
			
			$this->redirect(array('action' => 'report', $id), null, false);
			
		}

		$assessment = $this->Assessment->find('first', array(
			'conditions' => array('Assessment.id' => $id),
			'recursive' => -1
		));

		$facility = ClassRegistry::init('Facility')->find('first', array(
			'conditions' => array('Facility.id' => $assessment['Assessment']['facility_id']),
			'facilities' => array('Facility.F_STATE'),
			'recursive' => -1
		));

		if (empty($assessment['Assessment']['lock_date'])) {
			$assessment['Assessment']['lock_date'] = date('Y-m-d');
			$assessment['Assessment']['locked'] = 1;
			$this->Assessment->save($assessment['Assessment']);
		}
		else {
			$assessment['Assessment']['locked'] = 1;
			$this->Assessment->save($assessment['Assessment']);
		}
		 
		$this->Report->createTransmissionfile($id, $facility['Facility']['F_STATE']);
		
		$this->data = $this->Caa->trigger($id);

		$previous = $this->Assessment->getPrevious($id, $this->data['Assessment']['resident']);
		$this->set('previous', $previous);
		
		$this->set('section', 'r');

		$this->data['Assessment']['late'] = $this->Clock->checkLate($this->data['Assessment']['id']);

	}
	
	public function getAge($date = null) 
	{
		if (empty($date)) return $age;

		list($y, $m, $d) = explode('-', $date);
		$y_diff = date("Y") - $y;
		if (date('m') >= $m && date('d') >= $d) $age = $y_diff - 1;
		else $age = $y_diff;
		return $age;
	}
	
	public function update($id, $status) 
	{
		$data['Assessment']['id'] = $id;
		$data['Assessment']['transmission_status'] = $status;
		$this->Assessment->save($data['Assessment'], false);
		$this->Session->setFlash('Successfully updated the transmission status', 'default', array('class' => 'success'));
		$this->redirect($this->referer(), null, false);
	}
	
	public function history ($id = null, $section = 'history') 
	{
		
		Controller::loadModel('Log');
		$this->paginate = array(
			'conditions' => array(
				'or' => array(
					'Log.assessment_id' => $id,
					'and' => array(
						'Log.model' => 'Assessment',
						'Log.model_id' => $id
					 )
				)
			),
			'limit' => 50,
			'order' => array('Log.created' => 'DESC')
		);
		$data = $this->paginate('Log');
		
		$this->Assessment->unbindModel(array('belongsTo' => array('User')));
		$this->data = $this->Assessment->find('first', array(
			'conditions' => array('Assessment.id' => $id),
		));
		
		$this->data = $this->Caa->report($this->data);
		$this->set(compact('data', 'section'));

		$previous = $this->Assessment->getPrevious($id, $this->data['Assessment']['resident']);
		$this->set('previous', $previous);
	}
	
	public function caa ($id = null, $section = 'caa') 
	{
		if (!empty($this->data)) {
			
			// check if you can lock this item
			if ($this->data['SectionV']['V0200A01E'] == 1 && empty($this->data['SectionV']['V0200A01F'])) {
				$this->data['SectionV']['V0200A01F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A01G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A02E'] == 1 && empty($this->data['SectionV']['V0200A02F'])) {
				$this->data['SectionV']['V0200A02F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A02G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A03E'] == 1 && empty($this->data['SectionV']['V0200A03F'])) {
				$this->data['SectionV']['V0200A03F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A03G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A04E'] == 1 && empty($this->data['SectionV']['V0200A04F'])) {
				$this->data['SectionV']['V0200A04F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A04G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A05E'] == 1 && empty($this->data['SectionV']['V0200A05F'])) {
				$this->data['SectionV']['V0200A05F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A05G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A06E'] == 1 && empty($this->data['SectionV']['V0200A06F'])) {
				$this->data['SectionV']['V0200A06F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A06G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A07E'] == 1 && empty($this->data['SectionV']['V0200A07F'])) {
				$this->data['SectionV']['V0200A07F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A07G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A08E'] == 1 && empty($this->data['SectionV']['V0200A08F'])) {
				$this->data['SectionV']['V0200A08F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A08G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A09E'] == 1 && empty($this->data['SectionV']['V0200A09F'])) {
				$this->data['SectionV']['V0200A09F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A09G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A10E'] == 1 && empty($this->data['SectionV']['V0200A10F'])) {
				$this->data['SectionV']['V0200A10F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A10G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A11E'] == 1 && empty($this->data['SectionV']['V0200A11F'])) {
				$this->data['SectionV']['V0200A11F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A11G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A12E'] == 1 && empty($this->data['SectionV']['V0200A12F'])) {
				$this->data['SectionV']['V0200A12F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A12G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A13E'] == 1 && empty($this->data['SectionV']['V0200A13F'])) {
				$this->data['SectionV']['V0200A13F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A13G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A14E'] == 1 && empty($this->data['SectionV']['V0200A14F'])) {
				$this->data['SectionV']['V0200A14F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A14G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A15E'] == 1 && empty($this->data['SectionV']['V0200A15F'])) {
				$this->data['SectionV']['V0200A15F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A15G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A16E'] == 1 && empty($this->data['SectionV']['V0200A16F'])) {
				$this->data['SectionV']['V0200A16F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A16G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A17E'] == 1 && empty($this->data['SectionV']['V0200A17F'])) {
				$this->data['SectionV']['V0200A17F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A17G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A18E'] == 1 && empty($this->data['SectionV']['V0200A18F'])) {
				$this->data['SectionV']['V0200A18F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A18G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A19E'] == 1 && empty($this->data['SectionV']['V0200A19F'])) {
				$this->data['SectionV']['V0200A19F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A19G'] = $this->Auth->user('id');
			}
			if ($this->data['SectionV']['V0200A20E'] == 1 && empty($this->data['SectionV']['V0200A20F'])) {
				$this->data['SectionV']['V0200A20F'] = date('Y-m-d');
				$this->data['SectionV']['V0200A20G'] = $this->Auth->user('id');
			}
			
			$this->Assessment->SectionV->save($this->data, false);
			$this->Session->setFlash('Successfully updated the care plans', 'default', array('class' => 'success'));
		}
		
		$this->data = $this->Caa->trigger($id);
    
		$this->set(compact('section'));

		$previous = $this->Assessment->getPrevious($id, $this->data['Assessment']['resident']);
		$this->set('previous', $previous);
		
	}
	
	public function remove ($id = null) 
	{
		$this->Assessment->save(array('id' => $id, 'deleted' => 1));
		$this->Session->setFlash('Assessment #'. $id .' has been deleted', 'default', array('class' => 'success'));
		$this->redirect ($this->referer(), null, false);
	}
	
	public function undelete ($id = null) 
	{
		$this->Assessment->save(array('id' => $id, 'deleted' => 0));
		$this->Session->setFlash('Assessment #'. $id .' has been un-deleted', 'default', array('class' => 'success'));
		$this->redirect ($this->referer(), null, false);
	}
	
	public function regenerate ($id, $state) 
	{ 
		$this->Report->createTransmissionfile ($id, $state);
		$this->Session->setFlash('Successfully regenerated the transmission file for Assessment ID #'. $id, 'default', array('class' => 'success'));
		$this->redirect('/assessments/report/'. $id);
	}
	
	private function __saveType ($id) 
	{
		
		// get the information from assessment
		$info = $this->Assessment->find('first', array(
			'conditions' => array('Assessment.id' => Sanitize::clean($id)),
		));

		return $this->Calc->calcIsc($info);
	}
	
	/**
	 * Check for the validation
	 */
	private function __checkValidation ($id, $type, $state, $item_subset) 
	{

		// verify for entry
		$a = $this->Assessment->SectionA->find('first', array(
			'conditions' => array('SectionA.id' => $id),
			'fields' => array('SectionA.A2300', 'SectionA.A2000', 'SectionA.A1600')
		));

		if (
			$a['SectionA']['A2300'] >= '2012-04-01' || 
			$a['SectionA']['A2000'] >= '2012-04-01' || 
			$a['SectionA']['A1600'] >= '2012-04-01'
		)
			$item_subset = '1.10';


		// set the fields
		$fields = ClassRegistry::init('ReportType')->getType($type, $item_subset);
		
		// set fields for PA
		if ($state == 'PA') {
			if ($type == 'NT') {
				$fields[] = 'SectionS.S0120'; $fields[] = 'SectionS.S0123'; $fields[] = 'SectionS.S9080E';
			}
			if ($type == 'NC' || $type == 'NQ' || $type == 'NP' || $type == 'NT' || $type == 'ND') {
				$fields[] = 'SectionS.S9080A'; $fields[] = 'SectionS.S9080B'; $fields[] = 'SectionS.S9080C'; $fields[] = 'SectionS.S9080D'; 
				$fields[] = 'SectionS.S9080D';
			}
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
				$fields[] = 'SectionS.S2010';	$fields[] = 'SectionS.S2011';	$fields[] = 'SectionS.S4000A'; $fields[] = 'SectionS.S4000B';
				$fields[] = 'SectionS.S4000C';	$fields[] = 'SectionS.S4000D'; $fields[] = 'SectionS.S4010A'; $fields[] = 'SectionS.S4010B';
				$fields[] = 'SectionS.S4010C';	$fields[] = 'SectionS.S4010D'; $fields[] = 'SectionS.S4010E'; $fields[] = 'SectionS.S4500';
				$fields[] = 'SectionS.S4510A';	$fields[] = 'SectionS.S4510B'; $fields[] = 'SectionS.S4510C'; $fields[] = 'SectionS.S4510D';
				$fields[] = 'SectionS.S4510E';	$fields[] = 'SectionS.S4510F'; $fields[] = 'SectionS.S9000';	$fields[] = 'SectionS.S9001';
				$fields[] = 'SectionS.S9002A';	$fields[] = 'SectionS.S9002B'; $fields[] = 'SectionS.S9002C'; $fields[] = 'SectionS.S9002D';
				$fields[] = 'SectionS.S9002E';	$fields[] = 'SectionS.S9002F'; $fields[] = 'SectionS.S9002G'; $fields[] = 'SectionS.S9002H';
				$fields[] = 'SectionS.S9002i';	 $fields[] = 'SectionS.S9003';
			}
			if ($type == 'NQ') {
				$fields[] = 'SectionS.S2010'; $fields[] = 'SectionS.S2011';
			}
		}
		
		// get the appropriate fields from the database
		$data = $this->Assessment->find('first', array(
			'conditions' => array('Assessment.id' => $id),
			'fields' => $fields,
			'limit' => 1
		));

		if (isset($data['SectionA']['A0050']) && $data['SectionA']['A0050'] == 1) {
			unset($data['SectionX']);
		}
		
		if (isset($data['SectionB']['B0100'])	&& $data['SectionB']['B0100'] == 1) {
			unset($data['SectionC']);
			unset($data['SectionD']);
			unset($data['SectionE']);
			unset($data['SectionF']);
		}

	    if (array_key_exists('A0310A', $data) && isset($data['SectionA']['A0310A'])) $A0310A = $data['SectionA']['A0310A']; else $A0310A  = $data['SectionA']['A0310A'];
	    if (array_key_exists('A0310B', $data) && isset($data['SectionA']['A0310B'])) $A0310B = $data['SectionA']['A0310B']; else $A0310B  = $data['SectionA']['A0310B'];
	    if (array_key_exists('A0310G', $data) && isset($data['SectionA']['A0310G'])) $A0310G = $data['SectionA']['A0310G']; else $A0310G  = '';
		
	    if (
	      $A0310G == 2 && 
	      ($A0310A != '01' && $A0310A != '02' && $A0310A != '03' && $A0310A != '04' && $A0310A != '05' && $A0310A != '06') && 
	      ($A0310B != '01' && $A0310B != '02' && $A0310B != '03' && $A0310B != '04' && $A0310B != '05' && $A0310B != '06')
	    ) {
	    	unset($data['SectionD']);
	    }
	    
		// unset unneccassary data
		unset($data['Assessment']);
		unset($data['CarePlan']);
		unset($data['Facility']);
		unset($data['Resident']);
		
		// set the sections to show
		$cnt_models = 0;
		$cnt_validated = 0;


		
		foreach ($data as $key => $value) {
			$section = ClassRegistry::init($key)->find('first', array(
				'conditions' => array($key .'.assessment_id' => $id),
				'fields' => array('Assessment.id', $key .'.validated'),
				'recursive' => 0
			));

			// check if inactiavation
			if (isset($data['SectionA']['A0050']) && $data['SectionA']['A0050'] != 3) {

        if (isset($data['SectionA']['A0310G']) && $data['SectionA']['A0310G'] == 2 && $key == 'SectionD')  
          $info[$key] = 1;
        elseif (isset($data['SectionA']['A0310G']) && $data['SectionA']['A0310G'] == 1 && $key == 'SectionD')  
          $info[$key] = 1;
        else
          $info[$key] = $section[$key]['validated'];

        if ($info[$key] == 1) $cnt_validated += 1;
        $cnt_models++;
				
			}
      else {
        if ($key == 'SectionA' || $key == 'SectionX') {
          $info[$key] = $section[$key]['validated'];
          if ($section[$key]['validated'] == 1) $cnt_validated += 1;
          $cnt_models++;
        }
      }
		}


		if ($cnt_models == $cnt_validated) return 1; else return 0;
	}

	public function rollback ($id) 
	{
		if (!empty($id)) {
			
			Controller::loadModel('Log');
			
			// get the appropriate fields from the database
			$data = $this->Log->find('first', array(
				'conditions' => array('Log.id' => $id),
				'limit' => 1
			));
			
			
			if( $data['Log']['change'] == '' ) {
				$this->Session->setFlash('Sorry there was nothing to change.', 'default', array('class' => 'error'));
			}
			else if( empty($data) ) {
				$this->Session->setFlash('Sorry there was no history found.', 'default', array('class' => 'error'));
			}
			else {
								
				// get the changes
				$changes = explode(',', $data['Log']['change']);
				
				$change[$data['Log']['model']]['id'] = $data['Log']['model_id'];
				
				// create an array for the changes
				foreach ($changes as $key => $value) {
					list ($var, $val) = explode('=>', $value);
					
					$val = str_replace(array('(', ')'), '', $val);
					$val = trim($val); 
					
					list ($field, $bleh) = explode('(', str_replace(' ', '', $var));
					
					$change[$data['Log']['model']][$field] = $val;
					
					if ($val == '')
						unset($change[$data['Log']['model']][$field]);
				}
				
				// save the changed data
				if(ClassRegistry::init($data['Log']['model'])->save($change, false)) {
					
					//Set a session flash message and redirect.
					$this->Session->setFlash('The history item was rollbacked successfully.', 'default', array('class' => 'success'));

				}
				else {
					
					//Set a session flash message and redirect.
					$this->Session->setFlash('The history item was not rollbacked successfully.', 'default', array('class' => 'error'));
				}
			}
			
			// go back to the previous page
			$this->redirect($this->referer(), null, false);
		} 
	}
	
	public function catreason($id, $caaNum) {
    if (strlen($caaNum) == 1) $caaReason = 'cat0'. $caaNum .'reason';
    else $caaReason = 'cat'. $caaNum .'reason';
    $this->set('reason', $this->Caa->{$caaReason}($id));
	}

	private function doModification ($id = null)
	{

		$this->Assessment->unbindModel(array(
			'belongsTo' => array('Facility', 'Resident',	'User')
		));

		$previous = $this->Assessment->find('first', array(
			'conditions' => array('Assessment.id' => $id),
		));
		
		// create the new assessment from the previous data
		$new['Assessment'] = $previous['Assessment'];
		unset($new['Assessment']['id']);
		
		$this->Assessment->create();
		$this->Assessment->save($new, false);
		
		// reset the information again
		$new = $previous;
		$new['Assessment']['id'] = $this->Assessment->id;
		
		// remove uneeded models
		unset($new['Facility']);
		unset($new['Resident']);
		unset($new['User']);
		
		ksort($new['SectionX']);
		
		$new['SectionX']['X0100'] = 2;
		$new['SectionX']['X0150'] = $previous['SectionA']['A0200'];
		$new['SectionX']['X0200A'] = $previous['SectionA']['A0500A'];
		$new['SectionX']['X0200C'] = $previous['SectionA']['A0500C'];
		$new['SectionX']['X0300'] = $previous['SectionA']['A0800'];
		$new['SectionX']['X0400'] = str_replace('-', '', $previous['SectionA']['A0900']);
		$new['SectionX']['X0500'] = $previous['SectionA']['A0600A'];
		$new['SectionX']['X0600A'] = $previous['SectionA']['A0310A'];
		$new['SectionX']['X0600B'] = $previous['SectionA']['A0310B'];
		$new['SectionX']['X0600C'] = $previous['SectionA']['A0310C'];
		$new['SectionX']['X0600D'] = $previous['SectionA']['A0310D'];
		$new['SectionX']['X0600F'] = $previous['SectionA']['A0310F'];
		$new['SectionX']['X0700A'] = substr($previous['SectionA']['A2300'], 4, 4) . substr($previous['SectionA']['A2300'], 0, 4);
		$new['SectionX']['X0700B'] = substr($previous['SectionA']['A2000'], 4, 4) . substr($previous['SectionA']['A2000'], 0, 4);
		$new['SectionX']['X0700C'] = str_replace('-', '', $previous['SectionA']['A1600']);

		// set the new ids
		foreach ($new as $key => $value) {
			$new[$key]['id'] = $this->Assessment->id;
			$new[$key]['assessment_id'] = $this->Assessment->id;
			$new[$key]['validated']	 = 0;
			ClassRegistry::init($key)->save($new[$key], false);
		}
		
		$new['Assessment']['locked'] = 0;
		$new['Assessment']['transmission_status'] = 0;
		
		// save the new information
		$this->Assessment->save($new, false);


		// inactivate the original assessment
		$this->Assessment->save(array('id' => $this->Assessment->id, 'X0100' => 3), false);
		
		header('Location: /assessments/edit/a/'. $this->Assessment->id);
		exit();
	}
}