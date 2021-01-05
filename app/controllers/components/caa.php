<?php

class CaaComponent extends Object {
  
  public $name = 'Caa';
  public $description = 'Care Area Assessment Triggers';
  public $components = array('Fields');
  public $letters = array();

  public function report ($data) {
    return $this->__triggers($data);
  }
  
  public function trigger ($id) {
    $this->Assessment = ClassRegistry::init('Assessment');
    $data = $this->Assessment->find('first', array(
        'conditions' => array('Assessment.id' => $id),
        'rcursive' => 1
      ));

    foreach ($data as $key => $value) {

      if ($key != 'Assessment' && $key != 'Facility' && $key != 'Resident' && $key != 'User' && $key != 'SectionV' && $key != 'SectionZ' && $key != 'RugCache') {
        $skips = $this->Assessment->{$key}->skipPatterns($data);

        foreach ($data[$key] as $key2 => $value2) {
          if (in_array($key2, $skips)) $data[$key][$key2] = '';
        }
      }
    }

    $past = $this->Assessment->getPreviousOBRAPPS($id, $data['Assessment']['resident']);

    if (!empty($past) && empty($data['SectionV']['V0100A'])) {
      $data['SectionV']['V0100A'] = $past['SectionA']['A0310A'];
      $data['SectionV']['V0100B'] = $past['SectionA']['A0310B'];
      $data['SectionV']['V0100C'] = $past['SectionA']['A2300'];
      $data['SectionV']['V0100D'] = $past['SectionC']['C0500'];
      $data['SectionV']['V0100E'] = $past['SectionD']['D0300'];
    }
    
    if (isset($data['SectionO']))
      $data['SectionO']['day_diff'] = self::__count_days($data['SectionA']['A2300'], $data['SectionA']['A1600']); 
    
    return $this->__triggers($data);
  }
  
  protected function __triggers($data) {
    
    if (!isset($data['SectionV'])) return $data;
    
    $data = self::__cat01($data); $data = self::__cat02($data); $data = self::__cat03($data); 
    $data = self::__cat04($data); $data = self::__cat05($data); $data = self::__cat06($data); 
    $data = self::__cat07($data); $data = self::__cat08($data); $data = self::__cat09($data); 
    $data = self::__cat10($data); $data = self::__cat11($data); $data = self::__cat12($data); 
    $data = self::__cat13($data); $data = self::__cat14($data); $data = self::__cat15($data); 
    $data = self::__cat16($data); $data = self::__cat17($data); $data = self::__cat18($data);  
    $data = self::__cat19($data); $data = self::__cat20($data);

    $data['SectionG']['A0310A'] = $data['SectionA']['A0310A'];
    
    return $data;
    
  }
  
  protected function __cat01 ($data) {

    if (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] != '') $A0310A = $data['SectionA']['A0310A']; else $A0310A = '';
    if (isset($data['SectionC']['C0500']) && $data['SectionC']['C0500'] != '') $C0500 = $data['SectionC']['C0500']; else $C0500 = '';
    if (isset($data['SectionC']['C1600']) && $data['SectionC']['C1600'] != '') $C1600 = $data['SectionC']['C1600']; else $C1600 = '';
    if (isset($data['SectionV']['V0100D']) && $data['SectionV']['V0100D'] != '') $V0100D = $data['SectionV']['V0100D']; else $V0100D = '';

    // CAT01 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A01A'] = 0;
    // Trigger on Condition 1;
    // Current assessment is limited to a non-admission comprehensive assessment;
    if ($A0310A == '03' || $A0310A == '04' || $A0310A == '05') {
      // Check that C0500 and V0100D both have non-missing values (00 to 15);
      if (($C0500 >= '00' && $C0500 <= '15') && ($V0100D >= '00' && $V0100D <= '15')) {
        // Trigger Care Area if current assessment score < prior;
        //  assessment score;
        if ($C0500 < $V0100D) $data['SectionV']['V0200A01A'] = 1;
      }
    }
    // Trigger on Condition 2;
    if ($C1600 == '1') $data['SectionV']['V0200A01A'] = 1;
    
