<?php

class ResidentDrug extends AppModel {

  public $belongsTo = array('Resident', 'Facility');
  public $hasOne = array(
    'RugCache' => array(
      'foreignKey' => false,
      'conditions' => array('RugCache.resident_id = ResidentDrug.resident_id'),
      'limit' => 1,
      'order' => array('RugCache.id DESC')
    )
  );

  public function storeUpdate($resident_id, $facility_id, $data) {

    $current = $this->find('first', array(
      'conditions' => array('ResidentDrug.resident_id' => $resident_id, 'ResidentDrug.facility_id' => $facility_id),
      'recursive' => -1
    ));

    // structure new data set
    if (empty($current)) {
      $this->create();
      $current['ResidentDrug']['resident_id'] = $resident_id;
      $current['ResidentDrug']['facility_id'] = $facility_id;
    }

    if (isset($data['SectionN']['N0350A']) && !empty($data['SectionN']['N0350A'])) $current['ResidentDrug']['N0350A'] = $data['SectionN']['N0350A'];
    if (isset($data['SectionN']['N0410A']) && !empty($data['SectionN']['N0410A'])) $current['ResidentDrug']['N0410A'] = $data['SectionN']['N0410A'];
    if (isset($data['SectionN']['N0410B']) && !empty($data['SectionN']['N0410B'])) $current['ResidentDrug']['N0410B'] = $data['SectionN']['N0410B'];
    if (isset($data['SectionN']['N0410C']) && !empty($data['SectionN']['N0410C'])) $current['ResidentDrug']['N0410C'] = $data['SectionN']['N0410C'];
    if (isset($data['SectionN']['N0410D']) && !empty($data['SectionN']['N0410D'])) $current['ResidentDrug']['N0410D'] = $data['SectionN']['N0410D'];
    if (isset($data['SectionN']['N0410E']) && !empty($data['SectionN']['N0410E'])) $current['ResidentDrug']['N0410E'] = $data['SectionN']['N0410E'];
    if (isset($data['SectionN']['N0410F']) && !empty($data['SectionN']['N0410F'])) $current['ResidentDrug']['N0410F'] = $data['SectionN']['N0410F'];
    if (isset($data['SectionN']['N0410G']) && !empty($data['SectionN']['N0410G'])) $current['ResidentDrug']['N0410G'] = $data['SectionN']['N0410G'];

    $this->save($current);

  }

}