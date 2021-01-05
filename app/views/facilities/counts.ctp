<h2>Assessment Totals</h2>
<style type="text/css">
  .results { width: 60%; }
</style>
<table class="results" cellspacing="0" width="50%">
  <tr>
    <th>INTERNAL ID</th>
    <th>CMS ID</th>
    <th>NAME</th>
    <th>STATE</th>
    <th># of Locked Assessments</th>
    <th># of Open Assessments</th>
  </tr>
  <?php foreach ($counts as $key => $value) { ?>
    <tr>
      <td class="align-center"><?php echo $value['id']; ?></td>
      <td class="align-center"><?php echo $value['FAC_ID']; ?></td>
      <td class="align-center"><?php echo $value['name']; ?></td>
      <td class="align-center"><?php echo $value['F_STATE']; ?></td>
      <td class="align-center"><?php echo $value['locked']; ?></td>
      <td class="align-center"><?php echo $value['open']; ?></td>
    </tr>
  <?php } ?>
</table>