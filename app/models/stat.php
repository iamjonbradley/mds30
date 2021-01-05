<?php

class Stat extends AppModel {
  
  public $name = 'Stat';
  public $useDbConfig = 'logs';
  
  public $belongsTo = array(
    'Group' => array(
      'className' => 'Group',
      'foreignKey' => 'group_id',
      'fields' => 'Group.name'
    ),
    'Facility' => array(
      'className' => 'Facility',
      'foreignKey' => 'facility_id',
      'fields' => 'Facility.name'
    ),
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id',
      'fields' => array('User.name')
    )
  );

  public function afterFind ($results) {
    
    foreach ($results as $key => $value) {
      
      if (isset($value['Stat'])) {
      
        $user = $this->User->find('first', array(
          'conditions' => array('User.id' => $value['Stat']['user_id']),
          'fields' => array('User.name', 'User.facility_id', 'User.group_id'),
          'recusive' => -1
        )); 
        
        $facility = $this->Facility->find('first', array(
          'conditions' => array('Facility.id' => $user['User']['facility_id']),
          'fields' => array('Facility.name'),
          'recusive' => -1
        )); 
        
        $group = $this->Group->find('first', array(
          'conditions' => array('Group.id' => $user['User']['group_id']),
          'fields' => array('Group.name'),
          'recusive' => -1
        )); 
        
        $results[$key]['User'] = $user['User'];      
        $results[$key]['Group'] = $group['Group'];
        $results[$key]['Facility'] = $facility['Facility'];
        
      }
      
    }
    
    return $results;
    
  }

  public function getOnline () {

    $sql  = 'SELECT Stat.url, Stat.ip_address, Stat.user_id, Stat.facility_id, Stat.created FROM stats as Stat ';
    $sql .= 'WHERE Stat.created >= DATE_SUB(NOW(), INTERVAL 1 HOUR) AND  Stat.user_id != "" ';
    $sql .= 'GROUP BY Stat.user_id ORDER BY id DESC';
    $results = $this->query($sql);

    return self::afterFind ($results);

  }

  public function shutdown(&$controller) {
  }
  
}
