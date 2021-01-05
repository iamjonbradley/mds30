<h2>Section M - Skin Conditions</h2>
<?php
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Report based on highest stage of existing ulcer(s) at its worst; do not "reverse" stage');
?>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
echo $this->Form->hidden('SectionM.A0310E', array('value' => $this->data['SectionA']['A0310E'], 'id' => 'A0310E'));
echo $this->Html->div('header', 'M0100. Determination of Pressure Ulcer Risk');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $this->Form->input('SectionM.M0100A', array('label' => 'A. Resident has a stage 1 or greater, a scar over bony prominence, or a non-removable dressing/device', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M0100B', array('label' => 'B. Formal assessment instrument/tool <span class="normal">(e.g., Braden, Norton, or other)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M0100C', array('label' => 'C. Clinical assessment', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M0100Z', array('label' => 'Z. None of the above', 'type' => 'checkbox'));

echo $this->Html->div('header', 'M0150. Risk of Pressure Ulcers');
echo $this->Form->input('SectionM.M0150', array('label' => 'Is this resident at risk of developing pressure ulcers?', 'id' => 'M0150', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes', 
	)));

echo $this->Html->div('header', 'M0210. Unhealed Pressure Ulcer(s)');
echo $this->Form->input('SectionM.M0210', array('label' => 'Does this resident have one or more unhealed pressure ulcer(s) at Stage 1 or higher?', 'id' => 'M0210', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
    0 => '0. No', 
    1 => '1. Yes', 
	)));
	
