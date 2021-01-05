<?php

class AvailableSectionHelper extends AppHelper {
  
  public $name = 'AvailableSection';
  
  public $helpers = array('Session', 'IncompleteCaa');
  
  public function letters ($data, $type, $state, $section = null) {
    
    $letters = $this->getLetters($type, $state);
    
    foreach ($letters as $key2 => $value2) {
      $letter[$value2] = $value2;
    }

    if ($data['SectionX']['X0100'] == 1)
      $data['SectionX']['validated'] = 1;

      $id = $data['Assessment']['id'];
    
    if ($id) {
      foreach ($letters as $key => $value) {
        
          $lModel = 'Section'. strtoupper($value);
          // set default class
          $classes  = 'section-'. $value;
          // check if active tab
          if ($value == $section) $classes .= ' active';
          // check if validated
          if (isset($data[$lModel]['validated']) && $data[$lModel]['validated'] == 0) $classes .= ' invalid'; 
          elseif (isset($data[$lModel]['validated']) && $data[$lModel]['validated'] == 1) $classes .= ' valid';
          else $classes .= '';

          if ($data['SectionA']['validated'] == 1 && $value != 'a') {
            echo '<li class="'. $classes .'"><a href="/assessments/edit/'. $value .'/'. $id .'">'. strtoupper($value) .'</a></li>';
          }
          elseif ($data['SectionA']['validated'] != 1 && $value != 'a') {
            echo '<li class="'. $classes .'"><a href="#">'. strtoupper($value) .'</a></li>';
          }
          else {
            echo '<li class="'. $classes .'"><a href="/assessments/edit/'. $value .'/'. $id .'">'. strtoupper($value) .'</a></li>';
          }
      }
      
      if ($section == 'r') $class_r = ' class="active"'; else $class_r = '';
      echo '<li'. $class_r .'><a href="/assessments/report/'. $id .'"><img src="/img/actions/report.png"></a></li>';
      
      if (isset($letter['v'])) {
        if ($this->params['action'] == 'caa') {
					if($this->IncompleteCaa->check($data, $id))
					{
						$class_caa = ' class="invalid"'; 
					}
					else {
						$class_caa = ' class="active"'; 
					}
				}
				else {
					if($this->IncompleteCaa->check($data, $id))
					{
						$class_caa = ' class="invalid"'; 
					}
					else {
						$class_caa = '';
					}
				}
				
        echo '<li'. $class_caa .'><a href="/assessments/caa/'. $id .'"><img src="/img/actions/caa.png"></a></li>';
      }
      
      if (!in_array($this->Session->read('Auth.User.group_id'), array(9))) {
        if ($this->params['action'] == 'history') $class_history = ' class="active"'; else $class_history = '';
        echo '<li'. $class_history .'><a href="/assessments/history/'. $id .'"><img src="/img/actions/history.png"></a></li>';
      }
    }

    return $letter;
  }
  
  public function getLetters ($type, $state) {

    $letters = array();

    // comprehensive (NC) item set
    if ($type == 'NC') {
      $letters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','v','x','z');
      if ($state == 'PA' || $state == 'FL' || $state == 'IL' || $state == 'VA') 
        $letters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','s','v','x','z');
    }
    
    // quarterly (NQ) item set
    if ($type == 'NQ') {
      $letters = array('a','b','c','d','e','g','h','i','j','k','l','m','n','o','p','q','x','z');
      if ($state == 'PA' || $state == 'FL' || $state == 'VA') 
        $letters = array('a','b','c','d','e','g','h','i','j','k','l','m','n','o','p','q','s','x','z');
      if ($state == 'IL')
        $letters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','s','x','z');
    }
    // pps (NP) item set
    if ($type == 'NP') {
      $letters = array('a','b','c','d','e','g','h','i','j','k','l','m','n','o','p','q','x','z');
      if ($state == 'PA' || $state == 'FL' || $state == 'VA') 
        $letters = array('a','b','c','d','e','g','h','i','j','k','l','m','n','o','p','q','s','x','z');
    }
    // omra start of therapy and discharge (NSD) item set
    if ($type == 'NSD') {
      $letters = array('a','b','c','d','e','g','h','i','j','k','m','n','o','p','q','x','z');
    }
    // omra = start of therapy (NS) Item Set
    if ($type == 'NS') {
      $letters = array('a','g','h','o','q','x','z');
    }
    // omra - discharge (NOD) item subset
    if ($type == 'NOD') {
      $letters = array('a','b','c','d','e','g','h','i','j','k','m','n','o','p','q','x','z');        
    }
    // omra (NO) item set
    if ($type == 'NO') {
      $letters = array('a','b','c','d','e','g','h','i','j','k','m','n','o','q','x','z');
    }
    // tracking (NT)
    if ($type == 'NT') {
      $letters = array('a','x','z');
      if ($state == 'PA' || $state == 'FL' || $state == 'VA') 
        $letters = array('a','s','x','z');
    }
    // discharge (ND)
    if ($type == 'ND') {
      $letters = array('a','b','c','d','e','g','h','i','j','k','m','n','o','p','q','x','z');
      if ($state == 'PA' || $state == 'FL') 
        $letters = array('a','b','c','d','e','g','h','i','j','k','m','n','o','p','q','s','x','z');
    }
    
    return $letters;
    
  }
  
