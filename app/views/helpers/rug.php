<?php

App::import('Component', array('Calc', 'Reports.Clock'));
class RugHelper extends AppHelper {
  
  public function __construct () {
	$this->Calc = new CalcComponent();
	$this->Clock = new ClockComponent();
  }
  
  public function therapy ($data, $facility_id) {
	$RUGIV = $this->Calc->calcRugTherapy($data);
	$HIPPS = $this->Calc->calcModifier($data);

//	$late = $this->__late($data);
//	if ($late == true) $RUGIV = 'AAA';
	
	$rug['score'] = $RUGIV . $HIPPS;
	$rug['rate'] = $this->__getRate($RUGIV, $facility_id);
	
	//if ($data['Assessment']['ATYPEOPAY'] == 'MEDICAID') 
	//  return $this->nursing($data, $facility_id);
	//else return $rug;

	return $rug;
  }
  
  public function nursing ($data, $facility_id) {
	$RUGIV = $this->Calc->calcRugNonTherapy($data);
	$HIPPS = $this->Calc->calcModifier($data);

//	$late = $this->__late($data);
//	if ($late == true) $RUGIV = 'AAA';
	
	$rug['score'] = $RUGIV . $HIPPS;
	$rug['rate'] = $this->__getRate($RUGIV, $facility_id);
	return $rug;
  }
  
  public function minutes ($data) {
	return $this->Calc->calcTherapy($data);
  }
  
  public function sot ($data) {
	return $this->Calc->calcSOT($data);
  }
  
  public function adl ($data) {
	return $this->Calc->calcAdl($data);
  }

  private function __late($data = array()) {
	$clock = '';

	if (in_array($data['SectionA']['A0310B'], array('01','02','03','04','05','06')))
	  $clock = $this->Clock->checkLate($data['Assessment']['id']);
	else 
	  $clock = '';

	return $clock;
  }
  
  protected function __getRate($rug, $facility_id) {
	$rate = ClassRegistry::init('RugRate')->getRate($facility_id, $rug);
	return $rate['RugRate']['rate'];
  }
}