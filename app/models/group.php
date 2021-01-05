<?php

class Group extends AppModel {

	public $name = 'Group';
	public $displayField = 'name';
	public $actsAs = array(
		'Tree' => array(
			'seperator' => '-'
		)
	);

	public $belongsTo = array('Parent' => array('className' => 'Group', 'foreignKey' => 'parent_id'));

	public function getList ($group = null) {

		if ($group == 1)
			$conditions = array();
		else 
			$conditions = array('Group.id >' => $group);

		return $this->find('list', array(
			'conditions' => $conditions,
			'fields' => array('Group.id', 'Group.name'),
			'recursive' => -1
		));
	}
}
