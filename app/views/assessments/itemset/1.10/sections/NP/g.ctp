<h2>Section G - Functional Status</h2>
<?php
echo $form->hidden('SectionG.A0310A', array('value' => $this->data['SectionA']['A0310A'], 'id' => 'A0310A'));

$options = array(
  1 => array(
    0 => '0. <strong>Independent</strong> - no help or staff oversight at any time',
    1 => '1. <strong>Supervision</strong> - oversight, encouragement or cueing',
    2 => '2. <strong>Limited assistance</strong> - resident highly involved in activity; staff provide guided maneuvering of limbs or other non-weight-bearing assistance',
    3 => '3. <strong>Extensive Assistance</strong> - resident involved in activity, staff provide weight-bearing support',
    4 => '4. <strong>Total Dependence</strong> - full staff performance every time during entire 7-day',
    7 => '7. <strong>Activity occurred only once or twice</strong> - activity did occur but only once or twice',
    8 => '8. <strong>Activity did not occur</strong> - activity (or any part of ADL) was not performed by resident or staff at all over the entire 7-day period'
  ),
  2 => array(
    0 => '0. <strong>No</strong> setup of physical help from staff',
    1 => '1. <strong>Setup</strong> help only',
    2 => '2. <strong>One </strong>person physical assist',
    3 => '3. <strong>Two+ </strong>persons physical assist',
    8 => '8. ADL active itself <strong>did not occur</strong> during entire period'
  )
);
?>
<table border="0" cellspacing="0" cellpadding="0" style="max-width:960px" class="adl">
  <tr>
    <td valign="top" colspan="3" class="header">
      G0110. Activites of daily Living (ADL) Assistance<br />
      <span class="normal">Refer to the ADL flow chart in the RAI manual to facilitate accurate coding</span>
    </td>
  </tr>
  <tr>
    <td valign="top" colspan="3" class="border-bottom">
      <strong>Instructions for Rule of 3</strong> <br />
      <ul>
        <li>When an activity occurs three times at any one given level, code that level.</li>
        <li>
          When an activity occurs three times at multiple levels, code the most dependent, exceptions are total dependence (4), activity must require full 
          assist every time, and activity did not occur (8), activity must not have occurred at all. Example, three times extensive assistance (3) and three 
          times limited assistance (2), code extensive assistance (3).
        </li>
        <li>
          When an activity occurs at various levels, but not three times at any given level, apply the following:
          <ul>
            <li>When there is a combination of full staff performance, and extensive assistance, code extensive assistance.</li>
            <li>When there is a combination of full staff performance, weight bearing assistance and/or non-weight bearing assistance code limited assistance (2).</li>
          </ul>         
        </li>
      </ul>
      <strong>If none of the above are met, code supervision.</strong>
    </td>
  </tr>
  <tr>
    <td valign="top">
      <strong>1. ADL Self-Performance</strong> <br />
      Code for <strong>resident's performance</strong> over all shifts - not including setup. If the ADL activity occurred 3 or more times at various levels of 
      assistance, code the most dependent -except for total dependence, which requires full staff performance every time 
      <div class="spacer"></div>
       
      <strong>Coding:</strong> <br />
      &nbsp; &nbsp; &nbsp; &nbsp; <strong><u>Acitvity Occurred 3 or More Times</u></strong> <br />
      <ol start="0">
        <li><strong>Independent</strong> - no help or staff oversight at any time </li>
        <li><strong>Supervision</strong> - oversight, encouragement or cueing </li>
        <li><strong>Limited assistance</strong> - resident highly involved in activity; staff provide guided maneuvering of limbs or other non-weight-bearing assistance</li>
        <li><strong>Extensive assistance</strong> - resident involved in activity, staff provide weight-bearing support</li> 
        <li><strong>Total dependence</strong> - full staff performance every time during entire 7-day period</li>
      </ol>
    </td>
    <td valign="top" colspan="2">
      <strong>2. ADL Support Provided</strong> <br />
      Code for <strong>most support provided</strong> over all shifts; code regardless of resident's self-performance classification
      <div class="spacer"></div>
      
      <strong>Coding:</strong> <br />
      <ol start="0">
        <li><strong>No</strong> setup or physical help from staff</li>
        <li><strong>Setup</strong> help only</li>
        <li><strong>One</strong> person physical assist</li>
        <li><strong>Two+</strong> persons physical assist</li>
      </ol>
      <ol start="8">
        <li>ADL activity itself <strong>did not occur</strong> during entire period</li>
      </ol>
    </td>
  </tr>
  <tr>
    <td valign="top" rowspan="2" style="padding-top: 0" class="border-bottom">
      
      &nbsp; &nbsp; &nbsp; &nbsp; <strong><u>Activity Occurred 2 or Fewer Times</u></strong> <br />
      <ol start="7">
        <li><strong>Activity occurred only once or twice</strong> - activity did occur but only once or twice </li>
        <li><strong>Activity did not occur</strong> - activity (or any part of the ADL) was not performed by resident or staff at all over the entire 7-day period </li>
      </ol>
    </td>
    <td valign="top" class="header-top">
      <strong>1.</strong><br />
      <strong>Self-Performance</strong>
    </td>
    <td valign="top" class="header-top border-right">      
      <strong>2.</strong><br />
      <strong>Support</strong>
    </td>
  </tr>
  <tr>
    <td valign="top" colspan="2" class="border-right border-bottom align-center" style="border-left: 1px solid black;"><strong> ⇣ Enter Codes in Boxes ⇣ </strong></td>
  </tr>
  <!-- start form -->
  <tr class="border-bottom">
    <td valign="top" class="bold border-left">
      <ol style="list-style-type: upper-alpha">
        <li>Bed mobility <span class="normal"> - how resident moves to and from lying position, turns side to side, and positions body while in bed or alternate sleep furniture</span></li>
      </ul>
    </td>
    <td valign="top" class="align-center border-left border-right"><?php echo $this->Form->input('SectionG.G0110A1', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
    <td valign="top" class="align-center border-right"><?php echo $this->Form->input('SectionG.G0110A2', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
  </tr>
  <tr class="border-bottom">
    <td valign="top" class="bold border-left">
      <ol style="list-style-type: upper-alpha" start="2">
        <li>Transfer <span class="normal"> - how resident moves between surfaces including to or from: bed, chair, wheelchair, standing position (</span> excludes <span class="normal"> to/from bath/toilet)</span></li>
      </ul>
    </td>
    <td valign="top" class="align-center border-left border-right"><?php echo $this->Form->input('SectionG.G0110B1', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
    <td valign="top" class="align-center border-right"><?php echo $this->Form->input('SectionG.G0110B2', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
  </tr>
  <tr class="border-bottom">
    <td valign="top" class="bold border-left">
      <ol style="list-style-type: upper-alpha" start="3">
        <li>Walk in room<span class="normal"> - how resident walks between locations in his/her room</span></li>
      </ul>
    </td>
    <td valign="top" class="align-center border-left border-right"><?php echo $this->Form->input('SectionG.G0110C1', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
    <td valign="top" class="align-center border-right"><?php echo $this->Form->input('SectionG.G0110C2', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
  </tr>
  <tr class="border-bottom">
    <td valign="top" class="bold border-left">
      <ol style="list-style-type: upper-alpha" start="4">
        <li>Walk in corridor<span class="normal"> - how resident walks in corridor on unit</span></li>
      </ul>
    </td>
    <td valign="top" class="align-center border-left border-right"><?php echo $this->Form->input('SectionG.G0110D1', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
    <td valign="top" class="align-center border-right"><?php echo $this->Form->input('SectionG.G0110D2', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
  </tr>
  <tr class="border-bottom">
    <td valign="top" class="bold border-left">
      <ol style="list-style-type: upper-alpha" start="5">
        <li>Locomotion on unit - <span class="normal">how resident moves between locations in his/her room and adjacent corridor on same floor. If wheelchair, self-sufficiency once in chair</span></li>
      </ul>
    </td>
    <td valign="top" class="align-center border-left border-right"><?php echo $this->Form->input('SectionG.G0110E1', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
    <td valign="top" class="align-center border-right"><?php echo $this->Form->input('SectionG.G0110E2', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
  </tr>
  <tr class="border-bottom">
    <td valign="top" class="bold border-left">
      <ol style="list-style-type: upper-alpha" start="6">
        <li>Locomotion off unit  - <span class="normal">how resident moves to and from off-unit locations (e.g., areas set aside for dining, activities or treatments). If facility has only one floor, how resident moves to and from distant areas on the floor. If in wheelchair, self-sufficiency once in chair.</span></li>
      </ul>
    </td>
    <td valign="top" class="align-center border-left border-right"><?php echo $this->Form->input('SectionG.G0110F1', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
    <td valign="top" class="align-center border-right"><?php echo $this->Form->input('SectionG.G0110F2', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
  </tr>
  <tr class="border-bottom">
    <td valign="top" class="bold border-left">
      <ol style="list-style-type: upper-alpha" start="7">
        <li>Dressing - <span class="normal">how resident puts on, fastens and takes off all items of clothing, including donning/removing a prosthesis or TED hose. Dressing includes putting on and changing pajamas and housedresses</span></li>
      </ul>
    </td>
    <td valign="top" class="align-center border-left border-right"><?php echo $this->Form->input('SectionG.G0110G1', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
    <td valign="top" class="align-center border-right"><?php echo $this->Form->input('SectionG.G0110G2', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
  </tr>
  <tr class="border-bottom">
    <td valign="top" class="bold border-left">
      <ol style="list-style-type: upper-alpha" start="8">
        <li>Eating - <span class="normal">how resident eats and drinks, regardless of skill. Do not include eating/drinking during medication pass. Includes intake of nourishment by other means (e.g., tube feeding, total parenteral nutrition, IV fluids administered for nutrition of hydration)</span></li>
      </ul>
    </td>
    <td valign="top" class="align-center border-left border-right"><?php echo $this->Form->input('SectionG.G0110H1', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
    <td valign="top" class="align-center border-right"><?php echo $this->Form->input('SectionG.G0110H2', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
  </tr>
  <tr class="border-bottom">
    <td valign="top" class="bold border-left">
      <ol style="list-style-type: upper-alpha" start="9">
        <li>Toilet Use - <span class="normal">how resident uses the toilet room, commode, bedpan, or urinal; transfers on/off toilet; cleanses self after elimination; changes pad; manages ostomy or catheter; and adjusts clothes. Do not include emptying of bedpan, urinal, bedside commode, catheter bag or ostomy bag</span></li>
      </ul>
    </td>
    <td valign="top" class="align-center border-left border-right"><?php echo $this->Form->input('SectionG.G0110I1', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
    <td valign="top" class="align-center border-right"><?php echo $this->Form->input('SectionG.G0110I2', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
  </tr>
  <tr class="border-bottom">
    <td valign="top" class="bold border-left">
      <ol style="list-style-type: upper-alpha" start="10">
        <li>Personal hygiene - <span class="normal">how resident maintains personal hygiene, including combing hair, brushing teeth, shaving, applying make-up, washing/drying face and hands (excludes baths and showers)</span></li>
      </ul>
    </td>
    <td valign="top" class="align-center border-left border-right"><?php echo $this->Form->input('SectionG.G0110J1', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
    <td valign="top" class="align-center border-right"><?php echo $this->Form->input('SectionG.G0110J2', array('label' => false, 'div' => false, 'size' => 1, 'maxLength' => 1, 'class' => 'align-center')); ?></td>   
  </tr>
</table>

<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'G0120. Bathing');
echo $this->Html->div('', 'How resident takes full-body bath/shower, sponge bath, and transfers in/out of tub/shower (<strong>excludes</strong> washing of back and hair). Code for <strong>most dependent</strong> in self-performance and support.');

echo $this->Form->input('SectionG.G0120A', array('label' => 'A. Self Performance', 'id' => 'G0120A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. Independent - no help provided', 
    1 => '1. Supervision - oversight help only', 
    2 => '2. Physical help limited to transfer only', 
    3 => '3. Physical help in part of bathing activity', 
    4 => '4. Total dependence', 
    8 => '8. Activity itself did not occur during the entire period', 
  )));

echo $this->Form->input('SectionG.G0120B', array('label' => 'B. Support provided','type' => 'select', 'select' => false, 'empty' => ' ', 'options' => $options[2]));

echo $this->Html->div('header', 'G0300. Balance During Transitions and Walking');
echo $this->Html->div('', 'After observing the resident, <strong>code the following walking and transition items for most dependent</strong>');

$options = array(
  0 => '0. Steady at all times',
  1 => '1. Not steady, but able to stabilize without human assistance',
  2 => '2. Not steady, only able to stabilize with human assistance',
  8 => '8. Activity did not occur'
);
echo $this->Form->input('SectionG.G0300A', array('label' => 'A. Moving from seated to standing position','type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionG.G0300B', array('label' => 'B. Walking <span class="normal">(with assistive device if used)</span>','type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionG.G0300C', array('label' => 'C. Turning around <span class="normal">and facing the opposite direction while walking</span>','type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionG.G0300D', array('label' => 'D. Moving on and off toilet','type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionG.G0300E', array('label' => 'E. Surface-to-surface <span class="normal">(transfer between bed and chair or wheelchair)</span>','type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header', 'G0400. Functional Limitation in Range of Motion');
echo $this->Html->div('', '<strong>Code for limitation</strong> that interfered with daily functions or placed resident at risk of injury');

$options = array(
  0 => '0. No impairment',
  1 => '1. Impairment on one side',
  2 => '2. Impairment on both sides',
);
echo $this->Form->input('SectionG.G0400A', array('label' => 'A. Upper extremity <span class="normal">(shoulder, elbow, wrist, hand)</span>','type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));
echo $this->Form->input('SectionG.G0400B', array('label' => 'B. Lower extremity <span class="normal">(hip, knee, ankle, foot)</span>','type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => $options));


echo $this->Html->div('header', 'G0600. Mobility Devices');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that were normally used');
echo $this->Form->input('SectionG.G0600A', array('label' => 'A. Cane/crutch', 'type' => 'checkbox'));
echo $this->Form->input('SectionG.G0600B', array('label' => 'B. Walker', 'type' => 'checkbox'));
echo $this->Form->input('SectionG.G0600C', array('label' => 'C. Wheelchair <span class="normal">(manual or electric)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionG.G0600D', array('label' => 'D. Limb prosthesis', 'type' => 'checkbox'));
echo $this->Form->input('SectionG.G0600Z', array('label' => 'Z. None of the above <span class="normal">were used</span>', 'type' => 'checkbox'));

/**
echo $this->Html->div('header G0900', 'G0900. Functional Rehabilitation Potential');

echo $this->Form->input('SectionG.G0900A', array('div' => 'input select G0900', 'label' => 'Resident believes he or she is capable of increased independence <span class="normal">in at least some ADLs</span>', 'id' => 'G0900A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. No', 
    1 => '1. Yes',
    9 => '9. Unable to determine'
  )));

echo $this->Form->input('SectionG.G0900B', array('div' => 'input select G0900', 'label' => 'Direct care staff believe resident is capable of increased independence <span class="normal">in at lease some ADLs</span>', 'id' => 'G0900B', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. No', 
    1 => '1. Yes'
  )));
*/  
?>
</td>
</tr>
</table>