<?php

class Bulk extends AppModel {
  
  var $name = 'Bulk';
  
  var $useTable = 'bulk_submissions';
  
  var $actsAs = array(
  	'Logable' => array( 
	    'change' => 'full', 
	    'description_ids' => TRUE 
	  )
  ); 
  
  var $belongsTo = array(
    'Facility' => array(
      'className' => 'Facility',
      'foreignKey' => 'facility_id',
    ), 
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id',
    ), 
  );
  
  var $hasMany = array(
    'BulkSubmissionAssessment' => array(
      'foreignKey' => 'bulk_id',
    )
  );
  
  function getRecent ($facility_id = null) {
    
    $this->unbindModel(array(
      'hasMany' => array('BulkSubmissionAssessment')
    ));
    return $this->find('all', array(
      'conditions' => array('Facility.id' => $this->Facility->getFacilities($facility_id)),
      'fields' => array('Bulk.id', 'Bulk.count', 'Bulk.created', 'Bulk.filename', 'User.name', 'Facility.name'),
      'order' => array('Bulk.created' => 'DESC'),
      'limit' => 15
    ));
  }
  
}