  public function get ($type, $state, $section) {
    // admissions NC
    if ($type == 'NC') {
      $page = 'sections/NC/'. $section; 
      if ($state == 'PA' && $section == 's') $page = 'states/PA/NC/s';
      if ($state == 'IL' && $section == 's') $page = 'states/IL/NC/s';
      if ($state == 'FL' && $section == 's') $page = 'states/FL/ALL';
      if ($state == 'VA' && $section == 's') $page = 'states/VA/NC/s';
    }
    // quarterly (NQ) item set
    else if ($type == 'NQ') {
      switch ($section) {
        case 'e': case 'g': case 'h': case 'i': case 'j': case 'l': case 'n': case 'o':  case 'q': $page = 'sections/NQ/'. $section; break;
        default: $page = 'sections/NC/'. $section; 
      }
      if ($state == 'PA' && $section == 's') $page = 'states/PA/NQ/s';
      if ($state == 'FL' && $section == 's') $page = 'states/FL/ALL';
      if ($state == 'VA' && $section == 's') $page = 'states/VA/NQ/s';
      if ($state == 'IL') {
        switch ($section) {
          case 'e': case 'f': case 'h': case 'i': case 'j': case 'l':  case 'n': case 'o': case 's': $page = 'states/IL/NQ/'. $section; break;
        }
      }
    }
    // pps (NP) item set
    else if ($type == 'NP') {
      switch ($section) {
        case 'e': case 'g': case 'h': case 'i': case 'j': case 'l': case 'n': case 'o': case 'q': $page = 'sections/NP/'. $section; break;
        default: $page = 'sections/NC/'. $section; 
      }
      if ($state == 'PA' && $section == 's') $page = 'states/PA/NP/s';
      if ($state == 'FL' && $section == 's') $page = 'states/FL/ALL';
      if ($state == 'VA' && $section == 's') $page = 'states/VA/NP/s';
    }
    // omra start of therapy and discharge (NSD) item set
    else if ($type == 'NSD') {
      switch ($section) {
        case 'e': case 'g': case 'h': case 'i': case 'j': case 'k': case 'n': case 'o': case 'q': case 'z': $page = 'sections/NSD/'. $section; break;
        default: $page = 'sections/NC/'. $section; 
      }
    }
    // omra = start of therapy (NS) Item Set
    else if ($type == 'NS') {
      $letters = array('a','g','h','o','q','x','z');
      switch ($section) {
        case 'a': case 'g': case 'h': case 'o': case 'q': case 'z': $page = 'sections/NS/'. $section; break;
        default: $page = 'sections/NC/'. $section; 
      }
    }
    // omra - discharge (NOD) item subset
    else if ($type == 'NOD') {
      switch ($section) {
        case 'a': case 'b': case 'c': case 'd': case 'j': case 'k': case 'm': case 'p': case 'x': case 'z': case 'r': $page = 'sections/NC/'. $section; break;
        default: $page = 'sections/NOD/'. $section; 
      }
    }
    // omra (NO) item set
    else if ($type == 'NO') {
      switch ($section) {
        case 'd': case 'f': case 'l': case 'p': case 'r': case 'x': $page = 'sections/NC/'. $section; break;
        default: $page = 'sections/NO/'. $section; 
      }
    }
    // discharge (ND)
    else if ($type == 'ND') {
      switch ($section) {
        case 'a': case 'l': case 'p': case 'x': case 'z': case 'r': $page = 'sections/NC/'. $section; break;
        default: $page = 'sections/ND/'. $section; 
      }
      if ($state == 'PA' && $section == 's') $page = 'states/PA/ND/s';
      if ($state == 'FL' && $section == 's') $page = 'states/FL/ALL';
    }
    // tracking (NT)
    else if ($type == 'NT') {
      switch ($section) {
        case 'a': case 'x': case 'z': $page = 'sections/NT/'. $section; break;
        default: $page = 'sections/NC/'. $section; 
      }
      if ($state == 'PA' && $section == 's') $page = 'states/PA/NT/s';
      if ($state == 'FL' && $section == 's') $page = 'states/FL/ALL';
      if ($state == 'VA' && $section == 's') $page = 'states/VA/NT/s';
    }
    // admissions NC
    else if ($type == 'NC') {
      $page = 'sections/NC/'. $section;
      if ($state == 'PA' && $section == 's') $page = 'states/PA/NC/s';
      if ($state == 'FL' && $section == 's') $page = 'states/FL/ALL';
      if ($state == 'IL' && $section == 's') $page = 'states/IL/NC/s';
      if ($state == 'VA' && $section == 's') $page = 'states/VA/NC/s';
    }
    // comprehensive (NC) item set
    else {
      $page = 'sections/NC/'. $section; 
      if ($state == 'PA' && $section == 's') $page = 'states/PA/NC/s';
      if ($state == 'FL' && $section == 's') $page = 'states/FL/ALL';
      if ($state == 'IL' && $section == 's') $page = 'states/IL/NC/s';
      if ($state == 'VA' && $section == 's') $page = 'states/VA/NC/s';
    }
    
    // render section
    return $page;
  }
}
?>