<?php

class BulkSubmissionAssessment extends AppModel {

  public $name = 'BulkSubmissionAssessment';
  public $useTable = 'bulk_submission_assessments';

  public $actsAs = array(
    'Logable' => array( 
    'change' => 'full', 
    'description_ids' => TRUE 
    )
  ); 

  public $belongsTo = array(
    'Assessment' => array(
      'className' => 'Assessment',
      'foreignKey' => 'assessment_id',
    ),
    'Resident' => array(
      'className' => 'Resident',
    ),
    'Bulk' => array(
      'className' => 'Bulk',
    ),
    'Facility' => array(
      'className' => 'Facility',
      'foreignKey' => false,
      'conditions' => 'Bulk.facility_id = Facility.id'
    )
  );

  public $hasOne = array(
    'RugCache' => array(
      'className' => 'RugCache',
      'foreignKey' => false,
      'conditions' => 'Bulk.assessment_id = RugCache.assessment_id'
    )
  );


}
