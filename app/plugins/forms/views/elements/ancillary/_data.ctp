


<?php 
$i = 1;
foreach ($residents as $resident) { 
	if (ceil($i%27) == 0 || $count == $i) {
		echo '<tr class="detail page-break">';
	}
	else 
		echo '<tr class="detail">';
?>


	<td><?php echo $resident['ROOM']; ?><?php echo $resident['BED']; ?></td>
	<td><?php echo ucwords(strtolower($resident['PATLNAME'])); ?></td>
	<td><?php echo ucwords(strtolower($resident['PATFNAME'])); ?></td>
	<td>
	
	<?php 

	switch ($resident['ATYPEOPAY']) {
		case 'MEDICARE A':
			echo '*';
			break;
		case 'MEDICAID':
			echo '';
			break;
		default:
			echo '**';
	}
	
	?>

	</td>
	<td>&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt border-r">&nbsp;</td>
	<td>&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt border-r">&nbsp;</td>
	<td>&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt border-r">&nbsp;</td>
	<td>&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt border-r">&nbsp;</td>
</td>
<?php 

	

	if (ceil($i%27) == 0 && $count != $i) {
		echo $this->element('ancillary/_header', array('page_break' => true, 'unit' => $unit));
	}
	$i++;
} 
?>