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

	.page-break {
		page-break-after: always;
	}
	table tr.page-break td {
		border-bottom: 1px solid #333;
	}
</style>
<table border="0" cellspacing="0" cellpadding="2">
<?php 


foreach ($data as $key => $value) {
	echo $this->element('ancillary/_header', array('unit' => $key)); 
	echo $this->element('ancillary/_data', array('unit' => $key, 'residents' => $value, 'count' => count($value))); 
}

?>
</table>