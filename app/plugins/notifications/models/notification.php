<?php

class Notification extends NotificationsAppModel {

  public $belongsTo = array(
    'Resident', 'Facility', 'User',
    'CompletedBy' => array(
      'className' => 'User',
      'foreignKey' => 'completed_by'
    )
  );

  public function saveNotification ($facility_id, $resident_id, $user_id, $assessment_id, $message) {
    $this->create();
    $saved['NOtification']['facility_id'] = $facility_id;
    $saved['NOtification']['resident_id'] = $resident_id;
    $saved['NOtification']['assessment_id'] = $assessment_id;
    $saved['NOtification']['user_id'] = $user_id;
    $saved['NOtification']['message'] = $message;
    $this->save($saved['NOtification']);
  }

}