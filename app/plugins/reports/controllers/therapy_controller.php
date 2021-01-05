<?php

class TherapyController extends AppController {

  public $name = 'Therapy';
  public $uses = array();

  public $codes = array(
    '92506', '92507', '92508', '92526', '92597', '96125', '97001', '97002', 
    '97003', '97004', '97012', '97016', '97018', '97022', '97024', '97026',
    '97028', '97032', '97033', '97034', '97035', '97036', '97110', '97112',
    '97113', '97116', '97140', '97150', '97533', '97535', '97537', '97542',
    '97750', '97755', '97760', '97761', '97762', 'G0281', 'G0283', 'G0329',
    '97530'
  );

  public function index () {

    Controller::loadModel('Resident');

    $this->paginate = array(
      'conditions' => array(
        'Resident.PATNUM IS NOT NULL',
        'Resident.id LIKE' => "%". 38 ."-%",
        'Resident.facility_id' => 38, 
        'Resident.apartment' => 0,
        'Resident.READM' => array('', 'A'),
        'Resident.ATYPEOPAY2' => 'MEDICARE B'
      ),
      'fields' => array(
        'Resident.PATNUM', 'Resident.PATLNAME', 'Resident.PATFNAME',
        'Resident.OTCAP_DTE', 'Resident.SPCAP_DTE', 'Resident.HRES_STPT', 'Resident.HRES_OT', 
        'Resident.HOTCAP_DTE', 'Resident.HSPCAP_DTE', 'Resident.RESCAPOT', 'Resident.RESCAPSP'
      ),
      'order' => array('Resident.PATLNAME' => 'ASC', 'Resident.PATFNAME' => 'ASC'),
      'limit' => 500
    );

    $data = $this->paginate('Resident');

    $this->set(compact('data'));

  }


}