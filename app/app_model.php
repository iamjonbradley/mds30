<?php

App::import('Lib', 'LazyModel');
class AppModel extends LazyModel {

  public $ignored = array('age','validated');
  public $dates = array();
  public $optional = array();

  /**
   * Set Validation Style Rules
   */

  public function validateModel ($data = array()) {

    foreach ($this->data[$this->name] as $key => $value) {
      $this->validate[$key] = array(
        'rule' => 'notEmpty',
        'message' => ' '. $key .' can not be left empty',
      );
    }

    $skips = $this->skipPatterns ();

    if (!empty($this->data) || !empty($data)) {

      if (empty($this->data) && !empty($data))
        $this->data = $data;

      foreach ($this->data[$this->name] as $key => $value) {

        // check if not a skipped field
        if (!in_array($key, $skips)) {
          // set the date
          if (empty($value))  $this->setValidationRules($key);
          // check if a date
          if (!empty ($this->dates) && in_array($key, $this->dates) && empty($value)) $this->setDateValidate($key);
        }

        // clear the value based on skip
        if (in_array($key, $skips)) { 
          $this->data[$key][$key] = ''; 
          unset ($this->validate[$key]);
        }

        // unset validation for igored
        if (!empty($this->ignored) && in_array($key, $this->ignored)) { unset($this->validate[$key]);  }

        // unset validation for option fields
        if (!empty($this->optional) && in_array($key, $this->optional)) { unset($this->validate[$key]); }

      }
    }

    unset($this->validate['validated']);
  }

  public function setValidationRules ($field) {
    $this->validate[$field] = array(
      'rule' => 'notEmpty',
      'message' => '   '. $field .' can not be left empty',
    );
  }

  public function setDateValidate($field) {
    $this->validate[$field] = array(
      'rule' => array('date','ymd'),
      'message' => '   '. $field .' has an invalid date. format must be YYYY-MM-DD',
      'allowEmpty' => true
    );
  }

  /**
   * Set Class Methods
   */

  public function getName ($id) {
    $info = $this->find('first', array(
      'conditions' => array($this->name.'.id' => $id),
      'fields' => array($this->name.'.name'),
      'recursive' => -1
    ));
    return $info[$this->name]['name'];
  }
  
  public function getData ($id) {
    $info = $this->find('first', array(
      'conditions' => array($this->name.'.id' => $id),
      'recursive' => -1
    ));
    return $info[$this->name];
  }
  
  public function getAge ($date = null) {
    if (empty($date)) return 0;
    list($y, $m, $d) = explode('-', $date);
    $y_diff = date("Y") - $y;
    if (date('m') >= $m && date('d') >= $d) $age = $y_diff - 1;
    else $age = $y_diff;
    return $age;
  }
  
  public function countDays ( $a = null, $b = null) {
    
    if ($a == null || $b == null) return 0;
    
    // start date
    if (preg_match('[-]', $a)) list($ay, $am, $ad) = explode('-', $a); 
    if (preg_match('[/]', $a)) list($am, $ad, $ay) = explode('/', $a);    
  
    // end date
    if (preg_match('[-]', $b)) list($by, $bm, $bd) = explode('-', $b); 
    if (preg_match('[/]', $b)) list($bm, $bd, $by) = explode('/', $b);
      
    $a_new = @mktime( 12, 0, 0, $am, $ad, $ay);
    $b_new = @mktime( 12, 0, 0, $bm, $bd, $by);

    $days = round( abs( $b_new - $a_new ) / 86400 );  

    return $days;
  }

}
?>