<?php

$type = $this->AssessmentType->short($this->data);

$letters = $this->AvailableSection->getLetters($type, $this->data['Facility']['F_STATE']);


echo '<h1> Resident: '. $this->data['Resident']['PATLNAME'] .', '. $this->data['Resident']['PATFNAME'] .'</h1> <br />';

if (isset($section) && !empty($section)) {    

    $section_page  = '..'. DS .'assessments';
    $section_page .= DS . 'itemset';
    $section_page .= DS . $this->data['Assessment']['item_subset'];
    $section_page .= DS . $this->AvailableSection->get($type, $this->data['Facility']['F_STATE'], $section);

   echo $this->element($section_page);
}
else {
  foreach ($letters as $key => $value) {    

    $section_page  = '..'. DS .'assessments';
    $section_page .= DS . 'itemset';
    $section_page .= DS . $this->data['Assessment']['item_subset'];
    $section_page .= DS . $this->AvailableSection->get($type, $this->data['Facility']['F_STATE'], $value);

   echo $this->element($section_page);
    if ($value != 'p')
      echo '<div style="page-break-after:always;"> </div>';
  }
}

