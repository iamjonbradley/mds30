<?php

class Assessment extends FormsAppModel {
  
  public $name = 'Assessment';
  
  public $actsAs = array(
    'Logable' => array( 
      'change' => 'full', 
      'description_ids' => true 
    ),
  ); 
  
  public $belongsTo = array(
    'Resident'  => array('className' => 'Forms.Resident', 'foreignKey' => false, 'conditions' => 'Resident.id = Assessment.resident'), 
    'Facility'  => array('className' => 'Facility'),
    'User'      => array('className' => 'User')
  );
  
  public $hasOne = array(
    'SectionA' => array('dependent' => true),
    'SectionB' => array('dependent' => true),
    'SectionC' => array('dependent' => true),
    'SectionD' => array('dependent' => true),
    'SectionE' => array('dependent' => true),
    'SectionF' => array('dependent' => true),
    'SectionG' => array('dependent' => true),
    'SectionH' => array('dependent' => true),
    'SectionI' => array('dependent' => true),
    'SectionJ' => array('dependent' => true),  
    'SectionK' => array('dependent' => true),
    'SectionL' => array('dependent' => true),
    'SectionM' => array('dependent' => true),
    'SectionN' => array('dependent' => true),
    'SectionO' => array('dependent' => true),
    'SectionP' => array('dependent' => true),
    'SectionQ' => array('dependent' => true),
    'SectionS' => array('dependent' => true),
    'SectionV' => array('dependent' => true),
    'SectionX' => array('dependent' => true),
    'SectionZ' => array('dependent' => true),
  ); 

