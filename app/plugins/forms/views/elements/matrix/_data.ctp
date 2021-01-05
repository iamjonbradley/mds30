<?php 

$i = 1;
foreach ($data as $key => $value) {
	if (ceil($i%20) == 0 || $count == $i) 
		echo '<tr class="detail page-break">';
	else 
		echo '<tr class="detail">';

	foreach ($value as $key2 => $value2) {

		switch ($key2) {
			case 11: case 17: case 20: case 21: case 24:
			case 27: case 28: case 30: case 43:
				echo '<td class="border-lt border-r align-c">';
				break;
			default:
				echo '<td class="border-lt align-c">';
		}

		echo $value2 .'</td>';
	}

	echo '</tr>';
	

} 
?>