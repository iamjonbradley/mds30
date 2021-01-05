<?php

class SectionZ extends AppModel {
	
	var $name = 'SectionZ';
	var $useTable = 'section_z';
  var $actsAs = array(
  	'Logable' => array( 
	    'change' => 'full', 
	    'description_ids' => TRUE 
	  )
  ); 
	var $belongsTo = array('Assessment');
}