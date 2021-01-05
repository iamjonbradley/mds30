<?php

class User extends AppModel {
	
	var $name = 'User';
	
	var $displayField = 'name';

	var $actsAs = array(
		'Logable' => array( 
			'change' => 'full', 
			'description_ids' => TRUE 
		)
	); 
	 
	var $belongsTo = array(
		'Facility' => array(
			'className' => 'Facility',
			'foriegnKey' => 'facility_id',
			'fields' => array(
				'Facility.id', 'Facility.name'
			)
		), 
		'Group' => array(
			'className' => 'Group',
			'foriegnKey' => 'group_id',
			'fields' => array(
				'Group.id', 'Group.parent_id', 'Group.name'
			)
		)
	);
	
	function getLogins ($facility_id = null) {
		return $this->find('all', array(
			'conditions' => array('User.last_login !=' => '', 'Facility.id' => $this->Facility->getFacilities($facility_id)),
			'fields' => array('User.id', 'User.name', 'User.email', 'User.last_login', 'Group.name', 'Facility.name'),
			'order' => array('User.last_login' => 'DESC'),
			'limit' => 10
		));
	}
	
	public function getUsers () {
		return $this->find('list', array(
			'conditions' => array('User.facility_id' => 1),
		));
	}

	public function forgot ($email) {
		return $this->find('first', array(
			'conditions' => array('User.email' => $email),
			'fields' => array('User.id', 'User.username', 'User.email', 'User.name')
		));
	}

	public function getUser($id) {
		return $this->find('first', array(
				'conditions' => array(
					'User.id' => $id
				),
				'fields' => array(
					'User.id', 'User.facility_id', 'User.group_id', 'User.name', 'User.username', 'User.email',
					'Facility.id', 'Facility.name', 'Facility.rec_type', 'Facility.F_STATE',
					'Group.id', 'Group.parent_id', 'Group.name'


				)
			));
	}
	
}
