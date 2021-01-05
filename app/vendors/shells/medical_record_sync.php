<?php

class MedicalRecordSyncShell extends Shell {

  public $tasks = array('MrFieldbase', 'MrNcs', 'CareTracker');

  public $uses = array('Facility');

  public function main () {

    $conditions = array(
      'Facility.rec_type'  => 0,
      'Facility.status'  => 1,
    );
    
    if (isset($this->args[0])) 
      $conditions['Facility.id'] = $this->args[0];
    
    $facilities = $this->Facility->find('all', array(
      'conditions' => $conditions,
      'fields' => array(
        'Facility.id', 'Facility.name', 'Facility.mr_software', 'Facility.care_tracker'
      ),
      'recursive' => -1
    ));

    foreach ($facilities as $key => $value) {

      $this->hr();    

      $task = 'Mr'. ucwords(strtolower($value['Facility']['mr_software']));

      $facility = $value['Facility']['id'];

      $name = $value['Facility']['name'];

      $this->out('Attempting to save Resident data for '. $name .' - FAC #' . $facility);

      // process medical records
      $count = $this->{$task}->execute($facility);

      $this->out('Finished saving Resident data for '. $name  . ' - FAC #' . $facility .' - records add/updated '. $count);

      // process care tracker if applicable
      if ($value['Facility']['care_tracker'] == 1) 
        $this->CareTracker->execute('resident_submit', $facility);
    
    }

    $this->hr();    
      
  }

}