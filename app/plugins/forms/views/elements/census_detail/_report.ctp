<?php 
echo $this->element('census_detail/_css');

if ($this->params['action'] == 'view') 
    echo $this->element('census_detail/_js'); 
?>
   	<h2>
    <?php 
    echo $cleaned['details']['name']; 

    if ($this->params['action'] == 'view') {
        echo ' <span class="medium">';
        echo '('. $this->Html->link('refresh report', array('action' => 'refresh', $this->params['pass'][0])) .')';
        echo '</span>';
    }
    ?>

    </h2>
    <h3>Created for <?php echo $cleaned['details']['facility']; ?></h3>

    	<table class="results census" cellspacing="0" width="100">

    	<?php

    	$headers  = '<tr class="%s sub-cols inner">';
    	$headers .= '	<td class="column-header align-left">Patient #</td>';
    	$headers .= '	<td class="column-header align-left">Resident Name</td>';
    	$headers .= '	<td class="column-header align-center">Status</td>';
    	$headers .= '	<td class="column-header align-center">Completion Date</td>';
    	$headers .= '	<td class="column-header align-left">Assessment #</td>';
    	$headers .= '</tr>';

    	foreach ($cleaned['data'] as $key => $value) {
    			
            if ($this->params['action'] == 'view') {
                $clean = strtolower($key);
                $clean = str_replace(array('-', '.', ' ', '/'), '', $clean);

                $name  = $this->Html->link($key, '#', array('id' => $clean, 'class' => 'show_hide', 'escape' => false));
                $name .= ' - <span class="small">( click to show/hide )</span>';
            }
            else {
                $clean = '';
                $name = $key;
            }

    		echo '<tr><td class="header" colspan="5">'. $name .'</td></tr>';
    		
    		foreach ($value as $header1 => $value2) {

    			echo '<tr class="'. $clean .' sub-1 inner"><td class="sub-header" colspan="5">'. $header1 .'</td></tr>';
    			echo sprintf($headers, $clean);
    			
    			foreach ($value2 as $key2 => $field) {
    				echo '<tr class="'. $clean .' sub-2 inner">';
    				echo '	<td>'. $field['PATNUM'] .'</td>';
    				echo '	<td>'. $field['NAME'] .'</td>';
    				echo '	<td class="align-center">'. $field['STATUS'] .'</td>';
    				echo '	<td class="align-center">'. $field['LOCK'] .'</td>';
    				echo '	<td>'. $field['ASMT'] .'</td>';
    				echo '</tr>';

    			}

    		}

    		echo '<tr><td class="spacer" colspan="5"></td></tr>';

    	}

    	?>

    	</table>