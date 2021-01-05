
<tr>
	<td colspan="30"><h3>Ancillary Form</h3><td>
</tr>

<!-- header -->
<tr>
	<td colspan="2"><strong>Facility Name</strong></td>
	<td colspan="6" style="border-bottom: 1px solid #333"> <?php echo $allowed_facilities[$this->params['pass'][0]]; ?> </td>
	<td colspan="22">
</tr>
<tr>
	<td colspan="2"><strong>Date</strong></td>
	<td colspan="6" style="border-bottom: 1px solid #333"> <?php echo date('m-d-Y'); ?>  </td>
	<td colspan="22">
</tr>
<tr>
	<td colspan="2"><strong>Unit</strong></td>
	<td colspan="6" style="border-bottom: 1px solid #333"> <?php echo $unit; ?> </td>
	<td colspan="22">
</tr>
<!-- end header -->

<tr>
	<td colspan="5"></td>
	<td colspan="3" class="align-center">Beds</td>
	<td>&nbsp;</td>
	<td colspan="10" class="align-center">Dressings</td>
	<td>&nbsp;</td>
	<td colspan="4" class="align-center">O2</td>
	<td>&nbsp;</td>
	<td colspan="3" class="align-center">Urological</td>
</tr>

<tr>
	<td><?php echo $this->Vertical->put('Room # / Bed Slot'); ?></td>
	<td><?php echo $this->Vertical->put('Last Name'); ?></td>
	<td><?php echo $this->Vertical->put('First Name'); ?></td>
	<td><?php echo $this->Vertical->put('Primary Insurance'); ?></td>
	<td>&nbsp;</td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Bariatric Beds'); ?></td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Rental Beds'); ?></td>
	<td class="field border-lt border-r"><?php echo $this->Vertical->put('Rental Mattress'); ?></td>
	<td>&nbsp;</td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Anti-fungal barrier'); ?></td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Alle-vyn'); ?></td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Exu-derm'); ?></td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Gauze Boarder'); ?></td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Gauze Sponges'); ?></td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Lanti-septic'); ?></td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Maxorb'); ?></td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Opti-foam 4x4'); ?></td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Wound Kit'); ?></td>
	<td class="field border-lt border-r"><?php echo $this->Vertical->put('Wound Vac Pump'); ?></td>
	<td>&nbsp;</td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Nasal Can-nulas'); ?></td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Nebu-lizer Mask'); ?></td>
	<td class="field border-lt"><?php echo $this->Vertical->put('O2 Concentrator'); ?></td>
	<td class="field border-lt border-r"><?php echo $this->Vertical->put('Suction Kit'); ?></td>
	<td>&nbsp;</td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Catheter'); ?></td>
	<td class="field border-lt"><?php echo $this->Vertical->put('Drain Pouch/ Bag'); ?></td>
	<td class="field border-lt border-r"><?php echo $this->Vertical->put('Drain Pouch/ Bag'); ?></td>
</tr>