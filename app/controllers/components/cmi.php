<?php

class CmiComponent extends Object {
	
	public $calculation = array(
		'adl' => 0, 
		'extensive' => 0, 
		'special' => 0, 
		'clinical' => 0, 
		'depressed' => 0,
		'impaired' => 0,
		'points' => 0, 
		'therapy' => array(
			'minutes' => 0, 
			'types' => 0,
			'type' => array(
				'speech' => 0,
				'occupational' => 0,
				'physical' => 0,
			),
			'days' => 0, 
			'activities' => 0
		),
		'rug' => array(
			'low'			=> '', 'medium'		=> '', 'high'			=> '',
			'very high'		=> '', 'ultra high'	=> '', 'extensive'		=> '',
			'special'		=> '', 'clinically'	=> '', 'impaired'		=> '',
			'behavior'		=> '', 'physical'	=> '',
		),
		'cmi' => array(
			'low'			=> 0, 'medium'		=> 0, 'high'			=> 0,
			'very high'		=> 0, 'ultra high'	=> 0, 'extensive'		=> 0,
			'special'		=> 0, 'clinically'	=> 0, 'impaired'		=> 0,
			'behavior'		=> 0, 'physical'	=> 0,
		)
	);

	public function calc ($data) {

		self::__step_1 ($data);
		self::__step_2 ($data);
		self::__step_3 ($data);
		self::__step_4 ($data);
		self::__step_5 ($data);
		self::__step_6 ($data);
		self::__step_7 ($data);
		self::__step_8 ($data);
		self::__step_9 ($data);
		self::__step_10 ($data);

		self::__step_3 ($data);

		return $this->calculation;

	}

	private function __step_1 ($data) {

		$adl_bed_mobility	= self::__calc_adl ($data['SectionG']['G0110A1'], $data['SectionG']['G0110A2']);
		$adl_transfer		= self::__calc_adl ($data['SectionG']['G0110B1'], $data['SectionG']['G0110B2']);
		$adl_adl_toilet_use	= self::__calc_adl ($data['SectionG']['G0110I1'], $data['SectionG']['G0110I2']);

		$K0500A = $data['SectionK']['K0500A'];
		$K0500B = $data['SectionK']['K0500B'];
		
		$adl_eating = 0;
		if (($K0500A != 0 && $K0500A != '') || ($K0500B != 0 && $K0500B != ''))
			$adl_eating = 3;

		if ($adl_eating == 0) {
			$adl_eating = self::__calc_adl_G0110H1($data['SectionG']['G0110H2']);
		}

		$this->calculation['adl'] = ($adl_bed_mobility + $adl_transfer + $adl_adl_toilet_use + $adl_eating);

		return null;

	}

