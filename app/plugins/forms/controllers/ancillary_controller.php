<?php

class AncillaryController extends FormsAppController {

  public $uses = array('Resident');
  public $helpers = array('Vertical');

  public function beforeFilter () {
    parent::beforeFilter();
  }

  public function index () {
    
  }

  public function view ($facility = null) {
    $this->layout = 'printing';
    if (!$facility) 
      $this->redirect('index', null, false);

      $allowed_facilities = ClassRegistry::init('Facility')->getNiceList($this->Auth->user('facility_id'));

        $map = ClassRegistry::init('AncillaryMap')->find('list', array(
          'conditions' => array('AncillaryMap.name' => $allowed_facilities[$facility]),
          'fields' => array('AncillaryMap.room', 'AncillaryMap.unit')  
      ));

      foreach ($map as $key => $value) {
        $mapped[strtoupper($key)] = $value;
      }

    $residents = $this->Resident->find('all', array(
        'conditions' => array(
          'Resident.PATNUM IS NOT NULL',
          'Resident.id LIKE' => "%". $facility ."-%",
          'Resident.facility_id' => $facility, 
          'Resident.READM' => array('', 'A')
        ),
        'fields' => array(
          'Resident.ATYPEOPAY',
          'Resident.PATFNAME', 'Resident.PATLNAME', 'Resident.PMI',
          'Resident.ROOM', 'Resident.STATION', 'Resident.BED'
        ),
        'order' => array('Resident.ROOM' => 'ASC', 'Resident.BED' => 'ASC'),
        'recursive' => -1
      ));

    foreach ($residents as $key => $value) {

      if (!empty($value) && !empty($value['Resident']['ROOM'])) {

        $room = preg_replace('/[a-zA-Z]/', '', $value['Resident']['ROOM']);

        if (substr($room, 0, 1) == 0) $room = substr($room, 1, count($room));

        $room = str_replace(' ', '', $room);

        if (!empty($mapped))
          $unit = @$mapped[$room];
        else 
          $unit = $value['Resident']['STATION'];

        if (empty($unit))
          $unit = 'No Unit';

        
        if (preg_match('|AB|', $value['Resident']['ROOM']))
          $unit = 'AB Hall';

        if (preg_match('|C|', $value['Resident']['ROOM']))
          $unit = 'C Hall';
        
        $data[$unit][] = $value['Resident'];
      }

    }

    $this->set(compact('data'));
  }
}