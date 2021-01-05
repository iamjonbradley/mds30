<?php

App::import('Core', 'Sanitize');
class ApiToken extends AppModel {

  public $actsAs = array(
    'cipher' => array(
      'fields' => array('key')
    )
  );

  public function checkAuth($token, $ip) {
    $exists = $this->find('first', array(
      'conditions' => array('token' => Sanitize::clean($token), 'status' => 1),
      'fields' => array('ip_address')
    ));

    // deny if invalid
    if (empty($exists)) 
      return false;

    $allows = $exists['ApiToken']['ip_address'];
    $allowed = explode(',', $allows);

    // check if allow all
    if ($allows == '*')
      return true;

    // check if ip is in allowed list
    if (in_array($ip, $allowed))
      return true;

    return false;

  }

}