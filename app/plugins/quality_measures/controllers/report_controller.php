<?php

class ReportController extends QualityMeasuresAppController {

  public $uses = array('Assessment');
  public $components = array('Report', 'QualityMeasures.ShortStay');
  
  public function index () {
    $data = self::structureData();
  }

  public function structureData () {
    $short = $this->Assessment->getShortStay(24);
    
    // Start Short Stay Measures
    $measure['ShortStay'] = $this->ShortStay->calculate($short);

    debug ($measure);
    die;

  }

}