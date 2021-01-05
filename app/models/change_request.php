<?php
class ChangeRequest extends AppModel {
  
  public $actsAs = array(
    'Logable' => array( 
      'change' => 'full', 
      'description_ids' => true 
    ),
  ); 

  public $belongsTo = array(
    'User' => array(
        'className' => 'User',
        'foreignKey' => 'user_id'
    ),
    'ApprovedBy' => array(
        'className' => 'User',
        'foreignKey' => 'approved_by'
    ),
    'Assessment'
  );

  public $hasOne = array(
    'Facility' => array(
        'className' => 'Facility',
        'foreignKey' => false,
        'conditions' => 'Assessment.facility_id = Facility.id'
    ),
  );
	
  public $validate = array(
    'current_lock_date' => array(
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'message' => 'Sorry you must have a Current Lock Date.'
      )
    ),
    'lock_date' => array(
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'message' => 'Sorry you must a New Lock Date.'
      )
    ),
    'reason' => array(
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'message' => 'Sorry you must provide a reason for the change.'
      )
    ),
  );

}

?>