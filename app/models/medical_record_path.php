<?php
class MedicalRecordPath extends AppModel {

  var $name = "MedicalRecordPath";
  
  var $validate = array(
    'server_user' => array(
      'allowEmpty' => true
    ),
    'server_pass' => array(
      'required' => false,
      'allowEmpty' => true
    )
  );

  public static $medicalRecordFiles = array(
    'facility' => array('LTCSMR.DBF'),
    'resident' => array(
      'ARRESD01.DBF', 'MRADMT01.DBF', 'MRCAID01.DBF', 'MR_MASTR.DBF', 
      'PATDIS.DBF',   'PATNCP.DBF',   'PATDIS.DBF',   
      'SPAT4.DBF',    'SPAT3.DBF',    'SPAT7.DBF', 
    )
  );

  public static $basePath = "/tmp/medical_records";
  
  var $belongsTo = array(
    'Facility' => array(
      'className' => 'Facility',
      'foreignKey' => 'facility_id'
    )
  );

  public function basePath() {
    return self::$basePath;
  }

  public function medicalRecordFiles() {
    return self::$medicalRecordFiles;
  }
}
?>
