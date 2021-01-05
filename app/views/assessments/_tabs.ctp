<div id="toptabs">
  <ul>
    <li class="previous">
      <a href="#">
        <?php
        if (isset($this->data['SectionA']['A0500A']) && !empty($this->data['SectionA']['A0500A']))
          $firstname = ucwords(strtolower($this->data['SectionA']['A0500A']));
        else 
          $firstname = ucwords(strtolower($this->data['Resident']['PATFNAME']));
          
        if (isset($this->data['SectionA']['A0500C']) && !empty($this->data['SectionA']['A0500C']))
          $lastname = ucwords(strtolower($this->data['SectionA']['A0500C']));
        else 
          $lastname = ucwords(strtolower($this->data['Resident']['PATLNAME']));
          
        echo $lastname .', '. $firstname;
        ?>        
      </a> 
    </li>
    <li class="active">
      <?php 
        if (isset($section) && $section == 'r' || $this->params['action'] == 'report') 
          $address = '/assessments/report/';
        else 
          $address = '/assessments/edit/'. $section .'/';

      ?>
      <a href="<?php echo $address . $this->data['Assessment']['id']; ?>">
        Current

        <?php
        $atype = $this->AssessmentType->get($this->data);
        if (!empty($atype))
          echo ' - '. $atype;
        ?>
      </a>    
    </li>
    <?php
    if (!empty($previous)) {
      foreach ($previous as $key => $value) {
        $atype = $this->AssessmentType->get($value);
        echo '<li>';

        // set type of assessment 
        if ($atype == 'ENT')
          $typeOfAssessment = $value['Assessment']['lock_date'] .' - '. $atype;
        else
          $typeOfAssessment = $value['SectionA']['A2300'] .' - '. $atype;

        echo '<a href="'. $address . $value['Assessment']['id'] .'">'. $typeOfAssessment .'</a>';
        echo '<li>';
      }
    }
    ?>
  </ul>
</div>