echo '<div class="M0210-SKIP">';
echo $this->Html->div('header', 'M0300. Current number of Unhealed <span class="normal">(non-epithelialized)</span> Pressure Ulcers at Each Stage');
echo $this->Form->input('SectionM.M0300A', array('label' => 'A. Number of State 1 pressure ulcers <br /> Stage 1: <span class="normal">Intact skin with non-blanchable redness of a localized area usually over a bony prominence. Darkly pigmented skin may not have a visible blanching; in dark skin tones only it may appear with persistent blue or purple hues</span>', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('', 'B. <strong>Stage 2:</strong> Partial thickness loss of dermis presenting as a shallow open ulcer with a red or pink wound bed, without slough. May also present as an intact or open/ruptured blister');
echo $this->Form->input('SectionM.M0300B1', array('label' => 'Number of Stage 2 pressure ulcers', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0300B2', array('label' => 'Number of these Stage 2 pressure ulcers that were present upon admission/reentry', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0300B3', array('label' => 'Date of oldest Stage 2 pressure ulcer:', 'type' => 'text', 'between' => 'Format as YYYY-MM-DD<br />', 'maxLength' => 10, 'size' => 10));

echo $this->Html->div('', 'C. <strong>Stage 3:</strong> Full thickness tissue loss. Subcutaneous fat may be visible but bone, tendon or muscle is not exposed. Slough may be present but does not obscure the depth of tissue loss. May include undermining and tunneling');
echo $this->Form->input('SectionM.M0300C1', array('label' => 'Number of Stage 3 pressure ulcers', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0300C2', array('label' => 'Number of these Stage 3 pressure ulcers that were present upon admission/reentry', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('', 'D. <strong>Stage 4:</strong> Full thickness tissue loss with exposed bone, tendon or muscle. Slough or eschar may be present on some parts of the wound bed. Often includes undermining and tunneling');
echo $this->Form->input('SectionM.M0300D1', array('label' => 'Number of Stage 4 pressure ulcers', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0300D2', array('label' => 'Number of these Stage 4 pressure ulcers that were present upon admission/reentry', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('', 'E. <strong>Unstageable - Non-removable dressing:</strong> Known but not stageable due to non-removable dressing/device');
echo $this->Form->input('SectionM.M0300E1', array('label' => 'Number of unstageable pressure ulcers due to non-removable dressing/device', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0300E2', array('label' => 'Number of these unstageable pressure ulcers that were present upon admission/reentry', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('', 'F. <strong>Unstageable - Slough and/or eschar:</strong> Known but not stageable due to coverage of wound bed by slough and/or eschar');
echo $this->Form->input('SectionM.M0300F1', array('label' => 'Number of unstageable pressure ulcers due to coverage of wound bed by slough and/or eschar', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0300F2', array('label' => 'Number of these unstageable pressure ulcers that were present upon admission/reentry', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('', 'G. <strong>Unstageable - Deep tissue:</strong> Suspected deep tissue injury in evolution');
echo $this->Form->input('SectionM.M0300G1', array('label' => 'Number of unstageable pressure ulcers with suspected deep tissue injury in evolution', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0300G2', array('label' => 'Number of these unstageable pressure ulcers that were present upon admission/reentry', 'maxLength' => 1, 'size' => 1));
echo '</div>';
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
echo '<div class="M0210-SKIP">';
echo $this->Html->div('header', 'M0610. Dimensions of Unhealed Stage 3 or 4 Pressure Ulcers or Eschar');
echo $this->Html->div('', 'lf the resident has one or more unhealed (non-epithelialized) Stage 3 or 4 pressure ulcers or an ustageble pressure ulcer due to slough or eschar, identify the pressure ulcer with the largest surface area (length x width) and record in centimeters:');
echo $this->Form->input('SectionM.M0610A', array('div' => 'input text M0610', 'label' => 'A. Pressure ulcer length', 'maxLength' => 4, 'size' => 4));
echo $this->Form->input('SectionM.M0610B', array('div' => 'input text M0610', 'label' => 'B. Pressure ulcer width', 'maxLength' => 4, 'size' => 4));
echo $this->Form->input('SectionM.M0610C', array('div' => 'input text M0610', 'label' => 'C. Pressure ulcer depth', 'maxLength' => 4, 'size' => 4));

echo $this->Html->div('header', 'M0700. Most Severe Tissue Type for Any Pressure Ulcer');
echo $this->Form->input('SectionM.M0700', array('label' => '<span class="normal">Select the best description of the most severe type of tissue present in any pressure ulcer bed</span>', 'id' => 'M0700', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		'-' => '-. Cannot be visualized', 
		1 => '1. Epithelial tissue', 
		2 => '2. Granulation tissue', 
		3 => '3. Slough', 
		4 => '4. Necrotic tissue (Eschar)', 
	)));
	
echo '<div class="M0800-SKIP">';
echo $this->Html->div('header', 'M0800. Worsening ln Pressure Ulcer Status Since Prior Assessment (OBRA, PPS, or Discharge)');
echo $this->Form->input('SectionM.M0800A', array('div' => 'input text float-left', 'label' => 'A. Stage 2', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0800B', array('div' => 'input text float-left', 'label' => 'B. Stage 3', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0800C', array('div' => 'input text float-left', 'label' => 'C. Stage 4', 'maxLength' => 1, 'size' => 1));
echo '</div>';

echo '</div>';

echo '<div class="M0900-SKIP">';
echo $this->Html->div('header', 'M0900. Healed Pressure Ulcers');
echo $this->Form->input('SectionM.M0900A', array('label' => 'A. Were pressure ulcers present on the prior assessment (OBRA, PPS, or Discharge)?', 'id' => 'M0900A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes', 
	)));
echo $this->Form->input('SectionM.M0900B', array('div' => 'input text float-left', 'label' => 'B. Stage 2', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0900C', array('div' => 'input text float-left', 'label' => 'C. Stage 3', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0900D', array('div' => 'input text float-left', 'label' => 'D. Stage 4', 'maxLength' => 1, 'size' => 1));
echo '</div>';

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
echo $this->Html->div('misc', 'None of the Above');
echo $this->Form->input('SectionM.M1040Z', array('label' => 'Z. None of the above <span class="normal">(second or third degree)</span>', 'type' => 'checkbox'));

echo $this->Html->div('header', 'M1200. Skin and Ulcer Treatments');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $this->Form->input('SectionM.M1200A', array('label' => 'A. Pressure reducing device for chair', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200B', array('label' => 'B. Pressure reducing device for bed', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200C', array('label' => 'C. Turning/repositioning program', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200D', array('label' => 'D. Nutrition or hydration intervention <span class="normal">to manage skin problems</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200E', array('label' => 'E. Ulcer care', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200F', array('label' => 'F. Surgical wound care', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200G', array('label' => 'G. Application of nonsurgical dressing <span class="normal">(with or without topical medications) other than to feet</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200H', array('label' => 'H. Application of ointments/medications <span class="normal">other than to feet</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200I', array('label' => 'I. Application of dressings to feet <span class="normal">(with or without topical medications)</span>', 'type' => 'checkbox'));
echo $this->Form->input('SectionM.M1200Z', array('label' => 'Z. None of the above <span class="normal">were provided</span>', 'type' => 'checkbox'));
?>
</td>
</table>