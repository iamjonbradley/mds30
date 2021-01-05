<?php

class ArDetail extends AppModel {

  public $useDbConfig = 'mdi';
  public $useTable = 'tblArX12Detail';

  public $belongsTo = array(
    'Admission' => array(
      'className' => 'Etl.Admission',
      'foreignKey' => false,
      'conditions' => 'ArDetail.ResidentID = Admission.ResidentID'
    )
  );

}