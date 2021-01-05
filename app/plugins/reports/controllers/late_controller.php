<?php

class LateController extends AppController {
  
  public $name = 'Late';
  public $uses = array();
  public $components = array('Tickler');

  public function index () {
    
  }

  public function view ($facility_id = null) {
    $ticklers = $this->__getData ($facility_id);
    $this->set('ticklers', $ticklers);
    $this->render('../ticklers/index');

    
  }

  private function __getData ($facility_id = null) {

    if (!empty($facility_id)) {

      $this->Assessment = ClassRegistry::init('Assessment');
      
      if ($facility_id == 'all') 
        $facility_id = $this->Auth->user('facility_id');
      
      $data = $this->Tickler->getMedicaid (array(), $facility_id);
      $data = $this->Tickler->getMedicare ($data['data'], $facility_id, $data['i']);

      $ticklers = $data['data'];
      
      foreach ($ticklers as $key => $value) { 
        $new = date("Ymd", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
        if ($key > $new) unset($ticklers[$key]);
      }
      
      foreach ($ticklers as $key => $value) {
        foreach ($value as $key2 => $value2) {
          
          $s_y = substr($value2['start'], 0, 4);
          $s_m = substr($value2['start'], 4, 2);
          $s_d = substr($value2['start'], 6, 2); 
          $s = $s_y .'-'. $s_m .'-'. $s_d;
          
          $e_y = substr($value2['end'], 0, 4);
          $e_m = substr($value2['end'], 4, 2);
          $e_d = substr($value2['end'], 6, 2);
          $e = $e_y .'-'. $e_m .'-'. $e_d;
          
          
          switch ($value2['type']) {
            case  '5 Day': case '14 Day': case '30 Day': 
            case '60 Day': case '90 Day': case '60 Day':
              $ticklers[$key][$key2]['done']  = $this->Assessment->checkClosedPPS($value2['id'], $value2['type'], $s, $e);
              if ($ticklers[$key][$key2]['done'] == true) 
                unset($ticklers[$key][$key2]); 
              break;
            case 'Admission': 
              $ticklers[$key][$key2]['done'] = $this->Assessment->checkClosedOBRA($value2['id'], $value2['type'], $s, $e);
              if ($ticklers[$key][$key2]['done'] == true) 
                unset($ticklers[$key][$key2]);
              break;
            case 'Quaterly or Annual':
              $ticklers[$key][$key2]['done'] = $this->Assessment->checkClosedOBRA($value2['id'], $value2['type'], $s, $e);


              if ($ticklers[$key][$key2]['done'] == true) 
                unset($ticklers[$key][$key2]);

          }

          $today  = strtotime(date('Ymd'));
          $start  = strtotime($value2['start']);
          $end    = strtotime($value2['end']);


          if (($start >= $today) || ($end >= $today) ) {
            unset($ticklers[$key][$key2]);
          }

        }
      }      
    }
    return $ticklers;
  }
  
  private function __reverse($date) {
    $date = str_replace('-', '', $date);
    $date = substr($date,4,4) . substr($date,0,4);
    return $date;
  }
  
  private function __days( $a = null, $b = null) {
    
    if ($a == null || $b == null) return 0;

    list($gd_a['m'], $gd_a['d'], $gd_a['y']) = @explode('/', $a);
    list($gd_b['m'], $gd_b['d'], $gd_b['y']) = @explode('/', $b);
    
    $a_new = mktime( 12, 0, 0, $gd_a['m'], $gd_a['d'], $gd_a['y'] );
    $b_new = mktime( 12, 0, 0, $gd_b['m'], $gd_b['d'], $gd_b['y'] );

    $days = round( abs( $a_new - $b_new ) / 86400 );
    return $days + 1;
  }
  
  protected function __date($date, $add) {
    list($month, $day, $year) = explode('/', $date);
    return date("Ymd", mktime(0, 0, 0, $month, $day + $add, $year));
  }

  private function __quarters($entry, $ard) {
    $datediff = (strtotime($ard) - strtotime($entry));
    return round($datediff / 7776000);
  }

}