
<?php echo $this->element('../assessments/_disable_inputs'); ?>
<?php 

if ($section != 'a' && $this->data['SectionA']['validated'] != 1) {
  echo '<div class="error" id="flashMessage">Sorry you must complete and validate Section A before you can continue.</div>';
}

$str = '/'. $section;
if (isset($id)) $str .= '/'. $id;
$model = 'Section'. ucwords($section);

if (empty($this->data[$model]['validated']))
  $this->data[$model]['validated'] = 0;

echo $this->Form->create($model, array('url' => '/assessments/edit'. $str, 'id' => 'addAssessment'));
echo $this->Form->hidden('id', array('value' => $this->data['Assessment']['id']));
echo $this->Form->hidden('Assessment.item_subset', array('value' => $this->data['Assessment']['item_subset']));
echo $this->Form->hidden('assessment_id', array('value' => $this->data['Assessment']['id']));
echo $this->Form->hidden('facility_id', array('value' => $this->data['Assessment']['facility_id']));
echo $this->Form->hidden('state', array('value' => $this->data['Assessment']['STATE_CD']));
echo $this->Form->hidden('resident_id', array('value' => $this->data['Assessment']['resident']));
echo $this->Form->hidden('SectionA.validated', array('id' => 'SectionA-validated', 'value' => $this->data['SectionA']['validated']));
echo $this->Form->hidden('validated', array('value' => $this->data[$model]['validated']));
echo $this->Form->hidden('Misc.section', array('id' => 'section', 'value' => $section));
echo $this->Form->hidden('Assessment.type', array('value' => $this->data['Assessment']['type']));
echo $this->Form->hidden('age', array('id' => 'age', 'value' => $this->data['SectionA']['age']));
echo $this->Form->hidden('admitted', array('id' => 'admitted', 'value' => $this->data['SectionA']['admitted']));

// if this doesn't equal section b
if ($section != 'b') {
  if (isset($this->data['SectionB']['B0100']) && !empty($this->data['SectionB']['B0100'])) $B0100 = $this->data['SectionB']['B0100'];
  elseif (isset($this->data['SectionB']['B0100']) && empty($this->data['SectionB']['B0100'])) $B0100 = 0;
  else $B0100 = 0;
  
  echo $this->Form->hidden('B0100', array('id' => 'B0100',  'value' => $this->data['SectionB']['B0100']));
}

  
// if this doesn't equal section a
if ($section != 'a') {
  
  if ($this->data['SectionA']['A0310D'] == '') $this->data['SectionA']['A0310D'] = '^';

  echo $this->Form->hidden('A0050',  array('id' => 'A0050',  'value' => $this->data['SectionA']['A0050']));
  echo $this->Form->hidden('A0310A', array('id' => 'A0310A', 'value' => $this->data['SectionA']['A0310A']));
  echo $this->Form->hidden('A0310B', array('id' => 'A0310B', 'value' => $this->data['SectionA']['A0310B']));
  echo $this->Form->hidden('A0310C', array('id' => 'A0310C', 'value' => $this->data['SectionA']['A0310C']));
  echo $this->Form->hidden('A0310D', array('id' => 'A0310D', 'value' => $this->data['SectionA']['A0310D']));
  echo $this->Form->hidden('A0310E', array('id' => 'A0310E', 'value' => $this->data['SectionA']['A0310E']));
  echo $this->Form->hidden('A0310F', array('id' => 'A0310F', 'value' => $this->data['SectionA']['A0310F']));
  echo $this->Form->hidden('A0310G', array('id' => 'A0310G', 'value' => $this->data['SectionA']['A0310G']));
  echo $this->Form->hidden('A1600',  array('id' => 'A1600',  'value' => $this->data['SectionA']['A1600']));
  echo $this->Form->hidden('A2300',  array('id' => 'A2300',  'value' => $this->data['SectionA']['A2300']));
  echo $this->Form->hidden('SectionA.A2300',  array('id' => 'A2300',  'value' => $this->data['SectionA']['A2300']));
  echo $this->Form->hidden('B0100', array('id' => 'B0100',  'value' => $this->data['SectionB']['B0100']));
}

// if this equals section s
if ($section == 's') {
  echo $this->Form->hidden('state', array('value' => $this->data['Facility']['F_STATE']));
}


if (!empty($previous)) {

  if (count($previous) == 1 && $previous[0]['Assessment']['type'] == 'NT') {
    $V0100SHOW = 0;
  }
  else if (count($previous) > 1 && $previous[0]['Assessment']['type'] == 'NT') {
    $V0100SHOW = 0;
  }
  else if (count($previous) == 0) {
    $V0100SHOW = 0;
  }
  else if ($previous[0]['Assessment']['type'] == 'NQ' || $previous[0]['Assessment']['type'] == 'NC' || $previous[0]['Assessment']['type'] == 'NP') {
   $V0100SHOW = 1;
  }
  else {
   $V0100SHOW = 1;
  }

}
else {
  $V0100SHOW = 1;
}


