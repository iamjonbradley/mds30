<?php

class CasambaTask extends extends Shell {

  public function import () {

    $i = 0;
    $handle = fopen(TMP ."sumter.csv", "r");
    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
      if ($i == 0) $headers = $row;
      if ($i != 0) {
        foreach ($headers as $key => $value) {
          $info[$i][$value] = $row[$key];
        }
      }
      $i++;
    }

    $facility_id = 38;

    foreach ($info as $key => $value) {
      $value['facility_id'] = $facility_id;
      // check if exists
      $import = $this->CasambaImport->find('count', array(
        'conditions' => array(
          'CasambaImport.SSNO' => $value['SSNO'],
          'CasambaImport.CPTCODE' => $value['CPTCODE']
        )
      ));
      if ($import == 0) {
        $this->CasambaImport->create();
        $this->CasambaImport->save($value, false);
      }

    }
    die;
  }

}