    return $data;
  }
	
	 public function cat01Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;1&nbsp;Delirum</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		
    // Trigger on Condition 1;
    // Current assessment is limited to a non-admission comprehensive assessment;
    
    if (
      ($data['SectionA']['A0310A'] == '03' || $data['SectionA']['A0310A'] == '04' || $data['SectionA']['A0310A'] == '05') && 
      (($data['SectionC']['C0500'] >= '0') && ($data['SectionC']['C0500'] <= '15')) && 
      (($data['SectionV']['V0100D'] >= '0') && ($data['SectionV']['V0100D'] <= '15')) &&
      ($data['SectionC']['C0500'] < $data['SectionV']['V0100D'])
    ) {
			$reason .= '<li>Worsening mental status is indicated by the BIMS summary score having a non-missing value of 00 to 15 on both the current non-admission comprehensive assessment (A031A = 03, 04, 05) and prior assessment, and the summary score on the current non-admission assesssment being less than prior assessment as indicated by:<br /><br />';
			$reason .= '(A031A = 03, 04, OR 05) AND<br />';
			$reason .= '((C0500 >= 0) AND (C0500 <= 15)) AND<br />';
			$reason .= '((V0100D >= 0) AND (V0100D <= 15)) AND<br />';
			$reason .= '(C0500 < V0100D)<br /><br /></li>';
    }
    
    // Trigger on Conditio[]n 2;
    if (isset($data['SectionC']['C1600']) && $data['SectionC']['C1600'] == '1') {
			$reason .= '<li>Acute mental status change is indicated on the current comprehensive assessment as follows:<br /><br />C1600 = 1</li>';
		}
    
    return $reason;
  }
  
  protected function __cat02($data) {

    if (isset($data['SectionC']) && isset($data['SectionC']['C0500']) && $data['SectionC']['C0500'] != '') $C0500 = $data['SectionC']['C0500']; else $C0500 = '';
    if (isset($data['SectionC']) && isset($data['SectionC']['C0700']) && $data['SectionC']['C0700'] != '') $C0700 = $data['SectionC']['C0700']; else $C0700 = '';
    if (isset($data['SectionC']) && isset($data['SectionC']['C0800']) && $data['SectionC']['C0800'] != '') $C0800 = $data['SectionC']['C0800']; else $C0800 = '';
    if (isset($data['SectionC']) && isset($data['SectionC']['C1000']) && $data['SectionC']['C1000'] != '') $C1000 = $data['SectionC']['C1000']; else $C1000 = '';
    if (isset($data['SectionC']) && isset($data['SectionC']['C1300A']) && $data['SectionC']['C1300A'] != '') $C1300A = $data['SectionC']['C1300A']; else $C1300A = '';
    if (isset($data['SectionC']) && isset($data['SectionC']['C1300B']) && $data['SectionC']['C1300B'] != '') $C1300B = $data['SectionC']['C1300B']; else $C1300B = '';
    if (isset($data['SectionC']) && isset($data['SectionC']['C1300C']) && $data['SectionC']['C1300C'] != '') $C1300C = $data['SectionC']['C1300C']; else $C1300C = '';
    if (isset($data['SectionC']) && isset($data['SectionC']['C1300D']) && $data['SectionC']['C1300D'] != '') $C1300D = $data['SectionC']['C1300D']; else $C1300D = '';

    if (isset($data['SectionE']) && isset($data['SectionE']['E0800']) && $data['SectionE']['E0800'] != '') $E0800 = $data['SectionE']['E0800']; else $E0800 = '';
    if (isset($data['SectionE']) && isset($data['SectionE']['E0900']) && $data['SectionE']['E0900'] != '') $E0900 = $data['SectionE']['E0900']; else $E0900 = '';
    if (isset($data['SectionE']) && isset($data['SectionE']['E0200A']) && $data['SectionE']['E0200A'] != '') $E0200A = $data['SectionE']['E0200A']; else $E0200A = '';
    if (isset($data['SectionE']) && isset($data['SectionE']['E0200B']) && $data['SectionE']['E0200B'] != '') $E0200B = $data['SectionE']['E0200B']; else $E0200B = '';
    if (isset($data['SectionE']) && isset($data['SectionE']['E0200C']) && $data['SectionE']['E0200C'] != '') $E0200C = $data['SectionE']['E0200C']; else $E0200C = '';

    // CAT02 Logic;
    // Initialize CAT indicator to not triggered
    $data['SectionV']['V0200A02A'] = '0';
    // Trigger on Condition 1;
    if ($C0500 >= '00' AND $C0500 < '13' )
      $data['SectionV']['V0200A02A'] = '1';
    // Trigger on Condition 2;
    // Condition 2 applicable only if BIMS summary score is not available;
    if ((($C0500 == '99' OR $C0500 == '-' OR $C0500 == '') && $C0700 == 1) AND $C0700 = '1')
      $data['SectionV']['V0200A02A'] = '1';
    // Trigger on Condition 3;
    // Condition 3 applicable only if BIMS summary score is not available;
    if ((($C0500 == '99' OR $C0500 == '-' OR $C0500 == '') && $C0800 == 1) AND $C0800 == '1') 
      $data['SectionV']['V0200A02A'] = '1';
    // Trigger on Condition 4;
    // Condition 4 applicable only if BIMS summary score is not available;
    if (($C0500 == '99' OR $C0500 == '-' OR $C0500 == '') AND $C1000 >= '1' AND $C1000 <= '3') 
      $data['SectionV']['V0200A02A'] = '1';
    // Trigger on Condition 5;
    if ($C1300A == '1' OR $C1300A == '2' OR $C1300B == '1' OR $C1300B == '2' OR $C1300C == '1' OR $C1300C == '2' OR $C1300D == '1' OR $C1300D == '2') 
      $data['SectionV']['V0200A02A'] = '1';
    // Trigger on Condition 6;
    if (($E0200A >= '1' AND $E0200A <= '3') OR ($E0200B >= '1' AND $E0200B <= '3') OR ($E0200C >= '1' AND $E0200C <= '3')) 
      $data['SectionV']['V0200A02A'] = '1';
    // Trigger on Condition 7;
    if ($E0800 >= '1' AND $E0800 <= '3' )
      $data['SectionV']['V0200A02A'] = '1';
    // Trigger on Condition 8;
    if ($E0900 >= '1' AND $E0900 <= '3') 
      $data['SectionV']['V0200A02A'] = '1';
    return $data;

  }
	
	public function cat02Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;2&nbsp;Cognitive&nbsp;Loss/Dementia</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if (
      (array_key_exists('C0500', $data['SectionC']) && $data['SectionC']['C0500'] >= '0') && 
      (array_key_exists('C0500', $data['SectionC']) && $data['SectionC']['C0500'] < '13'
    )) {
      $reason .= 	'<li>BIMS summary score is less 13 as indicated by:<br /><br /><b>C0500 >= 00 AND C0500 < 13</b><br /><br /></li>';
    }
    // Trigger on Condition 2;
    // Condition 2 applicable only if BIMS summary score is not available;
    if (
        (
          (array_key_exists('C0500', $data['SectionC']) && $data['SectionC']['C0500'] == '99') || 
          (array_key_exists('C0500', $data['SectionC']) && $data['SectionC']['C0500'] == '-') || 
          (array_key_exists('C0500', $data['SectionC']) && $data['SectionC']['C0500'] == null)
        ) && 
        (array_key_exists('C0700', $data['SectionC']) && $data['SectionC']['C0700'] == '1')
      ) {
      		$reason .= 	'<li>BIMS summary score has a missing value and there is a problem with short-term memory as indicated by:<br /><br /><b>(C0500 = 99, -, OR ^) AND (C0700 = 1)</b><br /><br /></li>';
    }
    // Trigger on Condition 3;
    // Condition 3 applicable only if BIMS summary score is not available;
    if (
      (
        (array_key_exists('C0500', $data['SectionC']) && $data['SectionC']['C0500'] == '99') || 
        (array_key_exists('C0500', $data['SectionC']) && $data['SectionC']['C0500'] == '-') || 
        (array_key_exists('C0500', $data['SectionC']) && $data['SectionC']['C0500'] == null)
      ) && 
      (array_key_exists('C0800', $data['SectionC']) && $data['SectionC']['C0800'] == '1')
    ) {
      		$reason .= 	'<li>BIMS summary score has a missing value and there is a problem with long-term memory as indicated by:<br /><br /><b>(C0500 = 99, -, OR ^) AND (C0800 = 1)</b><br /><br /></li>';
    }
    // Trigger on Condition 4;
    // Condition 4 applicable only if BIMS summary score is not available;
    if (
    (
      (array_key_exists('C0500', $data['SectionC']) && $data['SectionC']['C0500'] == 99) || 
      (array_key_exists('C0500', $data['SectionC']) && $data['SectionC']['C0500'] == '-') || 
      (array_key_exists('C0500', $data['SectionC']) && $data['SectionC']['C0500'] == null)) && 
      (
        (array_key_exists('C1000', $data['SectionC']) && $data['SectionC']['C1000'] >= '1') && 
        ($data['SectionC']['C1000'] <= '3')
      )
    ) {
     			$reason .= 	'<li>BIMS summary score has a missing value of 99 or - and at least some difficulty making decisions regarding tasks of daily life as indicated by:<br /><br /><b>(C0500 = 99, -, OR ^) AND (C01000 >= 1 AND C01000 <= 3)</b><br /><br /></li>';
    }  
    // Triger on Condition 5;
    if (
      (
        (array_key_exists('C0500', $data['SectionC']) && $data['SectionC']['C1300A'] == '1') || 
        (array_key_exists('C1300A', $data['SectionC']) && $data['SectionC']['C1300A'] == '2')
      ) || 
      (
        (array_key_exists('C1300B', $data['SectionC']) && $data['SectionC']['C1300B'] == '1') || 
        (array_key_exists('C1300B', $data['SectionC']) && $data['SectionC']['C1300B'] == '2')
      ) || 
      (
        (array_key_exists('C1300C', $data['SectionC']) && $data['SectionC']['C1300C'] == '1') || 
        (array_key_exists('C1300C', $data['SectionC']) && $data['SectionC']['C1300C'] == '2')
      ) || 
      (
        (array_key_exists('C1300D', $data['SectionC']) && $data['SectionC']['C1300D'] == '1') || 
        (array_key_exists('C1300D', $data['SectionC']) && $data['SectionC']['C1300D'] == '2')
      )
    ) {
      	$reason .= 	'<li>BIMS, staff assessment or clinical record suggests presence of inattention, disorganized thinking, alter level of consciousness or psychomotor retardation as indicated by:<br /><br /><b>(C1300A = 1 OR C1300A = 2) OR<br />(C1300B = 1 OR C1300B =2) OR<br />(C1300C =1 OR C1300C = 2) OR<br />(C1300D = 1 OR C1300D =2)</b><br /><br /></li>';
    }
    // Trigger on Condition 6;
    if (
      (array_key_exists('E0200A', $data['SectionE']) && $data['SectionE']['E0200A'] >= '1' && $data['SectionE']['E0200A'] <= '3') || 
      (array_key_exists('E0200B', $data['SectionE']) && $data['SectionE']['E0200B'] >= '1' && $data['SectionE']['E0200B'] <= '3') || 
      (array_key_exists('E0200C', $data['SectionE']) && $data['SectionE']['E0200C'] >= '1' && $data['SectionE']['E0200C'] <= '3')
    ) {
     		$reason .= 	'<li>Presence of any behavioral symptom (verbal, physical or other) as indicated by:<br /><br /><b>((E0200A >= 1 AND E0200A <= 3) OR<br />(E0200B >= 1 AND E0200B <= 3)<br />(E0200C >= 1 AND E0200C <= 3)</b><br /><br /></li>';
    }
    // Trigger on Condition 7;
    if (array_key_exists('E0800', $data['SectionE']) && $data['SectionE']['E0800'] >= '1' && $data['SectionE']['E0800'] <= '3') {
      	$reason .= 	'<li>Rejection of care occured at least 1 day in the past 7 days as indicated by:<br /><br /><b>E0800 >= 1 AND E0800 <= 3</b><br /><br /></li>';
    }
    // Trigger on Condition 8;
    if (array_key_exists('E0900', $data['SectionE']) && $data['SectionE']['E0900'] >= '1' && $data['SectionE']['E0900'] <= '3') {
      	$reason .= 	'<li>Wandering occurred at least 1 day in the past 7 days as indicated by:<br /><br /><b>E0900 >= 1 AND E0900 <= 3</b><br /><br /></li>';
    }
		
		return $reason;
 }
  
  protected function __cat03($data) {
    // // CAT03 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A03A'] = '0';
    // Trigger on Condition 1;
    if (array_key_exists('I6500', $data['SectionI']) && $data['SectionI']['I6500'] == '1') 
      $data['SectionV']['V0200A03A'] = 1;
    // Trigger on Condition 2;
    if (
      (array_key_exists('B1000', $data['SectionB']) && $data['SectionB']['B1000'] >= '1') && 
      (array_key_exists('B1000', $data['SectionB']) && $data['SectionB']['B1000']) <= '4'
    ) 
      $data['SectionV']['V0200A03A'] = 1;

    return $data;
  }
	
	public function cat03reason ($id) {

    $data = ClassRegistry::init('Assessment')->getAssessment($id);
		
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;3&nbsp;Visual&nbsp;Function</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		
    // Trigger on Condition 1;
    // Current assessment is limited to a non-admission comprehensive assessment;
    if (array_key_exists('I6500', $data['SectionI']) && $data['SectionI']['I6500'] == '1') {
			$reason .= 	'<li>Cataracts, glaucoma, or macular degenersation on the current assessment as indicated by:<br /><br /><b>I6500 = 1</b><br /><br /></li>';
		}
		
		if (
      (array_key_exists('B1000', $data['SectionB']) && $data['SectionB']['B1000'] >= '1') && 
      (array_key_exists('B1000', $data['SectionB']) && $data['SectionB']['B1000']) <= '4'
    )  {
			$reason .= 	'<li>Vision item has a value of 1 through 4 indicating vision problems on the current assessments as indicated by:<br /><br /><b>B1000 >=1 AND B1000 <= 4</b></li>';
		}
		
		$reason .= '</ul>';

    return (string)$reason; 
  }
  
  protected function __cat04($data) {
    // CAT04 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A04A'] = '0';
    // Trigger on Condition 1;
    if (array_key_exists('B0200', $data['SectionB']) && $data['SectionB']['B0200'] >= '1' && $data['SectionB']['B0200'] <= '3') 
      $data['SectionV']['V0200A04A'] = 1;
    // Trigger on Condition 2;
    if (array_key_exists('B0700', $data['SectionB'])  && $data['SectionB']['B0700'] >= '1' && $data['SectionB']['B0700'] <= '3') 
      $data['SectionV']['V0200A04A'] = 1;
    // Trigger on Condition 3;
    if (array_key_exists('B0800', $data['SectionB'])  && $data['SectionB']['B0800'] >= '1' && $data['SectionB']['B0800'] <= '3') 
      $data['SectionV']['V0200A04A'] = 1;
    
    return $data;
  }
	
	public function cat04Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;4&nbsp;Communication</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if (array_key_exists('B0200', $data['SectionB']) && $data['SectionB']['B0200'] >= '1' && $data['SectionB']['B0200'] <= '3') 
      $reason .= 	'<li>Hearing item has a value of 1 through 3 indicating hearing problems on the current assessment as indicated by:<br /><br /><b>B0200 >= 1 AND B0200 <= 3</b><br /><br /></li>';
    // Trigger on Condition 2;
    if (array_key_exists('B0700', $data['SectionB'])  && $data['SectionB']['B0700'] >= '1' && $data['SectionB']['B0700'] <= '3') 
      $reason .= 	'<li>Impaired ability to make self understood through verbal and non-verbal expression of ideas/wants as indicated by:<br /><br /><b>B0700 >= 1 AND B0700 <= 3</b><br /><br /></li>';
    // Trigger on Condition 3;
    if (array_key_exists('B0800', $data['SectionB'])  && $data['SectionB']['B0800'] >= '1' && $data['SectionB']['B0800'] <= '3') 
      $reason .= 	'<li>Impaired ability to understand others through verbal content as indicated by:<br /><br /><b>B0800 >= B0800 <= 3</b><br /><br /></li>';
		
		return $reason;
 }
  
  protected function __cat05($data) {
    
    // CAT05 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A05A'] = '0';
    // Resident is considered if independent, modified independent or moderately;
    // impaired regarding cognitive skills for daily decision making;
    if (
      (array_key_exists('C1000', $data['SectionC']) && ($data['SectionC']['C1000'] >= '0' && $data['SectionC']['C1000'] <=  '2')) || 
      (array_key_exists('C0500', $data['SectionC']) && ($data['SectionC']['C0500'] >= '5' && $data['SectionC']['C0500'] <= '15'))
    ) {
      // Trigger on Condition 1;
      if (array_key_exists('G0110A1', $data['SectionG']) && ($data['SectionG']['G0110A1'] >= '1' && $data['SectionG']['G0110A1'] <= '4')) {
        $data['SectionV']['V0200A05A'] = 1;
      }
      // Trigger on Condition 2;
      if (array_key_exists('G0110B1', $data['SectionG']) && ($data['SectionG']['G0110B1'] >= '1' && $data['SectionG']['G0110B1'] <= '4')) {
        $data['SectionV']['V0200A05A'] = 1;
      }
      // Trigger on Condition 3;
      if (array_key_exists('G0110C1', $data['SectionG']) && ($data['SectionG']['G0110C1'] >= '1' && $data['SectionG']['G0110C1'] <= '4')) {
        $data['SectionV']['V0200A05A'] = 1;
      }
      // Trigger on Condition 4;
      if (array_key_exists('G0110D1', $data['SectionG']) && ($data['SectionG']['G0110D1'] >= '1' && $data['SectionG']['G0110D1'] <= '4')) {
        $data['SectionV']['V0200A05A'] = 1;
      }
      // Trigger on Condition 5;
      if (array_key_exists('G0110E1', $data['SectionG']) && ($data['SectionG']['G0110E1'] >= '1' && $data['SectionG']['G0110E1'] <= '4')) {
        $data['SectionV']['V0200A05A'] = 1;
      }
      // Trigger on Condition 6;
      if (array_key_exists('G0110F1', $data['SectionG']) && ($data['SectionG']['G0110F1'] >= '1' && $data['SectionG']['G0110F1'] <= '4')) {
        $data['SectionV']['V0200A05A'] = 1;
      }
      // Trigger on Condition 7;
      if (array_key_exists('G0110G1', $data['SectionG']) && ($data['SectionG']['G0110G1'] >= '1' && $data['SectionG']['G0110G1'] <= '4')) {
        $data['SectionV']['V0200A05A'] = 1;
      }
      // Trigger on Condition 8;
      if (array_key_exists('G0110H1', $data['SectionG']) && $data['SectionG']['G0110H1'] >= '1' && $data['SectionG']['G0110H1'] <= '4') {
        $data['SectionV']['V0200A05A'] = 1;
      }
      // Trigger on Condition 9;
      if (array_key_exists('G0110I1', $data['SectionG']) && $data['SectionG']['G0110I1'] >= '1' && $data['SectionG']['G0110I1'] <= '4') {
        $data['SectionV']['V0200A05A'] = 1;
      }
      // Trigger on Condition 10;
      if (array_key_exists('G0110J1', $data['SectionG']) && $data['SectionG']['G0110J1'] >= '1' && $data['SectionG']['G0110J1'] <= '4') {
        $data['SectionV']['V0200A05A'] = 1;
      }
      // Trigger on Condition 11;
      if (array_key_exists('G0120A', $data['SectionG']) && $data['SectionG']['G0120A'] >= '1' && $data['SectionG']['G0120A'] <= '4') {
        $data['SectionV']['V0200A05A'] = 1;
      }
      // Trigger on Condition 12;
      if (
        (
          (array_key_exists('G0300A', $data['SectionG']) && $data['SectionG']['G0300A'] == '1') || 
          (array_key_exists('G0300A', $data['SectionG']) && $data['SectionG']['G0300A'] == '2')
        ) || 
        (
          (array_key_exists('G0300B', $data['SectionG']) && $data['SectionG']['G0300B'] == '1') || 
          (array_key_exists('G0300B', $data['SectionG']) && $data['SectionG']['G0300B'] == '2')) || 
        (
          (array_key_exists('G0300C', $data['SectionG']) && $data['SectionG']['G0300C'] == '1') || 
          (array_key_exists('G0300C', $data['SectionG']) && $data['SectionG']['G0300C'] == '2')
        ) || 
        (
          (array_key_exists('G0300D', $data['SectionG']) && $data['SectionG']['G0300D'] == '1') || 
          (array_key_exists('G0300D', $data['SectionG']) && $data['SectionG']['G0300D'] == '2')
        ) || 
        (
          (array_key_exists('G0300E', $data['SectionG']) && $data['SectionG']['G0300E'] == '1') || 
          (array_key_exists('G0300E', $data['SectionG']) && $data['SectionG']['G0300E'] == '2')
        ) 
      ) {
        $data['SectionV']['V0200A05A'] = 1;
      }
      // Trigger on Condition 13;
      if (array_key_exists('G0900A', $data['SectionG']) && $data['SectionG']['G0900A'] == '1') {
        $data['SectionV']['V0200A05A'] = 1;
      }
      // Trigger on Condition 14;
      if (array_key_exists('G0900B', $data['SectionG']) && $data['SectionG']['G0900B'] == '1') {
        $data['SectionV']['V0200A05A'] = 1;
      }
    }
    
    return $data;
  }
	
	public function cat05Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;5&nbsp;ADL&nbsp;Functional/Rehabilitation&nbsp;Potential</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Resident is considered if independent, modified independent or moderately;
    // impaired regarding cognitive skills for daily decision making;
    if (
      (array_key_exists('C1000', $data['SectionC']) && ($data['SectionC']['C1000'] >= '0' && $data['SectionC']['C1000'] <=  '2')) || 
      (array_key_exists('C0500', $data['SectionC']) && ($data['SectionC']['C0500'] >= '5' && $data['SectionC']['C0500'] <= '15'))
    ) {
      // Trigger on Condition 1;
      if (array_key_exists('G0110A1', $data['SectionG']) && ($data['SectionG']['G0110A1'] >= '1' && $data['SectionG']['G0110A1'] <= '4')) {
        $reason .= 	'<li>Cognitive skills for daily decision making has a value of 0 through 2 or BIMS summary score is 5 or greater, while ADL assistance for bed mobility was needed as indicated by:<br /><br /><b>(G0110A1 >= 1 AND G0110A1 <=4) AND<br />((C1000 >= 0 AND C1000 <= 2) OR <br />(C0500 >= 5 AND C0500 <= 15))</b><br /><br /></li>';
      }
      // Trigger on Condition 2;
      if (array_key_exists('G0110B1', $data['SectionG']) && ($data['SectionG']['G0110B1'] >= '1' && $data['SectionG']['G0110B1'] <= '4')) {
        $reason .= 	'<li>Cognitive skills for daily decision making has a value of 0 through 2 or BIMS summary score is 5 or greater, while ADL assistance for transfer between surfaces (excluding to/from bath/toilets) as indicated by:<br /><br /><b>(G0110B1 >= 1 AND G0110B1 <=4) AND<br />((C1000 >= 0 AND C1000 <= 2) OR <br />(C0500 >= 5 AND C0500 <= 15))</b><br /><br /></li>';
      }
      // Trigger on Condition 3;
      if (array_key_exists('G0110C1', $data['SectionG']) && ($data['SectionG']['G0110C1'] >= '1' && $data['SectionG']['G0110C1'] <= '4')) {
        $reason .= 	'<li>Cognitive skills for daily decision making has a value of 0 through 2 or BIMS summary score is 5 or greater, while ADL assistance for walking in his/her room was needed as indicated by:<br /><br /><b>(G0110C1 >= 1 AND G0110CB1 <=4) AND<br />((C1000 >= 0 AND C1000 <= 2) OR <br />(C0500 >= 5 AND C0500 <= 15))</b><br /><br /></li>';
      }
      // Trigger on Condition 4;
      if (array_key_exists('G0110D1', $data['SectionG']) && ($data['SectionG']['G0110D1'] >= '1' && $data['SectionG']['G0110D1'] <= '4')) {
        $reason .= 	'<li>Cognitive skills for daily decision making has a value of 0 through 2 or BIMS summary score is 5 or greater, while ADL assistance for walking in corridor was needed as indicated by:<br /><br /><b>(G0110D1 >= 1 AND G0110D1 <=4) AND<br />((C1000 >= 0 AND C1000 <= 2) OR <br />(C0500 >= 5 AND C0500 <= 15))</b><br /><br /></li>';
      }
      // Trigger on Condition 5;
      if (array_key_exists('G0110E1', $data['SectionG']) && ($data['SectionG']['G0110E1'] >= '1' && $data['SectionG']['G0110E1'] <= '4')) {
        $reason .= 	'<li>Cognitive skills for daily decision making has a value of 0 through 2 or BIMS summary score is 5 or greater, while ADL assistance for locomotion on unit (including with wheel chair, if applicable) was needed as indicated by:<br /><br /><b>(G0110E1 >= 1 AND G0110E1 <=4) AND<br />((C1000 >= 0 AND C1000 <= 2) OR <br />(C0500 >= 5 AND C0500 <= 15))</b><br /><br /></li>';
      }
      // Trigger on Condition 6;
      if (array_key_exists('G0110F1', $data['SectionG']) && ($data['SectionG']['G0110F1'] >= '1' && $data['SectionG']['G0110F1'] <= '4')) {
        $reason .= 	'<li>Cognitive skills for daily decision making has a value of 0 through 2 or BIMS summary score is 5 or greater, while ADL assistance for locomotion on unit (including with wheel chair, if applicable) was needed as indicated by:<br /><br /><b>(G0110F1 >= 1 AND G0110F1 <=4) AND<br />((C1000 >= 0 AND C1000 <= 2) OR <br />(C0500 >= 5 AND C0500 <= 15))</b><br /><br /></li>';
      }
      // Trigger on Condition 7;
      if (array_key_exists('G0110G1', $data['SectionG']) && ($data['SectionG']['G0110G1'] >= '1' && $data['SectionG']['G0110G1'] <= '4')) {
        $reason .= 	'<li>Cognitive skills for daily decision making has a value of 0 through 2 or BIMS summary score is 5 or greater, while ADL assistance for dressing was needed as indicated by:<br /><br /><b>(G0110G1 >= 1 AND G0110G1 <=4) AND<br />((C1000 >= 0 AND C1000 <= 2) OR <br />(C0500 >= 5 AND C0500 <= 15))</b><br /><br /></li>';
      }
      // Trigger on Condition 8;
      if (array_key_exists('G0110H1', $data['SectionG']) && $data['SectionG']['G0110H1'] >= '1' && $data['SectionG']['G0110H1'] <= '4') {
        $reason .= 	'<li>Cognitive skills for daily decision making has a value of 0 through 2 or BIMS summary score is 5 or greater, while ADL assistance for eating was needed as indicated by:<br /><br /><b>(G0110H1 >= 1 AND G0110H1 <=4) AND<br />((C1000 >= 0 AND C1000 <= 2) OR <br />(C0500 >= 5 AND C0500 <= 15))</b><br /><br /></li>';
      }
      // Trigger on Condition 9;
      if (array_key_exists('G0110I1', $data['SectionG']) && $data['SectionG']['G0110I1'] >= '1' && $data['SectionG']['G0110I1'] <= '4') {
        $reason .= 	'<li>Cognitive skills for daily decision making has a value of 0 through 2 or BIMS summary score is 5 or greater, while ADL assistance for toilet use was needed as indicated by:<br /><br /><b>(G0110I1 >= 1 AND G0110I1 <=4) AND<br />((C1000 >= 0 AND C1000 <= 2) OR <br />(C0500 >= 5 AND C0500 <= 15))</b><br /><br /></li>';
      }
      // Trigger on Condition 10;
      if (array_key_exists('G0110J1', $data['SectionG']) && $data['SectionG']['G0110J1'] >= '1' && $data['SectionG']['G0110J1'] <= '4') {
        $reason .= 	'<li>Cognitive skills for daily decision making has a value of 0 through 2 or BIMS summary score is 5 or greater, while ADL assistance for grooming/personal hygiene was needed as indicated by:<br /><br /><b>(G0110J1 >= 1 AND G0110J1 <=4) AND<br />((C1000 >= 0 AND C1000 <= 2) OR <br />(C0500 >= 5 AND C0500 <= 15))</b><br /><br /></li>';
      }
      // Trigger on Condition 11;
      if (array_key_exists('G0120A', $data['SectionG']) && $data['SectionG']['G0120A'] >= '1' && $data['SectionG']['G0120A'] <= '4') {
        $reason .= 	'<li>Cognitive skills for daily decision making has a value of 0 through 2 or BIMS summary score is 5 or greater, while ADL assistance for self-performance bathing (excluding washing of back and hair) has a value of 1 through 4 as indicated by:<br /><br /><b>(G0120A >= 1 AND G0120A <=4) AND<br />((C1000 >= 0 AND C1000 <= 2) OR <br />(C0500 >= 5 AND C0500 <= 15))</b><br /><br /></li>';
      }
      // Trigger on Condition 12;
      if (
        (
          (array_key_exists('G0300A', $data['SectionG']) && $data['SectionG']['G0300A'] == '1') || 
          (array_key_exists('G0300A', $data['SectionG']) && $data['SectionG']['G0300A'] == '2')
        ) || 
        (
          (array_key_exists('G0300B', $data['SectionG']) && $data['SectionG']['G0300B'] == '1') || 
          (array_key_exists('G0300B', $data['SectionG']) && $data['SectionG']['G0300B'] == '2')) || 
        (
          (array_key_exists('G0300C', $data['SectionG']) && $data['SectionG']['G0300C'] == '1') || 
          (array_key_exists('G0300C', $data['SectionG']) && $data['SectionG']['G0300C'] == '2')
        ) || 
        (
          (array_key_exists('G0300D', $data['SectionG']) && $data['SectionG']['G0300D'] == '1') || 
          (array_key_exists('G0300D', $data['SectionG']) && $data['SectionG']['G0300D'] == '2')
        ) || 
        (
          (array_key_exists('G0300E', $data['SectionG']) && $data['SectionG']['G0300E'] == '1') || 
          (array_key_exists('G0300E', $data['SectionG']) && $data['SectionG']['G0300E'] == '2')
        ) 
      ) {
        $reason .= 	'<li>Cognitive skills for daily decision making has a value of 0 through 2 or BIMS summary score is 5 or greater, while balance during transition has a value of 1 or 2 for any item as indicated by as indicated by:<br /><br /><b>((G0300A = 1 OR G0300A = 2) OR<br />(G0300B = 1 OR G0300B = 2) OR <br />(G0300C = 1 OR G0300C = 2) OR <br /><br />(G0300CD = 1 OR G0300D = 2) OR <br /><br />(G0300E = 1 OR G0300E = 2) AND ((C1000 >= 0 AND C1000 <= 2) OR<br /><br />(C0500 >= 5 AND C0500 <= 15))<br /><br /></b><br /><br /></li>';
      }
      // Trigger on Condition 13;
      if (array_key_exists('G0900A', $data['SectionG']) && $data['SectionG']['G0900A'] == '1') {
        $reason .= 	'<li>Cognitive skills for daily decision making has a value of 0 through 2 or BIMS summary score is 5 or greater, while resident believes he/she is capable of increased as indicated by:<br /><br /><b>(G0900A = 1 AND <br />((C1000 >= 0 AND C1000 <= 2) OR <br />(C0500 >= 5 AND C0500 <= 15))</b><br /><br /></li>';
      }
      // Trigger on Condition 14;
      if (array_key_exists('G0900B', $data['SectionG']) && $data['SectionG']['G0900B'] == '1') {
        $reason .= 	'<li>Cognitive skills for daily decision making has a value of 0 through 2 or BIMS summary score is 5 or greater, while direct care staff believe resident is capable of increased independence as indicated by:<br /><br /><b>(G0900B = 1 AND <br />((C1000 >= 0 AND C1000 <= 2) OR <br />(C0500 >= 5 AND C0500 <= 15))</b><br /><br /></li>';
      }
    }
		
		return $reason;
 }
  
  protected function __cat06($data) {

    if (isset($data['SectionG']) && isset($data['SectionG']['G0110I1']) && $data['SectionG']['G0110I1'] != '') $G0110I1 = $data['SectionG']['G0110I1']; else $G0110I1 = '';
    if (isset($data['SectionH']) && isset($data['SectionH']['H0100A']) && $data['SectionH']['H0100A'] != '') $H0100A = $data['SectionH']['H0100A']; else $H0100A = '';
    if (isset($data['SectionH']) && isset($data['SectionH']['H0100B']) && $data['SectionH']['H0100B'] != '') $H0100B = $data['SectionH']['H0100B']; else $H0100B = '';
    if (isset($data['SectionH']) && isset($data['SectionH']['H0100D']) && $data['SectionH']['H0100D'] != '') $H0100D   = $data['SectionH']['H0100D']; else $H0100D = '';
    if (isset($data['SectionH']) && isset($data['SectionH']['H0300']) && $data['SectionH']['H0300'] != '') $H0300 = $data['SectionH']['H0300']; else $H0300 = '';
    if (isset($data['SectionM']) && isset($data['SectionM']['M1040H']) && $data['SectionM']['M1040H'] != '') $M1040H = $data['SectionM']['M1040H']; else $M1040H = '';
    
    // CAT06 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A06A'] = '0';
    // Trigger on Condition 1;
    if ($G0110I1 >= 2 && $G0110I1 <= '4')
      $data['SectionV']['V0200A06A'] = 1;
    // Trigger on Condition 2;
    if ($H0100A == '1') 
      $data['SectionV']['V0200A06A'] = 1;
    // Trigger on Condition 3;
    if ($H0100B == '1') 
      $data['SectionV']['V0200A06A'] = 1;
    // Trigger on Condition 4;
    if ($H0100D == '1') 
      $data['SectionV']['V0200A06A'] = 1;
    // Trigger on Condition 5;
    if ($H0300 >= '1' && $H0300 <= '3')
      $data['SectionV']['V0200A06A'] = 1;
    // Trigger on Condition 6;
    if ($M1040H == '1')
      $data['SectionV']['V0200A06A'] = 1;
    
    return $data;
  }
	
	public function cat06Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);

    if (isset($data['SectionG']) && isset($data['SectionG']['G0110I1']) && $data['SectionG']['G0110I1'] != '') $G0110I1 = $data['SectionG']['G0110I1']; else $G0110I1 = '';
    if (isset($data['SectionH']) && isset($data['SectionH']['H0100A']) && $data['SectionH']['H0100A'] != '') $H0100A = $data['SectionH']['H0100A']; else $H0100A = '';
    if (isset($data['SectionH']) && isset($data['SectionH']['H0100B']) && $data['SectionH']['H0100B'] != '') $H0100B = $data['SectionH']['H0100B']; else $H0100B = '';
    if (isset($data['SectionH']) && isset($data['SectionH']['H0100D']) && $data['SectionH']['H0100D'] != '') $H0100D   = $data['SectionH']['H0100D']; else $H0100D = '';
    if (isset($data['SectionH']) && isset($data['SectionH']['H0300']) && $data['SectionH']['H0300'] != '') $H0300 = $data['SectionH']['H0300']; else $H0300 = '';
    if (isset($data['SectionM']) && isset($data['SectionM']['M1040H']) && $data['SectionM']['M1040H'] != '') $M1040H = $data['SectionM']['M1040H']; else $M1040H = '';
    
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;6&nbsp;Urinary&nbsp;Incontinence&nbsp;and&nbsp;Indwelling&nbsp;Catheter</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if ($G0110I1 >= 2 && $G0110I1 <= '4')
      $reason .= 	'<li>ADL assistance for toileting was needed as indicated by:<br /><br /><b>(G0110I1 >= 2 AND G0110I1 <= 4)</b><br /><br /></li>';
    // Trigger on Condition 2;
    if ($H0100A == '1') 
      $reason .= 	'<li>Resident requires a indwelling catheter as indicated by:<br /><br /><b>H0100A = 1</b><br /><br /></li>';
    // Trigger on Condition 3;
    if ($H0100B == '1') 
      $reason .= 	'<li>Resident requires an external catheter as indicated by:<br /><br /><b>H0100B = 1</b><br /><br /></li>';
    // Trigger on Condition 4;
    if ($H0100D == '1') 
      $reason .= 	'<li>Resident requires a intermittent catheterization as indicated by:<br /><br /><b>H0100D = 1</b><br /><br /></li>';
    // Trigger on Condition 5;
    if ($H0300 >= '1' && $H0300 <= '3')
      $reason .=  '<li>Urinary incontinence has a value of 1 through 3 as indicated by:<br /><br /><b>H0300 = 1 AND H0300 <= 3</b><br /><br /></li>';
    // Trigger on Condition 6;
    if ($M1040H == '1')
      $reason .=  '<li>Resident moisture associated skin damage as indicated by::<br /><br /><b>M1040H = 1</b><br /><br /></li>';

    return $reason;
 }
  
  protected function __cat07($data) {
    
    // CAT07 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A07A'] = '0';
    // Trigger on Condition 1;
    if  ($data['SectionD']['D0200A1'] == '1') $data['SectionV']['V0200A07A'] = '1';
    // Trigger on Condition 2;
    if  ($data['SectionD']['D0500A1'] == '1') $data['SectionV']['V0200A07A'] = '1';
    // Trigger on Condition 3;
    if  ($data['SectionF']['F0500F'] == '3' OR $data['SectionF']['F0500F'] == '4')  $data['SectionV']['V0200A07A']= '1';
    // Trigger on Condition 4;

    if  ($data['SectionF']['F0800Q'] == '0')  $data['SectionV']['V0200A07A'] = '1';
    // Trigger on Condition 5;
    if  (
      ($data['SectionE']['E0200A'] >= '1' AND $data['SectionE']['E0200A'] <= '3') AND
      ($data['SectionI']['I4800'] == '0' OR $data['SectionI']['I4800'] == '-') AND
      ($data['SectionI']['I4200'] == '0' OR $data['SectionI']['I4200'] == '-')
    ) $data['SectionV']['V0200A07A'] = '1';
    // Trigger on Condition 6;
    if  (
      ($data['SectionE']['E0200B'] >= '1' AND $data['SectionE']['E0200B'] <= '3') AND
      ($data['SectionI']['I4800'] == '0' OR $data['SectionI']['I4800'] == '-') AND
      ($data['SectionI']['I4200'] == '0' OR $data['SectionI']['I4200'] == '-')
    ) $data['SectionV']['V0200A07A'] = '1';
    // Trigger on Condition 7;
    // Count number of F0500 items = 4;
    $n_f0500eq4 = 0;
    if  ($data['SectionF']['F0500A'] == '4')   $n_f0500eq4 = $n_f0500eq4 + 1;
    if  ($data['SectionF']['F0500B'] == '4')   $n_f0500eq4 = $n_f0500eq4 + 1;
    if  ($data['SectionF']['F0500C'] == '4')   $n_f0500eq4 = $n_f0500eq4 + 1;
    if  ($data['SectionF']['F0500D'] == '4')   $n_f0500eq4 = $n_f0500eq4 + 1;
    if  ($data['SectionF']['F0500E'] == '4')   $n_f0500eq4 = $n_f0500eq4 + 1;
    if  ($data['SectionF']['F0500F'] == '4')   $n_f0500eq4 = $n_f0500eq4 + 1;
    if  ($data['SectionF']['F0500G'] == '4')   $n_f0500eq4 = $n_f0500eq4 + 1;
    if  ($data['SectionF']['F0500H'] == '4')   $n_f0500eq4 = $n_f0500eq4 + 1;
    if  ($n_f0500eq4 >= 6 AND $data['SectionF']['F0600'] == '1')  $data['SectionV']['V0200A07A'] = '1';
    
    return $data;
  }
	
	public function cat07Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;7&nbsp;Psychological&nbsp;Well-Being</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if (isset($data['SectionD']['D0200A1']) && $data['SectionD']['D0200A1'] == '1') {
      $reason .= 	'<li>Resident mood interview indicates the presence of little interest or pleasure in doing things as indicated by:<br /><br /><b>D0200A1 = 1</b><br /><br /></li>';
    }  
    // Trigger on Condition 2;
    if (isset($data['SectionD']['D0500A1']) && $data['SectionD']['D0500A1'] == '1') {
      $reason .= 	'<li>Staff assessment of resident mood indicates the presence of little interest or pleasure in doing things as indicated by:<br /><br /><b>D0500A1 = 1</b><br /><br /></li>';
    }  
    // Trigger on Condition 3;
    if (
      (isset($data['SectionF']['F0500F']) && $data['SectionF']['F0500F'] == '3') || 
      (isset($data['SectionF']['F0500F']) && $data['SectionF']['F0500F'] == '4')
    ) {
      $reason .= 	'<li>Interview for activity preference item "How important is it to you to do your favorite acitivities?" has a value of 3 or 4 as indicated by:<br /><br /><b>F0500F = 3 OR F0500F = 4</b><br /><br /></li>';
    }  
    // Trigger on Condition 4;
    if (isset($data['SectionF']['F0800Q']) && $data['SectionF']['F0800Q'] == '0') {
      $reason .= 	'<li>Staff assessment of daily and activity preferences did not indicate that resident prefers participating in favorite activities:<br /><br /><b>F0800Q = Not Checked</b><br /><br /></li>';
    }  
    // Trigger on Condition 5;
    if (
      (isset($data['SectionE']['E0200A']) && ($data['SectionE']['E0200A'] >= '1' && $data['SectionE']['E0200A'] <= '3')) && 
      ((isset($data['SectionI']['I4800']) && $data['SectionI']['I4800'] == '0') || (isset($data['SectionI']['I4800']) && $data['SectionI']['I4800'] == '-')) && 
      ((isset($data['SectionI']['I4200']) && $data['SectionI']['I4200'] == '0') || (isset($data['SectionI']['I4200']) && $data['SectionI']['I4200'] == '-'))
    ) {
      $reason .= 	'<li>Physical behavioral symtoms directed towards others has a value of 1 through 3 and neither dementia nor Alzheimer\'s disease is present as indicated by:<br /><br /><b>(E0200A >= 1 AND E0200A <= 3) AND<br />(I4800 = 0 OR I4800 = -) AND <br />(I4800 = 0 OR I4800 = -)</b><br /><br /></li>';
    }  
    // Trigger on Condition 6;
    if (
      (isset($data['SectionE']['E0200B']) && $data['SectionE']['E0200B'] >= '1' && $data['SectionE']['E0200B'] <= '3') && 
      (isset($data['SectionI']['I4800']) && $data['SectionI']['I4800'] == '0' || $data['SectionI']['I4800'] == '-') && 
      (isset($data['SectionI']['I4200']) && $data['SectionI']['I4200'] == '0' || $data['SectionI']['I4200'] == '-')
    ) {
      $reason .= 	'<li>Verbal behavioral symptoms directed towards others has a value of 1 through 3 and neither dementia nor Alzheimer\'s disease is present as indicated by:<br /><br /><b>(E0200A >= 1 AND E0200A <= 3) AND<br />(I4800 = 0 OR I4800 = -) AND <br />(I4800 = 0 OR I4800 = -)</b><br /><br /></li>';
    }
      
    // Trigger on Condition 7;
    // Count number of F0500 items = '4';
    $n = '0';
    if (isset($data['SectionF']['F0500A']) && $data['SectionF']['F0500A'] == '4') $n++;
    if (isset($data['SectionF']['F0500B']) && $data['SectionF']['F0500B'] == '4') $n++;
    if (isset($data['SectionF']['F0500C']) && $data['SectionF']['F0500C'] == '4') $n++;
    if (isset($data['SectionF']['F0500D']) && $data['SectionF']['F0500D'] == '4') $n++;
    if (isset($data['SectionF']['F0500E']) && $data['SectionF']['F0500E'] == '4') $n++;
    if (isset($data['SectionF']['F0500F']) && $data['SectionF']['F0500F'] == '4') $n++;
    if (isset($data['SectionF']['F0500G']) && $data['SectionF']['F0500G'] == '4') $n++;
    if (isset($data['SectionF']['F0500H']) && $data['SectionF']['F0500H'] == '4') $n++;
    if (isset($data['SectionF']['F0600']) && ($n >= 6 && $data['SectionF']['F0600'] == '1')) {
      $reason .= 	'<li>Verbal behavioral symptoms directed towards others has a value of 1 through 3 and neither dementia nor Alzheimer\'s disease is present as indicated by:<br /><br /><b>(Any 6 of F0500A through F0500H = 4) AND<br />(F0600 = 1)</b><br /><br /></li>';
    }
		
		return $reason;
 }
  
  protected function __cat08($data) {

    // CAT08 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A08A'] = '0';
    // Trigger on Condition 1;
    if (isset($data['SectionD']['D0200I1']) && $data['SectionD']['D0200I1'] == '1') 
      $data['SectionV']['V0200A08A'] = 1;
    // Trigger on Condition 2;
    if (isset($data['SectionD']['D0500I1']) && $data['SectionD']['D0500I1'] == '1') 
      $data['SectionV']['V0200A08A'] = 1;
    // Trigger on Condition 3;
    // Current assessment is limited to a non-admission comprehensive assessment;
    if (
      (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] == '03') || 
      (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] == '04') || 
      (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] == '05')
    ) {
      // Check that D0300 && V0100E both have non-missing values (00 to 27);
      if (($data['SectionD']['D0300'] >= '00' && $data['SectionD']['D0300'] <= '27') && ($data['SectionV']['V0100E'] >= '00' && $data['SectionV']['V0100E'] <= '27')) {
        // Trigger CAT if current assessment score > prior;
        //  assessment score;
        if ($data['SectionD']['D0300'] > $data['SectionV']['V0100E']) 
          $data['SectionV']['V0200A08A'] = 1;
      }
    }
    // Trigger on Condition 4;
    // Current assessment is limited to a non-admission comprehensive assessment,;
    //  && the resident interview is not successfully completed;
    if (
      (
        (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] == '03') || 
        (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] == '04') || 
        (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] == '05')
      ) && 
      (
        (isset($data['SectionD']['D0300']) && $data['SectionD']['D0300'] < '00') || 
        (isset($data['SectionD']['D0300']) && $data['SectionD']['D0300'] > '27')
      )
    ) {
    // Check that D0600 && V0100F both have non-missing values (00 to 30);
    if (($data['SectionD']['D0600'] >= '00' && $data['SectionD']['D0600'] <= '30') && ($data['SectionV']['V0100F'] >= '00' && $data['SectionV']['V0100F'] <= '30')) {
      // Trigger CAT if current assessment score > prior;
      // assessment score;
      if ($data['SectionD']['D0600'] > $data['SectionV']['V0100F']) 
        $data['SectionV']['V0200A08A'] = 1;
      }
    }
    // Trigger on Condition 5;
    if (isset($data['SectionD']['D0300']) && $data['SectionD']['D0300'] >= '10' && $data['SectionD']['D0300'] <= '27') 
      $data['SectionV']['V0200A08A'] = 1;
    // Trigger on Condition 6;
    if (isset($data['SectionD']['D0600']) && $data['SectionD']['D0600'] >= '10' && $data['SectionD']['D0600'] <= '30') 
      $data['SectionV']['V0200A08A'] = 1;
    
    return $data;
  }
	
	public function cat08Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;8&nbsp;Mood&nbsp;State</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if (isset($data['SectionD']['D0200I1']) && $data['SectionD']['D0200I1'] == '1') 
      $reason .= 	'<li>Resident has had thoughts he/she would be better off dead, or thoughts of hurting him/herself as indicated by:<br /><br /><b>D0200I1 = 1</b><br /><br /></li>';
    // Trigger on Condition 2;
    if (isset($data['SectionD']['D0500I1']) && $data['SectionD']['D0500I1'] == '1') 
      $reason .= 	'<li>Staff assessment of resident mood suggests resident states life isn\'t worth living, wishes for death, or attempts to harm self as indicated by:<br /><br /><b>D0500I1 = 1</b><br /><br /></li>';
    // Trigger on Condition 3;
    // Current assessment is limited to a non-admission comprehensive assessment;
    if (
      (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] == '03') || 
      (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] == '04') || 
      (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] == '05')
    ) {
      // Check that D0300 && V0100E both have non-missing values (00 to 27);
      if (($data['SectionD']['D0300'] >= '00' && $data['SectionD']['D0300'] <= '27') && ($data['SectionV']['V0100E'] >= '00' && $data['SectionV']['V0100E'] <= '27')) {
        // Trigger CAT if current assessment score > prior;
        //  assessment score;
        if ($data['SectionD']['D0300'] > $data['SectionV']['V0100E']) 
          $reason .= 	'<li>The resident mood interview total severity score has a non-missing value (0 to 27) on both the current non-admission comprehensive assessment (A0310A = 03, 04, or 05) and the prior assessment, and the resident interview summary score on the current non-admission comprensive assessment (D0300) is greater than the prior assessment (V0100E) as indicated by:<br /><br /><b>((A0310A = 03) OR (A0310A = 04) OR (A0310A = 05)) AND<r />((D0300 >= 00) AND (D0300 <= 27)) AND<br />((V0100E <= 00) AND (V0100E <= 27)) AND<br />(D0300 > V0100E)</b><br /><br /></li>';
      }
    }
    // Trigger on Condition 4;
    // Current assessment is limited to a non-admission comprehensive assessment,;
    //  && the resident interview is not successfully completed;
    if (
      (
        (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] == '03') || 
        (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] == '04') || 
        (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] == '05')
      ) && 
      (
        (isset($data['SectionD']['D0300']) && $data['SectionD']['D0300'] < '00') || 
        (isset($data['SectionD']['D0300']) && $data['SectionD']['D0300'] > '27')
      )
    ) {
    // Check that D0600 && V0100F both have non-missing values (00 to 30);
    if (($data['SectionD']['D0600'] >= '00' && $data['SectionD']['D0600'] <= '30') && ($data['SectionV']['V0100F'] >= '00' && $data['SectionV']['V0100F'] <= '30')) {
      // Trigger CAT if current assessment score > prior;
      // assessment score;
      if ($data['SectionD']['D0600'] > $data['SectionV']['V0100F']) 
         $reason .= 	'<li>The resident mood interview is not successfully completed (missing value on D0300), the staff assessment of resident mood has a non-missing value (0 to 30) on both the current non-admission comprehensive assessment (A0310A = 03, 04, or 05) and the prior assessment, and the staff assessment current total severity score on the current non-admission comprensive assessment (D0600) is greater than the prior assessment (V0100F) as indicated by:<br /><br /><b>((A0310A = 03) OR (A0310A = 04) OR (A0310A = 05)) AND<r />((D0300 >= 00) AND (D0300 <= 27)) AND<br />((D0600 >= 00) AND (D0600 <= 30)) AND((V0100F <= 00) AND (V0100F <= 30)) AND<br />(D0600 > V0100F)</b><br /><br /></li>';
      }
    }
    // Trigger on Condition 5;
    if (isset($data['SectionD']['D0300']) && $data['SectionD']['D0300'] >= '10' && $data['SectionD']['D0300'] <= '27') 
      $reason .= 	'<li>The resident mood interview is successfully completed and the current total severity score has a value of 10 through 27 as indicated by:<br /><br /><b>D0300 >= 10 AND D0300 <= 27</b><br /><br /></li>';
    // Trigger on Condition 6;
    if (isset($data['SectionD']['D0600']) && $data['SectionD']['D0600'] >= '10' && $data['SectionD']['D0600'] <= '30') 
      $reason .= 	'<li>The staff assessment of resident mood is recorded and the current total severity score has a value of 10 through 30 as indicated by:<br /><br /><b>D0600 >= 10 AND D0600 <= 30</b><br /><br /></li>';
		
		return $reason;
 }
  
  protected function __cat09($data) {

    // CAT09 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A09A'] = '0';
    // Trigger on Condition 1;
    if (isset($data['SectionE']['E0800']) && $data['SectionE']['E0800'] >= '1' && $data['SectionE']['E0800'] <= '3') 
      $data['SectionV']['V0200A09A'] = 1;
    // Trigger on Condition 2;
    if (isset($data['SectionE']['E0900']) && $data['SectionE']['E0900'] >= '1' && $data['SectionE']['E0900'] <= '3') 
      $data['SectionV']['V0200A09A'] = 1;
    // Trigger on Condition 3;
    if (isset($data['SectionE']['E1100']) && $data['SectionE']['E1100'] == '2') 
      $data['SectionV']['V0200A09A'] = 1;
    // Trigger on Condition 4;
    if (isset($data['SectionE']['E0300']) && $data['SectionE']['E0300'] == '1') 
      $data['SectionV']['V0200A09A'] = 1;
    
    return $data;
  }
	
	public function cat09Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;9&nbsp;Behavioral&nbsp;Symptoms</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    if (isset($data['SectionE']['E0800']) && $data['SectionE']['E0800'] >= '1' && $data['SectionE']['E0800'] <= '3') 
      $reason .= 	'<li>Rejection of care has a value of 1 through 3 indicating resident has rejected evaluation or care necessary to achieve his/her goals for health and well-being as indicated by:<br /><br /><b>E0800 >= 1 AND E0800 <= 3</b><br /><br /></li>';
    // Trigger on Condition 2;
    if (isset($data['SectionE']['E0900']) && $data['SectionE']['E0900'] >= '1' && $data['SectionE']['E0900'] <= '3') 
      $reason .= 	'<li>Wandering has a value of 1 through 3 as indicated by:<br /><br /><b>E0900 >= 1 AND E0900 <= 3</b><br /><br /></li>';
    // Trigger on Condition 3;
    if (isset($data['SectionE']['E1100']) && $data['SectionE']['E1100'] == '2') 
      $reason .= 	'<li>Change in behavior indicates behavior, care rejection or wandering has gotten worse since prior assessment as indicated by:<br /><br /><b>E01100 = 2</b><br /><br /></li>';
    // Trigger on Condition 4;
    if (isset($data['SectionE']['E0300']) && $data['SectionE']['E0300'] == '1') 
      $reason .= 	'<li>Presence of a least one behavioral symptom as indicated by:<br /><br /><b>E0300 = 1</b><br /><br /></li>';
			
		return $reason;
 }
  
  protected function __cat10($data) {
    // CAT10 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A10A'] = '0';
    // Trigger on Condition 1;
    if (isset($data['SectionD']['D0200A1']) && $data['SectionD']['D0200A1'] == '1') {
      $data['SectionV']['V0200A10A'] = 1;
    }  
    // Trigger on Condition 2;
    if (isset($data['SectionD']['D0500A1']) && $data['SectionD']['D0500A1'] == '1') {
      $data['SectionV']['V0200A10A'] = 1;
    }  
    // Trigger on Condition 3;
    // Count number of F0500 items = '4' or 5;
    $n = '0';
    if (isset($data['SectionF']['F0500A']) && ($data['SectionF']['F0500A'] == '4' || $data['SectionF']['F0500A'] == '5')) $n++;
    if (isset($data['SectionF']['F0500B']) && ($data['SectionF']['F0500B'] == '4' || $data['SectionF']['F0500B'] == '5')) $n++;
    if (isset($data['SectionF']['F0500C']) && ($data['SectionF']['F0500C'] == '4' || $data['SectionF']['F0500C'] == '5')) $n++;
    if (isset($data['SectionF']['F0500D']) && ($data['SectionF']['F0500D'] == '4' || $data['SectionF']['F0500D'] == '5')) $n++;
    if (isset($data['SectionF']['F0500E']) && ($data['SectionF']['F0500E'] == '4' || $data['SectionF']['F0500E'] == '5')) $n++;
    if (isset($data['SectionF']['F0500F']) && ($data['SectionF']['F0500F'] == '4' || $data['SectionF']['F0500F'] == '5')) $n++;
    if (isset($data['SectionF']['F0500G']) && ($data['SectionF']['F0500G'] == '4' || $data['SectionF']['F0500G'] == '5')) $n++;
    if (isset($data['SectionF']['F0500H']) && ($data['SectionF']['F0500H'] == '4' || $data['SectionF']['F0500H'] == '5')) $n++;
    if ($n >= 6) {
      $data['SectionV']['V0200A10A'] = 1;
    } 
    // Trigger on Condition 4;
    // Count number of F0800L through F0800T not checked;
    $n = '0';
    if (isset($data['SectionF']['F0800L']) && $data['SectionF']['F0800L'] == '0') $n++;
    if (isset($data['SectionF']['F0800M']) && $data['SectionF']['F0800M'] == '0') $n++;
    if (isset($data['SectionF']['F0800N']) && $data['SectionF']['F0800N'] == '0') $n++;
    if (isset($data['SectionF']['F0800O']) && $data['SectionF']['F0800O'] == '0') $n++;
    if (isset($data['SectionF']['F0800P']) && $data['SectionF']['F0800P'] == '0') $n++;
    if (isset($data['SectionF']['F0800Q']) && $data['SectionF']['F0800Q'] == '0') $n++;
    if (isset($data['SectionF']['F0800R']) && $data['SectionF']['F0800R'] == '0') $n++;
    if (isset($data['SectionF']['F0800S']) && $data['SectionF']['F0800S'] == '0') $n++;
    if (isset($data['SectionF']['F0800T']) && $data['SectionF']['F0800T'] == '0') $n++;
    if ($n >= 6) {
      $data['SectionV']['V0200A10A'] = 1;
    }
    
    return $data;
  }
	
	public function cat10Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;10&nbsp;Activities</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if (isset($data['SectionD']['D0200A1']) && $data['SectionD']['D0200A1'] == '1') {
      $reason .= 	'<li>Resident has little interest or pleasure in doing things as indicated by:<br /><br /><b>D0200A1 = 1</b><br /><br /></li>';
    }  
    // Trigger on Condition 2;
    if (isset($data['SectionD']['D0500A1']) && $data['SectionD']['D0500A1'] == '1') {
      $reason .= 	'<li>Staff assessment of resident mood suggests resident states little interest or pleasure in doing things as indicated by:<br /><br /><b>D0500A1 = 1</b><br /><br /></li>';
    }  
    // Trigger on Condition 3;
    // Count number of F0500 items = '4' or 5;
    $n = '0';
    if (isset($data['SectionF']['F0500A']) && ($data['SectionF']['F0500A'] == '4' || $data['SectionF']['F0500A'] == '5')) $n++;
    if (isset($data['SectionF']['F0500B']) && ($data['SectionF']['F0500B'] == '4' || $data['SectionF']['F0500B'] == '5')) $n++;
    if (isset($data['SectionF']['F0500C']) && ($data['SectionF']['F0500C'] == '4' || $data['SectionF']['F0500C'] == '5')) $n++;
    if (isset($data['SectionF']['F0500D']) && ($data['SectionF']['F0500D'] == '4' || $data['SectionF']['F0500D'] == '5')) $n++;
    if (isset($data['SectionF']['F0500E']) && ($data['SectionF']['F0500E'] == '4' || $data['SectionF']['F0500E'] == '5')) $n++;
    if (isset($data['SectionF']['F0500F']) && ($data['SectionF']['F0500F'] == '4' || $data['SectionF']['F0500F'] == '5')) $n++;
    if (isset($data['SectionF']['F0500G']) && ($data['SectionF']['F0500G'] == '4' || $data['SectionF']['F0500G'] == '5')) $n++;
    if (isset($data['SectionF']['F0500H']) && ($data['SectionF']['F0500H'] == '4' || $data['SectionF']['F0500H'] == '5')) $n++;
    if ($n >= 6) {
      $reason .= 	'<li>Any 6 items for interview for acitivity preferences has the value of 4 (not important at all) or 5 (important, but cannot do or no choice) as indicated by:<br /><br /><b>Any 6 of F0500A through F0500H = 4 or 5</b><br /><br /></li>';
    } 
    // Trigger on Condition 4;
    // Count number of F0800L through F0800T not checked;
    $n = '0';
    if (isset($data['SectionF']['F0800L']) && $data['SectionF']['F0800L'] == '0') $n++;
    if (isset($data['SectionF']['F0800M']) && $data['SectionF']['F0800M'] == '0') $n++;
    if (isset($data['SectionF']['F0800N']) && $data['SectionF']['F0800N'] == '0') $n++;
    if (isset($data['SectionF']['F0800O']) && $data['SectionF']['F0800O'] == '0') $n++;
    if (isset($data['SectionF']['F0800P']) && $data['SectionF']['F0800P'] == '0') $n++;
    if (isset($data['SectionF']['F0800Q']) && $data['SectionF']['F0800Q'] == '0') $n++;
    if (isset($data['SectionF']['F0800R']) && $data['SectionF']['F0800R'] == '0') $n++;
    if (isset($data['SectionF']['F0800S']) && $data['SectionF']['F0800S'] == '0') $n++;
    if (isset($data['SectionF']['F0800T']) && $data['SectionF']['F0800T'] == '0') $n++;
    if ($n >= 6) {
      $reason .= 	'<li>Any 6 items for staff assessment of activity preference item L through T are not checked as indicated by:<br /><br /><b>Any 6 of F0800L through F0800T = Not Checked</b><br /><br /></li>';
    }
			
		return $reason;
 }
  
  protected function __cat11($data) {

    // set variables for trigger
    if (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] != '') $A0310A = $data['SectionA']['A0310A']; else $A0310A = '';
    if (isset($data['SectionE']['E0900'])  && $data['SectionE']['E0900']  != '') $E0900  = $data['SectionE']['E0900'];  else $E0900  = '';
    if (isset($data['SectionG']['G0300A']) && $data['SectionG']['G0300A'] != '') $G0300A = $data['SectionG']['G0300A']; else $G0300A = '';
    if (isset($data['SectionG']['G0300B']) && $data['SectionG']['G0300B'] != '') $G0300B = $data['SectionG']['G0300B']; else $G0300B = '';
    if (isset($data['SectionG']['G0300C']) && $data['SectionG']['G0300C'] != '') $G0300C = $data['SectionG']['G0300C']; else $G0300C = '';
    if (isset($data['SectionG']['G0300D']) && $data['SectionG']['G0300D'] != '') $G0300D = $data['SectionG']['G0300D']; else $G0300D = '';
    if (isset($data['SectionG']['G0300E']) && $data['SectionG']['G0300E'] != '') $G0300E = $data['SectionG']['G0300E']; else $G0300E = '';
    if (isset($data['SectionJ']['J1700A']) && $data['SectionJ']['J1700A'] != '') $J1700A = $data['SectionJ']['J1700A']; else $J1700A = '';
    if (isset($data['SectionJ']['J1700B']) && $data['SectionJ']['J1700B'] != '') $J1700B = $data['SectionJ']['J1700B']; else $J1700B = '';
    if (isset($data['SectionJ']['J1800'])  && $data['SectionJ']['J1800']  != '') $J1800  = $data['SectionJ']['J1800'];  else $J1800  = '';
    if (isset($data['SectionN']['N0400C']) && $data['SectionN']['N0400C'] != '') $N0400C = $data['SectionN']['N0400C']; else $N0400C = '';
    if (isset($data['SectionN']['N0410B']) && $data['SectionN']['N0410B'] != '') $N0410B = $data['SectionN']['N0410B']; else $N0410B = '';
    if (isset($data['SectionN']['N0410C']) && $data['SectionN']['N0410C'] != '') $N0410C = $data['SectionN']['N0410C']; else $N0410C = '';
    if (isset($data['SectionP']['P0100B']) && $data['SectionP']['P0100B'] != '') $P0100B = $data['SectionP']['P0100B']; else $P0100B = '';
    if (isset($data['SectionP']['P0100E']) && $data['SectionP']['P0100E'] != '') $P0100E = $data['SectionP']['P0100E']; else $P0100E = '';

    if (isset($data['SectionN']['N0400B']) && $data['SectionN']['N0400B'] != '') $N0400B = $data['SectionN']['N0400B']; else $N0400B = '';

    // CAT11 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A11A'] = '0';
    // Trigger on Condition 1;
    if ($E0900 >= '1'  &&  $E0900 <= '3') $data['SectionV']['V0200A11A'] = '1';
    // Trigger on Condition 2;
    if (
      ($G0300A == '1'  ||  $G0300A == '2') ||
      ($G0300B == '1'  ||  $G0300B == '2') ||
      ($G0300C == '1'  ||  $G0300C == '2') ||
      ($G0300D == '1'  ||  $G0300D == '2') ||
      ($G0300E == '1'  ||  $G0300E == '2')
    ) $data['SectionV']['V0200A11A'] = '1';
    // Trigger on Condition 3;
    if ($A0310A == '01' && $J1700A == '1') $data['SectionV']['V0200A11A'] = '1';
    // Trigger on Condition 4;
    if ($A0310A == '01' && $J1700B == '1') $data['SectionV']['V0200A11A'] = '1';
    // Trigger on Condition 5;
    if ($J1800  == '1') $data['SectionV']['V0200A11A'] = '1';
    // Trigger on Condition 6;
    if ($N0400B == '1') $data['SectionV']['V0200A11A'] = '1';
    if ($N0410B >= '1'  && $N0410B <= '7') $data['SectionV']['V0200A11A'] = '1';
    // Trigger on Condition 7;
    if ($N0410C >= '1'  && $N0410C <= '7') $data['SectionV']['V0200A11A'] = '1';
    // Trigger on Condition 8;
    if ($P0100B == '1'  || $P0100B == '2') $data['SectionV']['V0200A11A'] = '1';
    // Trigger on Condition 9;
    if ($P0100E == '1'  || $P0100E == '2') $data['SectionV']['V0200A11A'] = '1';

    // Misc Triggger
    if ($N0400C  == '1') $data['SectionV']['V0200A11A'] = '1';

    return $data;
  }
	
	public function cat11Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;11&nbsp;Falls</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if (isset($data['SectionE']['E0900']) && $data['SectionE']['E0900'] >= '1' && $data['SectionE']['E0900'] <= '3') 
      $reason .= 	'<li>Wandering occurs as indicated by a value of 1 through 3 as follows:<br /><br /><b>E0900 >= 1 AND E0900 <= 3</b><br /><br /></li>';
    // Trigger on Condition 2;
    if (
      ((isset($data['SectionG']['G0300A']) && $data['SectionG']['G0300A'] == '1') || (isset($data['SectionG']['G0300A']) && $data['SectionG']['G0300A'] == '2')) || 
      ((isset($data['SectionG']['G0300B']) && $data['SectionG']['G0300B'] == '1') || (isset($data['SectionG']['G0300B']) && $data['SectionG']['G0300B'] == '2')) || 
      ((isset($data['SectionG']['G0300C']) && $data['SectionG']['G0300C'] == '1') || (isset($data['SectionG']['G0300C']) && $data['SectionG']['G0300C'] == '2')) || 
      ((isset($data['SectionG']['G0300D']) && $data['SectionG']['G0300D'] == '1') || (isset($data['SectionG']['G0300D']) && $data['SectionG']['G0300D'] == '2')) || 
      ((isset($data['SectionG']['G0300E']) && $data['SectionG']['G0300E'] == '1') || (isset($data['SectionG']['G0300E']) && $data['SectionG']['G0300E'] == '2'))
    ) 
      $reason .= 	'<li>Balance problems during transition indicated by a value of 1 or 2 for any item as follows:<br /><br /><b>(G0300A = 1 OR G0300A = 2) OR<br />(G0300B = 1 OR G0300B = 2) OR<br />(G0300C = 1 OR G0300C = 2) OR<br />(G0300D = 1 OR G0300D = 2) OR<br />(G0300E = 1 OR G0300E = 2) OR</b><br /><br /></li>';
    // Trigger on Condition 3;
    if (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] == '01' && isset($data['SectionJ']['J1700A']) && $data['SectionJ']['J1700A'] == '1') 
      $reason .= 	'<li>For OBRA admission assessment: fall history at admission indicates resident fell anytime in the last month prior to admission as indicated by:<br /><br /><b>A0310A = 01 AND J1700A = 1</b><br /><br /></li>';
    // Trigger on Condition 4;
    if (isset($data['SectionA']['A0310A']) && $data['SectionA']['A0310A'] == '01' && isset($data['SectionJ']['J1700B']) && $data['SectionJ']['J1700B'] == '1') 
      $reason .= 	'<li>For OBRA admission assessment: fall history at admission indicates resident fell anytime in the last 2 to 6 months prior to admission as indicated by:<br /><br /><b>A0310A = 01 AND J1700A = 1</b><br /><br /></li>';
    // Trigger on Condition 5;
    if (isset($data['SectionJ']['J1800']) && $data['SectionJ']['J1800'] == '1') 
     	$reason .= 	'<li>Resident has fallen at least one time since admission or the prior assessment as indicated by:<br /><br /><b>J1800 = 1</b><br /><br /></li>';
    // Trigger on Condition 6;
    if (isset($data['SectionN']['N0400B']) && $data['SectionN']['N0400B'] == '1') 
      $reason .= 	'<li>Resident received antianxiety medication during the last 7 days or since admission/reentry if less than 7 days as indicated by:<br /><br /><b>N0400B = 1</b><br /><br /></li>';
    // Trigger on Condition 7;
    if (isset($data['SectionN']['N0400C']) && $data['SectionN']['N0400C'] == '1') 
      $reason .= 	'<li>Resident received antidepresssant medication during the last 7 days or since admission/reentry if less than 7 days as indicated by:<br /><br /><b>N0400B = 2</b><br /><br /></li>';
    
    // Trigger on Condition 8;
    if ((isset($data['SectionP']['P0100B']) && $data['SectionP']['P0100B'] == '1') || (isset($data['SectionP']['P0100B']) && $data['SectionP']['P0100B'] == '2')) 
      $reason .= 	'<li>Trunk restraint used in bed as indicated by a value 1 or 2 as follows:<br /><br /><b>P0100B = 1 OR P0100B = 2</b><br /><br /></li>';
    // Trigger on Condition 9;
    if ((isset($data['SectionP']['P0100E']) && $data['SectionP']['P0100E'] == '1') || (isset($data['SectionP']['P0100E']) && $data['SectionP']['P0100E'] == '2')) 
      $reason .= 	'<li>Trunk restraint used in chair or out of bed as indicated by a value 1 or 2 as follows:<br /><br /><b>P0100E = 1 OR P0100E = 2</b><br /><br /></li>';
			
		return $reason;
 }
  
  protected function __cat12($data) {

    if (isset($data['SectionJ']['J1550C']) && $data['SectionJ']['J1550C'] != '') $J1550C = $data['SectionJ']['J1550C']; else $J1550C = '';
    if (isset($data['SectionK']['K0200A']) && $data['SectionK']['K0200A'] != '') $K0200A = $data['SectionK']['K0200A']; else $K0200A = '';
    if (isset($data['SectionK']['K0200B']) && $data['SectionK']['K0200B'] != '') $K0200B = $data['SectionK']['K0200B']; else $K0200B = '';
    if (isset($data['SectionK']['K0300']) && $data['SectionK']['K0300'] != '') $K0300 = $data['SectionK']['K0300']; else $K0300 = '';
    if (isset($data['SectionK']['K0310']) && $data['SectionK']['K0310'] != '') $K0310 = $data['SectionK']['K0310']; else $K0310 = '';
    if (isset($data['SectionK']['K0510A1']) && $data['SectionK']['K0510A1'] != '') $K0510A1 = $data['SectionK']['K0510A1']; else $K0510A1 = '';
    if (isset($data['SectionK']['K0510A2']) && $data['SectionK']['K0510A2'] != '') $K0510A2 = $data['SectionK']['K0510A2']; else $K0510A2 = '';
    if (isset($data['SectionK']['K0510C1']) && $data['SectionK']['K0510C1'] != '') $K0510C1 = $data['SectionK']['K0510C1']; else $K0510C1 = '';
    if (isset($data['SectionK']['K0510C2']) && $data['SectionK']['K0510C2'] != '') $K0510C2 = $data['SectionK']['K0510C2']; else $K0510C2 = '';
    if (isset($data['SectionK']['K0510D1']) && $data['SectionK']['K0510D1'] != '') $K0510D1 = $data['SectionK']['K0510D1']; else $K0510D1 = '';
    if (isset($data['SectionK']['K0510D2']) && $data['SectionK']['K0510D2'] != '') $K0510D2 = $data['SectionK']['K0510D2']; else $K0510D2 = '';
    if (isset($data['SectionK']['K0500A']) && $data['SectionK']['K0500A'] != '') $K0500A = $data['SectionK']['K0500A']; else $K0500A = '';
    if (isset($data['SectionK']['K0500C']) && $data['SectionK']['K0500C'] != '') $K0500C = $data['SectionK']['K0500C']; else $K0500C = '';
    if (isset($data['SectionK']['K0500D']) && $data['SectionK']['K0500D'] != '') $K0500D = $data['SectionK']['K0500D']; else $K0500D = '';
    if (isset($data['SectionM']['M0300B1']) && $data['SectionM']['M0300B1'] != '') $M0300B1 = $data['SectionM']['M0300B1']; else $M0300B1 = '';
    if (isset($data['SectionM']['M0300C1']) && $data['SectionM']['M0300C1'] != '') $M0300C1 = $data['SectionM']['M0300C1']; else $M0300C1 = '';
    if (isset($data['SectionM']['M0300D1']) && $data['SectionM']['M0300D1'] != '') $M0300D1 = $data['SectionM']['M0300D1']; else $M0300D1 = '';
    if (isset($data['SectionM']['M0300E1']) && $data['SectionM']['M0300E1'] != '') $M0300E1 = $data['SectionM']['M0300E1']; else $M0300E1 = '';
    if (isset($data['SectionM']['M0300F1']) && $data['SectionM']['M0300F1'] != '') $M0300F1 = $data['SectionM']['M0300F1']; else $M0300F1 = '';
    if (isset($data['SectionM']['M0300G1']) && $data['SectionM']['M0300G1'] != '') $M0300G1 = $data['SectionM']['M0300G1']; else $M0300G1 = '';

    // CAT12 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A12A'] = '0';
    // Trigger on Condition 1;
    if ($J1550C == '1') $data['SectionV']['V0200A12A'] = '1';
    // Trigger on Condition 2;
    // Set BMI to 20 (will not trigger) if K0200A or K0200B missing;
    //  else calculate actual value;

    if ($K0200A > 0 && $K0200B > 0) $BMI = ($K0200B * 703) / ($K0200A * $K0200A);
    else $BMI = 20;

    // Trigger on BMIl (do not round value to a single decimal place);
    if ($BMI < '18.5000' OR $BMI > '24.9000') $data['SectionV']['V0200A12A'] = '1';

    // Trigger on Condition 3;
    if ($K0300 == '1' OR $K0300 == '2') $data['SectionV']['V0200A12A'] = '1';
    // Trigger on Condition 4;
    if ($K0310 == '1' || $K0310 == '2') $data['SectionV']['V0200A12A'] = '1';
    // Trigger on Condition 5;
    if ($K0500A == '1') $data['SectionV']['V0200A12A'] = '1';
    if ($K0510A1 == '1' || $K0510A2 == '1') $data['SectionV']['V0200A12A'] = '1';
    // Trigger on Condition 6;
    if ($K0500C == '1') $data['SectionV']['V0200A12A'] = '1';
    if ($K0510C1 == '1' || $K0510C2 == '1') $data['SectionV']['V0200A12A'] = '1';
    // Trigger on Condition 7;
    if ($K0500D == '1') $data['SectionV']['V0200A12A'] = '1';
    if ($K0510D1 == '1' || $K0510D2 == '1') $data['SectionV']['V0200A12A'] = '1';
    // Trigger on Condition 8;
    if (
      ($M0300B1 > 0 AND $M0300B1 <= 9) OR
      ($M0300C1 > 0 AND $M0300C1 <= 9) OR
      ($M0300D1 > 0 AND $M0300D1 <= 9) OR
      ($M0300E1 > 0 AND $M0300E1 <= 9) OR
      ($M0300F1 > 0 AND $M0300F1 <= 9) OR
      ($M0300G1 > 0 AND $M0300G1 <= 9)
    )
      $data['SectionV']['V0200A12A'] = '1';
    
    return $data;
  }
	
	public function cat12Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);

    if (isset($data['SectionJ']['J1550C']) && $data['SectionJ']['J1550C'] != '') $J1550C = $data['SectionJ']['J1550C']; else $J1550C = '';
    if (isset($data['SectionK']['K0200A']) && $data['SectionK']['K0200A'] != '') $K0200A = $data['SectionK']['K0200A']; else $K0200A = '';
    if (isset($data['SectionK']['K0200B']) && $data['SectionK']['K0200B'] != '') $K0200B = $data['SectionK']['K0200B']; else $K0200B = '';
    if (isset($data['SectionK']['K0300']) && $data['SectionK']['K0300'] != '') $K0300 = $data['SectionK']['K0300']; else $K0300 = '';
    if (isset($data['SectionK']['K0310']) && $data['SectionK']['K0310'] != '') $K0310 = $data['SectionK']['K0310']; else $K0310 = '';
    if (isset($data['SectionK']['K0510A1']) && $data['SectionK']['K0510A1'] != '') $K0510A1 = $data['SectionK']['K0510A1']; else $K0510A1 = '';
    if (isset($data['SectionK']['K0510A2']) && $data['SectionK']['K0510A2'] != '') $K0510A2 = $data['SectionK']['K0510A2']; else $K0510A2 = '';
    if (isset($data['SectionK']['K0510C1']) && $data['SectionK']['K0510C1'] != '') $K0510C1 = $data['SectionK']['K0510C1']; else $K0510C1 = '';
    if (isset($data['SectionK']['K0510C2']) && $data['SectionK']['K0510C2'] != '') $K0510C2 = $data['SectionK']['K0510C2']; else $K0510C2 = '';
    if (isset($data['SectionK']['K0510D1']) && $data['SectionK']['K0510D1'] != '') $K0510D1 = $data['SectionK']['K0510D1']; else $K0510D1 = '';
    if (isset($data['SectionK']['K0510D2']) && $data['SectionK']['K0510D2'] != '') $K0510D2 = $data['SectionK']['K0510D2']; else $K0510D2 = '';
    if (isset($data['SectionK']['K0500A']) && $data['SectionK']['K0500A'] != '') $K0500A = $data['SectionK']['K0500A']; else $K0500A = '';
    if (isset($data['SectionK']['K0500C']) && $data['SectionK']['K0500C'] != '') $K0500C = $data['SectionK']['K0500C']; else $K0500C = '';
    if (isset($data['SectionK']['K0500D']) && $data['SectionK']['K0500D'] != '') $K0500D = $data['SectionK']['K0500D']; else $K0500D = '';
    if (isset($data['SectionM']['M0300B1']) && $data['SectionM']['M0300B1'] != '') $M0300B1 = $data['SectionM']['M0300B1']; else $M0300B1 = '';
    if (isset($data['SectionM']['M0300C1']) && $data['SectionM']['M0300C1'] != '') $M0300C1 = $data['SectionM']['M0300C1']; else $M0300C1 = '';
    if (isset($data['SectionM']['M0300D1']) && $data['SectionM']['M0300D1'] != '') $M0300D1 = $data['SectionM']['M0300D1']; else $M0300D1 = '';
    if (isset($data['SectionM']['M0300E1']) && $data['SectionM']['M0300E1'] != '') $M0300E1 = $data['SectionM']['M0300E1']; else $M0300E1 = '';
    if (isset($data['SectionM']['M0300F1']) && $data['SectionM']['M0300F1'] != '') $M0300F1 = $data['SectionM']['M0300F1']; else $M0300F1 = '';
    if (isset($data['SectionM']['M0300G1']) && $data['SectionM']['M0300G1'] != '') $M0300G1 = $data['SectionM']['M0300G1']; else $M0300G1 = '';
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;12&nbsp;Nutritional&nbsp;Status</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if ($J1550C == '1')
       $reason .= 	'<li>Dehydration is selected as a problem health condition as indicated by:<br /><br /><b>J1550C = 1</b><br /><br /></li>';
    // Trigger on Condition 2;
    // Set BMI to 20 (will not trigger) if K0200A or K0200B missing;
    //  else calculate actual value;
    if ($K0200A > 0 && $K0200B > 0) $BMI = ($K0200B * 703) / ($K0200A * $K0200A);
    else $BMI = 20;

    // Trigger on BMIl (do not round value to a single decimal place);
    if ($BMI < '18.5000' OR $BMI > '24.9000')
      $reason .= 	'<li>Body mass index (BMI) is too low or too high as indicated by:<br /><br /><b>BMI < 18.5 OR BMI > 24.9</b><br /><br /></li>';

    // Trigger on Condition 3;
    if ($K0300 == '1' OR $K0300 == '2')
     $reason .= 	'<li>Any weight loss as indicated by a value of 1 or 2 as follows:<br /><br /><b>K0300 = 1 OR K0300 = 2</b><br /><br /></li>';
		
    if ($K0310 == '1' || $K0310 == '2')
      $reason .= '<li>Bleh</li>';

    // Trigger on Condition 4;
    if ($K0500A == '1')
      $reason .=  '<li>Parenteral/IV feeding is used as nutritional approach as indicated by:<br /><br /><b>K0500A = 1</b><br /><br /></li>';
    if ($K0510A1 == '1')
      $reason .=  '<li>Parenteral/IV feeding is used as nutritional approach as indicated by:<br /><br /><b>K0510A1 = 1</b><br /><br /></li>';
    if ($K0510A2 == '1')
      $reason .=  '<li>Parenteral/IV feeding is used as nutritional approach as indicated by:<br /><br /><b>K0510A2 = 1</b><br /><br /></li>';

    // Trigger on Condition 5;
    if ($K0500C == '1')
      $reason .=  '<li>Mechanically altered diet is used as nutritional approach as indicated by:<br /><br /><b>K0500C = 1</b><br /><br /></li>';
    if ($K0510C1 == '1')
      $reason .=  '<li>Mechanically altered diet is used as nutritional approach as indicated by:<br /><br /><b>K0500C = 1</b><br /><br /></li>';
    if ($K0510C2 == '1')
      $reason .=  '<li>Mechanically altered diet is used as nutritional approach as indicated by:<br /><br /><b>K0500C = 1</b><br /><br /></li>';

    // Trigger on Condition 6;
    if ($K0500D == '1')
      $reason .=  '<li>Therapeutic diet is used as nutritional approach as indicated by:<br /><br /><b>K0500D = 1</b><br /><br /></li>';
    if ($K0510D1 == '1')
      $reason .=  '<li>Therapeutic diet is used as nutritional approach as indicated by:<br /><br /><b>K0500D = 1</b><br /><br /></li>';
    if ($K0510D2 == '1')
      $reason .=  '<li>Therapeutic diet is used as nutritional approach as indicated by:<br /><br /><b>K0500D = 1</b><br /><br /></li>';

    // Trigger on Condition 7;
    if (
      ($M0300B1 > 0 AND $M0300B1 <= 9) OR
      ($M0300C1 > 0 AND $M0300C1 <= 9) OR
      ($M0300D1 > 0 AND $M0300D1 <= 9) OR
      ($M0300E1 > 0 AND $M0300E1 <= 9) OR
      ($M0300F1 > 0 AND $M0300F1 <= 9) OR
      ($M0300G1 > 0 AND $M0300G1 <= 9)
    )
      $reason .= 	'<li>Resident has one or more unhealed pressure ulcers(s) at Stage 2 or higher, or one or more likely pressure ulcers that are unstageable at this time as indicated by:<br /><br /><b>((M0300B1 > 0 AND M0300B1 <= 9) OR<br />(M0300C1 > 0 AND M0300C1 <= 9) OR<br />(M0300D1 > 0 AND M0300D1 <= 9) OR<br />(M0300E1 > 0 AND M0300E1 <= 9) OR<br />(M0300F1 > 0 AND M0300F1 <= 9) OR<br />(M0300G1 > 0 AND M0300G1 <= 9) OR<br /></b><br /><br /></li>';
			
		return $reason;
 }
  
  protected function __cat13($data) {
    // CAT13 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A13A'] = '0';
    // Trigger on Condition 1;
    if (@$data['SectionK']['K0510B2'] == '1') 
      $data['SectionV']['V0200A13A'] = 1;
    
    return $data;
  }
	
	public function cat13Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;13&nbsp;Feeding&nbsp;Tubes</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if (isset($data['SectionK']['K0500B']) && $data['SectionK']['K0500B'] == '1') 
      $reason .= 	'<li>Feeding tube is used as nutritional approach as indicated by:<br /><br /><b>K0500B = 1</b><br /><br /></li>';
			
		return $reason;
 }
  
  protected function __cat14($data) {

    if (isset($data['SectionJ']['J1550A']) && $data['SectionJ']['J1550A'] != '') $J1550A = $data['SectionJ']['J1550A']; else $J1550A = '';
    if (isset($data['SectionJ']['J1550B']) && $data['SectionJ']['J1550B'] != '') $J1550B = $data['SectionJ']['J1550B']; else $J1550B = '';
    if (isset($data['SectionJ']['J1550C']) && $data['SectionJ']['J1550C'] != '') $J1550C = $data['SectionJ']['J1550C']; else $J1550C = '';
    if (isset($data['SectionJ']['J1550D']) && $data['SectionJ']['J1550D'] != '') $J1550D = $data['SectionJ']['J1550D']; else $J1550D = '';

    if (isset($data['SectionI']['I1700']) && $data['SectionI']['I1700'] != '') $I1700 = $data['SectionI']['I1700']; else $I1700 = '';
    if (isset($data['SectionI']['I2000']) && $data['SectionI']['I2000'] != '') $I2000 = $data['SectionI']['I2000']; else $I2000 = '';
    if (isset($data['SectionI']['I2100']) && $data['SectionI']['I2100'] != '') $I2100 = $data['SectionI']['I2100']; else $I2100 = '';
    if (isset($data['SectionI']['I2200']) && $data['SectionI']['I2200'] != '') $I2200 = $data['SectionI']['I2200']; else $I2200 = '';
    if (isset($data['SectionI']['I2300']) && $data['SectionI']['I2300'] != '') $I2300 = $data['SectionI']['I2300']; else $I2300 = '';
    if (isset($data['SectionI']['I2400']) && $data['SectionI']['I2400'] != '') $I2400 = $data['SectionI']['I2400']; else $I2400 = '';
    if (isset($data['SectionI']['I2500']) && $data['SectionI']['I2500'] != '') $I2500 = $data['SectionI']['I2500']; else $I2500 = '';

    if (isset($data['SectionH']['H0600']) && $data['SectionH']['H0600'] != '') $H0600 = $data['SectionH']['H0600']; else $H0600 = '';

    if (isset($data['SectionM']['M1040A']) && $data['SectionM']['M1040A'] != '') $M1040A = $data['SectionM']['M1040A']; else $M1040A = '';

    if (isset($data['SectionK']['K0510A1']) && $data['SectionK']['K0510A1'] != '') $K0510A1 = $data['SectionK']['K0510A1']; else $K0510A1 = '';
    if (isset($data['SectionK']['K0510A2']) && $data['SectionK']['K0510A2'] != '') $K0510A2 = $data['SectionK']['K0510A2']; else $K0510A2 = '';
    if (isset($data['SectionK']['K0510B1']) && $data['SectionK']['K0510B1'] != '') $K0510B1 = $data['SectionK']['K0510B1']; else $K0510B1 = '';
    if (isset($data['SectionK']['K0510B2']) && $data['SectionK']['K0510B2'] != '') $K0510B2 = $data['SectionK']['K0510B2']; else $K0510B2 = '';

    // CAT14 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A14A'] = '0';
    // Trigger on Condition 1;
    if ($J1550A == '1') $data['SectionV']['V0200A14A'] = '1';
    // Trigger on Condition 2;
    if ($J1550B == '1') $data['SectionV']['V0200A14A'] = '1';
    // Trigger on Condition 3;
    if ($J1550C == '1') $data['SectionV']['V0200A14A'] = '1';
    // Trigger on Condition 4;
    if ($J1550D == '1') $data['SectionV']['V0200A14A'] = '1';
    // Trigger on Condition 5;
    if (
      $I1700 == '1' OR $I2000 == '1' OR $I2100 == '1' OR $I2200 == '1' OR
      $I2300 == '1' OR $I2400 == '1' OR $I2500 == '1' OR $M1040A == '1'
    )
      $data['SectionV']['V0200A14A'] = '1';
    // Trigger on Condition 6;
    if ($H0600 == '1') $data['SectionV']['V0200A14A'] = '1';
    // Trigger on Condition 7;
    if ($K0510A1 == '1' OR $K0510A2 == '1') $data['SectionV']['V0200A14A'] = '1';
    // Trigger on Condition 8;
    if ($K0510B1 == '1' OR $K0510B2 == '1') $data['SectionV']['V0200A14A'] = '1';
    
    return $data;
  }
	
	public function cat14Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;14&nbsp;Dehydration/Fluid&nbsp;Maintenance</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if (isset($data['SectionJ']['J1550A']) && $data['SectionJ']['J1550A'] == '1') {
      $reason .= 	'<li>Fever is selected as a problem health condition as indicated by:<br /><br /><b>J1550A = 1</b><br /><br /></li>';
    }
    // Trigger on Condition 2;
    if (isset($data['SectionJ']['J1550B']) && $data['SectionJ']['J1550B'] == '1') {
      $reason .= 	'<li>Vomiting is selected as a problem health condition as indicated by:<br /><br /><b>J1550B = 1</b><br /><br /></li>';
    }
    // Trigger on Condition 3;
    if (isset($data['SectionJ']['J1550C']) && $data['SectionJ']['J1550C'] == '1') {
      $reason .= 	'<li>Dehydration is selected as a problem health condition as indicated by:<br /><br /><b>J1550C = 1</b><br /><br /></li>';
    }
    // Trigger on Condition 4;
    if (isset($data['SectionJ']['J1550D']) && $data['SectionJ']['J1550D'] == '1') {
      $reason .= 	'<li>Internal bleeding is selected as a problem health condition as indicated by:<br /><br /><b>J1550D = 1</b><br /><br /></li>';
    }
      
    // Trigger on Condition 5;
    if
    (
      (isset($data['SectionI']['I1700']) && $data['SectionI']['I1700'] == '1') || 
      (isset($data['SectionI']['I2000']) && $data['SectionI']['I2000'] == '1') || 
      (isset($data['SectionI']['I2100']) && $data['SectionI']['I2100'] == '1') || 
      (isset($data['SectionI']['I2200']) && $data['SectionI']['I2200'] == '1') || 
      (isset($data['SectionI']['I2300']) && $data['SectionI']['I2300'] == '1') || 
      (isset($data['SectionI']['I2400']) && $data['SectionI']['I2400'] == '1') || 
      (isset($data['SectionI']['I2500']) && $data['SectionI']['I2500'] == '1') || 
      (isset($data['SectionM']['M1040A']) && $data['SectionM']['M1040A'] == '1')
    )
      $reason .= 	'<li>Infection present as indicated by:<br /><br /><b>(I1700 = 1) OR<br />(I2000 = 1) OR<br />(I2100 = 1) OR<br />(I2200 = 1) OR<br />(I2300 = 1) OR<br />(I2400 = 1) OR<br />(I2500 = 1) OR<br />((M1040A = 1)) OR<br /></b><br /><br /></li>';
    
    // Trigger on Condition 6;
    if (isset($data['SectionH']['H0600']) && $data['SectionH']['H0600'] == '1') {
      $reason .= 	'<li>Constipation present as indicated by:<br /><br /><b>H0600 = 1</b><br /><br /></li>';
    }
    // Trigger on Condition 7;
    if (isset($data['SectionK']['K0500A']) && $data['SectionK']['K0500A'] == '1') {
      $reason .= 	'<li>Parenteral/IV feeding is used as nutritional approach as indicated by:<br /><br /><b>K0500A = 1</b><br /><br /></li>';
    }
    // Trigger on Condition 8;
    if (isset($data['SectionK']['K0500B']) && $data['SectionK']['K0500B'] == '1') {
      $reason .= 	'<li>Feeding tube is used as nutritional approach as indicated by:<br /><br /><b>K0500B = 1</b><br /><br /></li>';
    }
			
		return $reason;
 }
  
  protected function __cat15($data) {

    // CAT15 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A15A'] = '0';
    // Trigger on Condition 1;
    if (
      (isset($data['SectionL']['L0200A']) && $data['SectionL']['L0200A'] == '1') || 
      (isset($data['SectionL']['L0200B']) && $data['SectionL']['L0200B'] == '1') || 
      (isset($data['SectionL']['L0200C']) && $data['SectionL']['L0200C'] == '1') || 
      (isset($data['SectionL']['L0200D']) && $data['SectionL']['L0200D'] == '1') ||  
      (isset($data['SectionL']['L0200E']) && $data['SectionL']['L0200E'] == '1') || 
      (isset($data['SectionL']['L0200F']) && $data['SectionL']['L0200F'] == '1')) 
      $data['SectionV']['V0200A15A'] = 1;
    
    return $data;
  }
	
	public function cat15Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;15&nbsp;Dental&nbsp;Care</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if (
      (isset($data['SectionL']['L0200A']) && $data['SectionL']['L0200A'] == '1') || 
      (isset($data['SectionL']['L0200B']) && $data['SectionL']['L0200B'] == '1') || 
      (isset($data['SectionL']['L0200C']) && $data['SectionL']['L0200C'] == '1') || 
      (isset($data['SectionL']['L0200D']) && $data['SectionL']['L0200D'] == '1') ||  
      (isset($data['SectionL']['L0200E']) && $data['SectionL']['L0200E'] == '1') || 
      (isset($data['SectionL']['L0200F']) && $data['SectionL']['L0200F'] == '1')) 
      $reason .= 	'<li>Any dental problem indicated by:<br /><br /><b>(L0200A = 1) OR <br />(L0200B = 1) OR <br />(L0200C = 1) OR <br />(L0200D = 1) OR <br />(L0200E = 1) OR <br />(L0200F = 1)</b><br /><br /></li>';
			
		return $reason;
 }
  
  protected function __cat16($data) {
    // CAT16 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A16A'] = '0';
    // Trigger on Condition 1;
    if (
      (isset($data['SectionG']['G0110A1']) && $data['SectionG']['G0110A1'] >= '1' && $data['SectionG']['G0110A1'] <= '4') || 
      (
        (isset($data['SectionG']['G0110A1']) && $data['SectionG']['G0110A1'] == '7') || 
        (isset($data['SectionG']['G0110A1']) && $data['SectionG']['G0110A1'] == '8')
      )
    )
      $data['SectionV']['V0200A16A'] = 1;
    // Trigger on Condition 2;
    if ((isset($data['SectionH']['H0300']) && $data['SectionH']['H0300'] == '2') || (isset($data['SectionH']['H0300']) && $data['SectionH']['H0300'] == '3'))
      $data['SectionV']['V0200A16A'] = 1;
    // Trigger on Condition 3;
    if ((isset($data['SectionH']['H0400']) && $data['SectionH']['H0400'] == '2') || (isset($data['SectionH']['H0400']) && $data['SectionH']['H0400'] == '3'))
      $data['SectionV']['V0200A16A'] = 1;
    // Trigger on Condition 4;
    if (isset($data['SectionK']['K0300']) && $data['SectionK']['K0300'] == '2')
      $data['SectionV']['V0200A16A'] = 1;
    // Trigger on Condition 5;
    if (isset($data['SectionM']['M0150']) && $data['SectionM']['M0150'] == '1')
      $data['SectionV']['V0200A16A'] = 1;
    // Trigger on Condition 6;
    if (
      (isset($data['SectionM']['M0300B1']) && $data['SectionM']['M0300B1'] > '0' && $data['SectionM']['M0300B1'] <= '9') || 
      (isset($data['SectionM']['M0300C1']) && $data['SectionM']['M0300C1'] > '0' && $data['SectionM']['M0300C1'] <= '9' ) || 
      (isset($data['SectionM']['M0300D1']) && $data['SectionM']['M0300D1'] > '0' && $data['SectionM']['M0300D1'] <= '9') || 
      (isset($data['SectionM']['M0300E1']) && $data['SectionM']['M0300E1'] > '0' && $data['SectionM']['M0300E1'] <= '9') || 
      (isset($data['SectionM']['M0300F1']) && $data['SectionM']['M0300F1'] > '0' && $data['SectionM']['M0300F1'] <= '9') || 
      (isset($data['SectionM']['M0300G1']) && $data['SectionM']['M0300G1'] > '0' && $data['SectionM']['M0300G1'] <= '9')
    )
      $data['SectionV']['V0200A16A'] = 1;
    // Trigger on Condition 7;
    if (isset($data['SectionM']['M0300A']) && $data['SectionM']['M0300A'] > '0' && $data['SectionM']['M0300A'] <= '9')
      $data['SectionV']['V0200A16A'] = 1;
    // Trigger on Condition 8;
    if (
      (isset($data['SectionM']['M0800A']) && $data['SectionM']['M0800A'] > '0' && $data['SectionM']['M0800A'] <= '9') || 
      (isset($data['SectionM']['M0800B']) && $data['SectionM']['M0800B'] > '0' && $data['SectionM']['M0800B'] <= '9') || 
      (isset($data['SectionM']['M0800C']) && $data['SectionM']['M0800C'] > '0' && $data['SectionM']['M0800C'] <= '9')
    )
      $data['SectionV']['V0200A16A'] = 1;
    // Trigger on Condition 9;
    if ((isset($data['SectionP']['P0100B']) && $data['SectionP']['P0100B'] == '1') || (isset($data['SectionP']['P0100B']) && $data['SectionP']['P0100B'] == '2'))
      $data['SectionV']['V0200A16A'] = 1;
    // Trigger on Condition 10;
    if ((isset($data['SectionP']['P0100E']) && $data['SectionP']['P0100E'] == '1') || (isset($data['SectionP']['P0100E']) && $data['SectionP']['P0100E'] == '2'))
      $data['SectionV']['V0200A16A'] = 1;
    
    return $data;
  }

	public function cat16Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;16&nbsp;Pressure&nbsp;Ulcer</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if (
      (isset($data['SectionG']['G0110A1']) && $data['SectionG']['G0110A1'] >= '1' && $data['SectionG']['G0110A1'] <= '4') || 
      (
        (isset($data['SectionG']['G0110A1']) && $data['SectionG']['G0110A1'] == '7') || 
        (isset($data['SectionG']['G0110A1']) && $data['SectionG']['G0110A1'] == '8')
      )
    )
      $reason .= 	'<li>ADl assistance for bed mobility was needed, or activity did not occur, or acitivity only occurred once or twice as indicated by:<br /><br /><b>(G0110A1 >= 1 AND G0110A1 <= 4) OR<br />(G0110A1 = 7 OR G0110A1 = 8)</b><br /><br /></li>';
    // Trigger on Condition 2;
    if ((isset($data['SectionH']['H0300']) && $data['SectionH']['H0300'] == '2') || (isset($data['SectionH']['H0300']) && $data['SectionH']['H0300'] == '3'))
      $reason .= 	'<li>Frequent urinary incontinence as indicated by:<br /><br /><b>H0300 = 2 OR H0300 = 3</b><br /><br /></li>';
    // Trigger on Condition 3;
    if ((isset($data['SectionH']['H0400']) && $data['SectionH']['H0400'] == '2') || (isset($data['SectionH']['H0400']) && $data['SectionH']['H0400'] == '3'))
      $reason .= 	'<li>Frequent bowel continence as indicated by:<br /><br /><b>H0400 = 2 OR H0400 = 3</b><br /><br /></li>';
    // Trigger on Condition 4;
    if (isset($data['SectionK']['K0300']) && $data['SectionK']['K0300'] == '2')
      $reason .= 	'<li>Weight loss in the absence of physician-prescribed regimen as indicated by:<br /><br /><b>K0300 = 2</b><br /><br /></li>';
    // Trigger on Condition 5;
    if (isset($data['SectionM']['M0150']) && $data['SectionM']['M0150'] == '1')
      $reason .= 	'<li>Resident at risk for developing pressure ulcers as indicated by:<br /><br /><b>M0150 = 1</b><br /><br /></li>';
    // Trigger on Condition 6;
    if (
      (isset($data['SectionM']['M0300B1']) && $data['SectionM']['M0300B1'] > '0' && $data['SectionM']['M0300B1'] <= '9') || 
      (isset($data['SectionM']['M0300C1']) && $data['SectionM']['M0300C1'] > '0' && $data['SectionM']['M0300C1'] <= '9' ) || 
      (isset($data['SectionM']['M0300D1']) && $data['SectionM']['M0300D1'] > '0' && $data['SectionM']['M0300D1'] <= '9') || 
      (isset($data['SectionM']['M0300E1']) && $data['SectionM']['M0300E1'] > '0' && $data['SectionM']['M0300E1'] <= '9') || 
      (isset($data['SectionM']['M0300F1']) && $data['SectionM']['M0300F1'] > '0' && $data['SectionM']['M0300F1'] <= '9') || 
      (isset($data['SectionM']['M0300G1']) && $data['SectionM']['M0300G1'] > '0' && $data['SectionM']['M0300G1'] <= '9')
    )
      $reason .= 	'<li>Resident has one or more unhealed pressure ulcer(s) at Stage 2 or higher, or one or more likely pressure ulcers that are unstageable at this time as indicated by:<br /><br /><b>((M0300B1 > 0 AND M0300B1 <= 9) OR<br />(M0300C1 > 0 AND M0300C1 <= 9) OR<br />(M0300D1 > 0 AND M0300D1 <= 9) OR<br />(M0300E1 > 0 AND M0300E1 <= 9) OR<br />(M0300F1 > 0 AND M0300F1 <= 9) OR<br />(M0300G1 > 0 AND M0300G1 <= 9)) OR<br /></b><br /><br /></li>';
    // Trigger on Condition 7;
    if (isset($data['SectionM']['M0300A']) && $data['SectionM']['M0300A'] > '0' && $data['SectionM']['M0300A'] <= '9')
      $reason .= 	'<li>Resident has one or more unhealed pressure ulcer(s) at Stage 1 as indicated by:<br /><br /><b>M0300A > 0 AND M0300A <= 9</b><br /><br /></li>';
    // Trigger on Condition 8;
    if (
      (isset($data['SectionM']['M0800A']) && $data['SectionM']['M0800A'] > '0' && $data['SectionM']['M0800A'] <= '9') || 
      (isset($data['SectionM']['M0800B']) && $data['SectionM']['M0800B'] > '0' && $data['SectionM']['M0800B'] <= '9') || 
      (isset($data['SectionM']['M0800C']) && $data['SectionM']['M0800C'] > '0' && $data['SectionM']['M0800C'] <= '9')
    )
      $reason .= 	'<li>Resident has one or more pressure ulcer(s) that has gotten worse since prior assessment as indicated by:<br /><br /><b>(M0800A > 0 AND M0800A <= 9) OR<br />(M0800B > 0 AND M0800B <= 9) OR<br />(M0800C > 0 AND M0800C <= 9)</b><br /><br /></li>';
    // Trigger on Condition 9;
    if ((isset($data['SectionP']['P0100B']) && $data['SectionP']['P0100B'] == '1') || (isset($data['SectionP']['P0100B']) && $data['SectionP']['P0100B'] == '2'))
      $reason .= 	'<li>Trunk restraint used in bed has value of 1 or 2 as indicated by:<br /><br /><b>P0100B = 1 OR P0100B =2</b><br /><br /></li>';
    // Trigger on Condition 10;
    if ((isset($data['SectionP']['P0100E']) && $data['SectionP']['P0100E'] == '1') || (isset($data['SectionP']['P0100E']) && $data['SectionP']['P0100E'] == '2'))
      $reason .= 	'<li>Trunk restraint used in chair or out of bed has value of 1 or 2 as indicated by:<br /><br /><b>P0100E = 1 OR P0100E =2</b><br /><br /></li>';
						
		return $reason;
 }
	
  
  protected function __cat17($data) {

    if (isset($data['SectionN']['N0400A']) && $data['SectionN']['N0400A'] != '') $N0400A = $data['SectionN']['N0400A']; else $N0400A = '';
    if (isset($data['SectionN']['N0400B']) && $data['SectionN']['N0400B'] != '') $N0400B = $data['SectionN']['N0400B']; else $N0400B = '';
    if (isset($data['SectionN']['N0400C']) && $data['SectionN']['N0400C'] != '') $N0400C = $data['SectionN']['N0400C']; else $N0400C = '';
    if (isset($data['SectionN']['N0400D']) && $data['SectionN']['N0400D'] != '') $N0400D = $data['SectionN']['N0400D']; else $N0400D = '';

    if (isset($data['SectionN']['N0410A']) && $data['SectionN']['N0410A'] != '') $N0410A = $data['SectionN']['N0410A']; else $N0410A = '';
    if (isset($data['SectionN']['N0410B']) && $data['SectionN']['N0410B'] != '') $N0410B = $data['SectionN']['N0410B']; else $N0410B = '';
    if (isset($data['SectionN']['N0410C']) && $data['SectionN']['N0410C'] != '') $N0410C = $data['SectionN']['N0410C']; else $N0410C = '';
    if (isset($data['SectionN']['N0410D']) && $data['SectionN']['N0410D'] != '') $N0410D = $data['SectionN']['N0410D']; else $N0410D = '';
      
    // CAT17 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A17A'] = '0';
    // Trigger on Condition 1;
    if ($N0410A > 0) $data['SectionV']['V0200A17A'] = '1';
    // Trigger on Condition 2;
    if ($N0410B > 0) $data['SectionV']['V0200A17A'] = '1';
    // Trigger on Condition 3;
    if ($N0410C > 0) $data['SectionV']['V0200A17A'] = '1';
    // Trigger on Condition 4;
    if ($N0410D > 0) $data['SectionV']['V0200A17A'] = '1';

    return $data;
  }
	
	public function cat17Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;17&nbsp;Psychotropic&nbsp;Drug&nbsp;Use</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if (isset($data['SectionN']['N0400A']) && $data['SectionN']['N0400A'] == '1') 
      $reason .= 	'<li>Antipsychotic medication administered to resident in last 7 days or since admission as indicated by:<br /><br /><b>N0400A = 1</b><br /><br /></li>';
    // Trigger on Condition 2;
    if (isset($data['SectionN']['N0400B']) && $data['SectionN']['N0400B'] == '1') 
      $reason .= 	'<li>Antianxiety medication administered to resident in last 7 days or since admission as indicated by:<br /><br /><b>N0400B = 1</b><br /><br /></li>';
    // Trigger on Condition 3;
    if (isset($data['SectionN']['N0400C']) && $data['SectionN']['N0400C'] == '1') 
      $reason .= 	'<li>Antidepressant medication administered to resident in last 7 days or since admission as indicated by:<br /><br /><b>N0400C = 1</b><br /><br /></li>';
    // Trigger on Condition 4;
    if (isset($data['SectionN']['N0400D']) && $data['SectionN']['N0400D'] == '1') 
      $reason .= 	'<li>Hypnotic medication administered to resident in last 7 days or since admission as indicated by:<br /><br /><b>N0400D = 1</b><br /><br /></li>';
									
		return $reason;
 }
  
  protected function __cat18($data) {
    // CAT18 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A18A'] = '0';
    // Trigger on Condition 1;
    if ((isset($data['SectionP']['P0100A']) && $data['SectionP']['P0100A'] == '1') || (isset($data['SectionP']['P0100A']) && $data['SectionP']['P0100A'] == '2')) {
      $data['SectionV']['V0200A18A'] = 1;
    }
    // Trigger on Condition 2;
    if ((isset($data['SectionP']['P0100B']) && $data['SectionP']['P0100B'] == '1') || (isset($data['SectionP']['P0100B']) && $data['SectionP']['P0100B'] == '2')) {
      $data['SectionV']['V0200A18A'] = 1;
    }
    // Trigger on Condition 3;
    if ((isset($data['SectionP']['P0100C']) && $data['SectionP']['P0100C'] == '1') || (isset($data['SectionP']['P0100C']) && $data['SectionP']['P0100C'] == '2')) {
      $data['SectionV']['V0200A18A'] = 1;
    }
    // Trigger on Condition 4;
    if ((isset($data['SectionP']['P0100D']) && $data['SectionP']['P0100D'] == '1') || (isset($data['SectionP']['P0100D']) && $data['SectionP']['P0100D'] == '2')) {
      $data['SectionV']['V0200A18A'] = 1;
    }
    // Trigger on Condition 5;
    if ((isset($data['SectionP']['P0100E']) && $data['SectionP']['P0100E'] == '1') || (isset($data['SectionP']['P0100E']) && $data['SectionP']['P0100E'] == '2')) {
      $data['SectionV']['V0200A18A'] = 1;
    }
    // Trigger on Condition 6;
    if ((isset($data['SectionP']['P0100F']) && $data['SectionP']['P0100F'] == '1') || (isset($data['SectionP']['P0100F']) && $data['SectionP']['P0100F'] == '2')) {
      $data['SectionV']['V0200A18A'] = 1;
    }
    // Trigger on Condition 7;
    if ((isset($data['SectionP']['P0100G']) && $data['SectionP']['P0100G'] == '1') || (isset($data['SectionP']['P0100G']) && $data['SectionP']['P0100G'] == '2')) {
      $data['SectionV']['V0200A18A'] = 1;
    }
    // Trigger on Condition 8;
    if ((isset($data['SectionP']['P0100H']) && $data['SectionP']['P0100H'] == '1') || (isset($data['SectionP']['P0100H']) && $data['SectionP']['P0100H'] == '2')) {
      $data['SectionV']['V0200A18A'] = 1;
    }
    return $data;
  }

	public function cat18Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;18&nbsp;Physical&nbsp;Restraints</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if ((isset($data['SectionP']['P0100A']) && $data['SectionP']['P0100A'] == '1') || (isset($data['SectionP']['P0100A']) && $data['SectionP']['P0100A'] == '2')) {
      $reason .= 	'<li>Bed rail restraint used in bed has value of 1 or 2 as indicated by:<br /><br /><b>P0100A OR P0100A = 2</b><br /><br /></li>';
    }
    // Trigger on Condition 2;
    if ((isset($data['SectionP']['P0100B']) && $data['SectionP']['P0100B'] == '1') || (isset($data['SectionP']['P0100B']) && $data['SectionP']['P0100B'] == '2')) {
      $reason .= 	'<li>Trunk restraint used in bed has value of 1 or 2 as indicated by:<br /><br /><b>P0100B OR P0100B = 2</b><br /><br /></li>';
    }
    // Trigger on Condition 3;
    if ((isset($data['SectionP']['P0100C']) && $data['SectionP']['P0100C'] == '1') || (isset($data['SectionP']['P0100C']) && $data['SectionP']['P0100C'] == '2')) {
      $reason .= 	'<li>Limb restraint used in bed has value of 1 or 2 as indicated by:<br /><br /><b>P0100C OR P0100C = 2</b><br /><br /></li>';
    }
    // Trigger on Condition 4;
    if ((isset($data['SectionP']['P0100D']) && $data['SectionP']['P0100D'] == '1') || (isset($data['SectionP']['P0100D']) && $data['SectionP']['P0100D'] == '2')) {
      $reason .= 	'<li>Other restraint used in bed has value of 1 or 2 as indicated by:<br /><br /><b>P0100D OR P0100D = 2</b><br /><br /></li>';
    }
    // Trigger on Condition 5;
    if ((isset($data['SectionP']['P0100E']) && $data['SectionP']['P0100E'] == '1') || (isset($data['SectionP']['P0100E']) && $data['SectionP']['P0100E'] == '2')) {
      $reason .= 	'<li>Trunk restraint used in chair or out of bed has value of 1 or 2 as indicated by:<br /><br /><b>P0100E OR P0100E = 2</b><br /><br /></li>';
    }
    // Trigger on Condition 6;
    if ((isset($data['SectionP']['P0100F']) && $data['SectionP']['P0100F'] == '1') || (isset($data['SectionP']['P0100F']) && $data['SectionP']['P0100F'] == '2')) {
      $reason .= 	'<li>Limb restraint used in chair or out of bed has value of 1 or 2 as indicated by:<br /><br /><b>P0100F OR P0100F = 2</b><br /><br /></li>';
    }
    // Trigger on Condition 7;
    if ((isset($data['SectionP']['P0100G']) && $data['SectionP']['P0100G'] == '1') || (isset($data['SectionP']['P0100G']) && $data['SectionP']['P0100G'] == '2')) {
      $reason .= 	'<li>Chair restraint that prevents rising used in chair or out of bed has value of 1 or 2 as indicated by:<br /><br /><b>P0100G OR P0100G = 2</b><br /><br /></li>';
    }
    // Trigger on Condition 8;
    if ((isset($data['SectionP']['P0100H']) && $data['SectionP']['P0100H'] == '1') || (isset($data['SectionP']['P0100H']) && $data['SectionP']['P0100H'] == '2')) {
      $reason .= 	'<li>Other restraint used in chair or out of bed has value of 1 or 2 as indicated by:<br /><br /><b>P0100H OR P0100H = 2</b><br /><br /></li>';
    }
											
		return $reason;
 }  

  protected function __cat19($data) {

    if (isset($data['SectionJ']['J0400'])  && $data['SectionJ']['J0400']  != '') $J0400  = $data['SectionJ']['J0400'];  else $J0400  = '';
    if (isset($data['SectionJ']['J0500A']) && $data['SectionJ']['J0500A'] != '') $J0500A = $data['SectionJ']['J0500A']; else $J0500A = '';
    if (isset($data['SectionJ']['J0500B']) && $data['SectionJ']['J0500B'] != '') $J0500B = $data['SectionJ']['J0500B']; else $J0500B = '';
    if (isset($data['SectionJ']['J0600A']) && $data['SectionJ']['J0600A'] != '') $J0600A = $data['SectionJ']['J0600A']; else $J0600A = '';
    if (isset($data['SectionJ']['J0600B']) && $data['SectionJ']['J0600B'] != '') $J0600B = $data['SectionJ']['J0600B']; else $J0600B = '';

    if (isset($data['SectionJ']['J0800A']) && $data['SectionJ']['J0800A'] != '') $J0800A = $data['SectionJ']['J0800A']; else $J0800A = '';
    if (isset($data['SectionJ']['J0800B']) && $data['SectionJ']['J0800B'] != '') $J0800B = $data['SectionJ']['J0800B']; else $J0800B = '';
    if (isset($data['SectionJ']['J0800C']) && $data['SectionJ']['J0800C'] != '') $J0800C = $data['SectionJ']['J0800C']; else $J0800C = '';
    if (isset($data['SectionJ']['J0800D']) && $data['SectionJ']['J0800D'] != '') $J0800D = $data['SectionJ']['J0800D']; else $J0800D = '';

    // CAT19 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A19A'] = '0';
    // Trigger on Condition 1;
    if ($J0500A == '1') $data['SectionV']['V0200A19A'] = '1';
    // Trigger on Condition 2;
    if ($J0500B == '1') $data['SectionV']['V0200A19A'] = '1';
    // Trigger on Condition 3;
    if ($J0600A >= '07' AND $J0600A <= '10') $data['SectionV']['V0200A19A'] = '1';
    // Trigger on Condition 4;
    if ($J0600B == '3' OR $J0600B == '4') $data['SectionV']['V0200A19A'] = '1';
    // Trigger on Condition 5;
    if (
      ($J0400 == '1' OR $J0400 == '2') AND
      (($J0600A >= '04' AND $J0600A <= '10') OR ($J0600B >= '2' AND $J0600B <= '4'))
    ) $data['SectionV']['V0200A19A'] = '1';
    // Trigger on Condition 6;
    if ($J0800A == '1' OR $J0800B == '1' OR $J0800C == '1' OR $J0800D == '1') $data['SectionV']['V0200A19A'] = '1';

    return $data;
  }
	
	public function cat19Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;19&nbsp;Pain</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if (isset($data['SectionJ']['J0500A']) && $data['SectionJ']['J0500A'] == '1')
      $reason .= 	'<li>Pain has made it hard for resident to sleep at night over the past 5 nights as indicated by:<br /><br /><b>J0500A = 1</b><br /><br /></li>';
    // Trigger on Condition 2;
    if (isset($data['SectionJ']['J0500B']) && $data['SectionJ']['J0500B'] == '1')
      $reason .= 	'<li>Resident has limited day-to-day activity because of pain over the past 5 days as indicated by:<br /><br /><b>J0500B = 1</b><br /><br /></li>';
    // Trigger on Condition 3;
    if (isset($data['SectionJ']['J0600A']) && $data['SectionJ']['J0600A'] >= '07' && $data['SectionJ']['J0600A'] <= '10')
      $reason .= 	'<li>Pain numeric intensity rating has a value from 7 to 10 as indicated by:<br /><br /><b>J0600A >= 07 AND J0600A <= 10</b><br /><br /></li>';
    // Trigger on Condition 4;
    if ((isset($data['SectionJ']['J0600B']) && $data['SectionJ']['J0600B'] == '3') || (isset($data['SectionJ']['J0600B']) &&$data['SectionJ']['J0600B'] == '4'))
      $reason .= 	'<li>Verbal descriptor of pain is servere or very servere as indicated by a value of 3 or 4 as follows:<br /><br /><b>J0600B = 3 OR J0600B = 4</b><br /><br /></li>';
    // Trigger on Condition 5;
    if (
      ((isset($data['SectionJ']['J0400']) && $data['SectionJ']['J0400'] == '1') || (isset($data['SectionJ']['J0400']) && $data['SectionJ']['J0400'] == '2')) && 
      (
        (isset($data['SectionJ']['J0600A']) && $data['SectionJ']['J0600A'] >= '04' && $data['SectionJ']['J0600A'] <= '10') || 
        (isset($data['SectionJ']['J0600B']) && $data['SectionJ']['J0600B'] >= '2' && $data['SectionJ']['J0600B'] <= '4')
      )
    )
      $reason .= 	'<li>Pain is frequent as indicated by a value of 1 or 2 <u>and</u> numberic pain intensity rating has a value of 4 through 10 or verbal descriptor of pain has a value of 2 through 4 as indicated by:<br /><br /><b>(J0400 = 1 OR J0400 = 2) AND<br />((J0600A >= 04 AND J0600A <= 10) OR<br />(J0600B >=2 AND J0600B <= 4))</b><br /><br /></li>';
    // Trigger on Condition 6;
    if (
      (isset($data['SectionJ']['J0800A']) && $data['SectionJ']['J0800A'] == '1') || 
      (isset($data['SectionJ']['J0800B']) && $data['SectionJ']['J0800B'] == '1') || 
      (isset($data['SectionJ']['J0800C']) && $data['SectionJ']['J0800C'] == '1') || 
      (isset($data['SectionJ']['J0800D']) && $data['SectionJ']['J0800D'] == '1')
    )
      $reason .= 	'<li>Staff assessment reports resident indicates pain or possible pain in body language as indicated by:<br /><br /><b>(J0800A = 1) OR<br />(J0800B = 1) OR<br />(J0800C = 1) OR<br />(J0800D = 1)</b><br /><br /></li>';
											
		return $reason;
 }  
  
  protected function __cat20($data) {

    // CAT20 Logic;
    // Initialize CAT indicator to not triggered;
    $data['SectionV']['V0200A20A'] = '0';
    // Trigger on Condition 1;
    if (isset($data['SectionQ']['Q0600']) && $data['SectionQ']['Q0600'] == '1')
      $data['SectionV']['V0200A20A'] = 1;
    
    return $data;
  }
	
	public function cat20Reason ($id) {
    $data = ClassRegistry::init('Assessment')->getAssessment($id);
    
		$reason = '<h2>CAT&nbsp;Specifications:&nbsp;20&nbsp;Return&nbsp;to&nbsp;Community&nbsp;Referral</h2><br /><b>The following CAT/CATs caused the trigger:</b><ul>';
		    
    // Trigger on Condition 1;
    if (isset($data['SectionQ']['Q0600']) && $data['SectionQ']['Q0600'] == '1')
      $reason .= 	'<li>Referral has not been made to local contact agency as indicated by:<br /><br /><b>Q0600 = 1</b><br /><br /></li>';
														
		return $reason;
 }  
  
  private function __count_days ( $a = null, $b = null) {
    
    if ($a == null || $b == null) return 0;
    
    if (strlen($a) == 8) {
      $gd_a['year'] = substr($a, 0, 4);
      $gd_a['mon']  = substr($a, 4, 2);
      $gd_a['mday'] = substr($a, 6, 2);
    }
    else {
      $a = str_replace('/', '-', $a);
      list($gd_a['year'], $gd_a['mon'], $gd_a['mday']) = explode('-', $a);
    }
    
    if (strlen($b) == 8) {
      $gd_b['year'] = substr($b, 0, 4);
      $gd_b['mon']  = substr($b, 4, 2);
      $gd_b['mday'] = substr($b, 6, 2);
    }
    else {
      $b = str_replace('/', '-', $b);
      list($gd_b['year'], $gd_b['mon'], $gd_b['mday']) = explode('-', $b);
    }
    
    $a_new = @mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
    $b_new = @mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );

    $days = round( abs( $a_new - $b_new ) / 86400 );
    return $days;
  }
  
}