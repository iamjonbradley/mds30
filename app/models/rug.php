<?php

class Rug extends AppModel {

  public $actAs = array('Containable');

  public $hasMany = array(
    'RugRate'
  );

}