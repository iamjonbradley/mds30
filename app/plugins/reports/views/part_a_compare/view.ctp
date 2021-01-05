<table width="100%">
  <tr>
    <td valign="top" class="left-column" valign="top">
      <?php 
      echo $this->element('_facility_list', array('plugin' => 'reports')); 
      ?>
    </td>
    <td valign="top" valign="top">
      <table class="results" cellspacing="0">
        <tr>
          <th><?php echo $this->Paginator->sort('ID', 'Assessment.id') ?></th>
          <th><?php echo $this->Paginator->sort('Resident #', 'Resident.id') ?></th>
          <th><?php echo $this->Paginator->sort('Lastname', 'Resident.PATLNAME') ?></th>
          <th><?php echo $this->Paginator->sort('Firstname', 'Resident.PATFNAME') ?></th>
          <th><?php echo $this->Paginator->sort('Type', 'SectionA.A0310B') ?></th>
          <th><?php echo $this->Paginator->sort('ARD', 'SectionA.A2300') ?></th>
          <th><?php echo $this->Paginator->sort('Lock Date', 'Assessment.LOCK_DATE') ?></th>
          <th><?php echo $this->Paginator->sort('MDS Part A', 'SectionA.A2400B') ?></th>
          <th><?php echo $this->Paginator->sort('MR Part A', 'Assessment.ATOPDTE') ?></th>
        </tr>
        <?php foreach ($data as $key => $value) { ?>
          <tr>
            <td><?php echo $value['Assessment']['id']; ?></td>
            <td><?php echo $value['Resident']['id']; ?></td>
            <td><?php echo $value['Resident']['PATLNAME']; ?></td>
            <td><?php echo $value['Resident']['PATFNAME']; ?></td>
            <td>
              <?php
                switch($value['SectionA']['A0310B']) {
                  
                }
              ?>
            </td>
            <td class="align-center"><?php echo $value['SectionA']['A2300']; ?></td>
            <td class="align-center"><?php echo $value['Assessment']['LOCK_DATE']; ?></td>
            <td class="align-center"><?php echo $value['SectionA']['A2400B']; ?></td>
            <td class="align-center"><?php echo $value['Assessment']['ATOPDTE']; ?></td>
          </tr>
        <?php } ?>
      </table>
    </td>
  </tr>
</table>