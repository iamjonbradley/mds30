<?php

App::import('Core', 'Sanitize');
class RugsController extends AppController {

  public function edit ($facility_id = null) {

    if (isset($this->data)) {
      foreach ($this->data['RugRate'] as $key => $value) {
        ClassRegistry::init('RugRate')->save($value, false);
      }
    }

    if ($facility_id) {
      $this->data = ClassRegistry::init('RugRate')->find('all', array(
        'conditions' => array('RugRate.facility_id' => Sanitize::clean($facility_id)),
        'fields' => array('RugRate.id', 'RugRate.rate', 'Rug.name', 'Facility.name')
      ));
    }
  
  }
  

  public function generate () {
    
    Controller::loadModel('Rug');

    $facilities = $this->Facility->find('list', array(
      'conditions' => array('Facility.rec_type' => 0, 'Facility.status' => 1),
      'fields' => array('Facility.id', 'Facility.name')
    ));

    $rugs = $this->Rug->find('list', array(
      'fields' => array('Rug.id', 'Rug.name')
    ));

    foreach ($facilities as $facility_id => $facility_name) {

      foreach ($rugs as $rug_id => $rug_name) {

        $this->RugRate->create();
        $this->RugRate->save(
          array(
            'rug_id' => $rug_id,
            'facility_id' => $facility_id
          )
        );

      }

    }


    die;
  }

}