  public function getResidentCensusDetail ($facility) {
    
    $residents = $this->Resident->getActiveResidentList($facility);

    $facility = $this->Facility->getInfo($facility);

    $report['info']['CCN'] = $facility['Facility']['CCN'];
    $report['info']['F78'] = count($residents); 

    $max_late = self::__subDate(date('m/d/Y'), 7);

    foreach ($residents as $key => $value) {

      $last = $this->getResidentLast($value['Resident']['id']);

      if (!empty($last)) {

        $date = str_replace('-', '', $last['Assessment']['lock_date']);

        $details = array(
          'PATNUM'  => $value['Resident']['PATNUM'],
          'NAME'    => $value['Resident']['PATLNAME'] .', '. $value['Resident']['PATFNAME'] .' '. $value['Resident']['PMI'],
          'STATUS'  => $value['Resident']['READM'],
          'LOCK'    => $date,
          'ASMT'    => $last['Assessment']['id']
        );


        if ($value['Resident']['ATYPEOPAY'] == 'MEDICARE A')    $report['F75'][] = $details;
        elseif ($value['Resident']['ATYPEOPAY'] == 'MEDICAID')  $report['F76'][] = $details;
        else                                                    $report['F77'][] = $details;

        if ($max_late > $date) $dates[] = 1;

        // set Bathing
        switch ($last['SectionG']['G0120A']) {
          case 0:
            $report['F79'][] = $details;
            break;
          case 1: case 2: case 3:
            $report['F80'][] = $details;
            break;
          case 4:
            $report['F81'][] = $details;
            break;
        }

        // set Dressing
        switch ($last['SectionG']['G0110G1']) {
          case 0:
            $report['F82'][] = $details;
            break;
          case 1: case 2: case 3:
            $report['F83'][] = $details;
            break;
          case 4:
            $report['F84'][] = $details;
            break;
        }

        // set Transferring
        switch ($last['SectionG']['G0110B1']) {
          case 0:
            $report['F85'][] = $details;
            break;
          case 1: case 2: case 3:
            $report['F86'][] = $details;
            break;
          case 4:
            $report['F87'][] = $details;
            break;
        }

        // set Toilet Use
        switch ($last['SectionG']['G0110I1']) {
          case 0:
            $report['F88'][] = $details;
            break;
          case 1: case 2: case 3:
            $report['F89'][] = $details;
            break;
          case 4:
            $report['F90'][] = $details;
            break;
        }

        // set Eating
        switch ($last['SectionG']['G0110H1']) {
          case 0:
            $report['F91'][] = $details;
            break;
          case 1: case 2: case 3:
            $report['F92'][] = $details;
            break;
          case 4:
            $report['F93'][] = $details;
            break;
        }

        if ($last['SectionH']['H0100A'] == 1 || $last['SectionH']['H0100B'] == 1) 
          $report['F94'][] = $details;

        if (
          ($last['SectionH']['H0100A'] == 1 && ($last['SectionA']['A0310A'] == 1) || ($last['SectionA']['A0310B'] == '01' || $last['SectionA']['A0310B'] == '06')) || 
          ($last['SectionH']['H0100B'] == 1 && ($last['SectionA']['A0310A'] == 1) || ($last['SectionA']['A0310B'] == '01' || $last['SectionA']['A0310B'] == '06'))
        ) 
          $report['F95'][] = $details;

        if (
          ($last['SectionH']['H0300'] == 1 || $last['SectionH']['H0300'] == 2 || $last['SectionH']['H0300'] == 3) && 
          ($last['SectionH']['H0100A'] == 0 && $last['SectionH']['H0100B'] == 0)
        ) 
          $report['F96'][] = $details;

        if (($last['SectionH']['H0400'] == 1 || $last['SectionH']['H0400'] == 2 || $last['SectionH']['H0400'] == 3))
          $report['F97'][] = $details;
        
        if ($last['SectionH']['H0200A'] == 1) 
          $report['F98'][] = $details;
        
        if ($last['SectionH']['H0500'] == 1) 
          $report['F99'][] = $details;

        if (
          (($last['SectionG']['G0110C1'] == 0 || $last['SectionG']['G0110C1'] == 7) || ($last['SectionG']['G0110D1'] == 0 || $last['SectionG']['G0110D1'] == 7)) && 
          ($last['SectionG']['G0600A'] == 0 && $last['SectionG']['G0600B'] == 0)
        ) 
          $report['F102'][] = $details;

        if (
          (
            ($last['SectionG']['G0110C1'] == 1 || $last['SectionG']['G0110C1'] == 2 || $last['SectionG']['G0110C1'] == 3) ||
            ($last['SectionG']['G0110D1'] == 1 || $last['SectionG']['G0110C1'] == 2 || $last['SectionG']['G0110D1'] == 3)
          ) && 
          ($last['SectionG']['G0600A'] == 1 && $last['SectionG']['G0600B'] == 1)
        ) 
          $report['F103'][] = $details;

        if (isset($last['SectionP'])) {
          $count = 0;
          foreach ($last['SectionP'] as $key2 => $value2) {
            if ($key2 != 'P0100A') {
              if (preg_match('|P0100|', $key2) && ($value2 == 1 || $value2 == 2)) $count++;
            }
          }

          if ($count > 0)
            $report['F104'][] = $details;

          if ($count > 0 && ($last['SectionA']['A0310A'] == '01' || $last['SectionA']['A0310B'] == '01')) 
            $report['F105'][] = $details;
          
        }

        if (
          ($last['SectionG']['G0400A'] == 1 || $last['SectionG']['G0400A'] == 2) || 
          ($last['SectionG']['G0400B'] == 1 || $last['SectionG']['G0400B'] == 2)
        ) 
          $report['F106'][] = $details;

        if (
          (
            ($last['SectionG']['G0400A'] == 1 || $last['SectionG']['G0400A'] == 2) || 
            ($last['SectionG']['G0400B'] == 1 || $last['SectionG']['G0400B'] == 2)
          ) && 
          ($last['SectionA']['A0310A'] == '01' || $last['SectionA']['A0310B'] == '01' || $last['SectionA']['A0310B'] == '06')
        ) 
          $report['F107'][] = $details;

        if (
          $last['SectionA']['A1550A'] == 1 || $last['SectionA']['A1550B'] == 1 || $last['SectionA']['A1550C'] == 1 || 
          $last['SectionA']['A1550D'] == 1 || $last['SectionA']['A1550E'] == 1 
        ) 
          $report['F108'][] = $details;

        if ($last['SectionD']['D0300'] > 0 || $last['SectionD']['D0600'] > 0) 
          $report['F109'][] = $details;

        if (
          (isset($last['SectionI']['I5700']) && $last['SectionI']['I5700'] == 1) || 
          (isset($last['SectionI']['I5900']) && $last['SectionI']['I5900'] == 1) || 
          (isset($last['SectionI']['I5950']) && $last['SectionI']['I5950'] == 1) || 
          (isset($last['SectionI']['I6000']) && $last['SectionI']['I6000'] == 1) 
        ) 
          $report['F110'][] = $details;

        if ($last['SectionI']['I4200'] == 1 || $last['SectionI']['I4800'] == 1) 
          $report['F111'][] = $details;

        if (
          $last['SectionE']['E0300'] == 1 || $last['SectionE']['E0800'] == 1 || $last['SectionE']['E0800'] == 2 || 
          $last['SectionE']['E0800'] == 3 || $last['SectionE']['E0900'] == 1 || $last['SectionE']['E0900'] == 2 || 
          $last['SectionE']['E0900'] == 3 
        ) 
          $report['F112'][] = $details;
        
        if ($last['SectionM']['M0300B1'] > 0 || $last['SectionM']['M0300C1'] > 0 || $last['SectionM']['M0300D1'] > 0) 
          $report['F115'][] = $details;
        
        if ($last['SectionM']['M0300B2'] > 0 || $last['SectionM']['M0300C2'] > 0 || $last['SectionM']['M0300D2'] > 0) 
          $report['F116'][] = $details;

        if (isset($last['SectionM'])) {
          $count = 0;
          foreach ($last['SectionM'] as $key2 => $value2) {
            if (preg_match('|M1200|', $key)) {
              if ($value2 == 1) $count++;
            }
          }
          $report['F117'][] = $details;
        }
        
        if ($last['SectionO']['O0100K1'] == 1 || $last['SectionO']['O0100K2'] == 1) 
          $report['F119'][] = $details;
        
        if ($last['SectionO']['O0100B1'] == 1 || $last['SectionO']['O0100B2'] == 1) 
          $report['F120'][] = $details;
        
        if ($last['SectionO']['O0100A1'] == 1 || $last['SectionO']['O0100A2'] == 1) 
          $report['F121'][] = $details;
        
        if ($last['SectionO']['O0100J1'] == 1 || $last['SectionO']['O0100J2'] == 1) 
          $report['F122'][] = $details;
        
        if (
          $last['SectionK']['K0500A'] == 1 || $last['SectionO']['O0100H1'] == 1 || 
          $last['SectionO']['O0100H2'] == 1 || $last['SectionO']['O0100I1'] == 1 || 
          $last['SectionO']['O0100I2'] == 1
        ) 
          $report['F123'][] = $details;
        
        if (
          $last['SectionO']['O0100C1'] == 1 || $last['SectionO']['O0100C2'] == 1 || 
          $last['SectionO']['O0100F1'] == 1 || $last['SectionO']['O0100F2'] == 1 || 
          $last['SectionO']['O0100G1'] == 1 || $last['SectionO']['O0100G2'] == 1 || 
          $last['SectionO']['O0400D1'] == 1
        ) 
          $report['F124'][] = $details;

        if ($last['SectionO']['O0100E1'] == 1 || $last['SectionO']['O0100E2'] == 1) 
          $report['F125'][] = $details;
        
        if ($last['SectionO']['O0100D1'] == 1 || $last['SectionO']['O0100D2'] == 1) 
          $report['F127'][] = $details;
        
        if ($last['SectionN']['N0300'] > 0) 
          $report['F128'][] = $details;
        
        if ($last['SectionK']['K0500B'] == 1) 
          $report['F129'][] = $details;
        
        if ($last['SectionK']['K0500C'] == 1) 
          $report['F130'][] = $details;
        
        if (
          $last['SectionO']['O0400A1'] > 0 || $last['SectionO']['O0400A2'] > 0 || $last['SectionO']['O0400A3'] > 0 || 
          $last['SectionO']['O0400B1'] > 0 || $last['SectionO']['O0400B2'] > 0 || $last['SectionO']['O0400B3'] > 0 || 
          $last['SectionO']['O0400C1'] > 0 || $last['SectionO']['O0400C2'] > 0 || $last['SectionO']['O0400C3'] > 0 
        ) 
          $report['F131'][] = $details;
        
        if (
          $last['SectionN']['N0400A'] == 1 || $last['SectionN']['N0400B'] == 1 || 
          $last['SectionN']['N0400C'] == 1 || $last['SectionN']['N0400D'] == 1
        ) 
          $report['F133'][] = $details;
        
        if ($last['SectionN']['N0400A'] == 1) 
          $report['F134'][] = $details;
        
        if ($last['SectionN']['N0400B'] == 1) 
          $report['F135'][] = $details;
        
        if ($last['SectionN']['N0400C'] == 1) 
          $report['F136'][] = $details;
        
        if ($last['SectionN']['N0400D'] == 1) 
          $report['F137'][] = $details;
        
        if ($last['SectionN']['N0400F'] == 1) 
          $report['F138'][] = $details;
        
        if ($last['SectionJ']['J0100A'] == 1 || $last['SectionJ']['J0100B'] == 1 || $last['SectionJ']['J0100C'] == 1) 
          $report['F139'][] = $details;
        
        if ($last['SectionK']['K0300'] == 2) 
          $report['F140'][] = $details;

      }

    }

    ksort($report);

    $report['info']['bad_date'] = count($dates);

    return $report;

  }