	private function __step_2 ($data) {

		self::__calc_minutes ($data);

		if ($this->calculation['therapy']['minutes'] > 45) {
			self::__calc_days ($data);
		}

		self::__calc_activites ($data);

		// 1. Low Intensity Rehabilitation Criteria
		if (
			$this->calculation['therapy']['minutes'] >= 45 &&
			$this->calculation['therapy']['days'] >= 3 &&
			$this->calculation['therapy']['activities'] >= 2
		) {

			if ($this->calculation['adl'] >= 4 && $this->calculation['adl'] <= 13) {
				$this->calculation['rug']['low'] = 'RLA';
				$this->calculation['cmi']['low'] = '0.82';
			}

			if ($this->calculation['adl'] >= 14 && $this->calculation['adl'] <= 18) {
				$this->calculation['rug']['low'] = 'RLB';
				$this->calculation['cmi']['low'] = '1.15';
			}

		}

		// 2. Medium Intensity Rehabilitation Criteria
		if (
			$this->calculation['therapy']['minutes'] >= 150 &&
			$this->calculation['therapy']['days'] >= 5
		) {

			if ($this->calculation['adl'] >= 4 && $this->calculation['adl'] <= 7) {
				$this->calculation['rug']['medium'] = 'RMA';
				$this->calculation['cmi']['medium'] = '1.00';
			}

			if ($this->calculation['adl'] >= 9 && $this->calculation['adl'] <= 14) {
				$this->calculation['rug']['medium'] = 'RMB';
				$this->calculation['cmi']['medium'] = '1.13';
			}

			if ($this->calculation['adl'] >= 15 && $this->calculation['adl'] <= 18) {
				$this->calculation['rug']['medium'] = 'RMC';
				$this->calculation['cmi']['medium'] = '1.39';
			}

		}

		// 3. High Intensity Rehabilitation Criteria
		if (
			$this->calculation['therapy']['minutes'] >= 325 &&
			$this->calculation['therapy']['days'] >= 5
		) {

			if ($this->calculation['adl'] >= 4 && $this->calculation['adl'] <= 7) {
				$this->calculation['rug']['high'] = 'RHA';
				$this->calculation['cmi']['high'] = '0.90';
			}

			if ($this->calculation['adl'] >= 8 && $this->calculation['adl'] <= 12) {
				$this->calculation['rug']['high'] = 'RHB';
				$this->calculation['cmi']['high'] = '1.09';
			}

			if ($this->calculation['adl'] >= 13 && $this->calculation['adl'] <= 18) {
				$this->calculation['rug']['high'] = 'RHC';
				$this->calculation['cmi']['high'] = '1.22';
			}

		}

		// 4. Very High Intensity Rehabilitation Criteria
		if (
			$this->calculation['therapy']['minutes'] >= 500 &&
			$this->calculation['therapy']['days'] >= 5
		) {

			if ($this->calculation['adl'] >= 4 && $this->calculation['adl'] <= 8) {
				$this->calculation['rug']['very high'] = 'RVA';
				$this->calculation['cmi']['very high'] = '0.84';
			}

			if ($this->calculation['adl'] >= 9 && $this->calculation['adl'] <= 15) {
				$this->calculation['rug']['very high'] = 'RVB';
				$this->calculation['cmi']['very high'] = '1.07';
			}

			if ($this->calculation['adl'] >= 6 && $this->calculation['adl'] <= 18) {
				$this->calculation['rug']['very high'] = 'RVC';
				$this->calculation['cmi']['very high'] = '1.16';
			}

		}

		// 5. Ultra High Intensity Rehabilitation Criteria
		if (
			$this->calculation['therapy']['minutes']	>= 720	&&
			$this->calculation['therapy']['types']		>= 2	&& 
			(
				($this->calculation['therapy']['type']['speech'] 		>= 5 && ($this->calculation['therapy']['type']['occupational']	>= 3 || $this->calculation['therapy']['type']['physical']		>= 3)) || 
				($this->calculation['therapy']['type']['occupational'] 	>= 5 && ($this->calculation['therapy']['type']['speech']		>= 3 || $this->calculation['therapy']['type']['physical']		>= 3)) || 
				($this->calculation['therapy']['type']['physical'] 		>= 5 && ($this->calculation['therapy']['type']['speech']		>= 3 || $this->calculation['therapy']['type']['occupational']	>= 3))
			)
		) {

			if ($this->calculation['adl'] >= 4 && $this->calculation['adl'] <= 8) {
				$this->calculation['rug']['ultra high'] = 'RUA';
				$this->calculation['cmi']['ultra high'] = '0.80';
			}

			if ($this->calculation['adl'] >= 9 && $this->calculation['adl'] <= 15) {
				$this->calculation['rug']['ultra high'] = 'RUB';
				$this->calculation['cmi']['ultra high'] = '0.99';
			}

			if ($this->calculation['adl'] >= 6 && $this->calculation['adl'] <= 18) {
				$this->calculation['rug']['ultra high'] = 'RUC';
				$this->calculation['cmi']['ultra high'] = '1.34';
			}

		}

		return null;

	}

