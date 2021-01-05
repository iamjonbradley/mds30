
<?php echo $this->element('../assessments/_disable_inputs'); ?>
<h2>Please pick a section</h2>
<?php 

echo $this->Form->create('SectionV', array('url' => '/assessments/caa/'. $this->data['Assessment']['id'], 'id' => 'addAssessment'));
echo $this->Form->hidden('id', array('value' => $this->data['Assessment']['id']));
echo $this->Form->hidden('Assessment.item_subset', array('value' => $this->data['Assessment']['item_subset']));
echo $this->Form->hidden('assessment_id', array('value' => $this->data['Assessment']['id']));
echo $this->Form->hidden('state', array('value' => $this->data['Facility']['F_STATE']));
echo $this->Form->hidden('resident_id', array('value' => $this->data['Assessment']['resident']));
echo $this->Form->hidden('SectionA.validated', array('id' => 'SectionA-validated', 'value' => $this->data['SectionA']['validated']));
echo $this->Form->hidden('Assessment.type', array('value' => $this->data['Assessment']['type']));
echo $this->Form->hidden('age', array('id' => 'age', 'value' => $this->data['SectionA']['age']));
echo $this->Form->hidden('admitted', array('id' => 'admitted', 'value' => $this->data['SectionA']['admitted']));

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
  echo $this->Form->hidden('B0100', array('id' => 'B0100',  'value' => $this->data['SectionB']['B0100']));
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
  
<a href="/printing/caa/<?php echo $this->data['Assessment']['id']; ?>" target="new">
  <img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>
<span class="float-right printer">Print&nbsp;All&nbsp;-&nbsp;</span>  
<h2>Care Area Assessments (CAA) Summary</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top">
<?php
if ($this->data['SectionV']['V0200A01A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/1" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '01. Delirium'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/01" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '01'));

if ($this->data['SectionV']['V0200A02A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/2" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '02. Congitive Loss/Dementia'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/02" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '02'));

if ($this->data['SectionV']['V0200A03A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/3" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '03. Visual Function'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/03" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '03'));

if ($this->data['SectionV']['V0200A04A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/4" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '04. Communication'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/04" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '04'));

if ($this->data['SectionV']['V0200A05A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/5" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '05. ADL Functional/Rehabilitation Potential'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/05" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '05'));

if ($this->data['SectionV']['V0200A06A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/6" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '06. Urinary Incontinence and Indwelling Catheter'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/06" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '06'));

if ($this->data['SectionV']['V0200A07A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/7" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '07. Psychosocial Well-Being'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/07" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '07'));

if ($this->data['SectionV']['V0200A08A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/8" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '08. Mood State'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/08" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '08'));

if ($this->data['SectionV']['V0200A09A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/9" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '09. Behavioral Symptoms'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/09" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '09'));

if ($this->data['SectionV']['V0200A10A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/10" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '10. Activites'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/10" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '10'));

if ($this->data['SectionV']['V0200A11A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/11" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '11. Falls'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/11" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '11'));

if ($this->data['SectionV']['V0200A12A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/12" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '12. Nutritional Status'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/12" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '12'));

if ($this->data['SectionV']['V0200A13A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/13" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '13. Feeding Tubes'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/13" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '13'));

if ($this->data['SectionV']['V0200A14A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/14" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '14. Dehydration/Fluid Maintenance'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/14" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '14'));

if ($this->data['SectionV']['V0200A15A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/15" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '15. Dental Care'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/15" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '15'));

if ($this->data['SectionV']['V0200A16A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/16" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '16. Pressure Ulcer'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/16" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '16'));

if ($this->data['SectionV']['V0200A17A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/17" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '17. Psychotropic Drug Use'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/17" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '17'));

if ($this->data['SectionV']['V0200A18A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/18" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '18. Physical Restraints'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/18" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '18'));

if ($this->data['SectionV']['V0200A19A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/19" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '19. Pain'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/19" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '19'));

if ($this->data['SectionV']['V0200A20A'] == 1) $triggered = ' - <a rel="facebox" href="/assessments/catreason/'.$this->data['Assessment']['id'].'/20" title="Why is the Cat triggered?">Triggered</a>'; else $triggered = '';
echo $this->Html->div('header', '20. Return to Community Referral'. $triggered .
'<a href="/printing/caa/' .$this->data['Assessment']['id'] .'/V20" target="new">
	<img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>');
echo $this->element('../assessments/_caa_field', array('n' => '20'));
  ?>	
</td>
</table>
<?php
echo $this->Form->submit('Save Care Plan');
?>
  </div>
</div>
<?php echo $this->Form->end(); ?>