<?php

class RugRate extends AppModel {

  public $belongsTo = array('Facility', 'Rug');

  public function getRate ($facility_id, $rug_id) {
    return $this->find('first', array(
      'conditions' => array(
        'RugRate.facility_id' => $facility_id,
        'Rug.name' => $rug_id
      ),
      'fields' => array(
        'RugRate.rate'
      )
    ));
  }

}