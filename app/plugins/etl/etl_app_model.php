<?php

class EtlAppModel extends AppModel {

  public $useDbConfig = 'mdi';

  public function beforeSave($opt){ 
    parent::beforeSave($opt); 
  }
  
}