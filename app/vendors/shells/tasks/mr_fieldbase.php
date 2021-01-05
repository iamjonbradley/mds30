<?php

App::import('Core', 'File', false);
class MrFieldbaseTask extends Shell {

  public $uses = array('Resident', 'Facility', 'Sync');

  public $path = array(
    'facility'    => "/tmp/medical_records/%d/LTCSMR.DBF",
    'resident-1'  => "/tmp/medical_records/%d/ARRESD01.DBF", 
    'resident-2'  => "/tmp/medical_records/%d/MRADMT01.DBF", 
    'resident-3'  => "/tmp/medical_records/%d/PATNCP.DBF", 
  );

  public function execute($facility) {

    $total = $this->updateResidents($facility);

    // record the sync
    $this->Sync->create();
    $sync['Sync']['total'] = $total;
    $sync['Sync']['facility_id'] = $facility;
    $this->Sync->save($sync, false);
  }

  public function updateResidents($id) {


    // open the file
    $file = dbase_open(sprintf($this->path['resident-1'], $id), 0);
    $record_numbers = dbase_numrecords($file);

    for ($i = 1; $i <= $record_numbers; $i++) {
      $row = dbase_get_record_with_names($file, $i);

      $key = $row['PATNUM'];

      foreach ( $row as $key2 => $value2 ) {
        $info[$key][trim($key2)] = trim($value2);
      }

      $new_id = $id .'-'. $key;
      $info[$key]['id'] = $new_id;
      $info[$key]['facility_id'] = $id;
    }

    dbase_close ($file);

    // open the file
    $file = dbase_open(sprintf($this->path['resident-2'], $id), 0);
    $record_numbers = dbase_numrecords($file);

    for ($i = 1; $i <= $record_numbers; $i++) {
      $row = dbase_get_record_with_names($file, $i);

      $key = $row['PATNUM'];

      foreach ( $row as $key2 => $value2 ) {
        $info[$key][trim($key2)] = trim($value2);
      }

      $new_id = $id .'-'. $key;
      $info[$key]['id'] = $new_id;
      $info[$key]['facility_id'] = $id;
    }

    dbase_close ($file);

    foreach ($info as $key => $value) {
      if (!strpos('-', $value['PATNUM']) || $value['PATNUM'] != 0 || $value['PATNUM'] != '' || $value['READM'] != 'E') {
        // echo '[value]'; print_r($value); die;
        if($this->Resident->save($value, false)) {
          //$this->out('Saved patient record #'. $value['PATNUM']  .' at '. $name);
        }
        else {
          $this->out('Could not save patient record #'. $value['PATNUM']  .' at '. $name);
        }
      }
    }

    $info = array();
    return $record_numbers;

  }

  public function checkFiles() {

    $data = $this->Facility->find('all', array(
      'conditions' => array('Facility.id !=' => 1,'Facility.id !=' => 35,'Facility.id !=' => 36,'Facility.status' => 1),
      'fields' => array('Facility.id', 'Facility.FNAME'),
      'recursive' => -1
    ));

    foreach ($data as $key => $value) {
      $id = trim($value['Facility']['id']);
      if ($id != 1 && $id != 35 && $id != 36)
        $facilities[$id] = trim($value['Facility']['FNAME']);
    }

    return $facilities;

  }
}