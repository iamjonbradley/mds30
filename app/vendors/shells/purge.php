<?php

class PurgeShell extends Shell {

  public $uses = array('Log');

  public function main () {

    $date =  date("Y-m-d H:i:s", strtotime("-18 months"));

    echo $date;

  }

}