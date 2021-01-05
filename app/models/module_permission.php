<?php

class ModulePermission extends AppModel {
  
  var $belongsTo = array('Facility', 'Module');
}