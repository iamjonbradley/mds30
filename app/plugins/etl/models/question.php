<?php

class Question extends EtlAppModel {

  public $useDbConfig = 'mdi';
  public $useTable = 'Question';
  public $primaryKey = 'QuestionIDY';
  public $actAs = array('Containable');

  public $belongsTo = array(
    'AssessmentAnswer' => array(
      'foreignKey' => 'QuestionFK',
    )
  );

}