<?php

class ShortStayComponent extends Object {

  public $components = array('Report');

  public function calculate ($short) {

    $measure['0676']  = self::measure_0676($short);
    $measure['0678']  = self::measure_0678($short);
    $measure['0680']  = self::measure_0680($short);
    $measure['0680A'] = self::measure_0680A($short);
    $measure['0680B'] = self::measure_0680B($short);
    $measure['0680C'] = self::measure_0680C($short);
    $measure['0682']  = self::measure_0682($short);
    $measure['0682A'] = self::measure_0682A($short);
    $measure['0682B'] = self::measure_0682B($short);
    $measure['0682C'] = self::measure_0682C($short);


    return $measure;
  }
  
  /**
   * MDS 3.0 Measure (#0676): 
   * Percent of Residents Who Self-Report Moderate to Severe Pain (Short Stay)
   */
  public function measure_0676 ($data = array()) {
    if (empty($data))
      return null;

    $qualifies[0] = 0;
    $qualifies[1] = 0;

    foreach ($data as $key => $value) {

      $asmt = $this->Report->structureData($value['Assessment']['id']);

      if (array_key_exists('J0200',  $asmt['SectionJ']) && isset($asmt['SectionJ']['J0200']))  $J0200  = $asmt['SectionJ']['J0200'];  else $J0200  = '';
      if (array_key_exists('J0300',  $asmt['SectionJ']) && isset($asmt['SectionJ']['J0300']))  $J0300  = $asmt['SectionJ']['J0300'];  else $J0300  = '';
      if (array_key_exists('J0400',  $asmt['SectionJ']) && isset($asmt['SectionJ']['J0400']))  $J0400  = $asmt['SectionJ']['J0400'];  else $J0400  = '';
      if (array_key_exists('J0600A', $asmt['SectionJ']) && isset($asmt['SectionJ']['J0600A'])) $J0600A = $asmt['SectionJ']['J0600A']; else $J0600A = '';
      if (array_key_exists('J0600B', $asmt['SectionJ']) && isset($asmt['SectionJ']['J0600B'])) $J0600B = $asmt['SectionJ']['J0600B']; else $J0600B = '';

      // check Numerator
      if (
        ($J0400 == 1 || $J0400 == 2) && 
        (($J0600A == '05' || $J0600A == '06' || $J0600A == '07' || $J0600A == '08' || $J0600A == '09') || ($J0600B == '2' || $J0600B == '3'))
      ) {
        $qualifies[1]++;
        // check Exclusions
        if (
          ($J0200 == '0' || $J0200 == '-' || $J0200 == '' || $J0200 == '^') || 
          ($J0300 == '9' || $J0300 == '-' || $J0300 == '' || $J0300 == '^') || 
          (
            $J0300 == '1' && 
            ($J0300 == '9' || $J0300 == '-' || $J0300 == '' || $J0300 == '^') || 
            (
              ($J0600A == '99' || $J0600A == '-' || $J0600A == '' || $J0600A == '^') && 
              ($J0600B == '9' || $J0600B == '-' || $J0600B == '' || $J0600B == '^')
            ) ||
            $J0600A == '00'
          ) 
        ) {
          // set to no if the assessment does not qualify
          $qualifies[0]++;
        }
        else {
          // set to yes if the assessment does qualify
          $qualifies[1]++;
        }
      }
      else {
        // set to no if the assessment does not qualify
        $qualifies[0]++;
      }

    }

    return (int) round(count($qualifies[1])/100);

  }
  
