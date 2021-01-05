<?php

class TaskBehavior extends ModelBehavior {

  /*
  Run after a model is called.
  */
  public function afterFind(&$model, $results, $primary = false) 
  {
      if (!empty($results)) {
        if ($primary == true) {
          foreach ($results as $key => $value) {
            $results[$key] = $this->__item_subset (&$model, $value);
            $results[$key] = $this->__getISC (&$model, $results[$key]);
          }
        }
      }

      return $results;
  }

  /**
   * This ties the correct ISC Version Code to the Assessment
   *
   * @param $model currect object for the current model
   * @param $result the current data object for the result set
   * @return $result returns the current data object plus the assessment type
   */
  private function __getISC (&$model, $result)
  {

    if (!empty($result)) {
      if (array_key_exists('SectionA', $result) && isset($result['SectionA'])) $SectionA = $result['SectionA']; else $SectionA = '';

      if (is_array($SectionA)) {
        App::import('Model', 'Isc');
        $this->Isc = new Isc();
        $result['Assessment']['type'] = $this->Isc->get($result);
      }
    }
    
    return $result;

  }

  /**
   * Ties the correct item_subset, age of patient and 
   * how the long the patient has been admitted
   *
   * @param $model currect object for the current model
   * @param $result the current data object for the result set
   * @return $result returns the current data object plus the age of patient
   */
  private function __item_subset (&$model, $result) 
  {

    if (array_key_exists('SectionA', $result) && isset($result['SectionA'])) $SectionA = $result['SectionA']; else $SectionA = '';

    if (is_array($SectionA)) {
      if (array_key_exists('A2300', $result['SectionA']) && isset($result['SectionA']['A2300'])) $A2300 = $result['SectionA']['A2300']; else $A2300 = '';
      if (array_key_exists('A1600', $result['SectionA']) && isset($result['SectionA']['A1600'])) $A1600 = $result['SectionA']['A1600']; else $A1600 = '';
      if (array_key_exists('A0900', $result['SectionA']) && isset($result['SectionA']['A0900'])) $A0900 = $result['SectionA']['A0900']; else $A0900 = '';
      if (array_key_exists('A2000', $result['SectionA']) && isset($result['SectionA']['A2000'])) $A2000 = $result['SectionA']['A2000']; else $A2000 = '';

      // get isc
      if (!empty($A2000) ) {
        if ($A2000 >= '2012-04-01') $result['Assessment']['item_subset'] = '1.10';
        if ($A2000 <= '2012-04-01') $result['Assessment']['item_subset'] = '1.00';
      }
      else if (!empty($A2300) ) {
        if ($A2300 >= '2012-04-01') $result['Assessment']['item_subset'] = '1.10';
        if ($A2300 <= '2012-04-01') $result['Assessment']['item_subset'] = '1.00';
      }
      else {
        if ($A1600 >= '2012-04-01') $result['Assessment']['item_subset'] = '1.10';
        if ($A1600 <= '2012-04-01') $result['Assessment']['item_subset'] = '1.00';
      }

      if ($A1600 >= '2012-04-01') $result['Assessment']['item_subset'] = '1.10';

      if (!empty($A0900))
        $result['SectionA']['age'] = $model->getAge ($A0900);

      if (!empty($A1600))
        $result['SectionA']['admitted'] = $model->countDays ($A1600, $A2300);
    }

    return $result;
  }


}