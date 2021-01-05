<?php

class CasambaImport extends ReportsAppModel {

  public $belongsTo = array(
    'Resident' => array(
      'foreignKey' => false,
      'conditions' => 'Resident.SSNUM = CasambaImport.SSNO',
      'fields' => array('Resident.id', 'Resident.PATNUM', 'Resident.PATLNAME', 'Resident.PATFNAME', 'Resident.SSNUM')
    ),
    'Facility' => array(
      'foreignKey' => 'facility_id',
      'fields' => array('Facility.id', 'Facility.name', 'Facility.F_STATE')
    ),
  );

  public $hasOne = array(
    'TherapyFee' => array(
      'foreignKey' => false,
      'conditions' => 'Facility.F_STATE = TherapyFee.STATE AND CasambaImport.CPTCODE = TherapyFee.CODE',
      'fields' => array('TherapyFee.CDESC', 'TherapyFee.CODE', 'TherapyFee.AMOUNT')
    )
  );

}