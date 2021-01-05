<?php
    
App::import('Core', array('Cache', 'Inflector'));
class AppController extends Controller {
	
  public $components = array(
  	// 'Stats', 
  	'Auth' => array(
  		'loginAction' 		=> array('controller' => 'users', 'action' => 'login', 'plugin' => false),
  		'logoutRedirect' 	=> array('controller' => 'users', 'action' => 'login', 'plugin' => false),
  		'loginError' 			=> 'Invalid login credentials. Please try again.',
  		'authError' 			=> 'Please login'  		
  	), 
  	'Session', 
    'BruteForce.Detect',
    'DebugKit.Toolbar'
  );

  public $helpers = array('Time', 'Form', 'Session', 'Html', 'Menu');

  public function beforeFilter () {

    if (isset($this->{$this->modelClass}) && $this->{$this->modelClass}->Behaviors->attached('Logable')) {
      $this->{$this->modelClass}->setUserData($this->Session->read('Auth'));
    }
    if ($this->Auth->user()) {
    	$session = $this->Session->read('Auth');
    	
		$user = ClassRegistry::init('User')->getUser($session['User']['id']);
    	$session = array_merge($user, $this->Auth->user());
    	$this->Session->write('Auth', $session);

     	$this->set('user', $this->Auth->user());
    }

    $this->set('blocked', $this->Detect->checkForPenalty());
    
  }
  
  public function beforeRender () {
    // $this->Stats->save();
    
    $settings = $this->Session->read('Settings');
    if (empty($settings))
      $this->Session->write('Settings', ClassRegistry::init('Setting')->get());
      
    // $this->allowedModules();
    $this->allowed_facilities();
  }  

	public function autocomplete () {
		if ($this->RequestHandler->isAjax() && $this->RequestHandler->isPost()) {
			$fields = explode(",",$this->params['form']['fields']);
			$results = $this->{$this->params['form']['model']}->findAll($this->params['form']['search'].' LIKE \'%'.$this->params['form']['query'].'%\'',$fields,$this->params['form']['search'].' ASC',$this->params['form']['numresult']); 
			$this->set('results',$results);
			$this->set('fields',$fields);
			$this->set('model',$this->params['form']['model']);
			$this->set('input_id',$this->params['form']['rand']);
			$this->set('search',$this->params['form']['search']);
			$this->render('autocomplete','ajax','/common/autocomplete');                
		}
	} 
	
	function allowedModules () {
	    $permissions = ClassRegistry::init('ModulePermission')->find('all', array(
	      'conditions' => array('ModulePermission.facility_id' => $this->Auth->user('facility_id')),
	      'fields' => array('ModulePermission.allowed', 'Module.name', 'Module.path')
	    ));
	    
	    $this->set('allowedModules', $permissions);
	}
  
	function setSafeFacilityList () {
		if (($user = $this->Auth->user()) == true)
			return ClassRegistry::init('Facility')->getSafeTreeList($this->Auth->user('facility_id')); 

	}
  
  function allowed_facilities() {
    // get Facilities
    $allowed_facilities = $this->setSafeFacilityList();

    $this->set('allowed_facilities', $allowed_facilities);
    return $allowed_facilities;
  }
	
	/**
	 * uploads files to the server
   * 
   * @param $folder 	= the folder to upload the files e.g. 'img/files'
   * @param $formdata 	= the array containing the form files
   * @param $itemId 	= id of the item (optional) will create a new sub folder
	 * @return: will return an array with the success of each file upload
	 */
	function uploadFiles($folder_url, $formdata, $itemId = NULL, $filename = NULL) {
		
		// list of permitted file types, this is only images but documents can be added
		$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png', 'application/vnd.ms-excel');

		// loop through and deal with the files
		foreach($formdata as $file) {
			// assume filetype is false
			$typeOK = false;
			
			// check filetype is ok
			foreach($permitted as $type) {
				if($type == $file['image']['type']) {
				  
					if(!strcmp($type, "image/jpeg") ||  !strcmp($type,"image/jpeg") || !strcmp($type, "image/pjpeg") || !strcmp($type,"image/jpg") || !strcmp($type, "image/JPG"))
						$extension  = ".jpg";
					else if(!strcmp($type, "image/GIF") ||  !strcmp($type,"image/gif"))
					    $extension  = ".gif";
					else if(!strcmp($type, "image/PNG") ||  !strcmp($type,"image/png") ||  !strcmp($type,"image/x-png"))
					 	$extension  = ".png";
					else if(!strcmp($type, "application/vnd.ms-excel"))
					 	$extension  = ".csv";
					
					$typeOK = true;
					break;
				}
			}
			
			// if file type ok upload the file
			if($typeOK) {
				// switch based on error code
				switch($file['image']['error']) {
					case 0:
						// Find Correct Filename
						if($itemId || $filename) {
							if($itemId) {
								
								if($filename)
									$filename = $itemId."_".$filename;	
								else 
									$filename = $itemId;
							}
						}
						
						if($itemId || $filename) 
							$filename = $filename."".$extension;
						
						// check filename already exists
						if(!file_exists($folder_url.DS.$filename)) {
							// create full filename
							$full_url = $folder_url.DS.$filename;
							
							if(isset($rel_url))
								$url = $rel_url.'/'.$filename;
							else 
								$url = $full_url;

							// upload the file
							$success = move_uploaded_file($file['image']['tmp_name'], $url);
						} 
						else {
							// create unique filename and upload file
							ini_set('date.timezone', 'America/New_York');
							$now = date('Y-m-d-His');
							$full_url = $folder_url.'/'.$now.$filename;
							$url = $rel_url.'/'.$now.$filename;
							$success = move_uploaded_file($file['image']['tmp_name'], $url);
						}
						// if upload was successful
						if($success) 
							// save the url of the file
							$result['urls'][] = $url;
						else
							$result['errors'][] = "Error uploaded $filename. Please try again.";

						break;
					case 3:
						// an error occured
						$result['errors'][] = "Error uploading $filename. Please try again.";
						break;
					default:
						// an error occured
						$result['errors'][] = "System error uploading $filename. Contact webmaster.";
						break;
				}
			} 
			elseif($file['error'] == 4) {
				// no file was selected for upload
				$result['nofiles'][] = "No file Selected";
			} 
			else {
				// unacceptable file type
				$result['errors'][] = "$filename cannot be uploaded. Acceptable file types: gif, jpg, png.";
			}
		}
		
		return $result;
	}
  
  
  protected function __getRate($rug, $facility_id) {
    $rate = ClassRegistry::init('RugRate')->getRate($facility_id, $rug);
    return $rate['RugRate']['rate'];
  }
}
?>