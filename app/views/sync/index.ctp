<h2>Medical Records Sync Information</h2>

<table width="100%" class="results" cellspacing="0">
  <tr>
    <th class="align-left">Internal ID</th>
    <th class="align-left">Facility ID</th>
    <th class="align-left">MR Provider</th>
    <th class="align-left">Name</th>
    <th class="align-left">Last Rsync</th>
    <th class="align-left">Last MR Update</th>
  </tr>
  
  <?php 
  foreach ($data as $key => $value) { 
    $last_rsync = $this->Time->format('d', $value['last_rsync']);
    
    if ($last_rsync == date('d')) $class = 'current'; else $class = 'old';
  ?>
    <tr class="<?php echo $class; ?>">
      <td><?php echo $value['id']; ?></td>
      <td><?php echo $value['code']; ?></td>
      <td><?php echo ($value['rec_type']); ?></td>
      <td><?php echo $value['name']; ?></td>
      <td><?php echo $this->Time->timeAgoInWords($value['last_rsync']); ?></td>
      <td><?php echo $this->Time->timeAgoInWords($value['last_sync']); ?></td>
    </tr>
  <?php } ?>
  
</table>