  public function getREsidentCensusAndConditionsOfResidents ($facility) {
    
    $residents = $this->Resident->getActiveResidentList($facility);

    $facility = $this->Facility->getInfo($facility);

    $report['CCN'] = $facility['Facility']['CCN'];
    $report['F78'] = count($residents);

    $max_late = self::__subDate(date('m/d/Y'), 7);

    foreach ($residents as $key => $value) {

      if ($value['Resident']['ATYPEOPAY'] == 'MEDICARE A')    if (!isset($report['F75'])) $report['F75'] = 1; else $report['F75'] = $report['F75'] + 1;
      elseif ($value['Resident']['ATYPEOPAY'] == 'MEDICAID')  if (!isset($report['F76'])) $report['F76'] = 1; else $report['F76'] = $report['F76'] + 1;
      else                                                    if (!isset($report['F77'])) $report['F77'] = 1; else $report['F77'] = $report['F77'] + 1;
    
      $last = $this->getResidentLast($value['Resident']['id']);

      $date = str_replace('-', '', $last['Assessment']['lock_date']);

      if ($max_late > $date) $dates[] = 1;

      // set Bathing
      switch ($last['SectionG']['G0120A']) {
        case 0:
          if (!isset($report['F79'])) $report['F79'] = 1; else $report['F79'] = $report['F79'] + 1;
          break;
        case 1: case 2: case 3:
          if (!isset($report['F80'])) $report['F80'] = 1; else $report['F80'] = $report['F80'] + 1;
          break;
        case 4:
          if (!isset($report['F81'])) $report['F81'] = 1; else $report['F81'] = $report['F81'] + 1;
          break;
        default:
          $report['F79'] = $report['F79'] + 0;
          $report['F80'] = $report['F80'] + 0;
          $report['F81'] = $report['F81'] + 0;
      }

      // set Dressing
      switch ($last['SectionG']['G0110G1']) {
        case 0:
          if (!isset($report['F82'])) $report['F82'] = 1; else $report['F82'] = $report['F82'] + 1;
          break;
        case 1: case 2: case 3:
          if (!isset($report['F83'])) $report['F83'] = 1; else $report['F83'] = $report['F83'] + 1;
          break;
        case 4:
          if (!isset($report['F84'])) $report['F84'] = 1; else $report['F84'] = $report['F84'] + 1;
          break;
        default:
          $report['F82'] = $report['F82'] + 0;
          $report['F83'] = $report['F83'] + 0;
          $report['F84'] = $report['F84'] + 0;
      }

      // set Transferring
      switch ($last['SectionG']['G0110B1']) {
        case 0:
          if (!isset($report['F85'])) $report['F85'] = 1; else $report['F85'] = $report['F85'] + 1;
          break;
        case 1: case 2: case 3:
          if (!isset($report['F86'])) $report['F86'] = 1; else $report['F86'] = $report['F86'] + 1;
          break;
        case 4:
          if (!isset($report['F87'])) $report['F87'] = 1; else $report['F87'] = $report['F87'] + 1;
          break;
        default:
          $report['F85'] = $report['F85'] + 0;
          $report['F86'] = $report['F86'] + 0;
          $report['F87'] = $report['F87'] + 0;
      }

      // set Toilet Use
      switch ($last['SectionG']['G0110I1']) {
        case 0:
          if (!isset($report['F88'])) $report['F88'] = 1; else $report['F88'] = $report['F88'] + 1;
          break;
        case 1: case 2: case 3:
          if (!isset($report['F89'])) $report['F89'] = 1; else $report['F89'] = $report['F89'] + 1;
          break;
        case 4:
          if (!isset($report['F90'])) $report['F90'] = 1; else $report['F90'] = $report['F90'] + 1;
          break;
        default:
          $report['F88'] = $report['F88'] + 0;
          $report['F89'] = $report['F89'] + 0;
          $report['F90'] = $report['F90'] + 0;
      }

      // set Eating
      switch ($last['SectionG']['G0110H1']) {
        case 0:
          if (!isset($report['F91'])) $report['F91'] = 1; else $report['F91'] = $report['F91'] + 1;
          break;
        case 1: case 2: case 3:
          if (!isset($report['F92'])) $report['F92'] = 1; else $report['F92'] = $report['F92'] + 1;
          break;
        case 4:
          if (!isset($report['F93'])) $report['F93'] = 1; else $report['F93'] = $report['F93'] + 1;
          break;
        default:
          $report['F91'] = $report['F91'] + 0;
          $report['F92'] = $report['F92'] + 0;
          $report['F93'] = $report['F93'] + 0;
      }

      if ($last['SectionH']['H0100A'] == 1 || $last['SectionH']['H0100B'] == 1) {
        if (!isset($report['F94'])) $report['F94'] = 1; else $report['F94'] = $report['F94'] + 1;
      }
      else {
        if (!isset($report['F94'])) $report['F94'] = 0;
        else $report['F94'] = $report['F94'] + 0;
      }

      if (
        ($last['SectionH']['H0100A'] == 1 && ($last['SectionA']['A0310A'] == 1) || ($last['SectionA']['A0310B'] == '01' || $last['SectionA']['A0310B'] == '06')) || 
        ($last['SectionH']['H0100B'] == 1 && ($last['SectionA']['A0310A'] == 1) || ($last['SectionA']['A0310B'] == '01' || $last['SectionA']['A0310B'] == '06'))
      ) {
        if (!isset($report['F95'])) $report['F95'] = 1; else $report['F95'] = $report['F95'] + 1;
      }
      else {
        if (!isset($report['F95'])) $report['F95'] = 0;
        else $report['F95'] = $report['F95'] + 0;
      }

      if (
        ($last['SectionH']['H0300'] == 1 || $last['SectionH']['H0300'] == 2 || $last['SectionH']['H0300'] == 3) && 
        ($last['SectionH']['H0100A'] == 0 && $last['SectionH']['H0100B'] == 0)
      ) {
        if (!isset($report['F96'])) $report['F96'] = 1; else $report['F96'] = $report['F96'] + 1;
      }
      else {
        if (!isset($report['F96'])) $report['F96'] = 0;
        else $report['F96'] = $report['F96'] + 0;
      }

      if (
        ($last['SectionH']['H0400'] == 1 || $last['SectionH']['H0400'] == 2 || $last['SectionH']['H0400'] == 3)
      ) {
        if (!isset($report['F97'])) $report['F97'] = 1; else $report['F97'] = $report['F97'] + 1;
      }
      else {
        if (!isset($report['F97'])) $report['F97'] = 0;
        else $report['F97'] = $report['F97'] + 0;
      }
      
      if ($last['SectionH']['H0200A'] == 1) {
        if (!isset($report['F98'])) $report['F98'] = 1; else $report['F98'] = $report['F98'] + 1;
      }
      else {
        if (!isset($report['F98'])) $report['F98'] = 0;
        else $report['F98'] = $report['F98'] + 0;
      }
      
      if ($last['SectionH']['H0500'] == 1) {
        if (!isset($report['F99'])) $report['F99'] = 1; else $report['F99'] = $report['F99'] + 1;
      }
      else {
        if (!isset($report['F99'])) $report['F99'] = 0;
        else $report['F99'] = $report['F99'] + 0;
      }

      if (
        (($last['SectionG']['G0110C1'] == 0 || $last['SectionG']['G0110C1'] == 7) || ($last['SectionG']['G0110D1'] == 0 || $last['SectionG']['G0110D1'] == 7)) && 
        ($last['SectionG']['G0600A1'] == 0 && $last['SectionG']['G0600B1'] == 0)
      ) {
        if (!isset($report['F102'])) $report['F102'] = 1; else $report['F102'] = $report['F102'] + 1;
      }
      else {
        if (!isset($report['F102'])) $report['F102'] = 0;
        else $report['F102'] = $report['F102'] + 0;
      }

      if (
        (
          ($last['SectionG']['G0110C1'] == 1 || $last['SectionG']['G0110C1'] == 2 || $last['SectionG']['G0110C1'] == 3) ||
          ($last['SectionG']['G0110D1'] == 1 || $last['SectionG']['G0110C1'] == 2 || $last['SectionG']['G0110D1'] == 3)
        ) && 
        ($last['SectionG']['G0600A'] == 1 && $last['SectionG']['G0600B'] == 1)
      ) {
        if (!isset($report['F103'])) $report['F103'] = 1; else $report['F103'] = $report['F103'] + 1;
      }
      else {
        if (!isset($report['F103'])) $report['F103'] = 0;
        else $report['F103'] = $report['F103'] + 0;
      }

      if (isset($last['SectionP'])) {
        $count = 0;
        foreach ($last['SectionP'] as $key2 => $value2) {
          if ($key2 != 'P0100A') {
            if ($value2 == 1 || $value2 == 2) $count++;
          }
        }
        if (!isset($report['F104'])) $report['F104'] = 1; else $report['F104'] = $report['F104'] + 1;

        if (!isset($report['F104'])) $report['F104'] = 0;
        else $report['F104'] = $report['F104'] + 0;

        if ($count > 0 && ($last['SectionA']['A0310A'] == '01' || $last['SectionA']['A0310B'] == '01')) {
          if (!isset($report['F105'])) $report['F105'] = 1; else $report['F105'] = $report['F105'] + 1;
        }
        else {
          if (!isset($report['F105'])) $report['F105'] = 0;
          else $report['F105'] = $report['F105'] + 0;
        }
      }

      if (
        ($last['SectionG']['G0400A'] == 1 || $last['SectionG']['G0400A'] == 2) || 
        ($last['SectionG']['G0400B'] == 1 || $last['SectionG']['G0400B'] == 2)
      ) {
        if (!isset($report['F106'])) $report['F106'] = 1; else $report['F106'] = $report['F106'] + 1;
      }
      else {
        if (!isset($report['F106'])) $report['F106'] = 0;
        else $report['F106'] = $report['F106'] + 0;
      }

      if (
        (
          ($last['SectionG']['G0400A'] == 1 || $last['SectionG']['G0400A'] == 2) || 
          ($last['SectionG']['G0400B'] == 1 || $last['SectionG']['G0400B'] == 2)
        ) && 
        ($last['SectionA']['A0310A'] == '01' || $last['SectionA']['A0310B'] == '01' || $last['SectionA']['A0310B'] == '06')
      ) {
        if (!isset($report['F107'])) $report['F107'] = 1; else $report['F107'] = $report['F107'] + 1;
      }
      else {
        if (!isset($report['F107'])) $report['F107'] = 0;
        else $report['F107'] = $report['F107'] + 0;
      }

      if (
        $last['SectionA']['A1550A'] == 1 || $last['SectionA']['A1550B'] == 1 || $last['SectionA']['A1550C'] == 1 || 
        $last['SectionA']['A1550D'] == 1 || $last['SectionA']['A1550E'] == 1 
      ) {
        if (!isset($report['F108'])) $report['F108'] = 1; else $report['F108'] = $report['F108'] + 1;
      }
      else {
        if (!isset($report['F108'])) $report['F108'] = 0;
        else $report['F108'] = $report['F108'] + 0;
      }

      if ($last['SectionD']['D0300'] > 0 || $last['SectionD']['D0600'] > 0) {
        if (!isset($report['F109'])) $report['F109'] = 1; else $report['F109'] = $report['F109'] + 1;
      }
      else {
        if (!isset($report['F109'])) $report['F109'] = 0;
        else $report['F109'] = $report['F109'] + 0;
      }

      if (
        (isset($last['SectionI']['I5700']) && $last['SectionI']['I5700'] == 1) || 
        (isset($last['SectionI']['I5900']) && $last['SectionI']['I5900'] == 1) || 
        (isset($last['SectionI']['I5950']) && $last['SectionI']['I5950'] == 1) || 
        (isset($last['SectionI']['I6000']) && $last['SectionI']['I6000'] == 1) 
      ) {
        if (!isset($report['F110'])) $report['F110'] = 1; else $report['F110'] = $report['F110'] + 1;
      }
      else {
        if (!isset($report['F110'])) $report['F110'] = 0;
        else $report['F110'] = $report['F110'] + 0;
      }

      if (
        $last['SectionI']['I4200'] == 1 || $last['SectionI']['I4800'] == 1
      ) {
        if (!isset($report['F111'])) $report['F111'] = 1; else $report['F111'] = $report['F111'] + 1;
      }
      else {
        if (!isset($report['F111'])) $report['F111'] = 0;
        else $report['F111'] = $report['F111'] + 0;
      }

      if (
        $last['SectionE']['E0300'] == 1 || $last['SectionE']['E0800'] == 1 || $last['SectionE']['E0800'] == 2 || 
        $last['SectionE']['E0800'] == 3 || $last['SectionE']['E0900'] == 1 || $last['SectionE']['E0900'] == 2 || 
        $last['SectionE']['E0900'] == 3 
      ) {
        if (!isset($report['F112'])) $report['F112'] = 1; else $report['F112'] = $report['F112'] + 1;
      }
      else {
        if (!isset($report['F112'])) $report['F112'] = 0;
        else $report['F112'] = $report['F112'] + 0;
      }
      
      if (
        $last['SectionM']['M0300B1'] > 0 || $last['SectionM']['M0300C1'] > 0 || $last['SectionM']['M0300D1'] > 0
      ) {
        if (!isset($report['F115'])) $report['F115'] = 1; else $report['F115'] = $report['F115'] + 1;
      }
      else {
        if (!isset($report['F115'])) $report['F115'] = 0;
        else $report['F115'] = $report['F115'] + 0;
      }
      
      if (
        $last['SectionM']['M0300B2'] > 0 || $last['SectionM']['M0300C2'] > 0 || $last['SectionM']['M0300D2'] > 0
      ) {
        if (!isset($report['F116'])) $report['F116'] = 1; else $report['F116'] = $report['F116'] + 1;
      }
      else {
        if (!isset($report['F116'])) $report['F116'] = 0;
        else $report['F116'] = $report['F116'] + 0;
      }

      if (isset($last['SectionM'])) {
        $count = 0;
        foreach ($last['SectionM'] as $key2 => $value2) {
          if (preg_match('|M1200|', $key)) {
            if ($value2 == 1) $count++;
          }
        }
        if (!isset($report['F117'])) $report['F117'] = 1; else $report['F117'] = $report['F117'] + 1;
      }
      else {
        if (!isset($report['F117'])) $report['F117'] = 0;
        else $report['F117'] = $report['F117'] + 0;
      }
      
      if ($last['SectionO']['O0100K1'] == 1 || $last['SectionO']['O0100K2'] == 1) {
        if (!isset($report['F119'])) $report['F119'] = 1; else $report['F119'] = $report['F119'] + 1;
      }
      else {
        if (!isset($report['F119'])) $report['F119'] = 0;
        else $report['F119'] = $report['F119'] + 0;
      }
      
      if ($last['SectionO']['O0100B1'] == 1 || $last['SectionO']['O0100B2'] == 1) {
        if (!isset($report['F120'])) $report['F120'] = 1; else $report['F120'] = $report['F120'] + 1;
      }
      else {
        if (!isset($report['F120'])) $report['F120'] = 0;
        else $report['F120'] = $report['F120'] + 0;
      }
      
      if ($last['SectionO']['O0100A1'] == 1 || $last['SectionO']['O0100A2'] == 1) {
        if (!isset($report['F121'])) $report['F121'] = 1; else $report['F121'] = $report['F121'] + 1;
      }
      else {
        if (!isset($report['F121'])) $report['F121'] = 0;
        else $report['F121'] = $report['F121'] + 0;
      }
      
      if ($last['SectionO']['O0100J1'] == 1 || $last['SectionO']['O0100J2'] == 1) {
        if (!isset($report['F122'])) $report['F122'] = 1; else $report['F122'] = $report['F122'] + 1;
      }
      else {
        if (!isset($report['F122'])) $report['F122'] = 0;
        else $report['F122'] = $report['F122'] + 0;
      }
      
      if (
        $last['SectionK']['K0500A'] == 1 || $last['SectionO']['O0100H1'] == 1 || 
        $last['SectionO']['O0100H2'] == 1 || $last['SectionO']['O0100I1'] == 1 || 
        $last['SectionO']['O0100I2'] == 1
      ) {
        if (!isset($report['F123'])) $report['F123'] = 1; else $report['F123'] = $report['F123'] + 1;
      }
      else {
        if (!isset($report['F122'])) $report['F122'] = 0;
        else $report['F122'] = $report['F122'] + 0;
      }
      
      if (
        $last['SectionO']['O0100C1'] == 1 || $last['SectionO']['O0100C2'] == 1 || 
        $last['SectionO']['O0100F1'] == 1 || $last['SectionO']['O0100F2'] == 1 || 
        $last['SectionO']['O0100G1'] == 1 || $last['SectionO']['O0100G2'] == 1 || 
        $last['SectionO']['O0400D1'] == 1
      ) {
        if (!isset($report['F124'])) $report['F124'] = 1; else $report['F124'] = $report['F124'] + 1;
      }
      else {
        if (!isset($report['F124'])) $report['F124'] = 0;
        else $report['F124'] = $report['F124'] + 0;
      }

      if ($last['SectionO']['O0100E1'] == 1 || $last['SectionO']['O0100E2'] == 1) {
        if (!isset($report['F125'])) $report['F125'] = 1; else $report['F125'] = $report['F125'] + 1;
      }
      else {
        if (!isset($report['F125'])) $report['F125'] = 0;
        else $report['F125'] = $report['F125'] + 0;
      }
      
      if ($last['SectionO']['O0100D1'] == 1 || $last['SectionO']['O0100D2'] == 1) {
        if (!isset($report['F127'])) $report['F127'] = 1; else $report['F127'] = $report['F127'] + 1;
      }      
      else {
        if (!isset($report['F127'])) $report['F127'] = 0;
        else $report['F127'] = $report['F127'] + 0;
      }
      
      if ($last['SectionN']['N0300'] > 0) {
        if (!isset($report['F128'])) $report['F128'] = 1; else $report['F128'] = $report['F128'] + 1;
      }
      else {
        if (!isset($report['F128'])) $report['F128'] = 0;
        else $report['F128'] = $report['F128'] + 0;
      }
      
      if ($last['SectionK']['K0500B'] == 1) {
        if (!isset($report['F129'])) $report['F129'] = 1; else $report['F129'] = $report['F129'] + 1;
      }
      else {
        if (!isset($report['F129'])) $report['F129'] = 0;
        else $report['F129'] = $report['F129'] + 0;
      }
      
      if ($last['SectionK']['K0500C'] == 1) {
        if (!isset($report['F130'])) $report['F130'] = 1; else $report['F130'] = $report['F130'] + 1;
      }
      else {
        if (!isset($report['F130'])) $report['F130'] = 0;
        else $report['F130'] = $report['F130'] + 0;
      }
      
      if (
        $last['SectionO']['O0400A1'] > 0 || $last['SectionO']['O0400A2'] > 0 || $last['SectionO']['O0400A3'] > 0 || 
        $last['SectionO']['O0400B1'] > 0 || $last['SectionO']['O0400B2'] > 0 || $last['SectionO']['O0400B3'] > 0 || 
        $last['SectionO']['O0400C1'] > 0 || $last['SectionO']['O0400C2'] > 0 || $last['SectionO']['O0400C3'] > 0 
      ) {
        if (!isset($report['F131'])) $report['F131'] = 1; else $report['F131'] = $report['F131'] + 1;
      }
      else {
        if (!isset($report['F131'])) $report['F131'] = 0;
        else $report['F131'] = $report['F131'] + 0;
      }
      
      if (
        $last['SectionN']['N0400A'] == 1 || $last['SectionN']['N0400B'] == 1 || 
        $last['SectionN']['N0400C'] == 1 || $last['SectionN']['N0400D'] == 1
      ) {
        if (!isset($report['F133'])) $report['F133'] = 1; else $report['F133'] = $report['F133'] + 1;
      }
      else {
        if (!isset($report['F133'])) $report['F133'] = 0;
        else $report['F133'] = $report['F133'] + 0;
      }
      
      if ($last['SectionN']['N0400A'] == 1) {
        if (!isset($report['F134'])) $report['F134'] = 1; else $report['F134'] = $report['F134'] + 1;
      }
      else {
        if (!isset($report['F134'])) $report['F134'] = 0;
        else $report['F134'] = $report['F134'] + 0;
      }
      
      if ($last['SectionN']['N0400B'] == 1) {
        if (!isset($report['F135'])) $report['F135'] = 1; else $report['F135'] = $report['F135'] + 1;
      }
      else {
        if (!isset($report['F135'])) $report['F135'] = 0;
        else $report['F135'] = $report['F135'] + 0;
      }
      
      if ($last['SectionN']['N0400C'] == 1) {
        if (!isset($report['F136'])) $report['F136'] = 1; else $report['F136'] = $report['F136'] + 1;
      }
      else {
        if (!isset($report['F136'])) $report['F136'] = 0;
        else $report['F136'] = $report['F136'] + 0;
      }
      
      if ($last['SectionN']['N0400D'] == 1) {
        if (!isset($report['F137'])) $report['F137'] = 1; else $report['F137'] = $report['F137'] + 1;
      }
      else {
        if (!isset($report['F137'])) $report['F137'] = 0;
        else $report['F137'] = $report['F137'] + 0;
      }
      
      if ($last['SectionN']['N0400F'] == 1) {
        if (!isset($report['F138'])) $report['F138'] = 1; else $report['F138'] = $report['F138'] + 1;
      }
      else {
        if (!isset($report['F138'])) $report['F138'] = 0;
        else $report['F138'] = $report['F138'] + 0;
      }
      
      if ($last['SectionJ']['J0100A'] == 1 || $last['SectionJ']['J0100B'] == 1 || $last['SectionJ']['J0100C'] == 1) {
        if (!isset($report['F139'])) $report['F139'] = 1; else $report['F139'] = $report['F139'] + 1;
      }
      else {
        if (!isset($report['F139'])) $report['F139'] = 0;
        else $report['F139'] = $report['F139'] + 0;
      }
      
      if ($last['SectionK']['K0300'] == 2) {
        if (!isset($report['F140'])) $report['F140'] = 1; else $report['F140'] = $report['F140'] + 1;
      }
      else {
        if (!isset($report['F140'])) $report['F140'] = 0;
        else $report['F140'] = $report['F140'] + 0;
      }

    }

    $report['bad_date'] = count($dates);

    ksort($report);

    return $report;

  }


