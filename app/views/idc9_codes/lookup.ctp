<?php 
if (count($data) == 1) {
  echo $data[0]['Idc9Code']['D_CODE'] .' - '. $data[0]['Idc9Code']['D_ABBR'];
}
else {
  $str  = '<div>';
  $str .= 'We have found multiple codes that apply please limit your selection:' ."<br />";
  foreach ($data as $key => $value) {
    $str .= $value['Idc9Code']['D_CODE'] .' - '. $value['Idc9Code']['D_ABBR'] ."<br />";
  }
  $str .= '</strong>';
  echo $str;
}