	private function __step_3 ($data) {

		if (!empty($data['SectionK']['K0500A'])  && $data['SectionK']['K0500A']  != 0) $this->calculation['extensive'] += 1;
		if (!empty($data['SectionO']['O0100D1']) && $data['SectionO']['O0100D1'] != 0) $this->calculation['extensive'] += 1;
		if (!empty($data['SectionO']['O0100D2']) && $data['SectionO']['O0100D2'] != 0) $this->calculation['extensive'] += 1;
		if (!empty($data['SectionO']['O0100E1']) && $data['SectionO']['O0100E1'] != 0) $this->calculation['extensive'] += 1;
		if (!empty($data['SectionO']['O0100E2']) && $data['SectionO']['O0100E2'] != 0) $this->calculation['extensive'] += 1;
		if (!empty($data['SectionO']['O0100F1']) && $data['SectionO']['O0100F1'] != 0) $this->calculation['extensive'] += 1;
		if (!empty($data['SectionO']['O0100F2']) && $data['SectionO']['O0100F2'] != 0) $this->calculation['extensive'] += 1;
		if (!empty($data['SectionO']['O0100H1']) && $data['SectionO']['O0100H1'] != 0) $this->calculation['extensive'] += 1;
		if (!empty($data['SectionO']['O0100H2']) && $data['SectionO']['O0100H2'] != 0) $this->calculation['extensive'] += 1;

		$points = 0;

		if ($data['SectionK']['K0500A'] == 1) $points += 1;
		if ($data['SectionO']['O0100H1'] == 1 || $data['SectionO']['O0100H2'] == 1) $points += 1;
		if ($this->calculation['special'] == 1) $points += 1;
		if ($this->calculation['clinical'] == 1) $points += 1;
		if ($this->calculation['impaired'] == 1) $points += 1;
		
		$this->calculation['points'] = $points;

		if ($this->calculation['extensive'] == 0)
			return null;

		if ($this->calculation['adl'] < 7)
			return null;

		if ($this->calculation['points'] >= 0 && $this->calculation['points'] <= 1) {
			$this->calculation['rug']['extensive'] = 'SE1';
			$this->calculation['cmi']['extensive'] = '1.20';
		}

		if ($this->calculation['points'] >= 2 && $this->calculation['points'] <= 3) {
			$this->calculation['rug']['extensive'] = 'SE2';
			$this->calculation['cmi']['extensive'] = '1.43';
		}

		if ($this->calculation['points'] >= 4 && $this->calculation['points'] <= 5) {
			$this->calculation['rug']['extensive'] = 'SE3';
			$this->calculation['cmi']['extensive'] = '1.75';
		}
		
	}

