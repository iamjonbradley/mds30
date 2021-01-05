<?php

echo '<option value=""> select a resident </option>';

if (!empty ($data)) {
  foreach ($data as $key => $value) {
    echo '<option value="'. $key .'">'. ucwords(strtolower($value)) .'</option>';
  }
}