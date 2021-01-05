<h2>
  <?php echo ucwords(strtolower($resident['Resident']['PATLNAME'] .', '. $resident['Resident']['PATFNAME'])); ?> : 
  Assessment # <?php echo $data['SectionV']['assessment_id']; ?> : 
  Caa Summary
</h2>
<?php
// Single would only be true if a user is trying to print one CAA, otherwise it's false.
if($single) {

	if(isset($data['SectionV']['V0200A01D'])) {
		if ($data['SectionV']['V0200A01A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '01. Delirium'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A01D'] .'</p>';
		if (!empty($data['SectionV']['V0200A01F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A01F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A02D'])) {
		if ($data['SectionV']['V0200A02A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '02. Congitive Loss/Dementia'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A02D'] .'</p>';
		if (!empty($data['SectionV']['V0200A02F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A02F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A03D'])) {
		if ($data['SectionV']['V0200A03A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '03. Visual Function'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A03D'] .'</p>';
		if (!empty($data['SectionV']['V0200A03F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A03F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A04D'])) {
		if ($data['SectionV']['V0200A04A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '04. Communication'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A04D'] .'</p>';
		if (!empty($data['SectionV']['V0200A04F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A04F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A05D'])) {	
		if ($data['SectionV']['V0200A05A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '05. ADL Functional/Rehabilitation Potential'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A05D'] .'</p>';
		if (!empty($data['SectionV']['V0200A05F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A05F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A06D'])) {
		if ($data['SectionV']['V0200A06A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '06. Urinary Incontinence and Indwelling Catheter'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A06D'] .'</p>';
		if (!empty($data['SectionV']['V0200A06F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A06F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A07D'])) {
		if ($data['SectionV']['V0200A07A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '07. Psychosocial Well-Being'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A07D'] .'</p>';
		if (!empty($data['SectionV']['V0200A07F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A07F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A08D'])) {
		if ($data['SectionV']['V0200A08A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '08. Mood State'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A08D'] .'</p>';
		if (!empty($data['SectionV']['V0200A08F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A08F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A09D'])) {
		if ($data['SectionV']['V0200A09A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '09. Behavioral Symptoms'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A09D'] .'</p>';
		if (!empty($data['SectionV']['V0200A06F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A09F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A010D'])) {
		if ($data['SectionV']['V0200A10A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '10. Activites'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A10D'] .'</p>';
		if (!empty($data['SectionV']['V0200A10F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A10F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A11D'])) {
		if ($data['SectionV']['V0200A11A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '11. Falls'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A11D'] .'</p>';
		if (!empty($data['SectionV']['V0200A11F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A11F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A12D'])) {
		if ($data['SectionV']['V0200A12A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '12. Nutritional Status'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A12D'] .'</p>';
		if (!empty($data['SectionV']['V0200A12F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A12F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A13D'])) {
		if ($data['SectionV']['V0200A13A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '13. Feeding Tubes'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A13D'] .'</p>';
		if (!empty($data['SectionV']['V0200A13F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A13F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A14D'])) {
		if ($data['SectionV']['V0200A14A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '14. Dehydration/Fluid Maintenance'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A14D'] .'</p>';
		if (!empty($data['SectionV']['V0200A14F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A14F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A15D'])) {
		if ($data['SectionV']['V0200A15A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '15. Dental Care'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A15D'] .'</p>';
		if (!empty($data['SectionV']['V0200A15F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A15F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A16D'])) {
		if ($data['SectionV']['V0200A16A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '16. Pressure Ulcer'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A16D'] .'</p>';
		if (!empty($data['SectionV']['V0200A16F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A16F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A17D'])) {
		if ($data['SectionV']['V0200A17A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '17. Psychotropic Drug Use'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A17D'] .'</p>';
		if (!empty($data['SectionV']['V0200A17F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A17F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A18D'])) {
		if ($data['SectionV']['V0200A18A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '18. Physical Restraints'. $triggered);
		echo '<p>'. '<p>'. $data['SectionV']['V0200A18D'] .'</p>';
		if (!empty($data['SectionV']['V0200A18F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A18F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A19D'])) {
		if ($data['SectionV']['V0200A19A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '19. Pain'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A19D'] .'</p>';
		if (!empty($data['SectionV']['V0200A19F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A19F'] .'</span>';
	}
	
	if(isset($data['SectionV']['V0200A20D'])) {	
		if ($data['SectionV']['V0200A20A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
		echo $this->Html->div('header', '20. Return to Community Referral'. $triggered);
		echo '<p>'. $data['SectionV']['V0200A20D'] .'</p>';
		if (!empty($data['SectionV']['V0200A20F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A20F'] .'</span>';
	}
}
else {
	
	if ($data['SectionV']['V0200A01A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '01. Delirium'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A01D'] .'</p>';
	if (!empty($data['SectionV']['V0200A01F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A01F'] .'</span>';
	
	if ($data['SectionV']['V0200A02A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '02. Congitive Loss/Dementia'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A02D'] .'</p>';
	if (!empty($data['SectionV']['V0200A02F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A02F'] .'</span>';
	
	if ($data['SectionV']['V0200A03A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '03. Visual Function'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A03D'] .'</p>';
	if (!empty($data['SectionV']['V0200A03F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A03F'] .'</span>';
	
	if ($data['SectionV']['V0200A04A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '04. Communication'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A04D'] .'</p>';
	if (!empty($data['SectionV']['V0200A04F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A04F'] .'</span>';
	
	if ($data['SectionV']['V0200A05A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '05. ADL Functional/Rehabilitation Potential'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A05D'] .'</p>';
	if (!empty($data['SectionV']['V0200A05F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A05F'] .'</span>';
	
	if ($data['SectionV']['V0200A06A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '06. Urinary Incontinence and Indwelling Catheter'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A06D'] .'</p>';
	if (!empty($data['SectionV']['V0200A06F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A06F'] .'</span>';
	
	if ($data['SectionV']['V0200A07A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '07. Psychosocial Well-Being'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A07D'] .'</p>';
	if (!empty($data['SectionV']['V0200A07F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A07F'] .'</span>';
	
	if ($data['SectionV']['V0200A08A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '08. Mood State'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A08D'] .'</p>';
	if (!empty($data['SectionV']['V0200A08F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A08F'] .'</span>';
	
	if ($data['SectionV']['V0200A09A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '09. Behavioral Symptoms'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A09D'] .'</p>';
	if (!empty($data['SectionV']['V0200A06F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A09F'] .'</span>';
	
	if ($data['SectionV']['V0200A10A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '10. Activites'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A10D'] .'</p>';
	if (!empty($data['SectionV']['V0200A10F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A10F'] .'</span>';
	
	if ($data['SectionV']['V0200A11A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '11. Falls'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A11D'] .'</p>';
	if (!empty($data['SectionV']['V0200A11F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A11F'] .'</span>';
	
	if ($data['SectionV']['V0200A12A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '12. Nutritional Status'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A12D'] .'</p>';
	if (!empty($data['SectionV']['V0200A12F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A12F'] .'</span>';
	
	if ($data['SectionV']['V0200A13A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '13. Feeding Tubes'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A13D'] .'</p>';
	if (!empty($data['SectionV']['V0200A13F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A13F'] .'</span>';
	
	if ($data['SectionV']['V0200A14A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '14. Dehydration/Fluid Maintenance'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A14D'] .'</p>';
	if (!empty($data['SectionV']['V0200A14F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A14F'] .'</span>';
	
	if ($data['SectionV']['V0200A15A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '15. Dental Care'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A15D'] .'</p>';
	if (!empty($data['SectionV']['V0200A15F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A15F'] .'</span>';
	
	if ($data['SectionV']['V0200A16A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '16. Pressure Ulcer'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A16D'] .'</p>';
	if (!empty($data['SectionV']['V0200A16F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A16F'] .'</span>';
	
	if ($data['SectionV']['V0200A17A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '17. Psychotropic Drug Use'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A17D'] .'</p>';
	if (!empty($data['SectionV']['V0200A17F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A17F'] .'</span>';
	
	if ($data['SectionV']['V0200A18A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '18. Physical Restraints'. $triggered);
	echo '<p>'. '<p>'. $data['SectionV']['V0200A18D'] .'</p>';
	if (!empty($data['SectionV']['V0200A18F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A18F'] .'</span>';
	
	if ($data['SectionV']['V0200A19A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '19. Pain'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A19D'] .'</p>';
	if (!empty($data['SectionV']['V0200A19F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A19F'] .'</span>';
	
	if ($data['SectionV']['V0200A20A'] == 1) $triggered = ' - Triggered'; else $triggered = '';
	echo $this->Html->div('header', '20. Return to Community Referral'. $triggered);
	echo '<p>'. $data['SectionV']['V0200A20D'] .'</p>';
	if (!empty($data['SectionV']['V0200A20F'])) echo '<span class="small">Lock Date: '. $data['SectionV']['V0200A20F'] .'</span>';
}
  ?>	