	private function __step_4 ($data) {
		
		$qualify_1 = 0;
		if ($this->calculation['adl'] < 7) $qualify_1 += 1;
		if ($this->calculation['adl'] > 10 && $data['SectionI']['I4400']) $qualify_1 += 1;
		if ($this->calculation['adl'] > 10 && $data['SectionI']['I5100']) $qualify_1 += 1;
		if ($this->calculation['adl'] > 10 && $data['SectionI']['I5200']) $qualify_1 += 1;

		// count ulcer sites
		$ulcer_sites = 0;
		if ($data['SectionM']['M0300A'] != 0)	$ulcer_sites += 1;
		if ($data['SectionM']['M0300B1'] != 0)	$ulcer_sites += 1;
		if ($data['SectionM']['M0300C1'] != 0)	$ulcer_sites += 1;
		if ($data['SectionM']['M0300D1'] != 0)	$ulcer_sites += 1;
		if ($data['SectionM']['M0300F1'] != 0)	$ulcer_sites += 1;
		if ($data['SectionM']['M1030'] != 0)	$ulcer_sites += 1;

		// count ulcer treatments
		$ulcer_treatments = 0;
		if ($data['SectionM']['M1200A'] != 0)	$ulcer_treatments += 1;
		if ($data['SectionM']['M1200B'] != 0)	$ulcer_treatments += 1;
		if ($data['SectionM']['M1200C'] != 0)	$ulcer_treatments += 1;
		if ($data['SectionM']['M1200D'] != 0)	$ulcer_treatments += 1;
		if ($data['SectionM']['M1200E'] != 0)	$ulcer_treatments += 1;
		if ($data['SectionM']['M1200G'] != 0)	$ulcer_treatments += 1;
		if ($data['SectionM']['M1200H'] != 0)	$ulcer_treatments += 1;

		if ($ulcer_sites > 2 && $ulcer_treatments > 2) $qualify_1 += 1;

		$fever = 0;
		if (!isset($data['SectionJ']['J1500A'])) $data['SectionJ']['J1500A'] = 0;

		if ($data['SectionJ']['J1500A'] != 0 && $data['SectionI']['I2000'] != 0)	$fever += 1;
		if ($data['SectionJ']['J1500A'] != 0 && $data['SectionJ']['J1550B'] != 0)	$fever += 1;
		if ($data['SectionJ']['J1500A'] != 0 && $data['SectionJ']['J1550C'] != 0)	$fever += 1;
		if ($data['SectionJ']['J1500A'] != 0 && $data['SectionK']['K0300'] != 0)	$fever += 1;
		if ($data['SectionJ']['J1500A'] != 0 && $data['SectionK']['K0500B'] != 0)	$fever += 1;

		$feeding = 0;
		if ($data['SectionK']['K0500B'] != 0 && $data['SectionI']['I4300'] != 0)	$feeding += 1;

		$lesions = 0;
		if ($data['SectionM']['M1040D'] != 0)	$lesions += 1;

		$surgical_wounds = 0;
		if ($data['SectionM']['M1040E'] != 0 && $data['SectionM']['M1200F'])	$surgical_wounds += 1;
		if ($data['SectionM']['M1040E'] != 0 && $data['SectionM']['M1200G'])	$surgical_wounds += 1;
		if ($data['SectionM']['M1040E'] != 0 && $data['SectionM']['M1200H'])	$surgical_wounds += 1;

		$qualify_2 = 0;
		if ($fever != 0 || $feeding != 0 || $lesions != 0 || $surgical_wounds != 0)
			$qualify_2 = 1;

		if ($qualify_1 == 0 && $qualify_2 == 0)
			return null;

		if ($qualify_1 == 0 && $qualify_2 == 0 && $this->calculation['extensive'] == 1) {
			$this->calculation['special'] = 1;
			return null;
		}

		if ($this->calculation['adl'] < 7) 
			return null;

		if ($this->calculation['adl'] >= 7 && $this->calculation['adl'] <= 14) {
			$this->calculation['rug']['special'] = 'SSA';
			$this->calculation['cmi']['special'] = '1.04';
		}

		if ($this->calculation['adl'] >= 15 && $this->calculation['adl'] <= 16) {
			$this->calculation['rug']['special'] = 'SSB';
			$this->calculation['cmi']['special'] = '1.008';
		}

		if ($this->calculation['adl'] >= 17 && $this->calculation['adl'] <= 18) {
			$this->calculation['rug']['special'] = 'SSC';
			$this->calculation['cmi']['special'] = '1.16';
		}

	}

