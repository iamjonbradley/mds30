<?php

App::import('Core', 'File', false);
class MrNcsTask extends Shell {

  public $uses = array('Resident', 'Sync');


  public function execute($facility) {

    $total = $this->updateResidents($facility);

    // record the sync
    $this->Sync->create();
    $sync['Sync']['total'] = $total;
    $sync['Sync']['facility_id'] = $facility;
    $this->Sync->save($sync, false);
  }

  public function updateResidents($id) {

    $filename  = sprintf("/tmp/medical_records/%d/ResListForMds.txt", $id);

    $i = 0;

    if (($handle = fopen($filename, "r")) !== FALSE) {
      
      while (($data = fgetcsv($handle, 2500, "\t")) !== FALSE) {

        if ($data[0] != 'clast') {

          $res['id']      = $id .'-'. $data['17'];
          $res['facility_id'] = $id;
          $res['PATLNAME']  = $data['0'];
          $res['PATFNAME']  = $data['1'];
          $res['PMI']     = $data['2'];
          $res['SSNUM']     = $data['3'];
          $res['MEDICARE']  = str_replace('-', '', $data['4']);
          $res['MEDICAID']  = str_replace('-', '', $data['5']);
          $res['PATNUM']    = $data['17'];

          switch ($data['7']) {
            case 'MEDICAID PENDING':
              $res['ATYPEOPAY'] = '+';
              break;
            case 'PA Medicaid':
              $res['ATYPEOPAY'] = 'MEDICAID';
              break;
            case 'Medicare':
              $res['ATYPEOPAY'] = 'MEDICARE A';
              break;
            case 'HUMANA':
            case 'GHP GOLD':
              $res['ATYPEOPAY'] = 'MEDICARE A';
              break;
            default:
              $res['ATYPEOPAY'] = strtoupper($data['7']);
          }
          
          $res['BED'] = $data['8'];

          list($month, $day, $year) = explode('/', $data['9']);
          $res['BDATE'] = $year .'-'. $month .'-'. $day;

          list($month, $day, $year) = explode('/', $data['15']);
          $res['ADATE'] = $year .'-'. $month .'-'. $day;


          switch ($data['16']) {
            case 'In-House':
              $res['READM'] = '';
              break;
            case 'Discharge to Home':
              $res['READM'] = 'D';
              break;
            case 'Expired': 
              $res['READM'] = 'E';
              break;
            case 'Hospital, Non-Bed Hold':
              $res['READM'] = 'D';
              break;
            case 'Bed Hold':
              $res['READM'] = 'L';
              break;
          }
          
          $this->Resident->save($res, false);

          $i++;
        }


      }

    }


    $info = array();
    return $i;

  }
}