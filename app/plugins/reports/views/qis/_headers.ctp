
<tr>
	<?php 
    $this->Paginator->options(array('url' => $this->passedArgs));
		$header	= '';
		$header .= '<th>ID#</th>' ."\r\n";
		$header .= '<th>Medrec #</th>' ."\r\n";
		$header .= '<th>Last Name</th>' ."\r\n";
		$header .= '<th>First Name</th>' ."\r\n";
		$header .= '<th>ARD</th>' ."\r\n";
		$header .= '<th> Type </th>' ."\r\n";
		
		foreach ($results[0] as $key => $value) {

        	switch ($key) {
        		case 'A1300A':
        		case 'id':
        		case 'A0500C':
        		case 'A0500A':
        		case 'A2300':
        		case 'type':
        			break;
        		default:
					$header .= '<th> '. $key .' </td>' ."\r\n";
					break;
			}
			
		}		
		echo $header;
	?>
</tr>