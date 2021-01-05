<h2>Assessment Totals</h2>
<style type="text/css">
  .results { width: 98%; }
</style>
<table class="results" cellspacing="0" cellpadding="0">
  <?php 
    foreach ($data as $key => $value) { 
      $total['pending'][]   = $value['pending'];
      $total['submitted'][] = $value['submitted'];
      $total['accepted'][]  = $value['accepted'];
      $total['rejected'][]  = $value['rejected'];
    }
  
    $pending = array_sum($total['pending']);
    $submitted = array_sum($total['submitted']);
    $accepted = array_sum($total['accepted']);
    $rejected = array_sum($total['rejected']);
  ?>
    <tr>
      <th>Submitted</th>
      <th>Pending</th>
      <th>% Pending</th>
      <th>Accepted</th>
      <th>% Accepted</th>
    </tr>
    <?php
    // set totals
    $ttl_submited = $submitted + $accepted + $rejected;
    $ttl_accepted = $accepted;
    $ttl_rejected = $submitted + $rejected;
    
    // get percents
		if($ttl_submited > 0) {
			if($ttl_accepted > 0) {
				$perc_accepted = $this->Number->toPercentage(($ttl_accepted/$ttl_submited)*100, 2);
			}
			else {
				$perc_accepted = 0;
			}
			
			if($ttl_rejected > 0) {
				$perc_rejected = $this->Number->toPercentage(($ttl_rejected/$ttl_submited)*100, 2);
			}
			else {
				$perc_rejected = 0;
			}
		}
		else {
			$perc_accepted = 0;
			$perc_rejected = 0;
		}
		
    ?>
    <tr class="totals">
      <td class="align-center"><?php echo $ttl_submited; ?></td>
      <td class="align-center"><?php echo $ttl_rejected; ?></td>
      <td class="align-center"><?php echo $perc_rejected; ?></td>
      <td class="align-center"><?php echo $ttl_accepted; ?></td>
      <td class="align-center"><?php echo $perc_accepted; ?></td>
    </tr>
    <tr>
</table>