<?php

class Admission extends EtlAppModel {

  public $useDbConfig = 'mdi';
  public $useTable = 'tblAdmission';
  public $primaryKey = 'AdmissionPK';
  public $actAs = array('Containable');

  public $hasMany = array(
    'AssessmentControl' => array(
      'className' => 'Etl.AssessmentControl',
      'foreignKey' => 'ResidentFK' 
    )
  );

  public $hasOne = array(
    'ArMasterReference' => array(
      'className' => 'Etl.ArMasterReference',
      'foreignKey' => false,
      'conditions' => 'ArMasterReference.ResidentID = Admission.ResidentID'
    )
  );

  public function afterFind ($result) {

    foreach ($result as $key => $resident) {


      foreach ($resident['AssessmentControl'] as $key2 => $assessment) {
        $this->AssessmentControl->AssessmentAnswer->unbindModel(array(
          'belongsTo' => array('AssessmentControl')
        ));
        $assessments = $this->AssessmentControl->AssessmentAnswer->find('all', array(
          'conditions' => array(
            'AssessmentAnswer.AssessmentControlFK' => $assessment['AssessmentControlIDY']
          ),
          'contain' => array(
            'Question'
          )
        ));
        $result[$key]['AssessmentControl'][$key2]['Answers'] = $assessments;

      }

    }

    return $result;


  }

}