  /**
   * MDS 3.0 Measure (#0678): 
   * Percent of Residents With Pressure Ulcers That Are New or Worsened (Short Stay)
   */
  public function measure_0678 ($data = array()) {
    if (empty($data))
      return null;

    $qualifies[0] = 0;
    $qualifies[1] = 0;

    foreach ($data as $key => $value) {

      $asmt = $this->Report->structureData($value['Assessment']['id']);

      if (array_key_exists('M0300B1', $asmt['SectionM']) && isset($asmt['SectionM']['M0300B1'])) $M0300B1 = $asmt['SectionM']['M0300B1']; else $M0300B1 = '';
      if (array_key_exists('M0300C1', $asmt['SectionM']) && isset($asmt['SectionM']['M0300C1'])) $M0300C1 = $asmt['SectionM']['M0300C1']; else $M0300C1 = '';
      if (array_key_exists('M0300D1', $asmt['SectionM']) && isset($asmt['SectionM']['M0300D1'])) $M0300D1 = $asmt['SectionM']['M0300D1']; else $M0300D1 = '';
      if (array_key_exists('M0800A', $asmt['SectionM']) && isset($asmt['SectionM']['M0800A'])) $M0800A = $asmt['SectionM']['M0800A']; else $M0800A = '';
      if (array_key_exists('M0800B', $asmt['SectionM']) && isset($asmt['SectionM']['M0800B'])) $M0800B = $asmt['SectionM']['M0800B']; else $M0800B = '';
      if (array_key_exists('M0800C', $asmt['SectionM']) && isset($asmt['SectionM']['M0800C'])) $M0800C = $asmt['SectionM']['M0800C']; else $M0800C = '';

      // check Exclusion 1
      if (
        // Exclusion 1.1.1
        (in_array($M0300B1, array('0','1','2','3','4','5','6','7','8','9')) && in_array($M0800A, array('0','1','2','3','4','5','6','7','8','9')) && $M0800A <= $M0300B1) || 
        // Exclusion 1.1.2
        (($M0300B1 == '' || $M0300B1 == '^') && ($M0800A == '' || $M0800A == '^'))
      )
        $excludeA = 1;
      else
        $excludeA = 0;

      // check Exclusion 2
      if (
        // Exclusion 2.1.1
        (in_array($M0300C1, array('0','1','2','3','4','5','6','7','8','9')) && in_array($M0800B, array('0','1','2','3','4','5','6','7','8','9')) && $M0800B <= $M0300C1) || 
        // Exclusion 2.1.2
        (($M0300C1 == '' || $M0300C1 == '^') && ($M0800B == '' || $M0800B == '^'))
      ) 
        $excludeB = 1;
      else 
        $excludeB = 0;

      // check Exclusion 3
      if (
        // Exclusion 3.1.1
        (in_array($M0300D1, array('0','1','2','3','4','5','6','7','8','9')) && in_array($M0800B, array('0','1','2','3','4','5','6','7','8','9')) && $M0800C <= $M0300D1) || 
        // Exclusion 3.1.2
        (($M0300D1 == '' || $M0300D1 == '^') && ($M0800C == '' || $M0800C == '^'))
      ) 
        $excludeC = 1;
      else 
        $excludeC = 0;

      // check Numerator
      if (
        ($M0800A > 0 && $M0800A <= $M0300B1 && $excludeA == 0) || 
        ($M0800B > 0 && $M0800B <= $M0300C1 && $excludeB == 0) || 
        ($M0800C > 0 && $M0800C <= $M0300D1 && $excludeC == 0)
      ) 
        $qualifies[1]++;
      else
        $qualifies[0]++;
      
    }

    return (int) round(count($qualifies[1])/100);

  }
  
  /**
   * MDS 3.0 Measure (#0680): 
   * Percent of Residents Who Were Assessed and Appropriately Given the Seasonal Influenza Vaccine (Short Stay)
   */
  public function measure_0680 ($data = array()) {
    if (empty($data))
      return null;

    $qualifies[0] = 0;
    $qualifies[1] = 0;

    foreach ($data as $key => $value) {

      $asmt = $this->Report->structureData($value['Assessment']['id']);

      if (array_key_exists('O0250A', $asmt['SectionO']) && isset($asmt['SectionO']['O0250A'])) $O0250A = $asmt['SectionO']['O0250A']; else $O0250A = '';
      if (array_key_exists('O0250C', $asmt['SectionO']) && isset($asmt['SectionO']['O0250C'])) $O0250C = $asmt['SectionO']['O0250C']; else $O0250C = '';
      
      // check Exclusions 1
      if ($O0250C != 1) {
        // check Numerator
        if (
          // Numerator 1
          ($O0250A == 1 || $O0250C == 1) ||
          // Numerator 2
          ($O0250C == 4) ||
          // Numerator 3
          ($O0250C == 3)
        )
          $qualifies[1]++;
        else
          $qualifies[0]++;
      }
      else {
        $qualifies[0]++;
      }
      
    }

    return (int) round(count($qualifies[1])/100);

  }
  
