<?PHP

class MedicalRecordSource extends DataSource {
  
  var $description = "Medial Records Datasource";
  var $path = array(
    'patients' => '/mnt/itm01n/testmds_30/ARRESD01.DBF',
    'facility' => '/mnt/itm01n/testmds_30/LTCSMR.DBF'
  );
  var $db = '';

  function __construct() {
    $this->patients = dbase_open($this->path['patients'], 0);
    $this->facility = dbase_open($this->path['facility'], 0);
  }
  
  function getPatients($facility_id = null) {
    
    $record_numbers = dbase_numrecords($this->patients);
    for ($i = 1; $i <= $record_numbers; $i++) {
        $row = dbase_get_record_with_names($this->patients, $i);
        $row['facility_id'] = $facility_id;
        $data[] = $row;
    }
    return $data;
  }
  
  function getFacilities() {
    
    $record_numbers = dbase_numrecords($this->facility);
    for ($i = 1; $i <= $record_numbers; $i++) {
        $row = dbase_get_record_with_names($this->facility, $i);
        $data[] = $row;
    }
    return $data;
  }
  
  function getHeaders ($type = 'patients') {
    $headers = dbase_get_header_info($this->{$type});
    $str  = 'CREATE TABLE `residents` (' ."\n";
    foreach ( $headers as $key => $value ) {
      $str .= "\t". '`'. $value['name'] .'`';
      switch ($value['type']) {
        case 'boolean';
          $str .= ' TINYINT('. $value['length'] .') DEFAULT NULL ,' ."\n";
          break;
        case 'number';
          $str .= ' INT('. $value['length'] .') DEFAULT NULL ,' ."\n";
          break;
        case 'character';
          $str .= ' VARCHAR('. $value['length'] .') DEFAULT NULL ,' ."\n";
          break;
        case 'date';
          $str .= ' DATE DEFAULT NULL ,' ."\n";
          break;
      }
    }
    $str .= ');';
    return $str;
  }
  
  function getFacilityHeaders () {
    $headers = dbase_get_header_info($this->facility);
    $str = 'CREATE TABLE `facilities` (' ."\n";
    $str .= "\t". '`id` INT(10) ,'. "\n";
    foreach ( $headers as $key => $value ) {
      $str .= "\t". '`'. $value['name'] .'`';
      switch ($value['type']) {
        case 'boolean';
          $str .= ' TINYINT('. $value['length'] .') DEFAULT NULL,' ."\n";
          break;
        case 'number';
          $str .= ' INT('. $value['length'] .') DEFAULT NULL,' ."\n";
          break;
        case 'character';
          $str .= ' VARCHAR('. $value['length'] .') DEFAULT NULL,' ."\n";
          break;
        case 'date';
          $str .= ' DATE DEFAULT NULL,' ."\n";
          break;
      }
    }
    return substr($str, 0, -2) ."\n". ');';
  }
}
?>