  public function get802Detail ($facility) {
    
    $residents = $this->Resident->getActiveResidentList($facility);

    $facility = $this->Facility->getInfo($facility);

    foreach ($residents as $key => $value) {

      $last = $this->getResidentLast($value['Resident']['id']);

      if (!empty($last)) {

        $report[$key][1] = $last['Resident']['PATNUM'];
        $report[$key][2] = $last['Resident']['ROOM'];
        $report[$key][3] = '';
        $report[$key][4] = $last['Resident']['PATLNAME'] .', '. $last['Resident']['PATFNAME'] .' '. $last['Resident']['PMI'];
        $report[$key][5] = '';
        $report[$key][6] = '';
        $report[$key][7] = '';
        $report[$key][8] = '';
        $report[$key][9] = '';
        $report[$key][10] = '';
        $report[$key][11] = '';

        // number 6
        $code = '';
        if ($last['SectionI']['I3900'] == 1 || $last['SectionJ']['J1900C'] == 1)
          $code .=  'Fx';
        if ($last['SectionJ']['J1700A'] == 1)
          $code .=  'F';

        $report[$key][12] = $code;

        // number 7
        $code = '';
        if ($last['SectionJ']['J1900B'] == 1)
          $code .=  'x';

        $report[$key][13] = $code;

        // number 8
        $code = '';
        if (
          ($last['SectionE']['E0300'] == 1) ||
          ($last['SectionE']['E0800'] == 1 || $last['SectionE']['E0800'] == 2 || $last['SectionE']['E0800'] == 3) || 
          ($last['SectionE']['E0900'] == 1 || $last['SectionE']['E0900'] == 2 || $last['SectionE']['E0900'] == 3) 
        )
          $code .=  'x';

        $report[$key][14] = $code;

        // number 9
        $code = '';
        if (
          ($last['SectionI']['I5800'] == 1) ||
          ($last['SectionD']['D0200B1'] == 1 || $last['SectionD']['D0200F1'] == 2 || $last['SectionD']['D0200I1'] == 3) || 
          ($last['SectionD']['D0500B1'] == 1 || $last['SectionD']['D0500F1'] == 2 || $last['SectionD']['D0500I1'] == 3) 
        )
          $code .=  'x';

        $report[$key][15] = $code;

        // number 10
        $report[$key][16] = '';

        // number 11
        $code = '';
        if (
          $last['SectionC']['C0500'] < 13 || $last['SectionC']['C0700'] == 1 || $last['SectionC']['C0800'] == 1 || 
          $last['SectionC']['C1000'] == 1 || $last['SectionC']['C1000'] == 2 || $last['SectionC']['C1000'] == 3 || 
          $last['SectionC']['C1300A'] == 1 || $last['SectionC']['C1300A'] == 2 ||
          $last['SectionC']['C1300B'] == 1 || $last['SectionC']['C1300B'] == 2 ||
          $last['SectionC']['C1300C'] == 1 || $last['SectionC']['C1300C'] == 2 ||
          $last['SectionC']['C1300D'] == 1 || $last['SectionC']['C1300D'] == 2
        )
          $code .=  'x';

        $report[$key][17] = $code;

        // number 12
        $code = '';
        if (
          $last['SectionH']['H0300'] == 1 || $last['SectionH']['H0300'] == 2 || $last['SectionH']['H0300'] == 2 && 
          ($last['SectionH']['H0100A'] == 1 || $last['SectionH']['H0100B'] == 1)
        )
          $code .=  'I';

        if ($last['SectionH']['H0200A'] == 1)     
          $code .=  ' T';

        $report[$key][18] = $code;

        // number 13
        $code = '';
        if ($last['SectionH']['H0100A'] == 1)
          $code .=  'x';

        $report[$key][19] = $code;

        // number 14
        $report[$key][20] = '';

        // number 15
        $code = '';
        if (
          $last['SectionM']['M1040A'] == 1 || 
          $last['SectionI']['I1400'] == 1 || $last['SectionI']['I2000'] == 1 || $last['SectionI']['I2100'] == 1 || 
          $last['SectionI']['I2200'] == 1 || $last['SectionI']['I2300'] == 1 || $last['SectionI']['I2400'] == 1 || 
          $last['SectionI']['I2500'] == 1
        )
          $code .=  'x';

        $report[$key][21] = $code;

        // number 16
        $code = '';
        if ($last['SectionK']['K0300'] == 2)  
          $code .=  'W ';
        if (
          $last['SectionK']['K0100A'] == 1 || $last['SectionK']['K0100B'] == 1 || 
          $last['SectionK']['K0100C'] == 1 || $last['SectionK']['K0100D'] == 1
        ) 
          $code .=  'S ';
        if ($last['SectionL']['L0200A'] == 1)  
          $code .=  'D ';
        if ($last['SectionO']['O0500H'] > 0)  
          $code .=  'R ';

        $report[$key][22] = $code;

        // number 17
        $code = '';
        if ($last['SectionK']['K0500B'] == 1)
          $code .=  'x';

        $report[$key][23] = $code;

        // number 18
        $code = '';
        if ($last['SectionJ']['J1550C'] == 1)
          $code .=  'x';

        $report[$key][24] = $code;

        // number 19
        $report[$key][25] = '';

        // number 20
        $report[$key][26] = '';

        // number 21
        $code = '';
        if ($last['SectionG']['G0400A'] == 1 || $last['SectionG']['G0400B'] == 1) 
          $code .=  'x';

        $report[$key][27] = $code;

        // number 22
        $code = '';
        if ($last['SectionN']['N0400A'] == 1)
          $code .=  'P ';
        if ($last['SectionN']['N0400B'] == 1)
          $code .=  'A ';
        if ($last['SectionN']['N0400C'] == 1)
          $code .=  'D ';
        if ($last['SectionN']['N0400D'] == 1)
          $code .=  'H ';

        $report[$key][28] = $code;

        // number 23
        $code = '';
        if ($last['SectionP']['P0100A'] == 1) 
          $code .=  'S ';
        if (
          $last['SectionP']['P0100B'] == 1 || $last['SectionP']['P0100C'] == 1 || $last['SectionP']['P0100E'] == 1 || 
          $last['SectionP']['P0100F'] == 1 || $last['SectionP']['P0100G'] == 1
        ) 
          $code .=  'N ';

        $report[$key][29] = $code;

        // number 24
        $report[$key][30] = '';

        // number 25
        $code = '';
        if ($last['SectionM']['M0300B1'] > 0 || $last['SectionM']['M0300C1'] > 0 || $last['SectionM']['M0300D1'] > 0)
          $code .= 'x';

        $report[$key][31] = $code;

        // number 26
        $code = '';
        if ($last['SectionJ']['J0100A'] == 1 || $last['SectionJ']['J0100B'] == 1 || $last['SectionJ']['J0100C'] == 1)
          $code .= 'x';

        $report[$key][32] = $code;

        // number 27
        $report[$key][33] = '';

        // number 28
        $code = '';
        if ($last['SectionB']['B0200'] == 2 || $last['SectionB']['B0200'] == 3)
          $code .=  'H ';
        if ($last['SectionB']['B0100'] == 2 || $last['SectionB']['B0100'] == 3 || $last['SectionB']['B0100'] == 3)
          $code .=  'V ';
        if ($last['SectionB']['B0300'] == 1 || $last['SectionB']['B1200'] == 13)
          $code .=  'D ';

        $report[$key][34] = $code;

        // number 29
        $code = '';
        if ($last['SectionO']['O0400A1'] > 0 || $last['SectionO']['O0400A2'] > 0 || $last['SectionO']['O0400A3'] > 0)
          $code .= 'S ';
        if ($last['SectionO']['O0400B1'] > 0 || $last['SectionO']['O0400B2'] > 0 || $last['SectionO']['O0400B3'] > 0)
          $code .= 'O ';
        if ($last['SectionO']['O0400C1'] > 0 || $last['SectionO']['O0400C2'] > 0 || $last['SectionO']['O0400C3'] > 0)
          $code .= 'P ';

        $report[$key][35] = $code;

        // number 30
        $code = '';
        if ($last['SectionO']['O0500C'] > 0 || $last['SectionG']['G0600A'] == 1 || $last['SectionG']['G0600B'] == 1)
          $code .= 'B';

        $report[$key][36] = $code;

        // number 31
        $code = '';
        if ($last['SectionO']['O0100K1']  == 1 || $last['SectionO']['O0100K2']  == 1)
          $code .= 'x';

        $report[$key][37] = $code;

        // number 32
        $code = '';
        if ($last['SectionO']['O0100J1']  == 1 || $last['SectionO']['O0100J2']  == 1)
          $code .= 'x';

        $report[$key][38] = $code;

        // number 33
        $code = '';
        if (
          $last['SectionO']['O0100C1']  == 1 || $last['SectionO']['O0100C2']  == 1 || 
          $last['SectionO']['O0100F1']  == 1 || $last['SectionO']['O0100F2']  == 1 || 
          $last['SectionO']['O0100G1']  == 1 || $last['SectionO']['O0100G2']  == 1
        )
          $code .= 'x';

        $report[$key][39] = $code;

        // number 34
        $report[$key][40] = '';

        // number 35
        $code = '';
        if (
          $last['SectionA']['A1550A']  == 1 || $last['SectionA']['A1550B']  == 1 || $last['SectionA']['A1550C']  == 1 || 
          $last['SectionA']['A1550D']  == 1 || $last['SectionA']['A1550E']  == 1
        )
          $code .= 'MR ';
        if (
          $last['SectionI']['I5700']  == 1 || $last['SectionI']['I5900']  == 1 || 
          $last['SectionI']['I5950']  == 1 || $last['SectionI']['I6000']  == 1
        )
          $code .= 'MI ';

        $report[$key][41] = $code;

        // number 36
        $report[$key][42] = '';

        // number 37
        $report[$key][43] = '';

      }
    }


    return $report;

  }
  
  public function getResidentLast($resident) {
    $this->unbindModel(array('belongsTo' => array('Facility', 'User')));
    return $this->find('first', array(
      'conditions' => array(
        'Assessment.resident' => $resident, 
        'Assessment.locked' => 1,
        'Assessment.deleted' => 0,
        'Assessment.transmission_status' => 2,
        'or' => array(
          'SectionA.A0310A' => array('01', '02', '03', '04', '05', '06'),
          'SectionA.A0310B' => array('01', '02', '03', '04', '05', '06'),
        )
      ),
      'order' => array('Assessment.id' => 'DESC'),
    ));
  }
  
  protected function __subDate($date, $add) {
    list($month, $day, $year) = explode('/', $date);
    return date("Ymd", mktime(0, 0, 0, $month, $day - $add, $year));
  }

}