	private function __step_5 ($data) {

		$condition_1 = 0;
		if ($this->calculation['special'] == 1 && $this->calculation['adl'] < 7)	$condition_1 += 1;
		if ($data['SectionI']['I2000'] != 0)										$condition_1 += 1;
		if ($data['SectionI']['I2100'] != 0)										$condition_1 += 1;
		if ($data['SectionI']['I4900'] != 0 && $this->calculation['adl'] < 7)		$condition_1 += 1;
		if ($data['SectionJ']['J1550C'] != 0)										$condition_1 += 1;
		if ($data['SectionJ']['J1550D'] != 0)										$condition_1 += 1;
		if ($data['SectionK']['K0500B'] != 0)										$condition_1 += 1;
		if ($data['SectionM']['M1040F'] != 0)										$condition_1 += 1;
		if ($data['SectionO']['O0100A1'] != 0 && $data['SectionO']['O0100A2'] != 0)	$condition_1 += 1;
		if ($data['SectionO']['O0100C1'] != 0 && $data['SectionO']['O0100C2'] != 0)	$condition_1 += 1;
		if ($data['SectionO']['O0100I1'] != 0 && $data['SectionO']['O0100I2'] != 0)	$condition_1 += 1;
		if ($data['SectionO']['O0100J1'] != 0 && $data['SectionO']['O0100J2'] != 0)	$condition_1 += 1;

		$condition_2 = 0;

		$coma = 0;
		if ($data['SectionB']['B0100'] != 0 && ($data['SectionG']['O0100A1'] == 4 || $data['SectionG']['O0100A2'] == 8))	$coma += 1;
		if ($data['SectionB']['B0100'] != 0 && ($data['SectionG']['O0100B1'] == 4 || $data['SectionG']['O0100B2'] == 8))	$coma += 1;
		if ($data['SectionB']['B0100'] != 0 && ($data['SectionG']['O0100I1'] == 4 || $data['SectionG']['O0100I2'] == 8))	$coma += 1;
		if ($data['SectionB']['B0100'] != 0 && ($data['SectionG']['O0100J1'] == 4 || $data['SectionG']['O0100J2'] == 8))	$coma += 1;

		$diabetes = 0;
		if ($data['SectionI']['I2900'] != 0 && $data['SectionN']['N0300'] == 7)	$diabetes += 1;
		if ($data['SectionI']['I2900'] != 0 && $data['SectionO']['O0700'] >= 2)	$diabetes += 1;

		$foot_infection = 0;
		if ($data['SectionM']['M1040A'] != 0)	$foot_infection += 1;

		$open_lessions = 0;
		if ($data['SectionM']['M1200I'] != 0 && ($data['SectionM']['M1040B'] != 0 || $data['SectionM']['M1040C'] != 0))	$open_lessions += 1;
		
		$phsyician_exams = 0;
		if ($data['SectionO']['O0600'] != 0)	$phsyician_exams += 1;

		$phsyician_orders = 0;
		if ($data['SectionO']['O0600']  == 1 && $data['SectionO']['O0700']  >= 4)	$phsyician_exams += 1;
		if ($data['SectionO']['O0600']  == 2 && $data['SectionO']['O0700']  >= 2)	$phsyician_exams += 1;

		if ($coma != 1 || $diabetes != 1 || $foot_infection != 1 || $open_lessions != 1 || $phsyician_exams != 1)
			$condition_2 += 1;

		if ($condition_1 == 0 && $condition_2 == 0) 
			return null;

		if ($this->calculation['extensive'] == 1)
			$this->calculation['clinical'] = 1;

	}

	private function __step_6 ($data) {

		if ($this->calculation['clinical'] == 0)
			return null;

		if ($data['SectionD']['D0300'] < 10 || $data['SectionD']['D0600'] < 10)
			$depressed = 0;
		else 
			$depressed = 1;

		if ($this->calculation['adl'] >= 4 && $this->calculation['adl'] <= 11 && $depressed == 0) {
			$this->calculation['rug']['clinically'] = 'CA1';
			$this->calculation['cmi']['clinically'] = '0.77';
		}
		if ($this->calculation['adl'] >= 4 && $this->calculation['adl'] <= 11 && $depressed == 1) {
			$this->calculation['rug']['clinically'] = 'CA2';
			$this->calculation['cmi']['clinically'] = '0.85';
		}

		if ($this->calculation['adl'] >= 12 && $this->calculation['adl'] <= 16 && $depressed == 0) {
			$this->calculation['rug']['clinically'] = 'CB1';
			$this->calculation['cmi']['clinically'] = '0.86';
		}
		if ($this->calculation['adl'] >= 12 && $this->calculation['adl'] <= 16 && $depressed == 1) {
			$this->calculation['rug']['clinically'] = 'CB2';
			$this->calculation['cmi']['clinically'] = '0.94';
		}

		if ($this->calculation['adl'] >= 17 && $this->calculation['adl'] <= 18 && $depressed == 0) {
			$this->calculation['rug']['clinically'] = 'CC1';
			$this->calculation['cmi']['clinically'] = '1.01';
		}
		if ($this->calculation['adl'] >= 17 && $this->calculation['adl'] <= 18 && $depressed == 1) {
			$this->calculation['rug']['clinically'] = 'CC2';
			$this->calculation['cmi']['clinically'] = '1.15';
		}
		
		
	}

