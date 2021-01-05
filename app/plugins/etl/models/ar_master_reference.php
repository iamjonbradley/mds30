<?php

class ArMasterReference extends AppModel {

  public $useDbConfig = 'mdi';
  public $useTable = 'tblArMasterReferences';
  public $actAs = array('Containable');

  public $belongsTo = array(
    'Admission' => array(
      'className' => 'Etl.Admission',
      'foreignKey' => false,
      'conditions' => 'ArMasterReference.ResidentID = Admission.ResidentID'
    )
  );

}