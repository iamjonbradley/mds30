<?php

class RugCacheShell extends Shell {

  public $uses = array('Assessment');

  public function main () {

    $assessments = $this->Assessment->find('list', array(
      'conditions' => array(
        'Assessment.deleted' => 0,
        'Assessment.facility_id' => 44
      ),
      'fields' => array('Assessment.id', 'Assessment.modified'),
      'order' => 'Assessment.id DESC'
    ));
    foreach ($assessments as $key => $value) {
      $this->Assessment->RugCache->update_cache($key);
    }

  }

}