  /**
   * MDS 3.0 Measure (#0680A): 
   * Percent of Residents Who Received the Seasonal Influenza Vaccine (Short Stay)
   */
  public function measure_0680A ($data = array()) {
    if (empty($data))
      return null;

    $qualifies[0] = 0;
    $qualifies[1] = 0;

    foreach ($data as $key => $value) {

      $asmt = $this->Report->structureData($value['Assessment']['id']);

      if (array_key_exists('O0250A', $asmt['SectionO']) && isset($asmt['SectionO']['O0250A'])) $O0250A = $asmt['SectionO']['O0250A']; else $O0250A = '';
      if (array_key_exists('O0250C', $asmt['SectionO']) && isset($asmt['SectionO']['O0250C'])) $O0250C = $asmt['SectionO']['O0250C']; else $O0250C = '';
      
      // check Exclusions 1
      if ($O0250C != 1) {
        // check Numerator
        if (
          // Numerator 1
          ($O0250A == 1) ||
          // Numerator 2
          ($O0250C == 2)
        )
          $qualifies[1]++;
        else
          $qualifies[0]++;
      }
      else {
        $qualifies[0]++;
      }
      
    }

    return (int) round(count($qualifies[1])/100);

  }
  
  /**
   * MDS 3.0 Measure (#0680B): 
   * Percent of Residents Who Were Offered and Declined the Seasonal Influenza Vaccine (Short Stay)
   */
  public function measure_0680B ($data = array()) {
    if (empty($data))
      return null;

    $qualifies[0] = 0;
    $qualifies[1] = 0;

    foreach ($data as $key => $value) {

      $asmt = $this->Report->structureData($value['Assessment']['id']);

      if (array_key_exists('O0250A', $asmt['SectionO']) && isset($asmt['SectionO']['O0250A'])) $O0250A = $asmt['SectionO']['O0250A']; else $O0250A = '';
      if (array_key_exists('O0250C', $asmt['SectionO']) && isset($asmt['SectionO']['O0250C'])) $O0250C = $asmt['SectionO']['O0250C']; else $O0250C = '';
      
      // check Exclusions 1
      if ($O0250C != 1) {
        // check Numerator
        if ($O0250C == 4)
          $qualifies[1]++;
        else
          $qualifies[0]++;
      }
      else {
        $qualifies[0]++;
      }
      
    }

    return (int) round(count($qualifies[1])/100);

  }
  
  /**
   * MDS 3.0 Measure (#0680C): 
   * Percent of Residents Who Did Not Receive, Due to Medical Contraindication, the Seasonal Influenza Vaccine (Short Stay)
   */
  public function measure_0680C ($data = array()) {
    if (empty($data))
      return null;

    $qualifies[0] = 0;
    $qualifies[1] = 0;

    foreach ($data as $key => $value) {

      $asmt = $this->Report->structureData($value['Assessment']['id']);

      if (array_key_exists('O0250A', $asmt['SectionO']) && isset($asmt['SectionO']['O0250A'])) $O0250A = $asmt['SectionO']['O0250A']; else $O0250A = '';
      if (array_key_exists('O0250C', $asmt['SectionO']) && isset($asmt['SectionO']['O0250C'])) $O0250C = $asmt['SectionO']['O0250C']; else $O0250C = '';
      
      // check Exclusions 1
      if ($O0250C != 1) {
        // check Numerator
        if ($O0250C == 3)
          $qualifies[1]++;
        else
          $qualifies[0]++;
      }
      else {
        $qualifies[0]++;
      }
      
    }

    return (int) round(count($qualifies[1])/100);

  }
  
