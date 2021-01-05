<?php

App::import('Core', 'File');
define('IMPORT',    TMP     .'import'.    DS);
define('PENDING',   IMPORT  .'pending'.   DS);
define('PROCESSED', IMPORT  .'processed'. DS);

class MigrationsController extends AppController {

	public $name = 'Migrations';
	public $uses = array('Bulk', 'Facility','Assessment','Log', 'CarePlan', 'SectionV');
	public $components = array('Report');

	public function beforeRender () {
		$allowed_facilities = $this->__allowed_facilities();
		$this->set(compact('allowed_facilities'));
	}

	public function export ($id) {
		
		$this->set('facility_id', $id);
		
		if (!empty($this->params['url']['start'])) {
		
			$filename = WWW_ROOT .'exports' . DS . str_replace(array(' ', '_', '.'), '', strtolower(microtime())) .'.zip';
			
			$zip = new ZipArchive();
			$zip->open($filename, ZIPARCHIVE::CREATE);

			$s = $this->params['url']['start']['year'] .'-'. $this->params['url']['start']['month'] .'-'. $this->params['url']['start']['day'];
			$e = $this->params['url']['end']['year'] .'-'. $this->params['url']['end']['month'] .'-'. $this->params['url']['end']['day'];
			
			$this->Assessment = ClassRegistry::init('Assessment');

			$facility = ClassRegistry::init('Facility')->find('list', array(
					'conditions' => array('Facility.id' => $id),
					'fields' => array('Facility.F_STATE'),
					'recurisve' => -1
				));

			$asmt = $this->Assessment->find('all', array(
					'conditions' => array(
						'Assessment.facility_id' => $id,
						'Assessment.deleted' => 0,
						'Assessment.locked' => 1,
						'Assessment.transmission_status' => 2,
						'SectionA.A2300 >=' => $s,
						'SectionA.A2300 <=' => $e,
					),
					'fields' => array('Assessment.id')
				));
			
			foreach ($asmt as $key => $value) {
				$this->Report->createTransmissionfile ($value['Assessment']['id'], $facility[$id]);
				$file = $value['Assessment']['id'] .'.xml';
				$zip->addFile(WWW_ROOT .'transmission_files'. DS .'pending'. DS . $file, $file);
				$zip->close();
				$zip->open($filename, ZIPARCHIVE::OVERWRITE);
			}
			
			$zip->close();

			die;
			
			if (file_exists($filename)) {
				$this->layout = 'ajax';
				header('Cache-Control: no-cache, must-revalidate');
				header('Content-Type: application/x-zip'); 
				header('Content-Disposition: attachment; filename=' . $filename);
				header('Content-Length: ' . filesize($filename));
				readfile($filename);
				exit();
			}

		}

	}
	
	public function index($id = null) {
		
		if (!empty($this->params['url']['start'])) {
		
			$filename = WWW_ROOT .'exports' . DS . str_replace(array(' ', '_', '.'), '', strtolower(microtime())) .'.zip';
			
			$zip = new ZipArchive();
			$zip->open($filename, ZIPARCHIVE::CREATE);
			
			$s = $this->params['url']['start']['year'] .'-'. $this->params['url']['start']['month'] .'-'. $this->params['url']['start']['day'];
			$e = $this->params['url']['end']['year'] .'-'. $this->params['url']['end']['month'] .'-'. $this->params['url']['end']['day'];
			
			$files = $this->Bulk->find('list', array(
				'conditions' => array(
					'Bulk.created >=' => $s,
					'Bulk.created <=' => $e,
					'Bulk.facility_id' => $id 
				),
				'fields' => array(
					'Bulk.id',
					'Bulk.filename'	
				)
			));
			
			foreach ($files as $key => $value) {
				$bulk_submission_file = WWW_ROOT .'transmission_files'. DS .'batches'. DS . $value;
				$zip->addFile($bulk_submission_file, $value);
				
				if (($zip->numFiles % 200) == 0) {
					$zip->close();
					$zip->open($filename, ZIPARCHIVE::OVERWRITE);
				}
			
			}
			
			$zip->close();
			
			if (file_exists($filename)) {
				$this->layout = 'ajax';
				header('Cache-Control: no-cache, must-revalidate');
				header('Content-Type: application/x-zip'); 
				header('Content-Disposition: attachment; filename=' . $filename);
				header('Content-Length: ' . filesize($filename));
				readfile($filename);
				exit();
			}
		}
		
		$this->set('facility_id', $id);
		
	}
	
	public function dump_reports () {
		$assessments = $this->Assessment->find('all', array(
			'fields' => array('Assessment.id', 'Facility.F_STATE'),
		));
		
		foreach ($assessments as $key => $value) {
			$this->File = new File(PENDING . $value['Assessment']['id'] .'.xml');
			if ($this->File->exists() == false) {
				$this->Report->createTransmissionfile($value['Assessment']['id'], $value['Facility']['F_STATE']);
			}
		}
	}
	
	// populate log database
	function setLogs() {
		$logs = $this->LogOld->find('all');
		foreach ($logs as $key => $value) {
			$value['LogOld']['_id'] = $value['LogOld']['id'];
			$this->Log->create();
			$this->Log->save($value['LogOld'], false);
		} 
		
		exit();
	}
	
	
	function convert($size) {
		$unit=array('b','kb','mb','gb','tb','pb');
		return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
	}
	
	public function __allowed_facilities() {
		return $this->Facility->getNiceList($this->Auth->user('facility_id'));
	}

}