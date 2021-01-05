<?php

class AssessmentControl extends AppModel {

  public $useDbConfig = 'mdi';
  public $useTable = 'AssessmentControl';
  public $primaryKey = 'AssessmentControlIDY';
  public $actAs = array('Containable');

  public $belongsTo = array(
    'Admission' => array(
      'className' => 'Etl.Admission',
      'foreignKey' => 'ResidentFK',
    )
  );

  public $hasMany = array(
    'AssessmentAnswer' => array(
      'className' => 'Etl.AssessmentAnswer',
      'foreignKey' => 'AssessmentControlFK',
    )
  );

}