	private function __step_7 ($data) {

		$impaired = 0;

		$comatose = 0;
		if ($data['SectionB']['B0100'] == 1)										$comatose += 1;
		if ($data['SectionG']['G0110A1'] == 4 || $data['SectionG']['G0110A1'] == 8)	$comatose += 1;
		if ($data['SectionG']['G0110B1'] == 4 || $data['SectionG']['G0110B1'] == 8)	$comatose += 1;
		if ($data['SectionG']['G0110H1'] == 4 || $data['SectionG']['G0110H1'] == 8)	$comatose += 1;
		if ($data['SectionG']['G0110I1'] == 4 || $data['SectionG']['G0110I1'] == 8)	$comatose += 1;

		if ($comatose > 0)						$impaired += 1;
		if ($data['SectionC']['C0500'] <= 9)	$impaired += 1;
		if ($data['SectionC']['C1000'] == 3)	$impaired += 1;

		$simple = 0;
		if ($data['SectionB']['B0700'] > 0)		$simple += 1;
		if ($data['SectionC']['C0700'] == 1)	$simple += 1;
		if ($data['SectionC']['C1000'] > 0)		$simple += 1;

		$severe = 0;
		if ($data['SectionB']['B0700'] >= 2)	$severe += 1;
		if ($data['SectionC']['C1000'] >= 2)	$severe += 1;

		if (
			($data['SectionB']['B0700'] != 0 && $data['SectionC']['C0700'] != 0 && $data['SectionC']['C1000'] != 0) && 
			$simple >= 2 && $severe >= 1
		)
			$impaired += 1;

		if ($impaired == 0)
			return null;

		if ($this->calculation['adl'] > 10)
			return null;

		if ($this->calculation['extensive'] == 1) 
			$this->calculation['impaired'] = 1;		

		if (
			($this->calculation['therapy']['activities'] >= 0 && $this->calculation['therapy']['activities'] <= 1) &&
			($this->calculation['adl'] >= 4 && $this->calculation['adl'] <= 5)
		) {
			$this->calculation['rug']['impaired'] = 'IA1';
			$this->calculation['cmi']['impaired'] = '0.54';
		}
		if (
			($this->calculation['therapy']['activities'] >= 2) &&
			($this->calculation['adl'] >= 4 && $this->calculation['adl'] <= 5)
		) {
			$this->calculation['rug']['impaired'] = 'IA2';
			$this->calculation['cmi']['impaired'] = '0.59';
		}
		
		if (
			($this->calculation['therapy']['activities'] >= 0 && $this->calculation['therapy']['activities'] <= 1) &&
			($this->calculation['adl'] >= 6 && $this->calculation['adl'] <= 10)
		) {
			$this->calculation['rug']['impaired'] = 'IB1';
			$this->calculation['cmi']['impaired'] = '0.69';
		}
		if (
			($this->calculation['therapy']['activities'] >= 2) &&
			($this->calculation['adl'] >= 6 && $this->calculation['adl'] <= 10)
		) {
			$this->calculation['rug']['impaired'] = 'IB2';
			$this->calculation['cmi']['impaired'] = '0.71';
		}

	}

