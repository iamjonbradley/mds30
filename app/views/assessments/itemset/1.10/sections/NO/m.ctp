<h2>Section M - Skin Conditions</h2>
<?php
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Report based on highest stage of existing ulcer(s) at its worst; do not "reverse" stage');
?>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
if (isset($this->data['SectionA']['A0310E'])) $A0310E = $this->data['SectionA']['A0310E']; else $A0310E = $this->data['SectionM']['A0310E'];
echo $this->Form->hidden('SectionM.A0310E', array('value' => $A0310E, 'id' => 'A0310E', 'value' => $A0310E));

echo $this->Html->div('header', 'M0300. Current number of Unhealed <span class="normal">(non-epithelialized)</span> Pressure Ulcers at Each Stage');

echo $this->Html->div('', 'B. <strong>Stage 2:</strong> Partial thickness loss of dermis presenting as a shallow open ulcer with a red or pink wound bed, without slough. May also present as an intact or open/ruptured blister');
echo $this->Form->input('SectionM.M0300B1', array('label' => 'Number of Stage 2 pressure ulcers', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('', 'C. <strong>Stage 3:</strong> Full thickness tissue loss. Subcutaneous fat may be visible but bone, tendon or muscle is not exposed. Slough may be present but does not obscure the depth of tissue loss. May include undermining and tunneling');
echo $this->Form->input('SectionM.M0300C1', array('label' => 'Number of Stage 3 pressure ulcers', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('', 'D. <strong>Stage 4:</strong> Full thickness tissue loss with exposed bone, tendon or muscle. Slough or eschar may be present on some parts of the wound bed. Often includes undermining and tunneling');
echo $this->Form->input('SectionM.M0300D1', array('label' => 'Number of Stage 4 pressure ulcers', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('', 'F. <strong>Unstageable - Slough and/or eschar:</strong> Known but not stageable due to coverage of wound bed by slough and/or eschar');
echo $this->Form->input('SectionM.M0300F1', array('label' => 'Number of unstageable pressure ulcers due to coverage of wound bed by slough and/or eschar', 'maxLength' => 1, 'size' => 1));
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php

echo $this->Html->div('header', 'M1030. Number of Venous and Arterial Ulcers');
echo $this->Form->input('SectionM.M1030', array('label' => 'Enter the total number of venous and arterial ulcers present', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('header', 'M1040. Other Ulcers, Wounds and Skin Problems');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $this->Html->div('misc', 'Foot Problems');
echo $this->Form->input('SectionM.M1040A', array('label' => 'A. Infection of the foot <span class="normal">(e.g., cellulitis, purulent drainage)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1040B', array('label' => 'B. Diabetic foot ulcer(s)', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1040C', array('label' => 'C. Other open lesion(s)', 'type' => 'checkbox'));
echo $this->Html->div('misc', 'Other Problems');
echo $this->Form->input('SectionM.M1040D', array('label' => 'D. Open lesion(s) other than ulcers, rashes, cuts <span class="normal">(e.g., cancer lesion)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1040E', array('label' => 'E. Surgical wound(s)', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1040F', array('label' => 'F. Burn(s) <span class="normal">(second and third degree)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1040G', array('label' => 'G. Skin tear(s).', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1040H', array('label' => 'H. Moisture Associated Skin Damage (MASD) (i.e. incontinence (IAD), perspiration, drainage).', 'type' => 'checkbox'));
echo $this->Html->div('misc', 'None of the Above');
echo $this->Form->input('SectionM.M1040Z', array('label' => 'Z. None of the above <span class="normal">(second or third degree)</span>', 'type' => 'checkbox'));

echo $this->Html->div('header', 'M1200. Skin and Ulcer Treatments');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $this->Form->input('SectionM.M1200A', array('label' => 'A. Pressure reducing device for chair', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200B', array('label' => 'B. Pressure reducing device for bed', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200C', array('label' => 'C. Turning/repositioning program', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200D', array('label' => 'D. Nutrition or hydration intervention <span class="normal">to manage skin problems</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200E', array('label' => 'E. Pressure ulcer care', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200F', array('label' => 'F. Surgical wound care', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200G', array('label' => 'G. Application of nonsurgical dressing <span class="normal">(with or without topical medications) other than to feet</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200H', array('label' => 'H. Application of ointments/medications <span class="normal">other than to feet</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200I', array('label' => 'I. Application of dressings to feet <span class="normal">(with or without topical medications)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200Z', array('label' => 'Z. None of the above <span class="normal">were provided</span>', 'type' => 'checkbox'));

?>
</td>
</table>