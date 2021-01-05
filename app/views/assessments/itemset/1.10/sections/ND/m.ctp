<h2>Section M - Skin Conditions</h2>
<?php
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Report based on highest stage of existing ulcer(s) at its worst; do not "reverse" stage');
?>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="48%">
<?php
	
echo $this->Html->div('header', 'M0100. Determination of Pressure Ulcer Risk');
echo $this->Html->div('note', '<img src="/img/icons/lightbulb.png" class="note-img" /> <strong>NOTE:</strong> Check all that apply');
echo $this->Form->input('SectionM.M0100A', array('label' => 'A. Resident has a stage 1 or greater, a scar over bony prominence, or a non-removable dressing/device', 'type' => 'checkbox'));

echo $this->Html->div('header M0300', 'M0300. Current number of Unhealed <span class="normal">(non-epithelialized)</span> Pressure Ulcers at Each Stage');
echo $this->Form->input('SectionM.M0300A', array('label' => 'A. Number of State 1 pressure ulcers <br /> Stage 1: <span class="normal">Intact skin with non-blanchable redness of a localized area usually over a bony prominence. Darkly pigmented skin may not have a visible blanching; in dark skin tones only it may appear with persistent blue or purple hues</span>', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('M0300', 'B. <strong>Stage 2:</strong> Partial thickness loss of dermis presenting as a shallow open ulcer with a red or pink wound bed, without slough. May also present as an intact or open/ruptured blister');
echo $this->Form->input('SectionM.M0300B1', array('label' => 'Number of Stage 2 pressure ulcers', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0300B2', array('label' => 'Number of these Stage 2 pressure ulcers that were present upon admission/reentry', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0300B3', array('label' => 'Date of oldest Stage 2 pressure ulcer:', 'type' => 'text', 'between' => 'Format as YYYY-MM-DD<br />', 'maxLength' => 10, 'size' => 10));

echo $this->Html->div('M0300', 'C. <strong>Stage 3:</strong> Full thickness tissue loss. Subcutaneous fat may be visible but bone, tendon or muscle is not exposed. Slough may be present but does not obscure the depth of tissue loss. May include undermining and tunneling');
echo $this->Form->input('SectionM.M0300C1', array('label' => 'Number of Stage 3 pressure ulcers', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0300C2', array('label' => 'Number of these Stage 3 pressure ulcers that were present upon admission/reentry', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('M0300', 'D. <strong>Stage 4:</strong> Full thickness tissue loss with exposed bone, tendon or muscle. Slough or eschar may be present on some parts of the wound bed. Often includes undermining and tunneling');
echo $this->Form->input('SectionM.M0300D1', array('label' => 'Number of Stage 4 pressure ulcers', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0300D2', array('label' => 'Number of these Stage 4 pressure ulcers that were present upon admission/reentry', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('M0300', 'E. <strong>Unstageable - Non-removable dressing:</strong> Known but not stageable due to non-removable dressing/device');
echo $this->Form->input('SectionM.M0300E1', array('label' => 'Number of unstageable pressure ulcers due to non-removable dressing/device', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0300E2', array('label' => 'Number of these unstageable pressure ulcers that were present upon admission/reentry', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('M0300', 'F. <strong>Unstageable - Slough and/or eschar:</strong> Known but not stageable due to coverage of wound bed by slough and/or eschar');
echo $this->Form->input('SectionM.M0300F1', array('label' => 'Number of unstageable pressure ulcers due to coverage of wound bed by slough and/or eschar', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0300F2', array('label' => 'Number of these unstageable pressure ulcers that were present upon admission/reentry', 'maxLength' => 1, 'size' => 1));

echo $this->Html->div('M0300', 'G. <strong>Unstageable - Deep tissue:</strong> Suspected deep tissue injury in evolution');
echo $this->Form->input('SectionM.M0300G1', array('label' => 'Number of unstageable pressure ulcers with suspected deep tissue injury in evolution', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0300G2', array('label' => 'Number of these unstageable pressure ulcers that were present upon admission/reentry', 'maxLength' => 1, 'size' => 1));
?>
</td>
<td valign="top" class="spacer">&nbsp;</td>
<td valign="top" width="48%">
<?php
echo $this->Html->div('header M0610', 'M0610. Dimensions of Unhealed Stage 3 or 4 Pressure Ulcers or Eschar');
echo $this->Html->div('M0610', 'lf the resident has one or more unhealed (non-epithelialized) Stage 3 or 4 pressure ulcers or an ustageble pressure ulcer due to slough or eschar, identify the pressure ulcer with the largest surface area (length x width) and record in centimeters:');
echo $this->Form->input('SectionM.M0610A', array('div' => 'input text M0610', 'label' => 'A. Pressure ulcer length', 'maxLength' => 4, 'size' => 4));
echo $this->Form->input('SectionM.M0610B', array('div' => 'input text M0610', 'label' => 'B. Pressure ulcer width', 'maxLength' => 4, 'size' => 4));
echo $this->Form->input('SectionM.M0610C', array('div' => 'input text M0610', 'label' => 'C. Pressure ulcer depth', 'maxLength' => 4, 'size' => 4));
	
echo $this->Html->div('header M0800', 'M0800. Worsening ln Pressure Ulcer Status Since Prior Assessment (OBRA, PPS, or Discharge)');
echo $this->Form->input('SectionM.M0800A', array('div' => 'input text float-left', 'label' => 'A. Stage 2', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0800B', array('div' => 'input text float-left', 'label' => 'B. Stage 3', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0800C', array('div' => 'input text float-left', 'label' => 'C. Stage 4', 'maxLength' => 1, 'size' => 1));


echo $this->Html->div('header M0900', 'M0900. Healed Pressure Ulcers');
echo $this->Form->input('SectionM.M0900A', array('label' => 'A. Were pressure ulcers present on the prior assessment (OBRA, PPS, or Discharge)?', 'id' => 'M0900A', 'type' => 'select', 'escape' => false, 'empty' => ' ', 'options' => array(
		0 => '0. No', 
		1 => '1. Yes', 
	)));
echo $this->Form->input('SectionM.M0900B', array('div' => 'input text float-left', 'label' => 'B. Stage 2', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0900C', array('div' => 'input text float-left', 'label' => 'C. Stage 3', 'maxLength' => 1, 'size' => 1));
echo $this->Form->input('SectionM.M0900D', array('div' => 'input text float-left', 'label' => 'D. Stage 4', 'maxLength' => 1, 'size' => 1));
?>
</td>
</table>