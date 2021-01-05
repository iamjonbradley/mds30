<?php

App::import('Core', array('File', 'Folder'));
class SyncController extends AppController {

	public $uses = array('Sync', 'Facility');
	public $helpers = array('Time');

	public function index () {

		$facilities = $this->Facility->getNiceList();

		$data = array();

		foreach ($facilities as $key => $value) {

			$sync = $this->Sync->find('first', array(
				'conditions' => array('Sync.facility_id' => $key),
				'fields' => array('Sync.created'),
				'order' => array('Sync.created' => 'DESC'),
				'limit' => 1
			));

			$fac = $this->Facility->find('first', array(
				'conditions' => array('Facility.id' => $key),
				'fields' => array('Facility.code', 'Facility.mr_software', 'Facility.mr_software', 'Facility.rec_type'),
				'recursive' => -1,
				'limit' => 1
			));

			$path = '/tmp/medical_records/%d/%s';

			switch ($fac['Facility']['mr_software']) {
				case 'fieldbase':
					$filename = sprintf($path, $key, 'ARRESD01.DBF');
					$fac['Facility']['mr_software'] = 'IT';
					break;
				case 'ncs':
					$filename = sprintf($path, $key, 'ResListForMds.txt');
					$fac['Facility']['mr_software'] = 'NCS';
					break;
			}

			$this->File = new File($filename);

			if ($fac['Facility']['rec_type'] == 0 && $this->File->exists()) {
				$data[$key]['id']			= $key;
				$data[$key]['code']			= $fac['Facility']['code'];
				$data[$key]['rec_type']		= $fac['Facility']['mr_software'];
				$data[$key]['name'] 		= str_replace('- ', '', $value);
				$data[$key]['last_rsync']	= $this->File->lastChange();
				$data[$key]['last_sync']	= $sync['Sync']['created'];
			}

			$this->File->close();
		}

		$this->set(compact('data'));

	}
}