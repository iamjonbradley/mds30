<?php
App::import('Core', 'Sanitize');
class PayersController extends ApiAppController {

  public $uses = array('Resident');
  
  public function beforeFilter () { parent::beforeFilter(); }

  public function fetch ($facility_id) {

    $residents = $this->Resident->find('all', array(
      'conditions' => array(
        'Resident.facility_id' => Sanitize::clean($facility_id),
        'Resident.READM' => ''
      ),
      'fields' => array(
        'Resident.ATYPEOPAY', 'Resident.ATYPEOPAY2', 'Resident.apartment'
      ),
      'recursive' => -1
    ));

    $census = array();

    foreach ($residents as $key => $resident) {
      $payer_1 = self::format($resident['Resident']['ATYPEOPAY']);
      $payer_2 = self::format($resident['Resident']['ATYPEOPAY2']);

      if (empty($payer_1) || $payer_1 == '' || $payer_1 == null) $payer_1 = 'Misc';
      if (empty($payer_2) || $payer_2 == '' || $payer_2 == null) $payer_2 = 'Misc';

      $census[$payer_1][] = 1;
      $census[$payer_2][] = 1;
      if ($resident['Resident']['apartment'] == 1)
        $census['Apartment'][] = 1;
    }

    foreach ($census as $key => $value) {
      $data[$key] = count($value);
    }


    header('Content-Type: application/json; charset: utf-8');
    echo json_encode($data);

    die;

  }

  protected function format($value) {
    return ucwords(strtolower($value));
  }

}