<?php

class AssessmentAnswer extends EtlAppModel {

  public $useDbConfig = 'mdi';
  public $useTable = 'AssessmentAnswer';
  public $primaryKey = 'AssessmentAnswerIDY';
  public $actAs = array('Containable');

  public $belongsTo = array(
    'AssessmentControl' => array(
      'className' => 'Etl.AssessmentControl',
      'foreignKey' => 'AssessmentControlFK'
    ),
    'Question' => array(
      'className' => 'Etl.Question',
      'foreignKey' => 'QuestionFK',
    )
  );

}