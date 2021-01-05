<?php

class DashboardComponent extends Object {

  public function rugs ($data) {
    $this->RugRate = ClassRegistry::init('RugRate');

    foreach ($data as $key => $value) {
      debug ($value);
    }
  }
}