  /**
   * MDS 3.0 Measure (#0682): 
   * Percent of Residents Assessed and Appropriately Given the Pneumococcal Vaccine (Short Stay)
   */
  public function measure_0682 ($data = array()) {
    if (empty($data))
      return null;

    $qualifies[0] = 0;
    $qualifies[1] = 0;

    foreach ($data as $key => $value) {

      $asmt = $this->Report->structureData($value['Assessment']['id']);

      if (array_key_exists('O0300A', $asmt['SectionO']) && isset($asmt['SectionO']['O0300A'])) $O0300A = $asmt['SectionO']['O0300A']; else $O0300A = '';
      if (array_key_exists('O0300B', $asmt['SectionO']) && isset($asmt['SectionO']['O0300B'])) $O0300B = $asmt['SectionO']['O0300B']; else $O0300B = '';
      
      // check Numerator
          // Numerator 1
      if ($O0300A == 1 || $O0300B == 1)
        $qualifies[1]++;
      else
        $qualifies[0]++;
      
    }

    return (int) round(count($qualifies[1])/100);

  }
  
  /**
   * MDS 3.0 Measure (#0682A): 
   * Percent of Residents Who Received the Pneumococcal Vaccine (Short Stay)
   */
  public function measure_0682A ($data = array()) {
    if (empty($data))
      return null;

    $qualifies[0] = 0;
    $qualifies[1] = 0;

    foreach ($data as $key => $value) {

      $asmt = $this->Report->structureData($value['Assessment']['id']);

      if (array_key_exists('O0300A', $asmt['SectionO']) && isset($asmt['SectionO']['O0300A'])) $O0300A = $asmt['SectionO']['O0300A']; else $O0300A = '';
      
      // check Numerator
          // Numerator 1
      if ($O0300A == 1)
        $qualifies[1]++;
      else
        $qualifies[0]++;
      
    }

    return (int) round(count($qualifies[1])/100);

  }
  
  /**
   * MDS 3.0 Measure (#0682B): 
   * Percent of Residents Who Were Offered and Declined the Pneumococcal Vaccine (Short Stay)
   */
  public function measure_0682B ($data = array()) {
    if (empty($data))
      return null;

    $qualifies[0] = 0;
    $qualifies[1] = 0;

    foreach ($data as $key => $value) {

      $asmt = $this->Report->structureData($value['Assessment']['id']);

      if (array_key_exists('O0300B', $asmt['SectionO']) && isset($asmt['SectionO']['O0300B'])) $O0300B = $asmt['SectionO']['O0300B']; else $O0300B = '';
      
      // check Numerator
          // Numerator 1
      if ($O0300B == 2)
        $qualifies[1]++;
      else
        $qualifies[0]++;
      
    }

    return (int) round(count($qualifies[1])/100);

  }
  
  /**
   * MDS 3.0 Measure (#0682C): 
   * Percent of Residents Who Did Not Receive, Due to Medical Contraindication, the Pneumococcal Vaccine (Short Stay)
   */
  public function measure_0682C ($data = array()) {
    if (empty($data))
      return null;

    $qualifies[0] = 0;
    $qualifies[1] = 0;

    foreach ($data as $key => $value) {

      $asmt = $this->Report->structureData($value['Assessment']['id']);

      if (array_key_exists('O0300B', $asmt['SectionO']) && isset($asmt['SectionO']['O0300B'])) $O0300B = $asmt['SectionO']['O0300B']; else $O0300B = '';
      
      // check Numerator
          // Numerator 1
      if ($O0300B == 1)
        $qualifies[1]++;
      else
        $qualifies[0]++;
      
    }

    return (int) round(count($qualifies[1])/100);

  }

}