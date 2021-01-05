<?php

class IncompleteCaaHelper extends AppHelper {
  
  public $name = 'IncompleteCaa';
  
  public $helpers = array('Session');
	
	public function check ($data, $id = null) {
		
		$bTrigger = false;
		
		if (!empty($this->data)) {
      
      // check if you can lock this item
      if ($this->data['SectionV']['V0200A01A'] == 1 && empty($this->data['SectionV']['V0200A01D'])) {
         $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A02A'] == 1 && empty($this->data['SectionV']['V0200A02D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A03A'] == 1 && empty($this->data['SectionV']['V0200A03D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A04A'] == 1 && empty($this->data['SectionV']['V0200A04D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A05A'] == 1 && empty($this->data['SectionV']['V0200A05D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A06A'] == 1 && empty($this->data['SectionV']['V0200A06D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A07A'] == 1 && empty($this->data['SectionV']['V0200A07D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A08A'] == 1 && empty($this->data['SectionV']['V0200A08D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A09A'] == 1 && empty($this->data['SectionV']['V0200A09D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A10A'] == 1 && empty($this->data['SectionV']['V0200A10D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A11A'] == 1 && empty($this->data['SectionV']['V0200A11D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A12A'] == 1 && empty($this->data['SectionV']['V0200A12D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A13A'] == 1 && empty($this->data['SectionV']['V0200A13D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A14A'] == 1 && empty($this->data['SectionV']['V0200A14D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A15A'] == 1 && empty($this->data['SectionV']['V0200A15D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A16A'] == 1 && empty($this->data['SectionV']['V0200A16D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A17A'] == 1 && empty($this->data['SectionV']['V0200A17D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A18A'] == 1 && empty($this->data['SectionV']['V0200A18D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A19A'] == 1 && empty($this->data['SectionV']['V0200A19D'])) {
        $bTrigger = true;
      }
      if ($this->data['SectionV']['V0200A20A'] == 1 && empty($this->data['SectionV']['V0200A20D'])) {
        $bTrigger = true;
      }
		}
		
		return $bTrigger;		
	}
	
}
  
