<?php

App::import('Core', 'Sanitize');
class UsersController extends AppController {

	public $name = 'Users';
	public $helpers = array('Text');
	public $components = array(
		'Email' => array(
			'from' => 'noreply@care.adelpo.net'
		)
	);
	public $uses = array('User', 'Group', 'Facility');
	
	public function beforeFilter () {
		parent::beforeFilter();
		$this->Auth->allow('login', 'logout', 'forgot');
	}
	
	public function index () {
		// get Facilities
    	$tree = $this->Facility->getSafeTreeList($this->Auth->user('facility_id')); 

    	foreach ($tree as $key => $value) {
    		$facilities[] = $key;
    	}
		
		$conditions = array();
		
		 // sort through filters data
		$get = $this->params['url'];
		if (!empty($get['name']) && $get['name'] != 'Name') $conditions['User.name LIKE'] = '%'. $get['name'] .'%';
		if (!empty($get['facility_id'])) $conditions['User.facility_id'] =	$get['facility_id'];
		if (!empty($get['group_id']) && $get['group_id'] != '') {
			$conditions['Group.id'] = $get['group_id'];
		}
		
		if(empty($conditions)) 	{
			$conditions['User.group_id >='] = $this->Auth->user('group_id');
			$conditions['User.facility_id'] = $facilities;
		}
		
		$this->paginate = array(
			'conditions' => $conditions,
			'fields' => array(
				'User.id', 'User.name', 'User.username', 'User.email', 'User.created', 'User.modified',
				'Group.id', 'Group.name',
				'Facility.id', 'Facility.name'
			),
			'recursive' => 0
		);
		$data = $this->paginate('User');
		
		$this->set(compact('data'));
    	$this->setOptions(); 
	}
	
	public function add () {

		if (!empty($this->data)) {
			$data = Sanitize::clean($this->data);
			$data['User']['password'] = $this->Auth->hashPasswords($data['User']['password']);
			if ($this->User->save($data)) {
				$this->Session->setFlash('Successfully added User', 'default', array('class' => 'success'));
				$this->redirect('index', null, false);
			}
			else {
				$this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
			}
		}
    	$this->setOptions(); 
	}
	
	public function edit ( $id = null ) {
		if (!empty($this->data)) {
			$data = Sanitize::clean($this->data);
			if ($this->User->save($data['User'])) {
				$this->Session->setFlash('Successfully added User', 'default', array('class' => 'success'));
				$this->redirect('index', null, false);
			}
			else {
				$this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
			}
		}
		if (isset($id)) {
			$this->data = $this->User->read(null, Sanitize::clean($id));
		}
    	$this->setOptions(); 
	}
	
	public function delete ( $id = null ) {
		if (!$id) {
			$this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
			$this->redirect($this->referer(), null, false);
		}
		$this->User->id = Sanitize::clean($id);
		if ($this->User->delete()) {
			$this->Session->setFlash('Successfully deleted User', 'default', array('class' => 'success'));
			$this->redirect($this->referer(), null, false);
		}
		else {
			$this->Session->setFlash('Sorry there was an error', 'default', array('class' => 'error'));
			$this->redirect($this->referer(), null, false);
		}
	}

	public function setOptions() {
		
    	$this->set('facilities', $this->Facility->getSafeTreeList($this->Auth->user('facility_id'))); 

    	$groups = $this->Group->getSafeTreeList($this->Auth->user('group_id'));
    	unset($groups[$this->Auth->user('group_id')]);

    	$this->set('groups', $groups); 
		
	}

	public function account () {
		
	}
	
	public function password() {
		
		if (!empty($this->data)) {
			$data = Sanitize::clean($this->data);
			if ( $data['User']['password_new'] == $data['User']['password_confirm'] ) {

				$userinfo['User']['id'] 		= $this->Auth->user('id');
				$userinfo['User']['password'] 	= $this->Auth->password($data['User']['password_new']);

				$this->User->save($userinfo, false);
				$this->Session->setFlash('Successfully changed '. $data['User']['name'] .'\'s password', 'default', array('class' => 'success'));
				$this->redirect('account', null, false);
			}
			else {
				$this->Session->setFlash('Sorry the new password does not match.', 'default', array('class' => 'error'));
			}
		}
		
		if (isset($id)) {
			$this->data = $this->User->read(null, Sanitize::clean($this->Auth->user('id')));
		}
	}
	
	public function change_password($id) {
		
		if (!empty($this->data)) {
			$data = Sanitize::clean($this->data);
			if ( $data['User']['password_new'] == $data['User']['password_confirm'] ) {

				$userinfo['User']['id'] 		= Sanitize::clean($id);
				$userinfo['User']['password'] 	= $this->Auth->password($data['User']['password_new']);

				$this->User->save($userinfo, false);
				$this->Session->setFlash('Successfully changed '. $data['User']['name'] .'\'s password', 'default', array('class' => 'success'));
				$this->redirect('index', null, false);
			}
			else {
				$this->Session->setFlash('Sorry the new password does not match.', 'default', array('class' => 'error'));
			}
		}
		
		if (isset($id)) {
			$this->data = $this->User->read(null, Sanitize::clean($id));
		}
	}
	
