<?php

App::import('Core', 'File', false);
class LockedTask extends NotifyShell {

  public $uses = array('Assessment');

  public function execute() {

    $asmts = $this->Assessment->find('all', array(
      'conditions' => array(
        'Assessment.locked' => 1,
        'Assessment.deleted' => 0,
        'Assessment.transmission_status' => array(0,1,3),
        'Assessment.resident !=' => '',
        'Facility.status' => 1
      ),
      'fields' => array(
        'Assessment.id', 'Assessment.facility_id', 'Assessment.lock_date', 'Assessment.resident',
        'Resident.id', 'Resident.PATLNAME', 'Resident.PATFNAME'
      ),
      'order' => array('Assessment.id DESC')
    ));

    foreach ($asmts as $key => $value) {

      if (preg_match('| |', $value['Assessment']['lock_date'])) {
        list ($date,$time) = explode(' ', $value['Assessment']['lock_date']);
        $locked = $date;
      }
      else {
        $locked = $value['Assessment']['lock_date'];
      }

      $final = parent::modifyDateAdd($locked, 14);

      // check if the assessment is late
      if ($final <= date('Y-m-d'))
        $message = sprintf(
          parent::$messages['late'],
          $value['Assessment']['id'],
          $value['Resident']['id'] .' - '. ucwords(strtolower($value['Resident']['PATFNAME'] .' '. $value['Resident']['PATLNAME'])),
          parent::countDays ( day('Y-m-d'), $locked )
        );
      else
        $message = sprintf(
          parent::$messages['not_accepted'],
          $value['Assessment']['id'],
          $value['Resident']['id'] .' - '. ucwords(strtolower($value['Resident']['PATFNAME'] .' '. $value['Resident']['PATLNAME'])),
          $final
        );

      parent::store ($value['Assessment']['facility_id'], $value['Resident']['id'], null, $value['Assessment']['id'], $message);
    
    }

  }

}