<?php

class ErrorComponent extends Object {

	static $allowed = array(
		'A0200' => array(0, 1),
		'A0310A' => array('01', '02', '03', '04', '05', '06', '99'),
		'A0310B' => array('01', '02', '03', '04', '05', '06', '07', '99'),
		'A0310C' => array('0', '1', '2', '3'),
		'A0310D' => array('0', '1'),
		'A0310E' => array('0', '1'),
		'A0310F' => array('01', '10', '11', '12', '99'),
	);

	static $errors = array(
		'invalid' => 'Sorry Invalid Characters'
	);

	public $error = array();
	
	public function process ($data) {
		$data = self::__SectionA($data);
		$data = self::__SectionB($data);
		return $data;
	}

	private function __SectionA ($data) {

		self::__A0200($value['Section']['A0200']);
		
	}

	private function __SectionB ($data) {
		
		return $data;
	}

	private function __A0200($value) {

		if (!in_array($data['SectionA']['A0200'], $this->allowed['A0200']))
			$this->error[] = 'A0200 - '. $this->errors['invalid'];

			
	}

}