if (
  ($this->data['SectionA']['A0310E'] == 0 && $V0100SHOW == 1) && 
  (
    $this->data['SectionA']['A0310A'] == '01' || $this->data['SectionA']['A0310A'] == '02' || $this->data['SectionA']['A0310A'] == '03' || $this->data['SectionA']['A0310A'] == '04' || $this->data['SectionA']['A0310A'] == '05' || $this->data['SectionA']['A0310A'] == '06' || 
    $this->data['SectionA']['A0310B'] == '01' || $this->data['SectionA']['A0310B'] == '02' || $this->data['SectionA']['A0310B'] == '03' || $this->data['SectionA']['A0310B'] == '04' || $this->data['SectionA']['A0310B'] == '05' || $this->data['SectionA']['A0310B'] == '06' 
  )
) {
  $hide_V0100 = 0;
}
else {
  $hide_V0100 = 1;
}

echo $this->Form->hidden('V0100SHOW', array('id' => 'V0100SHOW', 'value' => $V0100SHOW));
  

// get calcs
$rugs = array();

$rugs['therapy'] = $this->Rug->therapy ($this->data, $this->data['Assessment']['facility_id']);
$rugs['nursing'] = $this->Rug->nursing ($this->data, $this->data['Assessment']['facility_id']);
$rugs['minutes'] = $this->Rug->minutes ($this->data);
$rugs['adl']     = $this->Rug->adl ($this->data);
$rugs['sot']     = $this->Rug->sot ($this->data);

if ($rugs['sot'] == false) $this->data['SectionZ']['Z0100C'] = 0;
else $this->data['SectionZ']['Z0100C'] = 1;
?>

<div class="spacer"></div>
<?php echo $this->element('../assessments/_tabs'); ?>
<div id="assessment">
  <div id="tabs">
    <ul>
      <?php 
        $this->AvailableSection->letters(
          $this->data, 
          $this->AssessmentType->short($this->data), 
          $this->data['Facility']['F_STATE'], 
          $section, 
          $this->data['Assessment']['id']
        );
      ?>
    </ul>
  </div>
  <div id="section">

    <?php
    if (isset($this->validationErrors) && !empty($this->validationErrors)) {
      echo '<div id="flashMessage" class="error">';
      echo '<ul>';

      foreach ($this->validationErrors['Section'. ucwords($section)] as $key => $value) {
        echo '<li>'. $value .'</li>';
      }

      echo '</ul>';
      echo '</div>';
    }
    ?>

    <?php if (!in_array($this->Session->read('Auth.User.group_id'), array(9))) { ?>
      <a href="/printing/view/<?php echo $this->data['Assessment']['type']; ?>/<?php echo $this->data['Assessment']['id']; ?>/<?php echo $section; ?>" target="new">
        <img alt="view" class="float-right" src="/img/actions/printer.png" />
      </a>
    <?php } ?>
    <?php 
    if (isset($invalid) && !empty($invalid)) {
      echo '<div class="error" id="invalid">';
      echo '<strong>ERRORS:</strong> <br /><br />';
      foreach ($invalid as $key => $value) {
        echo $key .' - '. $value .'<br />';
      }
      echo '</div>';
    }

    $section_page  = '..'. DS .'assessments';
    $section_page .= DS . 'itemset';
    $section_page .= DS . $this->data['Assessment']['item_subset'];
    $section_page .= DS . $this->AvailableSection->get($this->data['Assessment']['type'], $this->data['Facility']['F_STATE'], $section);

    echo $this->element($section_page, array('rug' => $rugs));
    if ($this->Session->read('Auth.User.group_id') != 3) {
      if (($this->data['Assessment']['transmission_status'] == 0) || ($this->data['Assessment']['transmission_status'] == 3)) {
        if ($section == 'r') {
          if ($this->data['Assessment']['validated'] == 1) {
            echo $this->Form->hidden('finished.end', array('value' => 1));
            echo $this->Form->submit('Finalize Assessment');
          }
          else {
            echo $this->Form->hidden('finished.validate', array('value' => 1));
            echo $this->Form->submit('Validate Assessment');
          }
        }
        else {
          echo $this->Form->hidden('finished.end', array('value' => 0));
          echo $this->Form->submit('Save this Section');
        }
      }
    }
    ?>
  </div>
</div>
<?php echo $this->Form->end(); ?>