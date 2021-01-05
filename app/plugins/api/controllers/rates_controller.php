<?php
App::import('Core', 'Sanitize');
class RatesController extends ApiAppController {

  public $uses = array('Rug', 'RugRate');
  
  public function beforeFilter () { parent::beforeFilter(); }

  public function fetch ($facility_id, $rug_score = null) {

    $conditions['RugRate.facility_id'] = Sanitize::clean($facility_id);

    if (!empty($rug_score))
      $conditions['Rug.name'] = Sanitize::clean($rug_score);

    $rates = $this->RugRate->find('all', array(
      'conditions' => $conditions,
      'fields' => array('Rug.name', 'RugRate.rate')
    ));

    debug ($conditions);
    debug ($rates);
     die;

    foreach ($rates as $key => $value) {

      $price = $value['RugRate']['rate'];
      $score = $value['Rug']['name'];

      $rate[$key]['score'] = $score;
      $rate[$key]['price'] = $price;

    }

    header('Content-Type: application/json; charset: utf-8');
    echo json_encode($rate);

    die;

  }

}