	public function upload() {
		if (!empty($this->data)) {

			if(!strcmp($this->data['User']['image']['type'], "application/vnd.ms-excel"))
			{
				// set a filename so we know what file to grab to import
				$now = date('Y-m-d-His');
				$fileFolder = TMP .'import';
				$filename = 'user_upload_'. $now;
				$filepath = TMP .'import'. DS. 'user_upload_'. $now.'.csv';
			
				$fileOK = $this->uploadFiles($fileFolder, $this->data, NULL, $filename); 
				
				App::import("Vendor","parsecsv");
				$this->Facility = ClassRegistry::init('Facility');
				$this->Group = ClassRegistry::init('Group');
				
				$facilities = $this->Facility->getNiceList(NULL);	
				$groups = $this->Group->getList(1);	
			
				//$filepath = TMP .'import'. DS. 'testdata.csv';
				$csv = new parseCSV();
				$csv->auto($filepath);
		
				// get titles from the first line in the csv file
				$titles = array();
			
				foreach ($csv->titles as $value) {
					array_push($titles, $value);			
				}
				
				$user_counter_success = 0;
				$user_counter_failed = 0;
				$importErrors = '';
				$userErrors = array();
				
				foreach ($csv->data as $key => $row) {
						// get id for facility
						$row['facility_id'] = array_search($row['facility'], $facilities);
						
						// get id for group
						$row['group_id'] = array_search($row['group'], $groups);			
 
						// set User model data array
						$this->User->data = $row;			
						$this->User->data = Sanitize::clean($this->User->data);
						
						// hash password
						$this->User->data['password'] = $this->Auth->password($this->User->data['password']);

						if ($this->User->saveAll($this->User->data,array('validate' => true))) {
							// keep counter of successful users added to report to users when done
							$user_counter_success++;
						}
						else {
							if (!isset($this->User->validate) || !empty($this->User->validationErrors)) { 
								foreach ($this->User->validationErrors as $key => $validErrors) {
											//$importErrors .= $row['username'].' '.$validErrors.'<br />';							
											$importErrors = $validErrors.'<br />';							
											
											// keep counter of successful users added to report to users when done
											$user_counter_failed++;																	
								}
								
								$row['error'] = $importErrors;
								
								// will pass array to upload.ctp so user knows which users rows in csv had a problem.
								array_push($userErrors, $row);
								
							}
						}
				}
			
				//$this->set('csv',$csv);
				if($user_counter_failed > 0) {
					$this->Session->setFlash($user_counter_success.' Users were successfully uploaded.<br />'.
																	 $user_counter_failed.' Users were not added.<br />', 'default', array('class' => 'error'));

					$this->set('importErrors', $importErrors);
					$this->set('userErrors', $userErrors);
				}
				else {					
					$this->Session->setFlash($user_counter_success.' Users were successfully uploaded.<br />', 'default', array('class' => 'success'));
					$this->redirect(array('action' => 'index'));
				}
					
				
			}
			else {
				$this->Session->setFlash('Sorry the file upload is not a csv file.	Please try again.', 'default', array('class' => 'error'));
				$this->redirect(array('action' => 'upload'));
			}
		}
	}
	
	function download () {
		$this->view = 'Media';
		
		$params = array(
			'id' => 'SampleUserData.csv',
			'name' => 'SampleUserData',
			'download' => true,
			'extension' => 'csv', // must be lower case
			'path' => TMP .'user-sample-data'. DS // don't forget terminal 'DS'
		);
		
		$this->set($params);
	}

	function forgot () {
		$this->layout = 'login';

		if (!empty($this->data)) {
			$data = Sanitize::clean($this->data);
			if (($user = $this->User->forgot($this->data['User']['email'])) == true) {

				list($name, $address) = explode('@', $user['User']['email']);

				$user['User']['password_clean'] = $name .'pass';
				$user['User']['password'] = $this->Auth->password($name .'pass');

				$this->User->save($user, false);
				$this->__forgotPassword($user);
				$this->Session->setFlash('A new password has been sent to you.', 'default', array('class' => 'success'));
			}
		}

	}
	
	public function login () {
		$this->layout = 'login';
	}
	
	public function logout() {
		$this->Session->delete('Auth');
		$this->redirect('/');
	}

	private function __forgotPassword($data) {
		
		$this->Email->to		= $data['User']['email'];
		$this->Email->subject	= 'MDS 3 | New Password Request';
		
		// structure the email message
		$msg  = '-----------------------------------------------------------' . "\n";
		$msg .= '                      New Password ' . "\n";							 
		$msg .= '-----------------------------------------------------------' . "\n";
		$msg .= '' . "\n";
		$msg .= 'Your login details are as follows:' . "\n";
		$msg .= '' . "\n";
		$msg .= 'Username: '. $data['User']['username'] . "\n";
		$msg .= 'Password: '. $data['User']['password_clean'] . "\n";
		$msg .= '' . "\n";
		$msg .= '-----------------------------------------------------------' . "\n";
		
		$this->Email->send($msg);
	}
	
}