

<style type="text/css">
	h3 {
		color: #333;
	}
	.border-lt {
		border-left: 1px solid #333;
		border-top: 1px solid #333;
		text-align: center;
	}
	.border-r {
		border-right: 1px solid #333;
	}
	.field {
		max-width: 16px;
	}
	.border-b {
		border-bottom: 1px solid #333;
	}
	table tr:last-child td {
		border-bottom: 1px solid #333;
	}
	table tr.detail:nth-child(2n) td { background: #F5F5F5; }
</style>

<h3>Ancillary Form</h3>

<table border="0" cellspacing="0" cellpadding="2">

<?php echo $this->element('acillary/header'); ?>

<?php foreach ($residents as $resident) { ?>
<tr class="detail">

	<td><?php echo $resident['Resident']['ROOM']; ?><?php echo $resident['Resident']['BED']; ?></td>
	<td><?php echo ucwords(strtolower($resident['Resident']['PATLNAME'])); ?></td>
	<td><?php echo ucwords(strtolower($resident['Resident']['PATFNAME'])); ?></td>
	<td>
	<?php 

	switch ($resident['Resident']['ATYPEOPAY']) {
		case 'MEDICARE A':
			echo '*';
			break;
		case 'MEDICAID':
		default:
			echo '**';
			break;
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
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt border-r">&nbsp;</td>
	<td>&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt">&nbsp;</td>
	<td class="field border-lt border-r">&nbsp;</td>
</tr>
<?php } ?>

</table>