	private function __step_8 ($data) {

		if ($this->calculation['adl'] > 10)
			return null;

		$behavior = 0;
		if (!empty($data['SectionE']['E0100A']) && $data['SectionE']['E0100A'] != 0)	$behavior += 1;
		if (!empty($data['SectionE']['E0100B']) && $data['SectionE']['E0100B'] != 0)	$behavior += 1;
		if ($data['SectionE']['E0200A'] == 2 || $data['SectionE']['E0200A'] == 2)		$behavior += 1;
		if ($data['SectionE']['E0200B'] == 2 || $data['SectionE']['E0200B'] == 2)		$behavior += 1;
		if ($data['SectionE']['E0200C'] == 2 || $data['SectionE']['E0200C'] == 2)		$behavior += 1;
		if ($data['SectionE']['E0800'] == 2 || $data['SectionE']['E0800'] == 2)			$behavior += 1;
		if ($data['SectionE']['E0900'] == 2 || $data['SectionE']['E0900'] == 2)			$behavior += 1;

		if ($behavior == 0)
			return null;

		if (
			($this->calculation['therapy']['activities'] >= 0 && $this->calculation['therapy']['activities'] <= 1) &&
			($this->calculation['adl'] >= 4 && $this->calculation['adl'] <= 5)
		) {
			$this->calculation['rug']['behavior'] = 'BA1';
			$this->calculation['cmi']['behavior'] = '0.49';
		}
		if (
			($this->calculation['therapy']['activities'] >= 2) &&
			($this->calculation['adl'] >= 4 && $this->calculation['adl'] <= 5)
		) {
			$this->calculation['rug']['behavior'] = 'BA2';
			$this->calculation['cmi']['behavior'] = '0.57';
		}
		
		if (
			($this->calculation['therapy']['activities'] >= 0 && $this->calculation['therapy']['activities'] <= 1) &&
			($this->calculation['adl'] >= 6 && $this->calculation['adl'] <= 10)
		) {
			$this->calculation['rug']['behavior'] = 'BB1';
			$this->calculation['cmi']['behavior'] = '0.67';
		}
		if (
			($this->calculation['therapy']['activities'] >= 2) &&
			($this->calculation['adl'] >= 6 && $this->calculation['adl'] <= 10)
		) {
			$this->calculation['rug']['behavior'] = 'BB2';
			$this->calculation['cmi']['behavior'] = '0.70';
		}
 		
	}

	private function __step_9 ($data) {
		if (
			($this->calculation['therapy']['activities'] >= 0 && $this->calculation['therapy']['activities'] <= 1) &&
			($this->calculation['adl'] >= 4 && $this->calculation['adl'] <= 5)
		) {
			$this->calculation['rug']['physical'] = 'PA1';
			$this->calculation['cmi']['physical'] = '0.48';
		}
		if (
			($this->calculation['therapy']['activities'] >= 2) &&
			($this->calculation['adl'] >= 4 && $this->calculation['adl'] <= 5)
		) {
			$this->calculation['rug']['physical'] = 'PA2';
			$this->calculation['cmi']['physical'] = '0.50';
		}
		
		if (
			($this->calculation['therapy']['activities'] >= 0 && $this->calculation['therapy']['activities'] <= 1) &&
			($this->calculation['adl'] >= 6 && $this->calculation['adl'] <= 8)
		) {
			$this->calculation['rug']['physical'] = 'PB1';
			$this->calculation['cmi']['physical'] = '0.52';
		}
		if (
			($this->calculation['therapy']['activities'] >= 2) &&
			($this->calculation['adl'] >= 6 && $this->calculation['adl'] <= 8)
		) {
			$this->calculation['rug']['physical'] = 'PB2';
			$this->calculation['cmi']['physical'] = '0.53';
		}
		
		if (
			($this->calculation['therapy']['activities'] >= 0 && $this->calculation['therapy']['activities'] <= 1) &&
			($this->calculation['adl'] >= 9 && $this->calculation['adl'] <= 10)
		) {
			$this->calculation['rug']['physical'] = 'PC1';
			$this->calculation['cmi']['physical'] = '0.66';
		}
		if (
			($this->calculation['therapy']['activities'] >= 2) &&
			($this->calculation['adl'] >= 9 && $this->calculation['adl'] <= 10)
		) {
			$this->calculation['rug']['physical'] = 'PC2';
			$this->calculation['cmi']['physical'] = '0.68';
		}
		
		if (
			($this->calculation['therapy']['activities'] >= 0 && $this->calculation['therapy']['activities'] <= 1) &&
			($this->calculation['adl'] >= 11 && $this->calculation['adl'] <= 15)
		) {
			$this->calculation['rug']['physical'] = 'PD1';
			$this->calculation['cmi']['physical'] = '0.69';
		}
		if (
			($this->calculation['therapy']['activities'] >= 2) &&
			($this->calculation['adl'] >= 11 && $this->calculation['adl'] <= 15)
		) {
			$this->calculation['rug']['physical'] = 'PD2';
			$this->calculation['cmi']['physical'] = '0.73';
		}
		
		if (
			($this->calculation['therapy']['activities'] >= 0 && $this->calculation['therapy']['activities'] <= 1) &&
			($this->calculation['adl'] >= 16 && $this->calculation['adl'] <= 18)
		) {
			$this->calculation['rug']['physical'] = 'PE1';
			$this->calculation['cmi']['physical'] = '0.79';
		}
		if (
			($this->calculation['therapy']['activities'] >= 2) &&
			($this->calculation['adl'] >= 16 && $this->calculation['adl'] <= 18)
		) {
			$this->calculation['rug']['physical'] = 'PE2';
			$this->calculation['cmi']['physical'] = '0.81';
		}
	}

