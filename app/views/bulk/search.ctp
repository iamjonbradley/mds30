<h2>Bulk Submissions</h2>
<table width="100%">
  <tr>
    <td class="left-column" valign="top">
      <?php echo $this->element('menus/side/bulk'); ?>
    </td>
    <td valign="top">
      <div class="tip"></div>
      <?php if (isset($data) && !empty($data)) { ?>
      <table  width="100%" cellspacing="0" class="results">
        <tr>
          <th>ID</th>
          <th>Facility</th>
          <th># of Assessments</th>
          <th>Download Batch File</th>
          <th>Date Created</th>
          <th>View Batch Information</th>
        </tr>
        <?php foreach ($data as $key => $value): ?>
          <tr>
            <td class="align-center"><?php echo $value['Bulk']['id']; ?></td>
            <td class="align-center"><?php echo $value['Facility']['name']; ?></td>
            <td class="align-center"><?php echo $value['Bulk']['count']; ?></td>
            <td class="align-center"><a href="/transmission_files/batches/<?php echo $value['Bulk']['filename']; ?>">Download Here</a></td>
            <td class="align-center"><?php echo $this->Time->format('m-d-Y', $value['Bulk']['created']); ?></td>
            <td class="align-center">
              <?php
                echo '<a href="/bulk/view/'. $value['Bulk']['id'] .'">
                  <img alt="edit" class="tooltip" title="Click here to view this Batch Submission" src="/img/actions/edit.png" />
                </a>';
              ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
      <?php } ?>
    </td>    
  </tr>  
</table>