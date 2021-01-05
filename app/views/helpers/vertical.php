<?php

class VerticalHelper extends AppHelper {
	
	function put ($text, $height = 150) {

		$out  = '';
	    $out .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="'. $height .'">';
	    $out .= '  <text id="thetext" transform="rotate(270, 10, -2) translate(-'. ($height-10) .',0)">'. $text .'</text>';
	    $out .= '</svg>';

	    return $out;
		
	}

}