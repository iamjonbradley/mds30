<strong style="font-size: 140%">Enter an IDC 9 Code or Partial IDC 9 Code to get a list of available codes.</strong>
<style type="text/css" media="screen">
	.note {
	  margin: 4px;
	  padding: 8px;
	  font-size:
	}
</style>
<?php
echo $this->Form->create('Idc9Code', array('action' => 'search'));
echo $this->Form->input('D_CODE', array('label' => 'Code'));
echo $this->Form->input('D_ABBR', array('label' => 'Description'));
echo $this->Form->submit('Search');
echo $this->Form->end();

if (isset($data) && !empty($data)) { 
  $count = count($data);

  echo $this->Html->div('note', '<strong>NOTE:</strong> <br /> To search within the please hit the Control Button + F (CTRL+F) Key to do so.');
?>


<table cellspacing="0" width="100%">
  <tr>
    <th width="40">Code</th>
    <th width="150">Description</th>
    <th style="border-bottom: 0"></th>
    <th width="40">Code</th>
    <th width="150">Description</th>
  </tr>
  
  <?php
  
 
  $i = 1;
  echo '<tr>';
  foreach ($data as $key => $value) {
    echo '<td>'. $value['Idc9Code']['D_CODE'] .'</td>';
    echo '<td>'. $value['Idc9Code']['D_ABBR'] .'</td>';
    
    if ($i % 2)
      echo '<td style="background: transparent">&nbsp;</td>';
    else 
      echo '</tr><tr>';
    $i++;
    
  }
  
  ?>
  <tr></tr>
</table>
  
  
<?php 
  
} 
?>
