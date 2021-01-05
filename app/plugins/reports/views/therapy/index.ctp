<table cellspacing="0" cellpadding="4" width="100%" class="results">

  <tr>
    <th><?php echo $this->Paginator->sort('PATNUM', 'Resident.PATNUM') ?></th>
    <th><?php echo $this->Paginator->sort('LASTNAME', 'Resident.PATLNAME') ?></th>
    <th><?php echo $this->Paginator->sort('FIRSTNAME', 'Resident.PATFNAME') ?></th>
    <th><?php echo $this->Paginator->sort('OTCAP_DTE', 'Resident.OTCAP_DTE') ?></th>
    <th><?php echo $this->Paginator->sort('SPCAP_DTE', 'Resident.SPCAP_DTE') ?></th>
    <th><?php echo $this->Paginator->sort('HRES_STPT', 'Resident.HRES_STPT') ?></th>
    <th><?php echo $this->Paginator->sort('HRES_OT', 'Resident.HRES_OT') ?></th>
    <th><?php echo $this->Paginator->sort('HOTCAP_DTE', 'Resident.HOTCAP_DTE') ?></th>
    <th><?php echo $this->Paginator->sort('HSPCAP_DTE', 'Resident.HSPCAP_DTE') ?></th>
    <th><?php echo $this->Paginator->sort('RESCAPOT', 'Resident.RESCAPOT') ?></th>
    <th><?php echo $this->Paginator->sort('RESCAPSP', 'Resident.RESCAPSP') ?></th>
  </tr>

<?php

foreach ($data as $key => $value) {

  echo '<tr>';
  echo '<td style="text-align: center">'. $value['Resident']['PATNUM'] .'</td>';
  echo '<td>'. $value['Resident']['PATLNAME'] .'</td>';
  echo '<td>'. $value['Resident']['PATFNAME'] .'</td>';
  echo '<td style="text-align: center">'. $value['Resident']['OTCAP_DTE'] .'</td>';
  echo '<td style="text-align: center">'. $value['Resident']['SPCAP_DTE'] .'</td>';
  echo '<td style="text-align: center">'. $value['Resident']['HRES_STPT'] .'</td>';
  echo '<td style="text-align: center">'. $value['Resident']['HRES_OT'] .'</td>';
  echo '<td style="text-align: center">'. $value['Resident']['HOTCAP_DTE'] .'</td>';
  echo '<td style="text-align: center">'. $value['Resident']['HSPCAP_DTE'] .'</td>';
  echo '<td style="text-align: center">'. $value['Resident']['RESCAPOT'] .'</td>';
  echo '<td style="text-align: center">'. $value['Resident']['RESCAPSP'] .'</td>';
  echo '</tr>';

}

?>

</table>