	private function __step_10 ($data) {

		asort($this->calculation['cmi']);

		foreach ($this->calculation['cmi'] as $key => $value) {
			$last = $key;
		}

		$this->calculation['final']['rug'] = $this->calculation['rug'][$last];
		$this->calculation['final']['cmi'] = $this->calculation['cmi'][$last];
		
	}

	private function __calc_minutes ($data) {
		
		$minutes  = $data['SectionO']['O0400A1'] + $data['SectionO']['O0400A2'] + $data['SectionO']['O0400A3'];
		$minutes += $data['SectionO']['O0400B1'] + $data['SectionO']['O0400B2'] + $data['SectionO']['O0400B3'];
		$minutes += $data['SectionO']['O0400C1'] + $data['SectionO']['O0400C2'] + $data['SectionO']['O0400C3'];

		$this->calculation['therapy']['minutes'] = $minutes;

		return null;

	}

	private function __calc_days ($data) {

		if (!empty($data['SectionO']['O0400A4'])) $this->calculation['therapy']['types']  = 1;
		if (!empty($data['SectionO']['O0400B4'])) $this->calculation['therapy']['types'] += 1;
		if (!empty($data['SectionO']['O0400C4'])) $this->calculation['therapy']['types'] += 1;


		$this->calculation['therapy']['type']['speech']			= $data['SectionO']['O0400A4'];
		$this->calculation['therapy']['type']['occupational']	= $data['SectionO']['O0400B4'];
		$this->calculation['therapy']['type']['physical']		= $data['SectionO']['O0400C4'];

		$this->calculation['therapy']['days'] = array_sum($this->calculation['therapy']['type']);

		return null;
		
	}

	private function __calc_activites ($data) {

		$activities = 0;

		if ($data['SectionH']['H0200C'] == 1 || $data['SectionH']['H0500'] == 1)	$activities += 1;
		if ($data['SectionO']['O0500C'] >= 6)										$activities += 1;
		if ($data['SectionO']['O0500E'] >= 6)										$activities += 1;
		if ($data['SectionO']['O0500G'] >= 6)										$activities += 1;
		if ($data['SectionO']['O0500H'] >= 6)										$activities += 1;
		if ($data['SectionO']['O0500I'] >= 6)										$activities += 1;
		if ($data['SectionO']['O0500J'] >= 6)										$activities += 1;
		if ($data['SectionO']['O0500A'] >= 6 || $data['SectionO']['O0500B'] >= 6)	$activities += 1;
		if ($data['SectionO']['O0500D'] >= 6 || $data['SectionO']['O0500F'] >= 6)	$activities += 1;

		$this->calculation['therapy']['activities'] = $activities;

		return null;
		
	}

	private function __calc_adl ($value1, $value2) {

		if (in_array($value1, array('-','0',1,7)) && !empty($value2)) return 1;
		if ($value1 == 2 && !empty($value2)) return 3;
		if (in_array($value1, array(3,4)) && in_array($value2, array('-', ' 0', 1,7))) return 4;
		if (in_array($value1, array(3,4,8)) && in_array($value2, array(3,8))) return 5;

		return null;
		
	}

	private function __calc_adl_G0110H1 ($G0110H1) {

		if (in_array($G0110H1, array('-','0',1,7))) return 1;
		if ($G0110H1 == 2) return 2;
		if (in_array($G0110H1, array(3,4,8))) return 2;

		return null;
		
	}

}