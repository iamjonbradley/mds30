<?php

class Log extends AppModel {

	public $name = 'Log';
	public $order = 'created DESC';
  public $useDbConfig = 'logs';
  
  public $belongsTo = array(
    'Assessment' => array(
      'foreignKey' => 'model_id',
      'fields' => array('Assessment.id', 'Assessment.resident')
    )
  );
  
  public function afterFind($results, $primary) {
    foreach ($results as $key => $value) {     
      if (!empty($value['Assessment']['resident'])) {
        $resident = $this->Assessment->Resident->find('first', array(
          'conditions' => array('Resident.id' => $value['Assessment']['resident']),
          'fields' => array('Resident.PATFNAME', 'Resident.PATLNAME')
        ));
        $results[$key]['Resident'] = $resident['Resident'];
      }
    }
    return $results;
  }

}