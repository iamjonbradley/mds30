<style type="text/css">
	* { 
		font-size: 8pt;
	}
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
	.border-l {
		border-left: 1px solid #333;
	}
	.border-b {
		border-bottom: 1px solid #333;
	}
	.field {
		max-width: 16px;
	}
	.align-c {
		vertical-align: center;
		text-align: center;
	}
	.bg-g {
		background-color: #DDD;
	}
	.border-b {
		border-bottom: 1px solid #333;
	}
	.tiny {
		font-size: 7pt;
	}
	br {
		clear: both;
	}
	.bold {
		font-weight: bold;
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
	table.small {
		margin-top: 5px;
		padding-left: 5px;
		padding-right: 5px;
	}
	table.small tr td {
		font-size: 7pt;
		border-bottom: 0;
		text-align: left;
		padding: 0;
	}
	table.small tr .border-b {
		border-bottom: 1px solid #333;
	}
</style>
<table cellspacing="0">
<?php
echo $this->element('matrix/_header', array('unit' => $key, 'cache' => '+1 day')); 
foreach ($data as $key => $value) {
	echo $this->element('matrix/_data', array('unit' => $key, 'residents' => $value, 'count' => count($value))); 
}
?>
</table>