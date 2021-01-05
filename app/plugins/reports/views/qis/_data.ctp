<?php

      foreach ($results as $key => $value) {
      	
        echo '<tr>';
        foreach ($value as $key2 => $value2) {
        	echo '<td class="align-center">'. $value2.' </td>' ."\r\n";
        }
        echo '</tr>';
        
      }