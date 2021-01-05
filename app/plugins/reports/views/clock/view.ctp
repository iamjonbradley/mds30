<style type="text/css">
  body { background: #EAF1F2; font-family:"Trebuchet MS", sans-serif; font-size: 8pt; margin: 0; }
  table { width: 100%; }
  table tr td.actions { text-align: center; }
  th { text-align: center; font-size: 12pt; }
  table tr td { border: 0; }
  table.clock { width: 500px; }
  table.clock tr td { text-align: center; }
  table { border-right:0; clear: both; color: #333; margin-bottom: 10px; }
  th { border:0; border-bottom:2px solid #555; padding:4px; }
  th a { display: block; padding: 2px 4px; text-decoration: none; }
  table.clock tr td { background: #fff; padding: 6px; text-align: left; vertical-align: top; border-bottom:1px solid #ddd; }
  table.clock tr:nth-child(2n) td { background: #f5f5f5; }
  table.clock .altrow td { background: #f5f5f5; }
</style>
<h2>MDS CLOCK</h2>
<table class="clock" cellspacing="0" cellpadding="4">
  <tr>
    <th style="border-bottom: 0;">&nbsp;</th>
    <th style="border-top: 2px solid; border-left: 2px solid;" colspan="3">
      ARD Window
    </th>
    <th style="border-top: 2px solid; border-left: 2px solid; border-right: 2px solid;" colspan="3">
      Coverage
    </th>
  </tr>
  <tr>
    <th>Asessment</th>
    <th style="border-left: 2px solid;">Start</th>
    <th>End</th>
    <th>Grace</th>
    <th style="border-left: 2px solid;">Start</th>
    <th>End</th>
    <th style="border-right: 2px solid;">Days</th>
  </tr>
  <?php 
    $i = 1;
    $ttl = count ($clock);
    foreach ($clock as $key => $value) { 
      if ($ttl == $i)
        $style = 'border-bottom: 2px solid; text-align:center;';
      else 
        $style = 'text-align:center;';
  ?>
    <tr>
      <td style="<?php echo $style; ?> border-left: 2px solid;"><?php echo $value['asmt']; ?></td>
      <td style="<?php echo $style; ?>"><?php echo $value['ard']['s']; ?></td>
      <td style="<?php echo $style; ?>"><?php echo $value['ard']['e']; ?></td>
      <td style="<?php echo $style; ?>"><?php echo $value['ard']['g']; ?></td>
      <td style="<?php echo $style; ?>"><?php echo $value['cvr']['s']; ?></td>
      <td style="<?php echo $style; ?>"><?php echo $value['cvr']['e']; ?></td>
      <td style="<?php echo $style; ?> border-right: 2px solid;"><?php echo $value['cvr']['d']; ?></td>
    </tr>
  <?php 
    $i++;
  } 
  ?>
</table>